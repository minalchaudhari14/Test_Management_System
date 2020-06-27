<?php

class TestCreationModel extends CI_Model {

    public function TestCreation($postData = null) {
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
        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (test_name like '%" . $searchValue . "%' or 
	            qset_code like '%" . $searchValue . "%' or 
                        duration like '%" . $searchValue . "%' or 
                       out_of_mark like '%" . $searchValue . "%' 
	              ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        
        $records = $this->db->get('view_testcreation')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        
        $records = $this->db->get('view_testcreation')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
       
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('view_testcreation')->result();

        $tableResult = array();

        foreach ($records as $row) {
            $data = array();
            $data[] = '<a href="' . base_url() . 'edit-test/' . $row->test_id . '" class="btn btn-primary">'
                    . '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
            $data[] = $row->test_name;
            $data[] = $row->qset_code;
            $data[] = $row->duration;
            $data[] = $row->out_of_mark;
            $data[] = (!empty($row->publish_id)) ? "Publish SuccessFully":"Pending..";
            $data[] = (!empty($row->assign_id)) ? "Assigned":"Pending..";
           $checked = ($row->active == 1) ? 'checked' : '';
            $data[] = '<center><input id="kv-toggle-demo" type="checkbox" value=1 '.$checked.' data-toggle="toggle" data-size="sm"
                             data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="warning" $checked onchange="changeStatus(' . $row->test_id . ',' . $row->active . ')">     
                            </td></center>';
             $data[] = '<center><td><buttton type="button" class="btn btn-primary remove-item" onclick="deleteTest(' . $row->test_id . ');">'
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

}

?>
