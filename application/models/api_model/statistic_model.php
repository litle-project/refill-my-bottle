<?php

class Statistic_model extends CI_Model
{
	
	function get_data($startDate, $endDate, $member_id)
	{
		$this->db->select('*');
		$this->db->from('bottle_saved');
		if($startDate != "" and $endDate!=""){
			$this->db->where("created_date BETWEEN '" . $startDate . " 00:00:00' AND '" . $endDate . " 23:59:59'");
		}
		$this->db->where("member_id", $member_id);
		$query = $this->db->get()->result_array();
		return $query;
	}

	function get_data_bottle($member_id)
	{
		$this->db->select("*, SUM(total_save) as bottle_saved");
		$this->db->from('bottle_saved');
		$this->db->where("member_id", $member_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_data_point($member_id)
	{
		$this->db->select("*");
		$this->db->from('point');
		$this->db->where("member_id", $member_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_data_daily($member_id)
	{
		$this->db->select("*");
		$this->db->from('member_profile a');
		$this->db->join('bottle_size b', 'b.bottle_size_id = a.bottle_size_id');
		$this->db->where("member_id", $member_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_data_refil($member_id, $date){
		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->where('member_id', $member_id);
		$this->db->like('created_date', $date);
		$query = $this->db->get();
		return $query->result_array();
	}

}