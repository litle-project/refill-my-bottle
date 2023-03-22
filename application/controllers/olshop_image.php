<?php

class Olshop_image extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Shop List Image";
		$data['page'] 	= "shop_image/view";
		$data['data']	= $this->global_model->get_data_join("*","shop_detail_image as a","where a.status='1'","left join shop_detail as b on b.id_shop_detail = a.id_shop_detail")->result_array();
		// print_r($data['data']); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();
$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/shop/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("name_image")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input['name_image']		= $file['file_name'];
	                // $input["splash_image"] 		= $post['splash_image']; 
					// $this->image_resize($image);
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/shop/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/shop/image_resize/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
	            	$input['name_image']		= "default_refill.jpeg";
	            	//  echo $this->upload->display_errors();die();
		            // return false;
		            // return false;
	        	}
			$input['id_shop_detail'] 			= $post['id_shop_detail'];
			$input['image_convert'] 			= "low_".$image;
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['updated_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			
			$this->db->insert("shop_detail_image", $input);
			redirect('olshop_image');
		}

		$data['title']	= "Add New Shop List Image";
		$data['page'] 	= "shop_image/add";
		$data['data']	= $this->global_model->get_data("*","shop_detail","where status='1'")->result_array();

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();
			$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/shop/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("name_image")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input['name_image']		= $file['file_name'];
	                // $input["splash_image"] 		= $post['splash_image']; 
					// $this->image_resize($image);
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/shop/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/shop/image_resize/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
	            	$image = $this->global_model->get_data("*","shop_detail_image","where id_shop_image ='".$id."'")->result_array();
		            $input["name_image"] = $image[0]["name_image"];
		            // return false;
	        	}
			$input['id_shop_detail'] 		= $post['id_shop_detail'];
			$input['image_convert'] 		= "low_".$image;
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['updated_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			
			$this->db->where("id_shop_image", $id);
			$this->db->update("shop_detail_image", $input);
			redirect('olshop_image');
		}

		$data['title']	= "Edit Shop List Image";
		$data['page'] 	= "shop_image/edit";
		$data['data']	= $this->global_model->get_data("*","shop_detail_image","where id_shop_image='".$id."'")->result_array();
       $data['ct']	= $this->global_model->get_data("*","shop_detail","where status = '1'")->result_array();
		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'id_shop_image', 'shop_detail_image');
		redirect("olshop_image");
	}
}