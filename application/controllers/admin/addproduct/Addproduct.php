<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addproduct extends CI_Controller {

// Login controller
    public function __construct() {
        parent::__construct();
// load common model
        //$this->load->model('Login_model');
    }

   public function getAllSkills() {
        // call to model function to get all skills from db
        $result = $this->product_model->getSkills();
        echo json_encode($result);
    }
}


?>