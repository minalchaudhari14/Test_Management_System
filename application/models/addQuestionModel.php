<?php

class addQuestionModel extends CI_Model {

    public function addque($data) {
        if ($this->db->insert('question_bank', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function addmatchpair($data) {
        if ($this->db->insert('question_bank', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function addsequencetype($data) {
        if ($this->db->insert('question_bank', $data)) {
            return true;
        } else {
            return false;
        }
    }
 


    function get_subjectname() {
        $result = $this->db->select('subject_id, subject_name')->get('subject')->result_array();

        $subject_name = array();
        foreach ($result as $r) {
            $subject_name[$r['subject_name']] = $r['subject_name'];
        }

        return $subject_name;
    }

    function get_levelname() {
        $result = $this->db->select('difficulty_level_id, difficulty_level_name')->get('difficulty_level')->result_array();

        $difficulty_level_name = array();
        foreach ($result as $r) {
            $difficulty_level_name[$r['difficulty_level_name']] = $r['difficulty_level_name'];
        }

        return $difficulty_level_name;
    }


    function get_level() {
        $result = $this->db->select('difficulty_level_id, difficulty_level_name')->get('difficulty_level')->result_array();

        $difficulty_level_name = array();
        foreach ($result as $r) {
            $difficulty_level_name[$r['difficulty_level_id']] = $r['difficulty_level_name'];
        }

        return $difficulty_level_name;
    }

// function get_level1() {
//         $result = $this->db->select('difficulty_level_id, difficulty_level_name')->get('difficulty_level')->result_array();

//         $difficulty_level_id = array();
//         foreach ($result as $r) {
//             $difficulty_level_id[$r['difficulty_level_id']] = $r['difficulty_level_id'];
//         }

//           return implode( $difficulty_level_id);
//     }
    function get_subject() {
        $result = $this->db->select('subject_id, subject_name')->get('subject')->result_array();

        $subject_name = array();
        foreach ($result as $r) {
            $subject_name[$r['subject_id']] = $r['subject_name'];
        }

        return $subject_name;
    }
   

    function get_descriptionname() {
        $result = $this->db->select('type_of_question_id,description')->get('type_of_question')->result_array();

        $description = array();

        foreach ($result as $r) {
            $description[$r['description']] = $r['description'];
        }

        return $description;
    }

    function get_description() {
        $result = $this->db->select('type_of_question_id,description')->get('type_of_question')->result_array();

        $description = array();

        foreach ($result as $r) {
            $description[$r['type_of_question_id']] = $r['description'];
        }

        return $description;
    }

    function get_description1() {
        $result = $this->db->select('type_of_question_id ,description')->get('type_of_question')->result_array();

        $type_of_question_id = array();

        foreach ($result as $r) {
            $type_of_question_id[$r['type_of_question_id']] = $r['type_of_question_id'];
        }
        return implode($type_of_question_id);
    }

    public function EditQuestion($id) {
        $query = $this->db->where('question_id', $id)->get('question_bank')->result_array();
        return $query;
    }

    public function updateQuestion($id, $data) {
        $this->db->where('question_id', $id);
        if ($this->db->update('question_bank', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function QuesBank($postData = null) {

        $fieldNamesArr = array(
            'question',
            'options_for_each_question',
            'correct_answer',
            'mark_for_question',
            'negative_mark_for_question',
            'difficulty_level_name',
            'subject_name',
            'description',
            'time_duration'
        );


        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value'];
        $difficulty_level_name = $postData['difficulty_level_name'];
        $subject_name = $postData['subject_name'];
        $description = $postData['description'];
        // Search value
        ## Get the actual column name for sorting
        $columnName = $fieldNamesArr[$columnName];

        # Search 
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $search_arr[] = "(question like '%" . $searchValue . "%' or
            q3.difficulty_level_name like '%" . $searchValue . "%' or 
            q2.subject_name like '%" . $searchValue . "%' or
         q1.description like '%" . $searchValue . "%')";
        }
        if ($difficulty_level_name != '') {
            $search_arr[] = "difficulty_level_name='" . $difficulty_level_name . "' ";
        }
        if ($subject_name != '') {
            $search_arr[] = "subject_name='" . $subject_name . "' ";
        }
        if ($description != '') {
            $search_arr[] = "description ='" . $description . "' ";
        }
        if (count($search_arr) > 0) {
            $searchQuery = implode(" and ", $search_arr);
        }



        ## Total number of records without filtering
        $this->db->select('count(*)
 as allcount');
        $this->db->where('question_bank.deleted', 0);
        $this->db->join('difficulty_level as q3', 'q3.difficulty_level_id=question_bank.difficulty_level_id', 'left');
        $this->db->join('subject as q2', 'q2.subject_id=question_bank.subject_id', 'left');
        $this->db->join('type_of_question as q1', 'q1.type_of_question_id=question_bank.type_of_question_id', 'left');
        $records = $this->db->get('question_bank')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*)
 as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('question_bank.deleted', 0);
        $this->db->join('difficulty_level as q3', 'q3.difficulty_level_id=question_bank.difficulty_level_id', 'left');
        $this->db->join('subject as q2', 'q2.subject_id=question_bank.subject_id', 'left');
        $this->db->join('type_of_question as q1', 'q1.type_of_question_id=question_bank.type_of_question_id', 'left');
        $records = $this->db->get('question_bank')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('question_bank.deleted', 0);
        $this->db->join('difficulty_level as q3', 'q3.difficulty_level_id=question_bank.difficulty_level_id', 'left');
        $this->db->join('subject as q2', 'q2.subject_id=question_bank.subject_id', 'left');
        $this->db->join('type_of_question as q1', 'q1.type_of_question_id=question_bank.type_of_question_id', 'left');
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('question_bank')->result();

        $str = $this->db->last_query();
        $tableResult = array();

        foreach ($records as $row) {
            $data = array();
            $data[] = $row->question;
            $data[] = $row->options_for_each_question;
            $data[] = $row->correct_answer;
            $data[] = $row->mark_for_question;
            $data[] = $row->negative_mark_for_question;
            $data[] = $row->difficulty_level_name;
            $data[] = $row->subject_name;
            $data[] = $row->description;
            $data[] = $row->time_duration;
            $data[] = '<center><td><buttton type="button" class="btn btn-primary remove-item" onclick="deleteQuestion(' . $row->question_id . ');">'
                    . '<i class="fa fa-trash" aria-hidden="true"></i></button></button></td></center>'
                    . '';
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
      function get_subjectid(){
        $result = $this -> db -> select('subject_id,subject_name')
                -> get('subject') -> result_array(); 
        return $result;
    }
       function get_levelid(){
        $result = $this -> db -> select('difficulty_level_id,difficulty_level_name')
                -> get('difficulty_level') -> result_array(); 
        return $result;
    }

}

?>