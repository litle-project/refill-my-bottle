<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_home extends CI_Controller {
        
        
        public function __construct(){
		parent :: __construct();
		$this->load->model('admin_home_model');
		//$this->load->model('Aktiviti_log_model');
                //$this->load->model('files_model');
		$link=$this->uri->segment(2);
		if(empty($link))
		{
			$link="view";
		}
		
		if($link=="save"){
			$link="add";
		}
		
		if($link=="update"){
			$link="edit";
		}
		
		priv($link);
	}
        
	public function index()
	{
                if($this->input->post()){
                    $post=$this->input->post();
                    $data=array(
                        "content_title" => $post["content_title"],
                        "content" => $post["content"],
                    );
                    $this->db->where("content_id", $post["content_id"]);
                    $this->db->update("content",$data);
                    
                    $action="Update HOME CONTENT " . $post['content_title'];
                    $this->Aktiviti_log_model->create($action);
                }
                $data["data"] = ($this->admin_home_model->get_data());
		$data["page"]="home/view";
		$data["title"]="Manage Home";
		$this->load->view('admin',$data);
	}
        
        
}

