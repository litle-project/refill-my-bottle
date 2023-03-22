<?php

class Suggest extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		$this->load->model('Aktiviti_log_model');
	}

	public function index($id='')
	{
		if ($this->input->post()) {
			$post = $this->input->post();

			$input['text_title'] 		= $post['text_title'];
			$input['text_content']		= $post['text_content'];
			$input['update_date']		= date("Y-m-d H:i:s");
			$input['update_by']			= $this->session->userdata("admin_id");
			$input['status']			= '1';

			$this->db->where("text_id", $id);
			$this->db->update("suggest_text", $input);

			$action="Update Text For Suggest Station " .$post['text_title'];
            $this->Aktiviti_log_model->create($action);

			redirect('suggest');
		}

		$data['title']	= "Manage Text For Suggested Station";
		$data['page']	= "suggest_text/view";
		$data['data']	= $this->global_model->get_data("*","suggest_text","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}

}