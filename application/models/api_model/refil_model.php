<?php 

class Refil_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get_data($station_id="" ){
		$this->db->select("*");
		$this->db->from("station");
		if ($station_id != "") {
			$this->db->where("station_id", $station_id);
		}
		$this->db->where("status", "1");
		$query = $this->db->get();
		return $query->result_array();

	}

	function get_data_trx($member_id, $date){
		$this->db->select('*, MAX(trx_id) as transaction_id');
		$this->db->from('transaction');
		$this->db->where('member_id', $member_id);
		$this->db->like('created_date', $date);
		$this->db->limit(2);
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_data_refil($member_id, $date){
		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->where('member_id', $member_id);
		$this->db->like('created_date', $date);
		$this->db->order_by("trx_id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
}