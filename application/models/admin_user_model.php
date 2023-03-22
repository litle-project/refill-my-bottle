<?php

class Admin_user_model extends CI_Model {

	function get_user($id=""){
		$this->db->select("*");
		$this->db->from("admin as a");
		$this->db->join("user_group as b","b.user_group_id=a.user_group_id");
		$this->db->where("a.deleted","0");
		
		if($id!=""){
			$this->db->where("a.admin_id",$id);
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function get_priv(){
		$this->db->where("deleted","0");
		$query=$this->db->get("user_group");
		$data[""]="Please Select";
		foreach($query->result_array() as $row){
			$data[$row["user_group_id"]]=$row["user_group_name"];
		}
		
		return $data;
		
	}
	
	function get_rest(){
		$this->db->where("deleted","0");
		$query=$this->db->get("restaurant");
		$data[""]="Please Select";
		foreach($query->result_array() as $row){
			$data[$row["restaurant_id"]]=$row["restaurant_name"];
		}
		
		return $data;
		
	}
	
	function rest($id){
		$this->db->where("deleted","0");
		$this->db->where("restaurant_location_id",$id);
		$query=$this->db->get("restaurant_location");
		
		return $query->row_array();

		
	
	}
	
}