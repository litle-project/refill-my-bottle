<?php

class Information_model_plus extends CI_Model {


	function get_state($code=""){
		$this->db->select('*');
		$this->db->from("state a");
		$this->db->join("country b","a.country_id=b.country_id","left");
		if($code != ""){
			$this->db->where('a.state_id', $code);
		}
		$query = $this->db->get()->result_array();
		return $query;	
	}


}