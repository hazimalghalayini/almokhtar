<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller {

    private $_countryId;

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('news_model');
        $this->load->model('media_model');
        $this->load->model('settings_model');
        $this->load->model('pages_model');
        $this->load->model('categories_model');

        $this->_countryId = '2'; // $this->ipToCountry($_SERVER['REMOTE_ADDR']);
    }

    function ipToCountry($ip = NULL) {
        $info = file_get_contents("http://who.is/whois-ip/ip-address/$ip");
        list($a, $b) = explode('country:', $info);
        $countryCode = substr($b, 0, 2);
        $coutryInfo = $this->news_model->getCountryId($countryCode);
        return $coutryInfo->id;
    }

    public function index() {

        $data['categories'] = $this->categories_model->get_categories_names_ids();
        $data['main_slider'] = $this->news_model->getMainSliderNews($this->_countryId);
//        $data['last_3_news'] = $this->news_model->last_3_news();
//        $data['local_news_first_post'] = $this->news_model->recent_small_category_news('11');
//        $data['fmale_news_post'] = $this->news_model->recent_small_category_news('14');
//        $data['health_news_post'] = $this->news_model->recent_small_category_news('16');
//        $data['arabic_news_first_post'] = $this->news_model->recent_small_category_news('12');
//        $data['international_news_first_post'] = $this->news_model->recent_small_category_news('13');
//        $data['sport_news_first_post'] = $this->news_model->recent_small_category_news('19');
//        $data['technology_news_first_post'] = $this->news_model->recent_small_category_news('25');
//        $data['recent_economy_news'] = $this->news_model->recent_small_category_news('26');
//        $data['recent_artical_news'] = $this->news_model->recent_small_category_news('21');
//        $data['recent_art_news'] = $this->news_model->recent_small_category_news('15');
//        $data['recent_quds_news'] = $this->news_model->recent_small_category_news('18');
//        $data['recent_report_news'] = $this->news_model->recent_small_category_news('22');
//        $data['sliderPhotos'] = $this->media_model->imageSlider();
//        $data['PhotosComments'] = $this->media_model->imageSlider(1);
//        $data['videoSlider'] = $this->media_model->videoSlider();
        $data['widgetRecentNews'] = $this->news_model->widgetNews($this->_countryId);
        $data['recentNews'] = $this->news_model->last_4_news($this->_countryId);
        $data['widgetPopularNews'] = $this->news_model->widgetNews($this->_countryId, 'news.views', 7);
//        $data['widgetPoll'] = $this->get_poll();
//        $data['RecentNewsSlider'] = $this->news_model->getRecentNewsSlider();
//        $data['firstVideo'] = $this->media_model->firstVideo();
//        $data['settings'] = $this->settings_model->get_settings();
////        $data['lastComment'] = $this->news_model->getPostComment('', 3);
//        $data['categoryNewsMostComment'] = $this->news_model->most_commented();
        $this->load->view('webpages/index', $data);
    }

    public function post() {
        $data['categories'] = $this->categories_model->get_categories_names_ids();
        $data['RecentNewsSlider'] = $this->news_model->getRecentNewsSlider();
        $data['widgetRecentNews'] = $this->news_model->widgetNews();
        $postId = $this->input->get('id', TRUE);
        empty($postId) ? redirect(base_url() . 'news/page') : '';

        $data['postInfo'] = $this->news_model->get_news_info($postId);
        $data['catName'] = $this->categories_model->get_category_info($data['postInfo']['category_id']);
        $data['last_4_news'] = $this->news_model->last_4_news();
        $data['widgetPopularNews'] = $this->news_model->widgetNews('views');
        $data['sliderPhotos'] = $this->media_model->imageSlider();
        $data['videoSlider'] = $this->media_model->videoSlider();
        $data['firstVideo'] = $this->media_model->firstVideo();
        $data['popular_4_news'] = $this->news_model->last_4_news('views');
        $data['postComment'] = $this->news_model->getPostComment($postId);
//        $data['lastComment'] = $this->news_model->getPostComment('', 3);
        $data['categoryNewsMostComment'] = $this->news_model->most_commented();
        $data['widgetPoll'] = $this->get_poll();
        $data['settings'] = $this->settings_model->get_settings();
        $this->news_model->postView($postId);

        $this->load->view('webpages/post', $data);
    }

    public function photo() {
        $this->load->library("pagination");
        $data['widgetRecentNews'] = $this->news_model->widgetNews();
        $photoId = $this->input->get('id', TRUE);

        $config = array();
        $config["base_url"] = base_url() . "news/photo";
        $config["total_rows"] = $this->media_model->photosCount();
        $config["per_page"] = 28;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;

        $config['query_string_segment'] = 'page';

        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'البداية';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'الأخير &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'التالي &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; السابق';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="current"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["pageNumber"] = $this->pagination->create_links();
        //empty($photoId) ? redirect(base_url() . 'news') : '';
        $data['categories'] = $this->categories_model->get_categories_names_ids();
        $data['RecentNewsSlider'] = $this->news_model->getRecentNewsSlider();
        $data['photoInfo'] = $this->media_model->get_photo_info($photoId);
        //$data['catName'] = $this->categories_model->get_category_info($data['photoInfo']['category_id']);
        //$data['last_4_news'] = $this->news_model->last_4_news();
        $data['widgetPopularNews'] = $this->news_model->widgetNews('views');
        $data['sliderPhotos'] = $this->media_model->imageSlider();
        $data['videoSlider'] = $this->media_model->videoSlider();
        $data['firstVideo'] = $this->media_model->firstVideo();
        $data['popular_4_news'] = $this->news_model->last_4_news('views');
        $data['photoComments'] = $this->media_model->getPhotoComment($photoId);
        $data['photoGallery'] = $this->media_model->photoGallery($config["per_page"], $page);
        $data['photoCountComments'] = $this->media_model->commentCount($photoId);
//        $data['lastComment'] = $this->news_model->getPostComment('', 3);
        $data['categoryNewsMostComment'] = $this->news_model->most_commented();
        $data['widgetPoll'] = $this->get_poll();
        $data['settings'] = $this->settings_model->get_settings();
        //$this->news_model->postView($postId);
        $this->load->view('webpages/photo', $data);
    }

    public function video() {
        $this->load->library("pagination");
        $data['widgetRecentNews'] = $this->news_model->widgetNews();
        //$photoId = $this->input->get('id', TRUE);

        $config = array();
        $config["base_url"] = base_url() . "news/video";
        $config["total_rows"] = $this->media_model->videosCount();
        $config["per_page"] = 28;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;

        $config['query_string_segment'] = 'page';

        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'البداية';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'الأخير &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'التالي &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; السابق';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="current"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["pageNumber"] = $this->pagination->create_links();
        $data['categories'] = $this->categories_model->get_categories_names_ids();
        $data['RecentNewsSlider'] = $this->news_model->getRecentNewsSlider();
        //$data['photoInfo'] = $this->media_model->get_photo_info($photoId);
        $data['widgetPopularNews'] = $this->news_model->widgetNews('views');
        $data['sliderPhotos'] = $this->media_model->imageSlider();
        $data['videoSlider'] = $this->media_model->videoSlider();
        $data['firstVideo'] = $this->media_model->firstVideo();
        $data['popular_4_news'] = $this->news_model->last_4_news('views');
        //$data['photoComments'] = $this->media_model->getPhotoComment($photoId);
        $data['videosGallery'] = $this->media_model->videoGallery($config["per_page"], $page);
        //$data['photoCountComments'] = $this->media_model->commentCount($photoId);
        $data['lastComment'] = $this->news_model->getPostComment('', 3);
        $data['categoryNewsMostComment'] = $this->news_model->most_commented();
        $data['widgetPoll'] = $this->get_poll();
        $data['settings'] = $this->settings_model->get_settings();

        $this->load->view('webpages/video', $data);
    }

    public function page() {
        $data['categories'] = $this->categories_model->get_categories_names_ids();
        $data['RecentNewsSlider'] = $this->news_model->getRecentNewsSlider();
        $data['widgetRecentNews'] = $this->news_model->widgetNews();
        $data['sliderPhotos'] = $this->media_model->imageSlider();
        $category_id = $this->uri->segment(3);
        $this->load->library("pagination");
        $data['videoSlider'] = $this->media_model->videoSlider();
        $data['firstVideo'] = $this->media_model->firstVideo();
        $config = array();
        $config["base_url"] = base_url() . "news/page/$category_id";
        $config["total_rows"] = $this->news_model->newsCategoryCount($category_id);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;

        $config['query_string_segment'] = 'page';

        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'البداية';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'الأخير &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'التالي &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; السابق';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="current"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["pageNumber"] = $this->pagination->create_links();
        $data['categoryNews'] = $this->news_model->getCategoryNews($category_id, $config["per_page"], $page);
        $data['categoryNewsPopular'] = $this->news_model->viewNewsBy('views', $category_id);
        $data['widgetPopularNews'] = $this->news_model->widgetNews('views');
        $data['popular_4_news'] = $this->news_model->last_4_news('views');
//        $data['lastComment'] = $this->news_model->getPostComment('', 3);
        $data['categoryNewsMostComment'] = $this->news_model->most_commented();
        $data['widgetPoll'] = $this->get_poll();
        $data['settings'] = $this->settings_model->get_settings();

        $this->load->view('webpages/page', $data);
    }

    function contact() {
        $data['categories'] = $this->categories_model->get_categories_names_ids();
        $data['sliderPhotos'] = $this->media_model->imageSlider();
        $data['videoSlider'] = $this->media_model->videoSlider();
        $data['widgetRecentNews'] = $this->news_model->widgetNews();
        $data['widgetPopularNews'] = $this->news_model->widgetNews('views');
        $data['RecentNewsSlider'] = $this->news_model->getRecentNewsSlider();
        $data['firstVideo'] = $this->media_model->firstVideo();
//        $data['lastComment'] = $this->news_model->getPostComment('', 3);
        $data['categoryNewsMostComment'] = $this->news_model->most_commented();
        $data['popular_4_news'] = $this->news_model->last_4_news('views');
        $data['widgetPoll'] = $this->get_poll();
        $data['settings'] = $this->settings_model->get_settings();

        $this->load->view('webpages/contact', $data);
    }

    function search() {
        $text = $this->input->post('text');
        $data['categories'] = $this->categories_model->get_categories_names_ids();
        $data['RecentNewsSlider'] = $this->news_model->getRecentNewsSlider();
        $data['widgetRecentNews'] = $this->news_model->widgetNews();
        $data['sliderPhotos'] = $this->media_model->imageSlider();
        $data['videoSlider'] = $this->media_model->videoSlider();
        $data['firstVideo'] = $this->media_model->firstVideo();
        $data['widgetPopularNews'] = $this->news_model->widgetNews('views');
        $data['popular_4_news'] = $this->news_model->last_4_news('views');
//        $data['lastComment'] = $this->news_model->getPostComment('', 3);
        $data['categoryNewsMostComment'] = $this->news_model->most_commented();
        $data['widgetPoll'] = $this->get_poll();
        $data['settings'] = $this->settings_model->get_settings();

        $this->load->library("pagination");
        $config = array();
        $config["base_url"] = base_url() . "news/search";
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['searchResults'] = $this->news_model->search($text, $config['per_page'], $page);
        $config["total_rows"] = $this->news_model->search_count($text);
//echo $config["total_rows"].">>";
//echo count($data['searchResults']);
//exit();
        $config['query_string_segment'] = 'page';

        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'البداية';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'الأخير &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'التالي &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; السابق';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="current"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data["pageNumber"] = $this->pagination->create_links();

        $this->load->view('webpages/search', $data);
    }

    public function redirect() {
        $data['categories'] = $this->categories_model->get_categories_names_ids();
        $data['sliderPhotos'] = $this->media_model->imageSlider();
        $data['videoSlider'] = $this->media_model->videoSlider();
        $data['widgetRecentNews'] = $this->news_model->widgetNews();
        $data['widgetPopularNews'] = $this->news_model->widgetNews('views');
        $data['RecentNewsSlider'] = $this->news_model->getRecentNewsSlider();
        $data['firstVideo'] = $this->media_model->firstVideo();
//        $data['lastComment'] = $this->news_model->getPostComment('', 3);
        $data['popular_4_news'] = $this->news_model->last_4_news('views');
        $data['widgetPoll'] = $this->get_poll();
        $data['settings'] = $this->settings_model->get_settings();

        $this->load->view('webpages/redirect', $data);
    }

    public function doComemnt() {
        $this->form_validation->set_rules('postId', 'رقم الخبر', 'required|trim');
        $this->form_validation->set_rules('author', 'الإسم', 'required|trim|max_length[60]');
        $this->form_validation->set_rules('email', 'البريد الإلكتروني', 'required|trim|valid_email|max_length[60]');
        $this->form_validation->set_rules('comment', 'التعليق', 'required|trim|max_length[300]');

        $postId = $this->input->post('postId');
        $submit = $this->input->post('doComment');
        $author = $this->input->post('author');
        $email = $this->input->post('email');
        $url = $this->input->post('url');
        $comment = $this->input->post('comment');

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url() . 'news/post?id=' . $photoId);
        } else {
            $data = array('news_id' => $postId, 'name' => $author, 'email' => $email, 'website' => $url, 'comment' => $comment);
            $query = $this->news_model->insertComment($data);
            redirect(base_url() . 'news/post?id=' . $photoId);
        }
    }

    function about_us() {
        $this->load->model('user_model');
        $data['about_us_content'] = $this->pages_model->page_content('1');
        $data['our_team'] = $this->user_model->get_our_team();
        $data['categories'] = $this->categories_model->get_categories_names_ids();
        $data['sliderPhotos'] = $this->media_model->imageSlider();
        $data['videoSlider'] = $this->media_model->videoSlider();
        $data['widgetRecentNews'] = $this->news_model->widgetNews();
        $data['widgetPopularNews'] = $this->news_model->widgetNews('views');
        $data['RecentNewsSlider'] = $this->news_model->getRecentNewsSlider();
        $data['firstVideo'] = $this->media_model->firstVideo();
//        $data['lastComment'] = $this->news_model->getPostComment('', 3);
        $data['categoryNewsMostComment'] = $this->news_model->most_commented();
        $data['popular_4_news'] = $this->news_model->last_4_news('views');
        $data['widgetPoll'] = $this->get_poll();
        $data['settings'] = $this->settings_model->get_settings();

        $this->load->view('webpages/about_us', $data);
    }

    function privacy_policy() {
        $data['about_us_content'] = $this->pages_model->page_content('2');
        $data['categories'] = $this->categories_model->get_categories_names_ids();
        $data['sliderPhotos'] = $this->media_model->imageSlider();
        $data['videoSlider'] = $this->media_model->videoSlider();
        $data['widgetRecentNews'] = $this->news_model->widgetNews();
        $data['widgetPopularNews'] = $this->news_model->widgetNews('views');
        $data['RecentNewsSlider'] = $this->news_model->getRecentNewsSlider();
        $data['firstVideo'] = $this->media_model->firstVideo();
//        $data['lastComment'] = $this->news_model->getPostComment('', 3);
        $data['categoryNewsMostComment'] = $this->news_model->most_commented();
        $data['popular_4_news'] = $this->news_model->last_4_news('views');
        $data['widgetPoll'] = $this->get_poll();
        $data['settings'] = $this->settings_model->get_settings();

        $this->load->view('webpages/privacy_policy', $data);
    }

    public function doPhotoComemnt() {
        $photoId = $this->input->post('photoId');
        $submit = $this->input->post('doPhotoComemnt');
        $author = $this->input->post('author');
        $email = $this->input->post('email');
        $url = $this->input->post('url');
        $comment = $this->input->post('comment');
        $this->form_validation->set_rules('photoId', 'رقم الصورة', 'required|trim');
        $this->form_validation->set_rules('author', 'الإسم', 'required|trim|max_length[60]');
        $this->form_validation->set_rules('email', 'البريد الإلكتروني', 'required|trim|valid_email|max_length[60]');
        $this->form_validation->set_rules('comment', 'التعليق', 'required|trim|max_length[300]');

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url() . 'news/photo?id=' . $photoId);
        } else {
            $data = array('photo_id' => $photoId, 'name' => $author, 'email' => $email, 'website' => $url, 'comment' => $comment);
            $query = $this->media_model->insertComment($data);
            redirect(base_url() . 'news/photo?id=' . $photoId);
        }
    }

