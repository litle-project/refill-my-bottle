<?php

class Event_model extends CI_Model
{
	

	function get_data($date_min, $date_max, $country_id = '')
	{
		$this->db->select('*');
		$this->db->from('event_master');
		$this->db->where('start_date >=', $date_min);
		$this->db->where('start_date <=', $date_max);
		if (!empty($country_id)) {
			$this->db->where('country', $country_id);
		}
		$this->db->where('status', '1');
		$query = $this->db->get()->result_array();
		return $query;
	}
}