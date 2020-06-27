<?php

class AddNewTestController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AddTestModel');
        $this->load->model('QsetModel');
        $this->load->model('PublishTestModel');
        $this->load->library('form_validation');
    }

    public function AddNewTest() {
        $data['course_name'] = $this->AddTestModel->get_course();
        $data['subject_name'] = $this->AddTestModel->get_subject();
        $this->load->view('AddNewTestView', $data);
    }

    public function createTest() {
        $postdata = $this->input->post();
        $data = array(
            'test_name' => $postdata['testName'],
            'duration' => $postdata['duration'],
            'out_of_mark' => $postdata['totalmark'],
            'qset_id' => $postdata['qset_id'],
            'course_id'=>$postdata['selectCourse']
        );

        if (empty($postdata['test_id'])) {
            $result = $this->AddTestModel->createTest($data);
            $lastinsertId = $this->db->insert_id();
        } else {
            $data['modify_by'] = date('y-m-d H:i');
            $result = $this->AddTestModel->editTest($postdata['test_id'], $data);
        }

        if ($result) {
            if (empty($postdata['test_id'])) {
                $statusMsg = "Test Added !";
            } else {
                $statusMsg = "Test info Updated!";
            }

            $result = array(
                'success' => true,
                'statusMsg' => $statusMsg,
                'lastInsetTestId' => (!empty($lastinsertId)) ? $lastinsertId : ""
            );
        } else {
            $result = array(
                'success' => false,
                'statusMsg' => "Something went wrong."
            );
        }
        echo json_encode($result);
    }

//************************code for Dual select*************
    public function MapSet() {
        $postdata=$this->input->post();
        $data['qset_code'] = $this->QsetModel->get_code($postdata);
        $this->load->view('AddSetView', $data);
    }

//****************Code For Update Data******************
    public function editTest($test_id) {
        $data['TestData'] = $this->AddTestModel->getTestDataById($test_id);
        $data['course_name'] = $this->AddTestModel->get_course();
        $data['subject_name'] = $this->AddTestModel->get_subject();
        $this->load->view('AddNewTestView', $data);
    }

    //*************Code for Delete Test***************

      public function EditTestafterdelete($id) {
        $data = $this->AddTestModel->EditTestafterdelete($id);
        echo json_encode($data);
    }

    public function deleteTest($id) {
        $data = array(
            'delete' => 1
        );
        $this->AddTestModel->updateTest($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    //*********************Code for Status**************
    public function changeStatus() {

        $postdata = $this->input->post();
        $data = array(
            'active' => $postdata['status'],
            'test_id' => $postdata['id']
        );
        if ($this->AddTestModel->editTest($postdata['id'], $data)) {
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

    //************************code for qset display***************
    public function editset($test_id) {
        $data['TestData'] = $this->AddTestModel->getTestDataById($test_id);
        $data['qset_code'] = $this->QsetModel->get_code();
        $this->load->view('AddSetView', $data);
    }

}
?>

