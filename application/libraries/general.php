<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class General{

	public function checkAppToken($appToken){
		$CI =& get_instance();
		$CI->load->model('api_model/member_model');
		if(!empty($appToken)){
			$data_app = $CI->member_model->check_app($appToken);
			if(count($data_app) > 0){
				$result = '1';
			}else{
				$result = '0';
			}
		}else{
			$result = '0';
		}
		return $result;
	}

	public function generateToken(){
		$CI =& get_instance();
		$CI->load->model('api_model/member_model');
		$headerData = array(
	        "APP_TOKEN: ".$GLOBALS['APP_TOKEN']."",
		);
		$post = array(
			'API_USERNAME' => $GLOBALS['USERNAME'],
			'API_PASSWORD' => $GLOBALS['PASSWORD'],
			'MERCHANT_ID' => $GLOBALS['MERCHANTID'],
		);
		$URL = $GLOBALS['URLCTRSAKHMAD'].'/ctrs/get_user_token';
		$utc = time();
	    $ch = curl_init();
	    $curlOpts = array(
	        CURLOPT_URL => $URL,
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_HTTPHEADER => $headerData,
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_FRESH_CONNECT => true,
	        CURLOPT_FTPAPPEND => true,
	        CURLOPT_NOPROGRESS => false,
	        CURLOPT_POST => true,
	        CURLOPT_POSTFIELDS => $post,
	        CURLOPT_HEADER => 0,
	        CURLOPT_FORBID_REUSE => 1, 
        	CURLOPT_TIMEOUT => 4000000, 
	    );
	    curl_setopt_array($ch, $curlOpts);
	    $answer = curl_exec($ch);
	    // If there was an error, show it
	    if (curl_error($ch)) {
	        die(curl_error($ch));
	    }

	    curl_close($ch);
	    $resultToken = json_decode($answer,true);
	    // echo '<pre>';
	    // print_r($resultToken);die();
	    $inputArray = array(
	    	'labs_token' => $resultToken['DATA']['TOKEN'],
	    	'request_date' => date('Y-m-d H:i:s'),
	    	'user_id' => '4',
	    	);
	    $table = 'ctrs_user_token';
	    $CI->member_model->insert($inputArray,$table);
	    return json_decode($answer, true);
	}

	public function generateTokenSave(){
		$CI =& get_instance();
		$CI->load->model('api_model/member_model');
		$headerData = array(
	        "APP_TOKEN: ".$GLOBALS['APP_TOKEN']."",
		);
		$post = array(
			'API_USERNAME' => $GLOBALS['USERNAME'],
			'API_PASSWORD' => $GLOBALS['PASSWORD'],
			'MERCHANT_ID' => $GLOBALS['MERCHANTID'],
		);
		$URL = $GLOBALS['URLCTRSAKHMAD'].'/ctrs/get_user_token';
		$utc = time();
	    $ch = curl_init();
	    $curlOpts = array(
	        CURLOPT_URL => $URL,
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_HTTPHEADER => $headerData,
	        CURLOPT_FOLLOWLOCATION => true,
	        CURLOPT_FRESH_CONNECT => true,
	        CURLOPT_FTPAPPEND => true,
	        CURLOPT_NOPROGRESS => false,
	        CURLOPT_POST => true,
	        CURLOPT_POSTFIELDS => $post,
	        CURLOPT_HEADER => 0,
	        CURLOPT_FORBID_REUSE => 1, 
        	CURLOPT_TIMEOUT => 4000000, 
	    );
	    curl_setopt_array($ch, $curlOpts);
	    $answer = curl_exec($ch);
	    // If there was an error, show it
	    if (curl_error($ch)) {
	        die(curl_error($ch));
	    }

	    curl_close($ch);
	    $resultToken = json_decode($answer,true);
	    // echo '<pre>';
	    // print_r($resultToken);die();
	    $inputArray = array(
	    	'labs_token' => $resultToken['DATA']['TOKEN'],
	    	'request_date' => date('Y-m-d H:i:s'),
	    	'user_id' => '4',
	    	'status' => '1',
	    	);
	    $table = 'ctrs_user_token';
	    $CI->member_model->insert($inputArray,$table);
	    return json_decode($answer, true);
	}

	function checkApiToken(){
		$CI =& get_instance();
		$CI->load->model('api_model/member_model');
		$user_token = $CI->member_model->get_api_token();
		$check_token = $CI->member_model->select("ctrs_user_token","*",array("labs_token"=>$user_token[0]['labs_token'], "TIMESTAMPDIFF(HOUR, request_date, now()) <= 22"=>""))->row_array();
		if(!empty($check_token)){
			$query = $check_token['labs_token'];
		}else{
			$queryResult = $this->generateToken();
			$query = $queryResult['DATA']['TOKEN'];
		}
		return $query;
	}

	function check_if_not_failed($headers,$member_id,$type) {
        $newdata["STAT"] = FALSE;
        $CI =& get_instance();
		$CI->load->model('api_model/member_model');
        if(!empty($headers["APP_TOKEN"])){

            $data_app = $CI->member_model->check_app($headers["APP_TOKEN"]);
            if(count($data_app)>0){
                if($type == TRUE) {
                    $data_user = $this->member_model->check_staff($headers["USER_TOKEN"],$member_id);
                    if(count($data_user)>0){ 
                        $newdata["STAT"] = TRUE;
                    }else{
                        $newdata["STATUS"] = "FAILED";
                        $newdata["MESSAGE"] = "YOUR SESSION IS EXPIRED. PLEASE RE-LOGIN";
                        $newdata["DATA"] = array();
                    }
                } else {
                    $newdata["STAT"] = TRUE;
                }
            }else{
                $newdata["STATUS"] = "FAILED";
                $newdata["MESSAGE"] = "APP TOKEN INVALID";
                $newdata["DATA"] = array();
            }
        }else{
            $newdata["STATUS"] = "FAILED";
            $newdata["MESSAGE"] = "PLEASE INPUT APP TOKEN & USER TOKEN";
            $newdata["DATA"] = array();
        }
        return $newdata;
    }

    function cek_null($var,$image_path=""){    
        if( empty($var) ){            
            return "";           
        }else{
            if($image_path!="") {
                return $image_path."/".$var;
            } else{
                return $var;
            }
        }
    }

}