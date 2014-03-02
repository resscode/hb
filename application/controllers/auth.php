<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * auth
 * 
 * Where all the authentication methods live
 * 
 * @license		http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @author		Mike Funk
 * @link		http://mikefunk.com
 * @email		mike@mikefunk.com
 * 
 * @file		auth.php
 * @version		1.3.4
 * @date		03/20/2012
 */
// --------------------------------------------------------------------------

/**
 * auth class.
 * 
 * @extends CI_Controller
 */
class auth extends CI_Controller {
    // --------------------------------------------------------------------------

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->spark('ci_authentication/1.3.4');
    }

    // --------------------------------------------------------------------------

    /**
     * login function.
     *
     * shows login form, handles validation.
     * 
     * @access public
     * @return void
     */
    public function login() {
        // IF login redirect to pockets
        if (is_logged_in()){
            $this->load->helper('url');
            redirect('/hb/outtransactions', 'refresh');
        }
        // load resources
        $this->load->helper(array('cookie', 'url'));
        $this->load->library('form_validation');
        $this->ci_authentication->remember_me();
        $data = array();
        $out = '';
        // form validation
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|callback__email_address_check');
        $this->form_validation->set_rules('password', 'Password', 'required|callback__password_check');
        if ($this->form_validation->run() == FALSE) {
            // load view
            $out = $this->load->view('login_view', $data, true);
        } else {
            // redirect to configured home page
            $this->ci_authentication->do_login();
        }
        $output['output'] = $out;
        $this->_bootstrap_output($output);
    }

    // --------------------------------------------------------------------------

    /**
     * login_new_password function.
     *
     * shows login_new_password form, handles validation.
     * 
     * @access public
     * @return void
     */
    public function login_new_password() {
        // load resources
        $this->load->helper(array('cookie', 'url'));
        $this->load->library('form_validation');
        $this->ci_authentication->remember_me();
        $out = '';
        // form validation
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|callback__email_address_check');
        $this->form_validation->set_rules('temp_password', 'Temporary Password', 'required|callback__password_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            // load view
            $out = $this->load->view('login_new_password_view', $data, true);
        } else {
            // redirect to configured home page
            $this->ci_authentication->do_login();
        }
        $output['output'] = $out;
        $this->_bootstrap_output($output);
    }

    // --------------------------------------------------------------------------

    /**
     * _email_address_check function.
     *
     * checks for an email in the db and checks to make sure registration link
     * has been clicked.
     * 
     * @access public
     * @param string $email_address
     * @return bool
     */
    public function _email_address_check($email_address) {
        if (!$this->ci_authentication_model->username_check($email_address)) {
            $this->form_validation->set_message('_email_address_check', 'Email address not found. <a href="' . base_url() . 'auth/register">Want to Register?</a>');
            return false;
        } else {
            // if there's a confirm string, fail
            $q = $this->ci_authentication_model->get_user_by_username($email_address);
            $r = $q->row();
            // if (!$this->ci_authentication_model->confirm_string_check($email_address))
            if ($r->confirm_string != '') {
                $this->form_validation->set_message('_email_address_check', 'Please click the registration link sent to your email. <a href="' . base_url() . 'auth/resend_register_email/' . $r->confirm_string . '">Or resend it</a>.');
                return false;
            } else {
                return true;
            }
        }
    }

    // --------------------------------------------------------------------------

    /**
     * _password_check function.
     *
     * checks to ensure password matches username in db.
     * 
     * @access public
     * @param string $password
     * @return bool
     */
    public function _password_check($password) {
        $chk = $this->ci_authentication_model->password_check($this->input->post('email_address'), $password);
        if (!$chk) {
            $this->form_validation->set_message('_password_check', 'Incorrect password. <a href="' . base_url() . 'auth/request_reset_password/?email_address=' . $this->input->post('email_address') . '">Forgot your password?</a>');
            return false;
        } else {
            return true;
        }
    }

    // --------------------------------------------------------------------------

    /**
     * register function.
     *
     * displays register form, handles validation, runs ci_authentication library 
     * method on success.
     * 
     * @access public
     * @return void
     */
    public function register() {
        $this->load->helper(array('cookie', 'url'));
        $this->load->library('form_validation');
        $data = array();
        $out = '';
        // form validation
        $this->form_validation->set_rules(config_item('username_field'), 'Email Address', 'trim|required|valid_email|is_unique[' . config_item('users_table') . '.' . config_item('username_field') . ']');
        $this->form_validation->set_rules(config_item('password_field'), 'Password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[' . config_item('password_field') . ']');
        if ($this->form_validation->run() == FALSE) {
            // load view
            $out = $this->load->view('register_view', $data, true);
        } else {
            // redirect to configured home page
            $this->ci_authentication->do_register();
        }
        $output['output'] = $out;
        $this->_bootstrap_output($output);
    }

    // --------------------------------------------------------------------------

    /**
     * my_profile function.
     *
     * Displays user profile form for logged in user, edits user and redirects
     * on successful submit.
     * 
     * @access public
     * @return void
     */
    public function my_profile() {
        $this->ci_authentication->restrict_access();

        $this->load->helper(array('cookie', 'url'));
        $this->load->library(array('form_validation'));
        $out = '';
        // form validation
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|callback__new_unique_email_check');
        if ($this->input->post('password') !== '' && $this->input->post('password') !== FALSE) {
            $this->form_validation->set_rules('old_password', 'Current Password', 'trim|required|callback__password_check');
            $this->form_validation->set_rules('password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'trim|required|matches[password]');
        }
        if ($this->form_validation->run() == FALSE) {
            // load view
            $data['item_query'] = $this->ci_authentication_model->get_user_by_username(auth_username());
            $out = $this->load->view('my_profile_view', $data, true);
        }
        // form val successful
        else {
            // update the user
            unset($_POST['old_password']);
            unset($_POST['confirm_password']);
            $post = $this->input->post();

            if ($this->input->post('password') == '') {
                unset($_POST['password']);
                unset($post['password']);
            } else {
                $post['password'] = encrypt_this($this->input->post('password'));
            }
            $this->ci_authentication_model->edit_user_by_username($post);

            // set userdata, alert, redirect
            $this->session->set_userdata($post);
            $this->ci_alerts->set('success', 'Profile updated.');
            redirect('my_profile');
        }
        if (!empty($out)){
            $output['auth'] = true;
        }
        $output['output'] = $out;
        $this->_bootstrap_output($output);
    }

    // --------------------------------------------------------------------------

    /**
     * resend_register_email function.
     *
     * resends register email based on confirm_string, redirects to configured page.
     * 
     * @access public
     * @param string $confirm_string
     * @return void
     */
    public function resend_register_email($confirm_string) {
        $this->ci_authentication->resend_register_email($confirm_string);
    }

    // --------------------------------------------------------------------------

    /**
     * confirm_register function.
     *
     * verifies confirm link, clears confirm_string column for that user, sets
     *  flashdata for success notice, redirects to login page.
     * 
     * @access public
     * @param string $confirm_string
     * @return void
     */
    public function confirm_register($confirm_string) {
        $this->ci_authentication->do_confirm_register($confirm_string);
    }

    // --------------------------------------------------------------------------

    /**
     * request_reset_password function.
     *
     * send email confirmation to user, redirects to configured page.
     * 
     * @access public
     * @return void
     */
    public function request_reset_password() {
        $email_address = $this->input->get('email_address');
        $this->ci_authentication->do_request_reset_password($email_address);
    }

    // --------------------------------------------------------------------------

    /**
     * confirm_reset_password function.
     *
     * validates whether encryption of passed email and encrypted string match,
     * emails temp password and redirects to configured page (login new password)
     * 
     * @access public
     * @return void
     */
    public function confirm_reset_password() {
        $this->ci_authentication->do_confirm_reset_password();
    }

    // --------------------------------------------------------------------------

    /**
     * logout function.
     *
     * destroys the session, unsets userdata, sets flashdata, redirects to 
     * configured page (login page).
     * 
     * @access public
     * @return void
     */
    public function logout() {
        $this->ci_authentication->do_logout();
    }

    // --------------------------------------------------------------------------

    /**
     * alert function.
     * 
     * @access public
     * @return void
     */
    public function alert() {
        // load resources
        $this->load->helper('url');

        // load content and view
        $data['content'] = $this->load->view('alert_view', $data);
    }

    public function _bootstrap_output($outputData = null) {
        // add js and css files, temporary
        $baseUrl = $this->config->item('base_url');
        $outputData['js_files'] = array(
            '2132c40972af50fb2d2e44213e047a1b5d9f49d3' => $baseUrl . '/assets/grocery_crud/js/jquery-1.10.2.min.js',
            'f364d273ef9826490ebd57509ae563d2071d3fb2' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/js/jquery-ui/jquery-ui-1.9.2.custom.js',
            '1e5c41adc3783d74df037a01f5c2175a824705a1' => $baseUrl . '/assets/grocery_crud/js/common/lazyload-min.js',
            'd04ba7f0d55dda1d4ba9b6532414c653c58b0318' => $baseUrl . '/assets/grocery_crud/js/common/list.js',
            '2660faea71981a496fdf559e3db2edd0b4c86b06' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/js/libs/bootstrap/bootstrap.min.js',
            '6516446c801c6c279aed213b6b6c03e599c8327e' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/js/libs/bootstrap/application.js',
            'ebed7bf5a99cd73259fbeb24deb9b026a869444d' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/js/libs/modernizr/modernizr-2.6.1.custom.js',
            '54913249db526ebb33ded4ec7737a44228a20a10' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/js/libs/tablesorter/jquery.tablesorter.min.js',
            'a0fe0be6274bc7fd45ddabcd561ff5e55c27e001' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/js/cookies.js',
            'd5904241462e293a4600e81358b1e32336efb468' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/js/jquery.form.js',
            '41101518af3f8fb416f60152aa019d963ae9293b' => $baseUrl . '/assets/grocery_crud/js/jquery_plugins/jquery.numeric.min.js',
            'c657bedfbdf44e5039bc0d291cee8e260c9743cf' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/js/libs/print-element/jquery.printElement.min.js',
            '6279df8612f557f3151c02ed3dfc5d97f491e9cf' => $baseUrl . '/assets/grocery_crud/js/jquery_plugins/jquery.fancybox-1.3.4.js',
            'd24105860047fc8ef3893d8892bb13d5cb2e8455' => $baseUrl . '/assets/grocery_crud/js/jquery_plugins/jquery.easing-1.3.pack.js',
            '68346b58c3ac45d87b5947c4a539c97ecdca8c92' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/js/app/twitter-bootstrap.js',
            'e50f4d5a086158ffc1396d8f8808710d96ebdcae' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/js/jquery.functions.js',
        );

        $outputData['css_files'] = array(
            'b36caa4af5f8b40ecf114db81b79f9e5d11be22f' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/css/bootstrap.min.css',
            'b04ba652b136ed87f03fa8bb17c565ce8b46c069' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/css/bootstrap-responsive.min.css',
            'e43fb64a583a3bc5ad7b709a2ab0c4b171e3d4bc' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/css/style.css',
            'ecf671ba38781f74e2f6c520900245386742b7b7' => $baseUrl . '/assets/grocery_crud/themes/twitter-bootstrap/css/jquery-ui/flick/jquery-ui-1.9.2.custom.css',
        );

        $this->load->view('hb.php', $outputData);
    }

    // --------------------------------------------------------------------------
}

/* End of file auth.php */
/* Location: ./ci_authentication/examples/controllers/auth.php */