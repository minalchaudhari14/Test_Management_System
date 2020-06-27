<?php
class AddStudInfoModel extends CI_Model {
    var $table = 'student_info';
    //insert student
    public function Validstudent($data) {
        if ($this->db->insert('student_info', $data)) {
            return true;
        } else {
            return false;
        }
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    //update registration id and data
    public function updateStudentInfo($studentId, $data) {
        $this->db->where('student_id', $studentId);
        if ($this->db->update('student_info', $data)) {
            return true;
        } else {
            return false;
        }
    }

    //Edit Student by id
    public function EditStudent($id) {
        $query = $this->db->where('student_id', $id)->get('student_info')->row();
        return $query;
    }

    public function get_Records() {
        $result = $this->db->select('assessment_year_id,assessment_year')->get('assessment_year')->result_array();
        return $result;
    }

    public function get_student_batch() {
        $result = $this->db->select('batch_id, batch_name')->get('batch')->result_array();
        return $result;
    }

    public function insertStudentBatchMap($data) {
        if ($query = $this->db->insert_batch('student_batch_map', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function changePassword($data) {
        return $this->db->where('email', $data['email'])
                        ->update('admin_user_login', $data);
    }

    public function checkAdminData($email) {
        $result = $this->db->select("*")
                ->where('email', $email)
                ->get('admin_user_login');
        return $result->row();
    }

    public function StudDatatableInfo($postData = null) {
        $fieldNamesArr = array(
            'reg_id',
            'student_first_name',
            'email'
        );

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        $assessment_year = $postData['assessment_year'];
        ## Get the actual column name for sorting
        $columnName = $fieldNamesArr[$columnName];




        ## Search
        $searchQuery = "";
        if ($searchValue != '') {
        $searchQuery = '(
                            reg_id like "%' . $searchValue . '%" or 
                            student_first_name like "%' . $searchValue . '%" or
                            email like "%' . $searchValue . '%" 

                    )';
        }
        if ($assessment_year != '') {
            $searchQuery = "assessment_year ='" . $assessment_year . "' ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->where('deleted', 0);
        $records = $this->db->get('view_student_info')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('deleted', 0);
        $records = $this->db->get('view_student_info')->result();
        $totalRecordwithFilter = $records[0]->allcount;


        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('deleted', 0);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);

        $records = $this->db->get('view_student_info')->result();

        $tableResult = array();


        foreach ($records as $row) {
            $data = array();
            $imageUrl = (!empty($row->student_photo)) ? $row->student_photo : "www/images/profile.jpg";
            $data[] = '<img style="max-width: 80%;" src="' . base_url() . $imageUrl . '"class="img-fluid" />';
            $data[] = $row->reg_id;
            $data[] = $row->student_first_name;
            $data[] = $row->student_middle_name;
            $data[] = $row->student_last_name;
            $data[] = $row->email;
            $data[] = '<center><buttton type="button" data-studentId=" ' . $row->student_id . ' " '
                    . 'class="btn btn-primary" data-toggle="modal"  onclick="addStudentBatch(' . $row->student_id . ')">'
                    . '<i class="fa fa-map" aria-hidden="true"></i></button></center>';
            $data[] = '<center><a class="btn btn-primary" href="'. base_url().'Add/'.$row->student_id . '">'
                    . 'Add</a></center>';
            $data[] = '<center><a class="btn btn-primary" href="'. base_url().'edit/'.$row->student_id . '">'
                    . '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></center>';
            $checked = ($row->active == 1) ? 'checked' : '';
            $data[] = '<center>
                             <input type="checkbox" id="kv-toggle-demo" '.$checked.' data-toggle="toggle" data-size="sm"
                             data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="warning"  
                             onchange="changeStatus(' . $row->student_id . ',' . $row->active . ')">
                           </center>';
            $data[] = $row->mobile_no;
            $data[] = $row->alternate_mobile_no;
            $data[] = $row->gender;
            $data[] = $row->dob;
            $data[] = $row->address;
            $data[] = $row->state;
            $data[] = $row->city;
            $data[] = $row->country;
            $data[] = $row->assessment_year;
            $data[] = $row->date_of_reg;
            $data[] = $row->aadhar_card_no;
            $tableResult[] = $data;
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $tableResult
        );

        return $response;
    }

}

?>