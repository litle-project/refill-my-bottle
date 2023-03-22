<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pop_up extends CI_Controller
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
       		$popup = $this->global_model->get_data("*","pop_up","where status='1'")->result_array();
       		// print_r($blog); die();
        		if(!empty($popup)){
        			foreach ($popup as $row) {

        				$data['POP_UP_ID']        = $row['popup_id'];
                        $data['POP_UP_CONTENT'] 	= $row['popup_content'];
        				$data['POP_UP_IMAGE'] 		= base_url()."media/pop_up/".$row['popup_image'];
        				$result[] = $data;
        			}
        			$json['STATUS'] = 'SUCCESS';
        			$json['MESSAGE'] = 'POP UP';
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