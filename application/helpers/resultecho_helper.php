<?php

function resultEcho($resultCode, $parameters = false, $message = false, $type = 'json') {
    $ci           = null;
    $echoPartsArr = array('result' => $resultCode);
    if ($parameters !== false) {
        // full answer 
        $echoPartsArr['parameters'] = $parameters;
    }
    if ($message !== false) {
        $echoPartsArr['messages'] = (!is_array($message)) ? array($message) : $message;
    }if ($type == 'json') {
        header('Content-type: application/json');
        $out = json_encode($echoPartsArr);
    } elseif ($type == 'xml') {
        header('Content-type: application/xml');
        if (is_null($ci)) {
            $ci = & get_instance();
        }
        $ci->load->library('ArrayToXml');
        $out = $ci->arraytoxml->get_xml(array('array' => $echoPartsArr));
    } else {
        header('Content-type: application/json');
        $out = json_encode($echoPartsArr);
    }
    // Turn on write in log for debug
    // TODO remove this debug code on production
    if (is_null($ci)) {
        $ci = & get_instance();
    }
    if ($ci->config->item('log_customdebug_answ')) {
        log_message('error', 'Answer: ' . $out);
    }
    echo $out;
    exit;
}

?>
