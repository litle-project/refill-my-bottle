<?php
class Feedback extends CI_Controller{
    
     function __construct(){
        parent::__construct();
        //$this->load->model("api_model/place_model");
        $this->load->model("global_model");
        $this->load->model("api_model/event_model");
        $this->load->model("api_model/member_model");
        header('Content-Type: application/json');
    }

    
    function index(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app           = $this->member_model->check_app($headers["APP_TOKEN"]);
                $feedback_content   = $this->input->get_post('CONTENT');
                $station_id         = $this->input->get_post('STATION_ID');
                if(count($data_app)>0){
                    $member_id = $this->global_model->get_data("*", "member", "where token = '".$headers['USER_TOKEN']."'")->result_array();
                    if (!empty($feedback_content)) {
                        $input['member_id']         = $member_id[0]['member_id'];
                        $input['feedback_content']  = $feedback_content;
                        $input['station_id']        = $station_id;
                        $input['created_date']      = date("Y-m-d H:i:s");

                        $this->db->insert("feedback", $input);

                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "YOUR FEEDBACK HAS SENT!";
                        $data["DATA"]       = array();
                    }else{
                        $data["STATUS"]     = "FAILED";
                        $data["MESSAGE"]    = "PLEASE INSERT YOUR FEEDBACK!";
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