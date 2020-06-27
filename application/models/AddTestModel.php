<?php

class AddTestModel extends CI_Model {

    public function createTest($data) {
        if ($this->db->insert('test_set', $data)) {
          
            return true;
        } else {
            return false;
        }
    }

//**********Code For Dropdown List Display**********
    function get_course() {
        $result = $this->db->select('course_id,course_name')->get('course')->result_array();     
        return $result;
    }

    function get_subject() {
        $result = $this->db->select('subject_id,subject_name')->get('subject')->result_array();

        $set = array();
        foreach ($result as $r) {
            $set[$r['subject_id']] = $r['subject_name'];
        }
        return $set;
    }

//*********code for Update Test Records***********************
    public function getTestDataById($id) {
        $query = $this->db->select('*')
                        ->from('test_set')
                        ->where('test_id', $id)
                        ->get()->row();
        return $query;
    }

    public function editTest($id, $data) {
        $this->db->where('test_id', $id);
        if ($this->db->update('test_set', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

//**********************Code for Delete Test***************

       public function EditTestafterdelete($id) {
        $query = $this->db->where('test_id', $id)->get('test_set')->result_array();
        return $query;
    }
    public function updateTest($id, $data) {
        $this->db->where('test_id', $id);
        if ($this->db->update('test_set', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    

}

?>