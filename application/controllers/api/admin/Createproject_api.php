<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Createproject_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Createproject_model');
        //$this->load->model('admin/Admin_model');
    }

    //----------fun for create project Details------------------------//
    public function create_project_post() {
        $data = $_POST;
        //print_r($data);die();
        $result = $this->Createproject_model->create_project($data);
        return $this->response($result);
    }

    public function getAllSkills_get() {
        $result = $this->Createproject_model->getAllSkills();
        return $this->response($result);
    }

}
