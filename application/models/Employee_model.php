<?php

class Employee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

// fun for get company name
    public function getCompanyName($company_id) {
        $query = "SELECT name FROM company_tab WHERE company_id='$company_id'";
        //echo $query;        die();
        $result = $this->db->query($query);
        //$response = '';
        if ($result->num_rows() <= 0) {
            $response = 500;
        } else {
            foreach ($result->result_array() as $row) {
                //print_r($row);die();
                $response = $row['name'];
            }
        }
        return $response;
    }

// fun for get all employee
    public function getAllEmployee($company_id) {
        $sql = "SELECT * FROM user_tab as us JOIN role_tab as ro "
                . "JOIN userdetails_tab as ut "
                . "JOIN company_tab as co "
                . "ON (us.user_id = ut.user_id) AND (ut.company_id = co.company_id) "
                . "AND (ro.role_id = us.role_id) "
                . "WHERE co.company_id = '$company_id' AND ro.role_name = 'Employee'";
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

// fun for get all employee details
    public function getAllEmployeeInfo($company_id) {
        $sql = "SELECT * FROM user_tab as us JOIN role_tab as ro "
                . "JOIN userdetails_tab as ut "
                . "JOIN company_tab as co "
                . "ON (us.user_id = ut.user_id) AND (ut.company_id = co.company_id) "
                . "AND (ro.role_id = us.role_id) "
                . "WHERE co.company_id = '$company_id' AND ro.role_name = 'Employee'";
        $result = $this->db->query($sql);
        $emp_skills = array();
        $skill = '';
        $skills = '';
        $user_id = '';
        $email = '';
        $role = '';
        $phone_no = '';
        $salary = '';
        $username = '';
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500,
                'status_message' => 'No data found.');
        } else {

            foreach ($result->result_array() as $row) {
                $skills = json_decode($row['skills'], true);
                foreach ($skills as $sk) {
                    $sqlSelect = "SELECT Skill_name FROM skill_tab WHERE skill_id = '$sk'";
                    $result = $this->db->query($sqlSelect);
                    $emp_skills[] = $result->result_array();
                }
                $skill = $emp_skills;
                $user_id = $row['user_id'];
                $role = $row['role_name'];
                $email = $row['user_email'];
                $phone_no = $row['phone_no'];
                $salary = $row['salary'];
                $username = $row['user_name'];
            }

            $response = array(
                'status' => 200,
                'skill' => $skill,
                '$user_id' => $user_id,
                'role' => $role,
                'email' => $email,
                'phone_no' => $phone_no,
                'salary' => $salary,
                'username' => $username);
        }
        return $response;
    }

// fun for delete employee details
    public function deleteUser($user_id) {
        $sql = "DELETE FROM user_tab WHERE user_id = '$user_id'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 200,
                'status_message' => 'Role Deleted Successfully.');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Role Not Deleted Successfully.');
        }
        return $response;
    }

    // --------------function to register user
    public function create_employee($data) {
        extract($data);

        $Arr = explode('/', $role);
        $role_id = $Arr[0];
        $role_name = $Arr[1];

        $query = "SELECT name FROM company_tab WHERE company_id='$company_id'";
        $resultSel = $this->db->query($query);
        $company_name = '';
        foreach ($resultSel->result_array() as $row) {
            $company_name = $row['name'];
        }

        $email_exist = Employee_model::checkEmailExist($eMail, $username);
        if ($email_exist == '0') {

            $result = array(
                'role_id' => $role_id,
                'user_email' => $eMail,
                'user_name' => $username,
                'password' => base64_encode($password),
                'created_date' => date('Y-m-d'),
                'status' => '1',
                'role' => $role_name,
            );
            // insert data to the user tab
            $this->db->insert('user_tab', $result);

            $user_table_id = $this->db->insert_id();

            //$profile_key = substr(base64_encode($insert_id), 0, 4);
            $costPerDay = $salary / 30;
            $profile_tab = array(
                'user_id' => $user_table_id,
                'company_id' => $company_id,
                'salary' => $salary,
                'cost_per_day' => $costPerDay,
                'skills' => $skills
            );
            $this->db->insert('userdetails_tab', $profile_tab);
            $sendEmail = Employee_model::send_Email($eMail, $password, $company_name, $username);
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
    public function checkEmailExist($email_id, $username) {
        $query = null;
        // ------------ check email exist 
        $query = $this->db->get_where('user_tab', array(//making selection
            'user_email' => $email_id,
            'user_name' => $username
        ));

        if ($query->num_rows() <= 0) {
            return 0;
        } else {
            return 1;
        }
    }

    //-- fun for send mail
    // -----------------------PASSWORD EMAIL MODEL----------------------//
    public function send_Email($email_id, $password, $company_name, $username) {
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
        $this->email->subject("Password For - MIS Product");
        $this->email->message('<html>
        <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
        <div class="container col-lg-8" style="box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;margin:10px; font-family:Candara;">
        <h2 style="color:blue; font-size:25px">Credentials for MIS Product!</h2>
        <h3 style="font-size:15px;">Hello User,<br></h3>
        <h3 style="font-size:15px;">The Following are the username and password for <u>MIS Product</u>.</h3>
        <h3 style="font-size:15px;">Username: ' . $email_id . ' OR ' . $username . '</h3>
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
