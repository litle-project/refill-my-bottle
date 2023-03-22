<?php

class Station_type extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		$this->load->model('Aktiviti_log_model');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Type";
		$data['page'] 	= "station_type/view";
		$data['data']	= $this->global_model->get_data("*","type_of_station","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}


	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			$input['category_name'] 		= $post['category_name'];
			$input['category_desc']			= $post['category_desc'];
			$input['status']				= "1";
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['created_date']			= date("Y-m-d");
			$input['update_by']				= $this->session->userdata("admin_id");

			
        	// echo "<pre>"; print_r($input); die();
			$this->db->insert("station_category", $input);

			$action="Add New Station Type " .$post['category_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('station_category');
		}

		$data['title']	= "Add New Category Station";
		$data['page'] 	= "station_category/add";
		// $data['data']	= $this->global_model->get_data("*","station_category","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			$input['name_type'] 		= $post['name_type'];
			$input['desc_type']			= $post['desc_type'];
			$input['status']				= "1";
			$input['updated_date']			= date("Y-m-d H:i:s");
			$input['updated_by']				= $this->session->userdata("admin_id");

			
        	// echo "<pre>"; print_r($input); die();
			$this->db->where("type_id", $id);
			$this->db->update("type_of_station", $input);

			$action="Edit Station Type " .$post['name_type'];
            $this->Aktiviti_log_model->create($action);

			redirect('station_type');
		}

		$data['title']	= "Edit Type Station";
		$data['page'] 	= "station_type/edit";
		$data['data']	= $this->global_model->get_data("*","type_of_station","where type_id='".$id."'")->result_array();

		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'category_id', 'station_category');

		$action="Delete Station Type With Id" .$id;
        $this->Aktiviti_log_model->create($action);

		redirect("station_category");
	}

}