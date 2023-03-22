<?php

class City extends CI_Controller
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
		$data['title']	= "Manage City";
		$data['page'] 	= "city/view";
		$data['data']	= $this->global_model->get_data_join("*","city a","where a.status='1'","left join country as b on b.country_id = a.country_id")->result_array();
		// print_r($data['data']); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			$input['city_name'] 			= $post['city_name'];
			$input['country_id']			= $post['country_id'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			
			$this->db->insert("city", $input);

			$action="Add New City " .$post['city_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('city');
		}

		$data['title']	= "Add New City";
		$data['page'] 	= "city/add";
		$data['data']	= $this->information_model->list_country();
		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			$input['city_name'] 			= $post['city_name'];
			$input['country_id']			= $post['country_id'];
			$input['created_date']			= date("Y-m-d");
			$input['updated_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			
			$this->db->where("city_id", $id);
			$this->db->update("city", $input);

			$action="Edit City " .$post['city_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('city');
		}

		$data['title']	= "Edit City";
		$data['page'] 	= "city/edit";
		$data['data']	= $this->global_model->get_data("*","city","where city_id='".$id."'")->result_array();
		$data['country']= $this->information_model->list_country();

		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'city_id', 'city');

		$action="Delete City With Id " .$id;
        $this->Aktiviti_log_model->create($action);

		redirect("city");
	}
}