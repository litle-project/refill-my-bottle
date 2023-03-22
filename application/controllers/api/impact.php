<?php
class Impact extends CI_Controller{
    
     function __construct(){
        parent::__construct();
        //$this->load->model("api_model/place_model");
        $this->load->model("global_model");
        $this->load->model("api_model/member_model");
        header('Content-Type: application/json');
    }

    
    function index(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app           = $this->member_model->check_app($headers["APP_TOKEN"]);
                if(count($data_app)>0){
                    // $member_id = $this->global_model->get_data("*", "member", "where token = '".$headers['USER_TOKEN']."'")->result_array();
                    $impact = $this->global_model->get_data('*', 'impact', "where status = '1'")->result_array();
                    if (!empty($impact)) {
                        
                        foreach ($impact as $key) {
                        	$json['IMPACT_TOTAL']	= $key['impact_total'];
                        	$json['IMPACT_DESC']	= $key['impact_desc'];
                        	$json['IMPACT_IMAGE']	= base_url('media/impact/'.$key['impact_image']);

                        	$array[] = $json;

                        }
                        	$data["STATUS"]     	= "SUCCESS";
                        	$data["MESSAGE"]    	= "THIS IMPACT DATA!";
                        	$data["DATA"]       	= $array;
                    }else{
                        $data["STATUS"]     = "FAILED";
                        $data["MESSAGE"]    = "NO DATA FOUND!";
                        $data["DATA"]       = array();
                    }
                }else{
                    $data["STATUS"]="FAILED";
                    $data["MESSAGE"]="INVALID APP_TOKEN";
                    $data["DATA"]=array();
                    }
            }else{
                $data["STATUS"]="FAILED";
                $data["MESSAGE"]="INPUT USER TOKEN";
                $data["DATA"]=array();
                }
        }else{
            $data["STATUS"]="FAILED";
            $data["MESSAGE"]="PLEASE LOGIN";
            $data["DATA"]=array();
            }
        echo json_encode($data);
    }
}