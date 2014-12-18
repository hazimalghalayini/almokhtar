<?php

class Categories_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function add_category($category_name) {
        $this->db->set('category_name', $category_name);
        $this->db->set('added_date', date('Y-m-d H:i:s'));
        $query = $this->db->insert('news_categories');

        return $query;
    }

    function get_all_categories($data) {
        $this->db->limit($data['i_end_index'], $data['i_start_index']);
        $this->db->like('category_name', $data['i_search']);
        $this->db->or_like('added_date', $data['i_search']);
        $query = $this->db->get('news_categories');

        return $query->result_array();
    }

    function get_categories_names_ids($limit = 6) {
        $this->db->select('category_id, category_name');
        $this->db->limit($limit);
        $query = $this->db->get('news_categories');

        return $query->result_array();
    }

    function get_categories_count($data) {
        $matches = array('category_name' => $data['i_search'], 'added_date' => $data['i_search']);
        !empty($data['i_search']) ? $this->db->like($matches) : '';
        return $this->db->count_all_results('news_categories');
    }

    function delete_category($category_id) {
        $this->db->where('category_id', $category_id);
        $query = $this->db->delete('news_categories');
        return $query;
    }

    function get_category_info($category_id) {
        $this->db->select('category_name');
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('news_categories');

        return $query->result();
    }

    function update_category($category_id, $data) {
        $this->db->where('category_id', $category_id);
        $query = $this->db->update('news_categories', $data);
        return $query;
    }

}
