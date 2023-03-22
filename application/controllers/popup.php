<?php

class Popup extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Aktiviti_log_model');
		$this->load->model("global_model");
	}

	public function index($popup_id='')
	{
		$data['title']	= "Manage Pop up";
		$data['page'] 	= "pop_up/view";
		$data['data']	= $this->global_model->get_data("*","pop_up","where status='1'")->result_array();
		// echo "<pre>"; print_r($data["data"]); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			
			$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/pop_up/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("popup_image")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input['popup_image']		= $file['file_name'];
	                // $input["splash_image"] 		= $post['splash_image']; 
					// $this->image_resize($image);
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/pop_up/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/pop_up/image_resize/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
		            // echo $this->upload->display_errors();die();
		            // return false;
		            $input['popup_image']		= "default_refill.jpeg";
	        	}

		        $input['popup_name'] 		= $post['popup_name'];
		        $input['popup_content'] 	= $post['popup_content'];
		        $input['image_convert']		= "low_".$image;
		        $input['status']			= "1";
		        $input['created_by']		= $this->session->userdata("admin_id");
		        $input['updated_by']			= $this->session->userdata("admin_id");
	        	// echo "<pre>"; print_r($input); die();
				$this->db->insert("pop_up", $input);
	        	
	        	$action="Add New Pop Up ".$post['popup_name'];
            	$this->Aktiviti_log_model->create($action);

			redirect('popup');
		}

		$data['title']	= "Add New Pop Up";
		$data['page'] 	= "pop_up/add";

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			
			$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/pop_up/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("popup_image")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input['popup_image']		= $file['file_name'];
	                // $input["splash_image"] 		= $post['splash_image']; 
					// $this->image_resize($image);
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/pop_up/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/pop_up/image_resize/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
	            	$image = $this->global_model->get_data("*","pop_up","where popup_id='".$id."'")->result_array();
		            $input["popup_image"] = $image[0]["popup_image"];
		            // return false;
	        	}

		       $input['popup_name'] 		= $post['popup_name'];
		        $input['popup_content'] 	= $post['popup_content'];
		        $input['image_convert']		= "low_".$image;
		        $input['status']			= "1";
		        $input['created_by']		= $this->session->userdata("admin_id");
		        $input['updated_by']		= $this->session->userdata("admin_id");
	        	// echo "<pre>"; print_r($input); die();
				$this->db->where("popup_id", $id);
				$this->db->update("pop_up", $input);

				$action="Edit Pop Up ".$post['popup_name'];
            	$this->Aktiviti_log_model->create($action);

				redirect('popup');
	        
			redirect('popup');
		}

	            	// echo "<pre>"; print_r($data["images"]); die();
	    $data["data"] = $this->global_model->get_data("*","pop_up","where popup_id='".$id."'")->result_array();
		$data['title']	= "Edit Pop Up";
		$data['page'] 	= "pop_up/edit";

		$this->load->view('admin', $data);
	}

	// function check($page){
	// 	$page =  $this->input->post('splash_page');    
	//  	$query = $this->global_model->get_data("*","splash","where splash_page='".$page."'")->row_array();
	//  	$status ="true";  
 //      	if($query){
	//    		$status = "false";
	//   	}                
 //        echo $status; 
	// }

	function delete($id)
	{
		$this->global_model->delete_data($id, 'popup_id', 'pop_up');

		$action="Delete Pop Up With Id ".$id;
        $this->Aktiviti_log_model->create($action);
		
		redirect("popup");
	}
}