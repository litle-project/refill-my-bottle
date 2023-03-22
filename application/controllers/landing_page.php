<?php

class Landing_page extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		// $this->load->model('blog_model');
	}

	public function event($id)
	{
		
		$this->db->select("*");
		$this->db->from("event_master a");
		$this->db->join("event_category b","a.category_id = b.category_id","left");
	 	$this->db->join("country c","a.country = c.country_id","left");
		$this->db->join("city d","a.city = d.city_id","left");
		$this->db->join("area e","a.area = e.area_id","left");		
		$this->db->where("a.event_id",$id);
			
		$query = $this->db->get()->result_array();

		$data['title']	= "Shared Event";
		$data['page']	= "LINK";
        $data['data']	= $query;

		$this->load->view('admin/share/event/view', $data);
	}

	
}
