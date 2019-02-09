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
        $company_id = $this->session->userdata('company_id');

        $path = base_url();
        $url = $path . 'api/admin/Employee_api/getAllEmployee?company_id=' . $company_id;
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
        $company_id = $this->session->userdata('company_id');
        $role = $this->session->userdata('role');
        $Arr = explode('/', $role);
        $role_id = $Arr[0];
        $role_name = $Arr[1];

        $path = base_url();
        $url = $path . 'api/admin/Assignemployee_api/getAllProjects?company_id=' . $company_id . '&role_id=' . $role_id;
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
    public function getEmployeeDetails() {
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

    public function assignEmployeeToProject() {
        extract($_POST);
        //$data = $_POST;
        //print_r($projects);die();    
        if ($projects == '0') {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Please Select Project First.</div>'
            );
            echo json_encode($response);
            die();
        }
         if (in_array('0', $employees)) {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Please Select At Least One Employee First.</div>'
            );
            echo json_encode($response);
            die();
        }
        $i = '';
        $assignedEmp = '';
        $emp = array();
        for ($i = 0; $i < count($employees); $i++) {
            $assignedEmp = array(
                'emp_id' => $employees[$i],
                'project_participation' => $project_participation[$i],
                'assign_date' => date('Y-m-d')
            );
            $emp[] = $assignedEmp;
        }
        $data['emp_assign'] = json_encode($emp);
        $data['project_id'] = $projects;
        $path = base_url();
        $url = $path . 'api/admin/Assignemployee_api/assignEmployeeToProject';
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
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Employee Assigned successfully.</div>'
            );
            echo json_encode($response);
            die();
        } elseif ($response == '700') {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Email Id Is Already Exist.</div>'
            );
            echo json_encode($response);
            die();
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Employee Not Assigned Successfully.</div>'
            );
            echo json_encode($response);
            die();
        }
    }

}
