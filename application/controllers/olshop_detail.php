<?php

class Olshop_detail extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Shop List Detail";
		$data['page'] 	= "shop_detail/view";
		$data['data']	= $this->global_model->get_data_join("*","shop_detail as a","where a.status='1'","left join shop_list as b on b.id_shop = a.id_shop")->result_array();
		// print_r($data['data']); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			$input['id_shop'] 			= $post['id_shop'];
			$input['title_product']			= $post['title_product'];
			$input['overview'] 			= $post['overview'];
			$input['how_to_use']			= $post['how_to_use'];
			$input['t_n_c'] 			= $post['t_n_c'];
			$input['url_web']			= $post['url_web'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['updated_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			
			$this->db->insert("shop_detail", $input);
			redirect('olshop_detail');
		}

		$data['title']	= "Add New Shop List Detail";
		$data['page'] 	= "shop_detail/add";
		$data['data']	= $this->global_model->get_data("*","shop_list","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

				$input['id_shop'] 			= $post['id_shop'];
			$input['title_product']			= $post['title_product'];
			$input['overview'] 			= $post['overview'];
			$input['how_to_use']			= $post['how_to_use'];
			$input['t_n_c'] 			= $post['t_n_c'];
			$input['url_web']			= $post['url_web'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['updated_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			
			$this->db->where("id_shop_detail", $id);
			$this->db->update("shop_detail", $input);
			redirect('olshop_detail');
		}

		$data['title']	= "Edit Shop List Detail";
		$data['page'] 	= "shop_detail/edit";
		$data['data']	= $this->global_model->get_data("*","shop_detail","where id_shop_detail='".$id."'")->result_array();
       $data['ct']	= $this->global_model->get_data("*","shop_list","where status = '1'")->result_array();
		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'id_shop_detail', 'shop_detail');
		redirect("olshop_detail");
	}
}