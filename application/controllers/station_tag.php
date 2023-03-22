<?php

class Station_tag extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		// $this->load->model('station_model');
	}

	public function index()
	{
		$data['title']	= "Manage Tag Station";
		$data['page'] 	= "station_tag/view";
		$data['data']	= $this->global_model->get_data("*","station_tag", "where status ='1'")->result_array();
		// $data['data']	= $this->station_model->get_data();
		// echo "<pre>"; print_r($data['data']); die();
		$this->load->view('admin', $data);
	}

	function detail($id)
	{
		$data['title']		= "Detail Station";
		$data['page'] 		= "station/detail";
		$data['data']		= $this->global_model->get_data("*","station","where station_id='".$id."'")->result_array();
		$data['category']	= $this->global_model->get_data("*","station_category", "where status ='1'")->result_array();
		// echo"<pre>"; print_r($data['category']); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			$input['tag_name'] 			= $post['tag_name'];
			$input['tag_desc'] 			= $post['tag_desc'];
			$input['created_date']		= date("Y-m-d");
			$input['created_by']		= $this->session->userdata("admin_id");
			$input['status']			= '1';

        	// echo "<pre>"; print_r($input); die();
			$this->db->insert("station_tag", $input);
			redirect('station_tag');
		}

		$data['title']	= "Add New Station Tag";
		$data['page'] 	= "station_tag/add";
		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			
			$input['tag_name'] 			= $post['tag_name'];
			$input['tag_desc'] 			= $post['tag_desc'];
			$input['created_date']		= date("Y-m-d");
			$input['created_by']		= $this->session->userdata("admin_id");
			$input['status']			= '1';

        	// echo "<pre>"; print_r($input); die();
			$this->db->where("tag_id", $id);
			$this->db->update("station_tag", $input);
			redirect('station_tag');
		}

		$data['title']		= "Edit Tag Station";
		$data['page'] 		= "station_tag/edit";
		$data['data']		= $this->global_model->get_data("*","station_tag","where tag_id='".$id."'")->result_array();
		// echo "<pre>"; print_r($data['data']); die();


		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'tag_id', 'station_tag');
		redirect("station_tag");
	}

}