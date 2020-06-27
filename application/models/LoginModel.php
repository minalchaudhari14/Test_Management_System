<?php
class LoginModel extends CI_Model {
    public function login($data) {
        $query = $this->db->get_where('admin_user_login',$data);
        return $query->row();
    }
    
    public function getcurrtPassword($user_id)
    {
        $query=$this->db->where(['admin_user_id'=>$user_id])
                                    ->get('admin_user_login');
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
    }
    
 public function updatepassword($new_password,$user_id){
$data=array('password' =>$new_password );
return $this->db->where(['admin_user_id'=>$user_id])
                ->update('admin_user_login',$data);
	}


    public function authorized()
   {  
       $data= $this->session->userdata(array(
          'email'=>$emailID,
         'password' => $pass
         ));  
       
   if(!empty($data))
   {
       return TRUE;
   } else {
       return FALSE;
   }
}
}

?>