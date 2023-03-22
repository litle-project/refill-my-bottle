<?php 
class Login_admin_model extends CI_Model {
	
	function login_check($data)
	{
	
		$user=$data["username"];
		$pass=$data["password"];

		$this->db->where("deleted","0");
		$this->db->where("admin_username",$user);
		$this->db->where("admin_password",md5($pass));
		$query=$this->db->get("admin");
		
		
		return $query;
		
		
	}
	
	function get_config($data="")
	{
		if(!empty($data)){
			$user=$data["username"];
			$pass=$data["password"];			
		
			$this->db->where("username",$user);
			$this->db->where("password",md5($pass));
		}
		$this->db->where("config_id","1");
		$query=$this->db->get("config");
		
		
		return $query;
		
		
	}
	
}
