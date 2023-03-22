<?php

class Voucher_master extends CI_Controller
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
		$data['title']	= "Manage Voucher";
		$data['page'] 	= "voucher/view";
		$data['data']	= $this->global_model->get_data("*","voucher", "where status ='1'")->result_array();


		$this->load->view('admin', $data);
	}

	function detail($id)
	{
		$data['title']		= "Voucher Detail";
		$data['page'] 		= "voucher/detail";
		$data['data']		= $this->global_model->get_data("*","voucher","where voucher_id='".$id."'")->result_array();
		// echo "<pre>"; print_r($data['rate']); die();
		
		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			$input['voucher_name'] 			= $post['voucher_name'];
			// $input['voucher_qty'] 			= $post['voucher_qty'];
			$input['voucher_valid'] 		= date("Y-m-d", strtotime($post['voucher_valid']));
			$input['overview'] 				= $post['overview'];
			$input['how_to_use'] 			= $post['how_to_use'];
			$input['voucher_terms'] 		= $post['voucher_terms'];
			$input['point']					= $post['point'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';

			// echo "<pre>"; print_r($input); die();


			$config['upload_path']  		= './media/voucher/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);

            if($this->upload->do_upload('voucher_image'))
            {
                $file = $this->upload->data();
                $input['voucher_image']		= $file['file_name'];

            }

            else {
            	$input['voucher_image'] 	= "default_refill.jpeg";
        	}

        	// echo "<pre>"; print_r($input); die();
			$this->db->insert("voucher", $input);

			$action="Add New Voucher ".$post['voucher_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('voucher_master');
		}

		$data['title']	= "Add New Voucher";
		$data['page'] 	= "voucher/add";
		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();
			$data	= $this->global_model->get_data("*","voucher","where voucher_id='".$id."'")->result_array();
			
			$input['voucher_name'] 			= $post['voucher_name'];
			// $input['voucher_qty'] 			= $post['voucher_qty'];
			$input['voucher_valid'] 		= date("Y-m-d", strtotime($post['voucher_valid']));
			$input['overview'] 				= $post['overview'];
			$input['how_to_use'] 			= $post['how_to_use'];
			$input['voucher_terms'] 		= $post['voucher_terms'];
			$input['point']					= $post['point'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';

			// echo "<pre>"; print_r($input); die();


			$config['upload_path']  		= './media/voucher/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);

            if($this->upload->do_upload('voucher_image'))
            {
                $file = $this->upload->data();
                $input['voucher_image']		= $file['file_name'];

            }

            else {
            	$input['voucher_image'] 	= $data[0]['voucher_image'];
        	}

        	// echo "<pre>"; print_r($input); die();
			$this->db->where("voucher_id", $id);
			$this->db->update("voucher", $input);

			$action="Edit Voucher ".$post['voucher_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('voucher_master');
		}

		$data['title']		= "Edit Voucher";
		$data['page'] 		= "voucher/edit";
		$data['data']		= $this->global_model->get_data("*","voucher","where voucher_id='".$id."'")->result_array();
		// echo "<pre>"; print_r($data['data']); die();


		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'voucher_id', 'voucher');

		$action="Delete Voucher With Id " .$id;
        $this->Aktiviti_log_model->create($action);

		redirect("voucher_master");
	}

}