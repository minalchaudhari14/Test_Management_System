<?php
class QsetController extends CI_Controller{ 
    public function __construct() {
        parent::__construct();
        $this->load->model('QsetModel');
         $this->load->model('AddTestModel');
        $this->load->library('form_validation');
    }
    public function QuestionSet()
    {
        $this->load->view('QuestionSetView');
    }
    public function Queset() {
        $postData = $this->input->post();
        $tableResult = $this->QsetModel->QuestionSet($postData);
        echo json_encode($tableResult);
    }
     public function editQuestionSet($test_id) {
       $data['TestData'] = $this->AddTestModel->getTestDataById($test_id);
       $data['qset_code'] = $this->QsetModel->get_code();
       $this->load->view('AddSetView', $data);
    }
    public function Editset($id) {
        $data = $this->QsetModel->Editset($id);
        echo json_encode($data);
    }

    public function deleteQuesset($id) {
        $data = array(
            'delete' => 1
        );
        $this->QsetModel->updateset($id, $data);
        echo json_encode(array("status" => TRUE));
    }
    public function changeStatus() {

        $postdata = $this->input->post();
        $data = array(
            'active' => $postdata['status'],
            'qset_id' => $postdata['id']
        );
        if ($this->QsetModel->updateset($postdata['id'], $data)) {
            $result = array(
                'success' => true
            );
        } else {
            $result = array(
                'success' => false,
                'statusMsg' => "Something went wrong."
            );
        }
        echo json_encode($result);
    }
}
?>


       