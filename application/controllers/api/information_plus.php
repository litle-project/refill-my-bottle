<?php
class Information_plus extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('api_model/information_model_plus');

		header('Content-Type: application/json');
	}
	
	function state(){
		$headers = apache_request_headers();
		if ($headers["APP_TOKEN"] != "") {
		    
		    	$info = $this->information_model_plus->get_state();
		    	print_r($info);die();
		    	if (count($info) > 0) {	
		    	// print_r($info);die();
		    		foreach ($info as $row) {
		    			$data['ID'] = $row['state_id'];
                        $data['NAME_STATE']   = $row['state_name'];
                        $data['NAME_COUNTRY']   = $row['country_name'];
		    			$result[] = $data;
		    		}

		     		$data["STATUS"]="SUCCESS";
					$data["MESSAGE"]="COUNTRY LIST";
					$data["DATA"]=$result;

		    	}else{
		    		$data["STATUS"]="FAILED";
					$data["MESSAGE"]="NO DATA FOUND";
					$data["DATA"]=array();
		    	}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="INVALID APP TOKEN";
			$data["DATA"]=array();
		}       
		echo json_encode($data);
    }

    function getCountry(){
		$headers = apache_request_headers();
		if ($headers["APP_TOKEN"] != "") {
		    $data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
		    if (count($data_app) > 0) {
		    	$info = $this->country_model->getDataCountry();
		    	if (count($info) > 0) {	
		    	// print_r($info);die();
		    		foreach ($info as $row) {
		    			$array["ID"] = $row["country_id"];
		    			$array["COUNTRY_CODE"] = $row["country_code"];
		    			$array["COUNTRY_NAME"] = $row["country_name"];
		    			$array["CODE_TELP"] = $row["code_telp"];
		    			$result[] = $array;
		    		}

		     		$data["STATUS"]="SUCCESS";
					$data["MESSAGE"]="COUNTRY LIST";
					$data["DATA"]=$result;

		    	}else{
		    		$data["STATUS"]="FAILED";
					$data["MESSAGE"]="NO DATA FOUND";
					$data["DATA"]=array();
		    	}
		    }else{
		    	$data["STATUS"]="FAILED";
				$data["MESSAGE"]="APP TOKEN NOT VALID";
				$data["DATA"]=array();
		    }
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="EMPTY HEADERS NOT ALLOWED";
			$data["DATA"]=array();
		}       
		echo json_encode($data);
    }

    function getPhoneCountry(){
		$headers = apache_request_headers();
		if ($headers["APP_TOKEN"] != "") {
		    $data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
		    if (count($data_app) > 0) {
		    	$code = $this->input->get_post('CODE');
		    	$info = $this->country_model->getDataCountry($code);
		    	if (count($info) > 0) {	
		    	// print_r($info);die();
		    		foreach ($info as $row) {
		    			$array["ID"] = $row["country_id"];
		    			$array["COUNTRY_CODE"] = $row["country_code"];
		    			$array["COUNTRY_NAME"] = $row["country_name"];
		    			$array["CODE_TELP"] = $row["code_telp"];
		    			$result[] = $array;
		    		}

		     		$data["STATUS"]="SUCCESS";
					$data["MESSAGE"]="COUNTRY LIST";
					$data["DATA"]=$result;

		    	}else{
		    		$data["STATUS"]="FAILED";
					$data["MESSAGE"]="NO DATA FOUND";
					$data["DATA"]=array();
		    	}
		    }else{
		    	$data["STATUS"]="FAILED";
				$data["MESSAGE"]="APP TOKEN NOT VALID";
				$data["DATA"]=array();
		    }
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="EMPTY HEADERS NOT ALLOWED";
			$data["DATA"]=array();
		}       
		echo json_encode($data);
    }

     function getPhoneCountryV2(){
		$headers = apache_request_headers();
		if ($headers["APP_TOKEN"] != "") {
		    $data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
		    if (count($data_app) > 0) {
		    	$code = $this->input->get_post('CODE');
		    	$info = $this->country_model->getDataCountryV2($code);
		    	if (count($info) > 0) {	
		    	// print_r($info);die();
		    		foreach ($info as $row) {
		    			$array["ID"] = $row["country_id"];
		    			$array["COUNTRY_CODE"] = $row["country_code"];
		    			$array["COUNTRY_NAME"] = $row["country_name"];
		    			$array["CODE_TELP"] = $row["code_telp"];
		    			$result[] = $array;
		    		}

		     		$data["STATUS"]="SUCCESS";
					$data["MESSAGE"]="COUNTRY LIST";
					$data["DATA"]=$result;

		    	}else{
		    		$data["STATUS"]="FAILED";
					$data["MESSAGE"]="NO DATA FOUND";
					$data["DATA"]=array();
		    	}
		    }else{
		    	$data["STATUS"]="FAILED";
				$data["MESSAGE"]="APP TOKEN NOT VALID";
				$data["DATA"]=array();
		    }
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="EMPTY HEADERS NOT ALLOWED";
			$data["DATA"]=array();
		}       
		echo json_encode($data);
    }

}
