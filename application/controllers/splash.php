<?php

class Splash extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Aktiviti_log_model');
		$this->load->model("global_model");
	}

	public function index($splash_id='')
	{
		$data['title']	= "Manage Splash Screen";
		$data['page'] 	= "apps/splash/view";
		$data['data']	= $this->global_model->get_data("*","splash","where status='1'")->result_array();
		// echo "<pre>"; print_r($data["data"]); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			
			$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/apps/splash/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("splash_image")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input['splash_image']		= $file['file_name'];
	                // $input["splash_image"] 		= $post['splash_image']; 
					// $this->image_resize($image);
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/apps/splash/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/apps/splash/image_resize/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
		            // echo $this->upload->display_errors();die();
		            // return false;
		             $input['splash_image']		= "default_refill.jpeg";
	        	}

		        $input['splash_name'] 		= $post['splash_name'];
		        $input['splash_content'] 	= $post['splash_content'];
		        $input['splash_page'] 		= $post['splash_page'];
		        $input['image_convert']		= "low_".$image;
		        $input['status']			= "1";
		        $input['created_by']		= $this->session->userdata("admin_id");
		        $input['update_by']			= $this->session->userdata("admin_id");
	        	// echo "<pre>"; print_r($input); die();
				$this->db->insert("splash", $input);

				$action="Add New Splash Screen ".$post['splash_name'];
            	$this->Aktiviti_log_model->create($action);
	        
			redirect('splash');
		}

		$data['title']	= "Add New Splash Screen";
		$data['page'] 	= "apps/splash/add";

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			
			$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/apps/splash/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("splash_image")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input['splash_image']		= $file['file_name'];
	                // $input["splash_image"] 		= $post['splash_image']; 
					// $this->image_resize($image);
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/apps/splash/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/apps/splash/image_resize/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
	            	$image = $this->global_model->get_data("*","splash","where splash_id='".$id."'")->result_array();
		            $input["splash_image"] = $image[0]["splash_image"];
		            // return false;
	        	}

		        $input['splash_name'] 		= $post['splash_name'];
		        $input['splash_content'] 	= $post['splash_content'];
		        $input['splash_page'] 		= $post['splash_page'];
		        $input['image_convert']		= "low_".$image;
		        $input['status']			= "1";
		        $input['created_by']		= $this->session->userdata("admin_id");
		        $input['update_by']			= $this->session->userdata("admin_id");
	        	// echo "<pre>"; print_r($input); die();
				$this->db->where("splash_id", $id);
				$this->db->update("splash", $input);

				$action="Edit Splash Screen ".$post['splash_name'];
            	$this->Aktiviti_log_model->create($action);

				redirect('splash');
	        
			redirect('splash');
		}

	            	// echo "<pre>"; print_r($data["images"]); die();
	    $data["data"] = $this->global_model->get_data("*","splash","where splash_id='".$id."'")->result_array();
		$data['title']	= "Edit Splash Screen";
		$data['page'] 	= "apps/splash/edit";

		$this->load->view('admin', $data);
	}

	function check($page){
		$page =  $this->input->post('splash_page');    
	 	$query = $this->global_model->get_data("*","splash","where splash_page='".$page."'")->row_array();
	 	$status ="true";  
      	if($query){
	   		$status = "false";
	  	}                
        echo $status; 
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'splash_id', 'splash');

		$action="Delete Splash Screen With Id ".$id;
    	$this->Aktiviti_log_model->create($action);

		redirect("splash");
	}

	function detail($id)
	{
		$data['title']		= "Detail Splash";
		$data['page'] 		= "apps/splash/detail";
		$data['data']		= $this->global_model->get_data("*","splash","where splash_id='".$id."'")->result_array();
		// echo "<pre>"; print_r($data['rate']); die();
		
		$this->load->view('admin', $data);
	}


}