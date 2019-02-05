<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

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
        $data['profit'] = Settings::getProfitMargin();
        $data['fcost'] = Settings::getFixedCost();
        $this->load->view('includes/header');
        $this->load->view('pages/setting', $data);
        $this->load->view('includes/footer');
    }

    public function getProfitMargin() {
        $path = base_url();
        $url = $path . 'api/admin/Setting_api/getProfitMargin';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

    public function getFixedCost() {
        $path = base_url();
        $url = $path . 'api/admin/Setting_api/getFixedCost';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

    public function updateFixedCost() {
        extract($_POST);
        $data = $_POST;
        $path = base_url();
        $url = $path . 'api/admin/Setting_api/updateFixedCost';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response_json);
        die();
        if ($response['status'] != 200) {
            echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i> ' . $response['status_message'] . '</h4>';
        } else {
            echo '<h4 class="w3-text-green w3-margin"><i class="fa fa-check"></i> ' . $response['status_message'] . '</h4>
    <script>
    window.setTimeout(function() {
     location.reload();
   }, 1000);
   </script>';
        }
    }

    public function updateProfitMargin() {
        extract($_POST);
        $data = $_POST;
        $path = base_url();
        $url = $path . 'api/admin/Setting_api/updateProfitMargin';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response_json);
        die();

        if ($response['status'] != 200) {
            echo '<h4 class="w3-text-red w3-margin"><i class="fa fa-warning"></i> ' . $response['status_message'] . '</h4>';
        } else {
            echo '<h4 class="w3-text-green w3-margin"><i class="fa fa-check"></i> ' . $response['status_message'] . '</h4>
    <script>
    window.setTimeout(function() {
     location.reload();
   }, 1000);
   </script>';
        }
    }

}
