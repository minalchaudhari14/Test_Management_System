<?php

class PublishTestModel extends CI_Model {

    public function displayTest($data) {
        if ($this->db->insert('publish_test', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function PublishTest($postData = null) {
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
       
        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (q1.question like '%" . $searchValue . "%' or 
	            q2.qset_code like '%" . $searchValue . "%' or 
	            q1.mark_for_question like '%" . $searchValue . "%') ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->join('question_set as q2', 'qset_map.qset_id = q2.qset_id', 'inner');
        $this->db->join('question_bank as q1', 'q1.question_id = qset_map.question_id','inner');
        $this->db->where_in('qset_map.qset_id',json_decode($postData['qset_id']));
        $records = $this->db->get('qset_map')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('question_set as q2', 'qset_map.qset_id = q2.qset_id', 'inner');
        $this->db->join('question_bank as q1', 'q1.question_id = qset_map.question_id','inner');
        $this->db->where_in('qset_map.qset_id',json_decode($postData['qset_id']));
        $records = $this->db->get('qset_map')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('q1.question,q2.qset_code,q1.mark_for_question');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->join('question_set as q2', 'qset_map.qset_id = q2.qset_id', 'inner');
        $this->db->join('question_bank as q1', 'q1.question_id = qset_map.question_id','inner');
        $this->db->where_in('qset_map.qset_id',json_decode($postData['qset_id']));
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('qset_map')->result();

        $tableResult = array();

        foreach ($records as $row) {
            $data = array();
            $data[] = $row->question;
            $data[] = $row->qset_code;
            $data[] = $row->mark_for_question;
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
//**********************Update Publish Test Records******************
   public function getpublishUpdateById($test_id) {
        $query = $this->db->select('*')
                        ->from('publish_test')
                        ->where('test_id', $test_id)
                        ->get()->row();
        return $query;
    }

    public function editPublishTest($test_id, $data) {
        $this->db->where('test_id', $test_id);
        if ($this->db->update('publish_test', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
?>
        








