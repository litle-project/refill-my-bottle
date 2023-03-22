<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Printer extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$page=$this->uri->segment(2);
		
		if($page=='') priv('view');
		else if(($page=='add') or ($page=='save')) priv('add');
		else if(($page=='edit') or ($page=='update')) priv('edit');
		else if($page=='delete') priv('delete');
		else  priv('other');
		
	}
	

	public function index()
	{
		
	    
		$data["data"] = $this->global_model->get_data("*","printer"," where deleted='0' order by printer_id desc")->result_array();
		$data["page"]="printer/view";
		$data["title"]="Printer";

		$this->load->view('admin',$data);
	}
	
	public function add()
	{
		
	    		
		$data["page"]="printer/add";
		$data["title"]="Add Printer";		
		$this->load->view('admin',$data);
	}
	
	function save(){
		
		if($this->input->post()){
			$post=$this->input->post();
			
			$config['upload_path'] = './media/printer/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '100';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("printer_image"))
			{
				$error = array('error' => $this->upload->display_errors());				
				//print_r("<pre>");
				//print_r($error);
				//print_r("</pre>");
				//$this->load->view('upload_form', $error);
				$image="";
			}
			else
			{
				$file = $this->upload->data();				
				$image=$file["file_name"];				
				$this->image_resize($file["file_name"]);				
			}
			
			if ( ! $this->upload->do_upload("printer_image_detail"))
			{
				$error = array('error' => $this->upload->display_errors());				
				//print_r("<pre>");
				//print_r($error);
				//print_r("</pre>");
				//$this->load->view('upload_form', $error);
				$image_detail="";
			} 
			else
			{
				$file = $this->upload->data();				
				$image_detail=$file["file_name"];				
				$this->image_resize($file["file_name"]);				
			}
			
			$input=array(
					"printer_name" => $post["printer_name"],
					"printer_desc" => $post["printer_desc"],										
					"printer_image" => $image,						
					"printer_image_detail" => $image_detail,	
					"created_date" => date("Y-m-d H:i:s"),
					"created_by" => $this->session->userdata("admin_id"),					
					);
					
			$this->global_model->save_data($input,"printer");
			
			// input log
			$action="Create Printer ".$post["printer_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("printer");
		}		
	}

	public function detail($id)
	{
		
	    
		$data["data"] = $this->global_model->get_data("*","printer","where printer_id='".$id."'")->result_array();		
		$data["page"]="printer/detail";
		$data["title"]="Printer Detail";

		$this->load->view('admin',$data);
	}
	
	public function edit($id)
	{
		
	    
		$data["data"] = $this->global_model->get_data("*","printer","where printer_id='".$id."'")->result_array();		
		$data["page"]="printer/edit";
		$data["title"]="Printer Edit";

		$this->load->view('admin',$data);
	}
	
	
	public function update(){
		if($this->input->post()){
			$post=$this->input->post();
			$id=$post["id"];
			
			if($post["photo_status"]==1){
			
				$config['upload_path'] = './media/printer/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

				$this->load->library('upload', $config);
				$this->upload->do_upload("printer_image");
				
				$file = $this->upload->data();
				$input["printer_image"]=$file["file_name"];
				$this->image_resize($file["file_name"]);

			}
			if($post["photo_status2"]==1){
			
				$config['upload_path'] = './media/printer/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

				$this->load->library('upload', $config);
				$this->upload->do_upload("printer_image_detail");
				
				$file = $this->upload->data();
				$input["printer_image_detail"]=$file["file_name"];
				$this->image_resize($file["file_name"]);

			}
			
			
			
			
			
				$input["printer_name"]=$post["printer_name"];
				$input["printer_desc"]=$post["printer_desc"];						
				$input["updated_date"]=date("Y-m-d H:i:s");
				$input["updated_by"]=$this->session->userdata("admin_id");
				
				
				$this->global_model->update_data($id, 'printer_id', $input, 'printer');
				
				$action="Edit Printer ". $post["printer_name"];
				$this->Aktiviti_log_model->create($action);
			
			
			redirect("printer");
		}
	}
	
	function delete($id){
		
		 
		$this->global_model->delete_data($id, 'printer_id', 'printer');
		redirect("printer");
	}
	
	function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/printer/'.$image.'';
			$config2['new_image'] = './media/printer/low/'.$image.'';
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = TRUE;
			$config2['width'] = 400;
			//$config2['height'] = 400;

			$this->load->library('image_lib', $config2);
			$this->image_lib->initialize($config2);

			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			}
	}
}

