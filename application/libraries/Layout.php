<?php

/**
 * Lib for layout some service content with using bootstrap
 *
 * @author anton
 */
class Layout {

    private $ci;
    // ways to view parts
    public $header = 'layout/header';
    public $footer = 'layout/footer';
    
    public $defaultCss = '';
    public $defaultJs = '';

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->helper('url');
        $this->defaultCss=base_url().'assets/bootstrap/css/';
        $this->defaultJs=base_url().'assets/bootstrap/js/';
    }

    // name of view, data for view
    public function content($views = '', $data = '') {
        // Default data for header
        if (!isset($data['defaultjs'])){
            $data['defaultjs']=$this->defaultJs;
        }
        if (!isset($data['defaultcss'])){
            $data['defaultcss']=$this->defaultCss;
        }
        // Load header
        if ($this->header) {            
            $this->ci->load->view($this->header, $data);
        }

        // main array content
        if (is_array($views)) {
            foreach ($views as $view) {
                $this->ci->load->view($view, $data);
            }
        } else {
            $this->ci->load->view($views, $data);
        }

        // load footer
        if ($this->footer) {
            $this->ci->load->view($this->footer, $data);
        }
    }

}

?>
