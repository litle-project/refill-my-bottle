<?php
class Statistic extends CI_Controller{
    
     function __construct(){
        parent::__construct();
        //$this->load->model("api_model/place_model");
        $this->load->model("global_model");
        $this->load->model("api_model/statistic_model");
        $this->load->model("api_model/member_model");
        header('Content-Type: application/json');
    }

    function index(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $member     = $this->global_model->get_data("*","member","where token='".$headers["USER_TOKEN"]."'")->result_array();
                if(count($data_app)>0){
                    $member_id = $member[0]['member_id'];
                    
                    $year = date('Y');
                    $array = array();
                    $stat = $this->statistic_model->get_data(date('Y-01-01'),date('Y-02-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data1['x']     = $day;
                            $total_data1[]  = $data1;
                            $data11['y'] = count($total_data1);
                            $data11['name'] = "January";
                        }
                    }
                    if(!empty($data11)){
                        $result[] = $data11;    
                    }

                    $stat = $this->statistic_model->get_data(date('Y-02-01'),date('Y-03-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data2['x']     = $day;
                            $total_data2[]  = $data2;
                            $data21['y'] = count($total_data2);
                            $data21['name'] = "February";
                        }
                    }
                    if(!empty($data21)){
                        $result[] = $data21;    
                    }

                    $stat = $this->statistic_model->get_data(date('Y-03-01'),date('Y-04-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data3['x']     = $day;
                            $total_data3[]  = $data3;
                            $data31['y'] = count($total_data3);
                            $data31['name'] = "March";
                        }
                    }
                    if(!empty($data31)){
                        $result[] = $data31;    
                    }

                    $stat = $this->statistic_model->get_data(date('Y-04-01'),date('Y-05-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data4['x']     = $day;
                            $total_data4[]  = $data4;
                            $data41['y'] = count($total_data4);
                            $data41['name'] = "April";
                        }
                    }
                    if(!empty($data41)){
                        $result[] = $data41;    
                    }
                    
                    $stat = $this->statistic_model->get_data(date('Y-05-01'),date('Y-06-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data5['x']     = $day;
                            $total_data5[]  = $data5;
                            $data51['y'] = count($total_data5);
                            $data51['name'] = "May";
                        }
                    }
                    if(!empty($data51)){
                        $result[] = $data51;    
                    }

                    $stat = $this->statistic_model->get_data(date('Y-06-01'),date('Y-07-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data6['x']     = $day;
                            $total_data6[]  = $data6;
                            $data61['y'] = count($total_data6);
                            $data61['name'] = "June";
                        }
                    }
                    if(!empty($data61)){
                        $result[] = $data61;    
                    }

                    $stat = $this->statistic_model->get_data(date('Y-07-01'),date('Y-08-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data7['x']     = $day;
                            $total_data7[]  = $data7;
                            $data71['y'] = count($total_data7);
                            $data71['name'] = "July";
                        }
                    }
                    if(!empty($data71)){
                        $result[] = $data71;    
                    }

                    $stat = $this->statistic_model->get_data(date('Y-08-01'),date('Y-09-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data8['x']     = $day;
                            $total_data8[]  = $data8;
                            $data81['y'] = count($total_data8);
                            $data81['name'] = "August";
                        }
                    }
                    if(!empty($data81)){
                        $result[] = $data81;    
                    }

                    $stat = $this->statistic_model->get_data(date('Y-09-01'),date('Y-10-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data9['x']     = $day;
                            $total_data9[]  = $data9;
                            $data91['y'] = count($total_data9);
                            $data91['name'] = "September";
                        }
                    }
                    if(!empty($data91)){
                        $result[] = $data91;    
                    }

                    $stat = $this->statistic_model->get_data(date('Y-10-01'),date('Y-11-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data10['x']    = $day;
                            $total_data10[] = $data10;
                            $dat101['y'] = count($total_data10);
                            $data101['name']    = "October";
                        }
                    }
                    if(!empty($data101)){
                        $result[] = $data101;   
                    }

                    $stat = $this->statistic_model->get_data(date('Y-11-01'),date('Y-12-01'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data11['x']    = $day;
                            $total_data11[] = $data11;
                            $data111['y'] = count($total_data11);
                            $data111['name']    = "November";
                        }
                    }
                    if(!empty($data111)){
                        $result[] = $data111;   
                    }

                    $stat = $this->statistic_model->get_data(date('Y-12-01'),date('Y-12-31'),$member_id);
                    if (count($stat)>0) {
                        foreach ($stat as $day) {
                            $data12['x']    = $day;
                            $total_data12[] = $data12;
                            $data121['y'] = count($total_data12);
                            $data121['name']    = "Desember";
                        }
                    }
                    if(!empty($data121)){
                        $result[] = $data121;   
                    }

                    $array = $result;

                    $data["STATUS"]     = "SUCCESS";
                    $data["MESSAGE"]    = "STATISTIC BOTTLE SAVED LIST";
                    $data["DATA"]       = $array;
                }else{
                    $data["STATUS"]     = "FAILED";
                    $data["MESSAGE"]    = "PLEASE INSERT APP TOKEN";
                    $data["DATA"]       = array();
                }
            }else{
                $data["STATUS"]     = "FAILED";
                $data["MESSAGE"]    = "INPUT USER TOKEN";
                $data["DATA"]       = array();
            }
        }else{
            $data["STATUS"]     = "FAILED";
            $data["MESSAGE"]    = "PLEASE LOGIN";
            $data["DATA"]       = array();
        }
                            
        echo json_encode($data);
    }

    function bottle(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $member     = $this->global_model->get_data("*","member","where token='".$headers["USER_TOKEN"]."'")->result_array();
                if(count($data_app)>0){
                    $member_id = $member[0]['member_id'];
                    $bottle = $this->statistic_model->get_data_bottle($member_id);
                    $array = array();
                    if (!empty($bottle)) { // cek store available
                        $json['BOTTLE_SAVED'] = $bottle[0]['bottle_saved'];
                        $array[] = $json;

                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "THIS BOTTLE SAVED";
                        $data["DATA"]       = $array;
                    }else{
                        $data["STATUS"]     = "FAILED";
                        $data["MESSAGE"]    = "YOU HAVE NOT REFILL YET";
                        $data["DATA"]       = array();
                    }
                }else{
                    $data["STATUS"]     = "FAILED";
                    $data["MESSAGE"]    = "PLEASE INSERT APP TOKEN";
                    $data["DATA"]       = array();
                }
            }else{
                $data["STATUS"]     = "FAILED";
                $data["MESSAGE"]    = "INPUT USER TOKEN";
                $data["DATA"]       = array();
            }
        }else{
            $data["STATUS"]     = "FAILED";
            $data["MESSAGE"]    = "PLEASE LOGIN";
            $data["DATA"]       = array();
        }
                            
        echo json_encode($data);
    }

    function point(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $member     = $this->global_model->get_data("*","member","where token='".$headers["USER_TOKEN"]."'")->result_array();
                if(count($data_app)>0){
                    $member_id = $member[0]['member_id'];
                    $point = $this->statistic_model->get_data_point($member_id);
                    // print_r($point); die();
                    $array = array();
                    if (!empty($point)) { // cek store available
                        $json['POINT'] = $point[0]['point'];
                        $array[] = $json;

                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "THIS YOUR POINT";
                        $data["DATA"]       = $array;
                    }else{
                        $data["STATUS"]     = "FAILED";
                        $data["MESSAGE"]    = "YOU HAVE NOT POINT";
                        $data["DATA"]       = array();
                    }
                }else{
                    $data["STATUS"]     = "FAILED";
                    $data["MESSAGE"]    = "PLEASE INSERT APP TOKEN";
                    $data["DATA"]       = array();
                }
            }else{
                $data["STATUS"]     = "FAILED";
                $data["MESSAGE"]    = "INPUT USER TOKEN";
                $data["DATA"]       = array();
            }
        }else{
            $data["STATUS"]     = "FAILED";
            $data["MESSAGE"]    = "PLEASE LOGIN";
            $data["DATA"]       = array();
        }
                            
        echo json_encode($data);
    }

    function daily_water(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $member     = $this->global_model->get_data("*","member","where token='".$headers["USER_TOKEN"]."'")->result_array();
                if(count($data_app)>0){
                    $member_id = $member[0]['member_id'];
                    $today          = date("Y-m-d");
                    $daily          = $this->statistic_model->get_data_daily($member_id);
                    $data_refill    = $this->statistic_model->get_data_refil($member_id, $today);
                    $array          = array();
                    if (!empty($data_refill)) {
                        $size_bottle    = $daily[0]['value'];
                        $progress       = count($data_refill);
                        $total_progress = $progress*$size_bottle;
                        
                        $json['PROGRESS']   = $total_progress." ML"."";
                        $json['INTAKE_SET'] = $size_bottle;
                        $array[]            = $json;
                    
                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "THIS STATISTIC YOUR DAILY WATER";
                        $data["DATA"]       = $array;
                   
                   }else{
                        $data["STATUS"]     = "FAILED";
                        $data["MESSAGE"]    = "YOU HAVE NOT REFILL TODAY";
                        $data["DATA"]       = array();
                    }
                }else{
                    $data["STATUS"]     = "FAILED";
                    $data["MESSAGE"]    = "PLEASE INSERT APP TOKEN";
                    $data["DATA"]       = array();
                }
            }else{
                $data["STATUS"]     = "FAILED";
                $data["MESSAGE"]    = "INPUT USER TOKEN";
                $data["DATA"]       = array();
            }
        }else{
            $data["STATUS"]     = "FAILED";
            $data["MESSAGE"]    = "PLEASE LOGIN";
            $data["DATA"]       = array();
        }
                            
        echo json_encode($data);
    }

    function intake_setting(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $member     = $this->global_model->get_data("*","member","where token='".$headers["USER_TOKEN"]."'")->result_array();
                if(count($data_app)>0){
                    $member_id      = $member[0]['member_id'];
                    // $data_intake    = $this->global_model->get_data("*", "intake_setting", "where member_id ='".$member_id."'")->result_array();
                    date_default_timezone_set("Asia/Bangkok");
                    $date           = date("Y-m-d");
                    $today_refill   = $this->statistic_model->get_data_refil($member_id, $date);
                    $total_refill   = count($today_refill);
                    $array          = array();
                    // if (!empty($data_intake)) {
                        // foreach ($data_intake as $key) {

                        $json['TOTAL_REFILL']   = $total_refill." TIMES";
                        $json['INTAKE_SIZE']    = 2000;
                        $json['SATUAN']         = "MiliLiter (ML)";
                        $array[]                = $json;
                    
                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "LIST OF INTAKE SETTING";
                        $data["DATA"]       = $array;
                        // }
                   
                   // }else{
                   //      $data["STATUS"]     = "FAILED";
                   //      $data["MESSAGE"]    = "YOU HAVE NOT SELECT SIZE";
                   //      $data["DATA"]       = array();
                   //  }
                }else{
                    $data["STATUS"]     = "FAILED";
                    $data["MESSAGE"]    = "PLEASE INSERT APP TOKEN";
                    $data["DATA"]       = array();
                }
            }else{
                $data["STATUS"]     = "FAILED";
                $data["MESSAGE"]    = "INPUT USER TOKEN";
                $data["DATA"]       = array();
            }
        }else{
            $data["STATUS"]     = "FAILED";
            $data["MESSAGE"]    = "PLEASE LOGIN";
            $data["DATA"]       = array();
        }
                            
        echo json_encode($data);
    }

    function change_intake(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $member     = $this->global_model->get_data("*","member","where token='".$headers["USER_TOKEN"]."'")->result_array();
                if(count($data_app)>0){
                    $member_id      = $member[0]['member_id'];
                    $data_intake    = $this->input->get_post("INTAKE_SIZE");
                    $chek_intake    = $this->global_model->get_data("*", "intake_setting", "where member_id = '".$member_id."'")->result_array();
                    $array          = array();
                    if (!empty($chek_intake)) {
                        if (!empty($data_intake)) {
                            $input['intake_size'] = $data_intake;
                            $this->db->where('member_id', $member_id);
                            $this->db->update('intake_setting', $input);
                        
                            $data["STATUS"]     = "SUCCESS";
                            $data["MESSAGE"]    = "YOU HAS CHANGE TARGET FOR WATER DAILY";
                            $data["DATA"]       = $array;
                        }else{
                            $data["STATUS"]     = "FAILED";
                            $data["MESSAGE"]    = "PLEASE SELECT SIZE";
                            $data["DATA"]       = $array;
                        }
                   
                   }else{
                        if (!empty($data_intake)) {
                            $input['intake_size'] = $data_intake;
                            $input['member_id']   = $member_id;
                            $this->db->insert('intake_setting', $input);
                        
                            $data["STATUS"]     = "SUCCESS";
                            $data["MESSAGE"]    = "YOU HAS ADD TARGET FOR WATER DAILY";
                            $data["DATA"]       = $array;
                        }else{
                            $data["STATUS"]     = "FAILED";
                            $data["MESSAGE"]    = "PLEASE SELECT SIZE";
                            $data["DATA"]       = $array;
                        }
                    }
                }else{
                    $data["STATUS"]     = "FAILED";
                    $data["MESSAGE"]    = "PLEASE INSERT APP TOKEN";
                    $data["DATA"]       = array();
                }
            }else{
                $data["STATUS"]     = "FAILED";
                $data["MESSAGE"]    = "INPUT USER TOKEN";
                $data["DATA"]       = array();
            }
        }else{
            $data["STATUS"]     = "FAILED";
            $data["MESSAGE"]    = "PLEASE LOGIN";
            $data["DATA"]       = array();
        }
                            
        echo json_encode($data);
    }

    function member_tier(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $member_id   = $this->global_model->get_data("*", "member", "where token ='".$headers["USER_TOKEN"]."'")->result_array();
                if(count($data_app)>0){
                    $data_tier          = $this->global_model->get_data("*", "member_tier", "where status = '1'")->result_array();
                    $data_member_tier   = $this->statistic_model->get_data_bottle($member_id[0]['member_id']);
                    // print_r($data_member_tier); die();
                        foreach ($data_tier as $row) {
                            $json['MEMBER_TIER_NAME']                   = $row['tier_name'];
                            $json['MEMBER_TIER_BOTTLE']                  = $row['tier_point'];
                            $json['MEMBER_TIER_REWARD']                 = $row['tier_reward'];
                            $json['MEMBER_TIER_TERMS_AND_CONDITION']    = $row['tier_terms'];
                            $json['MEMBER_TIER_ICON']                   = base_url("media/member_tier/".$row['tier_image']."");
                            if ($data_member_tier[0]['bottle_saved'] < $row['tier_point']) {
                               $json['STATUS']                          = "INACTIVE";
                            }elseif ($data_member_tier[0]['bottle_saved'] == $row['tier_point']) {
                               $json['STATUS']                          = "ACTIVE";
                            }elseif ($data_member_tier[0]['bottle_saved'] > $row['tier_point']) {
                               $json['STATUS']                          = "ACTIVE";
                            }
                            $json['MEMBER_BOTTLE']                       = $data_member_tier[0]['bottle_saved'];
                            $array[] = $json;
                            
                            $data["STATUS"]     = "SUCCESS";
                            $data["MESSAGE"]    = "MEMBER TIER LIST";
                            $data["DATA"]       = $array;
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