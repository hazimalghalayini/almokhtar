<?php

class News_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getCountryId($countryCode) {
        $this->db->select('id');
        $this->db->limit(1);
        $this->db->where('country_code', $countryCode);
        $query = $this->db->get('countries');
        return $query->row();
    }

    function add_slide_news($news_description) {
        $this->db->set('news_description', $news_description);
        $this->db->set('added_date', date('Y-m-d H:i:s'));
        $query = $this->db->insert('recent_news');

        return $query;
    }

    function get_all_recent_news($data) {
        $this->db->limit($data['i_end_index'], $data['i_start_index']);
        !empty($data['i_search']) ? $this->db->like('news_description', $data['i_search']) : '';
        $this->db->order_by('added_date', 'DESC');
        $query = $this->db->get('recent_news');

        return $query->result_array();
    }

    function news_most_viewed($orderBy = NULL, $limit = 10) {
        !empty($orderBy) ? $this->db->order_by($orderBy, 'desc') : $this->db->order_by('publish_date', 'desc');
        $this->db->limit($limit);
        $this->db->select('news_id, news_title, publish_date,views');
        $query = $this->db->get('news');
        return $query->result_array();
    }

    function get_recent_news_count($data = NULL) {
        !empty($data['i_search']) ? $this->db->like('news_description', $data['i_search']) : '';
        return $this->db->count_all_results('recent_news');
    }

    function delete_slide_news($news_id) {
        $this->db->where('news_id', $news_id);
        $query = $this->db->delete('recent_news');
        return $query;
    }

    function get_slide_news($news_id) {
        $this->db->select('news_description');
        $this->db->where('news_id', $news_id);
        $query = $this->db->get('recent_news');

        return $query->row_array();
    }

    function update_slide_news($news_id, $data) {
        $this->db->where('news_id', $news_id);
        $query = $this->db->update('recent_news', $data);
        return $query;
    }

    function do_add_news($data) {
        $query = $this->db->insert('news', $data);
        return $query;
    }

    function get_all_news($data) {
        $this->db->select('news.*,countries.country_name,news_categories.category_name');
        $this->db->from('news');
        $this->db->join('news_categories', 'news.category_id = news_categories.category_id');
        $this->db->join('countries', 'news.country_id = countries.id');
        !empty($data['category_id']) ? $this->db->where('news.category_id', $data['category_id']) : '';
        !empty($data['i_search']) ? $this->db->like('news_title', $data['i_search']) : '';
        $this->db->limit($data['i_end_index'], $data['i_start_index']);
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    function get_news_count($data = NULL) {
        !empty($data['category_id']) ? $this->db->where('news.category_id', $data['category_id']) : '';
        !empty($data['i_search']) ? $this->db->like('news_title', $data['i_search']) : '';
        return $this->db->count_all_results('news');
    }

    function get_news_info($news_id) {
        $this->db->select('news.* , count(comments.comment_id) as comments_count');
        $this->db->join('comments', 'comments.news_id=news.news_id', 'left');
        $query = $this->db->get_where('news', array('news.news_id' => $news_id));
        return $query->row_array();
    }

    function update_news($news_id, $data) {
        $this->db->where('news_id', $news_id);
        $query = $this->db->update('news', $data);
        return $query;
    }

    function delete_news($news_id) {
        $this->db->where('news_id', $news_id);
        $query = $this->db->delete('news');
        return $query;
    }

    function put_news_in_slider($news_id, $status) {
        $this->db->where('news_id', $news_id);
        if ($status == 1) {
            $query = $this->db->update('news', array('main_slider' => 0, 'slider_date' => date('Y-m-d H:i:s')));
        } else {
            $query = $this->db->update('news', array('main_slider' => 1, 'slider_date' => date('Y-m-d H:i:s')));
        }
        return $query;
    }

    function get_main_slider($data) {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->join('news_categories', 'news.category_id = news_categories.category_id');
        if ($data['category_id'] == 'showed') {
            $this->db->where('main_slider', 1);
            $this->db->order_by("slider_date", "desc");
        } else if (is_int($data['category_id'])) {
            $this->db->where('news.category_id', $data['category_id']);
            $this->db->order_by("publish_date", "desc");
        } else {
            $this->db->order_by("publish_date", "desc");
        }
        !empty($data['i_search']) ? $this->db->like('news_title', $data['i_search']) : '';
        $this->db->limit($data['i_end_index'], $data['i_start_index']);

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_main_slider_count($data = NULL) {
        if ($data['category_id'] == 'showed') {
            $this->db->where('main_slider', 1);
        } else if (is_int($data['category_id'])) {
            $this->db->where('news.category_id', $data['category_id']);
        }
        !empty($data['i_search']) ? $this->db->like('news_title', $data['i_search']) : '';
        return $this->db->count_all_results('news');
    }

    function get_comments($data) {
        $this->db->select('*');
        $this->db->from('comments');
//        $this->db->join('news', 'news.news_id = comments.news_id');
        $this->db->where('news_id', $data['news_id']);
        !empty($data['i_search']) ? $this->db->like('name', $data['i_search']) : '';
        $this->db->limit($data['i_end_index'], $data['i_start_index']);
        $this->db->order_by('publishDate', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    function get_comments_count($data = NULL) {
        !empty($data['news_id']) ? $this->db->where('news_id', $data['news_id']) : '';
        !empty($data['i_search']) ? $this->db->like('name', $data['i_search']) : '';
        !empty($data['i_search']) ? $this->db->like('comment', $data['i_search']) : '';
        return $this->db->count_all_results('comments');
    }

    function get_recent_comments($data = NULL) {
        $this->db->select('comments.*,news.news_title');
        $this->db->from('comments');
        $this->db->join('news', 'news.news_id = comments.news_id');
        !empty($data['i_search']) ? $this->db->like('name', $data['i_search']) : '';
        $this->db->limit($data['i_end_index'], $data['i_start_index']);
        $this->db->order_by('status ASC, publishDate DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    function latest_comments($count = 10) {
        $this->db->select('comments.*,news.news_title');
        $this->db->from('comments');
        $this->db->join('news', 'news.news_id = comments.news_id');
        $this->db->where(array('status' => '0'));
        $this->db->limit($count);
        $query = $this->db->get();

        return $query->result_array();
    }

    function get_recent_comments_count($data = NULL) {
        !empty($data['i_search']) ? $this->db->like('name', $data['i_search']) : '';
        !empty($data['i_search']) ? $this->db->like('comment', $data['i_search']) : '';
        return $this->db->count_all_results('comments');
    }

    function getNotifications() {
        $this->db->where(array('status' => 0));
        $data['comments_count'] = $this->db->count_all_results('comments');
        $data['latest_comments'] = $this->latest_comments(6);
        $data['latest_messages'] = $this->get_latest_messages(6);
        return $data;
    }

    function change_comment_status($data) {
        $this->db->where('comment_id', $data['comment_id']);
        $query = $this->db->update('comments', array('status' => ($data['current_status'] == 0) ? 1 : 0));
        return $query;
    }

    function last_3_news($limit = 5) {
        $this->db->limit($limit);
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get('news');
        return $query->result();
    }

    function last_4_news($countryId,$limit = 5,$orderBy = NULL) {
        !empty($orderBy) ? $this->db->order_by("$orderBy", 'desc') : '';
        $this->db->select('news.*,COUNT(comment_id) as comments_count');
        $this->db->join('comments', 'news.news_id = comments.news_id', 'left');
        $this->db->group_by('news.news_id');
        $this->db->order_by('publish_date', 'DESC');
        $this->db->limit($limit);
        $this->db->where('country_id', $countryId);
        $query = $this->db->get('news');
        return $query->result();
    }

    function recent_main_category_news($category_id) {
        $this->db->select('news.*,COUNT(comment_id) as comments_count');
        $this->db->from('news');
        $this->db->join('comments', 'news.news_id = comments.news_id', 'left');
        $this->db->where('news.category_id', $category_id);
        $this->db->group_by('news.news_id');

        $this->db->order_by('publish_date', 'DESC');

        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    function recent_small_category_news($category_id) {
        $this->db->select('news.*,COUNT(comment_id) as comments_count');
        $this->db->from('news');
        $this->db->join('comments', 'news.news_id = comments.news_id', 'left');
        $this->db->where('news.category_id', $category_id);
        $this->db->group_by('news.news_id');
        $this->db->order_by('publish_date', 'DESC');
        $this->db->limit(2);
        $query = $this->db->get();
        return $query->result();
    }

    function widgetNews($countryId, $orderBy = NULL, $limit = 7) {
        $this->db->select('news.news_id,news.views, news.news_title,news.news_picture, news.publish_date,count(comment_id) as comments_count');
        $orderBy ? $this->db->order_by($orderBy, 'DESC') : $this->db->order_by('publish_date', 'DESC');
        $this->db->limit($limit);
        $this->db->join('comments', 'news.news_id = comments.news_id', 'left');
        $this->db->where('news.country_id', $countryId);
        $query = $this->db->get('news');
        return $query->result();
    }

    function getMainSliderNews($countryId) {
        $this->db->select('news.news_id, news.news_title, news.news_description,news.publish_date, news.news_picture,news_categories.category_name as categoryName,count(comment_id) as comments_count');
        $this->db->join('news_categories', 'news.category_id = news_categories.category_id', 'left');
        $this->db->join('comments', 'news.news_id = comments.news_id', 'left');
        $this->db->group_by('news.news_id');
        $this->db->where('main_slider', 1);
        $this->db->where('country_id', $countryId);
        $this->db->limit(16);
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get('news');
//
//        echo '<pre>';
//        print_r($query->result());
//        echo '</pre>';

        return $query->result();
    }

    function getCategoryNews($category_id, $limit, $start) {
        $this->db->select('news.*, COUNT(comment_id) as comments_count');
        $this->db->limit($limit, $start);
        $this->db->join('comments', 'news.news_id = comments.news_id', 'left');
        !empty($category_id) ? $this->db->where('category_id', $category_id) : '';
        $this->db->group_by('news.news_id');
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get('news');
        return $query->result();
    }

    function newsCategoryCount($category_id) {
        $this->db->where('category_id', $category_id);
        $query = $this->db->count_all_results('news');
        return $query;
    }

    function postView($postId) {
        $this->db->select('views');
        $query1 = $this->db->get('news');
        $views = $query1->row_array();
        $this->db->where('news_id', $postId);
        $query = $this->db->update('news', array('views' => $views['views'] + 1));
        return $query;
    }

    function viewNewsBy($orderBy, $categoryId) {
        $this->db->limit(10);
        $this->db->order_by($orderBy, 'DESC');
        !empty($categoryId) ? $this->db->where('category_id', $categoryId) : '';
        //$this->db->where('category_id', $categoryId);
        $query = $this->db->get('news');
        return $query->result();
    }

    function getRecentNewsSlider() {
        $this->db->limit('10');
        $this->db->select('news_id, news_description');
        $this->db->order_by('added_date', 'DESC');
        $query = $this->db->get('recent_news');

        return $query->result();
    }

    function insertComment($data) {
        $query = $this->db->insert('comments', $data);
        return $query;
    }

    function insertContactMsg($data) {
        $query = $this->db->insert('contactMsg', $data);
        return $query;
    }

    function insertSubscribeEmail($data) {
        $query = $this->db->insert('newsletter', $data);
        return $query;
    }

    function getPostComment($postId = NULL, $limit = 10) {
        !empty($postId) ? $this->db->where('news_id', $postId) : '';
        $this->db->limit($limit);
        $this->db->select('name, comment, publishDate,news_id');
        $this->db->order_by('publishDate');
        $query = $this->db->get('comments', array('status' => 1));

        return $query->result();
    }

    function commentCount($postId) {
        $this->db->where('news_id', $postId);
        $query = $this->db->count_all_results('comments');
        return $query;
    }

    function most_commented() {
        $this->db->select('news.*,COUNT(comment_id) as rows');
        $this->db->from('news');
        $this->db->join('comments', 'news.news_id = comments.news_id');
        $this->db->group_by('comments.news_id');
        $this->db->order_by('rows', 'DESC');
        $this->db->limit('10');
        $query = $this->db->get();
        return $query->result();
    }

    function search($text, $limit = 10, $start = 0) {
        $this->db->select('news.*');
        $this->db->limit($limit, $start);
        $this->db->like('news_title', $text);
        $this->db->or_like('news_description', $text);
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get('news');
        return $query->result();
    }

    function search_count($text) {
        $this->db->like('news_title', $text);
        $this->db->or_like('news_description', $text);
        return $this->db->count_all_results('news');
    }

    function get_messages_count() {
        return $this->db->count_all_results('contactmsg');
    }

    function get_latest_messages() {
        $this->db->from('contactmsg');
        $this->db->limit(6);
        $query = $this->db->get();

        return $query->result_array();
    }

    function get_countries_names_codes() {
        $this->db->select('id, country_name');
        $query = $this->db->get('countries');

        return $query->result_array();
    }

}
