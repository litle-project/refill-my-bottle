<?php

class Dashboard_model extends CI_Model {

	
	function sell_monthly($date){
		$this->db->select("COUNT('station_id') as total, b.station_id, b.station_name");
		$this->db->join('station b', 'b.station_id = a.station_id');
		$this->db->like("a.created_date", $date);
		$this->db->group_by('station_id');
		$this->db->limit(10);
		$query=$this->db->get('transaction a');
		return $query->result_array();
	}
	
}