<?php

class Admin_partner extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		$this->load->model('Aktiviti_log_model');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Partner";
		$data['page']	= "partner/view";
		$data['data']	= $this->global_model->get_data("*","partner","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}

	function add()
	{
		
		if ($this->input->post()) {
			$post = $this->input->post();
			// print_r($this->input->post()); die();

			$input['partner_name'] 			= $post['partner_name'];
			$input['partner_description']	= $post['partner_description'];
			$input['partner_url']			= $post['partner_url'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			$config['upload_path']  		= './media/partner/';
            $config['allowed_types']  		= 'jpg|jpeg|png|JPG';

            $this->load->library('upload', $config);

            if($this->upload->do_upload('partner_image'))
            {
                $file = $this->upload->data();
                $input['partner_image']		= $file['file_name'];

            }

            else {
            	$input['partner_image']		= "default_refill.jpeg";
            // echo $this->upload->display_errors();die();
            // return false;
        	}

			// echo "<pre>"; print_r($input); die();
			$this->db->insert("partner", $input);

			$action="Add New Partner ".$post['partner_name'];
			$this->Aktiviti_log_model->create($action);

			redirect('admin_partner');
		}

		$data['title']	= "Manage Partner";
		$data['page']	= "partner/add";

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// print_r($this->input->post()); die();
			$data = $this->global_model->get_data("*","partner","where partner_id='".$id."'")->result_array();
			// print_r($data); die();
			$input['partner_name'] 			= $post['partner_name'];
			$input['partner_description']	= $post['partner_description'];
			$input['partner_url']			= $post['partner_url'];
			$input['created_date']			= date("Y-m-d");
			$input['update_by']				= $this->session->userdata("admin_id");
			$input['status']				= '1';
			$config['upload_path']  		= './media/partner/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);

            if($this->upload->do_upload('partner_image'))
            {
                $file = $this->upload->data();
                $input['partner_image']		= $file['file_name'];

            }

            else
            {
            	 $input['partner_image'] = $data[0]['partner_image'];
        	}

			// echo "<pre>"; print_r($input); die();
			$this->db->where("partner_id", $id);
			$this->db->update("partner", $input);

			$action="Edit Partner ".$post['partner_name'];
			$this->Aktiviti_log_model->create($action);

			redirect('admin_partner');
		}

		$data['data'] 	= $this->global_model->get_data("*","partner","where partner_id='".$id."'")->result_array();
		$data['title']	= "Manage Partner";
		$data['page']	= "partner/edit";

		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'partner_id', 'partner');

		$action="Delete Partner With ID ".$id;
		$this->Aktiviti_log_model->create($action);
		
		redirect("admin_partner");
	}

}