<?php

class Information_model extends CI_Model{
	
function check_state($masuk){
		
		$this->db->select("*");
		$this->db->from("city a");
		$this->db->join("country b","a.country_id=b.country_id","left");
		//$this->db->join("member_polis c","a.member_id=c.member_id","left");
		 
		$this->db->where("a.status","1");
		$this->db->where("a.country_id",$masuk);
		$this->db->order_by("city_name","asc");
		$query = $this->db->get();
		return $query->result_array();
    
	}
	function check_state_cari($masuk,$manji){
		
		$this->db->select("*");
		$this->db->from("city a");
		$this->db->join("country b","a.country_id=b.country_id","left");
		//$this->db->join("member_polis c","a.member_id=c.member_id","left");
		 
		$this->db->where("a.status","1");
		$this->db->where("a.country_id",$masuk);
		$this->db->like("a.city_name",$manji);
		$this->db->order_by("a.city_name","asc");
		$query = $this->db->get();
		return $query->result_array();
    
	}
	function list_country(){
		
		$this->db->select("*");
		$this->db->from("country"); 
		$this->db->where("status","1");
		$this->db->order_by("country_name","asc");
		$query = $this->db->get();
		return $query->result_array();
	
    
	}

function list_country_say($hit){
		
		$this->db->select("*");
		$this->db->from("country"); 
		$this->db->where("status","1");
		$this->db->like("country_name",$hit);
		$this->db->order_by("country_name","asc");
		$query = $this->db->get();
		return $query->result_array();
	
    
	}

	function list_country_filter(){
		
		$this->db->select("*");
		$this->db->from("country"); 
		$this->db->where("status","1");
		$this->db->where("operate","1");
		$this->db->order_by("country_name","asc");
		$query = $this->db->get();
		return $query->result_array();
	
    
	}

function check_city($masuk2){
		
		$this->db->select("*");
		$this->db->from("area a");
		$this->db->join("city b","a.city_id=b.city_id","left");
		//$this->db->join("member_polis c","a.member_id=c.member_id","left");
		$this->db->where("a.status","1");
		$this->db->where("a.city_id",$masuk2);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	}
	?>