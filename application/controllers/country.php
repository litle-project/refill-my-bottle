<?php

class Country extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');
		$this->load->model('Aktiviti_log_model');
		$this->load->model('api_model/information_model');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Country";
		$data['page'] 	= "country/view";
		$data['data']	= $this->information_model->list_country();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			$input['country_name'] 			= $post['country_name'];
			$input['country_code']			= $post['country_code'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			
			$this->db->insert("country", $input);

			$action="Add New Country " .$post['country_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('country');
		}

		$data['title']	= "Add New Country";
		$data['page'] 	= "country/add";
		// $data['data']	= $this->global_model->get_data("*","station","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			$input['country_name'] 			= $post['country_name'];
			$input['country_code']			= $post['country_code'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			
			$this->db->where("country_id", $id);
			$this->db->update("country", $input);

			$action="Edit Country " .$post['country_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('country');
		}

		$data['title']	= "Edit Country";
		$data['page'] 	= "country/edit";
		$data['data']	= $this->global_model->get_data("*","country","where country_id='".$id."'")->result_array();

		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'country_id', 'country');

		$action="Delete Country With Id " .$id;
        $this->Aktiviti_log_model->create($action);

		redirect("country");
	}
}