<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->is_logged_in();
        $this->load->model('news_model');
        $this->load->model('media_model');
        $this->load->model('categories_model');
    }

    public function index() {
        $result['news_count'] = $this->news_model->get_news_count();
        $result['photos_count'] = $this->media_model->get_photos_count();
        $result['videos_count'] = $this->media_model->get_videos_count();
        $result['comments_count'] = $this->news_model->get_comments_count();
        $result['recent_news_count'] = $this->news_model->get_recent_news_count();
        $result['messages_count'] = $this->news_model->get_messages_count();
        $result['comments'] = $this->news_model->latest_comments(10);
        $result['news'] = $this->news_model->news_most_viewed('views', 10);
        $this->load->view('admin/index', $result);
    }

    function slide_news() {
        $this->load->view('admin/slide_news');
    }

    function do_add_slide_news() {
        $this->form_validation->set_rules('news_description', 'نص الخبر', 'required|trim|max_length[300]');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $result = $this->news_model->add_slide_news($this->input->post('news_description'));
            if ($result)
                echo json_encode(array('status' => true, 'msg' => 'تم إضافة الخبر بنجاح'));
            else
                echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
        }
    }

    function get_all_recent_news() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $records_number = $this->news_model->get_recent_news_count($data);
        $result = $this->news_model->get_all_recent_news($data);

        $row = array();
        foreach ($result as $value) {
            $record = array();
            $options = '';
            $record[] = '<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />';
            $record[] = $value['added_date'];
            $record[] = $value['news_description'];

            $options .= '<a href="#" onclick="get_slide_news(' . $value['news_id'] . ',this);return false;" class="btn btn-small purple" title="تعديل"><i class="icon-edit"></i></a> ';
            $options .= '<a href="#myModal2" onclick="setTarget(' . $value['news_id'] . ',this);return false;" title="حـذف" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-trash"></i></a>';
            $record[] = $options;
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
    }

    function delete_slide_news() {
        $news_id = $this->input->post('news_id');
        $result = $this->news_model->delete_slide_news($news_id);
        if ($result)
            echo json_encode(array('status' => true, 'msg' => "تم حذف الخبر بنجاح"));
        else
            echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
    }

    function get_slide_news() {
        $news_id = $this->input->post('news_id');
        $result = $this->news_model->get_slide_news($news_id);

        echo json_encode($result);
    }

    function update_slide_news() {
        $this->form_validation->set_rules('news_description', 'نص الخبر', 'required|trim|max_length[300]');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $news_id = $this->input->post('news_id');
            $data = array('news_description' => $this->input->post('news_description'));
            $result = $this->news_model->update_slide_news($news_id, $data);
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

    function add_news() {
        $result['categories'] = $this->categories_model->get_categories_names_ids();
        $result['countries'] = $this->news_model->get_countries_names_codes();
        $this->load->view('admin/add_news', $result);
    }

    function do_add_news() {
        $this->form_validation->set_rules('category_id', 'التصنيف', 'required|trim');
        $this->form_validation->set_rules('news_title', 'عنوان الخبر', 'required|trim');
        $this->form_validation->set_rules('news_description', 'نص الخبر', 'required|trim');
        $this->form_validation->set_rules('country_id', 'الدولة', 'required|trim');
        $this->form_validation->set_rules('news_picture', 'صورة الخبر', 'required|trim|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => htmlentities($errorMsg)));
        } else {
            $new_pic = $this->input->post('news_picture');
            if ($new_pic != NULL) {
                $file_element_name = 'news_picture';
                $imageName = $this->uploadImage($file_element_name, 'news');
                $this->generateThumb(194, 146, 'news');
                @unlink($_FILES[$file_element_name]);
            }
            $description = $this->input->post('news_description');
            $description = str_replace("--*", '"', $description);
            $description = str_replace("++*", "'", $description);
            $description = str_replace("+++", "style", $description);
            $data = array(
                'category_id' => $this->input->post('category_id'),
                'news_title' => $this->input->post('news_title'),
                'country_id' => $this->input->post('country_id'),
                'news_description' => $description,
                'news_picture' => ($imageName != 'false') ? $imageName : ''
            );

            $result = $this->news_model->do_add_news($data);
            if ($result) {
                echo json_encode(array('status' => true, 'msg' => 'تم إضافة الخبر بنجاح'));
            } else {
                if ($imageName != NULL) {
                    unlink('./uploads/news/' . $imageName);
                    unlink('./uploads/news/thumbs/' . $imageName);
                }
                echo json_encode(array('status' => false, 'msg' => htmlentities('هناك خطأ في البيانات المدخلة')));
            }
        }
    }

    function manage_news() {
        $result['categories'] = $this->categories_model->get_categories_names_ids();
        $this->load->view('admin/manage_news', $result);
    }

    function get_all_news() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $data['category_id'] = $this->input->post('category_id');
        $records_number = $this->news_model->get_news_count($data);
        $result = $this->news_model->get_all_news($data);

        $row = array();
        foreach ($result as $value) {
            $record = array();
            $options = '';
            $record[] = '<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />';
            $img = '<div class="span12">
                <div class="thumbnail">
                    <div class="item">
                        <a class="fancybox-button" data-rel="fancybox-button" title="' . $value['news_title'] . '" href="' . base_url() . "uploads/news/" . $value["news_picture"] . '">
                            <div class="zoom">
                                <img width="100px" height="100px" src="' . base_url() . "uploads/news/thumbs/" . $value["news_picture"] . '" alt="Photo">
                                <div class="zoom-icon"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>';
            $record[] = $img;
            $record[] = substr($value['news_title'], 0, 50) . '...';
            $record[] = $value['country_name'];
            $record[] = $value['category_name'];
            $record[] = $value['publish_date'];
            $record[] = $value['views'];

            $options .= '<a href="update_news/' . $value['news_id'] . '" class="btn btn-small purple" title="تعديل"><i class="icon-edit"></i></a> ';
            $options .= '<a href="manage_comments/' . $value['news_id'] . '" class="btn btn-small btn-info" title="التعليقات"><i class="icon-comment"></i></a> ';
            $options .= '<a href="#myModal2" onclick="setTarget(' . $value['news_id'] . ',this);return false;" title="حـذف" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-trash"></i></a>';
            $record[] = $options;
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
    }

    function update_news($news_id = NULL) {
        $result['categories'] = $this->categories_model->get_categories_names_ids();
        $result['countries'] = $this->news_model->get_countries_names_codes();
        $result['data'] = $this->news_model->get_news_info($news_id);
        $this->load->view('admin/update_news', $result);
    }

    public function do_update_news() {
        $this->form_validation->set_rules('category_id', 'التصنيف', 'required|trim');
        $this->form_validation->set_rules('news_title', 'عنوان الخبر', 'required|trim');
        $this->form_validation->set_rules('country_id', 'الدولة', 'required|trim');
        $this->form_validation->set_rules('news_description', 'نص الخبر', 'required|trim');
        $this->form_validation->set_rules('news_picture', 'صورة الخبر', 'trim|max_length[100]|callback_check_news_picture[' . $this->input->post('old_picture') . ']');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => htmlentities($errorMsg)));
        } else {
            $new_pic = $this->input->post('news_picture');
            if ($new_pic != NULL) {
                $file_element_name = 'news_picture';
                $imageName = $this->uploadImage($file_element_name, 'news');
                $this->generateThumb(120, 120, 'news');
            }
            $description = $this->input->post('news_description');
            $description = str_replace("--*", '"', $description);
            $description = str_replace("++*", "'", $description);
            $description = str_replace("+++", "style", $description);
            
            $news_id = $this->input->post('news_id');
            $data['category_id'] = $this->input->post('category_id');
            $data['news_title'] = $this->input->post('news_title');
            $data['news_description'] = $description;
            $data['country_id'] = $this->input->post('country_id');
            if ($new_pic == NULL)
                $data['news_picture'] = $this->input->post('old_picture');
            else
                $data['news_picture'] = ($imageName != 'false') ? $imageName : '';

            $result = $this->news_model->update_news($news_id, $data);
            if ($result) {
                if ($new_pic != NULL) {
                    unlink('./uploads/news/' . $this->input->post('old_picture'));
                    unlink('./uploads/news/thumbs/' . $this->input->post('old_picture'));
                }
                echo json_encode(array('status' => true, 'msg' => 'تم تعديل بيانات المستخدم بنجاح'));
            } else {
                unlink('./uploads/news/' . $imageName);
                unlink('./uploads/news/thumbs/' . $imageName);
                echo json_encode(array('status' => false, 'msg' => htmlentities('هناك خطأ في البيانات المدخلة')));
            }
        }
    }

    /*
     * To check the old or new picture is exist
     */

    function check_news_picture($news_picture, $old_picture) {
        if (!empty($news_picture) or !empty($old_picture)) {
            return true;
        } else {
            $this->form_validation->set_message('check_news_picture', 'يجب إختيار صورة للخبر');
            return false;
        }
    }

    function delete_news() {
        $news_id = $this->input->post('news_id');
        $result = $this->news_model->delete_news($news_id);
        if ($result)
            echo json_encode(array('status' => true, 'msg' => "تم حذف الخبر بنجاح"));
        else
            echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
    }

    function main_slider() {
        $result['categories'] = $this->categories_model->get_categories_names_ids();
        $this->load->view('admin/main_slider', $result);
    }

    function get_main_slider() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $data['category_id'] = $this->input->post('category_id');
        $records_number = $this->news_model->get_main_slider_count($data);
        $result = $this->news_model->get_main_slider($data);

        $row = array();
        foreach ($result as $value) {
            $record = array();
            if ($value['main_slider'] == 1) {
                $icon = '<i class="warning icon-star"></i>';
            } else {
                $icon = '<i class="warning icon-star-empty"></i>';
            }
            $record[] = '<button title="السلايدر الرئيسي" onClick="put_news_in_slider(' . $value["news_id"] . ', this,' . $value['main_slider'] . ')">' . $icon . '</button>';
            $img = '<div class="span12">
                <div class="thumbnail">
                    <div class="item">
                        <a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="' . base_url() . "uploads/news/" . $value["news_picture"] . '">
                            <div class="zoom">
                                <img width="100px" height="100px" src="' . base_url() . "uploads/news/thumbs/" . $value["news_picture"] . '" alt="Photo">
                                <div class="zoom-icon"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>';
            $record[] = $img;
            $record[] = substr($value['news_title'], 0, 50) . '...';
            $record[] = substr($value['news_description'], 0, 50) . '...';
            $record[] = $value['category_name'];
            $record[] = $value['publish_date'];
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
    }

    function put_news_in_slider() {
        $this->form_validation->set_rules('news_id', 'تحديد الخبر', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $news_id = $this->input->post('news_id');
            $status = $this->input->post('status');
            $result = $this->news_model->put_news_in_slider($news_id, $status);
            if ($result)
                echo json_encode(array('status' => true, 'msg' => 'تم وضع الخبر في السلايدر الرئيسي'));
            else
                echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
        }
    }

    function manage_comments($news_id = NULL) {
        $data['news_id'] = $news_id;
        $this->load->view('admin/manage_comments', $data);
    }

    function get_all_comments() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $data['news_id'] = $this->input->post('news_id');
        $records_number = $this->news_model->get_comments_count($data);
        $result = $this->news_model->get_comments($data);

        $row = array();
        foreach ($result as $value) {
            $record = array();
            $options = '';
            $record[] = '<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />';
            $record[] = $value['name'];
            $record[] = '<span title="' . $value['comment'] . '">' . substr($value['comment'], 0, 50) . '...' . '</span>';
            $record[] = $value['email'];
            $record[] = $value['publishDate'];
            if ($value['status'] == '0') {
                $options .= '<a href="#myModal1" onclick="setTarget(' . $value['comment_id'] . ',this,' . $value['status'] . ');return false;" title="قبول هذا التعليق" class="btn btn-small btn-success" data-toggle="modal"><i class="icon-eye-open"></i></a>';
            } else {
                $options .= '<a href="#myModal1" onclick="setTarget(' . $value['comment_id'] . ',this,' . $value['status'] . ');return false;" title="رفض هذا التعليق" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-eye-close"></i></a>';
            }
            $record[] = $options;
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
    }

    function recent_comments() {
        $this->load->view('admin/recent_comments');
    }

    function get_recent_comments() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $data['news_id'] = $this->input->post('news_id');
        $records_number = $this->news_model->get_recent_comments_count($data);
        $result = $this->news_model->get_recent_comments($data);

        $row = array();
        foreach ($result as $value) {
            $record = array();
            $options = '';
            $record[] = '<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />';
            $record[] = '<a target="_blank" href="' . base_url() . 'news/post?id=' . $value['news_id'] . '">' . substr($value['news_title'], 0, 100) . '...';
            $record[] = $value['name'];
            $record[] = '<span title="' . $value['comment'] . '">' . substr($value['comment'], 0, 100) . '...' . '</span>';
            $record[] = $value['email'];
            $record[] = $value['publishDate'];
            if ($value['status'] == '0') {
                $options .= '<a href="#myModal1" onclick="setTarget(' . $value['comment_id'] . ',this,' . $value['status'] . ');return false;" title="قبول هذا التعليق" class="btn btn-small btn-success" data-toggle="modal"><i class="icon-eye-open"></i></a>';
            } else {
                $options .= '<a href="#myModal1" onclick="setTarget(' . $value['comment_id'] . ',this,' . $value['status'] . ');return false;" title="رفض هذا التعليق" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-eye-close"></i></a>';
            }
            $record[] = $options;
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
    }

    function comment_status() {
        $data['comment_id'] = $this->input->post('comment_id');
        $data['current_status'] = $this->input->post('current_status');
        $result = $this->news_model->change_comment_status($data);
        if ($result)
            echo json_encode(array('status' => true, 'msg' => "تم تغيير حالة التعليق بنجاح"));
        else
            echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
    }

    function getNotificationsNumber() {
        $result = $this->news_model->getNotifications();
        echo json_encode($result);
    }

    /**
     * generateThumb
     * 
     * function will resize the actual image and store it into project folder
     * 
     * @access public
     * @return void
     */
    function generateThumb($width = 35, $height = 35, $location = NULL) {
        $config['new_image'] = './uploads/' . $location . '/thumbs/' . $this->upload->file_name;
        $config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }

    /**
     * uploadImage
     * 
     * function will take the actual image and store it into project folder
     * 
     * @access public
     * @return void
     */
    function uploadImage($file_element_name = NULL, $location = NULL) {
        $config['upload_path'] = './uploads/' . $location . '/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1024;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_element_name)) {
            $msg = $this->upload->display_errors('', '');
            return 'false';
        } else {
            $picture = $this->upload->data();
            return $picture['file_name'];
        }
    }

}
