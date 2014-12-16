<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

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
//        $this->auth->is_logged_in();
        $this->load->model('user_model');
    }

    public function index() {
        $this->login();
    }

    function check_email_existing() {
        $this->form_validation->set_rules('user_email', 'البريد الإلكتروني', 'required|trim|xss_clean|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => 'false', 'msg' => $errorMsg));
        } else {
            $user_email = $this->input->post('user_email');
            $info = $this->user_model->check_email_existing($user_email);
            if ($info) {
                $this->reset_password($info);
                echo json_encode(array('status' => 'true', 'msg' => 'تم إرسال رسالة على البريد الإلكتروني لمساعدتك في إسترجاع كلمة المرور'));
            } else if ($info) {
                echo json_encode(array('status' => 'false', 'msg' => 'عذراً البريد الإلكتروني الذي أدخلتة غير موجود'));
            }
        }
    }

    function reset_password($info = NULL) {
        $this->load->library('email');
        $this->email->set_mailtype('html');
        $this->email->from($this->config->item('site_email'), 'Shbab News');
        $this->email->to($info['email']);
        $this->email->subject('إستعادة كلمة المرور');

        $message = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        </head><body>';
        $message .= '<p>مرحبا ' . $info['username'] . '</p>';
        $message .= '<p>نريد مساعدتك في إسترجاع كلمة المرور المفقوردة</p>';
        $message .= '<p>لإسترجاع كلمة المرور الرجاء الضغط <a href="' . base_url() . 'admin/users/revert_account/' . $info['username'] . '/' . $info['password'] . '"><strong> هنا </strong></a></p>';
        $message .= '<p>تقبلوا فائق الإحترام</p>';
        $message .= '</body></html>';
        $this->email->message($message);
        $this->email->send();
//        echo $this->email->print_debugger();
    }

    function revert_account($username = NULL, $password = NULL) {
        $data['username'] = $username;
        $data['password'] = $password;
        $info = $this->user_model->do_login($data);
        if (count($info)) {
            $this->auth->fill_session($info);
            redirect(base_url() . 'admin/news', 'refresh');
        } else if (count($info) < 1) {
            redirect(base_url() . 'admin/users', 'refresh');
        }
    }

    function login() {
        $this->load->view('admin/login');
    }

    /**
     * do_login
     * 
     * function takes username and password from login form
     * and will check if these inf. is valid or not by calling 
     * doLogin function in model
     * 
     * @access public
     * @return json
     */
    function do_login() {
        $this->form_validation->set_rules('username', 'إسم المستخدم', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'كلمة المرور', 'required|trim|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => 'false', 'msg' => $errorMsg));
        } else {
            $data['username'] = $this->input->post('username');
            $data['password'] = $this->auth->addSalt($this->input->post('password'));
            $info = $this->user_model->do_login($data);
            if ($info) {
                $this->auth->fill_session($info);
                echo json_encode(array('status' => 'true', 'msg' => 'تم تسجيل الدخول بنجاح'));
            } else {
                echo json_encode(array('status' => 'false', 'msg' => 'خطأ في إسم المستخدم أو كلمة المرور'));
            }
        }
    }

    /**
     * loginout
     * 
     * function call logout function to destroy the user session
     * 
     * @access public
     * @return void
     */
    function logout() {
        $this->auth->logout();
    }

    /**
     * do_add_user
     * 
     * function takes user information from view page and parse 
     * it to model class to store it in database and return json 
     * have transaction status
     * 
     * @access public
     * @return json
     */
    function do_add_user() {
        $this->form_validation->set_rules('full_name', 'الإسم بالكامل', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('job_name', 'المسمى الوظيفي', 'required|trim|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => htmlentities($errorMsg)));
        } else {
            $new_pic = $this->input->post('user_picture');
            $imageName = '';
            if ($new_pic != NULL) {
                $file_element_name = 'user_picture';
                $imageName = $this->uploadImage($file_element_name, 'users');
                $this->generateThumb(150, 150, 'users');
                @unlink($_FILES[$file_element_name]);
            }
            $data['full_name'] = $this->input->post('full_name');
            $data['job_name'] = $this->input->post('job_name');
            $data['user_picture'] = ($imageName != 'false') ? $imageName : '';

            $result = $this->user_model->do_add_user($data);
            if ($result) {
                echo json_encode(array('status' => true, 'msg' => 'تم إضافة العضو بنجاح'));
            } else {
                if ($imageName != NULL) {
                    unlink('./uploads/users/' . $imageName);
                    unlink('./uploads/users/thumbs/' . $imageName);
                }
                echo json_encode(array('status' => false, 'msg' => htmlentities('هناك خطأ في البيانات المدخلة')));
            }
        }
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

    /**
     * users_management 
     * 
     * function used to get users by calling get_users function
     * in model class and parsing these information to loaded view
     * 
     * @access public
     * @return load view
     */
    public function our_team() {
        $this->load->view('admin/our_team');
    }

    function get_our_team() {
        $data['i_search'] = isset($_POST['sSearch']) ? $_POST['sSearch'] : '';
        $data['i_start_index'] = $this->input->post('iDisplayStart');
        $data['i_end_index'] = $this->input->post('iDisplayLength');
        $records_number = $this->user_model->get_team_count($data);
        $result['aaData'] = $this->user_model->get_our_team($data);

        $row = array();
        foreach ($result['aaData'] as $value) {
            $options = '';
            $record = array();
            $record[] = '<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />';
            $record[] = $value['full_name'];
            $record[] = $value['job_name'];
            $record[] = $value['publish_date'];
            $options .= '<a href="#" onclick="get_user(' . $value['user_id'] . ',this);return false;" class="btn btn-small purple" title="تعديل"><i class="icon-edit"></i></a> ';
            $options .= '<a href="#myModal2" onclick="setTarget(' . $value['user_id'] . ',this);return false;" title="حـذف" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-trash"></i></a>';
            $record[] = $options;
            array_push($row, $record);
        }
        $output = $this->createOutput(intval($_POST['sEcho']), $records_number, $row);
        echo json_encode($output);
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

    /**
     * get_user 
     * 
     * function used to get user inforamtion by calling get_user_byID
     * in model class and parsing these information to loaded view
     * 
     * @access public
     * @return load view
     */
    public function get_user() {
        $user_id = $this->input->post('user_id');
        $result = $this->user_model->get_user($user_id);
        echo json_encode($result);
    }

    /**
     * do_update_user
     * 
     * function takes user information from view page and parse 
     * it to model class to update specific record in database and return json 
     * have transaction status
     * 
     * @access public
     * @return json
     */
    public function do_update_user() {
        $this->form_validation->set_rules('full_name', 'الإسم بالكامل', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('job_name', 'المسمى الوظيفي', 'required|trim|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $errorMsg = validation_errors();
            echo json_encode(array('status' => false, 'msg' => htmlentities($errorMsg)));
        } else {
            $new_pic = $this->input->post('user_picture2');
            if ($new_pic != NULL) {
                $file_element_name = 'user_picture2';
                $imageName = $this->uploadImage($file_element_name, 'users');
                $this->generateThumb(150, 150, 'users');
            }

            $user_id = $this->input->post('user_id');
            $data['full_name'] = $this->input->post('full_name');
            $data['job_name'] = $this->input->post('job_name');
            if ($new_pic == NULL)
                $data['user_picture'] = $this->input->post('old_picture');
            else
                $data['user_picture'] = ($imageName != 'false') ? $imageName : '';

            $result = $this->user_model->update_user($user_id, $data);
            if ($result) {
                if ($new_pic != NULL) {
                    unlink('./uploads/users/' . $this->input->post('old_picture'));
                    unlink('./uploads/users/thumbs/' . $this->input->post('old_picture'));
                }
                echo json_encode(array('status' => true, 'msg' => 'تم تعديل بيانات العضو بنجاح'));
            } else {
                unlink('./uploads/users/' . $imageName);
                unlink('./uploads/users/thumbs/' . $imageName);
                echo json_encode(array('status' => false, 'msg' => htmlentities('هناك خطأ في البيانات المدخلة')));
            }
        }
    }
    
    /**
     * do_delete_user
     * 
     * function takes user id from json request and parse 
     * it to delete_user in user_model class to delete 
     * specific user from database and return transacton status
     * 
     * @access public
     * @return json
     */
    function delete_user() {
        $user_id = $this->input->post('user_id');
        $result = $this->user_model->delete_user($user_id);
        if ($result)
            echo json_encode(array('status' => true, 'msg' => "تم حذف العضو بنجاح"));
        else
            echo json_encode(array('status' => false, 'msg' => 'هناك خطأ في البيانات المدخلة'));
    }

}

//End of File