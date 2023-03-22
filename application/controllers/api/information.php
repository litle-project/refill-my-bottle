<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		header('Content-Type: application/json');
		$this->load->model('api_model/information_model');
        $this->load->model('global_model');
		$this->load->library('get_api');
	}

	public function country()
	{

		$headers = apache_request_headers();

		if(!empty($headers["APP_TOKEN"])){
       		$cari = $this->input->post("SEARCH");
            $country_nyari = $this->information_model->list_country_say($cari);
            $country = $this->information_model->list_country();
       		// print_r($blog); die();

        		if(!empty($country)){
                if($cari==""){
        			foreach ($country as $row) {

        				$data['ID_COUNTRY']        = $row['country_id'];
                        $data['NAME_COUNTRY'] 	= $row['country_name'];

        				$result[] = $data;
        			}
                    $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'COUNTRY';
                    $json['DATA'] = $result;
                }else{
                    if(!empty($country_nyari)){
                    foreach ($country_nyari as $cow) {

                        $data['ID_COUNTRY']        = $cow['country_id'];
                        $data['NAME_COUNTRY']   = $cow['country_name'];

                        $result[] = $data;
                    }
                    $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'COUNTRY';
                    $json['DATA'] = $result;
                }else{
                    $json['STATUS'] = 'FAILED';
                    $json['MESSAGE'] = 'NO DATA FOUND';
                    $json['DATA'] = (object) array();         
                     }
                    }
        			
        		}else{
        			$json['STATUS'] = 'FAILED';
        			$json['MESSAGE'] = 'NO DATA FOUND';
        			$json['DATA'] = (object) array();
        		}
        	}else{
        		$json['STATUS'] = 'FAILED';
    			$json['MESSAGE'] = 'INVALID APP_TOKEN';
    			$json['DATA'] = (object) array();
        	}
		echo json_encode($json);
	}

   public function city()
    {
        $country = $this->input->post("COUNTRY_ID");
         $cari = $this->input->post("SEARCH");
        $headers = apache_request_headers();
        if(!empty($headers['APP_TOKEN'])){
            $splash = $this->information_model->check_state($country);
            $nyari = $this->information_model->check_state_cari($country,$cari);

            // print_r($blog); die();
                if(!empty($splash)){
                    if($cari==""){
                    foreach ($splash as $row) {

                        $data['ID_CITY'] = $row['city_id'];
                        $data['NAME_CITY']   = $row['city_name'];
                         $data['ID_COUNTRY']   = $row['country_id'];
                        $result[] = $data;
                    }
                     $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'CITY';
                    $json['DATA'] = $result;
                }else{
                         if(!empty($nyari)){
                           foreach ($nyari as $cow) {

                        $data['ID_CITY'] = $cow['city_id'];
                        $data['NAME_CITY']   = $cow['city_name'];
                         $data['ID_COUNTRY']   = $cow['country_id'];
                        $result[] = $data;
                    }
                     $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'CITY';
                    $json['DATA'] = $result;
                }else{
                    $json['STATUS'] = 'FAILED';
                    $json['MESSAGE'] = 'NO DATA FOUND';
                    $json['DATA'] = (object) array();
                }
                }
                   
                }else{
                    $json['STATUS'] = 'FAILED';
                    $json['MESSAGE'] = 'NO DATA FOUND';
                    $json['DATA'] = (object) array();
                }
            }else{
                $json['STATUS'] = 'FAILED';
                $json['MESSAGE'] = 'INVALID APP_TOKEN';
                $json['DATA'] = (object) array();
            }
        echo json_encode($json);
    }


public function area()
    {
         $city = $this->input->post("CITY_ID");
        $headers = apache_request_headers();
        if(!empty($headers['APP_TOKEN'])){
            $splash = $this->information_model->check_city($city);
            // print_r($blog); die();
                if(!empty($splash)){
                    foreach ($splash as $row) {

                        $data['ID_AREA']        = $row['area_id'];
                        $data['NAME_AREA']   = $row['area_name'];
                           $data['ID_CITY']   = $row['city_id'];
                        $result[] = $data;
                    }
                    $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'AREA';
                    $json['DATA'] = $result;
                }else{
                    $json['STATUS'] = 'FAILED';
                    $json['MESSAGE'] = 'NO DATA FOUND';
                    $json['DATA'] = (object) array();
                }
            }else{
                $json['STATUS'] = 'FAILED';
                $json['MESSAGE'] = 'INVALID APP_TOKEN';
                $json['DATA'] = (object) array();
            }
        echo json_encode($json);
    }

