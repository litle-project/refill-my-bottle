<?php

class Config_model extends CI_Model {

	function get_front($id=""){
		if($id!=""){
			$this->db->where("index_id",$id);
		}
		$this->db->where("deleted","0");
		$query=$this->db->get("index");
		return $query->result_array();
		
	}
	
	
	function get_menu($id=""){
		$this->db->select("*");
		$this->db->from("menu as a");
		$this->db->join("group_menu as b","b.group_menu_id=a.group_menu_id");
		$this->db->join("menu_privileges as c","c.menu_id=a.menu_id");
		
		$this->db->where("a.deleted","0");
		
		if($id!=""){
			$this->db->where("a.menu_id",$id);
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function get_menu_group(){
		$this->db->where("deleted","0");
		$query=$this->db->get("group_menu");
		$data[""]="Please Select";
		foreach($query->result_array() as $row){
			$data[$row["group_menu_id"]]=$row["group_menu_name"];
		}
		
		return $data;
		
	}
	
	function list_menu_group($id=""){
		if($id!=""){
			$this->db->where("group_menu_id",$id);
		}
		$this->db->where("deleted","0");
		$query=$this->db->get("group_menu");
		return $query->result_array();
		
	}
}