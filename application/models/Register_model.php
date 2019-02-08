<?php

class Register_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // --------------function to register user
    public function register_company($data) {
//        print_r($data);
//        die();
        extract($data);

        $Arr = explode('/', $role);
        $role_id = $Arr[0];
        $role_name = $Arr[1];
//echo $role_id.'//'.$role_name;die();
        $pac = $package;
        $package_select = explode("|", $pac);
        //print_r($package_select);die();
        $reg_date = date('Y-m-d');
        $expiry_date = '';
        switch ($package_select[1]) {
            case 'Monthly':
                $expiry_date = date('Y-m-d', strtotime('+' . $package_select[2] . ' months'));
                break;
            case 'Yearly':
                $expiry_date = date('Y-m-d', strtotime('+' . $package_select[2] . ' years'));
                break;
            default:
                # code...
                break;
        }

        $email_exist = Register_model::checkEmailExist($eMail,$username);
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

            // insert data to the company tab
            $insert = array(
                'name' => $company_name,
                'added_date' => date('Y-m-d'),
                'status' => '1'
            );
            $this->db->insert('company_tab', $insert);
            $company_table_id = $this->db->insert_id();

            // insert data to the user details tab

            $profile_tab = array(
                'user_id' => $user_table_id,
                'company_id' => $company_table_id,
                'expiry_date' => $expiry_date,
                'package_purchased' => $package_select[0]
            );
            
            $this->db->insert('userdetails_tab', $profile_tab);
            
            if ($this->db->affected_rows() > 0) {
                return 200;
            } else {
                return 500;
            }
        } else {
            return 700;
        }
    }

    // check email id exist or not
    public function checkEmailExist($email_id,$username) {
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

}
