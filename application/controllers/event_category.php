<?php

class Event_category extends CI_Controller
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
		$data['page']	= "event/category/view";
		$data['data']	= $this->global_model->get_data("*","event_category","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();

			$input['category_name'] 		= $post['category_name'];
			$input['category_description']	= $post['category_description'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';

			$this->db->insert("event_category", $input);

			$action="Add New Event Category " .$post['category_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('event_category');
		}
		$data['title']	= "Add New Category";
		$data['page']	= "event/category/add";
		// $data['data']	= $this->global_model->get_data("*","event_category","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();

			$input['category_name'] 		= $post['category_name'];
			$input['category_description']	= $post['category_description'];
			$input['created_date']			= date("Y-m-d");
			$input['update_by']				= $this->session->userdata("admin_id");
			$input['status']				= '1';

			$this->db->where("category_id", $id);
			$this->db->update("event_category", $input);

			$action="Edit Event Category " .$post['category_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('event_category');
		}
		$data['title']	= "Edit Category";
		$data['page']	= "event/category/edit";
		$data['data'] 	= $this->global_model->get_data("*","event_category","where category_id='".$id."'")->result_array();

		$this->load->view('admin', $data);
	}

	function delete()
	{
		$this->global_model->delete_data($id, 'category_id', 'event_category');

		$action="Delete Event Category With Id" .$id;
        $this->Aktiviti_log_model->create($action);

		redirect("event_category");
	}
}