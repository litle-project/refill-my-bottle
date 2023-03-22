<?php

class Impact extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');
	}

	public function index()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($post); die();

			$input['impact_total'] 		= $post['impact_total'];
			$input['impact_desc']		= $post['impact_desc'];
			$input['status']			= '1';
			$input['update_date']		= date("Y-m-d H:i:s");
			$input['update_by']			= $this->session->userdata("admin_id");
			$config['upload_path']  	= './media/impact/';
            $config['allowed_types']  	= 'jpg|jpeg|png';

            $this->load->library('upload', $config);
			$impact	= $this->global_model->get_data("*","impact","where impact_id='".$post['impact_id']."'")->result_array();
				
				
            if($this->upload->do_upload('impact_image'))
            {
                $file = $this->upload->data();
                $input['impact_image']		= $file['file_name'];

            }

            else {
            	$input['impact_image']		= $impact[0]['impact_image'];
        	}

			$this->db->where("impact_id", $post['impact_id']);
			$this->db->update("impact", $input);

			$action="Change Impact Total " .$post['impact_total'];
            $this->Aktiviti_log_model->create($action);

			redirect('impact');
		}
		$data['title']	= "Manage Impact";
		$data['page'] 	= "impact/add";
		$data['data']	= $this->global_model->get_data("*","impact","where status='1'")->result_array();
		// print_r($data['data']); die();
		$this->load->view('admin', $data);
	}

	public function save($id='')
	{
			
	}
}