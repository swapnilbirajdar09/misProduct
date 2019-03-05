<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Setting_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Setting_model');
    }

// fun for get Company name
    public function getProfitMargin_get() {
        extract($_GET);
        $result = $this->Setting_model->getProfitMargin();
        return $this->response($result);
    }

    public function getFixedCost_get() {
        extract($_GET);
        $result = $this->Setting_model->getFixedCost();
        return $this->response($result);
    }

    public function updateFixedCost_post() {
        extract($_POST);
        $data = $_POST;
        $result = $this->Setting_model->updateFixedCost($data);
        return $this->response($result);
    }

    public function updateProfitMargin_post() {
        extract($_POST);
        $data = $_POST;
        $result = $this->Setting_model->updateFixedCost($data);
        return $this->response($result);
    }

// -------fun to add skill 
    public function addskills()
    {
        extract($_POST);
        $data=$_POST;
        $result=$this->Setting_model->addskills();
        return $this->response($result);

    }

}
