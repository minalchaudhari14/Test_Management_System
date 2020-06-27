<?php

class AddStudDocModel extends CI_Model {

    var $table = "student_document";

    public function studDocValid($data) {
        if ($this->db->insert('student_document', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function EditDoc($id) {
        $query = $this->db->where('student_id', $id)->get('student_info')->row();
        return $query;
    }

    public function getDoc() {
        $query = $this->db->select('student_doc_id,student_doc_name,student_document_path')->get('student_document')->row();
        return $query;
    }

    public function updateDoc($id, $data) {
        $this->db->where('student_doc_id', $id);
        if ($this->db->update('student_document', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function StudDocument($postData = null) {
        $fieldNamesArr = array(
            'student_doc_name'
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

# Search
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = '(
student_doc_name like "%' . $searchValue . '%")';
        }


## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->where('deleted', 0);
        $this->db->where('student_id', $postData['sid']);
        $records = $this->db->get('student_document')->result();
        $totalRecords = $records[0]->allcount;


## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('student_id', $postData['sid']);
        $this->db->where('deleted', 0);
        $records = $this->db->get('student_document')->result();
        $totalRecordwithFilter = $records[0]->allcount;

## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('student_id', $postData['sid']);
        $this->db->where('deleted', 0);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('student_document')->result();

        $tableResult = array();

        foreach ($records as $row) {
            $data = array();
            $data[] = $row->student_doc_name;
            $imageUrl = (!empty($row->student_document_path)) ? $row->student_document_path : "www/images/file-doc-icon-white-vector-15970651.jpg";
            $data[] = '<img style="max-width: 40%;" src="' . base_url() . $imageUrl . '"class="img-fluid" />';
            $data[] = '<center><a class="btn btn-primary" href="' . base_url() . 'deletede/' . $row->student_doc_id . '" >'
                    . '<i class="fa fa-trash" aria-hidden="true" ></i></button></center>'
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