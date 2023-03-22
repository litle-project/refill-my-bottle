<?php

class Station_category extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		$this->load->model('Aktiviti_log_model');
		
	}

	public function index($id='')
	{
		$data['title']	= "Manage Category";
		$data['page'] 	= "station_category/view";
		$data['data']	= $this->global_model->get_data("*","station_category","where status='1'")->result_array();

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

			$action="Add New Station Category " .$post['category_name'];
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

			$input['category_name'] 		= $post['category_name'];
			$input['category_desc']			= $post['category_desc'];
			$input['status']				= "1";
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['created_date']			= date("Y-m-d");
			$input['update_by']				= $this->session->userdata("admin_id");

			
        	// echo "<pre>"; print_r($input); die();
			$this->db->where("category_id", $id);
			$this->db->update("station_category", $input);

			$action="Edit Station Category " .$post['category_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('station_category');
		}

		$data['title']	= "Edit Category Station";
		$data['page'] 	= "station_category/edit";
		$data['data']	= $this->global_model->get_data("*","station_category","where category_id='".$id."'")->result_array();

		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'category_id', 'station_category');

		$action="Delete Station Category With Id " .$id;
        $this->Aktiviti_log_model->create($action);
		
		redirect("station_category");
	}

}