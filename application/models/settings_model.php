<?php

class Settings_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function update_settings($data) {
        $query = $this->db->update('settings', $data);
        return $query;
    }

    function get_settings() {
        $query = $this->db->get('settings');
        return $query->row_array();
    }

}
