<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_sliding extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("sliding_model");
		$this->load->model('Aktiviti_log_model');
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Sliding";
		$data["page"]="sliding/view";
		$data["get_data"]=$this->sliding_model->get_data();
		$this->load->view('admin',$data);
	}
	
	function add(){
		priv("add");
		if($this->input->post()){
			$post=$this->input->post();
			$config['upload_path'] = './media/sliding/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '100';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("sliding_image"))
			{
				$error = array('error' => $this->upload->display_errors());
				
				print_r("<pre>");
				print_r($error);
				print_r("</pre>");
				//$this->load->view('upload_form', $error);
			}
			else
			{
                                $file = $this->upload->data();
				$data=array(
							"sliding_title" => $post["sliding_title"],
							"sliding_desc" => $post["sliding_desc"],
							"sliding_image" => $file["file_name"],
							"created_date" => date("Y-m-d H:i:s"),
							"created_by" => $this->session->userdata("admin_id")
							);
							
				$this->db->insert("sliding",$data);
				$action="Create New Sliding  " . $post['sliding_title'];
				$this->Aktiviti_log_model->create($action);
			}
				redirect("admin_sliding");
			
		}
		
		
		
		$data["title"]="Add Sliding";
		$data["page"]="sliding/add";
		//$data["cat"]=$this->sliding_model->cat();
		$this->load->view('admin',$data);
	}
	
	function edit($id){
		priv("edit");
		if($this->input->post()){
			$post=$this->input->post();
			if($post["photo_status"]==1){
			
				$config['upload_path'] = './media/sliding/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

				$this->load->library('upload', $config);
				$this->upload->do_upload("photo");
				
				$file = $this->upload->data();
				$data["sliding_image"]=$file["file_name"];

			}
				$data["sliding_title"] = $post["sliding_title"];
				$data["sliding_desc"] = $post["sliding_desc"];
				
				$data["updated_date"] = date("Y-m-d H:i:s");
				$data["updated_by"] = $this->session->userdata("admin_id");
						
						
			$this->db->where("sliding_id",$id);
			$this->db->update("sliding",$data);
			
			
			$action="Update Sliding  " . $post['sliding_title'];
			$this->Aktiviti_log_model->create($action);
			//print_r($data);
			redirect("admin_sliding");
			
		}
		
		
		
		$data["title"]="Edit Sliding";
		$data["page"]="sliding/edit";
		
		$data["get_data"]=$this->sliding_model->get_data($id);
		$this->load->view('admin',$data);
	}
	
	function delete($id){
		priv("delete");
			$data=array(
						"deleted" => "1",
						);
						
			$this->db->where("sliding_id",$id);
			$this->db->update("sliding",$data);
			
			$action="Delete Sliding ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			redirect("admin_sliding");
	
	}
	

}
