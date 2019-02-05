<?php

class Employee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

// fun for get company name
    public function getCompanyName($user_id) {
        $query = "SELECT company_name FROM user_tab WHERE user_id='$user_id'";
        //echo $query;        die();
        $result = $this->db->query($query);
        //$response = '';
        if ($result->num_rows() <= 0) {
            $response = 500;
        } else {
            foreach ($result->result_array() as $row) {
                //print_r($row);die();
                $response = $row['company_name'];
            }
        }
        return $response;
    }

// fun for get all employee
    public function getAllEmployee($user_id) {
        $query = "SELECT company_name FROM user_tab WHERE user_id='$user_id'";
        $resultSel = $this->db->query($query);
        $company_name = '';
        if ($resultSel->num_rows() <= 0) {
            $response = 500;
        } else {
            foreach ($resultSel->result_array() as $row) {
                $company_name = $row['company_name'];
            }
        }

        $sql = "SELECT * FROM user_tab WHERE company_name = '$company_name' AND role = 'Employee'";

        $result = $this->db->query($sql);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500,
                'status_message' => 'No data found.');
        } else {
            $response = array(
                'status' => 200,
                'status_message' => $result->result_array());
        }
        return $response;
    }

// fun for delete employee details
    public function deleteUser($user_id) {
        $sql = "DELETE FROM user_tab WHERE user_id = '$user_id'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 'success',
                'status_message' => 'Role Deleted Successfully.');
        } else {
            $response = array(
                'status' => 'error',
                'status_message' => 'Role Not Deleted Successfully.');
        }
        return $response;
    }

    // --------------function to register user
    public function create_employee($data) {
        extract($data);
        $email_exist = Employee_model::checkEmailExist($eMail);
        if ($email_exist == '0') {
            $result = array(
                'gender' => $gender,
                'email' => $eMail,
                'username' => $username,
                'password' => base64_encode($password),
                'registered_date' => date('Y-m-d'),
                'status' => '1',
                'company_name' => addslashes($company_name),
                'role' => 'Employee',
                'phone_no' => $ph_number,
                'salary' => $salary
            );

            $this->db->insert('user_tab', $result);

            $insert_id = $this->db->insert_id();
            //$profile_key = substr(base64_encode($insert_id), 0, 4);

            $profile_tab = array(
                'user_id' => $insert_id
            );
            $this->db->insert('profile_tab', $profile_tab);
            $sendEmail = Employee_model::send_Email($eMail, $password, $company_name);
            //print_r($sendEmail);die();
            if ($sendEmail['status'] == 200) {
                if ($this->db->affected_rows() > 0) {
                    return 200;
                } else {
                    return 500;
                }
            } else {
                return 500;
            }
        } else {
            return 700;
        }
    }

    // check email id exist or not
    public function checkEmailExist($email_id) {
        $query = null;
        // ------------ check email exist 
        $query = $this->db->get_where('user_tab', array(//making selection
            'email' => $email_id
        ));

        if ($query->num_rows() <= 0) {
            return 0;
        } else {
            return 1;
        }
    }

    //-- fun for send mail
    // -----------------------PASSWORD EMAIL MODEL----------------------//
    public function send_Email($email_id, $password, $company_name) {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mx1.hostinger.in',
            'smtp_port' => '587',
            'smtp_user' => 'customercare@bizmo-tech.com', // change it to yours
            'smtp_pass' => 'Descartes@1990', // change it to yours
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        //$config['smtp_crypto'] = 'tls';

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('customercare@bizmo-tech.com', "Admin Team");
        $this->email->to($email_id);
        $this->email->subject("Password Request - MIS Product");
        $this->email->message('<html>
        <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
        <div class="container col-lg-8" style="box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;margin:10px; font-family:Candara;">
        <h2 style="color:blue; font-size:25px">Credentials for MIS Product!</h2>
        <h3 style="font-size:15px;">Hello User,<br></h3>
        <h3 style="font-size:15px;">The Following are the username and password for <u>MIS Product</u>.</h3>
        <h3 style="font-size:15px;">Username: ' . $email_id . '</h3>
        <h3 style="font-size:15px;">Password: ' . $password . '</h3>
        <h3 style="font-size:15px;">Role: Employee</h3>
        <h3 style="font-size:15px;">Company Name: ' . $company_name . '</h3>
        <br><br>
        <h5>Note: If you did not make this request, then kindly ignore this message.</h5>
        <div class="col-lg-12">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
        </div>
        </body></html>');
//print_r($this->email->print_debugger());die();
        if ($this->email->send()) {
            $response = array(
                'status' => 200, //---------email sending succesfully 
                'status_message' => 'Email Sent Successfully.',
            );
        } else {
//            print_r($this->email->print_debugger());
//            die();
            $response = array(
                'status' => 500, //---------email send failed
                'status_message' => 'Email Sending Failed.'
            );
        }
        return $response;
    }

}
