<?php

class dropdowncontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('addQuestionModel');
    }

    public function dropdown() {
         $data['questionType'] = $_GET['q'];
        $data['subject_name'] = $this->addQuestionModel->get_subject();
        $data['difficulty_level_name'] = $this->addQuestionModel->get_level();
     $data['type_of_question_id'] = $this->addQuestionModel->get_description1();
        $data['description'] = $this->addQuestionModel->get_description();
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('password');
        if ($email != '' && $pass != '') {
         $this->load->view('dropdownview', $data);
        } else {
            redirect(base_url('loginroute'));
        }
       
    }

}

?> 