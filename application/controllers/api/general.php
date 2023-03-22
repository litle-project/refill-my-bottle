<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Content-Type: application/json');
		$this->load->model('global_model');
		$this->load->library('get_api');
	}

	public function about_us(){

		$headers = apache_request_headers();
		if(!empty($headers['APP_TOKEN'])){
       		$about = $this->global_model->get_data("*","content","where deleted='0'")->row_array();
        		if(!empty($about)){
                        $data['IMAGE_UTAMA']         = base_url()."media/about/".$about['image_utama'];
        				$data['TITLE_1']    = $about['content_title_1'];
        				$data['CONTENT_1']  = $about['content_1'];
        				$data['TITLE_2']    = $about['content_title_2'];
        				$data['CONTENT_2']  = $about['content_2'];
        				$data['TITLE_3']    = $about['content_title_3'];
        				$data['CONTENT_3']  = $about['content_3'];
        			$json['STATUS'] = 'SUCCESS';
        			$json['MESSAGE'] = 'ABOUT US';
        			$json['DATA'] = $data;
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

	function faq(){

		$headers = apache_request_headers();
		if(!empty($headers['APP_TOKEN'])){
       		$faq = $this->global_model->get_data("*","faq","where status='1'")->result_array();
        		if(!empty($faq)){
					// print_r($faq[1]['ask']); die();
        			foreach ($faq as $row) {

        				$data['ASK']		= $row['ask'];
        				$data['ANSWER'] 	= $row['answer'];
        				$result[] = $data;
        			}
        			$json['STATUS'] = 'SUCCESS';
        			$json['MESSAGE'] = 'FAQ';
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

	function partner()
	{
		$headers = apache_request_headers();
		if(!empty($headers['APP_TOKEN'])){
       		$partner = $this->global_model->get_data("*","partner","where status='1'")->result_array();
        		if(!empty($partner)){
					// print_r($faq[1]['ask']); die();
        			foreach ($partner as $row) {

        				$data['PARTNER_NAME']			= $row['partner_name'];
        				$data['PARTNER_DESCRIPTION'] 	= $row['partner_description'];
        				$data['PARTNER_IMAGE']		 	= base_url()."media/partner/".$row['partner_image'];
        				$data['PARTNER_URL'] 			= $row['partner_url'];
        				$result[] = $data;
        			}
        			$json['STATUS'] = 'SUCCESS';
        			$json['MESSAGE'] = 'PARTNER';
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


public function tns(){

        $headers = apache_request_headers();
        if(!empty($headers['APP_TOKEN'])){
            $tns = $this->global_model->get_data("*","termservice","where deleted='0'")->row_array();
                if(!empty($tns)){
                        $data['TITLE_1']    = $tns['tns_title_1'];
                        $data['TERMS_1']  = $tns['tns_1'];
                        $data['TITLE_2']    = $tns['tns_title_2'];
                        $data['TERMS_2']  = $tns['tns_2'];
                        $data['TITLE_3']    = $tns['tns_title_3'];
                        $data['TERMS_3']  = $tns['tns_3'];
                    $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'TERMS SERVICE AND PRIVACY';
                    $json['DATA'] = $data;
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

function contact_us()
    {
        $headers = apache_request_headers();
        if(!empty($headers['APP_TOKEN'])){
            $contact = $this->global_model->get_data("*","contact_us","where status='1'")->result_array();
                if(!empty($contact)){
                    // print_r($faq[1]['ask']); die();
                    foreach ($contact as $row) {

                        $data['CONTACT_ID']           = $row['contact_id'];
                        $data['CONTACT_TYPE']    = $row['contact_type'];
                         $data['CONTACT_TITLE']   = $row['contact_title'];
                        $data['CONTACT_IMAGE']          = base_url()."media/contact_us/".$row['image_contact'];
                        $data['CONTACT_TARGET']            = $row['contact_target'];
                        $result[] = $data;
                    }
                    $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'CONTACT_US';
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

/* End of file color.php */
/* Location: ./application/controllers/general/color.php */