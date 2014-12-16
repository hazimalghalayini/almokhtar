<?php

class Media_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function add_photo($data) {
        $query = $this->db->insert('photos', $data);

        return $query;
    }

    function get_all_photos($data) {
        $this->db->limit($data['i_end_index'], $data['i_start_index']);
        $this->db->like('photo_title', $data['i_search']);
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get('photos');

        return $query->result_array();
    }

    function get_photos_count($data = NULL) {
        $matches = array('photo_title' => $data['i_search']);
        !empty($data['i_search']) ? $this->db->like($matches) : '';
        return $this->db->count_all_results('photos');
    }

    function delete_photo($photo_id) {
        $this->db->where('photo_id', $photo_id);
        $query = $this->db->delete('photos');
        return $query;
    }

    function get_photo_info($photo_id) {
        $this->db->select('photo_id,publish_date,photo_title,photo_src');
        $this->db->where('photo_id', $photo_id);
        $query = $this->db->get('photos');

        return $query->row_array();
    }

    function update_photo($photo_id, $data) {
        $this->db->where('photo_id', $photo_id);
        $query = $this->db->update('photos', $data);
        return $query;
    }
    
    function apply_comments($photo_id, $status) {
        $this->db->where('photo_id', $photo_id);
        if ($status == 1) {
            $query = $this->db->update('photos', array('apply_comments' => 0));
        } else {
            $query = $this->db->update('photos', array('apply_comments' => 1));
        }
        return $query;
    }

    function add_v_news($data) {
        $query = $this->db->insert('visual_news', $data);
        return $query;
    }
    
    function get_all_v_news($data) {
        $this->db->select('visual_news.*,countries.country_name');
        $this->db->join('countries', 'visual_news.country_id = countries.id');
        $this->db->limit($data['i_end_index'], $data['i_start_index']);
        !empty($data['i_search']) ? $this->db->like(array('news_title' => $data['i_search'])) : '';
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get('visual_news');

        return $query->result_array();
    }
    
    function delete_v_news($news_id) {
        $this->db->where('news_id', $news_id);
        $query = $this->db->delete('visual_news');
        return $query;
    }

    function get_v_news_count($data = NULL) {
        $matches = array('news_title' => $data['i_search']);
        !empty($data['i_search']) ? $this->db->like($matches) : '';
        return $this->db->count_all_results('visual_news');
    }
    
    function get_v_news_info($news_id) {
        $this->db->select('visual_news.* , countries.country_name');
        $this->db->join('countries', 'visual_news.country_id = countries.id');
        $query = $this->db->get_where('visual_news', array('visual_news.news_id' => $news_id));
        return $query->row_array();
    }
    
    function update_v_news($news_id, $data) {
        $this->db->where('news_id', $news_id);
        $query = $this->db->update('visual_news', $data);
        return $query;
    }
    
    function add_video($data) {
        $query = $this->db->insert('videos', $data);
        return $query;
    }

    function insertComment($data) {
        $query = $this->db->insert('photos_comments', $data);
        return $query;
    }

    function get_all_videos($data) {
        $this->db->select('video_id,video_title,video_src,video_thumb,video_description,publish_date');
        $this->db->limit($data['i_end_index'], $data['i_start_index']);
        $this->db->like('video_title', $data['i_search']);
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get('videos');

        return $query->result_array();
    }

    function get_videos_count($data = NULL) {
        $matches = array('video_title' => $data['i_search']);
        !empty($data['i_search']) ? $this->db->like($matches) : '';
        return $this->db->count_all_results('videos');
    }
    
    function add_ads($data) {
        $this->db->where(array('place' =>$data['place'],'end_date >=' => $data['start_date']));
        $this->db->from('ads');
        $count = $this->db->count_all_results();
        if($count >= 1 and $data['place'] ==='t' || $count >= 2 and $data['place'] ==='m' || $count >= 2 and $data['place'] ==='l'){
            return false;
        }else{
            $this->db->insert('ads', $data);
            return true;
        }
    }
    
    function get_all_ads($data) {
        $this->db->select('*');
        $this->db->limit($data['i_end_index'], $data['i_start_index']);
//        $this->db->like('name', $data['i_search']);
        $this->db->order_by('publish_date' , 'DESC');
        $query = $this->db->get('ads');

        return $query->result_array();
    }

    function get_ads_count($data = NULL) {
        $matches = array('name' => $data['i_search']);
        !empty($data['i_search']) ? $this->db->like($matches) : '';
        return $this->db->count_all_results('ads');
    }

    function delete_video($video_id) {
        $this->db->where('video_id', $video_id);
        $query = $this->db->delete('videos');
        return $query;
    }

    function get_video_info($video_id) {
        $this->db->select('video_id,video_title,video_src,video_description');
        $this->db->where('video_id', $video_id);
        $query = $this->db->get('videos');

        return $query->row_array();
    }

    function update_video($video_id, $data) {
        $this->db->where('video_id', $video_id);
        $query = $this->db->update('videos', $data);
        return $query;
    }

    function imageSlider($type = NULL) {
        $this->db->select('photo_id,photo_src, photo_title');
        $this->db->limit(10);
        $this->db->order_by('publish_date', 'DESC');
        ($type != NULL) ? $this->db->where(array('apply_comments' =>1)) : '';
        $query = $this->db->get('photos');
        return $query->result();
    }

    function videoSlider() {
        $this->db->select('video_src, video_thumb, video_title');
        $this->db->limit(10);
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get('videos');
        return $query->result();
    }

    function firstVideo() {
        $this->db->select('video_src, video_thumb, video_title');
        $this->db->limit(1);
        $query = $this->db->get('videos');
        return $query->row_array();
    }

    function getPhotoComment($photoId = NULL, $limit = 10) {
        !empty($photoId) ? $this->db->where('photo_id', $photoId) : '';
        $this->db->limit($limit);
        $this->db->select('name, comment, publishDate,photo_id');
        $query = $this->db->get('photos_comments');

        return $query->result();
    }

    function commentCount($photoId) {
        $this->db->where('photo_id', $photoId);
        $query = $this->db->count_all_results('photos_comments');
        return $query;
    }

    function photoGallery($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get('photos');
        return $query->result();
    }
    
    function videoGallery($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('publish_date', 'DESC');
        $query = $this->db->get('videos');
        return $query->result();
    }

    function photosCount() {
        $query = $this->db->count_all_results('photos');
        return $query;
    }
    
    function videosCount() {
        $query = $this->db->count_all_results('videos');
        return $query;
    }

}
