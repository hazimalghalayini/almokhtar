<?php

class Pages_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function page_content($page_id) {
        $query = $this->db->get_where('pages', array('page_id' => $page_id));
        return $query->row_array();
    }

    function update_page($page_id, $data) {
        $this->db->where('page_id', $page_id);
        $query = $this->db->update('pages', $data);
        return $query;
    }

}
