<?php
class Restaurant_review_model extends CI_Controller{
	
	function get_com($id,$limit="",$offset=""){
	
		$this->db->select("*");
		$this->db->from("restaurant_comment a");
		
		$this->db->join("member b","b.member_id=a.member_id");
		$this->db->join("member_profile c","c.member_id=a.member_id");
		$this->db->where("a.deleted","0");
		$this->db->where("a.restaurant_location_id",$id);
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
		$query = $this->db->get();
		
		return $query->result_array();
		
	}
	
}