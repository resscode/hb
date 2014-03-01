<?php

/**
 * Description of Zip
 *
 * @author anton
 */
class Zip {

    // String to zip
    private $content;
    private $filename         = 'answer';
    private $compressInConstr = true;
    private $archivename      = false;
    private $archivepath;
    private $filetype         = 'json';
    private $archivetype      = 'zip';
    private $path             = '/assets/downloads/packages';
    private $compressedContent;
    private $result           = false;
    private $errorMessage;

    /*
     * $parameters=array('content', 'path', 'filename', 'filetype')
     */

    public function __construct($params = array()) {
        if (!isset($params['content'])) {
            $this->errorMessage = 'No content';
        }
        // parce params
        $this->paramsParce($params);
        // make compress file
        if ($this->compressInConstr == true) {
            $this->compress();
        }
    }

    private function paramsParce($params) {
        $publicArray = array('archivetype', 'path', 'content', 'filename', 'archivename', 'filetype');
        foreach ($params as $key => $val) {
            if (property_exists(__CLASS__, $key) && in_array($key, $publicArray)) {
                $this->$key = $val;
            }
        }
    }

    private function compress() {
        try {
            $zip         = new ZipArchive;
            $archivePath = realpath(FULLPATH . $this->path);
            if ($archivePath == false) {
                throw new Exception('No path or No permission for path view');
            }
            if ($this->archivename === false) {
                $archiveName = date('Y-m-d_H-i-s') . '.' . $this->archivetype;
            } else {
                $archiveName = $this->archivename . '.' . $this->archivetype;
            }
            $archiveName       = $archivePath . DIRECTORY_SEPARATOR . $archiveName;
            // Save in class property
            $this->archivepath = $archiveName;
            // Create Zip file
            $res               = $zip->open($archiveName, ZipArchive::CREATE);
            if ($res === TRUE) {
                $filename                = $this->filename .'.'. $this->filetype;
                $zip->addFromString($filename, $this->content);
                $this->compressedContent = $zip;
                $zip->close();
                $this->result            = true;
            } else {
                throw new Exception('Fail in zip operation');
            }
        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }

    public function getOriginalSize($filename = false) {
        if ($filename == false) {
            $filename = $this->archivepath;
        }
        $size         = 0;
        $resource     = zip_open($filename);
        while ($dir_resource = zip_read($resource)) {
            $size += zip_entry_filesize($dir_resource);
        }
        zip_close($resource);
        return $size;
    }
    
    public function getZipFileSize($filename = false){
        if ($filename == false) {
            $filename = $this->archivepath;
        }
        $size         = filesize($filename);
        return $size;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function getArchivepath() {
        if ($this->result == false) {
            return false;
        } else {
            return str_replace(FULLPATH, '', $this->archivepath);
        }
    }

    public function getCompressed() {
        
    }

}

?>
