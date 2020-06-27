<?php

class SubjectModel extends CI_Model {

    var $table = 'subject';

    public function createData2($data) {
        if ($query = $this->db->insert('subject', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function EditSubject($id) {
        $query = $this->db->where('subject_id', $id)->get('subject')->result_array();
        return $query;
    }

    public function updateSubject($id, $data) {
        $this->db->where('subject_id', $id);
        if ($this->db->update('subject', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function fetchsubjectdata($postData = null) {
        $fieldNamesArr = array(
            'subject_code',
            'subject_name'
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
            $searchQuery = " (
                   subject_code like '%" . $searchValue . "%' or 
                   subject_name like '%" . $searchValue . "%'  ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->where('deleted', 0);
        $records = $this->db->get('subject')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('deleted', 0);
        $records = $this->db->get('subject')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('deleted', 0);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);

        $records = $this->db->get('subject')->result();

        $tableResult = array();

        foreach ($records as $row) {
            $data = array();
            $data[] = '<center><button type="button" class="btn btn-primary" onclick="EditSubject(' . $row->subject_id . ');">'
                    . '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></center>';
            $data[] = $row->subject_code;
            $data[] = $row->subject_name;
             $checked = ($row->active == 1) ? 'checked' : '';
            $data[] = '<center>
                                 <input id="kv-toggle-demo" type="checkbox" '.$checked.' data-toggle="toggle" data-size="sm"
                             data-on="Active" data-off="Deactive" data-onstyle="success" 
                             data-offstyle="warning" $checked onchange="changeStatus(' . $row->subject_id . ',' . $row->active . ')">     
                            </td></a></center>';
            $data[] = '<center><button type="button" class="btn btn-primary" data-dismiss="modal"  onclick="deleteSubject(' . $row->subject_id . ')">'
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


