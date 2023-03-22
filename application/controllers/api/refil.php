<?php
class Refil extends CI_Controller{
    
     function __construct(){
        parent::__construct();
        //$this->load->model("api_model/place_model");
        $this->load->model("global_model");
        $this->load->model("api_model/refil_model");
        $this->load->model("api_model/member_model");
        header('Content-Type: application/json');
    }

    function index(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                date_default_timezone_set('Asia/Bangkok');
                $station_id  = $this->input->get_post("STATION_ID");
                $date        = date("Y-m-d");
                $member     = $this->global_model->get_data("*","member","where token='".$headers["USER_TOKEN"]."'")->result_array();
                // print_r($member); die();
                if(count($data_app)>0){
                    if (!empty($station_id)) { // cek store available
                        $hasil_query = $this->refil_model->get_data($station_id);
                        if(!empty($hasil_query)){ // cek store availablity
                            $data_refill        = $this->refil_model->get_data_refil($member[0]['member_id'], $date);
                            $date_time          = $this->global_model->get_data("*", "time", "where status = '1'")->result_array();
                            // print_r($data_refill); die();
                            if (!empty($data_refill)) { //user has refill
                                if(count($data_refill) == 1){

                                    $from                   = $data_refill[0]['created_date'];
                                    $to                     = date('Y-m-d H:i:s');
                                    $total                  = strtotime($to) - strtotime($from);
                                    $hours                  = floor($total / 60 / 60);
                                        // print_r($hours); die();
                                    if ($hours >= $date_time[0]['time']) {
                                        $array = array();
                                        foreach ($hasil_query as $key) {
                                        
                                            // increment trx 
                                            $input1['member_id']     = $member[0]['member_id'];
                                            $input1['station_id']    = $station_id;
                                            $input1['created_date']  = date("Y-m-d H:i:s");
                                            $this->db->insert("transaction", $input1);

                                            // increment bottle
                                            $input2['total_save']   = 1;
                                            $input2['member_id']    = $member[0]['member_id'];
                                            $this->db->insert("bottle_saved", $input2);
                                                
                                            // increment point
                                            $point = $this->global_model->get_data("*", "point", "where member_id='".$member[0]['member_id']."'")->result_array();
                                            // print_r($point); die();
                                            $input3['point']        = $point[0]['point']+$key['station_point'];
                                            $input3['member_id']    = $member[0]['member_id'];
                                            $input3['created_date'] = date("Y-m-d H:i:s");
                                            $this->db->where("member_id", $member[0]['member_id']);
                                            $this->db->update("point", $input3);
                                                

                                            $json["STATION_ID"]     = $key["station_id"];
                                            $json["STORE_POINT"]    = $key["station_point"];
                                            $array[]                = $json;

                                            $data["STATUS"]         = "SUCCESS";
                                            $data["MESSAGE"]        = "YOUR POINT FOR TODAY HAS ADDED";
                                            $data["DATA"]           = $array;
                                        }
                                    }else{
                                        $data["STATUS"]         = "FAILED";
                                        $data["MESSAGE"]        = "YOU HAVE REACHED YOUR REFILL LIMIT";
                                        $data["MESSAGE"]        = "HEY, IT LOOKS LIKE YOU JUST REFIILED! ENJOY YOUR WATER AND REFILL AGAIN IN 2 HOURS";
                                        $data["DATA"]           = array();
                                    }
                                }else{
                                   // echo"dua"; die();

                                    foreach ($hasil_query as $key3) {

                                    // increment trx 
                                        $input4['member_id']     = $member[0]['member_id'];
                                        $input4['station_id']    = $station_id;
                                        $input4['created_date']  = date("Y-m-d H:i:s");
                                        $this->db->insert("transaction", $input4);

                                        // increment bottle
                                        $input5['total_save']   = 1;
                                        $input5['member_id']    = $member[0]['member_id'];
                                        $this->db->insert("bottle_saved", $input5);
                                            
                                        // increment point
                                        $member_id = $member[0]['member_id'];
                                        $point = $this->global_model->get_data("*", "point", "where member_id = '".$member_id."'")->result_array();
                                        $input6['point']        = $point[0]['point']+$key3['station_point'];
                                        $input6['member_id']    = $member[0]['member_id'];
                                        $input6['created_date'] = date("Y-m-d H:i:s");
                                        // print_r($input6); die();
                                        $this->db->where("member_id", $member_id);
                                        $this->db->update("point", $input6);
                                            

                                        $json["STATION_ID"]     = $key3["station_id"];
                                        $json["STORE_POINT"]    = $key3["station_point"];
                                        $array[]                = $json;

                                        $data["STATUS"]         = "SUCCESS";
                                        $data["MESSAGE"]        = "YOUR POINT FOR TODAY HAS ADDED";
                                        $data["DATA"]           = $array;
                                    }
                                }
                            }else{
                                   // echo"dua"; die();

                                $array = array();
                                foreach ($hasil_query as $key2) {
                                    // increment trx
                                    $input7['member_id']     = $member[0]['member_id'];
                                    $input7['station_id']    = $station_id;
                                    $input7['created_date']  = date("Y-m-d H:i:s");
                                    $this->db->insert("transaction", $input7);

                                    // increment bottle
                                    $input8['total_save']   = 1;
                                    $input8['member_id']    = $member[0]['member_id'];
                                    $this->db->insert("bottle_saved", $input8);
                                        
                                    // increment point
                                    $input9['point']        = $key2['station_point'];
                                    $input9['member_id']    = $member[0]['member_id'];
                                    $input9['created_date'] = date("Y-m-d H:i:s");
                                    $this->db->insert("point", $input9);
                                        

                                    $json["STATION_ID"]        = $key2["station_id"];
                                    $json["STORE_POINT"]       = $key2["station_point"];
                                    $array[] = $json;

                                    $data["STATUS"]="SUCCESS";
                                    $data["MESSAGE"]="YOUR POINT FOR TODAY HAS ADDED";
                                    $data["DATA"]=$array;
                                }
                            }
                        }else{
                            $data["STATUS"]     = "FAILED";
                            $data["MESSAGE"]    = "STATION IS NOT AVAILABLE";
                            $data["DATA"]       = array();
                        }
                    }else{
                        $data["STATUS"]     = "FAILED";
                        $data["MESSAGE"]    = "PLEASE SELECT STATION";
                        $data["DATA"]       = array();
                    }
                }else{
                    $data["STATUS"]     = "FAILED";
                    $data["MESSAGE"]    = "PLEASE INSERT APP TOKEN";
                    $data["DATA"]       = array();
                }
            }else{
                $data["STATUS"]     = "FAILED";
                $data["MESSAGE"]    = "PLEASE LOGIN";
                $data["DATA"]       = array();
            }
        }
                                
        echo json_encode($data);
    }
}