<?php

class Promo_list_model extends CI_Model{

function manggil_promo($rada){
		
		$this->db->select("*");
		$this->db->from("promo_list a");
		$this->db->join("promo_detail b","a.promo_id=b.promo_id","left");
		$this->db->where("a.status","1");
       $this->db->where("a.promo_id",$rada);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	function promo_list($kunci){
		
		$this->db->select("*");
		$this->db->from("promo_list a");
		$this->db->join("station b","a.station_id=b.station_id","left");
		//$this->db->join("member_polis c","a.member_id=c.member_id","left");
		$this->db->where("a.status","1");
		$this->db->where("a.station_id",$kunci);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	

}
?>