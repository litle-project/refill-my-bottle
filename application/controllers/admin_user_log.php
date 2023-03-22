<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_user_log extends CI_Controller {
    
        public function __construct(){
		parent :: __construct();
		
		$this->load->model('Aktiviti_log_model');
		/*$link=$this->uri->segment(2);
		if(empty($link))
		{
			$link="view";
		}
		
		priv($link);*/
                
	}
        
        public function index()
	{
		priv("view");
		$data["user_group"] = ($this->Aktiviti_log_model->get_data());
		$data["page"]="user/log";
		$data["title"]="Activity Log";
		$this->load->view('admin',$data);
	}
        
        public function view($page="")
	{
                
                priv("view");
                $data["data"] = ($this->Aktiviti_log_model->get_data());
		$data["page"]="user/log";
		$data["title"]="Activity Log";
		$this->load->view('admin',$data);
                
	}
}