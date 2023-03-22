<?php

class Landing extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		// $this->load->model('blog_model');
	}

	public function station($id)
	{
		$data['title']	= "Manage Event";
		$data['page']	= "event/master/view";
		$data['rate']	= $this->global_model->get_data("*", "rating", "where station_id = '".$id."'")->result_array();
        $data['data']	= $this->global_model->get_data_join("*","station a","where a.station_id='".$id."'","left join station_category as b on b.category_id = a.category_id")->result_array();
		// print_r($data['data']); die();

		$this->load->view('admin/share/station/view', $data);
	}

	public function event($id2)
	{

		$this->db->select("*");
		$this->db->from("event_master a");
		$this->db->join("event_category b","a.category_id = b.category_id","left");
	 	$this->db->join("country c","a.country = c.country_id","left");
		$this->db->join("city d","a.city = d.city_id","left");
		$this->db->join("area e","a.area = e.area_id","left");		
		$this->db->where("a.event_id",$id2);
			
		$query = $this->db->get()->result_array();

		$data2['title']	= "Shared Event";
		$data2['page']	= "LINK";

        $data2['data']	= $query;

		$this->load->view('admin/share/event/view', $data2);
	}
}