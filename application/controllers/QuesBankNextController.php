<?php
class QuesBankNextController extends CI_Controller
{
    public function QuesBankNext()
    {
         $email = $this->session->userdata('email');
        $pass = $this->session->userdata('password');
        if ($email != '' && $pass != '') {
          $this->load->view('QuesBankNextView');
        } else {
            redirect(base_url('loginroute'));
        }
      
    }
}
?>
