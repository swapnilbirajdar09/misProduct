<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

class Registeruser_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Register_model');
    }

    // api to get all document types
    public function register_user_post() {
        extract($_POST);
        $data = $_POST;
        $result = $this->Register_model->register_user($data);
        return $this->response($result);
    }

}
