<?php

class QuesBankController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('addQuestionModel');
    }

    public function QuesBank() {
        $data['subject_name'] = $this->addQuestionModel->get_subjectname();
        $data['difficulty_level_name'] = $this->addQuestionModel->get_levelname();
        $data['description'] = $this->addQuestionModel->get_descriptionname();
        $this->load->view('QuesBankView', $data);
    }

    public function QuesBank1() {

        // POST data
        $postData = $this->input->post();

        // Get data
        $tableResult = $this->addQuestionModel->QuesBank($postData);

        echo json_encode($tableResult);
    }

    public function EditQuestion($id) {
        $data = $this->addQuestionModel->EditQuestion($id);
        echo json_encode($data);
    }

    public function deleteQuestion($id) {
        $data = array(
            'deleted' => 1
        );
        $this->addQuestionModel->updateQuestion($id, $data);
        echo json_encode(array("status" => TRUE));
    }

}

?>
