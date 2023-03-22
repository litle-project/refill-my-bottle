<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_product extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$this->load->model("admin_product_model");
		$page=$this->uri->segment(2);
		
		if($page=='') priv('view');
		else if(($page=='add') or ($page=='save')) priv('add');
		else if(($page=='edit') or ($page=='update') or ($page=='update_product_image')) priv('edit');
		else if(($page=='delete')or($page=='delete1')) priv('delete');
		else  priv('other');
		
	}
	

	public function index()
	{
		
	    
		$data["data"] = $this->admin_product_model->get_data();
		$data["page"]="product/view";
		$data["title"]="Product";

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
                                $this->image_lib->clear();
			}
						
			
			$input=array(
					"product_name" => $post["product_name"],
					"category_id" => $post["category_id"],
					
					"product_desc" => $post["product_desc"],										
					"product_image_list" => $image,											
					"created_date" => date("Y-m-d H:i:s"),
					"created_by" => $this->session->userdata("admin_id"),					
					);
					
			$this->global_model->save_data($input,"product");
			$id = $this->db->insert_id();
                        for($i=1;$i<=$post["images"];$i++){
					$field='product_image' . $i;
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
							"product_id" => $id,
							"product_image_link" => $name2['file_name'],
							
							"created_by" => $this->session->userdata("admin_id"),
							"created_date" => date("Y-m-d h:i:s"),
						);
						$this->db->insert("product_image", $data3);
						
					}
				}
                        
			// input log
			$action="Create Product ".$post["product_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_product");
		}	
		$data["page"]="product/add";
		$data["title"]="Add Product";	
		$data["printer"]=$this->global_model->get_dropdown("category","where deleted='0' ","category_id","category_name");
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
					"category_id" => $post["category_id"],
					
					"product_desc" => $post["product_desc"],										
					"product_image_list" => $image,											
					"created_date" => date("Y-m-d H:i:s"),
					"created_by" => $this->session->userdata("admin_id"),					
					);
					
			$this->global_model->save_data($input,"product");
			
                        for($i=1;$i<=$post["images"];$i++){
					$field='product_image' . $i;
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
							"product_id" => $id,
							"product_image" => $name2['file_name'],
							
							"created_by" => $this->session->userdata("admin_id"),
							"created_date" => date("Y-m-d h:i:s"),
						);
						$this->db->insert("product_image", $data3);
						
					}
				}
                        
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
		
	    
		$data["data"] = $this->admin_product_model->get_data($id);
		$data["printer"]=$this->global_model->get_dropdown("category","where deleted='0' ","category_id","category_name");
		$data["page"]="product/edit";
		$data["title"]="Product Edit";
                $data["get_image"] = $this->admin_product_model->get_data_image($id);
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
				$input["product_image_list"]=$file["file_name"];
				$this->image_resize($file["file_name"]);

			}
			
				$input["product_name"]=$post["product_name"];
				$input["product_desc"]=$post["product_desc"];						
				//$input["product_code"]=$post["product_code"];
				$input["category_id"]=$post["category_id"];
				$input["updated_date"]=date("Y-m-d H:i:s");
				$input["updated_by"]=$this->session->userdata("admin_id");
				
				
				$this->global_model->update_data($id, 'product_id', $input, 'product');
				
				$action="Edit Product ". $post["product_name"];
				$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_product");
		}
	}
	
	function delete($id){
		
		 
		$this->global_model->delete_data($id, 'product_id', 'product');
		redirect("admin_product");
	}
	
        
        function update_product_image($product_id){
		$post = $this->input->post(); 
			for ($i=1; $i<$post["frist"]; $i++)
			{
				if($this->input->post("photo_status$i")=="1")
				{
			
					$config['upload_path'] = "./media/product/";
					$config['allowed_types'] = "gif|jpg|png|jpeg";
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					$file="product_thumb$i";
					
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
							"product_image_link" => $image
							);
				
						$this->db->where("product_image_id",$post["product_image_id$i"]);
						$this->db->update("product_image",$input);  
					}            
				}
  
			}
		for($i=$post["frist"];$i<$post["images"];$i++){
			$field='product_image' . $i;
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
					"product_id" => $product_id,
					"product_image_link" => $name2['file_name'],
					
					"created_by" => $this->session->userdata("admin_id"),
					"created_date" => date("Y-m-d h:i:s"),
				);
				$this->db->insert("product_image", $data3);
				
			}
		}
		redirect("admin_product/edit/$product_id");
	}
        
        
    function delete1($id,$product_id){
		priv("delete");
		$data = array(
			'deleted' => "1",
			'updated_by' => $this->session->userdata("admin_id"),
			 );
		$this->db->where("product_image_id", $id);
		$this->db->update("product_image",$data);
		redirect("admin_product/edit/$product_id");
	}
	
	function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/product/'.$image.'';
			$config2['new_image'] = './media/product/low/'.$image.'';
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = TRUE;
			$config2['width'] = 400;
			$config2['height'] = 400;

			$this->load->library('image_lib', $config2);
			$this->image_lib->initialize($config2);

			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			}
	}
}

