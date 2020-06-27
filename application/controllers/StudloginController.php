<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StudloginController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LoginModel');
        $this->load->helper('cookie');
    }

    public function Studlogin() {
        $this->load->view('student_login_view');
    }

 
    public function StudResetPass() {
        $this->load->view('Reset_Password_view');
    }

    public function validation() {

        $this->form_validation->set_rules('inputEmail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('inputPassword', 'Password', 'required|min_length[5]');

        if ($this->form_validation->run()) {
            $postdata = $this->input->post();
            $emailID = $this->input->post('inputEmail');
            $pass = $this->input->post('inputPassword');
            $remember = $this->input->post('remember');

            $data = array(
                'email' => $postdata['inputEmail'],
                'password' => md5($postdata['inputPassword']),
            );
            $query_res = $this->LoginModel->login($data);
            
            if ($query_res) {
                if (!empty($remember)) {
                    $this->input->set_cookie('emailid', $data['email'], time() + (60 * 1));
                    $this->input->set_cookie('pass', $pass, time() + (60 * 1));
                    $this->session->set_userdata(array(
                     'email' => $emailID,
                     'password' =>$pass
                         ));
                } else {
                    delete_cookie('emailid');
                    delete_cookie('pass');
                    $this->session->set_userdata(array(
                     'email' => $emailID,
                     'password' =>$pass
                         ));
                }
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
                'error' => true,
                'email_error' => form_error('inputEmail'),
                'pass_error' => form_error('inputPassword')
            );
        }
        echo json_encode($result);
    }
    public function logout() {
        // $this->session->unset_userdata('uid');
        $this->session->sess_destroy();
        return redirect('loginroute');
    }
 }

?>
