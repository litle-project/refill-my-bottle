<?php

class area extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');
		$this->load->model('Aktiviti_log_model');
		$this->load->model('api_model/alamat_model');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Area";
		$data['page'] 	= "area/view";
		$data['data']	= $this->global_model->get_data_join("*","area a","where a.status='1'","left join city as b on b.city_id = a.city_id left join country as c on c.country_id = b.country_id   ")->result_array();
		// print_r($data['data']); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			
			
			$input['country_id']			= $post['country_id'];
			$input['area_name'] 			= $post['area_name'];
			$input['city_id']				= $post['city_id'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			
			$this->db->insert("area", $input);

			$action="Add New Area " .$post['area_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('area');
		}

		$data['title']	= "Add New area";
		$data['page'] 	= "area/add";
		$data['country']= $this->global_model->get_data("*","country","where status='1'")->result_array();
		$data['data']	= $this->alamat_model->buat_state();

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			$input['area_name'] 			= $post['area_name'];
			$input['city_id']			= $post['city_id'];
			$input['country_id']			= $post['country_id'];
			$input['created_date']			= date("Y-m-d");
			
			$input['updated_by']				= $this->session->userdata("admin_id");
			$input['status']				= '1';
			
			$this->db->where("area_id", $id);
			$this->db->update("area", $input);

			$action="Edit Area " .$post['area_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('area');
		}

		$data['title']	= "Edit area";
		$data['page'] 	= "area/edit";
		$data['data']	= $this->global_model->get_data("*","area","where area_id='".$id."'")->result_array();
		$data['state']  = $this->alamat_model->buat_state();
		$data['country']= $this->global_model->get_data("*","country","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}
	function cek_city($id){
		
		$data['city'] = $this->global_model->get_data("city_id, city_name","city","where country_id='".$id."'")->result_array();
		// print_r($data['city']); die();
		foreach ($data['city'] as $key) {
			echo "<option value=".$key['city_id'].">".$key['city_name']."</option>";
		}
		// print_r($data);
	}

	

	function delete($id)
	{
		$this->global_model->delete_data($id, 'area_id', 'area');

		$action="Delete Area With Id" .$id;
        $this->Aktiviti_log_model->create($action);

		redirect("area");
	}
}