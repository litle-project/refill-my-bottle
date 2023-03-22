<?php

class Bottle_size extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Aktiviti_log_model');
		$this->load->model("global_model");
	}

	public function index($bottle_size_id='')
	{
	$this->db->select('*');
    $this->db->where('status','1');
    $this->db->order_by("value","asc");
    $this->db->from('bottle_size');
    $query=$this->db->get()->result_array();

		$data['title']	= "Manage Bottle_size";
		$data['page'] 	= "bottle_size/view";
		$data['data']	= $query;
		// echo "<pre>"; print_r($data["data"]); die();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			
			$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/bottle/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("bottle_image")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input['bottle_image']		= $file['file_name'];
	                // $input["splash_image"] 		= $post['splash_image']; 
					// $this->image_resize($image);
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/bottle/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/bottle/image_resize/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
		            echo $this->upload->display_errors();die();
		            return false;
	        	}

		        $input['name_size'] 		= $post['name_size'];
		        $input['value'] 			= $post['bottle_value'];
		        $input['image_convert']		= "low_".$image;
		        $input['status']			= "1";
		        $input['created_by']		= $this->session->userdata("admin_id");
		        $input['updated_by']			= $this->session->userdata("admin_id");
	        	// echo "<pre>"; print_r($input); die();
				$this->db->insert("bottle_size", $input);

				$action="Add New Size " .$post['bottle_value'];
            	$this->Aktiviti_log_model->create($action);
	        
			redirect('bottle_size');
		}

		$data['title']	= "Add New bottle_size";
		$data['page'] 	= "bottle_size/add";

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			
			$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/bottle/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("bottle_image")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input['bottle_image']		= $file['file_name'];
	                // $input["splash_image"] 		= $post['splash_image']; 
					// $this->image_resize($image);
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/bottle/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/bottle/image_resize/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
	            	$image = $this->global_model->get_data("*","bottle_size","where bottle_size_id='".$id."'")->result_array();
		            $input["bottle_image"] = $image[0]["bottle_image"];
		            // return false;
	        	}

		       	$input['name_size'] 		= $post['name_size'];
		        $input['value'] 			= $post['bottle_value'];
		        $input['image_convert']		= "low_".$image;
		        $input['status']			= "1";
		        $input['created_by']		= $this->session->userdata("admin_id");
		        $input['updated_by']			= $this->session->userdata("admin_id");
	        	// echo "<pre>"; print_r($input); die();
				$this->db->where("bottle_size_id", $id);
				$this->db->update("bottle_size", $input);

				$action="Edit Bottle Size ".$post['name_size'];
            	$this->Aktiviti_log_model->create($action);

				redirect('bottle_size');
	        
			redirect('bottle_size');
		}

	            	// echo "<pre>"; print_r($data["images"]); die();
	    $data["data"] = $this->global_model->get_data("*","bottle_size","where bottle_size_id='".$id."'")->result_array();
		$data['title']	= "Edit bottle_size";
		$data['page'] 	= "bottle_size/edit";

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
		$this->global_model->delete_data($id, 'bottle_size_id', 'bottle_size');

		$action="Delete Bottle Size With Id ".$id;
    	$this->Aktiviti_log_model->create($action);

		redirect("bottle_size");
	}
}