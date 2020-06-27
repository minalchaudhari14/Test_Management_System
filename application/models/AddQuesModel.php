<?php

class AddQuesModel extends CI_Model {
    
    public function AddSet($data, $checkedCheckboxes) {
        if ($this->db->insert('question_set', $data)) {
            $getcurrentqsetId = $this->db->insert_id();
            $questionIds = explode(',', $checkedCheckboxes['question_id']);
            $data = array();
            $a=1;
            foreach ($questionIds as $value) {
                $data[] = array(
                    'qset_id' => $getcurrentqsetId,
                    'question_id' => $value,
                    'sequence_id' => $a
                );
                $a++;
            }
            if ($this->db->insert_batch('qset_map', $data)) {
                return array(
                    'qsetId' => $getcurrentqsetId,
                    'success' => true
                );
            }
        } else {
            return array(
                'success' => false
            );
        }
    }

    public function AddQues($postData = null) {
        $fieldNamesArr = array();
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        ## Get the actual column name for sorting
        // $columnName = $fieldNamesArr[$columnName];
        $difficulty_level_name = $postData['difficulty_level_name'];
        # ## Search 
//        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (question like '%" . $searchValue . "%' or 
	            difficulty_level_name like '%" . $searchValue . "%' or 
                    mark_for_question like '%" . $searchValue . "%' or 
                    negative_mark_for_question like '%" . $searchValue . "%') ";
        }
        if ($difficulty_level_name != '') {
            $searchQuery = " difficulty_level_name='" . $difficulty_level_name . "' ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('difficulty_level as q3', 'q3.difficulty_level_id=q1.difficulty_level_id', 'inner');
        $records = $this->db->get('question_bank as q1')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('difficulty_level as q3', 'q3.difficulty_level_id=q1.difficulty_level_id', 'inner');

        $records = $this->db->get('question_bank as q1')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('difficulty_level as q3', 'q3.difficulty_level_id=q1.difficulty_level_id', 'inner');
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('question_bank as q1')->result();

        $tableResult = array();

        foreach ($records as $row) {
            $data = array();
            $data[] = '<input type="checkbox" id="selectCheckbox" name="question_id[]" value="' . $row->question_id . '"><input type="hidden" value="' . $row->question_id . '">';
            $data[] = $row->question;
            $data[] = $row->difficulty_level_name;
            $data[] = $row->mark_for_question;
            $data[] = $row->negative_mark_for_question;
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

    //*******************************Code for selected question Display************
    public function SelQues($postData=null) {
        $fieldNamesArr = array();
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName =$postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
     
        # ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (question like '%" . $searchValue . "%' or 
	            difficulty_level_name like '%" . $searchValue . "%' or 
                    mark_for_question like '%" . $searchValue . "%' or 
                    negative_mark_for_question like '%" . $searchValue . "%') ";
        }
       
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->where_in('q1.question_id',json_decode($postData['question_id']));
        $this->db->join('difficulty_level as q3', 'q3.difficulty_level_id=q1.difficulty_level_id', 'inner');
        $records = $this->db->get('question_bank as q1')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where_in('q1.question_id',json_decode($postData['question_id']));
        $this->db->join('difficulty_level as q3', 'q3.difficulty_level_id=q1.difficulty_level_id', 'inner');
        $records = $this->db->get('question_bank as q1')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where_in('q1.question_id', json_decode($postData['question_id']));
        $this->db->join('difficulty_level as q3', 'q3.difficulty_level_id=q1.difficulty_level_id', 'inner');
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('question_bank as q1')->result();
       

        $tableResult = array();

        foreach ($records as $row) {
            $data = array();
            $data[] = $row->question;
            $data[] = $row->difficulty_level_name;
            $data[] = $row->mark_for_question;
            $data[] = $row->negative_mark_for_question;
            $data[] = '<a id="question_id" onclick="removeIdfromlocal('.$row->question_id.');" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></a>';
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

    function get_level() {
        $result = $this->db->select('difficulty_level_Id,difficulty_level_name')->get('difficulty_level')->result_array();
        $selectlevel = array();
        foreach ($result as $r) {
            $selectlevel[$r['difficulty_level_name']] = $r['difficulty_level_name'];
        }
        return $selectlevel;
    }
    function get_course(){
        $result = $this -> db -> select('course_id,course_name')
                -> get('course') -> result_array(); 
        return $result;
    }
}

?>
