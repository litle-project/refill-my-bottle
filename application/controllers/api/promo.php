<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		header('Content-Type: application/json');
		$this->load->model('api_model/promo_list_model');
        $this->load->model('global_model');
		$this->load->library('get_api');
	}

	public function promo_list(){

         $station = $this->input->post("STATION_ID");
         $headers = apache_request_headers();
         	if(!empty($headers['APP_TOKEN'])){
       		$list = $this->promo_list_model->promo_list($station);
           		if(!empty($list)){

       // print_r($blog); die();
        			foreach ($list as $row) {
                        $data['STATION_ID'] 			= $row['station_id'];
                        $data['PROMO_ID']   			= $row['promo_id'];
                        $data['PROMO_NAME']     		= $row['promo_name'];
                        $data['PROMO_DESCRIPTION']      = $row['promo_desc'];
                        $data['IMAGE']    	   		    = base_url()."media/promo/".$row['image_promo'];
        				$data['IMAGE_RESIZE']           = base_url()."media/promo/image_resize/".$row['image_convert'];

        				$result = $data;
        			}
        			$json['STATUS']  = 'SUCCESS';
        			$json['MESSAGE'] = 'PROMO_LIST';
        			$json['DATA']  	 = $result;
        		}else{
        			$json['STATUS']  = 'FAILED';
        			$json['MESSAGE'] = 'NO DATA FOUND';
        			$json['DATA'] 	 = (object) array();
        		}
        	}else{
        		$json['STATUS'] 	 = 'FAILED';
    			$json['MESSAGE']     = 'INVALID APP_TOKEN';
    			$json['DATA']        = (object) array();
        	}
		echo json_encode($json);
         
    }

public function promo_detail(){

         $promo = $this->input->post("PROMO_ID");
         $headers = apache_request_headers();
         	if(!empty($headers['APP_TOKEN'])){
       		$detail = $this->promo_list_model->promo_detail($promo);
           if(!empty($detail)){

       // print_r($blog); die();
        			foreach ($detail as $row) {
                        $data['PROMO_DETAIL_ID'] 	= $row['promo_detail_id'];
                        $data['PROMO_ID']   = $row['promo_id'];
                       
                        $data['TITLE']     = $row['title'];
                        $data['T_N_C']     = $row['t_n_c'];
                          $data['PROMO_NAME']     = $row['promo_name'];
                        $data['PROMO_DESCRIPTION']     = $row['promo_desc'];
                          $data['PROMO_NAME']     = $row['promo_name'];
                        $data['PROMO_DESCRIPTION']     = $row['promo_desc'];
                        $data['IMAGE']     = base_url()."media/promo/".$row['image_promo'];
        				$data['IMAGE_RESIZE']     = base_url()."media/promo/image_resize/".$row['image_convert'];

        				$result = $data;
        			}
        			$json['STATUS'] = 'SUCCESS';
        			$json['MESSAGE'] = 'PROMO_DETAIL';
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
?>