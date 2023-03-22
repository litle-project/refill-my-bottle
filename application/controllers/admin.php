<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_model");
		$this->load->model("dashboard_model");
		$this->load->model('global_model'); 
		$admin_id=$this->session->userdata("admin_id");
		if(empty($admin_id)){
			redirect("login_admin");	
				
		}
	}
	
	public function index()
	{
		$data["title"]			= "Dashboard";
		$data['member'] 		= $this->global_model->get_data('COUNT(member_id) as total_member','member', 'where status = "1" AND deleted = "0"')->result_array();
		$data['station'] 		= $this->global_model->get_data('COUNT(station_id) as total_station','station', 'where status = "1"')->result_array();
		$data['feedback'] 		= $this->global_model->get_data('COUNT(feedback_id) as total_feedback','feedback', '')->result_array();
		$data['bottle'] 		= $this->global_model->get_data('COUNT(saved_id) as total_saved','bottle_saved', '')->result_array();
		$date = date('Y-m');
		$data['best_station'] 	= $this->dashboard_model->sell_monthly($date);
		// echo "<pre>"; print_r($data['best_station']); die();
		$data["page"]	= "main/admin";
		$this->load->view('admin',$data);
	}
	
	
	function sell_monthly(){
		// echo "<pre>"; print_r($data);
		 // die();
	}
}
