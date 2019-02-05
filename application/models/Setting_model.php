<?php

class Setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getProfitMargin() {
        $query = "SELECT setting_value FROM setting_tab WHERE setting_key='Profit Margin'";
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

    public function getFixedCost() {
        $query = "SELECT setting_value FROM setting_tab WHERE setting_key='Fixed Cost'";
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

    public function updateFixedCost($data) {
        extract($data);
        $sql = "UPDATE setting_tab SET setting_value='$fixed_cost' WHERE setting_key='Fixed Cost'";
//        echo $sql;
//        die();
        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200,
                'status_message' => 'Updated Successfully..!');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Updation Failed...!');
        }
        return $response;
    }

    public function updateProfitMargin() {
        extract($data);
        $sql = "UPDATE setting_tab SET setting_value='$profit_margin' WHERE setting_key='Profit Margin'";
//        echo $sql;
//        die();

        if ($this->db->query($sql)) {
            $response = array(
                'status' => 200,
                'status_message' => 'Updated Successfully..!');
        } else {
            $response = array(
                'status' => 500,
                'status_message' => 'Updation Failed...!');
        }
        return $response;
    }

}
