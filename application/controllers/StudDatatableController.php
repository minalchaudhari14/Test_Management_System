<?php
class StudDatatableController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AddStudInfoModel');
	}
    public function StudDatatable()
    {
    	$data['assessment_year']=$this->AddStudInfoModel->get_Records();
    	$data['batch_data'] = $this->AddStudInfoModel->get_student_batch();
        $this->load->view('StudDatatableView',$data);
    }
    public function getStudentData()
	{
		$postData = $this->input->post();
		$tableResult = $this->AddStudInfoModel->StudDatatableInfo($postData);
		echo json_encode($tableResult);
	}   
}

?>