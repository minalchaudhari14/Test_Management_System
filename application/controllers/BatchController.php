<?php

class BatchController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('BatchModel');
    }

    public function Batch() {
        $data['assessment_year'] = $this->BatchModel->get_Records();
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('password');
        if ($email != '' && $pass != '') {
          $this->load->view('BatchView', $data);
        } else {
                     redirect(base_url('loginroute'));
        }     
    }

    public function changeStatus() {

        $postdata = $this->input->post();
        $data = array(
            'active' => $postdata['status'],
            'batch_id' => $postdata['id']
        );
        if ($this->BatchModel->updateBatch($postdata['id'], $data)) {
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

    public function insertbatch() {
        $this->form_validation->set_rules(
                'batchcode', 'Batch Code', 
                'batchname', 'Batch Name ', 
           array(
            'is_unique' => 'This %s already exists.'
                )
        );

        $this->form_validation->set_rules('batchcode', 'Batch Code', 'required|is_unique[batch.batch_code]');
        $this->form_validation->set_rules('batchname', ' Batch Name ', 'required|is_unique[batch.batch_name]');
        $this->form_validation->set_rules('batchstrength', 'Strength', 'required');

        if ($this->form_validation->run() == FALSE) {
            $result = array(
                'success' => true,
                'statusMsg' => validation_errors()
            );
        } else {
            $postdata = $this->input->post();
            $data = array(
                'batch_code' => $postdata['batchcode'],
                'batch_name' => $postdata['batchname'],
                'max_strength' => $postdata['batchstrength'],
                'assessment_year_id' => $postdata['assessmentyear'],
            );

            if (empty($postdata['batchid'])) {
                $result = $this->BatchModel->createData1($data);
            } else {
                $data['modify_ts'] = date('y-m-d H:i');
                $result = $this->BatchModel->updateBatch($postdata['batchid'], $data);
            }
        }
        echo json_encode($result);
    }

    public function EditBatch($id) {
        $data = $this->BatchModel->EditBatch($id);
        echo json_encode($data);
    }

    public function deleteBatch($id) {
        $data = array(
            'deleted' => 1
        );
        $this->BatchModel->updateBatch($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function fetchbatchdata() {
        $postData = $this->input->post();
        $tableResult = $this->BatchModel->fetchbatchdata($postData);
        echo json_encode($tableResult);
        
    }
}

?>
