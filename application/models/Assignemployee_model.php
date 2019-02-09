<?php

class Assignemployee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

// fun for get all Projects
    public function getAllProjects($company_id, $role_id) {
        if ($role_id == 2) {
            $query = "SELECT * FROM project_tab WHERE company_id='$company_id'";
        } else {
            $query = "SELECT * FROM project_tab";
        }
        //echo $query;die();
        $result = $this->db->query($query);
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

    public function getEmployeeDetails($user_id) {
        $query = "SELECT * FROM user_tab as u, profile_tab as p WHERE u.user_id = p.user_id AND u.user_id = '$user_id'";
        $result = $this->db->query($query);
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

    public function assignEmployeeToProject($data) {
        extract($data);
        $update_data = array(
            'assigned_user' => $emp_assign           
        );
        // print_r($insert_data);die();
        $this->db->where('project_id', $project_id);
        $this->db->update('project_tab', $update_data);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 500;
        }
    }

}
