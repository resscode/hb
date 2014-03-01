<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('resultecho');
        // Turn on write in log for debug
        if ($this->input->post() && $this->config->item('log_customdebug_req')) {
            log_message('error', 'Request Data: ; ' . (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '') . "; " . implode(';', $this->input->post()));
        }
    }

    public function test() {
        
        $xml   = simplexml_load_string($xmlstring);
        $json  = json_encode($xml);
        $array = json_decode($json, TRUE);
        var_export($array);
        
    }

    public function package() {
        if ($this->input->post() && $this->input->post('authKey') && $this->input->post('parameters') && $this->input->post('userId')) {
            // Check For right sign
            $this->load->library('SecurityMethods');
            $this->config->load('commonconfig');
            $secCheckResult = $this->securitymethods->basicCheck($this->input->post('authKey'), $this->input->post('parameters'), $this->input->post('userId'));
            if ($secCheckResult !== $this->config->item('successcode_success')) {
                resultEcho($secCheckResult);
            }
            // Prepare answer
            $dataFromJson = $this->securitymethods->getDataFromJson();
            if (!isset($dataFromJson['answerFormat']) || !isset($dataFromJson['compression'])) {
                resultEcho($this->config->item('errorcode_notenoughparams'));
            }           
            // make operations in marketplace
            $this->load->library('MobilepackLib');
            $sendorderResult = $this->mobilepacklib->getpackage($dataFromJson);
            if (isset($dataFromJson['compression']) && $dataFromJson['compression'] == 'zip') {
                // just link on zip file
                if (!isset($dataFromJson['dataFormat'])){
                    $dataFromJson['dataFormat']= $dataFromJson['answerFormat'];
                }
                if ($dataFromJson['dataFormat'] == 'xml') {
                    $this->load->library('ArrayToXml', array('array' => $sendorderResult));
                    $stringToZip = $this->arraytoxml->get_xml();
                } else {
                    $stringToZip = json_encode($sendorderResult);
                }
                $this->load->library('Zip', array('content' => $stringToZip, 'filetype'=>$dataFromJson['dataFormat']));
                // full answer 
                $sendorderResult            = array();
                $sendorderResult['link']    = $this->zip->getArchivepath();
                $sendorderResult['compressSize']    = $this->zip->getZipFileSize();
                $sendorderResult['fileSize']    = $this->zip->getOriginalSize();
                $sendorderResult['version'] = isset($dataFromJson['version']) ? $dataFromJson['version'] : 0;
            }
            resultEcho($this->config->item('successcode_success'), $sendorderResult, false, $dataFromJson['answerFormat']);
        } else {
            resultEcho($this->config->item('errorcode_notenoughparams'));
        }
    }

}