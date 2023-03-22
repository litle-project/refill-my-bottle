<?php

class Report_model extends CI_Model
{
	
	public function get_data($start_date='', $end_date='')
	{
		$this->db->select("*, COUNT(a.station_id) as total");
		$this->db->from('transaction a');
		if (!empty($start_date) && !empty($end_date)) {
			$this->db->where('a.created_date >=', $start_date);
			$this->db->where('a.created_date <=', $end_date);
		}
		$this->db->join('station b', 'b.station_id = a.station_id');
		$this->db->join('station_category c', 'c.category_id = b.category_id');
		$this->db->join('type_of_station d', 'd.type_id = b.type_id');
		$this->db->group_by('a.station_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_data_name($name='')
	{
		$this->db->select("*, COUNT(a.station_id) as total");
		$this->db->from('transaction a');
		if (!empty($name)) {
			$this->db->like('b.station_name', $name);
		}
		$this->db->join('station b', 'b.station_id = a.station_id');
		$this->db->join('station_category c', 'c.category_id = b.category_id');
		$this->db->join('type_of_station d', 'd.type_id = b.type_id');
		$this->db->group_by('a.station_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_data_type($type='')
	{
		$this->db->select("*, COUNT(a.station_id) as total");
		$this->db->from('transaction a');
		if (!empty($type)) {
			$this->db->where('b.type_id', $type);
		}
		$this->db->join('station b', 'b.station_id = a.station_id');
		$this->db->join('station_category c', 'c.category_id = b.category_id');
		$this->db->join('type_of_station d', 'd.type_id = b.type_id');
		$this->db->group_by('a.station_id');
		$query = $this->db->get();
		return $query->result_array();
	}
}