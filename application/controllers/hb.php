<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hb extends CI_Controller {

    private $errorMessage;
    private $menu;
    private static $listsActions = array(
        'list',
        'ajax_list'
    );
    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->library('Layout');
        $this->ci_authentication->restrict_access();
    }

    public function pockets() {
        try {
            $crud          = new grocery_CRUD();
            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('pockets');
            $crud->columns('name', 'count', 'description', 'updated');
//            $crud->fields('name', 'description', 'count', 'count_limit', 'created');
            $output        = $crud->render();
            $output->title = 'Pockets';
            $this->_bootstrap_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function migratetransactionsInCounts($post) {
        // Minus in From pocket
        // Get count from pocket
        $query  = $this->db->get_where('pockets', array('id' => $post['pocket_id']), 1);
        $result = 1;
        if (is_object($query) && $query->num_rows() > 0) {
            $row = $query->row_array();
//            if ($row['count_limit'] == 0 || ($row['count_limit'] != 0 && $row['count_limit'] <= $row['count'] + $post['count'])) {
                $this->db->where('id', $post['pocket_id']);
                $this->db->update('pockets', array('count' => $row['count'] + $post['count']));
//            }else{
               $result = 1; 
//            }
        } else {
            $result = 0;
        }
        // Add login user id
        $post['user_id'] = auth_id();
        // Add currend date time if was not selected
        if (empty($post['created'])){
            $post['created'] = date('d-m-Y h:i:s');
        }
        $post['result'] = $result;
        return $post;
    }

    public function intransactions() {
        try {
            $crud          = new grocery_CRUD();
            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('in_transactions');
            $crud->order_by('created', 'desc');
            $crud->columns('created','name', 'count', 'pocket_id', 'user_id', 'category_id');
            $crud->required_fields('name','count','pocket_id','category_id');
            $crud->set_rules('count','Count','numeric|required');
            $crud->set_primary_key('id', 'in_categories');
            $crud->set_relation('category_id', 'in_categories', 'name', null, 'priority desc');
            $crud->set_primary_key('id', 'pockets');
            if( !in_array($crud->getState(), self::$listsActions)) { 
                $crud->set_relation('pocket_id', 'pockets', '{name} | {count}', null, 'priority desc');
            }else{
                $crud->set_relation('pocket_id', 'pockets', 'name', null, 'priority desc');
            }
            $crud->set_primary_key('id', 'users');
            if( in_array($crud->getState(), self::$listsActions)) { 
                $crud->set_relation('user_id', 'users', 'name');
            }
            $crud->field_type('user_id', 'invisible');
            $crud->callback_before_insert(array($this, 'migratetransactionsInCounts'));
            $output        = $crud->render();
            $output->title = 'In transactions';
            $this->_bootstrap_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function migratetransactions() {
        try {
            $crud          = new grocery_CRUD();
            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('migrate_transactions');
            $crud->order_by('created', 'desc');
            $crud->set_primary_key('id', 'pockets');
            $crud->required_fields('count','pocket_id_from','pocket_id_to');
            $crud->set_rules('count','Count','numeric|required');
            $crud->set_relation('pocket_id_from', 'pockets', '{name} | {count}', null, 'priority desc');
            $crud->set_relation('pocket_id_to', 'pockets', '{name} | {count}', null, 'priority desc');
            $crud->columns('pocket_id_from', 'pocket_id_to', 'count', 'created');
            $crud->field_type('user_id', 'invisible');
            $crud->callback_before_insert(array($this, 'migratetransactionsCounts'));
            $output        = $crud->render();
            $output->title = 'Migrate transactions';
            $this->_bootstrap_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function migratetransactionsCounts($post) {
        // Minus in From pocket
        // Get count from pocket
        $query  = $this->db->get_where('pockets', array('id' => $post['pocket_id_from']), 1);
        $result = 1;
        if (is_object($query) && $query->num_rows() > 0) {
            $row = $query->row_array();
            if ($row['count'] >= $post['count']) {
                $this->db->where('id', $post['pocket_id_from']);
                $this->db->update('pockets', array('count' => $row['count'] - $post['count']));
            } else {
                $result = 0;
            }
        } else {
            $result = 0;
        }
        // Plus in To pocket
        $query = $this->db->get_where('pockets', array('id' => $post['pocket_id_to']), 1);
        if (is_object($query) && $query->num_rows() > 0 && $result == 1) {
            $row = $query->row_array();            
                $this->db->where('id', $post['pocket_id_to']);
                $this->db->update('pockets', array('count' => $row['count'] + $post['count']));            
        } else {
            $result = 0;
        }
        // Add login user id
        $post['user_id'] = auth_id();
        $post['result'] = $result;
        return $post;
    }

    public function migratetransactionsOutCounts($post) {
        // Minus in From pocket
        // Get count from pocket
        $query  = $this->db->get_where('pockets', array('id' => $post['pocket_id']), 1);
        $result = 1;
        if (is_object($query) && $query->num_rows() > 0) {
            $row = $query->row_array();
            if ($row['count'] >= $post['count'] || $row['is_negative']) {
                $this->db->where('id', $post['pocket_id']);
                $this->db->update('pockets', array('count' => $row['count'] - $post['count']));
            } else {
                $result = 0;
            }
        } else {
            $result = 0;
        }
        // Add login user id
        $post['user_id'] = auth_id();
        // Add currend date time if was not selected
        if (empty($post['created'])){
            $post['created'] = date('d-m-Y h:i:s');
        }
        $post['result'] = $result;
        return $post;
    }

    public function outtransactions() {
        try {

            $crud          = new grocery_CRUD();
            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('out_transactions');
            $crud->set_primary_key('id', 'out_categories');
            $crud->order_by('created','desc');
            $crud->columns('created','name', 'count', 'pocket_id', 'user_id', 'category_id');
            $crud->required_fields('name','count','pocket_id','category_id');
            $crud->set_rules('count','Count','numeric|required');
            $crud->set_relation('category_id', 'out_categories', 'name', null, 'priority desc');
            $crud->set_primary_key('id', 'pockets');
            if( !in_array($crud->getState(), self::$listsActions)) { 
                $crud->set_relation('pocket_id', 'pockets', '{name} | {count}', null, 'priority desc');
            }else{
                $crud->set_relation('pocket_id', 'pockets', 'name', null, 'priority desc');
            }
            $crud->set_primary_key('id', 'users');
            if( in_array($crud->getState(), self::$listsActions)) { 
                $crud->set_relation('user_id', 'users', 'name');
            }
            $crud->add_fields('name','category_id','pocket_id','count', 'created', 'description', 'user_id');
            $crud->field_type('user_id', 'invisible');
            $crud->callback_before_insert(array($this, 'migratetransactionsOutCounts'));
            $output        = $crud->render();
            $output->title = 'Out transactions';
            $this->_bootstrap_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
    public function incategories() {
        try {

            $crud          = new grocery_CRUD();
            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('in_categories');
            $output        = $crud->render();
            $output->title = 'In categories';
            $this->_bootstrap_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function outcategories() {
        try {

            $crud          = new grocery_CRUD();
            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('out_categories');
            $output        = $crud->render();
            $output->title = 'Out categories';
            $this->_bootstrap_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
    public function prepareUserCreate($params){
        if (empty($params['secret_key'])){
            $this->load->helper('secretkeygenerate');
            $params['secret_key']=secretkeygenerate(32);
        }
        $this->config->load('commonconfig');
        $params['pass']=md5($this->config->item('user_pass_blowfish').$params['pass']);
        return $params;
    }
    
    public function users() {
        try {

            $crud          = new grocery_CRUD();
            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('users');
            $crud->callback_before_insert(array($this, 'prepareUserCreate'));
            $output        = $crud->render();
            $output->title = 'Users';
            $this->_bootstrap_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _bootstrap_output($output = null) {
        $output->auth = true; 
        $this->load->view('hb.php', $output);
    }

    public function index() {
        $this->pockets();
    }

}