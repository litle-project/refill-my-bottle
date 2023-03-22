<?php

class Member_tier extends CI_Controller
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
		$data['title']	= "Manage Member Tier";
		$data['page'] 	= "member_tier/view";
		$data['data']	= $this->global_model->get_data("*","member_tier a","where a.status='1'")->result_array();
		// print_r($data['data']); die();

		$this->load->view('admin', $data);
	}

	public function detail($id)
	{
		$data['title']	= "Detail Member Tier";
		$data['page'] 	= "member_tier/detail";
		$data['data']	= $this->global_model->get_data("*","member_tier a","where a.status='1'")->result_array();
		// print_r($data['data']); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();
			$input['tier_name']				= $post['tier_name'];
			$input['tier_point'] 			= $post['tier_point'];
			$input['tier_terms'] 			= $post['tier_terms'];
			$input['tier_reward'] 			= $post['tier_reward'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			$config['upload_path']  		= './media/member_tier/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);

            if($this->upload->do_upload('tier_image'))
            {
                $file = $this->upload->data();
                $input['tier_image']		= $file['file_name'];

            }

            else {
            	 $input['tier_image']		= "default_refill.jpeg";
            // echo $this->upload->display_errors();die();
            // return false;
        	}
			$this->db->insert("member_tier", $input);

			$action="Add New Tier ".$post['tier_name'];
			$this->Aktiviti_log_model->create($action);

			redirect('member_tier');
		}

		$data['title']	= "Add New Tier";
		$data['page'] 	= "member_tier/add";

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			$data	= $this->global_model->get_data("*","member_tier","where tier_id='".$id."'")->result_array();

			// echo "<pre>"; print_r($this->input->post()); die();

			$input['tier_name']				= $post['tier_name'];
			$input['tier_point'] 			= $post['tier_point'];
			$input['tier_terms'] 			= $post['tier_terms'];
			$input['tier_reward'] 			= $post['tier_reward'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			$config['upload_path']  		= './media/member_tier/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);

            if($this->upload->do_upload('tier_image'))
            {
                $file = $this->upload->data();
                $input['tier_image']		= $file['file_name'];

            }

            else {
            	$input['tier_image'] 		= $data[0]['tier_image'];
        	}

			$this->db->where("tier_id", $id);
			$this->db->update("member_tier", $input);

			$action="Edit Tier ".$post['tier_name'];
			$this->Aktiviti_log_model->create($action);

			redirect('member_tier');
		}

		$data['title']	= "Edit Member Tier";
		$data['page'] 	= "member_tier/edit";
		$data['data']	= $this->global_model->get_data("*","member_tier","where tier_id='".$id."'")->result_array();

		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'tier_id', 'member_tier');

		$action="Delete Tier with ID ".$id;
		$this->Aktiviti_log_model->create($action);

		redirect("member_tier");
	}
}