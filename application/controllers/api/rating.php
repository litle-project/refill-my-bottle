<?php
class Rating extends CI_Controller{
    
     function __construct(){
        parent::__construct();
        //$this->load->model("api_model/place_model");
        $this->load->model("global_model");
        // $this->load->model("api_model/refil_model");
        $this->load->model("api_model/member_model");
        header('Content-Type: application/json');
    }

    function index(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            // print_r($data_user); die();
            if(count($data_user)>0){
                $station_id   = $this->input->get_post("STATION_ID");
                $rating       = $this->input->get_post("RATING");
                $review       = $this->input->get_post("REVIEW");
                $data_app     = $this->member_model->check_app($headers["APP_TOKEN"]);
                // print_r($refil_id); die();
                if(count($data_app)>0){
                    if (!empty($station_id)){
                    $get_member = $this->global_model->get_data("*","member", "where token='".$headers['USER_TOKEN']."'")->result_array();
                    $check_refil  = $this->global_model->get_data("*","rating","where station_id='".$station_id."' AND member_id='".$get_member[0]['member_id']."'")->result_array();
                        if (!empty($check_refil)) {
                            $array = array();
                            $input['rating']         = $rating;
                            $input['review']         = $review;
                            $input['status']         = '1';
                            $this->db->where("station_id", $station_id);
                            $this->db->where("member_id", $get_member[0]['member_id']);
                            $this->db->update("rating", $input);

                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="YOU RATING & REVIEW HAS UPDATED";
                            $data["DATA"]=$array;
                        }else{
                            $array = array();
                            $input1['rating']         = $rating;
                            $input1['review']         = $review;
                            $input1['station_id']     = $station_id;
                            $input1['member_id']      = $get_member[0]['member_id'];
                            $input1['status']         = '1';
                            $this->db->insert("rating", $input1);

                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="YOU RATING & REVIEW HAS SENT";
                            $data["DATA"]=$array;
                            }
                    }else{
                        $data["STATUS"]="FAILED";
                        $data["MESSAGE"]="NO DATA FOUND";
                        $data["DATA"]=array();
                    }
                    
                }else{
                    $data["STATUS"]="FAILED";
                    $data["MESSAGE"]="NO DATA";
                    $data["DATA"]=array();
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
    echo json_encode($data);
    }
    



}