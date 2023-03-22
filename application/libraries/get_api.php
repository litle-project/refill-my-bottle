<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Get_api{
	
	
	
	
  public function get_api_data_issue($URL,$post){
        $utc = time();
        $header_data = array(
            "Content-Type: application/json",
            "Accept: application/json",
            // "X-API-KEY:3ecbcb4e62a00d2bc58080218a4376f24a8079e1",
            "X-UTC:" . $utc,
        );
        $post = http_build_query($post);
        $url = $URL."?".$post;
        // echo $post;
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_HEADER => 0,
        );
        // echo $url."<br>";
        // echo $ch;
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        // echo $answer;die();
        return $answer;
    }

    public function get_api_data($URL,$post){
        $utc = time();
        $header_data = array(
            "Content-Type: application/json",
            "Accept: application/json",
            // "X-API-KEY:3ecbcb4e62a00d2bc58080218a4376f24a8079e1",
            "X-UTC:" . $utc,
        );
        $post = http_build_query($post);
        $url = $URL."?".$post;
        // echo $post;
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => 0,
        );
        // echo $url."<br>";
        // echo $ch;
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        // echo $answer;die();
        return json_decode($answer, true);
        // return $answer;
    }

    public function get_api_air_price_galileo($URL,$post){
        $utc = time();
        $header_data = array(
            "Content-Type: application/json",
            "Accept: application/json",
            // "X-API-KEY:3ecbcb4e62a00d2bc58080218a4376f24a8079e1",
            "X-UTC:" . $utc,
        );
        $post = http_build_query($post);
        $url = $URL."?".$post;
        // echo $post;
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_HEADER => 0,
        );
        // echo $url."<br>";
        // echo $ch;
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        // echo $answer;die();
        return $answer;
    }

    public function get_api_data1($URL,$post){
        $utc = time();
        $header_data = array(
            // "Content-Type: application/json",
            // "Accept: application/json",
            // "X-API-KEY:3ecbcb4e62a00d2bc58080218a4376f24a8079e1",
            "X-UTC:" . $utc,
        );
        $post = http_build_query($post);
        $url = $URL."?".$post;
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => 0,
        );
        // echo $ch;
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // $answer = $this->get_string_between($answer,"JSON_CALLBACK(",")");
        $answer = substr($answer, 14, strlen($answer)-15);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        // echo $answer;die();
        return json_decode($answer, true);
    }

    public function post_api_data($URL,$post,$header_data = ""){
        $utc = time();
        if($header_data == "") {
            if(!empty($post['USER_TOKEN']))
            {
                $header_data = array(
                    "APP_TOKEN: clabsrefil",
                    "USER_TOKEN: ".$post['USER_TOKEN'],
                );
            }
            else
            {
                 $header_data = array(
                    "APP_TOKEN: clabrefil",
                );
            }
        }
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_FTPAPPEND => true,
            CURLOPT_NOPROGRESS => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HEADER => 0,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 4000000,
        );
        // echo $ch."<br>";
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        //print_r($answer);
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        //echo $answer;die();
        return json_decode($answer, true);
    }

    public function post_api_data2($URL,$post,$header_data = ""){
        $utc = time();
        if($header_data == "") {
            if(!empty($post['USER_TOKEN']))
            {
                $header_data = array(
                    "APP_TOKEN: clabsTourizp4zz",
                    "USER_TOKEN: ".$post['USER_TOKEN'],
                );
            }
            else
            {
                 $header_data = array(
                    "APP_TOKEN: clabsTourizp4zz",
                );
            }
        }
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_FTPAPPEND => true,
            CURLOPT_NOPROGRESS => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HEADER => 0,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 4000000,
        );
        // echo $ch."<br>";
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        echo $answer;die();
        return json_decode($answer, true);
    }

     public function post_api_data3($URL,$post,$header_data){
        $utc = time();
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_FTPAPPEND => true,
            CURLOPT_NOPROGRESS => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HEADER => 0,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 4000000,
        );
        // echo $ch."<br>";
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        //echo $answer;die();
        return json_decode($answer, true);
    }

     public function post_cek_data($URL,$post,$header_data){
        $utc = time();
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_FTPAPPEND => true,
            CURLOPT_NOPROGRESS => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HEADER => 0,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 4000000,
        );
        // echo $ch."<br>";
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        echo $answer;die();
        return json_decode($answer, true);
    }

     public function post_api_data4($URL,$post,$header_data){
        $utc = time();
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_FTPAPPEND => true,
            CURLOPT_NOPROGRESS => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HEADER => 0,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 4000000,
        );
        // echo $ch."<br>";
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        echo $answer;die();
        return json_decode($answer, true);
    }

    public function post_api_data_backend($URL, $post, $header_data=""){
        $utc = time();
        if($header_data == ""){
            $header_data = array(
                "APP_TOKEN: clabskia"
            );
        }
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HEADER => 0,
        );

        // print_r($curlOpts);
        // die();

        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        if (curl_error($ch)){
            die(curl_error($ch));
        }

        // echo $answer;
        // die();

        curl_close($ch);
        return json_decode($answer, true);
    }

    public function post_api_data_mem($URL,$post,$header_data = ""){
        $utc = time();
        if($header_data == "") {
            $header_data = array(
                // "Content-Type: application/json",
                // "Accept: application/json",
                "APP_TOKEN: clabslandtour",
            );
        }
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HEADER => 0,
            CURLOPT_CONNECTTIMEOUT => 300,
            CURLOPT_AUTOREFERER => true,
        );

        // echo $ch."<br>";
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        // echo $answer;die();
        return $answer;
    }

    public function post_api_data_dev($URL,$post,$header_data = ""){
        $utc = time();
        if($header_data == "") {
            $header_data = array(
                // "Content-Type: application/json",
                // "Accept: application/json",
            );
        }
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HEADER => 0,
        );
        // echo $ch."<br>";
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        // echo $answer;die();
        return json_decode($answer, true);
    }

    public function post_api_data1($URL,$post,$header_data = ""){
        $utc = time();
        if($header_data == "") {
            $header_data = array(
                "Content-Type: application/json",
                "Accept: application/json",
            );
        }
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HEADER => 1,

        );
        echo $ch;
        print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        echo $answer;die();
        return json_decode($answer, true);
    }

    function get_opsigo_api($url,$post="",$header_data) {
        $utc = time();
        if($post != "") {
            $post = http_build_query($post);
            $url = $url."?".$post;
        }
        // echo $url;die();
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header_data,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => 0,
        );
        // echo $ch."<br>";
        // print_r($curlOpts);
        // die();
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        // If there was an error, show it
        if (curl_error($ch)) {
            die(curl_error($ch));
        }

        curl_close($ch);
        // echo $answer;die();
        return json_decode($answer, true);
    }

    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

	public function get_item($type="all",$id=""){
		$url = "http://codelabsid.com/auction_cms/api/item/".$type."/".$id;
		$json = file_get_contents($url);
		$json_data = json_decode($json, true);
		
		return $json_data;
	}
	
	
		
	
	
	
	
}