<?php
class StudDocPageController extends CI_Controller
{
public function __construct()
{
parent::__construct();
$this->load->model('AddStudDocModel');
$this->load->library('form_validation','upload');
}

public function StudDocPage()
{
$this->load->view('stud_doc_view_page');
}

private function documentUploadConfig(){
$config = array();
// $config['upload_path'] = UPLOAD_FILE_BASE_LOCATION;
$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).PROFILE_FILE_BASE_LOCATION;
$config['allowed_types'] = ALLOWED_TYPES;
$config['max_size'] = IMAGE_MAX_SIZE;
$config['encrypt_name'] = TRUE;
$config['remove_spaces'] = TRUE;
return $config;
}

public function EditDoc($id) {
$data['studentName'] = $this->AddStudDocModel->EditDoc($id);
$data['studentDocName'] = $this->AddStudDocModel->getDoc();
$this->load->view('stud_doc_view_page', $data );
}

public function studDocValid()
{
$this->form_validation->set_rules('student_doc_name', 'Document', 'required|is_unique[student_document.student_doc_name]');
if ($this->form_validation->run() == FALSE) {
$result = array (
'success' => true,
'statusMsg' => validation_errors()
);
} else {
$postdata=$this->input->post();
$data = array(
'student_id'=>$postdata['student_id'],
'student_doc_name'=>$postdata['student_doc_name']
);
$this->load->library('upload', $this->documentUploadConfig());
$this->upload->initialize($this->documentUploadConfig());
if($this->upload->do_upload('document'))
{
$fileData = $this->upload->data();
$actual_filename = PROFILE_FILE_BASE_LOCATION . $fileData['file_name'];
} else {
$actual_filename = "";
}
$data['student_document_path']=$actual_filename;
if($this->AddStudDocModel->studDocValid($data))
$result = array (
'success' => true,
'statusMsg' => "Document Added Successfully!"
);
}
echo json_encode($result);
}
}
?>



