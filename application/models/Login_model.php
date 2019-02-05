
<?php

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($data) {
        extract($data);
        //print_r($data);
        //die();

        //---get admin details
        // $login_passwordNew = base64_encode($login_password);
        $sql = "SELECT * FROM user_tab where (email= '$login_username' OR username = '$login_username') "
                . "AND password = '$login_password'";
        //echo $sql;        die();
        $result = $this->db->query($sql);
        $username = '';
        $password = '';
        $company_id = '';
        $project_id = '';
        $project_name = '';
        // $role_name = '';
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 500
            );
            return $response;
            die();
        } else {
            foreach ($result->result_array() as $key) {
                $user_id = $key['user_id'];
                $username = $key['username'];
                $role = $key['role'];
                $email = $key['email'];
            }
//            $sqlSelect = "SELECT * FROM project_tab WHERE company_id = '$company_id' LIMIT 1";
//            $resultsel = $this->db->query($sqlSelect);
//            foreach ($resultsel->result_array() as $val) {
//                $project_id = $val['project_id'];
//                $project_name = $val['project_name'];
//            }
            $response = array(
                'status' => 200,
                'user_id' => $user_id,
                'usersession_name' => $username,
                'role' => $role,
                'email' => $email
            );
        }
        return $response;
    }

}
