<?php

class Shop_model extends CI_Model{

	function get_data($id='')
	{
		$this->db->select("*");
		if (!empty($id)) {
			
			$this->db->where("a.id_shop", $id);
		}
		$this->db->from("shop_list a");
		$this->db->join("shop_image b", "b.shop_id = a.id_shop", "left");
		$this->db->where("a.status", "1");
		$this->db->group_by("a.id_shop");
		$query = $this->db->get();
		return $query->result_array();
	}



}
