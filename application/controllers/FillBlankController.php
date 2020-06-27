<?php

class FillBlankController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('addQuestionModel');
    }

    public function FillBlank() {
      $data['subject'] = $this->addQuestionModel->get_subjectid();
       $data['difficulty_level'] = $this->addQuestionModel->get_levelid();
        $data['type_of_question_id'] = $this->addQuestionModel->get_description1();
        $data['description'] = $this->addQuestionModel->get_description();
        $this->load->view('FillblankView', $data);
    }

    public function addque() {
        $this->form_validation->set_rules('Question', 'Question', 'required');
        $this->form_validation->set_rules('Answer', 'Answer', 'required');
      
        if ($this->form_validation->run() == FALSE) {
            $result = array(
                'success' => true,
                'statusMsg' => validation_errors()
            );
        } else {

            $postdata = $this->input->post();
            $data = array(
                'question' => $postdata['Question'],
                'subject_id' => $postdata['subject_name'],
                'difficulty_level_id' => $postdata['difficulty_level_name'],
                'type_of_question_id' => $postdata['description'],
                'correct_answer' => $postdata['Answer'],
                'mark_for_question' => $postdata['Marks'],
                'negative_mark_for_question' => $postdata['Nmark'],
                'time_duration' => $postdata['Time']);
            if ($this->addQuestionModel->addque($data)) {

                $result = array(
                    'success' => true,
                    'statusMsg' => "Question Added!"
                );
            } else {
                $result = array(
                    'success' => false,
                    'statusMsg' => "Something went wrong."
                );
            }
        }
        echo json_encode($result);
    }

}

?>