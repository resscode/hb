<?php

function getFileType($file) {
    if (function_exists("mime_content_type"))
        return mime_content_type($file);
    else if (function_exists("finfo_open")) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $type  = finfo_file($finfo, $file);
        finfo_close($finfo);
        return $type;
    } else {
        $types = array(
            'jpg'  => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png'  => 'image/png',
            'gif'  => 'image/gif', 'bmp'  => 'image/bmp'
        );
        $ext   = substr($file, strrpos($file, '.') + 1);
        if (key_exists($ext, $types))
            return $types[$ext];
        return "unknown";
    }
}

function acceptableType($type) {
    $array = array("image/jpeg", "image/jpg", "image/png", "image/png");
    if (in_array($type, $array))
        return true;
    return false;
}

function echoImage($file = false, $type=false) {
    if ($file == false) {
        header('HTTP/1.1 403 Forbidden');
        exit;
    } else {
        header("Content-type: $type");
        echo file_get_contents($file);
        exit;
    }
}

?>
