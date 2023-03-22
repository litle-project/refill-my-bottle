<?php
class Station extends CI_Controller{
    
     function __construct(){
        parent::__construct();
        //$this->load->model("api_model/place_model");
        $this->load->model("global_model");
        $this->load->model("api_model/station_model");
        $this->load->model("api_model/member_model");
        header('Content-Type: application/json');
    }

   function index(){ //detail v.1
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $store      = $this->input->get_post("STATION_ID");
                $radius     = $this->input->get_post("RADIUS");
                $latitude   = $this->input->get_post("LATITUDE");
                $longtitude = $this->input->get_post("LONGTITUDE");
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                if(count($data_app)>0){
                    $hasil_query = $this->global_model->get_data_join("*","station a","where a.station_id='".$store."'","left join station_category as b on b.category_id = a.category_id")->result_array();
                    // $hasil_query = $this->station_model->get_data($store,$radius,$latitude,$longtitude);
                    // print_r($hasil_query); die();
                    if(!empty($hasil_query)){
                    $array = array();
                        $rating = $this->global_model->get_data("*", "rating", "where station_id ='".$store."'")->result_array();
                        foreach ($rating as $rate) {
                            $json_rate['rating']            = $rate['rating'];
                            $json_rate['review']            = $rate['review'];

                            $array_rate[] = $json_rate;
                        }
                        $facebook_id = $this->global_model->get_data("*", "member", "where token ='".$headers['USER_TOKEN']."'")->result_array();
                         $type_station = $this->global_model->get_data_join("*","station a","where a.station_id='".$store."'","left join type_of_station as b on b.type_id = a.type_id")->result_array();
                        foreach ($hasil_query as $key) {
                            $empty = 0;
                            if (!empty($rating)) {
                                foreach ($rating as $row) {
                                    $empty += $row['rating'];
                                }
                                $result = $empty/count($rating);
                            }
                                    // print_r($key);die();
                            $json["STATION_ID"]            = $key["station_id"];
                            $json["FACEBOOK_ID"]           = $facebook_id[0]['facebook_id'];
                            $json["STATION_NAME"]          = $key["station_name"];
                            $json["STATION_CATEGORY"]      = $key["category_name"];
                            $json["CATEGORY_ID"]           = $key["category_id"];
                            $json["STATION_DESCRIPTION"]   = $key["station_desc"];
                            $json["TYPE_ID"]               = $type_station[0]['type_id'];
                            $json["TYPE_NAME"]             = $type_station[0]['name_type'];
                            $json["FACEBOOK_ID"]           = $facebook_id[0]['facebook_id'];
                            $json["STATION_ADDRESS"]       = $key["station_address"];
                            $json["STATION_LONGITUDE"]     = $key["station_long"];
                            $json["STATION_LATITUDE"]      = $key["station_lat"];
                            // $json["DISTANCE"]              = $key["distance"];
                            $json["STATION_PHONE"]         = $key["station_phone"];
                            $json["STATION_OPEN"]          = $key["station_open_hour"];
                            $json["STATION_CLOSE"]         = $key["station_close_hour"];
                            $json["STATION_IMAGE"]         = base_url()."media/station/".$key["station_image"];
                            $json["STATION_POINT"]         = $key["station_point"];
                            $json["SHARE_LINK"]                  = base_url()."landing/station/".$store."";

                            if (!empty($result)) {
                                $json["RATING"]     = $result;
                            }else{
                                $json["RATING"]     = "THIS STATION HAS NOT RATE OR REVIEW YET";
                            }

                            if ($key['category_name'] == "Paid" || $key['category_name'] == "PAID" || $key['category_name'] == "paid" || $key['category_id'] == 3) {
                                $json["STATION_TAG"]           = $key["station_tag"];
                            }
                            if (!empty($array_rate)) {
                                $json["RATING & REVIEW"]       = $array_rate;
                            }else{
                                $json["RATING & REVIEW"]       = "This Station Has Not Review or Rating Yet";
                            }
                            $array[] = $json; 
                        }
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="STORE LIST";
                        $data["DATA"]=$array;
                }else{
                    $data["STATUS"]="SUCCESS";
                    $data["MESSAGE"]="STORE NOT FOUND";
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

function detail(){ //detail v.2
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $store      = $this->input->get_post("STATION_ID");
                // $radius     = $this->input->get_post("RADIUS");
                $latitude   = $this->input->get_post("LATITUDE");
                $longtitude = $this->input->get_post("LONGTITUDE");
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                
                if(count($data_app)>0){
                    // $hasil_query = $this->global_model->get_data_join("*","station a","where a.station_id='".$store."'","left join station_category as b on b.category_id = a.category_id")->result_array();
                    $hasil_query = $this->station_model->get_data_detail($store,$latitude,$longtitude);
                    // print_r($hasil_query); die();
                    if(!empty($hasil_query)){
                    $array = array();
                        $rating = $this->global_model->get_data("*", "rating", "where station_id ='".$store."'")->result_array();
                        foreach ($rating as $rate) {
                            $json_rate['rating']            = $rate['rating'];
                            $json_rate['review']            = $rate['review'];

                            $array_rate[] = $json_rate;
                        }
                        $facebook_id = $this->global_model->get_data("*", "member", "where token ='".$headers['USER_TOKEN']."'")->result_array();
                         $type_station = $this->global_model->get_data_join("*","station a","where a.station_id='".$store."'","left join type_of_station as b on b.type_id = a.type_id")->result_array();
                         $type_water = $this->global_model->get_data_join("*","station a","where a.station_id='".$store."'","left join type_of_water as b on b.type_water_id = a.type_water_id")->result_array();
                        foreach ($hasil_query as $key) {
                            $empty = 0;
                            if (!empty($rating)) {
                                foreach ($rating as $row) {
                                    $empty += $row['rating'];
                                }
                                $result = $empty/count($rating);
                            }
                                    // print_r($key);die();
                            $json["STATION_ID"]            = $key["station_id"];
                            $json["FACEBOOK_ID"]           = $key['fb_id'];
                            $json["WEBSITE"]               = $key['website'];
                            $json["STATION_NAME"]          = $key["station_name"];
                            $json["STATION_CATEGORY"]      = $key["category_name"];
                            $json["CATEGORY_ID"]           = $key["category_id"];
                            $json["TYPE_ID"]               = $key['type_id'];
                            $json["TYPE_NAME"]             = $type_station[0]['name_type'];
                            $json["TYPE_WATER_ID"]         = $key['type_water_id'];
                            $json["TYPE_WATER_NAME"]       = $type_water[0]['type_water_name'];
                           
                            $json["STATION_DESCRIPTION"]   = $key["station_desc"];
                            $json["STATION_ADDRESS"]       = $key["station_address"];
                            $json["STATION_LONGITUDE"]     = $key["station_long"];
                            $json["STATION_LATITUDE"]      = $key["station_lat"];
                            $json["DISTANCE"]              = $key["distance"];
                            $compcost =  $key['cost'];
                            if($compcost==0){
                            $json["REFILL_COST"]           ="FREE";
                        }
                        else{
                              $json["REFILL_COST"]         = $key['cost'];
                        }
                            $json["STATION_PHONE"]         = $key["station_phone"];
                            $json["STATION_OPEN"]          = $key["station_open_hour"];
                            if($key["opening_days"]=="Daily"){
                            $json["OPENING_DAYS"]="Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday";
                            }else{
                                 $json["OPENING_DAYS"]=$key["opening_days"];
                            }
                            $json["STATION_PRICE"]         = $key["cost"];
                            $json["STATION_CLOSE"]         = $key["station_close_hour"];
                            $json["STATION_IMAGE"]         = base_url()."media/station/".$key["station_image"];
                            $json["STATION_POINT"]         = $key["station_point"];
                            $json["SHARE_LINK"]                  = base_url()."landing/station/".$store."";

                            if (!empty($result)) {
                                $json["RATING"]     = $result;
                            }else{
                                $json["RATING"]     = "THIS STATION HAS NOT RATE OR REVIEW YET";
                            }

                            if ($key['category_name'] == "Paid" || $key['category_name'] == "PAID" || $key['category_name'] == "paid" || $key['category_id'] == 3) {
                                $json["STATION_TAG"]           = $key["station_tag"];
                            }
                            if (!empty($array_rate)) {
                                $json["RATING & REVIEW"]       = $array_rate;
                            }else{
                                $json["RATING & REVIEW"]       = "This Station Has Not Review or Rating Yet";
                            }
                            $array[] = $json; 
                        }
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="STORE LIST";
                        $data["DATA"]=$array;
                }else{
                    $data["STATUS"]="SUCCESS";
                    $data["MESSAGE"]="STORE NOT FOUND";
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

    function nearby(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $longtitude  = $this->input->get_post("LONGTITUDE");
                $latitude    = $this->input->get_post("LATITUDE");
                $radius      = $this->input->get_post("RADIUS");
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
         if($radius!=""){
            if($latitude!=""){
             if($longtitude!=""){
                if(count($data_app)>0){
                    $hasil_query = $this->station_model->get_data($longtitude,$latitude,$radius);
                    // print_r($hasil_query); die();
                    if(!empty($hasil_query)){
                    
                        $array = array();
                        foreach ($hasil_query as $key) {
                        $rate = $this->global_model->get_data("*", "rating", "where station_id ='".$key['station_id']."'")->result_array();
                        $empty = 0;
                        if (!empty($rate)) {
                            foreach ($rate as $row) {
                                $empty += $row['rating'];
                            }
                            $result = $empty/count($rate);
                        }
//                                     //print_r($key);die();
                            $json["STATION_ID"]            = $key["station_id"];
                            $json["STATION_NAME"]          = $key["station_name"];
                            $json["STATION_CATEGORY"]      = $key["category_name"];
                            $json["CATEGORY_ID"]           = $key["category_id"];
                            $json["STATION_DESCRIPTION"]   = $key["station_desc"];
                            $json["STATION_ADDRESS"]       = $key["station_address"];
                            $json["STATION_LONGITUDE"]     = $key["station_long"];
                            $json["STATION_LATITUDE"]      = $key["station_lat"];
                            $json["DISTANCE"]              = $key["distance"];
                            $json["STATION_PHONE"]         = $key["station_phone"];
                            $json["STATION_OPEN"]          = $key["station_open_hour"];
                            $json["STATION_CLOSE"]         = $key["station_close_hour"];
                            $json["STATION_IMAGE"]         = base_url()."media/station/".$key["station_image"];
                            $json["STATION_POINT"]         = $key["station_point"];
                            if (!empty($result)) {
                                $json["RATING AND REVIEW"]     = $result;
                            }else{
                                $json["RATING AND REVIEW"]     = "THIS STATION HAS NOT RATE OR REVIEW YET";
                            }

                            if (!empty($result) && $result > 0 && $result < 2) {
                                $json["TOTAL STAR"]        = "1";
                            }elseif (!empty($result) && $result > 1 && $result < 3) {
                                $json["TOTAL_STAR"]        = "2";
                            }elseif (!empty($result) && $result > 2 && $result < 4) {
                                $json["TOTAL_STAR"]        = "3";
                            }elseif (!empty($result) && $result > 3 && $result < 5) {
                                $json["TOTAL_STAR"]        = "4";
                            }elseif (!empty($result) && $result > 4 && $result < 6) {
                                $json["TOTAL_STAR"]        = "5";
                            }
                            $array[] = $json; 
                        }
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="STORE LIST";
                        $data["DATA"]=$array;
                }else{
                    $data["STATUS"]="SUCCESS";
                    $data["MESSAGE"]="STORE NOT FOUND";
                    $data["DATA"]=array();
                    }
            }else{
                $data["STATUS"]="FAILED";
                $data["MESSAGE"]="INVALID APP_TOKEN";
                $data["DATA"]=array();
                }
            }else{
                $data["STATUS"]="FAILED";
                $data["MESSAGE"]="REQUIRED LONGTITUDE";
                $data["DATA"]=array();
             }
            }else{
                $data["STATUS"]="FAILED";
                $data["MESSAGE"]="REQUIRED LATITUDE";
                $data["DATA"]=array();   
            }
        }else{
               $data["STATUS"]="FAILED";
                $data["MESSAGE"]="REQUIRED RADIUS";
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


    function suggest(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
                if(count($data_user)>0){
                    $name        = $this->input->post("STATION_NAME");
                    $longtitude  = $this->input->get_post("LONGTITUDE");
                    $latitude    = $this->input->get_post("LATITUDE");
                    $category    = $this->input->get_post("CATEGORY");
                    $type_water  = $this->input->get_post("TYPE_WATER_ID");
                    $type        = $this->input->get_post("TYPE_ID");
                    $email       = $this->input->get_post("EMAIL");
                    // $city        = $this->input->get_post("CITY_ID");
                    // $country     = $this->input->get_post("COUNTRY_ID");
                    $location    = $this->input->get_post("LOCATION");
                    $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                    if(count($data_app)>0){
                        if(!empty($longtitude !="" && $latitude !="")){
                        $validate    = $this->global_model->get_data("*","member","where token='".$headers["USER_TOKEN"]."'")->result_array();
                        $array = array();
                            $input['station_name']  = $name;
                            $input['category_id']   = $category;
                            $input['type_id']       = $type;
                            $input['type_water_id'] = $type_water;
                            $input['suggest_lat']   = $latitude;
                            $input['suggest_long']  = $longtitude;
                            $input['location']      = $location;
                            // $input['city_id']       = $city;
                            // $input['country_id']    = $country;
                            if (!empty($email)) {
                                $input['email']     = $email;
                            }else{
                                $input['email']     = "";
                            }
                            $input['member_id']     = $validate[0]['member_id'];
                            $input['status']        = "1";
                            // print_r($input); die();
                            $this->db->insert("station_suggested", $input);
                            $id = $this->db->insert_id();

                            $point_before = $this->global_model->get_data("*", "point", "where member_id = '".$validate[0]['member_id']."'")->result_array();
                            if(!empty($point_before)){
                            // $TOTAL = $point_before[0]['point'];
                            // print_r($TOTAL); die();
                            $input2['point']            = $point_before[0]['point']+10;
                            // print_r($point_before[0]['point']+10); die();
                            $input2['created_date']     = date("Y-m-d H:i:s");
                            $this->db->where("member_id", $validate[0]['member_id']);
                            $this->db->update('point', $input2);

                            if($this->input->get_post("IMAGE")!=""){
                                    // $temp_android="";
                                $base64 = $this->input->get_post("IMAGE");
                                
                                define('UPLOAD_DIR', './media/station/suggested/');
                                $base64img = str_replace('data:image/jpeg;base64,', '', $base64);
                                $data1 = base64_decode($base64img);
                                // $data2 = uniqid() . '.jpg';
                                $file = UPLOAD_DIR . uniqid(). '.jpg';
                                file_put_contents($file, $data1);
                                $xxx=explode("/",$file);
                                $image= $xxx[4];

                                $input1['suggest_id']        = $id;
                                $input1['suggest_image']     = $image;
                                $this->db->insert('suggest_image', $input1);
                            }

                            if($this->input->get_post("IMAGE_2")!=""){
                                    // $temp_android="";
                                $base64 = $this->input->get_post("IMAGE_2");
                                
                                // define('UPLOAD_DIR', './media/station/suggested/');
                                $base64img = str_replace('data:image/jpeg;base64,', '', $base64);
                                $data1 = base64_decode($base64img);
                                // $data2 = uniqid() . '.jpg';
                                $file = UPLOAD_DIR . uniqid(). '.jpg';
                                file_put_contents($file, $data1);
                                $xxx=explode("/",$file);
                                $image= $xxx[4];

                                $input1['suggest_id']        = $id;
                                $input1['suggest_image']     = $image;
                                $this->db->insert('suggest_image', $input1);
                            }

                            if($this->input->get_post("IMAGE_3")!=""){
                                    // $temp_android="";
                                $base64 = $this->input->get_post("IMAGE_3");
                                
                                // define('UPLOAD_DIR', './media/station/suggested/');
                                $base64img = str_replace('data:image/jpeg;base64,', '', $base64);
                                $data1 = base64_decode($base64img);
                                // $data2 = uniqid() . '.jpg';
                                $file = UPLOAD_DIR . uniqid(). '.jpg';
                                file_put_contents($file, $data1);
                                $xxx=explode("/",$file);
                                $image= $xxx[4];

                                $input1['suggest_id']        = $id;
                                $input1['suggest_image']     = $image;
                                $this->db->insert('suggest_image', $input1);
                            }

                            if($this->input->get_post("IMAGE_4")!=""){
                                    // $temp_android="";
                                $base64 = $this->input->get_post("IMAGE_4");
                                
                                // define('UPLOAD_DIR', './media/station/suggested/');
                                $base64img = str_replace('data:image/jpeg;base64,', '', $base64);
                                $data1 = base64_decode($base64img);
                                // $data2 = uniqid() . '.jpg';
                                $file = UPLOAD_DIR . uniqid(). '.jpg';
                                file_put_contents($file, $data1);
                                $xxx=explode("/",$file);
                                $image= $xxx[4];

                                $input1['suggest_id']        = $id;
                                $input1['suggest_image']     = $image;
                                $this->db->insert('suggest_image', $input1);
                            }

                            if($this->input->get_post("IMAGE_5")!=""){
                                    // $temp_android="";
                                $base64 = $this->input->get_post("IMAGE_5");
                                
                                // define('UPLOAD_DIR', './media/station/suggested/');
                                $base64img = str_replace('data:image/jpeg;base64,', '', $base64);
                                $data1 = base64_decode($base64img);
                                // $data2 = uniqid() . '.jpg';
                                $file = UPLOAD_DIR . uniqid(). '.jpg';
                                file_put_contents($file, $data1);
                                $xxx=explode("/",$file);
                                $image= $xxx[4];

                                $input1['suggest_id']        = $id;
                                $input1['suggest_image']     = $image;
                                $this->db->insert('suggest_image', $input1);
                            }
                                $message = $this->global_model->get_data("*", "suggest_text", "where status = '1'")->result_array();
                                if (!empty($message) || $message != "") {
                                    $json['SUGGEST_TEXT']      = $message[0]['text_title'];
                                    $json['SUGGEST_CONTENT']   = $message[0]['text_content'];

                            $array[] = $json;
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="YOUR DATA HAS SENT";
                            $data["DATA"]=$array;

                                }else{
                                    $data["STATUS"]     = "SUCCESS";
                                    $data["MESSAGE"]    = "BUT DATA IS EMPTY :( PLEASE CREATE DATA BEFORE";
                                    $data["DATA"]       = $array;
                                }
                            }else{
                        // $data["STATUS"]="FAILED";
                        // $data["MESSAGE"]="ACCOUNT NOT DETECTED";
                        // $data["DATA"]=array();
                            $input2['point']            = 10;
                            // print_r($point_before[0]['point']+10); die();
                            $input2['created_date']     = date("Y-m-d H:i:s");
                            $input2['member_id']        = $validate[0]['member_id'];

                            $this->db->insert('point', $input2);

                            if($this->input->get_post("IMAGE")!=""){
                                    // $temp_android="";
                                $base64 = $this->input->get_post("IMAGE");
                                
                                define('UPLOAD_DIR', './media/station/suggested/');
                                $base64img = str_replace('data:image/jpeg;base64,', '', $base64);
                                $data1 = base64_decode($base64img);
                                // $data2 = uniqid() . '.jpg';
                                $file = UPLOAD_DIR . uniqid(). '.jpg';
                                file_put_contents($file, $data1);
                                $xxx=explode("/",$file);
                                $image= $xxx[4];

                                $input1['suggest_id']        = $id;
                                $input1['suggest_image']     = $image;
                                $this->db->insert('suggest_image', $input1);
                            }

                            if($this->input->get_post("IMAGE_2")!=""){
                                    // $temp_android="";
                                $base64 = $this->input->get_post("IMAGE");
                                
                                // define('UPLOAD_DIR', './media/station/suggested/');
                                $base64img = str_replace('data:image/jpeg;base64,', '', $base64);
                                $data1 = base64_decode($base64img);
                                // $data2 = uniqid() . '.jpg';
                                $file = UPLOAD_DIR . uniqid(). '.jpg';
                                file_put_contents($file, $data1);
                                $xxx=explode("/",$file);
                                $image= $xxx[4];

                                $input1['suggest_id']        = $id;
                                $input1['suggest_image']     = $image;
                                $this->db->insert('suggest_image', $input1);
                            }

                            if($this->input->get_post("IMAGE_3")!=""){
                                    // $temp_android="";
                                $base64 = $this->input->get_post("IMAGE");
                                
                                // define('UPLOAD_DIR', './media/station/suggested/');
                                $base64img = str_replace('data:image/jpeg;base64,', '', $base64);
                                $data1 = base64_decode($base64img);
                                // $data2 = uniqid() . '.jpg';
                                $file = UPLOAD_DIR . uniqid(). '.jpg';
                                file_put_contents($file, $data1);
                                $xxx=explode("/",$file);
                                $image= $xxx[4];

                                $input1['suggest_id']        = $id;
                                $input1['suggest_image']     = $image;
                                $this->db->insert('suggest_image', $input1);
                            }

                            if($this->input->get_post("IMAGE_4")!=""){
                                    // $temp_android="";
                                $base64 = $this->input->get_post("IMAGE");
                                
                                // define('UPLOAD_DIR', './media/station/suggested/');
                                $base64img = str_replace('data:image/jpeg;base64,', '', $base64);
                                $data1 = base64_decode($base64img);
                                // $data2 = uniqid() . '.jpg';
                                $file = UPLOAD_DIR . uniqid(). '.jpg';
                                file_put_contents($file, $data1);
                                $xxx=explode("/",$file);
                                $image= $xxx[4];

                                $input1['suggest_id']        = $id;
                                $input1['suggest_image']     = $image;
                                $this->db->insert('suggest_image', $input1);
                            }

                            if($this->input->get_post("IMAGE_5")!=""){
                                    // $temp_android="";
                                $base64 = $this->input->get_post("IMAGE");
                                
                                // define('UPLOAD_DIR', './media/station/suggested/');
                                $base64img = str_replace('data:image/jpeg;base64,', '', $base64);
                                $data1 = base64_decode($base64img);
                                // $data2 = uniqid() . '.jpg';
                                $file = UPLOAD_DIR . uniqid(). '.jpg';
                                file_put_contents($file, $data1);
                                $xxx=explode("/",$file);
                                $image= $xxx[4];

                                $input1['suggest_id']        = $id;
                                $input1['suggest_image']     = $image;
                                $this->db->insert('suggest_image', $input1);
                            }
                                $message = $this->global_model->get_data("*", "suggest_text", "where status = '1'")->result_array();
                                if (!empty($message) || $message != "") {
                                    $json['SUGGEST_TEXT']      = $message[0]['text_title'];
                                    $json['SUGGEST_CONTENT']   = $message[0]['text_content'];

                            $array[] = $json;
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="YOUR DATA HAS SENT WITH NEW suggested";
                            $data["DATA"]=$array;

                                }else{
                                    $data["STATUS"]     = "SUCCESS";
                                    $data["MESSAGE"]    = "BUT DATA IS EMPTY :( PLEASE CREATE DATA BEFORE";
                                    $data["DATA"]       = $array;
                                }
                            }
                        // }
                    }else{
                        $data["STATUS"]="FAILED";
                        $data["MESSAGE"]="PLEASE ACTIVATION YOUR LOCATION";
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

    function station_category(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                if(count($data_app)>0){
                    $hasil_query = $this->global_model->get_data("*","station_category a","where a.status='1'")->result_array();
                    // print_r($hasil_query); die();
                    if(!empty($hasil_query)){
                    $array = array();
                        foreach ($hasil_query as $key) {
//                                     //print_r($key);die();
                            $json["CATEGORY_ID"]           = $key["category_id"];
                            $json["CATEGORY_NAME"]         = $key["category_name"];
                            $json["CATEGORY_DESCRIPTION"]  = $key["category_desc"];
                            
                            $array[] = $json; 
                        }
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="CATEGORY LIST";
                        $data["DATA"]=$array;
                }else{
                    $data["STATUS"]="SUCCESS";
                    $data["MESSAGE"]="DATA NOT FOUND";
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

    function filter(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $longtitude  = $this->input->get_post("LONGTITUDE");
                $latitude    = $this->input->get_post("LATITUDE");
                $radius      = $this->input->get_post("RADIUS");
                $category_id = $this->input->get_post("CATEGORY_ID");
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
         if($radius!=""){
            if($latitude!=""){
             if($longtitude!=""){
                if(count($data_app)>0){

                    // print_r($hasil_query); die();
                    if (!empty($category_id)) {
                        $hasil_query = $this->station_model->get_data_filter($longtitude,$latitude,$radius,$category_id);
                        if(!empty($hasil_query)){
                            $array = array();
                            foreach ($hasil_query as $key) {
    //                         $rate = $this->global_model->get_data("*", "rating", "where station_id ='".$key['station_id']."'")->result_array();
                                $empty = 0;
                                if (!empty($rate)) {
                                    foreach ($rate as $row) {
                                        $empty += $row['rating'];
                                    }
                                    $result = $empty/count($rate);
                                }
        //                                     //print_r($key);die();
                                    $json["STATION_ID"]            = $key["station_id"];
                                    $json["STATION_NAME"]          = $key["station_name"];
                                    $json["STATION_CATEGORY"]      = $key["category_name"];
                                    $json["CATEGORY_ID"]           = $key["category_id"];
                                    $json["STATION_DESCRIPTION"]   = $key["station_desc"];
                                    $json["STATION_ADDRESS"]       = $key["station_address"];
                                    $json["STATION_LONGITUDE"]     = $key["station_long"];
                                    $json["STATION_LATITUDE"]      = $key["station_lat"];
                                    $json["DISTANCE"]              = $key["distance"];
                                    $json["STATION_PHONE"]         = $key["station_phone"];
                                    $json["STATION_OPEN"]          = $key["station_open_hour"];
                                    $json["STATION_CLOSE"]         = $key["station_close_hour"];
                                    $json["STATION_IMAGE"]         = base_url()."media/station/".$key["station_image"];
                                    $json["STATION_POINT"]         = $key["station_point"];
                                    if (!empty($result)) {
                                        $json["RATING AND REVIEW"]     = $result;
                                    }else{
                                        $json["RATING AND REVIEW"]     = "THIS STATION HAS NOT RATE OR REVIEW YET";
                                    }

                                    if (!empty($result) && $result > 0 && $result < 2) {
                                        $json["TOTAL STAR"]        = "1";
                                    }elseif (!empty($result) && $result > 1 && $result < 3) {
                                        $json["TOTAL_STAR"]        = "2";
                                    }elseif (!empty($result) && $result > 2 && $result < 4) {
                                        $json["TOTAL_STAR"]        = "3";
                                    }elseif (!empty($result) && $result > 3 && $result < 5) {
                                        $json["TOTAL_STAR"]        = "4";
                                    }elseif (!empty($result) && $result > 4 && $result < 6) {
                                        $json["TOTAL_STAR"]        = "5";
                                    }
                                    $array[] = $json; 
                                }
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="STORE LIST";
                            $data["DATA"]=$array;
                        }else{
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="STORE NOT FOUND";
                            $data["DATA"]=array();
                        }
                }else{
                    $hasil_query = $this->station_model->get_data($longtitude,$latitude,$radius);
                    if(!empty($hasil_query)){
                        $array = array();
                        foreach ($hasil_query as $key) {
//                                     //print_r($key);die();
                            $rate = $this->global_model->get_data("*", "rating", "where station_id ='".$key['station_id']."'")->result_array();
                            $empty = 0;
                            if (!empty($rate)) {
                                foreach ($rate as $row) {
                                    $empty += $row['rating'];
                                }
                                $result = $empty/count($rate);
                            }
    //                                     //print_r($key);die();
                                $json["STATION_ID"]            = $key["station_id"];
                                $json["STATION_NAME"]          = $key["station_name"];
                                $json["STATION_CATEGORY"]      = $key["category_name"];
                                $json["CATEGORY_ID"]           = $key["category_id"];
                                $json["STATION_DESCRIPTION"]   = $key["station_desc"];
                                $json["STATION_ADDRESS"]       = $key["station_address"];
                                $json["STATION_LONGITUDE"]     = $key["station_long"];
                                $json["STATION_LATITUDE"]      = $key["station_lat"];
                                $json["DISTANCE"]              = $key["distance"];
                                $json["STATION_PHONE"]         = $key["station_phone"];
                                $json["STATION_OPEN"]          = $key["station_open_hour"];
                                $json["STATION_CLOSE"]         = $key["station_close_hour"];
                                $json["STATION_IMAGE"]         = base_url()."media/station/".$key["station_image"];
                                $json["STATION_POINT"]         = $key["station_point"];
                                if (!empty($result)) {
                                    $json["RATING AND REVIEW"]     = $result;
                                }else{
                                    $json["RATING AND REVIEW"]     = "THIS STATION HAS NOT RATE OR REVIEW YET";
                                }

                                if (!empty($result) && $result > 0 && $result < 2) {
                                    $json["TOTAL STAR"]        = "1";
                                }elseif (!empty($result) && $result > 1 && $result < 3) {
                                    $json["TOTAL_STAR"]        = "2";
                                }elseif (!empty($result) && $result > 2 && $result < 4) {
                                    $json["TOTAL_STAR"]        = "3";
                                }elseif (!empty($result) && $result > 3 && $result < 5) {
                                    $json["TOTAL_STAR"]        = "4";
                                }elseif (!empty($result) && $result > 4 && $result < 6) {
                                    $json["TOTAL_STAR"]        = "5";
                                }else{
                                    $json["TOTAL_STAR"]        = "";
                                }
                                $array[] = $json; 
                            }
                            $data["STATUS"]="SUCCESS";
                            $data["MESSAGE"]="STORE LIST";
                            $data["DATA"]=$array;
                    }else{
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="STORE NOT FOUND";
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
                $data["MESSAGE"]="REQUIRED LONGTITUDE";
                $data["DATA"]=array();
             }
            }else{
                $data["STATUS"]="FAILED";
                $data["MESSAGE"]="REQUIRED LATITUDE";
                $data["DATA"]=array();   
            }
        }else{
            $data["STATUS"]="FAILED";
            $data["MESSAGE"]="REQUIRED RADIUS";
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

    function promo(){
        $headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_user = $this->member_model->check_member($headers["USER_TOKEN"]);
            if(count($data_user)>0){
                $station_id  = $this->input->get_post("STATION_ID");
                $data_app    = $this->member_model->check_app($headers["APP_TOKEN"]);
                if(count($data_app)>0){
                    $date_now = date("Y-m-d");
                    $hasil_query = $this->global_model->get_data_join("*","promo_list a","where a.station_id='".$station_id."' AND a.end_date >='".$date_now."'","left join station as b on b.station_id = a.station_id")->result_array();
                    // print_r($hasil_query); die();
                    if(!empty($hasil_query)){
                    $array = array();
                        foreach ($hasil_query as $key) {
//                                     //print_r($key);die();
                            $json["PROMO_NAME"]            = $key["promo_name"];
                            $json["MINIMUM_TRANSACTION"]   = $key["transaction"];
                            $json["START_DATE"]            = $key["start_date"];
                            $json["END_DATE"]              = $key["end_date"];
                            $json["STATION_ID"]            = $key["station_id"];
                            $json["STATION_NAME"]          = $key["station_name"];
                            $json["PROMO_DESC"]            = $key["promo_desc"];
                            $json["TERMS"]                 = $key["terms"];
                            $json["PROMO_IMAGE"]         = base_url()."media/promo/".$key["promo_image"];
                            $array[] = $json; 
                        }
                        $data["STATUS"]="SUCCESS";
                        $data["MESSAGE"]="PROMO LIST";
                        $data["DATA"]=$array;
                }else{
                    $data["STATUS"]="SUCCESS";
                    $data["MESSAGE"]="PROMO NOT FOUND";
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