public function bottle_size()
    {
        $headers = apache_request_headers();

        if(!empty($headers["APP_TOKEN"])){
            // $bottle = $this->global_model->get_data("*","bottle_size","where status='1'")->order_by("value","asc")->result_array();
    $this->db->select('*');
    $this->db->where('status','1');
    $this->db->order_by("value","asc");
    $this->db->from('bottle_size');
    $query=$this->db->get()->result_array();
    
            // print_r($blog); die();
                if(!empty($query)){
                    foreach ($query as $row) {

                        $data['ID_BOTTLE']     = $row['bottle_size_id'];
                        $data['NAME_BOTTLE']   = $row['name_size'];
                        $data['BOTTLE_VALUE']  = $row['value'];
                        $data['BOTTLE_IMAGE']  = base_url()."media/bottle/".$row['bottle_image'];
                        $result[] = $data;
                    }
                    $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'BOTTLE_SIZE';
                    $json['DATA'] = $result;
                }else{
                    $json['STATUS'] = 'FAILED';
                    $json['MESSAGE'] = 'NO DATA FOUND';
                    $json['DATA'] = (object) array();
                }
            }else{
                $json['STATUS'] = 'FAILED';
                $json['MESSAGE'] = 'INVALID APP_TOKEN';
                $json['DATA'] = (object) array();
            }
        echo json_encode($json);
    }

public function type_station()
    {
        $headers = apache_request_headers();

        if(!empty($headers["APP_TOKEN"])){
           
    $this->db->select('*');
    $this->db->where('status','1');
    $this->db->order_by("name_type","asc");
    $this->db->from('type_of_station');
    $query=$this->db->get()->result_array();
    
            // print_r($blog); die();
                if(!empty($query)){
                    foreach ($query as $row) {

                        $data['ID_TYPE']     = $row['type_id'];
                        $data['NAME_TYPE']   = $row['name_type'];
                        $result[] = $data;
                    }
                    $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'TYPE_OF_STATION';
                    $json['DATA'] = $result;
                }else{
                    $json['STATUS'] = 'FAILED';
                    $json['MESSAGE'] = 'NO DATA FOUND';
                    $json['DATA'] = (object) array();
                }
            }else{
                $json['STATUS'] = 'FAILED';
                $json['MESSAGE'] = 'INVALID APP_TOKEN';
                $json['DATA'] = (object) array();
            }
        echo json_encode($json);
    }

    public function type_water()
    {
        $headers = apache_request_headers();

        if(!empty($headers["APP_TOKEN"])){
           
    $this->db->select('*');
    $this->db->where('status','1');
    $this->db->order_by("type_water_name","asc");
    $this->db->from('type_of_water');
    $query=$this->db->get()->result_array();
    
            // print_r($blog); die();
                if(!empty($query)){
                    foreach ($query as $row) {

                        $data['ID_TYPE_WATER']     = $row['type_water_id'];
                        $data['NAME_TYPE_WATER']   = $row['type_water_name'];
                        $result[] = $data;
                    }
                    $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'TYPE_OF_WATER';
                    $json['DATA'] = $result;
                }else{
                    $json['STATUS'] = 'FAILED';
                    $json['MESSAGE'] = 'NO DATA FOUND';
                    $json['DATA'] = (object) array();
                }
            }else{
                $json['STATUS'] = 'FAILED';
                $json['MESSAGE'] = 'INVALID APP_TOKEN';
                $json['DATA'] = (object) array();
            }
        echo json_encode($json);
    }

public function country_filter()
    {
        $headers = apache_request_headers();

        if(!empty($headers["APP_TOKEN"])){
            $country = $this->information_model->list_country_filter();
            // print_r($blog); die();
                if(!empty($country)){
                    foreach ($country as $row) {

                        $data['ID_COUNTRY']        = $row['country_id'];
                        $data['NAME_COUNTRY']   = $row['country_name'];

                        $result[] = $data;
                    }
                    $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'COUNTRY';
                    $json['DATA'] = $result;
                }else{
                    $json['STATUS'] = 'FAILED';
                    $json['MESSAGE'] = 'NO DATA FOUND';
                    $json['DATA'] = (object) array();
                }
            }else{
                $json['STATUS'] = 'FAILED';
                $json['MESSAGE'] = 'INVALID APP_TOKEN';
                $json['DATA'] = (object) array();
            }
        echo json_encode($json);
    }

}