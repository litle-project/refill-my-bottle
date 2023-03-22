<?php

class Relation extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		$this->load->model('Aktiviti_log_model');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Relation";
		$data['page'] 	= "relation/view";
		$data['data']	= $this->global_model->get_data("*","relation", "where status ='1'")->result_array();
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

			$input['relation_name'] 		= $post['relation_name'];
			$input['relation_description']	= $post['relation_description'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';


        	// echo "<pre>"; print_r($input); die();
			$this->db->insert("relation", $input);

			$action="Add New Relation ".$post['relation_name'];
			$this->Aktiviti_log_model->create($action);

			redirect('relation');
		}

		$data['title']	= "Add New Station";
		$data['page'] 	= "relation/add";
		// $data['data']	= $this->global_model->get_data("*","station_category","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();
			
			$input['relation_name'] 		= $post['relation_name'];
			$input['relation_description']	= $post['relation_description'];
			$input['created_date']			= date("Y-m-d");
			$input['update_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';

        	// echo "<pre>"; print_r($input); die();
			$this->db->where("relation_id", $id);
			$this->db->update("relation", $input);

			$action="Edit Relation ".$post['relation_name'];
			$this->Aktiviti_log_model->create($action);

			redirect('relation');
		}

		$data['title']		= "Edit New Station";
		$data['page'] 		= "relation/edit";
		$data['data']		= $this->global_model->get_data("*","relation","where relation_id='".$id."'")->result_array();

		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'relation_id', 'relation');

		$action="Delete Relation With ID ".$id;
		$this->Aktiviti_log_model->create($action);

		redirect("relation");
	}

}