<?php
class Notice_model extends CI_Model{
	
	function get_data($id,$limit="",$offset=""){
	
		$this->db->select("*");
		$this->db->from("restaurant_notice a");
		$this->db->join("member b","b.member_id=a.member_id", "left");
		$this->db->join("admin c", "a.created_by=c.admin_id", "left");
		$this->db->join("wifren_criteria e", "a.restaurant_notice_id=e.notice_id", "left");
		$this->db->join("wifren_merchant d", "c.merchant_id=d.merchant_id", "left");
		$this->db->where("a.deleted","0");
		$this->db->where("a.restaurant_notice_valid_date >=", date("Y-m-d H:i:s"));
		$member=array($id, "0");
		$this->db->where_in("a.member_id",$member);
		
		$this->db->group_by("a.restaurant_notice_id");
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
		
		
		$query = $this->db->get();
		
		return $query->result_array();
	
	}
}