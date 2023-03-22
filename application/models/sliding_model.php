<?php 
class Sliding_model extends CI_Model {
	
	function get_data($id="")
	{
		
		$this->db->select("*");
		$this->db->from("sliding a");
		
		$this->db->where("a.deleted","0");
		
		if($id!=""){
			$this->db->where("a.sliding_id",$id);
		
		}
		
		$this->db->order_by("a.sliding_id","desc");
		$query=$this->db->get();

		
		return $query->result_array();
		
	}
	
}
