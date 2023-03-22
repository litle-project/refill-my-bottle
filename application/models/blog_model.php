<?php

class Blog_model extends CI_Model
{
	
	function get_data($id='')
	{
		$this->db->select('*');
		$this->db->from('blog_master a');
			if (!empty($id)) {
				$this->db->where('blog_id', $id);
			}
		$this->db->join('blog_category b', 'b.category_id = a.category_id', 'left');
		$this->db->where('a.status', '1');

		$query = $this->db->get();
		return $query->result_array();
	}
}