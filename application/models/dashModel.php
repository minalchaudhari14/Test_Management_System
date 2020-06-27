<?php
class dashModel extends CI_Model
{
    public function dash()
    {
      $query= $this->db->select("count(student_info.student_id) as number")
              ->get('student_info');
       return $query->row_array();
}
public function regRecords()
{
    $result= $this->db->select("count(*)  as num")
                             ->where ("date_of_reg >= ( curdate() - interval 10 day )")
                             ->get('student_info');
    return $result->row_array();                      
}
public function regRecords1()
{
     $result= $this->db->select("count(*)  as no")
                             ->where ("date_of_reg >= ( curdate() - interval 30 day )")
                             ->get('student_info');
    return $result->row_array();     
}
public function fetchAdminInfo()
{
    $query= $this->db->select("email as admin" )
                                ->get('admin_user_login');
                        return $query->row_array() ;
                     
}
}

?>