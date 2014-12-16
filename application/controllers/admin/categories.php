<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->is_logged_in();
        $this->load->model('categories_model');
    }

    public function index() {
        
    }

    function manage_categories() {
        $this->load->view('admin/manage_categories');
    }

    function add_category() {
        $this->form_validation->set_rules('category_name', 'نص الخبر', 'required|trim|max_length[70]');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $result = $this->categories_model->add_category($this->input->post('category_name'));
            if ($result)
                echo json_encode(array('status' => true, 'msg' => 'تم إضافة التصنيف بنجاح'));
            else
                echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
        }
    }

    function get_all_categories() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $records_number = $this->categories_model->get_categories_count($data);
        $result = $this->categories_model->get_all_categories($data);

        $row = array();
        foreach ($result as $value) {
            $record = array();
            $options = '';
            $record[] = '<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />';
            $record[] = $value['added_date'];
            $record[] = $value['category_name'];

            $options .= '<a href="#" onclick="get_category(' . $value['category_id'] . ',this);return false;" class="btn btn-small purple" title="تعديل"><i class="icon-edit"></i></a> ';
            $options .= '<a href="#myModal2" onclick="setTarget(' . $value['category_id'] . ',this);return false;" title="حـذف" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-trash"></i></a>';
            $record[] = $options;
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
    }
    
    function get_categories_names_ids(){
        $result = $this->categories_model->get_categories_names_ids();
        echo json_encode($result);
    }

    function delete_category() {
        $category_id = $this->input->post('category_id');
        $result = $this->categories_model->delete_category($category_id);
        if ($result)
            echo json_encode(array('status' => true, 'msg' => "تم حذف الخبر بنجاح"));
        else
            echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
    }
    
    function get_category_info(){
        $category_id = $this->input->post('category_id');
        $result = $this->categories_model->get_category_info($category_id);
        
        echo json_encode($result);
    }
    
    function update_category() {
        $this->form_validation->set_rules('category_name', 'إسم التصنيف', 'required|trim|max_length[300]');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $category_id = $this->input->post('category_id');
            $data = array('category_name' => $this->input->post('category_name'));
            $result = $this->categories_model->update_category($category_id,$data);
            if ($result)
                echo json_encode(array('status' => true, 'msg' => 'تم تعديل الخبر بنجاح'));
            else
                echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
        }
    }

    function createOutput($sEcho, $records_number, $aaData = array()) {
        $output = array(
            "sEcho" => $sEcho,
            "iTotalRecords" => $records_number,
            "iTotalDisplayRecords" => $records_number,
            "aaData" => $aaData
        );
        return $output;
    }

}
