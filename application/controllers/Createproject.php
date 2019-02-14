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
        $data['skills'] = Createproject::getAllSkills();

        $this->load->view('includes/header');
        $this->load->view('pages/createProject', $data);
        $this->load->view('includes/footer');
    }

    public function getAllSkills() {
        $path = base_url();
        $url = $path . 'api/admin/Createproject_api/getAllSkills';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // authenticate API
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, API_USER . ":" . API_PASSWD);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        $output = curl_exec($ch);
        //close cURL resource
        curl_close($ch);
        $response = json_decode($output, true);
        //echo $output;
        return $response;
    }

    public function create_project() {
        $company_id = $this->session->userdata('company_id');
        extract($_POST);
        $data['project_title'] = $project_title;
        $data['project_profit_margin'] = $project_profit_margin;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['skills'] = json_encode($skills);
        $data['project_cost'] = $project_cost;
        $data['project_description'] = $project_description;
        $data['company_id'] = $company_id;
        //print_r($data);die();
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
