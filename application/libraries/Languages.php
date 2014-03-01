<?php

/**
 * Description of Languages
 *
 * @author anton
 */
class Languages {

    private $ci;
    private $customerId = false;
    private $lanArray=array();
    private $daultIsoCode;
    public function __construct($params) {
        $this->ci = & get_instance();
        $this->ci->config->load('commonconfig');
        $daultIsoCode= $this->ci->config->item('defaultLan');
        $this->setParams($params);
        if (isset($params['customerId'])) {
           $result = $this->selectCustomerLanRow($params['customerId']);
           if ($result==false){
               $this->selectLanRow(array("iso_code"=>$daultIsoCode));
           }
        }else{
            $this->selectLanRow(array("iso_code"=>$daultIsoCode));
        }
        $this->daultIsoCode=$daultIsoCode;
    }

    /**
     * Set default params
     * @param array $params
     */
    private function setParams($params) {
        $open = array('customerId');
        foreach ($params as $key => $val) {
            if (in_array($key, $open) && property_exists(__CLASS__, $key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * Select row by params
     * @param type $where
     * @return boolean/array
     */
    public function selectLanRow($where, $returnVal = false) {
        $query = $this->ci->db->get_where('languages', $where, 1);
        if (is_object($query) && $query->num_rows() > 0) {
            $this->lanArray = $query->row_array();
            if ($returnVal == true) {
                return $this->lanArray;
            } else {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Get language row by customer id
     * @param int $customerId
     * @param boolean $returnVal
     * @return boolean/array
     */
    public function selectCustomerLanRow($customerId, $returnVal = false) {
        $this->ci->db->select('languages.*');
        $this->ci->db->from('customers_languages');
        $this->ci->db->join('languages', 'customers_languages.table_id = languages.id');
        $this->ci->db->where('customers_languages.customer_id', $customerId);
        $query = $this->ci->db->get();
        if (is_object($query) && $query->num_rows() > 0) {
            $this->lanArray = $query->row_array();
            if ($returnVal == true) {
                return $this->lanArray;
            } else {
                return true;
            }
        }
        return false;
    }

    /**
     * Just return Lan row
     * @return array
     */
    public function getLanArr() {
        return $this->lanArray;
    }

}

?>
