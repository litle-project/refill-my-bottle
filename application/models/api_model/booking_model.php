<?php

class Booking_model extends CI_Model{
	
	function get_booking($date="",$limit="",$offset=""){
		$this->db->select("*");
		
		$this->db->from("booking a");
		//$this->db->join("restaurant_table b","b.restaurant_table_id=a.restaurant_table_id","inner");
		$this->db->join("restaurant_location c","c.restaurant_location_id=b.restaurant_location_id","inner");
		$this->db->join("restaurant d","d.restaurant_id=c.restaurant_id","inner");
		$this->db->join("member e","e.member_id=a.member_id","inner");
		$this->db->join("member_profile f","f.member_id=e.member_id","inner");
		
		if($date != ""){
			$this->db->where("a.booking_date",$date);
		}
		
		if($limit != "" || $offset!=""){
			$this->db->limit($limit,$offset);
		}
		
		
		$this->db->where("a.deleted","0");
		
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function get_history($id="",$date="",$limit="",$offset=""){
		$this->db->select("*");
		
		$this->db->from("booking a");
		//$this->db->join("restaurant_table b","b.restaurant_table_id=a.restaurant_table_id","inner");
		$this->db->join("restaurant_location c","c.restaurant_location_id=b.restaurant_location_id","inner");
		$this->db->join("restaurant d","d.restaurant_id=c.restaurant_id","inner");
		$this->db->join("member e","e.member_id=a.member_id","inner");
		$this->db->join("member_profile f","f.member_id=e.member_id","inner");
		
		if($id != ""){
			$this->db->where("a.member_id",$id);
		}
		
		if($date != ""){
			$this->db->where("a.booking_date <",$date);
		}
		
		if($limit != "" || $offset!=""){
			$this->db->limit($limit,$offset);
		}
		
		
		$this->db->where("a.deleted","0");
		
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function cek_booking($member_id,$booking_date,$booking_time,$restaurant_location_id){
		$this->db->where("member_id",$member_id);
		$this->db->where("booking_date",$booking_date);
		$this->db->where("booking_time",$booking_time);
		$this->db->where("restaurant_location_id",$restaurant_location_id);
		$this->db->where("deleted","0");
		
		$query = $this->db->get("booking");
		
		return $query->num_rows();

	}
	
	
	
	
}