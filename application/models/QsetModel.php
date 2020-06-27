<?php

class QsetModel extends CI_Model {

    public function QuestionSet($postData = null) {
        $fieldNamesArr = array(
            'qset_id',
            'qset_code',
            'total_no_of_question' 
        );
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        ## Get the actual column name for sorting
        $columnName = $fieldNamesArr[$columnName];

        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (qset_id like '%" . $searchValue . "%' or 
	            qset_code like '%" . $searchValue . "%' or 		
	            total_no_of_question like '%" . $searchValue . "%') ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
           $this->db->where('delete', 0);
        $records = $this->db->get('question_set')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
           $this->db->where('delete', 0);

        $records = $this->db->get('question_set')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
           $this->db->where('delete', 0);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('question_set')->result();

        $tableResult = array();

        foreach ($records as $row) {
            $data = array();
            $data[] = $row->qset_id;
            $data[] = $row->qset_code;
            $data[] = $row->total_no_of_question;
            $checked = ($row->active == 1) ? 'checked' : '';
            $data[] = '<center><input id="kv-toggle-demo" type="checkbox" value=1 '.$checked.' data-toggle="toggle" data-size="sm"
                             data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="warning" $checked onchange="changeStatus(' . $row->qset_id . ',' . $row->active . ')">     
                            </td></center>';
            $data[] = '<center><td><buttton type="button" class="btn btn-primary remove-item" onclick="deleteQuesset(' . $row->qset_id . ');">'
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
//*************Code for Dual select Box Display*************************
    function get_code($postdata=null) { 
        $result = $this -> db -> select('qset_id,qset_code,total_no_of_question')
//                -> where_in('course_id',$postdata['courseIds'])
                -> get('question_set') -> result_array();
//    print_r($this->db->last_query());
//    die();
        return $result;
    } 

//************code for delete Set************************
    public function Editset($id) {
        $query = $this->db->where('qset_id', $id)->get('question_set')->result_array();
        return $query;
    }
    public function updateset($id, $data) {
        $this->db->where('qset_id', $id);
        if ($this->db->update('question_set', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
  
}
?>
