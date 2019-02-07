<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Admin_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Admin_model');
    }

// fun for get Company name
    public function getAllPackages_get() {
        extract($_GET);
        $result = $this->Admin_model->getAllPackages();
        return $this->response($result);
    }

      public function getAllRoles_get() {
        extract($_GET);
        $result = $this->Admin_model->getAllRoles();
        return $this->response($result);
    }

}
