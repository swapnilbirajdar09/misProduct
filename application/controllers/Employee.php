<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

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
        //check session variable set or not, otherwise logout
            redirect('login');
        }
        $data['company_name'] = Employee::getCompanyName();
        //$data['users'] = Employee::getAllEmployee();
        $data['roles'] = Employee::getAllRoles();

        $this->load->view('includes/header');
        $this->load->view('pages/createEmployee', $data);
        $this->load->view('includes/footer');
    }

    // fun for get all roles
    public function getAllRoles() {
        $path = base_url();
        $url = $path . 'api/admin/Admin_api/getAllRoles';
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
        //print_r($output);die();
        return $response;
    }

    // fun for get company 
    public function getCompanyName() {
        $company_id = $this->session->userdata('company_id');

        $path = base_url();
        $url = $path . 'api/admin/Employee_api/getCompanyName?company_id=' . $company_id;
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
        //print_r($output);die();
        return $response;
    }

    // fun for get all employe
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
        echo $output;
        //return $output;
    }

    // fun for create employee
    public function create_employee() {
        extract($_POST);
        $data = $_POST;
        $company_id = $this->session->userdata('company_id');
        $data['company_id'] = $company_id;
        $path = base_url();
        $url = $path . 'api/admin/Employee_api/create_employee';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
//        echo $response_json;
//       die();
        if ($response == '200') {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success-</strong> Employee Created successfully.</div>'
            );
            echo json_encode($response);
            die();
        } elseif ($response == '700') {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Email Id Is Already Exist.</div>'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error-</strong> Employee Not Created Successfully.</div>'
            );
            echo json_encode($response);
            die();
        }
    }

// fun for delete user
    public function deleteUser() {
        extract($_GET);
        $path = base_url();
        $url = $path . 'api/admin/Employee_api/deleteUser?user_id=' . $user_id;
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
        //print_r($output);die();
        if ($response['status'] == 'success') {
            $response = array(
                'status' => 'success',
                'message' => '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> Employee Removed successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			location.reload();
			}, 1000);
			</script>'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Failure!</strong> Employee Not Removed Successfully.
			</div>
			<script>
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove(); 
			});
			}, 5000);
			</script>'
            );
        }
        echo json_encode($response);
    }

}
