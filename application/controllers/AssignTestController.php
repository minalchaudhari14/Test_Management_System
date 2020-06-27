<?php

class AssignTestController extends CI_Controller
{
      public function __construct() {
        parent::__construct();
        $this->load->model('AssignTestModel');
    }
    public function AssignTest()
    {
        $this->load->view('AssignTestView');
    }
     public function InsertAssignData() {
         
            $postdata = $this->input->post();
            
            $data = array(
               'batch_id' => $postdata['batch_id'],
               'test_id' => $postdata['lastInsertId'],
             
            );

   if (empty($postdata['test_id'])) {
            $result = $this->AssignTestModel->InsertAssignData($data);
        } else {
            $dataAssignEdit = array(
               'batch_id' => $postdata['batch_id'],
               'test_id' => $postdata['test_id'],
            );
            $result = $this->AssignTestModel->InsertAssignData($dataAssignEdit);
            $result = $this->AssignTestModel->editAssignTest($postdata['test_id'],$dataAssignEdit);
        }
        if ($result) {
            if (empty($postdata['test_id'])) {
                $statusMsg = "Test Assign Successfully..";
            } else {
                $statusMsg = "Test Assigned Updated!";
            }
                $result = array(
                    'success' => true,
                    'statusMsg' => "$statusMsg"
                );
            } else {
                $result = array(
                    'success' => false,
                    'statusMsg' => "Something went wrong."
                );
            }
        echo json_encode($result);
    }
     public function getAssign() {
        $postData = $this->input->post();
        $tableResult = $this->AssignTestModel->AssignTest($postData);
        echo json_encode($tableResult);
    }
    public function editAssign($test_id) {
//     $checkedCheckboxes = ("[name='batch_id[]']:checked").val(value.batch_id);
       $data['TestData'] = $this->AssignTestModel->getTestDataById($test_id);
       $this->load->view('AssignTestView', $data);
    }
}
?>

