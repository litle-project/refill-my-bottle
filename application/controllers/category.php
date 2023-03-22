<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		
		$page=$this->uri->segment(2);
		if($page=='') priv('view');
		else if($page=='add') priv('add');
		else if($page=='edit') priv('edit');
		else if($page=='delete') priv('delete');
		else  priv('other');
	}
	

	public function index()
	{			    
		$data["data"] = $this->global_model->get_data("*","category"," where deleted='0' order by category_id desc")->result_array();
		$data["page"]="category/view";
		$data["title"]="Category";

		$this->load->view('admin',$data);
	}
	
	public function add()
	{		
		$data["page"]="category/add";
		$data["title"]="Add Category";
		$this->load->view('admin',$data);
	}
	
	function save(){
		
		if($this->input->post()){
			$post=$this->input->post();
			
			$config['upload_path'] = './media/category/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '100';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("category_icon") )
			{
				$error = array('error' => $this->upload->display_errors());
				
				print_r("<pre>");
				print_r($error);
				print_r("</pre>");
				$this->load->view('upload_form', $error);
			}
			else
			{
				$file = $this->upload->data();											
				$image=$file["file_name"];
				
				$this->upload->do_upload("category_icon");
				$file_icon = $this->upload->data();			
				$icon=$file_icon["file_name"];
				
				$input=array(
						"category_name" => $post["category_name"],
						"category_desc" => $post["category_desc"],						
						"category_icon" => $icon,		
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						
						);
						
				$this->global_model->save_data($input,"category");
				
				// input log
				$action="Create Category ".$post["category_name"];
				$this->Aktiviti_log_model->create($action);
			}
			
			
			redirect("category");
		}		
	}
	

	public function detail($id)
	{
		
	    
		$data["data"] = $this->global_model->get_data("*,a.created_date as category_date","category a","
		where a.deleted='0' and category_id='".$id."' order by a.category_id desc")->result_array();
		
		$data["detail"]="1";
		$data["page"]="category/detail";
		$data["title"]="Category Detail";

		$this->load->view('admin',$data);
	}
	
	public function edit($id)
	{			   
		$data["data"] = $this->global_model->get_data("*","category","where category_id='".$id."'")->result_array();		
		$data["page"]="category/edit";
		$data["title"]="Category Edit";

		$this->load->view('admin',$data);
	}
	
	function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/user/'.$image.'';
			$config2['new_image'] = './media/user/low/'.$image.'';
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = FALSE;
			$config2['width'] = 500;
			$config2['height'] = 500;

			$this->load->library('image_lib', $config2);
			$this->image_lib->initialize($config2);

			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			}
	}
	
	function delete($id){
		$this->global_model->delete_data($id, 'category_id', 'category');
		redirect("category");
	}
	
	
	public function update(){
		if($this->input->post()){
			$post=$this->input->post();
			$id=$post["id"];
			
			if($post["photo_status"]==1){
			
				$config['upload_path'] = './media/category/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

				$this->load->library('upload', $config);
				$this->upload->do_upload("category_icon");
				
				$file = $this->upload->data();
				$input["category_icon"]=$file["file_name"];
				//$this->image_resize($file["file_name"]);

			}	
			
				$input["category_name"]=$post["category_name"];
				$input["category_desc"]=$post["category_desc"];		
				$input["updated_date"]=date("Y-m-d H:i:s");
				$input["updated_by"]=$this->session->userdata("admin_id");
				
				
				$this->global_model->update_data($id, 'category_id', $input, 'category');
				
				$action="Edit Category ". $post["category_name"];
				$this->Aktiviti_log_model->create($action);
			
			
			redirect("category");
		}
	}

}

