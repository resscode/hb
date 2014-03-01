<?php

function writeLog($log, $messageName = false, $messageType = 1, $log_file = 'debug_log', $log_path = '/logs') {
    $log_path = APPPATH . $log_path;    
    $date = new DateTime();
    $messageName = $messageName == false ? "" : $messageName . '; ';
    $full_name = $log_path . "/" . $log_file . $date->format("Ymd") . ".log";
    if (!file_exists($log_path)) {
        mkdir($log_path);
    }
    if (!$file_handle = fopen($full_name, "a")) {
        
    }
    if (is_array($log)) {
        ob_start();
        var_export($log);
        $log = ob_get_clean();
//        $log = implode(";", $log);
    }
    if (!fwrite($file_handle, '[' . $date->format('d\/m\/Y : H:i:s:u') . '] ; ' . $messageName . $log . "\n")) {
        
    }
    fclose($file_handle);
}

?>
