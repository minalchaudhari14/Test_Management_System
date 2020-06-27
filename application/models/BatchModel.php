<?php

class BatchModel extends CI_Model {
    
    public function createData1($data) {
        if ($query = $this->db->insert('batch', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function EditBatch($id) {
        $query = $this->db->where('batch_id', $id)->get('batch')->result_array();
        return $query;
    }

    public function updateBatch($id, $data) {
        $this->db->where('batch_id', $id);
        if ($this->db->update('batch', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_Records() {
        $result = $this->db->select('assessment_year_id,assessment_year')->get('assessment_year')->result_array();
        return $result;
    }

    public function fetchbatchdata($postData = null) {
        $fieldNamesArr = array(
            'batch_code',
            'batch_name',
            'max_strength',
            'assessment_year'
        );
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc  
        $searchValue = $postData['search']['value']; // Search value
        $assessment_year=$postData['assessment_year'];    
        ## Get the actual column name for sorting
        $columnName = $fieldNamesArr[$columnName];
       
        ## Search 
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (
                 batch_code  like '%" . $searchValue . "%' or 
                 batch_name like '%" . $searchValue . "%'  )";
        }
         if ($assessment_year != '') {
            $searchQuery = "assessment_year_id ='" . $assessment_year . "' ";
        } 
        
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('view_batch')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get('view_batch')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);   
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $record = $this->db->get('view_batch')->result();
        $tableResult = array();
        foreach ($record as $row) {
            $data = array();
            $data[] = '<center><button type="button" class="btn btn-primary" onclick="EditBatch(' . $row->batch_id . ',' . $row->assessment_year_id . ');">'
                    . '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></center>';
            $data[] = $row->batch_code;
            $data[] = $row->batch_name;
            $data[] = $row->max_strength;
            $data[] = $row->assessment_year;
            
            $checked = ($row->active == 1) ? 'checked' : '';
            
            $data[] = '<center><input id="kv-toggle-demo" type="checkbox"  '.$checked.' data-toggle="toggle" data-size="sm"
                             data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="warning" onchange="changeStatus(' . $row->batch_id . ',' . $row->active . ')">     
                            </td></center>';
            $data[] = '<center><button type="button"  class="btn btn-primary"  onclick="deleteBatch(' . $row->batch_id . ')">'
                    . '<i class="fa fa-trash" aria-hidden="true"></i></button></center>'
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

