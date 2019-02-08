<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Employee_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
    }

// fun for get Company name
    public function getCompanyName_get() {
        extract($_GET);
        $result = $this->Employee_model->getCompanyName($company_id);
        return $this->response($result);
    }
    // fun for create employee
    public function create_employee_post(){
        extract($_POST);
        $data = $_POST;
        $result = $this->Employee_model->create_employee($data);
        return $this->response($result);
    }
    // fun get all employee details
    public function getAllEmployee_get(){
        extract($_GET);
        $result = $this->Employee_model->getAllEmployee($company_id);
        return $this->response($result);
    }
    // fun for delete user 
    public function deleteUser_get() {
        extract($_GET);
        $result = $this->Employee_model->deleteUser($user_id);
        return $this->response($result);
    }
}