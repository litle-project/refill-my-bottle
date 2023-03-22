<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		header('Content-Type: application/json');
		$this->load->model('global_model');
		$this->load->library('get_api');
	}

	public function index()
	{
		$headers = apache_request_headers();
		if(!empty($headers['APP_TOKEN'])){
       		$blog = $this->global_model->get_data_join("*","blog_master a","where a.status='1'","left join blog_category as b on b.category_id = a.category_id")->result_array();
       		// print_r($blog); die();
        		if(!empty($blog)){
        			foreach ($blog as $row) {
        				$data['TITLE']		= $row['blog_title'];
        				$data['CONTENT']	= $row['blog_content'];
        				$data['CATEGORY']   = $row['category_name'];
        				$data['TAG'] 		= $row['tag'];
        				$result[] = $data;
        			}
        			$json['STATUS'] = 'SUCCESS';
        			$json['MESSAGE'] = 'BLOG';
        			$json['DATA'] = $result;
        		}else{
        			$json['STATUS'] = 'FAILED';
        			$json['MESSAGE'] = 'NO DATA FOUND';
        			$json['DATA'] = (object) array();
        		}
        	}else{
        		$json['STATUS'] = 'FAILED';
    			$json['MESSAGE'] = 'INVALID APP_TOKEN';
    			$json['DATA'] = (object) array();
        	}
		echo json_encode($json);
	}
}