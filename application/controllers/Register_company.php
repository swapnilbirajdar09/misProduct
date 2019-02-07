<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register_company extends CI_Controller {

    // Login controller
    public function __construct() {
        parent::__construct();

        // load common model
        //$this->load->model('Login_model');
    }

    // main index function
    public function index() {
        $data['package'] = Register_company::getAllPackages();
        $data['roles'] = Register_company::getAllRoles();
        $this->load->view('includes/header');
        $this->load->view('pages/registerCompany',$data);
        $this->load->view('includes/footer');
    }

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
    
    public function getAllPackages() {
        $path = base_url();
        $url = $path . 'api/admin/Admin_api/getAllPackages';
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

    public function register_user() {
        extract($_POST);
        $data = $_POST;
        //print_r($data);die();
        $path = base_url();
        $url = $path . 'api/admin/Registeruser_api/register_user';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        echo $response_json;
        die();

        if ($response == '200') {
            echo '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> user Details Saved SuccessFully.
        </div>
        <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
                });
                window.location.reload();
                }, 1000);                
                </script>';
        } elseif ($response == '700') {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning!</strong> Email Id Already Exists.
                </div>
                <script>
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                        });
                        }, 5000);
                        </script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning!</strong> user Details Not Saved SuccessFully.
                </div>
                 <script>
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                        });
                        }, 5000);
                        </script>';
        }
    }

}

?>