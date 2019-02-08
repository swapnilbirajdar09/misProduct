<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Assignemployee_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Assignemployee_model');
    }

// fun for get Company name
    public function getAllProjects_get() {
        extract($_GET);
        $result = $this->Assignemployee_model->getAllProjects($company_id);
        return $this->response($result);
    }
    
    public function getEmployeeDetails_get(){
        extract($_GET);
        $result = $this->Assignemployee_model->getEmployeeDetails($user_id);
        return $this->response($result);
    }
}