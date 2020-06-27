<?php
class StudDocController extends CI_Controller
{
public function __construct()
{
parent::__construct();
$this->load->model('AddStudDocModel');
$this->load->library('form_validation','upload');
}

public function StudDocument()
{
$this->load->view('student_document_view');
}


public function getStudentDocData()
{
$postData = $this->input->post();
$tableResult = $this->AddStudDocModel->StudDocument($postData);
echo json_encode($tableResult);
}


public function EditDoc($id) {
$data['studentName'] = $this->AddStudDocModel->EditDoc($id);
$data['studentDocName'] = $this->AddStudDocModel->getDoc();
$this->load->view('student_document_view', $data );
}


public function deleteDoc($id) {
$data = array(
'deleted' => 1
);
$this->AddStudDocModel->updateDoc($id, $data);
echo json_encode("Document Delete Successfully");
}

public function updateDoc($id, $data) {
$this->db->where('student_id', $id);
if ($this->db->update('student_document', $data)) {
return TRUE;
} else {
return FALSE;
}
}
}
?>