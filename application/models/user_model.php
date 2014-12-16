<?php

class User_model extends CI_Model {

    /**
     * Constructor
     * 
     * Automatically load libraries needed in this controler
     *
     * @access public
     * @return void
     */
    function __construct() {
        parent::__construct();
    }

    function do_login($data) {
        $this->db->select('*');
        $query = $this->db->get_where('admin', array('username' => $data['username'], 'password' => $data['password']));
        return $query->row_array();
    }

    function check_email_existing($user_email) {
        $query = $this->db->get_where('admin', array('email' => $user_email));
        return $query->row_array();
    }

    function get_our_team($data = NULL) {
        if ($data != NULL) {
            $this->db->limit($data['i_end_index'], $data['i_start_index']);
            !empty($data['i_search']) ? $this->db->like('full_name', $data['i_search']) : '';
            !empty($data['i_search']) ? $this->db->or_like('publish_date', $data['i_search']) : '';
        }
        $query = $this->db->get('our_team');

        return $query->result_array();
    }

    function get_team_count($data) {
        $matches = array('full_name' => $data['i_search'], 'publish_date' => $data['i_search']);
        !empty($data['i_search']) ? $this->db->like($matches) : '';
        return $this->db->count_all_results('our_team');
    }

    function get_user($user_id) {
        $query = $this->db->get_where('our_team', array('user_id' => $user_id));
        return $query->row_array();
    }

    function do_add_user($data) {
        $this->db->set($data);
        $query = $this->db->insert('our_team');

        return $query;
    }

    function delete_user($news_id) {
        $this->db->where('user_id', $news_id);
        $query = $this->db->delete('our_team');
        return $query;
    }

    function update_user($user_id, $data) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->update('our_team', $data);
        return $query;
    }

//    function store_session($data) {
//        $this->db->insert('ci_sessions', $data);
//    }
}

/* End of file user_model.php */