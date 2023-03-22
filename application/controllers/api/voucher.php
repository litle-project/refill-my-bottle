<?php
class Voucher extends CI_Controller{
    
     function __construct(){
        parent::__construct();
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
                // $member_id   = $this->global_model->get_data("*","member", "where token = '".$headers['USER_TOKEN']."'")->result_array();
                if(count($data_app)>0){
                    $now = date("Y-m-d");
                    $voucher = $this->global_model->get_data("*", "voucher", "where status ='1' AND voucher_valid >='". $now."'")->result_array();
                    if (!empty($voucher)) {
                        foreach ($voucher as $row) {
                            $json["VOUCHER_ID"]           = $row['voucher_id'];
                            $json["VOUCHER_NAME"]         = $row['voucher_name'];
                            // $json["VOUCHER_QUANTITY"]     = $row['voucher_qty'];
                            $json["VALID_UNTIL"]          = $row['voucher_valid'];
                            $json["OVERVIEW"]             = $row['overview'];
                            $json["HOW_TO_USE"]           = $row['how_to_use'];
                            $json["TERMS_AND_CONDITION"]  = $row['voucher_terms'];
                            $json["VOUCHER_POINT"]        = $row['point'];
                            $json["VOUCHER_IMAGE"]        = base_url("media/voucher/".$row['voucher_image']."");

                            $array[] = $json;
                        }

                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "VOUCHER LIST";
                        $data["DATA"]       = $array;
                    }else{
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="NO VOUCHER HAS CREATED";
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

    function redeem(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $member_id   = $this->global_model->get_data("*","member", "where token = '".$headers['USER_TOKEN']."'")->result_array();
                $voucher_id  = $this->input->get_post("VOUCHER_ID");
                if(count($data_app)>0){
                    if (!empty($voucher_id)) {
                        $voucher = $this->global_model->get_data("*", "voucher", "where voucher_id ='".$voucher_id."'")->result_array();
                        $member_point = $this->statistic_model->get_data_point($member_id[0]['member_id']);
                        if (!empty($voucher)) {
                            if ($member_point) {
                                    // print_r($member_point); die();

                                if ($member_point[0]['point'] >= $voucher[0]['point']) {
                                    $point_awal     = $member_point[0]['point'];
                                    $point_vouchher = $voucher[0]['point'];
                                    $point_result   = $point_awal-$point_vouchher;
                                    // print_r($point_result); die();

                                    $input_point['point']           = $point_result;
                                    $input_point['created_date']    = date("Y-m-d H:i:s");
                                    $this->db->where("member_id", $member_id[0]['member_id']);
                                    $this->db->update("point", $input_point);

                                    $input['member_id']     = $member_id[0]['member_id'];
                                    $input['voucher_id']    = $voucher_id;
                                    $input['created_date']  = date("Y-m-d H:i:s");
                                    $this->db->insert('member_voucher', $input);
                                    
                                    $data["STATUS"]     = "SUCCESS";
                                    $data["MESSAGE"]    = "This voucher is now added into your account";
                                    $data["DATA"]       = array();
                                
                                }else{
                                    $data["STATUS"]     = "FAILED";
                                    $data["MESSAGE"]    = "YOUR POINT IS NOT ENOUGH TO REDEEM THIS VOUCHER";
                                    $data["DATA"]       = array();
                                }
                            }else{
                                $data["STATUS"]     = "FAILED";
                                $data["MESSAGE"]    = "You don’t have any point yet, start refilling or adding new stations";
                                $data["DATA"]       = array();
                            }
                        }else{
                            $data["STATUS"]     = "FAILED";
                            $data["MESSAGE"]    = "THIS VOUCHER IS NOT AVAILABLE";
                            $data["DATA"]       = array();
                        }
                    }else{
                        $data["STATUS"]="FAILED";
                        $data["MESSAGE"]="PLEASE SELECT VOUCHER FOR REDEEMPTION";
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

    function member_voucher(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $member_id   = $this->global_model->get_data("*","member", "where token = '".$headers['USER_TOKEN']."'")->result_array();
                if(count($data_app)>0){
                    $my_voucher = $this->global_model->get_data_join("*", "member_voucher a", "where a.member_id ='".$member_id[0]['member_id']."'", "left join voucher as b on b.voucher_id = a.voucher_id")->result_array();
                    // print_r($my_voucher); die();
                    if (!empty($my_voucher)) {
                        foreach ($my_voucher as $row) {
                            $json["REDEEM_ID"]            = $row['redeem_id'];
                            $json["VOUCHER_ID"]           = $row['voucher_id'];
                            $json["VOUCHER_NAME"]         = $row['voucher_name'];
                            $json["STATUS"]               = $row['status_voucher'];
                            $json["VALID_UNTIL"]          = $row['voucher_valid'];
                            $json["OVERVIEW"]             = $row['overview'];
                            $json["HOW_TO_USE"]           = $row['how_to_use'];
                            $json["TERMS_AND_CONDITION"]  = $row['voucher_terms'];
                            $json["VOUCHER_POINT"]        = $row['point'];
                            $json["VOUCHER_IMAGE"]        = base_url("media/voucher/".$row['voucher_image']."");

                            $array[] = $json;
                        }

                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "VOUCHER LIST";
                        $data["DATA"]       = $array;
                    }else{
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="NO VOUCHER HAS CREATED";
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

    function use_voucher(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $member_id   = $this->global_model->get_data("*","member", "where token = '".$headers['USER_TOKEN']."'")->result_array();
                $redeem_id  = $this->input->get_post("REDEEM_ID");
                $voucher_id  = $this->input->get_post("VOUCHER_ID");
                if(count($data_app)>0){
                    if (!empty($voucher_id)) {
                    $cek_voucher = $this->global_model->get_data_join("*", "member_voucher a", "where a.member_id ='".$member_id[0]['member_id']."' AND a.redeem_id = '".$redeem_id."' AND a.voucher_id='".$voucher_id."'", "left join voucher as b on b.voucher_id = a.voucher_id")->result_array();

                    // print_r($cek_voucher); die();
                        if (!empty($cek_voucher)) {
                           if ($cek_voucher[0]['status_voucher'] == '0') {
                                $input['status_voucher'] = '1';

                                $this->db->where("member_id", $member_id[0]['member_id']);
                                $this->db->where("voucher_id", $voucher_id);
                                $this->db->where("redeem_id", $redeem_id);
                                $this->db->update("member_voucher", $input);

                                $data["STATUS"]     = "SUCCESS";
                                $data["MESSAGE"]    = "YOUR VOUCHER HAS BEEN USED";
                                $data["DATA"]       = array();

                           }elseif($cek_voucher[0]['status_voucher'] == '1'){

                                $data["STATUS"]     = "FAILED";
                                $data["MESSAGE"]    = "YOUR VOUCHER HAS BEEN USED";
                                $data["DATA"]       = array();

                           }else{

                                $data["STATUS"]     = "FAILED";
                                $data["MESSAGE"]    = "YOUR VOUCHER HAS EXPIRED";
                                $data["DATA"]       = array();
                           }
                        }else{
                            $data["STATUS"]     = "FAILED";
                            $data["MESSAGE"]    = "YOUR VOUCHER HAS EXPIRED";
                            $data["DATA"]       = array();
                            }
                    }else{
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="NO VOUCHER HAS CREATED";
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