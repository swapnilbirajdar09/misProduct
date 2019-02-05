<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Createproject extends CI_Controller {

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
        if ($admin_name == '') {
            //     //check session variable set or not, otherwise logout
            redirect('login');
        }
        $this->load->view('includes/header');
        $this->load->view('pages/createProject');
        $this->load->view('includes/footer');
    }

    public function create_project() {
        $user_name = $this->session->userdata('session_name');
        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');

        extract($_POST);
        $data = $_POST;
        //print_r($data);die();
        $data['user_id'] = $user_id;
        $data['user_name'] = $user_name;
        $path = base_url();
        $url = $path . 'api/admin/Createproject_api/create_project';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
//        echo $response_json;
//        die();
        if ($response == '200') {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Project Created successfully.</div>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Project Not Created Successfully.</div>'
            );
            echo json_encode($response);
            die();
        }
    }

}
