<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_tns extends CI_Controller {
        
        
        public function __construct(){
		parent :: __construct();
		$this->load->model('admin_tns_model');
		$this->load->model("global_model");
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
			
        	// print_r($this->sesion->id); die();
            $content=array(
            	// "content_id"		=> $post["content_id"],
                "tns_type"		=> "0",
                "tns_title_1"	=> $post['tns_title_1'],
            	"tns_title_2"	=> $post['tns_title_2'],
            	"tns_title_3"	=> $post['tns_title_3'],
            	"tns_1"			=> $post['tns_1'],
            	"tns_2"			=> $post['tns_2'],
            	"tns_3"			=> $post['tns_3'],
                "created_date"		=> date("Y-m-d H:i:s"),
                "created_by"		=> $this->session->userdata("admin_id"),
            );
            $this->db->where("tns_id", $post["tns_id"]);
            $this->db->update("termservice", $content);
            
            $action="Update HOME CONTENT " . $post['tns_title_1'];
            $this->Aktiviti_log_model->create($action);
        }
        $data["data"] = $this->admin_tns_model->get_data();
       
        // print_r($data["data"]); die();
		$data["page"]="tns/view";
		$data["title"]="Manage Terms Service And Privacy";
		$this->load->view('admin',$data);
	}
        
        
}

