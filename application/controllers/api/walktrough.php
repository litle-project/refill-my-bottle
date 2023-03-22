<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Walktrough extends CI_Controller
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
       		$splash = $this->global_model->get_data("*","splash","where status='1'")->result_array();
       		// print_r($blog); die();
        		if(!empty($splash)){
        			foreach ($splash as $row) {

        				$data['PAGE']        = $row['splash_page'];
                        $data['SPLASH_CONTENT'] 	= $row['splash_content'];
        				$data['SPLASH_IMAGE'] 		= base_url()."media/apps/splash/".$row['splash_image'];
        				$result[] = $data;
        			}
        			$json['STATUS'] = 'SUCCESS';
        			$json['MESSAGE'] = 'WALKTROUGH';
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