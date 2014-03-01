<?php

/**
 * Methods for realisation security ideology
 * 
 */
class SecurityMethods {

    private $ci;
    private $configArray;
    private $dataFromJson;

    public function __construct() {
        // Connection of the configuration array, can be changed for not CI
        $this->ci          = & get_instance();
        $this->ci->config->load('commonconfig');
        $this->configArray = $this->ci->config->config;
    }

    public function basicCheck($authKey, $allParamsString, $authUserId = false) {
        if ($authUserId == false) {
            $secretKey = $this->configArray['default_secret_key'];
        } else {
            $this->ci->load->model('Users_model');
            $dataForAuth = $this->ci->Users_model->getDataForAuth($authUserId);
            if ($dataForAuth == false) {
                // If there is no user with sended ID or some error with Get from DB
                return $this->configArray['errorcode_signcheckfail'];
                log_message('error', 'No user for middle check founded');
            }
            $secretKey = $dataForAuth['secretKey'];
        }

        $result             = $this->configArray['errorcode_signcheckfail'];
        // Saving all params array
        $this->dataFromJson = json_decode($allParamsString, true);
        // TODO remove this debug code on production
        if ($this->ci->config->item('off_signcheck'))
            return $this->configArray['successcode_success'];
        // Temporary for debugging
         log_message('error', '{
             "api_blowfish":"'.$this->ci->config->item('api_blowfish').'", 
             "params":"'.$allParamsString.'", "secretKey":"'.$secretKey.'",
             "md5":"'.md5($this->ci->config->item('api_blowfish').$allParamsString.$secretKey).'"}');
        if ($authKey == md5($this->ci->config->item('api_blowfish').$allParamsString.$secretKey)) {
            $result = $this->configArray['successcode_success'];
        }
        return $result;
    }

    public function basicSign($allParamsString, $secretKey) {
        $authKey = hash_hmac('md5', $allParamsString, $secretKey);
        return $authKey;
    }

    public function middleCheck($timestamp, $authKey, $allParamsString, $password, $secretKey) {
        $result = $this->configArray['errorcode_signcheckfail'];
        // First part of check, check for timestamp expire
        if (time() - $timestamp > $this->configArray['sign_lifetime']) {
            $result = $this->configArray['errorcode_signlifetime'];
        } else {
            // Second step - signature verification
            $generatedAuthKey = hash_hmac('sha256', $allParamsString, $password . $secretKey);
            if ($authKey == $generatedAuthKey) {
                $result = $this->configArray['successcode_success'];
            } else {
                log_message('error', 'Wrong authKey for middle check; authKey: ' . $generatedAuthKey . '; data: ' . $allParamsString . ';' . $password . ';' . $secretKey);
            }
        }
        return $result;
    }

    public function middlePacketCheck($userId, $paramsString, $authKey) {
        // Get User password and Secr Key from DB
        $this->ci->load->model('Users_model');
        $dataForAuth = $this->ci->Users_model->getDataForAuth($userId);
        if ($dataForAuth == false) {
            // If there is no user with sended ID or some error with Get from DB
            return $this->configArray['errorcode_signcheckfail'];
            log_message('error', 'No user for middle check founded');
        }
        // Check  for right packet structure            
        $params = json_decode($paramsString, true);
        // Exit for wrong json string format
        if ($params == NULL || !isset($params['timestamp'])) {
            log_message('error', 'No timestamp or other params for middle check');
            return $this->configArray['errorcode_signcheckfail'];
        }
        $this->dataFromJson = $params;
        // TODO remove this debug code on production
        if ($this->ci->config->item('off_signcheck'))
            return $this->configArray['successcode_success'];
        // Check For right sign        
        $securityCheck      = $this->middleCheck($params['timestamp'], $authKey, $paramsString, $dataForAuth['password'], $dataForAuth['secretKey']);
        return $securityCheck;
    }

    public function getDataFromJson($singleColumn = false) {
        if ($singleColumn == false) {
            return $this->dataFromJson;
        } else {
            return $this->dataFromJson[$singleColumn];
        }
    }

    public function middleSign($allParamsString, $password, $secretKey) {
        $authKey   = hash_hmac('sha256', $allParamsString, $password . $secretKey);
        $resultArr = array('timestamp' => time(),
            'authKey'   => $authKey);
        return $resultArr;
    }

    public function advancedCheck() {
        
    }

    public function advancedSign() {
        
    }

}