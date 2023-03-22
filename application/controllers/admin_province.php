<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_province extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_province_model");
	}
	
	public function index()
	{
		priv("view");
		$data["title"]="Province";
		$data["page"]="province/view";
		$data["get_data"]=$this->admin_province_model->get_data();
		$this->load->view('admin',$data);
	}
	
	function add(){
		priv("add");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			$input = array(
						"province_name" => $post["province_name"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->insert("province",$input);
			
			$action="Add Province Name " . $post["province_name"];
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_province");
		endif;
		
		$data["title"]="Add Province";
		$data["page"]="province/add";

		$this->load->view('admin',$data);
	}
	
	function edit($id){
		priv("edit");
		
		if($this->input->post()):
			$post = $this->input->post(); 
			
			$input = array(
						"province_name" => $post["province_name"],
						"created_date" => date("Y-m-d H:i:s"),
						"created_by" => $this->session->userdata("admin_id")
						);
			
			$this->db->where("province_id",$id);
			$this->db->update("province",$input);
			
			$action="Edit Province ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			
			redirect("admin_province");
		endif;
		
		$data["title"]="Edit Province";
		$data["page"]="province/edit";
		$data["get_data"]=$this->admin_province_model->get_data($id);
		$this->load->view('admin',$data);
	}
	
	
	
	function delete($id){
		priv("delete");
			$data=array(
						"deleted" => "1",
						);
						
			$this->db->where("province_id",$id);
			$this->db->update("province",$data);
			
			$action="Delete Province ID " . $id;
			$this->Aktiviti_log_model->create($action);
			
			redirect("admin_province");
	
	}
	

}