// Add vote on option to poll
// ----------------------------------------------------------------------
    public function vote() {
        if (!$this->poll_lib->vote($this->input->post('poll_id'), $this->input->post('option_id'))) {
            $data['error_message'] = $this->poll_lib->get_errors();
            echo json_encode(array('status' => false, 'msg' => $data['error_message']));
        } else {
            echo json_encode(array('status' => true, 'msg' => 'تم التصويت بنجاح'));
        }
    }

// View poll
// ----------------------------------------------------------------------
    public function get_poll() {
        $data = $this->poll_lib->single_poll();
        return $data;
    }

    public function doContactMsg() {
        $submit = $this->input->post('doContactMsg');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $url = $this->input->post('url');
        $msg = $this->input->post('msg');

        if ($submit && $name && $email && $url && $msg) {
            $data = array('name' => $name, 'email' => $email, 'url' => $url);
            $query = $this->news_model->insertContactMsg($data);

            if ($query === TRUE) {
                $message = wordwrap($msg, 70);
                mail("support@4newsm.com", 'رسالة استفسار من ' . $name, $message, "From: $email\n");
                redirect(base_url() . 'news/redirect');
            } else {
                
            }
        }
    }

    public function doSubscriberEmail() {

        $submit = $this->input->post('doSubscribe');
        $email = $this->input->post('email');

        if ($submit && $email) {
            $data = array('email' => $email);
            $query = $this->news_model->insertSubscribeEmail($data);

            if ($query === TRUE) {
                mail("support@4newsm.com", 'الإشتراك بالقائمة البريدية', 'تم تسجيل بريدك في القائمة الإخبارية سوف يتم إرسال أخر الأخبار إلي بريدك الإلكتروني أولاً بأول', "From: $email\n");
                redirect(base_url());
            } else {
                
            }
        }
    }

}
