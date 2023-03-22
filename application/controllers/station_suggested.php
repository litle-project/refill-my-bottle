<?php

class Station_suggested extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		$this->load->model('suggest_model');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Station";
		$data['page'] 	= "station_suggested/view";
		$data['data']	= $this->suggest_model->get_data();
		// $data['data']	= $this->station_model->get_data();
		// echo "<pre>"; print_r($data['data']); die();
		$this->load->view('admin', $data);
	}

	function detail($id)
	{
		$data['title']		= "Detail Suggested Station";
		$data['page'] 		= "station_suggested/detail";
		$data['data']		= $this->global_model->get_data_join("*","station_suggested a","where suggest_id='".$id."'","left join member as b on b.member_id = a.member_id left join member_profile as c on c.member_id = b.member_id left join type_of_station as d on d.type_id = a.type_id left join country as e on e.country_id = a.country_id left join city as f on f.city_id = a.city_id left join station_category as g on g.category_id = a.category_id")->result_array();
		// echo "<pre>"; print_r($data['data']); die();
		$data['image']		= $this->global_model->get_data("*","suggest_image","where suggest_id='".$id."'")->result_array();
		// echo "<pre>"; print_r($data['image']); die();
		// echo"<pre>"; print_r($data['category']); die();

		$this->load->view('admin', $data);
	}


}