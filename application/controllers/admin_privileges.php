<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_privileges extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_model");
		$this->load->model('Aktiviti_log_model');
		/*
		$link=$this->uri->segment(2);
		if(empty($link))
		{
			$link="view";
		}
		
		if($link=="privileges"){
			$link="other";
		}
		
		priv($link);
		*/
	}

	public function index()
	{
		priv("view");
		$data["page"]="privileges/view";
		$data["title"]="User Privileges";
		//$data["menu"]=$this->admin_model->menu();
		$data["user_group"]=$this->admin_model->user_group();
		
		
		
		
		$this->load->view('admin',$data);
	}
	
	function privileges(){
	
		priv("other");
		$menu_all=$this->admin_model->menu_privileges();
			
		$user_privileges=$this->admin_model->user_privileges($this->uri->segment(3));
		
		// echo"<pre>"; print_r($user_privileges);	die();	
		if($this->input->post()){
			$post=$this->input->post();
			

			//$data=array();
			$n=0;
			foreach($menu_all as $row2){
				$no=0;
				foreach($row2["menu"] as $row)
				{
					if($row['menu_view']==1){
						
						if(isset($post['view_'.$row['menu_id']]))
						{
							$data["menu_view"] = $post['view_'.$row['menu_id']]; 
						}else{
							$data["menu_view"] = "0";
						}
					
					}else{
						$data["menu_view"] = "0";
					}
					
					if($row['menu_add']==1){
						
						if(isset($post['add_'.$row['menu_id']]))
						{
							$data["menu_add"] = $post['add_'.$row['menu_id']];
						}else{
							$data["menu_add"] = "0";
						}
						
					}else{
						$data["menu_add"] = "0";
					}
					
					if($row['menu_edit']==1){
						
						if(isset($post['edit_'.$row['menu_id']]))
						{	
							$data["menu_edit"] = $post['edit_'.$row['menu_id']];
						}else{
							$data["menu_edit"] = "0";
						}
						
					}else{
						$data["menu_edit"] = "0";
					}
						
					if($row['menu_delete']==1){
						if(isset($post['delete_'.$row['menu_id']])){
							$data["menu_delete"] = $post['delete_'.$row['menu_id']];
						}else{
							$data["menu_delete"] = "0";
						}
					}else{
							$data["menu_delete"] = "0";
					}
						
					if($row['menu_other']==1){
						if(isset($post['other_'.$row['menu_id']])){
							$data["menu_other"] = $post['other_'.$row['menu_id']];
						}else{
							$data["menu_other"] = "0";
						}
					}else{
							$data["menu_other"] = "0";
					}
					
					$data["menu_id"] = $row['menu_id'];
					$data["user_group_id"] = $this->uri->segment(3);
					
					if(isset($post['view_'.$row['menu_id']])){
						//echo $this->admin_model->cek_available(1,$row['menu_id'])." ".$row['menu_id']." ".$post['view_'.$row['menu_id']]."<br>";
					}
					
					if( $this->admin_model->cek_available($this->uri->segment(3),$row['menu_id']) == "1")
					{
						
						$data["updated_date"] = date("Y-m-d H:i:s");	
						$data["updated_by"] = $this->session->userdata("admin_id");	
						$this->db->where("user_group_id",$this->uri->segment(3));
						$this->db->where("menu_id",$row['menu_id']);
						$this->db->update("user_privileges",$data);
						
						//echo "a";
					}else{
						//echo "b";
						
						$data["created_date"] = date("Y-m-d H:i:s");
						$data["created_by"] = $this->session->userdata("admin_id");	
						$this->db->insert("user_privileges",$data);
						
						
					}
				
				$no++;
				}
				
			$n++;
			}
			
			$action="Setting Privileges ID ".$this->uri->segment(3);
			$this->Aktiviti_log_model->create($action);
		}
	
		$data["page"]="privileges/privileges";
		$data["title"]="User Privileges";


		$data["menu_privileges"]=$this->admin_model->menu_privileges();	
		$data["user_privileges"]=$this->admin_model->user_privileges($this->uri->segment(3));	
		

		$this->load->view('admin',$data);		
	}
	
	function add(){
		priv("add");
		if($this->input->post()){
		
			$post=$this->input->post();
			$input=array(
						"user_group_name" => $post["priv_name"],
						"user_group_desc" => $post["priv_desc"],
						"created_by" => $this->session->userdata("admin_id"),
						"created_date" => date("Y-m-d H:i:s"),
						);
			$this->db->insert("user_group",$input);
			
				$action="Create New Privileges ".$post["priv_name"];
				$this->Aktiviti_log_model->create($action);
				
			redirect("admin_privileges");
			
		}
		
		$data["page"]="privileges/add";
		$data["title"]="Add Privileges";
		$this->load->view('admin',$data);	
	}
	
	function edit($id){
		priv("edit");
		if($this->input->post()){
		
			$post=$this->input->post();
			$input=array(
						"user_group_name" => $post["priv_name"],
						"user_group_desc" => $post["priv_desc"],
						"created_by" => $this->session->userdata("admin_id"),
						"created_date" => date("Y-m-d H:i:s"),
						);
			$this->db->where("user_group_id",$id);			
			$this->db->update("user_group",$input);
			
				$action="Edit Privileges ".$post["priv_name"];
				$this->Aktiviti_log_model->create($action);
				
			redirect("admin_privileges");
			
		}
		
		$data["user_group"]=$this->admin_model->user_group($id);
		$data["page"]="privileges/edit";
		$data["title"]="Edit Privileges";
		$this->load->view('admin',$data);	
	}
	
	function delete($id){
		priv("delete");
		$data=array(
			"deleted" => "1",
			);
		$this->db->where("user_group_id",$id);
		$this->db->update("user_group",$data);
		
		$action="Delete Privileges ID ".$id;
		$this->Aktiviti_log_model->create($action);
		
		redirect("admin_privileges");
	}
}

