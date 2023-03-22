<?php

class Suggest_model extends CI_Model
{
	
	public function get_data()
	{
		$this->db->select('*');
		$this->db->from('station_suggested a');
		$this->db->join('member b', 'b.member_id = a.member_id', 'left');
		$this->db->join('member_profile c', 'c.member_id = b.member_id', 'left');
		$this->db->join('type_of_station d', 'd.type_id = a.type_id', 'left');
		$this->db->join('station_category e', 'e.category_id = a.category_id', 'left');
		$this->db->where('a.status', '1');
		$this->db->group_by('a.suggest_id');
		$this->db->order_by('a.created_date', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
}