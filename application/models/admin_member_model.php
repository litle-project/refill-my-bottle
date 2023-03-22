<?php
class Admin_member_model extends CI_Model {
	
	function get_data($id){
		$this->db->select("*");
		$this->db->from("member a");
	//	$this->db->join("city b","b.city_id = a.city_id","left");		
	//	$this->db->join("country c","c.country_id = a.country_id","left");
		$this->db->where("a.member_id", $id);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
}