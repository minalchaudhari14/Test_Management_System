<?php
class AddAdminLoginModel extends CI_Model
{
	public function LoginAdmin($data)
	{
		if($this->db->insert('admin_user_login', $data)) {
			return true;
		} else {
			return false;
		}
	}
}
?>