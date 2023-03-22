<?php

class Refil_exp extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('Aktiviti_log_model');
		$this->load->model('global_model');
		// $this->load->model('station_model');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Refill Expired";
		$data['page'] 	= "refill/view";
		$data['data']	= $this->global_model->get_data_join("*","time a", "where status ='1'", "left join admin as b on b.admin_id = a.update_by")->result_array();
		// $data['data']	= $this->station_model->get_data();
		// echo "<pre>"; print_r($data['data']); die();
		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();
			
			$input['time'] 					= $post['time'];
			$input['reason']				= $post['reason'];
			$input['update_date']			= date("Y-m-d H:i:s");
			$input['update_by']				= $this->session->userdata("admin_id");
			$input['status']				= '1';

        	// echo "<pre>"; print_r($input); die();
			$this->db->where("time_id", $id);
			$this->db->update("time", $input);

			$action="Edit Time Exp Become " .$post['time'];
            $this->Aktiviti_log_model->create($action);

			redirect('refil_exp');
		}

		$data['title']		= "Edit Refill Expired";
		$data['page'] 		= "refill/edit";
		$data['data']		= $this->global_model->get_data("*","time","where time_id='".$id."'")->result_array();

		$this->load->view('admin', $data);
	}

}