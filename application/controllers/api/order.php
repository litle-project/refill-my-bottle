<?php
error_reporting(0);
class Order extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("api_model/order_model");
		$this->load->model("api_model/member_model");
	}

	function add_order(){
		$headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            if(count($data_app)>0){
                $data_user = $this->member_model->check_member($headers["USER_TOKEN"],$this->input->get_post("MEMBER_ID"));
                if(count($data_user)>0){
					$MEMBER_ID=$this->input->get_post("MEMBER_ID");
					$ORDER_SERVICE=$this->input->get_post("ORDER_SERVICE");
					$EMERGENCY_SERVICE=$this->input->get_post("EMERGENCY_SERVICE");
					$ORDER_LOCATION=$this->input->get_post("ORDER_LOCATION");
					$ORDER_LOCATION_DETAIL=$this->input->get_post("ORDER_LOCATION_DETAIL");
					$ORDER_LAT=$this->input->get_post("ORDER_LAT");
					$ORDER_LONG=$this->input->get_post("ORDER_LONG");
					$ORDER_PHOTO_DETAIL=$this->input->get_post("ORDER_PHOTO_DETAIL");
					$PHOTO_COUNT=$this->input->get_post("PHOTO_COUNT");
					
					if($MEMBER_ID!=""){
						if($ORDER_LAT!="0" && $ORDER_LONG!="0"){
								
							$data=array(
								"member_id" => $MEMBER_ID,
								"order_service" => $ORDER_SERVICE,
								"emer_service_id" => $EMERGENCY_SERVICE,
								"order_location" => $ORDER_LOCATION,
								"order_location_detail" => $ORDER_LOCATION_DETAIL,
								"order_lat" => $ORDER_LAT,
								"order_long" => $ORDER_LONG,
								"order_photo_det" => $ORDER_PHOTO_DETAIL,
								"status" => "0",
								"created_date" => date("Y-m-d h:i:s"),
								
							);
							
							$this->db->insert("order", $data);
							$id = $this->db->insert_id();
							
							if($PHOTO_COUNT!=""){
								for($i=1;$i<=$PHOTO_COUNT;$i++){


									define('UPLOAD_DIR', './media/order/');
									$base64img = str_replace('data:image/jpeg;base64,', '', $this->input->get_post("ORDER_IMAGE" .$i));
									$data1 = base64_decode($base64img);
									$file = UPLOAD_DIR . uniqid() . '.jpg';
									file_put_contents($file, $data1);
									$xxx=explode("/",$file);
									$image= $xxx[3];
									$this->image_resize($image);
									
									/// input database Order image
									$input_item_image=array(
												"order_id"=>$id,
												"order_image_name"=> $image,
												"created_date" => date("Y-m-d h:i:s"),
												"deleted" =>  "0"
											);
									$this->db->insert("order_image",$input_item_image);
								}
							}

							$check = $this->order_model->order_list($id);
								
							$json["STATUS"]="SUCCESS";
							$json["MESSAGE"]="ORDER SUCCESS";
							$json["DATA"]=$check;
						}else{
							$json["STATUS"]="FAILED";
							$json["MESSAGE"]="PLEASE ACTIVED YOUR GPS FIRST";
							$json["DATA"]=(object) array();
						}
					}else{
						$json["STATUS"]="FAILED";
						$json["MESSAGE"]="PLEASE LOGIN FIRST";
						$json["DATA"]=(object) array();
					}
				}else{
					$json["STATUS"] = "FAILED";
                    $json["MESSAGE"] = "YOUR SESSION IS EXPIRED. PLEASE RE-LOGIN";
                    $json["DATA"] = array();
				}
			}else{
				$json["STATUS"] = "FAILED";
                $json["MESSAGE"] = "APP TOKEN INVALID";
                $json["DATA"] = array();
			}
		}else{
			$json["STATUS"] = "FAILED";
            $json["MESSAGE"] = "PLEASE INPUT APP TOKEN & USER TOKEN";
            $json["DATA"] = array();
		}
		echo json_encode($json);
	}

	function claim(){
		$headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            if(count($data_app)>0){
                $data_user = $this->member_model->check_member($headers["USER_TOKEN"],$this->input->get_post("MEMBER_ID"));
                if(count($data_user)>0){
					$MEMBER_ID=$this->input->get_post("MEMBER_ID");
					$MEMBER_POLIS_ID=$this->input->get_post("MEMBER_POLIS_ID");
					$CHRONOLOGY_ACC=$this->input->get_post("CHRONOLOGY_ACC");
					$DATE_ACC=$this->input->get_post("DATE_ACC");
					$TIME_ACC=$this->input->get_post("TIME_ACC");
					$LOCATION_ACC=$this->input->get_post("LOCATION_ACC");
					$CLAIM_STATUS=$this->input->get_post("CLAIM_STATUS");
					
					if($MEMBER_ID!=""){
								
						$data=array(
							"member_id" => $MEMBER_ID,
							"member_polis_id" => $MEMBER_POLIS_ID,
							"claim_chronology" => $CHRONOLOGY_ACC,
							"claim_date" => $DATE_ACC,
							"claim_time" => $TIME_ACC,
							"claim_location" => $LOCATION_ACC,
							"claim_status" => $CLAIM_STATUS,
							"created_date" => date("Y-m-d h:i:s"),
							
						);
						
						$this->db->insert("claim", $data);
						$id = $this->db->insert_id();

						$check = $this->order_model->claim($id);
							
						$json["STATUS"]="SUCCESS";
						$json["MESSAGE"]="CLAIM SUCCESS";
						$json["DATA"]=$check;
					}else{
						$json["STATUS"]="FAILED";
						$json["MESSAGE"]="PLEASE LOGIN FIRST";
						$json["DATA"]=(object) array();
					}
				}else{
					$json["STATUS"] = "FAILED";
                    $json["MESSAGE"] = "YOUR SESSION IS EXPIRED. PLEASE RE-LOGIN";
                    $json["DATA"] = array();
				}
			}else{
				$json["STATUS"] = "FAILED";
                $json["MESSAGE"] = "APP TOKEN INVALID";
                $json["DATA"] = array();
			}
		}else{
			$json["STATUS"] = "FAILED";
            $json["MESSAGE"] = "PLEASE INPUT APP TOKEN & USER TOKEN";
            $json["DATA"] = array();
		}
		echo json_encode($json);
	}

	function claim_photo(){
		$headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            if(count($data_app)>0){
                $data_user = $this->member_model->check_member($headers["USER_TOKEN"],$this->input->get_post("MEMBER_ID"));
                if(count($data_user)>0){
					$MEMBER_ID=$this->input->get_post("MEMBER_ID");
					$CLAIM_ID=$this->input->get_post("CLAIM_ID");
					$PHOTO_CATEGORY=$this->input->get_post("PHOTO_CATEGORY");
					$PHOTO_COUNT=$this->input->get_post("PHOTO_COUNT");
					
					if($MEMBER_ID!=""){
								
						if($PHOTO_COUNT!=""){
							for($i=1;$i<=$PHOTO_COUNT;$i++){


								define('UPLOAD_DIR', './media/claim/');
								$base64img = str_replace('data:image/jpeg;base64,', '', $this->input->get_post("CLAIM_IMAGE" .$i));
								$data1 = base64_decode($base64img);
								$file = UPLOAD_DIR . uniqid() . '.jpg';
								file_put_contents($file, $data1);
								$xxx=explode("/",$file);
								$image= $xxx[3];
								$this->image_resize($image);
								
								/// input database claim image
								$input_item_image=array(
											"claim_id"=>$CLAIM_ID,
											"claim_photo_cat"=> $PHOTO_CATEGORY,
											"claim_photo_link"=> $image,
											"created_date" => date("Y-m-d h:i:s"),
											"deleted" =>  "0"
										);
								$this->db->insert("claim_photo",$input_item_image);
							}
						}

						$check = $this->order_model->claim($CLAIM_ID);
							
						$json["STATUS"]="SUCCESS";
						$json["MESSAGE"]="PHOTO UPLOAD SUCCESS";
						$json["DATA"]=$check;
					}else{
						$json["STATUS"]="FAILED";
						$json["MESSAGE"]="PLEASE LOGIN FIRST";
						$json["DATA"]=(object) array();
					}
				}else{
					$json["STATUS"] = "FAILED";
                    $json["MESSAGE"] = "YOUR SESSION IS EXPIRED. PLEASE RE-LOGIN";
                    $json["DATA"] = array();
				}
			}else{
				$json["STATUS"] = "FAILED";
                $json["MESSAGE"] = "APP TOKEN INVALID";
                $json["DATA"] = array();
			}
		}else{
			$json["STATUS"] = "FAILED";
            $json["MESSAGE"] = "PLEASE INPUT APP TOKEN & USER TOKEN";
            $json["DATA"] = array();
		}
		echo json_encode($json);
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