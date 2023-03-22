<?php

class Event_master extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('Aktiviti_log_model');
		$this->load->model('global_model');
		// $this->load->model('blog_model');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Event";
		$data['page']	= "event/master/view";
		$data['data']	= $this->global_model->get_data_join("*","event_master a","where a.status='1'","left join event_category as b on b.category_id = a.category_id")->result_array();
		// print_r($data['data']); die();

		$this->load->view('admin', $data);
	}

	public function detail($id)
	{
		$data['title']	= "Detail Event";
		$data['page']	= "event/master/detail";
		$data['data']	= $this->global_model->get_data_join("*","event_master a","where event_id='".$id."'","left join event_category as b on b.category_id = a.category_id left join country as c on c.country_id = a.country left join city as d on d.city_id = a.city left join area as e on e.area_id = a.area")->result_array();
		// echo "<pre>"; print_r($data['data']); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($post); die();

			$input['event_name'] 		= $post['event_name'];
			$input['event_content']		= $post['event_content'];
			$input['category_id']		= $post['category_id'];
			$input['start_date']		= date("Y-m-d", strtotime($post['start_date']));
			$input['end_date']			= date("Y-m-d", strtotime($post['end_date']));
			$input['country']			= $post['country'];
			$input['city']				= $post['city'];
			$input['area']				= $post['area'];
			$input['status']			= '1';
			$input['created_date']		= date("Y-m-d");
			$input['created_by']		= $this->session->userdata("admin_id");
			$config['upload_path']  		= './media/event/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);

            if($this->upload->do_upload('event_image'))
            {
                $file = $this->upload->data();
                $input['event_image']		= $file['file_name'];

            }

            else {
            	$input['event_image']		= "default_refill.jpeg";
        	}

			// $this->db->insert("blog_id", $id);
			$this->db->insert("event_master", $input);

			$action="Add Event " .$post['event_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('event_master');
		}

		$data['title']	= "Create New Event";
		$data['page']	= "event/master/add";
		$data['data'] 	= $this->global_model->get_data("*","event_category","where status='1'")->result_array();
		$data['country'] = $this->global_model->get_data("*","country","where status='1'")->result_array();

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

	function cek_area($id)
	{
		$data['area'] = $this->global_model->get_data("area_id, area_name","area","where city_id='".$id."'")->result_array();
		// print_r($data['area']); die();
		foreach ($data['area'] as $key) {
			echo "<option value=".$key['area_id'].">".$key['area_name']."</option>";
		}
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
            $old_data = $this->global_model->get_data("*", "event_master", "where event_id ='".$id."'")->result_array();

			// echo "<pre>";print_r($post);die();
			$input['event_name'] 		= $post['event_name'];
			$input['event_content']		= $post['event_content'];
			$input['category_id']		= $post['category_id'];
			$input['start_date']		= date("Y-m-d", strtotime($post['start_date']));
			$input['end_date']			= date("Y-m-d", strtotime($post['end_date']));
			$input['country']			= $post['country'];
			if (!empty($post['city'])) {
				$input['city']			= $post['city'];
			}else{
				$input['city']			= $old_data[0]['city'];
			}

			if (!empty($post['area'])) {
				$input['area']			= $post['area'];
			}else{
				$input['area']			= $old_data[0]['area'];
			}
			$input['status']			= '1';
			$input['created_date']		= date("Y-m-d");
			$input['created_by']		= $this->session->userdata("admin_id");
			$config['upload_path']  		= './media/event/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);
            if($this->upload->do_upload('event_image'))
            {
                $file = $this->upload->data();
                $input['event_image']		= $file['file_name'];

            }

            else {
            	$input['event_image']		= $old_data[0]['event_image'];
        	}


			$this->db->where("event_id", $id);
			$this->db->update("event_master", $input);

			$action="Edit Event " .$post['event_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('event_master');
		}

		$data['title']	= "Edit Event";
		$data['page']	= "event/master/edit";
		$data['data']	= $this->global_model->get_data("*","event_master","where event_id='".$id."'")->result_array();
		$data['category'] = $this->global_model->get_data("*","event_category","where status='1'")->result_array();
		$data['country'] = $this->global_model->get_data("*","country","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'event_id', 'event_master');

		$action="Delete Event With Id" .$id;
        $this->Aktiviti_log_model->create($action);

		redirect("event_master");
	}
}