<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_member extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("admin_member_model");
		$this->load->model("global_model");
	}
	

	public function index()
	{
		priv("view");
	    
		$data["data"] = $this->global_model->get_data_join("*","member a", "where a.status = '1' and a.deleted = '0'", "inner join member_profile as b on b.member_id = a.member_id")->result_array();
		$data["page"]="member/view";
		$data["title"]="Member List";

		$this->load->view('admin',$data);
	}

	public function detail($id)
	{
		priv("view");
	    
		$data["data"] = $this->admin_member_model->get_data($id);
		$data["page"]="member/detail";
		$data["title"]="Member Detail";


		$this->load->view('admin',$data);
	}

}

