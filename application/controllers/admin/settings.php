<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->is_logged_in();
        $this->load->model('settings_model');
    }

    public function index() {
        $data['settings'] = $this->settings_model->get_settings();
        $this->load->view('admin/website_settings', $data);
    }

    public function update_settings() {
        $data['email'] = $this->addhttp($this->input->post('email'));
        $data['facebook'] = $this->addhttp($this->input->post('facebook'));
        $data['twitter'] = $this->addhttp($this->input->post('twitter'));
        $data['google_plus'] = $this->addhttp($this->input->post('google_plus'));
        $data['youtube'] = $this->addhttp($this->input->post('youtube'));
        $data['rss'] = $this->addhttp($this->input->post('rss'));
        $data['pinterest'] = $this->addhttp($this->input->post('pinterest'));
        $result = $this->addhttp($this->settings_model->update_settings($data));
        if ($result)
            echo json_encode(array('status' => true, 'msg' => 'تم حفظ الإعدادات بنجاح'));
        else
            echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
    }

    function addhttp($url) {
        if (!empty($url) and !preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }

}
