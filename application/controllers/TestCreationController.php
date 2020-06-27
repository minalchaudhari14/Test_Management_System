<?php
class TestCreationController extends CI_Controller{
   
    public function __construct() {
        parent::__construct();
        $this->load->model('TestCreationModel');
        $this->load->library('form_validation');
    }
    
    public function TestCreation()
    {
        $this->load->view('TestCreationView');
    }
    public function Test() {
        $postData = $this->input->post();
        $tableResult = $this->TestCreationModel->TestCreation($postData);
        echo json_encode($tableResult);
    }
}
?>
