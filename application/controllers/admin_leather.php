<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_leather extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$this->load->model("admin_leather_model");
		$page=$this->uri->segment(2);
		
		if($page=='') priv('view');
		else if(($page=='add') or ($page=='save')) priv('add');
		else if(($page=='edit') or ($page=='update') or ($page=='update_leather_image')) priv('edit');
		else if(($page=='delete')or($page=='delete1')) priv('delete');
		else  priv('other');
		
	}
	

	public function index()
	{
		
	    
		$data["data"] = $this->admin_leather_model->get_data();
		$data["page"]="leather/view";
		$data["title"]="Leather";

		$this->load->view('admin',$data);
	}
	
	public function add()
	{
		priv('add');
	    	if($this->input->post()){
			$post=$this->input->post();
			
			$config['upload_path'] = './media/product/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '100';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("leather_image"))
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
                                $this->image_lib->clear();
			}
						
			
			$input=array(
					"leather_name" => $post["leather_name"],
					"leather_category_id" => $post["leather_category_id"],
					
					"leather_desc" => $post["leather_desc"],										
					"leather_image_list" => $image,											
					"created_date" => date("Y-m-d H:i:s"),
					"created_by" => $this->session->userdata("admin_id"),					
					);
					
			$this->global_model->save_data($input,"leather");
			$id = $this->db->insert_id();
                        for($i=1;$i<=$post["images"];$i++){
					$field='leather_image' . $i;
					$config['upload_path'] = "./media/product/";
					$config['allowed_types'] = "gif|jpg|png|jpeg";
					$this->load->library('upload', $config);
					
					
					if ( ! $this->upload->do_upload($field))
					{
						//echo "gagal";
						$name['file_name']=$image;
						$error = array('error' => $this->upload->display_errors());
						//print_r("<pre>");
						//print_r($error);
						//print_r("</pre>");
					}
					else
					{
						//echo "berhasil";
						//$data = array('upload_data' => $this->upload->data());
						$name2=$this->upload->data();
						
						$dir="./media/product/";
						//echo "$dir";
						$new_name="./media/product/low";
						$image=$name2['file_name'];
						//echo $image . "<br>";
						$width="";
						$height="";
						
						$this->image_resize($image);
						$this->image_lib->clear();
						//print_r("<pre>");
						//print_r($data);
						//print_r("</pre>");
						//$this->load->view('upload_success', $data);
						
						
						$data3=array(
							"leather_id" => $id,
							"leather_image_link" => $name2['file_name'],
							
							"created_by" => $this->session->userdata("admin_id"),
							"created_date" => date("Y-m-d h:i:s"),
						);
						$this->db->insert("leather_image", $data3);
						
					}
				}
                        
			// input log
			$action="Create Leather ".$post["leather_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_leather");
		}	
		$data["page"]="leather/add";
		$data["title"]="Add Leather";	
		$data["printer"]=$this->global_model->get_dropdown("leather_category","where deleted='0' ","leather_category_id","leather_category_name");
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

			if ( ! $this->upload->do_upload("leather_image"))
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
					"leather_name" => $post["leather_name"],
					"leather_category_id" => $post["leather_category_id"],
					
					"leather_desc" => $post["leather_desc"],										
					"leather_image_list" => $image,											
					"created_date" => date("Y-m-d H:i:s"),
					"created_by" => $this->session->userdata("admin_id"),					
					);
					
			$this->global_model->save_data($input,"leather");
			
                        for($i=1;$i<=$post["images"];$i++){
					$field='leather_image' . $i;
					$config['upload_path'] = "./media/product/";
					$config['allowed_types'] = "gif|jpg|png|jpeg";
					$this->load->library('upload', $config);
					
					
					if ( ! $this->upload->do_upload($field))
					{
						//echo "gagal";
						$name['file_name']=$image;
						$error = array('error' => $this->upload->display_errors());
						//print_r("<pre>");
						//print_r($error);
						//print_r("</pre>");
					}
					else
					{
						//echo "berhasil";
						//$data = array('upload_data' => $this->upload->data());
						$name2=$this->upload->data();
						
						$dir="./media/product/";
						//echo "$dir";
						$new_name="./media/product/low";
						$image=$name2['file_name'];
						//echo $image . "<br>";
						$width="";
						$height="";
						
						$this->resize_image($dir, $new_name, $image, $width, $height);
						$this->image_lib->clear();
						//print_r("<pre>");
						//print_r($data);
						//print_r("</pre>");
						//$this->load->view('upload_success', $data);
						
						
						$data3=array(
							"leather_id" => $id,
							"leather_image" => $name2['file_name'],
							
							"created_by" => $this->session->userdata("admin_id"),
							"created_date" => date("Y-m-d h:i:s"),
						);
						$this->db->insert("leather_image", $data3);
						
					}
				}
                        
			// input log
			$action="Create Leather ".$post["leather_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("leather");
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
		
	    
		$data["data"] = $this->admin_leather_model->get_data($id);
		$data["printer"]=$this->global_model->get_dropdown("leather_category","where deleted='0' ","leather_category_id","leather_category_name");
		$data["page"]="leather/edit";
		$data["title"]="Leather Edit";
                $data["get_image"] = $this->admin_leather_model->get_data_image($id);
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
				$this->upload->do_upload("leather_image");
				
				$file = $this->upload->data();
				$input["leather_image_list"]=$file["file_name"];
				$this->image_resize($file["file_name"]);

			}
			
				$input["leather_name"]=$post["leather_name"];
				$input["leather_desc"]=$post["leather_desc"];						
				//$input["product_code"]=$post["product_code"];
				$input["leather_category_id"]=$post["leather_category_id"];
				$input["updated_date"]=date("Y-m-d H:i:s");
				$input["updated_by"]=$this->session->userdata("admin_id");
				
				
				$this->global_model->update_data($id, 'leather_id', $input, 'leather');
				
				$action="Edit Leather ". $post["leather_name"];
				$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_leather");
		}
	}
	
	function delete($id){
		
		 
		$this->global_model->delete_data($id, 'leather_id', 'leather');
		redirect("admin_leather");
	}
	
        
        function update_leather_image($leather_id){
		$post = $this->input->post(); 
			for ($i=1; $i<$post["frist"]; $i++)
			{
				if($this->input->post("photo_status$i")=="1")
				{
			
					$config['upload_path'] = "./media/product/";
					$config['allowed_types'] = "gif|jpg|png|jpeg";
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					$file="leather_thumb$i";
					
					if ( ! $this->upload->do_upload($file)){
						$image="img_album_default.jpg";
					}else{
						$name=$this->upload->data($file);
						$image=$name['file_name'];
						
						$dir="./media/product/";
						//echo "$dir";
						$new_name="./media/product/low";
						//echo $image . "<br>";
						$width="";
						$height="";
						//echo "here";
						$this->image_resize($image);
						$this->image_lib->clear();
						
						//echo "here";
						$input = array(
							"leather_image_link" => $image
							);
				
						$this->db->where("leather_image_id",$post["leather_image_id$i"]);
						$this->db->update("leather_image",$input);  
					}            
				}
  
			}
		for($i=$post["frist"];$i<$post["images"];$i++){
			$field='leather_image' . $i;
			$config['upload_path'] = "./media/product/";
			$config['allowed_types'] = "gif|jpg|png|jpeg";
			$this->load->library('upload', $config);
			
			
			if ( ! $this->upload->do_upload($field))
			{
				//echo "gagal";
				$name['file_name']=$image;
				$error = array('error' => $this->upload->display_errors());
				//print_r("<pre>");
				//print_r($error);
				//print_r("</pre>");
			}
			else
			{
				//echo "berhasil";
				//$data = array('upload_data' => $this->upload->data());
				$name2=$this->upload->data();
				
				$dir="./media/product/";
				//echo "$dir";
				$new_name="./media/product/low";
				$image=$name2['file_name'];
				//echo $image . "<br>";
				$width="";
				$height="";
				
				$this->image_resize($image);
				$this->image_lib->clear();
				//print_r("<pre>");
				//print_r($data);
				//print_r("</pre>");
				//$this->load->view('upload_success', $data);
				
				
				$data3=array(
					"leather_id" => $leather_id,
					"leather_image_link" => $name2['file_name'],
					
					"created_by" => $this->session->userdata("admin_id"),
					"created_date" => date("Y-m-d h:i:s"),
				);
				$this->db->insert("leather_image", $data3);
				
			}
		}
		redirect("admin_leather/edit/$leather_id");
	}
        
        
        function delete1($id,$leather_id){
		priv("delete");
		$data = array(
						'deleted' => "1",
						'updated_by' => $this->session->userdata("admin_id"),
						 );
		$this->db->where("leather_image_id", $id);
		$this->db->update("leather_image",$data);
		redirect("admin_leather/edit/$leather_id");
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

