<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$this->load->model("product_model");
		$page=$this->uri->segment(2);
		
		if($page=='') priv('view');
		else if(($page=='add') or ($page=='save')) priv('add');
		else if(($page=='edit') or ($page=='update')) priv('edit');
		else if($page=='delete') priv('delete');
		else  priv('other');
		
	}
	

	public function index()
	{
		
	    
		$data["data"] = $this->product_model->get_data();
		$data["page"]="product/view";
		$data["title"]="Product / Cartridge";

		$this->load->view('admin',$data);
	}
	
	public function add()
	{
		
	    		
		$data["page"]="product/add";
		$data["title"]="Add Product";	
		$data["printer"]=$this->global_model->get_dropdown("printer","where deleted='0' ","printer_id","printer_name");
		$this->load->view('admin',$data);
	}
	
	function save(){
		
		if($this->input->post()){
			$post=$this->input->post();
			
			$config['upload_path'] = './media/product/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '100';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("product_image"))
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
						
			
			$input=array(
					"product_name" => $post["product_name"],
					"printer_id" => $post["printer_id"],
					"product_code" => $post["product_code"],
					"product_desc" => $post["product_desc"],										
					"product_image" => $image,											
					"created_date" => date("Y-m-d H:i:s"),
					"created_by" => $this->session->userdata("admin_id"),					
					);
					
			$this->global_model->save_data($input,"product");
			
			// input log
			$action="Create Product ".$post["product_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("product");
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
		
	    
		$data["data"] = $this->product_model->get_data($id);
		$data["printer"]=$this->global_model->get_dropdown("printer","where deleted='0' ","printer_id","printer_name");
		$data["page"]="product/edit";
		$data["title"]="Product Edit";

		$this->load->view('admin',$data);
	}
	
	
	public function update(){
		if($this->input->post()){
			$post=$this->input->post();
			$id=$post["id"];
			
			if($post["photo_status"]==1){
			
				$config['upload_path'] = './media/product/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

				$this->load->library('upload', $config);
				$this->upload->do_upload("product_image");
				
				$file = $this->upload->data();
				$input["product_image"]=$file["file_name"];
				$this->image_resize($file["file_name"]);

			}
			
				$input["product_name"]=$post["product_name"];
				$input["product_desc"]=$post["product_desc"];						
				$input["product_code"]=$post["product_code"];
				$input["printer_id"]=$post["printer_id"];
				$input["updated_date"]=date("Y-m-d H:i:s");
				$input["updated_by"]=$this->session->userdata("admin_id");
				
				
				$this->global_model->update_data($id, 'product_id', $input, 'product');
				
				$action="Edit Product ". $post["product_name"];
				$this->Aktiviti_log_model->create($action);
			
			
			redirect("product");
		}
	}
	
	function delete($id){
		
		 
		$this->global_model->delete_data($id, 'product_id', 'product');
		redirect("product");
	}
	
	function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/product/'.$image.'';
			$config2['new_image'] = './media/product/low/'.$image.'';
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

