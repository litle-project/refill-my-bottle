<?php

class Olshop extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("global_model");
		$this->load->model("api_model/shop_model");

	}

	public function index($shop_id='')
	{
		$data['title']	= "Manage Shop List";
		$data['page'] 	= "shop_list/view";
		$data['data']	= $this->shop_model->get_data();

		// echo "<pre>"; print_r($data["data"]); die();

		$this->load->view('admin', $data);
	}
	public function detail($id){
		priv("view");
	    
		$data["data"] = $this->global_model->get_data("*", "shop_list", "where id_shop = '".$id."'")->result_array();
		$data["image"] = $this->global_model->get_data("*", "shop_image", "where shop_id = '".$id."'")->result_array();
		// echo "<pre>"; print_r($data['image']); die();
		$data["page"]="shop_list/detail";
		$data["title"]="shop Detail";


		$this->load->view('admin',$data);
	}
	
	public function add(){
		if ($this->input->post()) {
			$post = $this->input->post();

			$config['upload_path']  		= './media/shop/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);
            
            if($this->upload->do_upload('image'))
            {
                $file 					= $this->upload->data();
                $input['image']	= $file['file_name'];
            }else{
            	$input['image'] 	= "default_refill.jpeg";
        	}
			
			// echo "<pre>"; print_r($this->input->post()); die();
	        $input['name_product'] 			= $post['name_product'];
	        $input['point_discount'] 		= $post['point_discount'];
	        $input['price'] 				= $post['price'];
	        $input['price_after_discount']  = $post['price_after_discount'];
            $input['available_until']		= date("Y-m-d", strtotime($post['available_until']));
			$input['overview'] 				= $post['overview'];
			$input['how_to_use']			= $post['how_to_use'];
			$input['t_n_c'] 				= $post['t_n_c'];
			$input['url_web']				= $post['url_web'];
	        $input['status']				= "1";
	        $input['created_by']			= $this->session->userdata("admin_id");
	        $input['created_date']			= date("Y-m-d H:i:s");
			// print_r($input); die();
			$this->db->insert("shop_list", $input);
            $id 	= $this->db->insert_id();

 			
			$config['upload_path']  		= './media/shop/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);
            
        	for ($i=1; $i<=$post['products']; $i++) { 
	            if($this->upload->do_upload('name_image'.$i))
	            {
	                $file = $this->upload->data();
	                $input1['shop_image']	= $file['file_name'];
	                $input1['shop_id']		= $id;
	            	$input1['created_by']	= $this->session->userdata("admin_id");
	            	$input1['created_date'] = date("Y-m-d H:i:s");
	            	// $all[]= $input1;
	            	$this->db->insert("shop_image", $input1);
	            }else{
	            	$input1['shop_image'] 	= " ";
	            	$input1['shop_id']		= $id;
	            	$input1['created_by']	= $this->session->userdata("admin_id");
	            	$input1['created_date'] = date("Y-m-d H:i:s");
	            	$this->db->insert("shop_image", $input1);
	        	}
        	}
        	
			redirect('olshop');
	    }

		$data['title']	= "Add New Shop Catalog";
		$data['page'] 	= "shop_list/add";

		$this->load->view('admin', $data);
	}

	function edit($id){

		if ($this->input->post()) {
			$post = $this->input->post();

			$config['upload_path']  		= './media/shop/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);
            $image = $this->global_model->get_data("*", "shop_list", "where id_shop = '".$id."'")->result_array();
            if($this->upload->do_upload('image'))
            {
                $file 					= $this->upload->data();
                $input['image']			= $file['file_name'];
            }else{
            	$input['image'] 		= $image[0]['image'];
        	}

			// echo "<pre>"; print_r($this->input->post()); die();
	        $input['name_product'] 			= $post['name_product'];
	        $input['point_discount'] 		= $post['point_discount'];
	        $input['price'] 				= $post['price'];
	        $input['price_after_discount']  = $post['price_after_discount'];
            $input['available_until']		= date("Y-m-d", strtotime($post['available_until']));
			$input['overview'] 				= $post['overview'];
			$input['how_to_use']			= $post['how_to_use'];
			$input['t_n_c'] 				= $post['t_n_c'];
			$input['url_web']				= $post['url_web'];
	        $input['status']				= "1";
	        $input['updated_by']			= $this->session->userdata("admin_id");
        	$input['updated_date'] 			= date("Y-m-d H:i:s");
			// print_r($input); die();
			$this->db->where("id_shop", $id);
			$this->db->update("shop_list", $input);
            // $id 	= $this->db->insert_id();
        	
			redirect('olshop');
	    }

	    $data["data"] 		= $this->shop_model->get_data($id);
	    // echo "<pre>"; print_r(count($data['image'])); die();
		$data['title']		= "Edit Shop Catalog";
		$data['page'] 		= "shop_list/edit";
		$this->load->view('admin', $data);
	}


	function delete($id)
	{
		$this->global_model->delete_data($id, 'id_shop', 'shop_list');
		redirect("olshop");
	}
}