<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Feedback extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
	}
	

	public function index()
	{
		priv("view");
	    
		$data["data"] 	= $this->global_model->get_data_join("*","feedback a","left join member_profile as b on b.member_id = a.member_id left join station as c on c.station_id = a.station_id", "")->result_array();
		// print_r($data['data']); die();
		$data["page"]	= "feedback/view";
		$data["title"]	= "Feedback List";

		$this->load->view('admin',$data);
	}

	public function detail($id)
	{
		priv("view");
	    
		$data["data"] 	= $this->global_model->get_data_join("*","feedback a", "where feedback_id ='".$id."'", "left join member_profile as b on b.member_id = a.member_id left join station as c on c.station_id = a.station_id")->result_array();
		// echo "<pre>"; print_r($data["data"]); die();
		$data["page"]	= "feedback/detail";
		$data["title"]	= "Feedback Detail";


		$this->load->view('admin',$data);
	}

}

