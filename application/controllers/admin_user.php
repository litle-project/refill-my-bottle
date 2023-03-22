<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_user_model");
		$this->load->model('Aktiviti_log_model');
		
	}
	

	public function index()
	{
		priv("view");
		$data["page"]="user/view";
		$data["title"]="Manage User";
		$data["get_user"]=$this->admin_user_model->get_user();
		$this->load->view('admin',$data);
	}
	
	function add(){
		priv("add");
		$branch_id="";
		if($this->input->post()){
			$post=$this->input->post();
			
			$config['upload_path'] = './media/user/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '100';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("photo"))
			{
				// $error = array('error' => $this->upload->display_errors());
				
				// print_r("<pre>");
				// print_r($error);
				// print_r("</pre>");
				// $this->load->view('upload_form', $error);
				$file = $this->upload->data();
				if($post["priv"]=="1"):
					$branch_id="";
				else:
					$branch_id=$post["branch_id"];
				endif;
				
				
				$this->image_resize($file["file_name"]);
				$input=array(
						"admin_username" => $post["username"],
						"admin_password" => md5($post["password1"]),
						"admin_email" => $post["email"],
						"admin_name" => $post["name"],
						"admin_photo" => "default_refill.jpeg",
						"user_group_id" => $post["priv"],
						//"branch_id" => $branch_id,
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id"),
						
						);
						
				$this->db->insert("admin",$input);
				$action="Create User Name ".$post["username"];
				$this->Aktiviti_log_model->create($action);
			}
			else
			{
				$file = $this->upload->data();
				if($post["priv"]=="1"):
					$branch_id="";
				else:
					$branch_id=$post["branch_id"];
				endif;
				
				
				$this->image_resize($file["file_name"]);
				$input=array(
						"admin_username" => $post["username"],
						"admin_password" => md5($post["password1"]),
						"admin_email" => $post["email"],
						"admin_name" => $post["name"],
						"admin_photo" => $file["file_name"],
						"user_group_id" => $post["priv"],
						//"branch_id" => $branch_id,
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id"),
						
						);
						
				$this->db->insert("admin",$input);
				$action="Create User Name ".$post["username"];
				$this->Aktiviti_log_model->create($action);
			}
			
			
			redirect("admin_user");
		}
		$data["page"]="user/add";
		
		$data["title"]="Add User";
		
		$data["priv"]=$this->admin_user_model->get_priv();
		//$data["rest"]=$this->admin_user_model->get_rest();
		$this->load->view('admin',$data);
	}
	
	function delete($id){
		priv("delete");

		$data=array(
					"deleted" => "1",
					);
		$this->db->where("admin_id",$id);
		$this->db->update("admin",$data);
		
		$action="Delete User ID ".$id;
		$this->Aktiviti_log_model->create($action);
		
		redirect("admin_user");
	
	}
	
	function edit($id){
		priv("edit");
		$branch_id="";
		if($this->session->userdata("user_group_id")>1){
			$id=$this->session->userdata("admin_id");
		}
		if($this->input->post()){
			$post=$this->input->post();
			
			
			if($post["photo_status"]==1){
			
				$config['upload_path'] = './media/user/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '768';

				$this->load->library('upload', $config);
				$this->upload->do_upload("photo");
				
				$file = $this->upload->data();
				$input["admin_photo"]=$file["file_name"];
				$this->image_resize($file["file_name"]);

			}
			
			if($post["pass_status"]==1){
				$input["admin_password"]=md5($post["password1"]);
			}
			
			if($post["priv"]=="1"):
				$branch_id="";
			else:
				$branch_id=$post["branch_id"];
			endif;
			
				$input["admin_username"]=$post["username"];
				$input["admin_email"]=$post["email"];
				$input["admin_name"]=$post["name"];
				$input["user_group_id"]=$post["priv"];
				//$input["branch_id"]=$branch_id;
				$input["updated_date"]=date("Y-m-d H:i:s");
				$input["updated_by"]=$this->session->userdata("admin_id");
				
				
				$this->db->where("admin_id",$id);
				$this->db->update("admin",$input);
				
				$action="Edit User". $post["username"];
				$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_user");
		}
		
		$data["page"]="user/edit";
		$data["title"]="Edit User";
		$data["get_user"]=$this->admin_user_model->get_user($id);
		
		//print_r($data["get_user"]);
		//echo $data["get_user"][0]["user_group_id"];
		/*if($data["get_user"][0]["user_group_id"]>1){
			$data["restaurant"]=$this->admin_user_model->rest($data["get_user"][0]["restaurant_location_id"]);
		
		}
		$data["rest"]=$this->admin_user_model->get_rest();*/
		$data["priv"]=$this->admin_user_model->get_priv();
		//$data["branch"] = $this->dropdown->set("branch","branch_id","branch_name");
		$this->load->view('admin',$data);
	}
	
	function get_loc(){
		$id=$this->input->post("rest_id");
		$this->db->where("deleted","0");
		$this->db->where("restaurant_id",$id);
		$query=$this->db->get("restaurant_location");
		echo "<option value=''>Please Select</option>";
		foreach($query->result_array() as $row){
			echo "<option value='".$row["restaurant_location_id"]."'>".$row["restaurant_location_desc"]."</option>";
		}
		
		
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
	
	
	
	
}

