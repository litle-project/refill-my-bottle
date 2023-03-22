<?php
class Event extends CI_Controller{
    
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
                $date        = $this->input->get_post('DATE');
                $convert_date = date("Y-m-d", strtotime($date));
                if(count($data_app)>0){
                    $date_now = date("Y-m-d");
                    $event_date = $this->global_model->get_data("*", "event_master", "where start_date ='".$convert_date."' AND end_date >='".$date_now."'")->result_array();
                    if (!empty($event_date)) {
                        foreach ($event_date as $row) {
                            $json["EVENT_ID"]           = $row['event_id'];
                            $json["EVENT_NAME"]         = $row['event_name'];
                            $json["EVENT_CONTENT"]      = $row['event_content'];
                            $json["EVENT_IMAGE"]        = base_url("media/event/".$row['event_image']."");
                            $json["EVENT_START_DATE"]   = $row['start_date'];
                            $json["EVENT_END_DATE"]     = $row['end_date'];

                            $array[] = $json;
                        }

                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "EVENT LIST FOR THIS DATE";
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

    function event_available(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app       = $this->member_model->check_app($headers["APP_TOKEN"]);
                $month          = $this->input->get_post('MONTH');
                $year           = $this->input->get_post('YEAR');
                $country_id     = $this->input->get_post('COUNTRY_ID');
                if(count($data_app)>0){
                    $date_month     = $month."-".$year;
                    $date_min       = "01-".$date_month;
                    $date_max       = "31-".$date_month;
                    $change_min     = date("Y-m-d", strtotime($date_min));
                    $change_max     = date("Y-m-d", strtotime($date_max));
                    if (!empty($country_id)) {
                        $event_date = $this->event_model->get_data($change_min, $change_max, $country_id);
                        // print_r($event_date); die();
                        if (!empty($event_date)) {
                            for ($i=1; $i<=31 ; $i++) {
                                $month_year = $year."-".$month;
                                $array["tanggal"] = $month_year."-".sprintf("%02d",$i);
                                $res[] = $array;
                            }
                            for ($j=0; $j<count($event_date); $j++){
                                $event = $event_date[$j]['start_date'];
                                $eventTgl[] = $event;
                            }
                            foreach ($res as $key) {
                                if(in_array($key["tanggal"], $eventTgl)){
                                    $tgl['DATE']        = $key["tanggal"];
                                    $tgl['AVAILABLE']   = "TRUE";
                                }else{
                                    $tgl['DATE']        = $key["tanggal"];
                                    $tgl['AVAILABLE']   = "FALSE";
                                }

                                $final[] = $tgl;
                            }

                                $array = array();
                                $data["STATUS"]     = "SUCCESS";
                                $data["MESSAGE"]    = "DATA EVENT";
                                $data["DATA"]       = $final;
                        }else{
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="NO EVENT FOR THIS MONTH OR YEAR";
                            $data["DATA"]=array();
                            }    
                    }else{
                        $event_date = $this->event_model->get_data($change_min, $change_max);
                        // print_r($event_date); die();
                        if (!empty($event_date)) {
                            for ($i=1; $i<=31 ; $i++) {
                                $month_year = $year."-".$month;
                                $array["tanggal"] = $month_year."-".sprintf("%02d",$i);
                                $res[] = $array;
                            }
                            for ($j=0; $j<count($event_date); $j++){
                                $event = $event_date[$j]['start_date'];
                                $eventTgl[] = $event;
                            }
                            foreach ($res as $key) {
                                if(in_array($key["tanggal"], $eventTgl)){
                                    $tgl['DATE']        = $key["tanggal"];
                                    $tgl['AVAILABLE']   = "TRUE";
                                }else{
                                    $tgl['DATE']        = $key["tanggal"];
                                    $tgl['AVAILABLE']   = "FALSE";
                                }

                                $final[] = $tgl;
                            }

                                $array = array();
                                $data["STATUS"]     = "SUCCESS";
                                $data["MESSAGE"]    = "DATA EVENT";
                                $data["DATA"]       = $final;
                        }else{
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="NO EVENT FOR THIS MONTH OR YEAR";
                            $data["DATA"]=array();
                            }  
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

    function detail(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $id = $this->input->get_post('EVENT_ID');
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                if(count($data_app)>0){
                    $hasil_query = $this->global_model->get_data_join("*","event_master a","where a.event_id='".$id."'","left join event_category as b on b.category_id = a.category_id")->result_array();
                        if(!empty($hasil_query)){
                        $array = array();
                        $cek_fav     = $this->global_model->get_data("*", "fav_event", "where event_id='".$id."'")->result_array();
                        $fav         = count($cek_fav);
                        $cek_share   = $this->global_model->get_data("*", "log_share", "where event_id='".$id."'")->result_array();
                        $share       = count($cek_share);
                        // print_r($fav); die();
                            foreach ($hasil_query as $key) {
                                       //print_r($key);die();
                                $json["EVENT_ID"]            = $key["event_id"];
                                $json["EVENT_NAME"]          = $key["event_name"];
                                $json["EVENT_CATEGORY"]      = $key["category_name"];
                                $json["EVENT_DESCRIPTION"]   = $key["event_content"];
                                $json["EVENT_START_DATE"]    = $key["start_date"];
                                $json["EVENT_END_DATE"]      = $key["end_date"];
                                $json["EVENT_IMAGE"]         = base_url()."media/event/".$key["event_image"];
                                $json["TOTAL USER FAV"]      = $fav;
                                $json["TOTAL USER SHARE"]    = $share;
                                $json["LINK_SHARED"]         =base_url()."landing/event/".$id."";
                                
                                $array[] = $json; 
                            }
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="DETAIL EVENT";
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


    function filter_country(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app       = $this->member_model->check_app($headers["APP_TOKEN"]);
                $country        = $this->input->get_post('COUNTRY_ID');
                $date_frist     = $this->input->get_post('DATE');
                $date = date("Y-m-d", strtotime($date_frist));
                if(count($data_app)>0){
                    if (!empty($country)) {

                        $event_country = $this->global_model->get_data_join("*","event_master a","where country='".$country."' AND start_date='".$date."'","left join event_category as b on b.category_id = a.category_id left join country as c on c.country_id = a.country left join city as d on d.city_id = a.city left join area as e on e.area_id = a.area")->result_array();
                        if (!empty($event_country)) {
                            foreach ($event_country as $row) {
                                $json["EVENT_ID"]           = $row['event_id'];
                                $json["EVENT_NAME"]         = $row['event_name'];
                                $json["EVENT_CONTENT"]      = $row['event_content'];
                                $json["EVENT_IMAGE"]        = base_url("media/event/".$row['event_image']."");
                                $json["EVENT_START_DATE"]   = $row['start_date'];
                                $json["EVENT_END_DATE"]     = $row['end_date'];
                                $json["EVENT_COUNTRY"]      = $row['country_name'];
                                $json['EVENT_CITY']         = $row['city_name'];
                                $json['EVENT_AREA']         = $row['area_name'];

                                $array[] = $json;
                            }

                            $data["STATUS"]     = "SUCCESS";
                            $data["MESSAGE"]    = "EVENT LIST FOR THIS COUNTRY";
                            $data["DATA"]       = $array;
                        }else{
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="NO EVENT FOR THIS COUNTRY";
                            $data["DATA"]=array();
                        }
                    }else{
                        $event_country = $this->global_model->get_data_join("*","event_master a","where start_date='".$date."'","left join event_category as b on b.category_id = a.category_id left join country as c on c.country_id = a.country left join city as d on d.city_id = a.city left join area as e on e.area_id = a.area")->result_array();
                        if (!empty($event_country)) {
                            foreach ($event_country as $row) {
                                $json["EVENT_ID"]           = $row['event_id'];
                                $json["EVENT_NAME"]         = $row['event_name'];
                                $json["EVENT_CONTENT"]      = $row['event_content'];
                                $json["EVENT_IMAGE"]        = base_url("media/event/".$row['event_image']."");
                                $json["EVENT_START_DATE"]   = $row['start_date'];
                                $json["EVENT_END_DATE"]     = $row['end_date'];
                                $json["EVENT_COUNTRY"]      = $row['country_name'];
                                $json['EVENT_CITY']         = $row['city_name'];
                                $json['EVENT_AREA']         = $row['area_name'];

                                $array[] = $json;
                            }

                            $data["STATUS"]     = "SUCCESS";
                            $data["MESSAGE"]    = "EVENT LIST FOR THIS COUNTRY";
                            $data["DATA"]       = $array;
                        }else{
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="NO EVENT FOR THIS COUNTRY";
                            $data["DATA"]=array();
                        }
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

    function fav(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $event_id    = $this->input->get_post('EVENT_ID');
                if(count($data_app)>0){
                    $member_id = $this->global_model->get_data("*", "member", "where token ='".$headers["USER_TOKEN"]."'")->result_array();
                    // print_r($member_id); die();
                    if (!empty($member_id)) {
                        $cek_member = $this->global_model->get_data("*", "fav_event", "where member_id='".$member_id[0]['member_id']."' AND event_id='".$event_id."'" )->result_array();
                        // $cek_event  = $this->global_model->get_data("*", "fav_event", "where event_id='".$event_id."' AND status = '1'")->result_array();

                        // print_r($cek_member); die();
                        // if (empty($cek_member) && empty($cek_event)) {
                        if (empty($cek_member)) {
                            
                            $input['event_id']  = $event_id;
                            $input['member_id'] = $member_id[0]['member_id'];
                            $input['status']    = '1';
                            // print_r($input); die();
                            $this->db->insert("fav_event", $input);

                            $data["STATUS"]     = "SUCCESS";
                            $data["MESSAGE"]    = "YOU HAS FAVORITE THIS EVENT";
                            $data["DATA"]       = array();
                        }elseif($cek_member[0]['status'] == '0'){
                            $input['status']    = '1';
                            $this->db->where('member_id', $member_id[0]['member_id']);
                            $this->db->where('event_id', $event_id);
                            $this->db->update('fav_event', $input);

                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="YOU HAS FAVORITE THIS EVENT";
                            $data["DATA"]=array();
                        }elseif($cek_member[0]['status'] == '1'){

                            $input['status']    = '0';
                            $this->db->where('member_id', $member_id[0]['member_id']);
                            $this->db->where('event_id', $event_id);
                            $this->db->update('fav_event', $input);

                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="YOU HAS UNFAVORITE THIS EVENT";
                            $data["DATA"]=array();
                        }
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

    function share(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $event_id    = $this->input->get_post('EVENT_ID');
                if(count($data_app)>0){
                    $member_id = $this->global_model->get_data("*", "member", "where token ='".$headers["USER_TOKEN"]."'")->result_array();
                    // print_r($member_id); die();
                    // if (!empty($member_id)) {
                        // $cek_member = $this->global_model->get_data("*", "fav_event", "where member_id='".$member_id[0]['member_id']."'")->result_array();
                        // $cek_event  = $this->global_model->get_data("*", "fav_event", "where event_id='".$event_id."'")->result_array();
                        // if (empty($cek_member) && empty($cek_event)) {
                            
                            $input['event_id']  = $event_id;
                            $input['member_id'] = $member_id[0]['member_id'];
                            // print_r($input); die();
                            $this->db->insert("log_share", $input);

                            $data["STATUS"]     = "SUCCESS";
                            $data["MESSAGE"]    = "YOU HAS SHARE THIS EVENT";
                            $data["DATA"]       = array();
                    //     }else{
                    //         $data["STATUS"]="FAILED";
                    //         $data["MESSAGE"]="YOU HAS FAVORITE THIS EVENT";
                    //         $data["DATA"]=array();
                    //     }
                    // }
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