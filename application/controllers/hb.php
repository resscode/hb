<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hb extends CI_Controller {

    private $errorMessage;
    private $menu;

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->library('Layout');
        $this->ci_authentication->restrict_access();
        //TODO finish with realizatin auth part
//$autoload['libraries'] = array('ci_authentication');
//$autoload['model'] = array('ci_authentication_model');
//$autoload['helper'] = array('ci_authentication_helper');
//$autoload['config'] = array('ci_authentication');
        // If Not login, redirect to login page.
    }

    public function pockets() {
        try {
            $crud          = new grocery_CRUD();
            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('pockets');
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
        $post['result'] = $result;
        return $post;
    }

    public function intransactions() {
        try {
            $crud          = new grocery_CRUD();
            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('in_transactions');
            $crud->set_primary_key('id', 'in_categories');
            $crud->set_relation('category_id', 'in_categories', 'name');
            $crud->set_primary_key('id', 'pockets');
            $crud->set_relation('pocket_id', 'pockets', 'name');
            $crud->set_primary_key('id', 'users');
            $crud->set_relation('user_id', 'users', 'name');
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
            $crud->set_primary_key('id', 'pockets');
            $crud->set_relation('pocket_id_from', 'pockets', 'name');
            $crud->set_relation('pocket_id_to', 'pockets', 'name');
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
            if ($row['count'] >= $post['count']) {
                $this->db->where('id', $post['pocket_id']);
                $this->db->update('pockets', array('count' => $row['count'] - $post['count']));
            } else {
                $result = 0;
            }
        } else {
            $result = 0;
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
            $crud->set_relation('category_id', 'out_categories', 'name');
            $crud->set_primary_key('id', 'pockets');
            $crud->set_relation('pocket_id', 'pockets', 'name');
            $crud->set_primary_key('id', 'users');
            $crud->set_relation('user_id', 'users', 'name');
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