<?php

class Alamat_model extends CI_Model{
	
function buat_state(){
		
		$this->db->select("*");
		$this->db->from("city a");
		$this->db->join("country b","a.country_id=b.country_id","left");
		//$this->db->join("member_polis c","a.member_id=c.member_id","left");
		$this->db->where("a.status","1");
		$query = $this->db->get();
		return $query->result_array();
		
	}

function check_city(){
		
		$this->db->select("*");
		$this->db->from("area a");
		$this->db->join("city b","a.city_id=b.city_id","left");
		//$this->db->join("member_polis c","a.member_id=c.member_id","left");
		$this->db->where("a.status","1");
		$query = $this->db->get();
		return $query->result_array();
		
	}
	}
	?>