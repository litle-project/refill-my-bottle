<?php
//error_reporting(0);
class General extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_model/order_model");
		$this->load->model("api_model/member_model");
	}

	function list_workshop(){
		$headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            if(count($data_app)>0){
                $data_user = $this->member_model->check_member($headers["USER_TOKEN"],$this->input->get_post("MEMBER_ID"));
                if(count($data_user)>0){
					$location_id = $this->input->get_post("LOCATION_ID");
				    $limit = $this->input->get_post("LIMIT");
				    $offset = $this->input->get_post("OFFSET");
				    
				    $cek = $this->order_model->workshop($location_id,$limit,$offset);
				    if(count($cek)>0){
				        foreach($cek as $row){
				            $json["LOCATION_ID"] = $row["location_id"];
				            $json["LOCATION_NAME"] = $row["location_name"];
				            ///////// GET LOCATION DETAIL ////////
				            $this->db->select("*");
							$this->db->where("deleted","0");
							$this->db->where("location_id",$row["location_id"]);
							$loc=$this->db->get("location_det");


							if($loc->result_array()){
								$no=0;
								foreach ($loc->result_array() as $det){
									$image[$no]["LOCATION_DETAIL"]=$det["location_det_desc"];
									$image[$no]["LOCATION_LAT"]=$det["location_det_lat"];
									$image[$no]["LOCATION_LONG"]=$det["location_det_long"];
									//$menuux[]=$image;
									$no++;
								}
								$json["LOCATION_LIST"]=$image;
							}else{
								$json["LOCATION_LIST"]=array();
							}

				            $list[]=$json;
				        }
				        $data["STATUS"]="SUCCESS";
						$data["MESSAGE"]="WORKSHOP LIST";
						$data["DATA"]=$list;
				    }else{
				        $data["STATUS"]="FAILED";
						$data["MESSAGE"]="NO DATA AVAILABLE";
						$data["DATA"]=(object) array();
				    }
				}else{
					$data["STATUS"] = "FAILED";
                    $json["MESSAGE"] = "YOUR SESSION IS EXPIRED. PLEASE RE-LOGIN";
                    $json["DATA"] = array();
				}
			}else{
				$data["STATUS"] = "FAILED";
                $data["MESSAGE"] = "APP TOKEN INVALID";
                $data["DATA"] = array();
			}
		}else{
			$data["STATUS"] = "FAILED";
            $data["MESSAGE"] = "PLEASE INPUT APP TOKEN & USER TOKEN";
            $data["DATA"] = array();
		}
		echo json_encode($data);
	}

	function image_resize($image){

		$config2['image_library'] = 'gd2';
		$config2['source_image'] = './media/order/'.$image.'';
		$config2['new_image'] = './media/order/low/'.$image.'';
		$config2['create_thumb'] = FALSE;
		$config2['maintain_ratio'] = FALSE;
		$config2['width'] = 400;
		$config2['height'] = 400;

		$this->load->library('image_lib', $config2);
		$this->image_lib->initialize($config2);

		$this->image_lib->resize();

	}
}
?>