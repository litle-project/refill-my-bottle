<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_tips extends CI_Controller {
        
        
        public function __construct(){
		parent :: __construct();
		$this->load->model('admin_tips_model');
		$this->load->model('Aktiviti_log_model');
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
                $data["data"] = ($this->admin_tips_model->get_data());
		$data["page"]="tips/view";
		$data["title"]="Manage Contact Content";
		$this->load->view('admin',$data);
	}
        public function edit($id="")
	{
                if($this->input->post()){
                    $post=$this->input->post();
                    $data=array(
                        "content_title" => $post["content_title"],
                        "content" => $post["content"],
                    );
                    $this->db->where("content_id", $post["content_id"]);
                    $this->db->update("content",$data);
                    
                    $action="Update Tips CONTENT " . $post['content_title'];
                    $this->Aktiviti_log_model->create($action);
                    redirect("admin_tips");
                }
                
                $data["data"]=$this->admin_tips_model->get_data($id);
		$data["page"]="tips/edit";
		$data["title"]="Update Tips";
		$this->load->view('admin',$data);
	}
        public function add(){
                if($this->input->post()){
                    $post = $this->input->post();
                    $data_input = array(
                                        "content_title" => $post["content_title"],
                                        "content" => $post["content"],
                                        "content_type" => "4",
                                    );
                    $this->db->insert("content", $data_input);
                    $action="Update Tips CONTENT " . $post['content_title'];
                    $this->Aktiviti_log_model->create($action);
                    redirect("admin_tips");
                }
                
                $data["data"]=$this->admin_tips_model->get_data();
		$data["page"]="tips/add";
		$data["title"]="Add Tips";
		$this->load->view('admin',$data);
        }
        
        function delete($id){
            $data_update = array("deleted_flag"=> "1");
            $this->db->where("content_id", $id);
            $this->db->update("content", $data_update);
            
            $action="Delete Tips CONTENT ";
            $this->Aktiviti_log_model->create($action);
            redirect("admin_tips");
        }
        
}

