
<?php

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($data) {
        extract($data);
        //print_r($data);
        //die();
        $sql = "SELECT * FROM user_tab as us JOIN role_tab as ro "
                . "JOIN userdetails_tab as ut "
                . "JOIN company_tab as co "
                . "ON (us.user_id = ut.user_id) AND (ut.company_id = co.company_id) "
                . "AND (ro.role_id = us.role_id) "
                . "WHERE (us.user_email= '$login_username' OR us.user_name = '$login_username') "
                . "AND us.password = '$login_password'";

        $result = $this->db->query($sql);
        $username = '';
        $company_id = '';
        $role = '';
        $email = '';
        $user_id = '';
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500
            );
            return $response;
            die();
        } else {
            foreach ($result->result_array() as $key) {
                $user_id = $key['user_id'];
                $username = $key['user_name'];
                $role = $key['role_id'] . '/' . $key['role_name'];
                $email = $key['user_email'];
                $company_id = $key['company_id'];
            }

            $response = array(
                'status' => 200,
                'user_id' => $user_id,
                'usersession_name' => $username,
                'role' => $role,
                'email' => $email,
                'company_id' => $company_id
            );
        }
        return $response;
    }

}
