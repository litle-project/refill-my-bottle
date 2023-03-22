<?php

class Admin_faq_model extends CI_Model
{
	
	public function get_data($id='')
	{
		$this->db->select("*");
		$this->db->from("faq");
			if (!empty($id)) {
				$this->db->where("faq_id", $id);
			}
		$this->db->where("status", "1");

		$query = $this->db->get();
		return $query->result_array();
	}
}