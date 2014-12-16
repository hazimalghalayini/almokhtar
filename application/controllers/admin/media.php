<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Media extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth->is_logged_in();
        $this->load->model('media_model');
        $this->load->model('news_model');
    }

    public function index() {
        
    }

    function manage_photos() {
        $this->load->view('admin/manage_photos');
    }

    function add_photo() {
        $this->form_validation->set_rules('photo_title', 'عنوان الصورة', 'required|trim|max_length[250]');
        $this->form_validation->set_rules('photo_src', 'الصورة', 'required|trim|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => htmlentities($errorMsg)));
        } else {
            $new_pic = $this->input->post('photo_src');
            if ($new_pic != NULL) {
                $file_element_name = 'photo_src';
                $imageName = $this->uploadImage($file_element_name, 'photos');
                $this->generateThumb(400, 292, 'photos');
                @unlink($_FILES[$file_element_name]);
            }

            $data = array(
                'photo_title' => $this->input->post('photo_title'),
                'photo_src' => $imageName
            );

            $result = $this->media_model->add_photo($data);
            if ($result) {
                echo json_encode(array('status' => true, 'msg' => 'تم إضافة المستخدم بنجاح'));
            } else {
                if ($imageName != NULL) {
                    unlink('./uploads/photos/' . $imageName);
                    unlink('./uploads/photos/thumbs/' . $imageName);
                }
                echo json_encode(array('status' => false, 'msg' => htmlentities('هناك خطأ في البيانات المدخلة')));
            }
        }
    }

    function get_all_photos() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $records_number = $this->media_model->get_photos_count($data);
        $result = $this->media_model->get_all_photos($data);

        $row = array();
        foreach ($result as $value) {
            $record = array();
            $options = '';

            if ($value['apply_comments'] == 1) {
                $icon = '<i class="warning icon-star"></i>';
            } else {
                $icon = '<i class="warning icon-star-empty"></i>';
            }
            $record[] = '<button onClick="apply_comments(' . $value["photo_id"] . ', this,' . $value['apply_comments'] . ')">' . $icon . '</button>';
            $record[] = '<div class="span12">
                <div class="thumbnail">
                    <div class="item">
                        <a class="fancybox-button" data-rel="fancybox-button" title="' . $value['photo_title'] . '" href="' . base_url() . "uploads/photos/" . $value["photo_src"] . '">
                            <div class="zoom">
                                <img width="100px" height="100px" src="' . base_url() . "uploads/photos/thumbs/" . $value["photo_src"] . '" alt="Photo">
                                <div class="zoom-icon"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>';
            $record[] = $value['photo_title'];
            $record[] = $value['publish_date'];
            $options .= '<a href="#" onclick="get_photo(' . $value['photo_id'] . ',this);return false;" class="btn btn-small purple" title="تعديل"><i class="icon-edit"></i></a> ';
            $options .= '<a href="#myModal2" onclick="setTarget(' . $value['photo_id'] . ',this);return false;" title="حـذف" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-trash"></i></a>';
            $record[] = $options;
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
    }

    function apply_comments() {
        $this->form_validation->set_rules('photo_id', 'تحديد الصورة', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $photo_id = $this->input->post('photo_id');
            $status = $this->input->post('status');
            $result = $this->media_model->apply_comments($photo_id, $status);
            if ($result) {
                if ($status == 0) {
                    echo json_encode(array('status' => true, 'msg' => 'تم تفعيل التعليقات لهذة الصورة'));
                } else {
                    echo json_encode(array('status' => true, 'msg' => 'تم تعطيل التعليقات لهذة الصورة'));
                }
            } else
                echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
        }
    }

    function get_photo_info() {
        $photo_id = $this->input->post('photo_id');
        $result = $this->media_model->get_photo_info($photo_id);

        echo json_encode($result);
    }

    public function update_photo() {
        $this->form_validation->set_rules('photo_title', 'عنوان الصورة', 'required|trim|max_length[250]');
        $this->form_validation->set_rules('photo_src', 'الصورة', 'trim|max_length[100]|callback_check_news_picture[' . $this->input->post('old_photo') . ']');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => htmlentities($errorMsg)));
        } else {
            $new_pic = $this->input->post('photo_src2');
            if ($new_pic != NULL) {
                $file_element_name = 'photo_src2';
                $imageName = $this->uploadImage($file_element_name, 'photos');
                $this->generateThumb(40, 40, 'photos');
            }

            $photo_id = $this->input->post('photo_id');
            $data['photo_title'] = $this->input->post('photo_title');
            $data['photo_src'] = $this->input->post('photo_src2');
            if ($new_pic == NULL)
                $data['photo_src'] = $this->input->post('old_photo');
            else
                $data['photo_src'] = ($imageName != 'false') ? $imageName : '';

            $result = $this->media_model->update_photo($photo_id, $data);
            if ($result) {
                if ($new_pic != NULL) {
                    unlink('./uploads/photos/' . $this->input->post('old_photo'));
                    unlink('./uploads/photos/thumbs/' . $this->input->post('old_photo'));
                }
                echo json_encode(array('status' => true, 'msg' => 'تم تعديل بيانات الصورة بنجاح'));
            } else {
                unlink('./uploads/photos/' . $imageName);
                unlink('./uploads/photos/thumbs/' . $imageName);
                echo json_encode(array('status' => false, 'msg' => htmlentities('هناك خطأ في البيانات المدخلة')));
            }
        }
    }

    function delete_photo() {
        $photo_id = $this->input->post('photo_id');
        $result = $this->media_model->delete_photo($photo_id);
        if ($result)
            echo json_encode(array('status' => true, 'msg' => "تم حذف الصورة بنجاح"));
        else
            echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
    }

    function add_v_news() {
        $result['countries'] = $this->news_model->get_countries_names_codes();
        $this->load->view('admin/add_visual_news',$result);
    }

    function do_add_v_news() {
        $this->form_validation->set_rules('news_title', 'عنوان الفيديو', 'required|trim');
        $this->form_validation->set_rules('news_description', 'نص الموضوع', 'required|trim');
        $this->form_validation->set_rules('country_id', 'الدولة', 'required|trim');
        $this->form_validation->set_rules('video_src', 'إرفاق الفيديو', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $this->load->helper('video');
            $video_url = $this->input->post('video_src');
            $host_name = parse_url($video_url, PHP_URL_HOST);
            if ($host_name == 'www.youtube.com' or $host_name == 'youtube.com') {
                $id = youtube_id($video_url);
                $video_thumb = youtube_thumbs($id, 1);
            } else if ($host_name == 'www.vimeo.com' or $host_name == 'vimeo.com') {
                $id = vimeo_id($video_url);
                $video_thumb = vimeo_thumbs($id, 2);
            } else {
                echo json_encode(array('status' => false, 'msg' => 'يجب جلب الفيديو من موقع اليوتيوب "youtube" أو "vimeo"'));
            }
            
            $description = $this->input->post('news_description');
            $description = str_replace("--*", '"', $description);
            $description = str_replace("++*", "'", $description);
            $description = str_replace("+++", "style", $description);

            $data = array(
                'news_title' => $this->input->post('news_title'),
                'news_description' => $description,
                'country_id' => $this->input->post('country_id'),
                'video_src' => $video_url,
                'video_thumb' => $video_thumb
            );

            $result = $this->media_model->add_v_news($data);
            if ($result) {
                echo json_encode(array('status' => true, 'msg' => 'تم إضافة الخبر بنجاح'));
            } else {
                echo json_encode(array('status' => false, 'msg' => htmlentities('هناك خطأ في البيانات المدخلة')));
            }
        }
    }
    
    function manage_v_news() {
        $this->load->view('admin/manage_v_news');
    }

    function get_all_v_news() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $records_number = $this->media_model->get_v_news_count($data);
        $result = $this->media_model->get_all_v_news($data);

        $row = array();
        foreach ($result as $value) {
            $record = array();
            $options = '';
            $record[] = '<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />';
            $record[] = '<a href="' . $value['video_src'] . '" target="_blank" class="more"><img src="' . $value["video_thumb"] . '" width="80px" height="80px" alt="Video"></a>';

            $record[] = substr($value['news_title'], 0, 50) . '...';
            $record[] = $value['country_name'];
            $record[] = $value['publish_date'];
            $options .= '<a href="update_v_news/' . $value['news_id'] . '" class="btn btn-small purple" title="تعديل"><i class="icon-edit"></i></a> ';
            $options .= '<a href="#myModal2" onclick="setTarget(' . $value['news_id'] . ',this);return false;" title="حـذف" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-trash"></i></a>';
            $record[] = $options;
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
    }

    function delete_v_news() {
        $news_id = $this->input->post('news_id');
        $result = $this->media_model->delete_v_news($news_id);
        if ($result)
            echo json_encode(array('status' => true, 'msg' => "تم حذف الخبر بنجاح"));
        else
            echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
    }

    function update_v_news($news_id = NULL) {
        $result['countries'] = $this->news_model->get_countries_names_codes();
        $result['data'] = $this->media_model->get_v_news_info($news_id);
        $this->load->view('admin/update_v_news', $result);
    }

    function do_update_v_news() {
        $this->form_validation->set_rules('news_title', 'عنوان الفيديو', 'required|trim');
        $this->form_validation->set_rules('news_description', 'نص الموضوع', 'required|trim');
        $this->form_validation->set_rules('country_id', 'الدولة', 'required|trim');
        $this->form_validation->set_rules('video_src', 'إرفاق الفيديو', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $this->load->helper('video');
            $video_url = $this->input->post('video_src');
            $news_id = $this->input->post('news_id');
            $id = youtube_id($video_url);
            $video_thumb = youtube_thumbs($id, 1);
            $data = array(
                'news_title' => $this->input->post('news_title'),
                'news_description' => $this->input->post('news_description'),
                'country_id' => $this->input->post('country_id'),
                'video_src' => $video_url,
                'video_thumb' => $video_thumb
            );

            $result = $this->media_model->update_v_news($news_id, $data);
            if ($result) {
                echo json_encode(array('status' => true, 'msg' => 'تم تعديل بيانات الخبر بنجاح'));
            } else {
                echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
            }
        }
    }
    
    function add_video() {
        $this->load->view('admin/add_video');
    }

    function do_add_video() {
        $this->form_validation->set_rules('video_title', 'عنوان الفيديو', 'required|trim');
        $this->form_validation->set_rules('video_description', 'نص الموضوع', 'required|trim');
        $this->form_validation->set_rules('video_src', 'إرفاق الفيديو', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $this->load->helper('video');
            $video_url = $this->input->post('video_src');
            $host_name = parse_url($video_url, PHP_URL_HOST);
            if ($host_name == 'www.youtube.com' or $host_name == 'youtube.com') {
                $id = youtube_id($video_url);
                $video_thumb = youtube_thumbs($id, 1);
            } else if ($host_name == 'www.vimeo.com' or $host_name == 'vimeo.com') {
                $id = vimeo_id($video_url);
                $video_thumb = vimeo_thumbs($id, 2);
            } else {
                echo json_encode(array('status' => false, 'msg' => 'يجب جلب الفيديو من موقع اليوتيوب "youtube" أو "vimeo"'));
            }

            $data = array(
                'video_title' => $this->input->post('video_title'),
                'video_description' => $this->input->post('video_description'),
                'video_src' => $video_url,
                'video_thumb' => $video_thumb
            );

            $result = $this->media_model->add_video($data);
            if ($result) {
                echo json_encode(array('status' => true, 'msg' => 'تم إضافة مقطع الفيديو بنجاح'));
            } else {
                echo json_encode(array('status' => false, 'msg' => htmlentities('هناك خطأ في البيانات المدخلة')));
            }
        }
    }

    function manage_videos() {
        $this->load->view('admin/manage_videos');
    }

    function get_all_videos() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $records_number = $this->media_model->get_videos_count($data);
        $result = $this->media_model->get_all_videos($data);

        $row = array();
        foreach ($result as $value) {
            $record = array();
            $options = '';
            $record[] = '<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />';
            $record[] = '<a href="' . $value['video_src'] . '" target="_blank" class="more"><img src="' . $value["video_thumb"] . '" width="80px" height="80px" alt="Video"></a>';

            $record[] = substr($value['video_title'], 0, 50) . '...';
            $record[] = substr($value['video_description'], 0, 50) . '...';
            $record[] = $value['publish_date'];
            $options .= '<a href="update_video/' . $value['video_id'] . '" class="btn btn-small purple" title="تعديل"><i class="icon-edit"></i></a> ';
            $options .= '<a href="#myModal2" onclick="setTarget(' . $value['video_id'] . ',this);return false;" title="حـذف" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-trash"></i></a>';
            $record[] = $options;
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
    }

    function delete_video() {
        $video_id = $this->input->post('video_id');
        $result = $this->media_model->delete_video($video_id);
        if ($result)
            echo json_encode(array('status' => true, 'msg' => "تم حذف الصورة بنجاح"));
        else
            echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
    }

    function update_video($video_id = NULL) {
        $result['data'] = $this->media_model->get_video_info($video_id);
        $this->load->view('admin/update_video', $result);
    }

    function do_update_video() {
        $this->form_validation->set_rules('video_title', 'عنوان الفيديو', 'required|trim');
        $this->form_validation->set_rules('video_description', 'نص الموضوع', 'required|trim');
        $this->form_validation->set_rules('video_src', 'إرفاق الفيديو', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $this->load->helper('video');
            $video_url = $this->input->post('video_src');
            $video_id = $this->input->post('video_id');
            $id = youtube_id($video_url);
            $video_thumb = youtube_thumbs($id, 1);
            $data = array(
                'video_title' => $this->input->post('video_title'),
                'video_description' => $this->input->post('video_description'),
                'video_src' => $video_url,
                'video_thumb' => $video_thumb
            );

            $result = $this->media_model->update_video($video_id, $data);
            if ($result) {
                echo json_encode(array('status' => true, 'msg' => 'تم تعديل بيانات مقطع الفيديو بنجاح'));
            } else {
                echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
            }
        }
    }
    
    function manage_ads(){
        $this->load->view('admin/manage_ads');
    }
    
    function add_ads(){
        $this->load->view('admin/ad_ads');
    }
    
    function do_add_ads(){
        $this->form_validation->set_rules('name', 'عنوان الفيديو', 'required|trim');
        $this->form_validation->set_rules('start_date', 'نص الموضوع', 'required|trim');
        $this->form_validation->set_rules('end_date', 'إرفاق الفيديو', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => $errorMsg));
        } else {
            $file_source = $this->input->post('file_source');
            if ($file_source != NULL) {
                $file_element_name = 'file_source';
                $imageName = $this->uploadImage($file_element_name, 'ads');
                $this->generateThumb(195, 123, 'ads');
                @unlink($_FILES[$file_element_name]);
            }

            $data = array(
                'name' => $this->input->post('name'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'place' => $this->input->post('place'),
                'file_source' => $imageName
            );

            $result = $this->media_model->add_ads($data);
            if ($result) {
                echo json_encode(array('status' => true, 'msg' => 'تم إضافة الإعلان بنجاح'));
            } else {
                if ($imageName != NULL) {
                    unlink('./uploads/ads/' . $imageName);
                    unlink('./uploads/ads/thumbs/' . $imageName);
                }
                echo json_encode(array('status' => false, 'msg' => htmlentities('هناك خطأ في البيانات المدخلة')));
            }
        }
    }
    
    function get_all_ads() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $records_number = $this->media_model->get_ads_count($data);
        $result = $this->media_model->get_all_ads($data);

        $row = array();
        foreach ($result as $value) {
            $record = array();
            $record[] = '<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />';
            $record[] = $value['name'];
            $record[] = $value['start_date'];
            $record[] = $value['end_date'];
            $places = array('t' => 'في الأعلى', 'l' => 'في القائمة الجانبية', 'm' => 'في الوسط');
            $record[] = $places[$value['place']];
            $record[] = '';
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
    }

    /*
     * To check the old or new picture is exist
     */

    function check_news_picture($news_picture, $old_picture) {
        if (!empty($news_picture) or !empty($old_picture)) {
            return true;
        } else {
            $this->form_validation->set_message('check_news_picture', 'يجب إختيار صورة');
            return false;
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

//    function uploadVedio($file_element_name = NULL, $location = NULL) {
//        $config['upload_path'] = './uploads/'.$location.'/';
//        $config['allowed_types'] = 'mp4|3gp|flv|mp3';
//        $config['max_size'] = 1024;
//        $config['encrypt_name'] = TRUE;
//
//        $this->load->library('upload', $config);
//
//        if (!$this->upload->do_upload($file_element_name)) {
//            return 'false';
//        } else {
//            $picture = $this->upload->data();
//            return $picture['file_name'];
//        }
//    }

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
            return 'false';
        } else {
            $picture = $this->upload->data();
            return $picture['file_name'];
        }
    }

}
