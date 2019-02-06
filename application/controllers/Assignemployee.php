<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assignemployee extends CI_Controller {

// Login controller
    public function __construct() {
        parent::__construct();
// load common model
        //$this->load->model('Login_model');
    }

    // main index function
    public function index() {
        //start session     
        $admin_name = $this->session->userdata('session_name');
        if ($admin_name == '') {
            //check session variable set or not, otherwise logout
            redirect('login');
        }
        $data['projects'] = Assignemployee::getAllProjects();
        $data['employees'] = Assignemployee::getAllEmployee();

        $this->load->view('includes/header');
        $this->load->view('pages/assignEmployee', $data);
        $this->load->view('includes/footer');
    }

    public function getAllEmployee() {
        $user_id = $this->session->userdata('user_id');

        $path = base_url();
        $url = $path . 'api/admin/Employee_api/getAllEmployee?user_id=' . $user_id;
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

    public function getAllProjects() {
        $user_id = $this->session->userdata('user_id');

        $path = base_url();
        $url = $path . 'api/admin/Assignemployee_api/getAllProjects?user_id=' . $user_id;
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

    // fin for get employee details
    public function getEmployeeDetails(){
        extract($_POST);
        
        $path = base_url();
        $url = $path . 'api/admin/Assignemployee_api/getEmployeeDetails?user_id=' . $emp_user_id;
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
        print_r($response);
        
        
    }


//    public function assignEmployeeToProject(){
//        
//    }
    
}
