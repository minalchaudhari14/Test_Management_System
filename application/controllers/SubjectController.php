<?php

class SubjectController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SubjectModel');
    }

    public function Subject() {
           $email = $this->session->userdata('email');
        $pass = $this->session->userdata('password');
        if ($email != '' && $pass != '') {
         $this->load->view('SubjectView');
        } else {
                     redirect(base_url('loginroute'));
        }     
    
    }

    public function EditSubject($id) {
        $data = $this->SubjectModel->EditSubject($id);
        echo json_encode($data);
    }

    public function deleteSubject($id) {
        $data = array(
            'deleted' => 1
        );
        $this->SubjectModel->updateSubject($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function insertsubject() {
//     $this->form_validation->set_rules(
//        'subjectcode', 'Subject Code',
//        array(
//                'is_unique'     => 'This %s already exists.'
//                 )
//         );    
        $this->form_validation->set_rules('subjectcode', 'Subject Code', 'required|is_unique[subject.subject_code]');
        $this->form_validation->set_rules('subjectname', ' Subejct Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $result = array(
                'success' => true,
                'statusMsg' => validation_errors()
            );
        } else {
            $postdata = $this->input->post();
            $data = array(
                'subject_code' => $postdata['subjectcode'],
                'subject_name' => $postdata['subjectname']
            );

            if (empty($postdata['subjectid'])) {
                $result = $this->SubjectModel->createData2($data);
            } else {
                $data['modify_ts'] = date('y-m-d H:i');
                $result = $this->SubjectModel->updateSubject($postdata['subjectid'], $data);
            }

        }
        echo json_encode($result);
    }

    public function fetchsubjectdata() {

        $postData = $this->input->post();
        $tableResult = $this->SubjectModel->fetchsubjectdata($postData);

        echo json_encode($tableResult);
    }

    public function changeStatus() {
        $postdata = $this->input->post();
        $data = array(
            'active' => $postdata['status'],
            'subject_id' => $postdata['id']
        );
        if ($this->SubjectModel->updateSubject($postdata['id'], $data)) {
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
