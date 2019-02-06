<?php

class Register_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // --------------function to register user
    public function register_user($data) {
//        print_r($data);
//        die();
        extract($data);
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

        $email_exist = Register_model::checkEmailExist($eMail);
        if ($email_exist == '0') {

            $result = array(
                'gender' => $gender,
                'email' => $eMail,
                'username' => $username,
                'password' => base64_encode($password),
                'registered_date' => date('Y-m-d'),
                'expiry_date' => $expiry_date,
                'package_purchased' => $package_select[0],
                'status' => '1',
                'company_name' => addslashes($company_name),
                'role' => 'Admin',
                'phone_no' => $ph_number
            );

            $this->db->insert('user_tab', $result);

            $insert_id = $this->db->insert_id();
            $profile_key = substr(base64_encode($insert_id), 0, 4);

            $profile_tab = array(
                'user_id' => $insert_id
//                'user_profile_key' => 'BPARI#' . date('Ymd') . '0' . $insert_id . $profile_key
            );
            $this->db->insert('profile_tab', $profile_tab);
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


}