<?php

class DashController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashModel');
    }

    public function Dashboard() {
        $data['h'] = $this->dashModel->dash();
        $data['r'] = $this->dashModel->regRecords();
        $data['s'] = $this->dashModel->regRecords1();
        $email = $this->session->userdata('email');
        $pass = $this->session->userdata('password');
        if ($email != '' && $pass != '') {
            $this->load->view('Dashboard', $data);
        } else {
                     redirect(base_url('loginroute'));
        }
    }

}

?>
