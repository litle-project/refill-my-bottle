<?php

class Station_model extends CI_Model
{
	
	function __construct()
	{
		
	}

	function get_data($id='')
	{
		$this->db->select("*");
		$this->db->from("station a");
		if (!empty($id)) {
			$this->db->where("a.station_id", $id);
		}
		$this->db->join("log_refill b", "b.station_id = a.station_id");
		// $this->db->join("station_category  c", "c.category_id = a.category_id");
		$this->db->group_by("b.station_id");
		$this->db->where("a.status", "1");
		$query = $this->db->get();
		return $query->result_array();
	}
}