<?php

class CourseModel extends CI_Model {

    var $table = 'course';

    public function createData($data) {
        if ($query = $this->db->insert('course', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function EditCourse($id) {
        $query = $this->db->where('course_id', $id)->get('course')->result_array();
        return $query;
    }

    public function updateCourse($id, $data) {
        $this->db->where('course_id', $id);
        if ($this->db->update('course', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_subject() {
        $result = $this->db->select('subject_id, subject_name')->get('subject')->result_array();
        return $result;
    }

    public function get_batch() {
        $result = $this->db->select('batch_id, batch_name,assessment_year_id')->get('batch ')->result_array();
        return $result;
    }

    public function getAssessmentYearByBatchId($batchId) {
        $query = $this->db->select('assessment_year_id')
                        ->from('batch')
                        ->where('batch_id', $batchId)
                        ->get()->row();
        return $query->assessment_year_id;
    }

    public function insertSubjectMap($data) {
        if ($query = $this->db->insert_batch('course_subject_map1', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insertBatchMap($data) {
        if ($query = $this->db->insert_batch('course_batch_map', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function fetchDatafromDatabase($postData = null) {
        $fieldNamesArr = array(
            'course_code',
            'course_name'
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
                  course_code like '%" . $searchValue . "%' or 
                 course_name like '%" . $searchValue . "%'  ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->where('deleted', 0);
        $records = $this->db->get('course')->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('deleted', 0);
        $records = $this->db->get('course')->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $this->db->where('deleted', 0);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);

        $records = $this->db->get('course')->result();
        $tableResult = array();
//        $checked='';
        foreach ($records as $row) {
            $data = array();
            $data[] = '<center><buttton type="button" class="btn btn-primary"  onclick="EditCourse(' . $row->course_id . ');">'
                    . '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></center>';
            $data[] = $row->course_code;
            $data[] = $row->course_name;
            $data[] = '<center><buttton type="button" data-courseId=" ' . $row->course_id . ' " '
                    . 'class="btn btn-primary" data-toggle="modal"  onclick="addSubject(' . $row->course_id . ')">'
                    . '<i class="fa fa-map" aria-hidden="true"></i></button></center>';
            $data[] = '<center><buttton type="button"  class="btn btn-primary" data-toggle="modal" '
                    . 'onclick="addBatch(' . $row->course_id . ')">'
                    . '<i class="fa fa-map" aria-hidden="true"></i></button></center>';
            $checked = ($row->active == 1) ? 'checked' : '';
            $data[] = '<center>
                             <input type="checkbox" id="kv-toggle-demo" '.$checked.' data-toggle="toggle" data-size="sm"
                             data-on="Active" data-off="Deactive" data-onstyle="success" data-offstyle="warning"  
                             onchange="changeStatus(' . $row->course_id . ',' . $row->active . ')">
                           </center>';
            $data[] = '<center><td><buttton type="button" class="btn btn-primary remove-item" onclick="deleteCourse(' . $row->course_id . ');">'
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
