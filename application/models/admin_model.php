<?php

class Admin_model extends CI_Model {

	function menu()
	{
		$sql="select * from group_menu WHERE deleted='0' ";
		$query=$this->db->query($sql);
		
		foreach($query->result_array() as $row){
			$sql2="select * from menu where deleted='0' AND group_menu_id='".$row['group_menu_id']."'";
			$query2=$this->db->query($sql2);
			$row["menu"]=$query2->result_array();
			$all[]=$row;
		}
		
		return $all;
		
		//return $query->result_array();
	}

	function get_site($id="")
	{
		
		$this->db->select("*");
		$this->db->from("content a");
		
		$this->db->where("a.deleted","0");
		
		if($id!=""){
			$this->db->where("a.content_id",$id);
		
		}
		
		$this->db->order_by("a.content_id","desc");
		$query=$this->db->get();

		
		return $query->result_array();
		
	}
	
	function menu_privileges(){
	
		$sql="select * from group_menu WHERE deleted='0' ";
		$query=$this->db->query($sql);
		
		foreach($query->result_array() as $row){
			$sql2="select * from menu_privileges as a 
			INNER JOIN menu as b ON b.menu_id=a.menu_id
			where a.deleted='0' AND b.group_menu_id='".$row['group_menu_id']."'";
			$query2 = $this->db->query($sql2);
			$row["menu"]=$query2->result_array();
			$all[]=$row;
		}
		
		return $all;
	}
	
	function user_group($id=""){
		$sql="select * from user_group where deleted='0'";
		
		if($id!=""){
			$sql .=" AND user_group_id='".$id."'";
		}
		
		$query=$this->db->query($sql);
		
		return $query->result_array();
	}
	
	function menu_all(){
		$sql="select * from menu where deleted='0'";
		$query=$this->db->query($sql);
		
		return $query->result_array();
	
	}
	
	function user_privileges2($id=""){
		if($id!=""){
			$this->db->where("user_group_id",$id);
		}
		$this->db->where("deleted","0");
		$query=$this->db->get("user_privileges");
		return $query->result_array();
		
	}
	
	function user_privileges($id=""){
		
		$sql="select * from group_menu WHERE deleted='0' ";
		
		
		
		$query=$this->db->query($sql);
		
		foreach($query->result_array() as $row){
			$sql2="select * from user_privileges as a 
			INNER JOIN menu as b ON b.menu_id=a.menu_id
			where a.deleted='0' AND b.group_menu_id='".$row['group_menu_id']."'";
			
			if($id!=""){
				$sql2 .=" AND a.user_group_id='".$id."'";
			}
			$query2 = $this->db->query($sql2);
			$row["menu"]=$query2->result_array();
			$all[]=$row;
		}
		
		return $all;
		
	}
	
	function cek_available($group,$id){

			$sql2="select * from user_privileges as a 
			INNER JOIN menu as b ON b.menu_id=a.menu_id
			where a.deleted='0' AND  a.user_group_id='".$group."'";
			
			if($id!=""){
				$sql2 .=" AND a.menu_id='".$id."'";
			}
			
			//$sql2 .="GROUP BY a.menu_id";
			
			$query2 = $this->db->query($sql2);
	
			
			return $query2->num_rows();

	}
	
}