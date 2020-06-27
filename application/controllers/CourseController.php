<?php

class CourseController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CourseModel');
    }

    public function Course() {
        $data['subject_data'] = $this->CourseModel->get_subject();
        $data['batch_data'] = $this->CourseModel->get_batch();
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('password');
        if ($email != '' && $pass != '') {
           $this->load->view('CourceView', $data);
        } else {
                     redirect(base_url('loginroute'));
        }
    }

    public function EditCourse($id) {
        $data = $this->CourseModel->EditCourse($id);
        echo json_encode($data);
    }

    public function deleteCourse($id) {
        $data = array(
            'deleted' => 1
        );
        $this->CourseModel->updateCourse($id, $data);
        echo json_encode(array("status" => TRUE));
    }

    public function changeStatus() {

        $postdata = $this->input->post();
               $data = array(
            'active' => $postdata['status'],
            'course_id' => $postdata['id']
        );

        if ($this->CourseModel->updateCourse($postdata['id'], $data)) {
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

    public function mapSubejct() {
        $postdata = $this->input->post();
        $subjectIdsArr = explode(',', $postdata['languageselect']);
        foreach ($subjectIdsArr as $row) {
            $data[] = array(
                'subject_id' => $row,
                'course_id' => $postdata['cid'],
            );
        }
        if ($this->CourseModel->insertSubjectMap($data)) {
            $result = array(
                'success' => true,
                'statusMsg' => "Map Successfully..!"
            );
        } else {
            $result = array(
                'success' => false,
                'statusMsg' => "Something went wrong."
            );
        }
        echo json_encode($result);
    }

    public function mapBatch() {
        $postdata = $this->input->post();
        $batchIdsArr = explode(',', $postdata['batchselect']);
        foreach ($batchIdsArr as $row) {
            $assessmentYearID = $this->CourseModel->getAssessmentYearByBatchId($row);
            $data[] = array(
                'course_id' => $postdata['cid'],
                'batch_id' => $row,
                'assessment_year_id' => $assessmentYearID
            );
        }
        if ($this->CourseModel->insertBatchMap($data)) {
            $result = array(
                'success' => true,
                'statusMsg' => "Map Successfully..!"
            );
        } else {
            $result = array(
                'success' => false,
                'statusMsg' => "Something went wrong."
            );
        }
        echo json_encode($result);
    }

    public function insertCourse() {
        $this->form_validation->set_rules(
                'coursecode', 'Course Code', array(
                'is_unique' => 'This %s already exists.',
                )
        );

        $this->form_validation->set_rules('coursecode', 'Course Code', 'required|is_unique[course.course_code]');
        $this->form_validation->set_rules('coursename', ' Course Name ', 'required');
        if ($this->form_validation->run() == FALSE) {
            $result = array(
                'success' => true,
                'statusMsg' => validation_errors()
            );
        } else {
            $postdata = $this->input->post();
            $data = array(
                'course_code' => $postdata['coursecode'],
                'course_name' => $postdata['coursename']
            );

            if (empty($postdata['courseid'])) {
                $result = $this->CourseModel->createData($data);
            } else {
                $data['modify_ts'] = date('y-m-d H:i');
                $result = $this->CourseModel->updateCourse($postdata['courseid'], $data);
            }
        }
        echo json_encode($result);
    }

    public function fetchDatafromDatabase() {
        $postData = $this->input->post();
        $tableResult = $this->CourseModel->fetchDatafromDatabase($postData);
        echo json_encode($tableResult);
    }

}

?>