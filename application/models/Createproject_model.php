<?php

class Createproject_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
// fun for create project 
    public function create_project($data) {
        extract($data); 
        //print_r($data);die();
        $result = array(
            'company_id' => $company_id,
            'project_name' => addslashes($project_title),
            'project_description' => addslashes($project_description),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'project_cost' => $project_cost,
            'profit_margin' => $project_profit_margin,
            'created_date' => date('Y-m-d'),
            'status' => '1'            
        );
        //print_r($result);die();
        $this->db->insert('project_tab', $result);
        if ($this->db->affected_rows() > 0) {
            return 200;
        } else {
            return 500;
        }
    }

}
