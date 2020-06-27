<?php

class forgetpassController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LoginModel');
        $this->load->helper('cookie');
        $this->load->model('AddStudInfoModel');
    }

    public function Studforgotpass() {
        $this->load->view('Forgot_Password_view');
    }

    public function StudResetPass() {
        $this->load->view('Reset_Password_view');
    }

    public function changePassword() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('newPass', 'New Password', 'required|min_length[5]');
        $this->form_validation->set_rules('confirmPass', 'Confirm Password', 'required|min_length[5]|matches[newPass]');
        if ($this->form_validation->run()) {
            $postdata = $this->input->post();
            $pass = $this->input->post('newPass');
            $email = $postdata['email'];
            $data = array(
                'email' => $postdata['email'],
                'password' => $postdata['newPass'],
            );
            $query_result['admin_data'] = $this->AddStudInfoModel->checkAdminData($email);
            if ($query_result['admin_data']) {
                $query_result = $this->AddStudInfoModel->changePassword($data);

                if ($query_result) {
                    $result = array(
                        'success' => true
                    );
                } else {
                    $result = array(
                        'fail' => true
                    );
                }
            } else {

                $result = array(
                    'fail' => true
                );
            }
        } else {
            $result = array(
                'error' => true,
                'checkEmail' => form_error('email'),
                'newPassError' => form_error('newPass'),
                'confirmPassError' => form_error('confirmPass')
            );
        }

        echo json_encode($result);
    }

}
