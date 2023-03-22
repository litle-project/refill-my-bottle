<?php
class Event_avaible_temp extends CI_Controller{
    
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
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $year        = $this->input->get_post('YEARS');
                $month        = $this->input->get_post('MONTH');
                $this->db->select('*');
                $this->db->from('event_master a');
                $this->db->join('event_category b', 'b.category_id = a.category_id');
                $this->db->where('MONTH(start_date)', $month);
                $this->db->where('YEAR(start_date)', $year);
                $this->db->where('a.status', '1');
                $query = $this->db->get();
                $get_event= $query->result_array();

                if(count($data_app)>0){
                    if (!empty($get_event)) {
                        $d=cal_days_in_month(CAL_GREGORIAN,$month,$year);
                        foreach ($get_event as $row) {
                            $json["EVENT_ID"]           = $row['event_id'];
                            $json["EVENT_START_DATE"]   = $row['start_date'];
                            $json["EVENT_END_DATE"]     = $row['end_date'];

                            $array[] = $json;
                        }

                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "AVAIBLE IVENT LIST";
                        $data["DATA"]       = $array;
                    }else{
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="NO EVENT FOR THIS DATE";
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
        }else{
            $data["STATUS"]="FAILED";
            $data["MESSAGE"]="PLEASE LOGIN";
            $data["DATA"]=array();
            }
        echo json_encode($data);
    }

}