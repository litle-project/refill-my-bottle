<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Store extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$this->load->model("store_model");
		$page=$this->uri->segment(2);
		
		if($page=='') priv('view');
		else if(($page=='add') or ($page=='save')) priv('add');
		else if(($page=='edit') or ($page=='update')) priv('edit');
		else if($page=='delete') priv('delete');
		else  priv('other');
		
	}
	

	public function index()
	{			   
		$data["data"] = $this->store_model->get_data();
		$data["page"]="store/view";
		$data["title"]="Store";

		$this->load->view('admin',$data);
	}
	
	public function add()
	{
		
	    		
		$data["page"]="store/add";
		$data["title"]="Add Store";			
		$this->load->view('admin',$data);
	}
	
	function save(){
		
		if($this->input->post()){
			$post=$this->input->post();			
				$input=array(
						"store_name" => $post["store_name"],
						"store_desc" => $post["store_desc"],
						"store_address" => $post["store_address"],											
						"store_phone" => $post["store_phone"],
						"store_email" => $post["store_email"],
						"store_fax" => $post["store_fax"],										
						"store_website" => $post["store_website"],				
						"store_lat" => $post["store_lat"],				
						"store_long" => $post["store_long"],										
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						
						);
						
				$this->global_model->save_data($input,"store");
				$id=$this->db->insert_id();
				
				
				for($i=1;$i<=$post["images"];$i++){
					$field='place_image' . $i;
					$config['upload_path'] = "./media/store/";
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
						
						$dir="./media/store/";
						//echo "$dir";
						$new_name="./media/store/low";
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
						
						
						$data_image=array(
							"store_id" => $id,
							"store_image_link" => $name2['file_name'],							
							"created_by" => $this->session->userdata("admin_id"),
							"created_date" => date("Y-m-d h:i:s")
						);
						$this->global_model->save_data($data_image,"store_image");
						
					}
				}
			
			// input log
			$action="Create Store ".$post["store_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("store");
		}		
	}

	
	
	public function edit($id)
	{
		
	    
		$data["data"] = $this->store_model->get_data($id);
		$data["printer"]=$this->global_model->get_dropdown("printer","where deleted='0' ","printer_id","printer_name");
		$data["page"]="store/edit";
		$data["title"]="Store Edit";

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
		
		 
		$this->global_model->delete_data($id, 'store_id', 'store');
		redirect("store");
	}
	
	function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/store/'.$image.'';
			$config2['new_image'] = './media/store/low/'.$image.'';
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

