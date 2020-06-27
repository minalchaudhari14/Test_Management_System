<?php

class AddQuesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AddQuesModel');
        $this->load->library('form_validation');
    }

    public function AddQues() {
        $data['difficulty_level_name'] = $this->AddQuesModel->get_level();
        $data['course'] = $this->AddQuesModel->get_course();
        $this->load->view('AddQuesView', $data);
    }

    public function AddSet() {

//        $this->form_validation->set_rules('qset_code', 'qset_code', 'required|is_unique[question_set.qset_code]');
//        if ($this->form_validation->run() == FALSE) {
//            $result = array(
//                'success' => true,
//                'statusMsg' => validation_errors()
//            );
//        } else {
            $postdata = $this->input->post();
            $data = array(
                'course_id'=>$postdata['course_id'],
                'qset_code' => $postdata['qset_code'],
                'total_no_of_question' => $postdata['totalques'],
            );
           
            $checkedCheckboxes = array(
                'question_id' => $postdata['question_id'],
               
            );

            $queryResult = $this->AddQuesModel->AddSet($data, $checkedCheckboxes);
            if ($queryResult['success']) {

                $result = array(
                    'success' => true,
                    'statusMsg' => "Question set Created!",
                    'getcurrentqsetId' => (!empty($queryResult['qsetId'])) ? $queryResult['qsetId'] : ""
                );
            } else {
                $result = array(
                    'success' => false,
                    'statusMsg' => "Something went wrong."
                );
//            }
        }

        echo json_encode($result);
    }

    public function getQuestion() {
        $postData = $this->input->post();
        $tableResult = $this->AddQuesModel->AddQues($postData);
        echo json_encode($tableResult);
    }

    public function SelQues() {
        $this->load->view('AddQuesView');
    }
    // For Selected Question Display
    public function selectedQuestion() {
        $postData = $this->input->post();
        $tableResult = $this->AddQuesModel->SelQues($postData);
        
        echo json_encode($tableResult);
       
    }
}
?>
