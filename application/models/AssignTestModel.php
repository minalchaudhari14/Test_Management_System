<?php

class AssignTestModel extends CI_Model {

    public function InsertAssignData($data) {
        if ($this->db->insert('assign_test', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function AssignTest($postData = null) {
        $fieldNamesArr = array(
            'batch_code',
            'batch_name'
        );

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        ## Get the actual column name for sorting
//        $columnName = $fieldNamesArr[$columnName];

        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (batch_code like '%" . $searchValue . "%' or 
	            		batch_name like '%" . $searchValue . "%') ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
//                $this->db->where_in('batch_id',$postData['query']);
        $records = $this->db->get('batch')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
//        $this->db->where_in('batch_id',$postData['query']);
        $records = $this->db->get('batch')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
//        $this->db->where_in('batch_id',$postData['query']);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('batch')->result();

        $tableResult = array();

        foreach ($records as $row) {
            $data = array();
//            $checked = ($row->batch_id == $query) ? 'checked' : '';
            $data[] = '<input type="checkbox" name="batch_id[]"   value="' . $row->batch_id . '"><input type="hidden" value="' . $row->batch_id . '">';
            $data[] = $row->batch_code;
            $data[] = $row->batch_name;
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

    public function getTestDataById($test_id) {
        $query = $this->db->select('assign_test.batch_id')
                ->from('assign_test')
                ->where('test_id', $test_id);
//        $this->AssignTest('$query');
        return $query;
    }

    public function editAssignTest($test_id, $data) {
        $this->db->where('test_id', $test_id);
        if ($this->db->update('assign_test', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>