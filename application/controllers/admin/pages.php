<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->is_logged_in();
        $this->load->model('pages_model');
    }

    public function index() {
        
    }

    function about_us() {
        $result['data'] = $this->pages_model->page_content('1');
        $this->load->view('admin/about_us', $result);
    }
 
    function privacy_policy() {
        $result['data'] = $this->pages_model->page_content('2');
        $this->load->view('admin/privacy_policy', $result);
    }

    function update_page() {
        $this->form_validation->set_rules('content', 'محتوى الصفحة', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $page_id = $this->input->post('page_id');
            $page_content = $this->input->post('content');
            $data = array('content' => $page_content);
            $result = $this->pages_model->update_page($page_id, $data);
            if ($result)
                echo json_encode(array('status' => true, 'msg' => 'تم تعديل محتوى الصفحة بنجاح'));
            else
                echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
        }
    }

}
