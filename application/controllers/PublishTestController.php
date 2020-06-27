<?php

class PublishTestController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PublishTestModel');
    }

    public function PublishTest() {
        $this->load->view('PublishTestView');
    }

    public function displayTest() {
        $postdata = $this->input->post();
        $data = array(
            'test_id'=> $postdata['lastInsertId'],
            'start_date' => $postdata['sdate'],
            'end_date' => $postdata['edate'],
            'start_time' => $postdata['stime'],
            'end_time' => $postdata['etime']);

        if (empty($postdata['test_id'])) {
            $result = $this->PublishTestModel->displayTest($data);
        } else {
            $dataEdit = array(
            'test_id'=> $postdata['test_id'],
            'start_date' => $postdata['sdate'],
            'end_date' => $postdata['edate'],
            'start_time' => $postdata['stime'],
            'end_time' => $postdata['etime']);
            $result = $this->PublishTestModel->displayTest($dataEdit);
            $result = $this->PublishTestModel->editPublishTest($postdata['test_id'],$dataEdit);
        }

        if ($result) {
            if (empty($postdata['test_id'])) {
                $statusMsg = "Test Publish Successfully..";
            } else {
                $statusMsg = " Publish Test Updated!";
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

    public function Publishque() {
        $postData = $this->input->post();
        $tableResult = $this->PublishTestModel->PublishTest($postData);
        echo json_encode($tableResult);
    }

//***********************Update Publish Records****************
    public function editPublishTest($test_id) {
        $data['TestPublish'] = $this->PublishTestModel->getpublishUpdateById($test_id);
        $this->load->view('PublishTestView', $data);
    }

}

?>
