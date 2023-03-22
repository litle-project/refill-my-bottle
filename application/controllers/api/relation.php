<?php
class Relation extends CI_Controller{
    
     function __construct(){
        parent::__construct();
        //$this->load->model("api_model/place_model");
        $this->load->model("global_model");
        // $this->load->model("api_model/station_model");
        $this->load->model("api_model/member_model");
        header('Content-Type: application/json');
    }

    function index(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                if(count($data_app)>0){
                    $hasil_query = $this->global_model->get_data("*","relation","where status='1'")->result_array();
                        if(!empty($hasil_query)){
                        $array = array();
                            foreach ($hasil_query as $key) {
    //                                     //print_r($key);die();
                                $json["RELATION_ID"]            = $key["relation_id"];
                                $json["RELATION_NAME"]          = $key["relation_name"];
                                $json["RELATION_DESCRIPTION"]   = $key["relation_description"];
                                
                                $array[] = $json; 
                            }
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="RELATION LIST";
                            $data["DATA"]=$array;
                    }else{
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="DATA NOT FOUND";
                        $data["DATA"]=$array;
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