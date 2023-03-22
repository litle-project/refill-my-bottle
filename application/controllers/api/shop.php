<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		header('Content-Type: application/json');
        $this->load->model('api_model/shop_model');
		$this->load->model('api_model/member_model');
        $this->load->model('global_model');
		$this->load->library('get_api');
	}

	function index(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                // $member_id   = $this->global_model->get_data("*","member", "where token = '".$headers['USER_TOKEN']."'")->result_array();
                if(count($data_app)>0){
                    $product = $this->global_model->get_data("*", "shop_list", "where status ='1'")->result_array();
                    if (!empty($product)) {
                        foreach ($product as $row) {
                            $json["SHOP_ID"]                = $row['id_shop'];
                            $json["PRODUCT_NAME"]           = $row['name_product'];
                            $json["POINT_TO_DISCOUNT"]      = $row['point_discount'];
                            $json["PRICE"]                  = $row['price'];
                            $json["PRICE_AFTER_DISCOUNT"]   = $row['price_after_discount'];
                            $json["DISCOUNT_AVAILABLE"]     = $row['available_until'];
                            $json["OVERVIEW"]               = $row['overview'];
                            $json["HOW_TO_USE"]             = $row['how_to_use'];
                            $json["TERMS"]                  = $row['t_n_c'];
                            $json["URL_WEB"]                = $row['url_web'];
                            $json["IMAGE"]                  = base_url("media/shop/".$row['image']."");

                            $array[] = $json;
                        }

                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "PRODUCT LIST";
                        $data["DATA"]       = $array;
                    }else{
                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "NO PRODUCT HAS CREATED";
                        $data["DATA"]       = array();
                    }
                }else{
                    $data["STATUS"]     = "FAILED";
                    $data["MESSAGE"]    = "INVALID APP_TOKEN";
                    $data["DATA"]       = array();
                    }
            }else{
                $data["STATUS"]  = "FAILED";
                $data["MESSAGE"] = "INPUT USER TOKEN";
                $data["DATA"]    = array();
                }
        }else{
            $data["STATUS"]   = "FAILED";
            $data["MESSAGE"]  = "PLEASE LOGIN";
            $data["DATA"]     = array();
            }
        echo json_encode($data);
    }


   function shop_detail(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                $id          = $this->input->get_post("SHOP_ID");
                // $member_id   = $this->global_model->get_data("*","member", "where token = '".$headers['USER_TOKEN']."'")->result_array();
                if(count($data_app)>0){
                    $product = $this->global_model->get_data("*", "shop_list", "where id_shop ='".$id."'")->result_array();
                    $image   = $this->global_model->get_data("*", "shop_image", "where shop_id ='".$id."'")->result_array();

                    foreach ($image as $key) {
                        if ($key['shop_image'] == "") {
                            $json_image["MORE_IMAGE"]     = "";
                        }else{
                            $json_image["MORE_IMAGE"]     = base_url("media/shop/".$key['shop_image']."");
                        }
                        
                        $images[] = $json_image;
                    }
                    // print_r($images); die();
                    if (!empty($product)) {
                        foreach ($product as $row) {
                            $json["SHOP_ID"]                = $row['id_shop'];
                            $json["PRODUCT_NAME"]           = $row['name_product'];
                            $json["POINT_TO_DISCOUNT"]      = $row['point_discount'];
                            $json["PRICE"]                  = $row['price'];
                            $json["PRICE_AFTER_DISCOUNT"]   = $row['price_after_discount'];
                            $json["DISCOUNT_AVAILABLE"]     = $row['available_until'];
                            $json["OVERVIEW"]               = $row['overview'];
                            $json["HOW_TO_USE"]             = $row['how_to_use'];
                            $json["TERMS"]                  = $row['t_n_c'];
                            $json["URL_WEB"]                = $row['url_web'];
                            $json["IMAGE"]                  = base_url("media/shop/".$row['image']."");
                            if (!empty($images)) {
                                $json["MORE_IMAGES"]       = $images;
                            }else{
                                $json["MORE_IMAGES"]       = array();
                            }


                            $array[] = $json;
                        }

                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "PRODUCT LIST";
                        $data["DATA"]       = $array;
                    }else{
                        $data["STATUS"]     = "SUCCESS";
                        $data["MESSAGE"]    = "NO PRODUCT HAS CREATED";
                        $data["DATA"]       = array();
                    }
                }else{
                    $data["STATUS"]     = "FAILED";
                    $data["MESSAGE"]    = "INVALID APP_TOKEN";
                    $data["DATA"]       = array();
                    }
            }else{
                $data["STATUS"]  = "FAILED";
                $data["MESSAGE"] = "INPUT USER TOKEN";
                $data["DATA"]    = array();
                }
        }else{
            $data["STATUS"]   = "FAILED";
            $data["MESSAGE"]  = "PLEASE LOGIN";
            $data["DATA"]     = array();
            }
        echo json_encode($data);
    }
}
