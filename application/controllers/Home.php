<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

// Login controller
    public function __construct() {
        parent::__construct();
// load common model
        $this->load->model('Login_model');
    }

// main index function
    public function index() {
//start session     
        $admin_name = $this->session->userdata('session_name');
        if ($admin_name != '') {
            //     //check session variable set or not, otherwise logout
            redirect('user_dashboard');
        }

        $this->load->view('includes/home/landing_header');
        $this->load->view('pages/home');
        $this->load->view('includes/home/landing_footer');
    }

}
