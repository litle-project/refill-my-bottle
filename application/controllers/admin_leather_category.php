<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_leather_category extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		
		$page=$this->uri->segment(2);
		if($page=='') priv('view');
                
		else if(($page=='add') or ($page=='save')) priv('add');
                else if(($page=='edit') or ($page=='update') or ($page=='update_product_image')) priv('edit');
		
		else if($page=='delete') priv('delete');
		else  priv('other');
	}
	

	public function index()
	{			    
		$data["data"] = $this->global_model->get_data("*","leather_category"," where deleted='0' order by leather_category_id desc")->result_array();
		$data["page"]="leather_category/view";
		$data["title"]="Leather Category";

		$this->load->view('admin',$data);
	}
	
	public function add()
	{		
		$data["page"]="leather_category/add";
		$data["title"]="Add Leather Category";
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

			if ( ! $this->upload->do_upload("leather_category_icon") )
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
				
				$this->upload->do_upload("leather_category_icon");
				$file_icon = $this->upload->data();			
				$icon=$file_icon["file_name"];
				
				$input=array(
						"leather_category_name" => $post["leather_category_name"],
						"leather_category_desc" => $post["leather_category_desc"],						
						"leather_category_icon" => $icon,		
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						
						);
						
				$this->global_model->save_data($input,"leather_category");
				
				// input log
				$action="Create Category ".$post["leather_category_name"];
				$this->Aktiviti_log_model->create($action);
			}
			
			
			redirect("admin_leather_category");
		}		
	}
	

	public function detail($id)
	{
		
	    
		$data["data"] = $this->global_model->get_data("*,a.created_date as leather_category_date","leather_category a","
		where a.deleted='0' and leather_category_id='".$id."' order by a.leather_category_id desc")->result_array();
		
		$data["detail"]="1";
		$data["page"]="leather_category/detail";
		$data["title"]="Leather Category Detail";

		$this->load->view('admin',$data);
	}
	
	public function edit($id)
	{			   
		$data["data"] = $this->global_model->get_data("*","leather_category","where leather_category_id='".$id."'")->result_array();
		$data["page"]="leather_category/edit";
		$data["title"]="Leather Category Edit";

		$this->load->view('admin',$data);
	}
	
	function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/user/'.$image.'';
			$config2['new_image'] = './media/user/low/'.$image.'';
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = FALSE;
			$config2['width'] = 400;
			$config2['height'] = 400;

			$this->load->library('image_lib', $config2);
			$this->image_lib->initialize($config2);

			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			}
	}
	
	function delete($id){
		$this->global_model->delete_data($id, 'leather_category_id', 'leather_category');
		redirect("admin_leather_category");
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
				$this->upload->do_upload("leather_category_icon");
				
				$file = $this->upload->data();
				$input["leather_category_icon"]=$file["file_name"];
				//$this->image_resize($file["file_name"]);

			}	
			
				$input["leather_category_name"]=$post["leather_category_name"];
				$input["leather_category_desc"]=$post["leather_category_desc"];		
				$input["updated_date"]=date("Y-m-d H:i:s");
				$input["updated_by"]=$this->session->userdata("admin_id");
				
				
				$this->global_model->update_data($id, 'leather_category_id', $input, 'leather_category');
				
				$action="Edit Category ". $post["leather_category_name"];
				$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_leather_category");
		}
	}

}

