<?php

class ChangepassController extends CI_Controller {

    public function Changepass() {
        $this->load->library('form_validation');
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('password');
        if ($email != '' && $pass != '') {
            $this->load->view('ChangepassView');
        } else {
            redirect(base_url('loginroute'));
        }
    }

    public function updatePwd() {
        $this->form_validation->set_rules('currentpassword', 'Current Password', 'required|min_length[5]');
        $this->form_validation->set_rules('newpassword', 'New Password', 'required|min_length[5]');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|min_length[5]');
        if ($this->form_validation->run()) {
            $curr_password = $this->input->
                    
                    post('currentpassword');
            $new_password = $this->input->post('newpassword');
            $conf_password = $this->input->post('confirmpassword');
            $this->load->model('LoginModel');
            $user_id = 1;
            $passwd = $this->LoginModel->getcurrtPassword($user_id);
            if ($passwd->password == $curr_password) {
                if ($new_password == $conf_password) {
                    if ($query_res = $this->LoginModel->updatepassword($new_password, $user_id)) {
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
                    'fail' => true
                );
            }
        } else {
            $result = array(
                'error' => true,
                '$curr_password' => form_error('currentpassword'),
                '$new_password' => form_error('newpassword'),
                '$conf_password' => form_error('confirmpassword')
            );
        }
        echo json_encode($result);
    }

}
?>

