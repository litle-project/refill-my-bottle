<?php

class Contactus extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Aktiviti_log_model');
		$this->load->model("global_model");
	}

	public function index($contact_id='')
	{
		$data['title']	= "Manage contact us";
		$data['page'] 	= "contact_us/view";
		$data['data']	= $this->global_model->get_data("*","contact_us","where status='1'")->result_array();
		// echo "<pre>"; print_r($data["data"]); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			
			$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/contact_us/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("image_contact")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input['image_contact']		= $file['file_name'];
	                // $input["splash_image"] 		= $post['splash_image']; 
					// $this->image_resize($image);
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/contact_us/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/contact_us/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
	            	 $input['image_contact']		= "default_refill.jpeg";
		            // echo $this->upload->display_errors();die();
		            // return false;
	        	}

		        
		        $input['contact_type'] 		= $post['contact_type'];
		        $input['contact_title'] 	= $post['contact_title'];
		        $input['contact_target'] 	= $post['contact_target'];
		        $input['image_convert']		= "low_".$image;
		        $input['status']			= "1";
		        $input['created_by']		= $this->session->userdata("admin_id");
		        $input['updated_by']		= $this->session->userdata("admin_id");
	        	// echo "<pre>"; print_r($input); die();

	        	$action="Add New Contact " .$post['contact_title'];
                $this->Aktiviti_log_model->create($action);

				$this->db->insert("contact_us", $input);
	        
			redirect('contactus');
		}

		$data['title']	= "Add New Contact us";
		$data['page'] 	= "contact_us/add";

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			
			$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/contact_us/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("image_contact")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input['image_contact']		= $file['file_name'];
	                // $input["splash_image"] 		= $post['splash_image']; 
					// $this->image_resize($image);
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/contact_us/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/pop_up/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
	            	$image = $this->global_model->get_data("*","contact_us","where contact_id='".$id."'")->result_array();
		            $input["image_contact"] = $image[0]["image_contact"];
		            // return false;
	        	}

		       $input['contact_type'] 		= $post['contact_type'];
		        $input['contact_title'] 	= $post['contact_title'];
		        $input['contact_target'] 	= $post['contact_target'];
		        $input['image_convert']		= "low_".$image;
		        $input['status']			= "1";
		        $input['created_by']		= $this->session->userdata("admin_id");
		        $input['updated_by']			= $this->session->userdata("admin_id");
	        	// echo "<pre>"; print_r($input); die();
				$this->db->where("contact_id", $id);
				$this->db->update("contact_us", $input);

				$action="Edit Contact " .$post['contact_title'];
                $this->Aktiviti_log_model->create($action);

				redirect('contactus');
	        
			redirect('contactus');
		}

	            	// echo "<pre>"; print_r($data["images"]); die();
	    $data["data"] = $this->global_model->get_data("*","contact_us","where contact_id='".$id."'")->result_array();
		$data['title']	= "Edit Contact us";
		$data['page'] 	= "contact_us/edit";

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
		$this->global_model->delete_data($id, 'contact_id', 'contact_us');

		$action="Delete Contact With Id" .$id;
        $this->Aktiviti_log_model->create($action);

		redirect("contactus");
	}
}