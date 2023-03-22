<?php

class Landing extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		// $this->load->model('blog_model');
	}

	public function station($id='')
	{
		$data['title']	= "Manage Event";
		$data['page']	= "event/master/view";
		$data['data']	= $this->global_model->get_data_join("*","event_master a","where a.status='1'","left join event_category as b on b.category_id = a.category_id")->result_array();
		// print_r($data['data']); die();

		$this->load->view('admin', $data);
	}
}