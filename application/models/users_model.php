<?php

class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function checkUserIsset($login, $password) {
        // Get user data
        $this->db->select('users.secret_key AS secretKey, users.id AS userId, users.time_zone AS timeZone, users.role_id AS roleId, roles.Name AS roleName');
        $this->db->from('users', 'roles');
        $this->db->where(array('login' => $login, 'password' => $password));
        $this->db->join('roles', 'users.role_id = roles.id');
        $query = $this->db->get();        
        if ($query!=false && $query->num_rows() > 0) {
            $userArr = $query->row_array();
            return $userArr;
        } else {
            return false;
        }
    }

    public function getDataForAuth($userId ) {
        $query = $this->db->get_where('users', array('id' => $userId), 1);
        if ($query->num_rows() > 0) {
            $userArr = $query->row_array();
            return array('password' => $userArr['pass'],
                'secretKey' => $userArr['secret_key']);
        } else {
            return false;
        }
    }
    public function isExist($email, $select='id' ) {        
        $this->db->select($select);
        $query = $this->db->get_where('users', array('login' => $email), 1);
        if ($query!=false && $query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

}
