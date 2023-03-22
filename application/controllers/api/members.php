<?php
	
class Members extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model("api_model/member_model");
		//$this->load->model("api_model/operator_model");
	}
	
	function get_data($data, $gcm_regid=""){
	
		$row = $data;
		
		$api["MEMBER_ID"]=$row["member_id"];
		$api["MEMBER_EMAIL"]=$row["member_email"];
		$api["MEMBER_NAME"]=$this->cek_null($row["member_name"]);
		$api["MEMBER_PHONE"]=$this->cek_null($row["member_phone"]);

		$this->db->select("*");
		$this->db->from("member_polis a");
		$this->db->where("a.deleted","0");		
		$this->db->where("a.member_id",$row["member_id"]);
		$query = $this->db->get();
		foreach($query->result_array() as $raw){
			$caw["MEMBER_POLICY_ID"]=$raw["member_polis_id"];
			$caw["POLICY_NUMBER"]=$raw["member_polis_no"];
			$caw["CHASSIS_NUMBER"]=$raw["member_polis_chassis"];
			$caw["PLATE_NUMBER"]=$this->cek_null($raw["member_polis_plate"]);
			$caw["ENGINE_NUMBER"]=$this->cek_null($raw["member_polis_engine"]);
			$all[]=$caw;
		}
		$api["MEMBER_POLICY"]=$all;
		$api["MEMBER_IMAGE"]=base_url()."media/member/".$row["member_image"];
		//$api["MEMBER_IMAGE_LOW"]=base_url()."media/member/low/".$row["member_image"];
		$api["USER_TOKEN"] = md5($row["member_email"].date("Ymd"));
		//$api["GCM_ID"] = $gcm_regid;
		/*if($gcm_regid!=""){
			$update_gcm = array("gcm_regid"=>$gcm_regid);
			$this->db->where("id", $row["member_id"]);
			$this->db->update("member", $update_gcm);
		}*/
		if($gcm_regid!=""){
			$update_gcm = array(
			                "gcm_regid"=>$gcm_regid,
			                "token"=>md5($row["member_email"].date("Ymd"))
			    );
			
		}
		else{
		    $update_gcm = array(
			               
			                "token"=>md5($row["member_email"].date("Ymd"))
			    );
		}
		$this->db->where("member_id", $row["member_id"]);
		$this->db->update("member", $update_gcm);
		
		return $api;
	}
	
	
	function login(){
			
		$email  = $this->input->get_post("MEMBER_EMAIL");
		$pass  = $this->input->get_post("MEMBER_PASSWORD");
		$gcm_regid=$this->input->get_post("GCM_REGID");

		$headers = apache_request_headers();

		if( $email!=""&&$pass!=""&&!empty($headers["APP_TOKEN"]) ){
			$data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
			if(count($data_app)>0){

				$check = $this->member_model->check_login($email,$pass);
				//print_r($check);
				if( count($check) > 0 ){
					$json["STATUS"] = "SUCCESS";
					$json["MESSAGE"] = "LOGIN SUCCESS";
					$json["DATA"] = $this->get_data($check, $gcm_regid);
					//$member_id = $json["DATA"]["MEMBER_ID"];
					//$this->insert_log($member_id, $device_os, $type_os, $device_model, $login_first);
					
				}else{
					$json["STATUS"] = "FAILED";
					$json["MESSAGE"] = "INVALID EMAIL OR PASSWORD. CONTACT CUSTOMER SERVICE FOR INFORMATION";
					$json["DATA"] = (object) array();
				}
			}else{
				$json["STATUS"] = "FAILED";
				$json["MESSAGE"] = "INVALID APP TOKEN";
				$json["DATA"] = (object) array();
			}
		}else{
			$json["STATUS"] = "FAILED";
			$json["MESSAGE"] = "PLEASE INPUT VALID DATA";
			$json["DATA"] = (object) array();
			
		}
		
		echo json_encode($json);
		
	}
	
	function register(){
		$headers = apache_request_headers();

		$name 			= $this->input->get_post("MEMBER_NAME");
		$business 		= $this->input->get_post("BUSINESS_NAME");
		$bus_type 		= $this->input->get_post("BUSINESS_TYPE");
		$bus_type_name 	= $this->input->get_post("BUSINESS_TYPE_NAME");
		$water_offer	= $this->input->get_post("WATER_OFFER");
		$price_type		= $this->input->get_post("PRICE_TYPE");
		$water_price	= $this->input->get_post("WATER_PRICE");
		$open 			= $this->input->get_post("OPEN_HOUR");
		$close  		= $this->input->get_post("CLOSE_HOUR");
		$phone 			= $this->input->get_post("PHONE_NUMBER");
		$email 			= $this->input->get_post("EMAIL");
		$web 			= $this->input->get_post("WEBSITE");
		$fb 			= $this->input->get_post("FACEBOOK");
		$ig 			= $this->input->get_post("INTAGRAM");
		$twitter 		= $this->input->get_post("TWITTER");
		$city 			= $this->input->get_post("CITY_ID");
		$country		= $this->input->get_post("COUNTRY_ID");
		$city_name		= $this->input->get_post("CITY_OR_COUNTRY_NAME");
		$image			= $this->input->get_post("STORE_IMAGE");
		$logo 			= $this->input->get_post("STORE_LOGO");
		$address 		= $this->input->get_post("ADDRESS");
		$lat 			= $this->input->get_post("STORE_LAT");
		$long 			= $this->input->get_post("STORE_LONG");
		$location		= $this->input->get_post("STORE_LOCATION");

		if(!empty($headers["APP_TOKEN"])&&$email!=""&&$policy!=""&&$chassis!=""&&$plate!=""&&$engine!=""){
			$data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            if(count($data_app)>0){
				$this->db->select("member_email");
				$this->db->from("member");
				$this->db->where("member_email","$email");
				$email_row=$this->db->get();
				$email_count=$email_row->num_rows();

				if($email_count==0){
					$this->db->select("*");
					$this->db->from("policy_number");
					$this->db->where("policy_number","$policy");
					$this->db->where("policy_chassis","$chassis");
					$vali=$this->db->get();
					$val=$vali->num_rows();
					if($val==0){
						$this->db->select("*");
						$this->db->from("policy_number");
						$this->db->where("policy_number","$policy");
						$poli=$this->db->get();
						$pol=$poli->num_rows();
						if($pol > 0){
							$this->db->select("*");
							$this->db->from("policy_number");
							$this->db->where("policy_number","$policy");
							$this->db->where("policy_chassis","$chassis");
							$chas=$this->db->get();
							$cha=$chas->num_rows();

							if($cha > 0){
								$this->db->select("*");
								$this->db->from("policy_number");
								$this->db->where("policy_number","$policy");
								$this->db->like("policy_plate","$plate");
								$plat=$this->db->get();
								$pla=$plat->num_rows();

								if($pla > 0){
									$this->db->select("*");
									$this->db->from("policy_number");
									$this->db->where("policy_number","$policy");
									$this->db->where("policy_engine","$engine");
									$engi=$this->db->get();
									$eng=$engi->num_rows();

									if($eng > 0){
										if($pass == $pass2){
											if($this->input->post("IMAGE_BASE64")!=""){
												$temp_android="";
												$base64=$this->input->post("IMAGE_BASE64");
												
												define('UPLOAD_DIR', './media/member/');
												$base64img = str_replace('data:image/jpeg;base64,', '', $base64);
												$data1 = base64_decode($base64img);
												$file = UPLOAD_DIR . uniqid() . '.jpg';
												file_put_contents($file, $data1);
												$xxx=explode("/",$file);
												$image= $xxx[3];
												$this->image_resize($image);
											}
											else{
												$image="default.png";
											}

											$input=array(
															"member_email" => $email,
															"member_password" => md5($pass),
															"created_date" => date("Y-m-d H:i:s"),
															"deleted" =>  "0",
														);
											$this->db->insert("member",$input);
											$id = $this->db->insert_id();

											$inputprof=array(
															"member_id" => $id,
															"member_name" => $this->cek_null($member_name),
															"member_phone" => $this->cek_null($phone),
															"member_image" => $image,
															"created_date" => date("Y-m-d H:i:s"),
															"deleted" =>  "0",
															
														);
											$this->db->insert("member_profile",$inputprof);

											$inputpol=array(
															"member_id" => $id,
															"member_polis_no" => $policy,
															"member_polis_name" => $this->cek_null($member_name),
															"member_polis_chassis" => $chassis,
															"member_polis_plate" => $plate,
															"member_polis_engine" => $engine,
															"member_polis_car" => $this->cek_null($car),
															"created_date" => date("Y-m-d H:i:s"),
															"deleted" =>  "0",
															
														);
											$this->db->insert("member_polis",$inputpol);
											
											$check = $this->member_model->check_login($email,$pass);
											//$this->send_key($email,$random_key,$hash);
											
											$gcm_regid  = $this->input->get_post("GCM_REGID");
											
											$data["STATUS"]="SUCCESS";
											$data["MESSAGE"]="REGISTRATION SUCCESS";
											$data["DATA"]=$this->get_data($check, $gcm_regid);
										}else{
											$data["STATUS"]="FAILED";
											$data["MESSAGE"]="YOUR CONFIRMATION PASSWORD IS NOT VALID";
											$data["DATA"]=(object) array();
										}
									}else{
										$data["STATUS"]="FAILED";
										$data["MESSAGE"]="ENGINE NUMBER NOT VALID";
										$data["DATA"]=(object) array();
									}
								}else{
									$data["STATUS"]="FAILED";
									$data["MESSAGE"]="PLATE NUMBER NOT VALID";
									$data["DATA"]=(object) array();
								}
							}else{
								$data["STATUS"]="FAILED";
								$data["MESSAGE"]="CHASSIS NUMBER NOT VALID";
								$data["DATA"]=(object) array();
							}
						}else{
							$data["STATUS"]="FAILED";
							$data["MESSAGE"]="POLICY NUMBER NOT VALID";
							$data["DATA"]=(object) array();
						}
					}else{
						$data["STATUS"]="FAILED";
						$data["MESSAGE"]="POLICY NUMBER ALREADY REGISTERED";
						$data["DATA"]=(object) array();
					}
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="EMAIL ADDRESS ALREADY REGISTERED";
					$data["DATA"]=(object) array();
				}
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="INVALID APP TOKEN";
				$data["DATA"]=(object) array();
			}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT VALID DATA";
			$data["DATA"]=(object) array();	
		}
		
		
		echo json_encode($data);
	}

	function change_pass(){

		
		$pass1=$this->input->get_post("MEMBER_PASSWORD_OLD");
		$pass2=$this->input->get_post("MEMBER_PASSWORD_NEW");
		$pass3=$this->input->get_post("MEMBER_PASSWORD_NEW2");
		
		$member_id=$this->input->get_post("MEMBER_ID");

		if(!empty($member_id) && !empty($pass1) && !empty($pass2) && !empty($pass3)){
			$sql = " select * from member where member_id = '".$member_id."' AND member_password='".md5($pass1)."' ";
			$que = $this->db->query($sql);
			$num = $que->num_rows();
		

			if($num > 0){
			
				if($pass2==$pass3){
					
					$input=array(
									"member_password" => md5($pass3),
									
								);

					$this->db->where("member_id",$member_id);
					$this->db->update("member",$input);
					
					$data["STATUS"]="SUCCESS";
					$data["MESSAGE"]="CHANGE PASSWORD SUCCESS";
					$data["DATA"]=(object) array();
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="INVALID PASSWORD CONFIRMATION";
					$data["DATA"]=(object) array();
				}
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="INVALID OLD PASSWORD";
				$data["DATA"]=(object) array();
			}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT VALID DATA";
			$data["DATA"]=(object) array();
		}
		
		echo json_encode($data);

	}

	function add_policy(){
		$headers = apache_request_headers();
        if(!empty($headers["APP_TOKEN"])&&!empty($headers["USER_TOKEN"])){
            $data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            if(count($data_app)>0){
                $data_user = $this->member_model->check_member($headers["USER_TOKEN"],$this->input->get_post("MEMBER_ID"));
                if(count($data_user)>0){
					$MEMBER_ID=$this->input->get_post("MEMBER_ID");
					$POLICY_NUMBER=$this->input->get_post("POLICY_NUMBER");
					$CHASSIS_NUMBER=$this->input->get_post("CHASSIS_NUMBER");
					$PLATE_NUMBER=$this->input->get_post("PLATE_NUMBER");
					$ENGINE_NUMBER=$this->input->get_post("ENGINE_NUMBER");
					$CAR_NAME=$this->input->get_post("CAR_NAME");
					
					if($MEMBER_ID!=""){
								
						$data=array(
							"member_id" => $MEMBER_ID,
							"member_polis_no" => $POLICY_NUMBER,
							"member_polis_chassis" => $CHASSIS_NUMBER,
							"member_polis_plate" => $PLATE_NUMBER,
							"member_polis_engine" => $ENGINE_NUMBER,
							"member_polis_car" => $CAR_NAME,
							"created_date" => date("Y-m-d h:i:s"),
							"deleted" => "0",
						);
						
						$this->db->insert("member_polis", $data);
						//$id = $this->db->insert_id();

						$check = $this->member_model->check_user($MEMBER_ID);
							
						$json["STATUS"]="SUCCESS";
						$json["MESSAGE"]="ADD POLICY SUCCESS";
						$json["DATA"]=$this->get_data($check);
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

	function reset_password(){
		$headers = apache_request_headers();

		$email = $this->input->get_post("MEMBER_EMAIL");

		if(!empty($headers["APP_TOKEN"])&&$email!=""){
			$data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            if(count($data_app)>0){
			
				$cek = $this->member_model->cek_email($email);
				
				if(count($cek) > 0){
					$now = date("Y-m-d H:i:s");
					$hash = md5($email.$now);
					
					
					$input = array (
									"reset_password_key" => $hash,
									);
									
					$this->db->where("email",$email);
					$this->db->update("member",$input);
					
					
					$msg = '
							<html>
							<head>
							</head>
							<body>
							<table style="background-color:#404040; border-collapse:collapse; border-radius: 10px;" align="center">
								<tr>
									<td>
										<center>
											<p style="padding:10px; color: #ffffff; font-family: calibri;">
												Hi there,
												<br>
												Someone recently requested to change your account"s password
												<br>
												if want to reset your password please klik link below.
											</p>
											<p>
												<table border="0" cellpadding="0" cellspacing="0" class="emailButton" style=" border-collapse:separate; border-radius:4px; border: 1px solid #f7f550;">
													<tr>
														<td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;">
															<a href="'.site_url('api/member/res_pass/'.$cek["id"].'').'" target="_blank" style="color:#FFFFFF; display:block; text-decoration:none; width:100%;">Reset password</a>
														</td>
													</tr>
												</table>
											</p>
											<p style="padding:10px; color: #ffffff; font-family: calibri;">
												Here is your New password:
												<br>
												<b>'.$cek["reset_password_key"].'<b>
												<br>
												IGNORE THIS IF YOU DID NOT RESET YOUR PASSWORD.
											</p>
										</center>
									</td>
								</tr>
							</table>
							</body>
							</html>
							';
					
					$from = "no-reply@tukangbersih.com";
					$name = "No Reply Tukangbersih";
					$to = $email;
					//$cc = "indradevelop@gmail.com";
					
					$subject = "Reset Password Tukangbersih";
					
					
					
					
					$this->load->library('email');
					
					$email_setting  = array('mailtype'=>'html');
					$this->email->initialize($email_setting);
					
					$this->email->from($from, $name);
					$this->email->to($to);
					//$this->email->cc($cc);
					$this->email->bcc('zihar.neunzig@gmail.com');

					$this->email->subject($subject);
					$this->email->message($msg);
					$this->email->send();
					
					$data["STATUS"]="SUCCESS";
					$data["MESSAGE"]="RESET PASSWORD HAS BEEN SENT TO YOUR EMAIL";
					$data["DATA"]=(object) array();
					
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="PLEASE INPUT VALID EMAIL ADDRESS";
					$data["DATA"]=(object) array();
				}
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="INVALID APP TOKEN";
				$data["DATA"]=(object) array();
			}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT VALID DATA";
			$data["DATA"]=(object) array();
		}
		
		
		echo json_encode($data);
		
	}

	function res_pass($id){
	
		if($id !=""){
			$this->db->select("*");
			$this->db->from("member");
			$this->db->where("id",$id);
			$query=$this->db->get();			
			$taw=$query->row_array();

			if($taw["reset_password_key"]!=""){
				$derer=array(
	                "password" => "1"
	            );	
	            $this->db->where("member_id",$id);
	            $this->db->update("member_profile",$derer);
				//echo "here";
				$jason["STATUS"]="SUCCESS";
				$jason["MESSAGE"]="RESET PASSWORD SUCCESS";
				$jason["DATA"]=(object) array();
				
			}else{
				$jason["STATUS"]="FAILED";
				$jason["MESSAGE"]="YOU HAVE BEEN CONFIRMED BEFORE";
				$jason["DATA"]=(object) array();
			}
		}else{
			$jason["STATUS"]="FAILED";
			$jason["MESSAGE"]="FAILED";
			$jason["DATA"]=(object) array();
		}
		echo  "<script type='text/javascript'>";
		echo "window.close();";
		echo "</script>";
		//echo json_encode($jason);
	}
	
	function login_sosmed(){
		$post=$this->input->post();
		$facebook_id = $this->input->get_post("FACEBOOK_ID");
		$twitter_id = $this->input->get_post("TWITTER_ID");
		$user  = $this->input->get_post("MEMBER_USERNAME");
		$pass  = $this->input->get_post("MEMBER_PASSWORD");
		
		
		$device_os = $this->input->get_post("DEVICE_OS");
		$type_os = $this->input->get_post("TYPE_OS");
		$device_model = $this->input->get_post("DEVICE_MOCEL");
		$login_first = "0";
		$check = $this->member_model->check_login($user,$pass);
		$gcm_regid  = $this->input->get_post("GCM_REGID");
		
		
		
		
		$this->db->select("*");
		$this->db->from("member");
		if($facebook_id!=""){
			$this->db->where("facebook_id", $facebook_id);
		}
		else{
			$this->db->where("twitter_id", $twitter_id);
		}
		$data_member= $this->db->get();
		
		if(count($data_member->result_array())>0){
			
			$data["STATUS"] = "SUCCESS";
			$data["MESSAGE"] = "LOGIN SUCCESS";
			$data["DATA"] = $this->get_data($check, $gcm_regid);
			$member_id = $data["DATA"]["MEMBER_ID"];
			
			$this->insert_log($member_id, $device_os, $type_os, $device_model, $login_first);
		}
		else{
			$input=array(
							"member_username" => $user, 
							"password" => md5($pass),
							"facebook_id" => $facebook_id,
							"twitter_id" => $twitter_id,
							"created_date" => date("Y-m-d H:i:s"),
							
							"actived" =>  "1",
							
						);
			$this->db->insert("member",$input);
	
			$id = $this->db->insert_id();
			$input2 = array(
							"member_id" => $this->cek_null($id),
							
							);
			$this->db->insert("member_profile",$input2);
			
			//
			$check = $this->member_model->check_login($user,$pass,"1");
			
			
			$data["STATUS"]="SUCCESS";
			$data["MESSAGE"]="REGISTER SUCCESS";
			$data["DATA"]=$this->get_data($check, $gcm_regid);
			$member_id = $id;
			$device_os = $this->input->get_post("DEVICE_OS");
			$type_os = $this->input->get_post("TYPE_OS");
			$device_model = $this->input->get_post("DEVICE_MOCEL");
			$login_first = "1";
			$this->insert_log($member_id, $device_os, $type_os, $device_model, $login_first);
		}
		echo json_encode($data);
	}
	
	
	function member_log(){
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
		$member_id=$this->input->get_post("MEMBER_ID");
		$type=$this->input->get_post("TYPE");
		if(empty($limit)){
			$limit = "";
		}
                if(empty($offset)){
			$offset = "";
		}
		if($member_id!=""){
			$member_log=$this->member_model->get_log($member_id,$type,$limit,$offset);
			if(count($member_log)>0){
				foreach($member_log as $row){
					$json["MEMBER_ACTIVITY_ID"] = $row["wifren_log_id"];
					$json["MEMBER_ACTIVITY"] = $row["member_activity"];
					$json["MEMBER_ACTYVITY_TYPE"] = $row["wifren_log_type"];
					if($row["wifren_log_type"]=="1"){
						
						$json["MEMBER_ACTYVITY_TYPE_DESC"] = "VOUCHER";
					}
					else if($row["wifren_log_type"]=="2"){
						$json["MEMBER_ACTYVITY_TYPE_DESC"] = "LIKE";
					}
					else{
						$json["MEMBER_ACTYVITY_TYPE_DESC"] = "SHARE";
					}
					$json["MEMBER_ACTYVITY_DATE"] = $row["created_date"];
					$all[]=$json;
				}
				
	
				$this->db->where("member_id", $row["member_id"]);
				$this->db->where("deleted", "0");
				$likes = $this->db->get("wifren_like");
				$count_likes = count($likes->result_array());
				
				$this->db->where("member_id", $row["member_id"]);
				$this->db->where("deleted", "0");
				$shareds = $this->db->get("wifren_share_log");
				$count_share = count($shareds->result_array());
				
			}
			else{
			    $all=array();
			    $count_likes = "0";
			    $count_share = "0";
			}
			$api["MEMBER_LIKE"]="$count_likes";
			$api["MEMBER_SHARE"]="$count_share";
			$api["MEMBER_POINT"]="0";
			$api["MEMBER_ACTIVITY_LIST"]=$all;
		}
		else{
			$api=array();
		}
		$data=$api;
		echo json_encode($data);
	}
	
	function send_key($email,$random_key,$hash){
		
			$msg = '
					<html>
					<head>
					</head>
					<body>
					<table style="background-color:#404040; border-collapse:collapse; border-radius: 10px;" align="center">
						<tr>
							<td>
								<center>
									<p style="padding:10px; color: #ffffff; font-family: calibri;">
										Hi there,
										<br>
										Thanks for register Please input this key to Activated your account"s or Click link on this email. 
										<br>
										<H3 style="color:red;">"'.$random_key.'"</H3>
									</p>
									<p>
										<table border="0" cellpadding="0" cellspacing="0" class="emailButton" style=" border-collapse:separate; border-radius:4px; border: 1px solid #f7f550;">
											<tr>
												<td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;">
													<a href="'.site_url('api/member/activation/'.$hash.'').'" target="_blank" style="color:#FFFFFF; display:block; text-decoration:none; width:100%;">Activation Acount</a>
												</td>
											</tr>
										</table>
									</p>
									
								</center>
							</td>
						</tr>
					</table>
					</body>
					</html>
				';
			
			$from = "no-reply@food.com";
			$name = "No Reply";
			$to = $email;
			$cc = "indradevelop@gmail.com";
			
			$subject = "Activation WIFREN acount's";
			
			
			
			
			$this->load->library('email');
			
			$email_setting  = array('mailtype'=>'html');
			$this->email->initialize($email_setting);
			
			$this->email->from($from, $name);
			$this->email->to($to);
			$this->email->cc($cc);
			//$this->email->bcc('them@their-example.com');

			$this->email->subject($subject);
			$this->email->message($msg);
			$this->email->send();
	}
	
	
	function cek_key(){
		if($this->input->post()){
			$post=$this->input->post();
			$member_id=$post["MEMBER_ID"];
			$key=$post["KEY"];
			$this->db->select("*");
			$this->db->from("member");
			$this->db->where("member_id", $member_id);
			$this->db->where("key_actived",$key);
			$query=$this->db->get();
			$data_query=$query->result_array();
			if(count($data_query)>0){
				$data_update=array(
						   "actived" => "1",
						   );
				$this->db->where("member_id", $member_id);
				$this->db->update("member", $data_update);
				
				$data["STATUS"]="SUCCESS";
				$data["MESSAGE"]="Activation Acount successful.";
				$data["DATA"]=(object) array();
				
			}
			else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="PLEASE CEK KEY ACTIVATION";
				$data["DATA"]=(object) array();
			}
		}
		else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT VALID DATA";
			$data["DATA"]=(object) array();
		}
		echo json_encode($data);
	}
	
	function activation(){
		if($this->uri->segment(4)){
			$hash = $this->uri->segment(4);
			
			$data["hasil"] = $this->member_model->cek_email_hash($hash,"1");
			//print_r($data["hasil"]);
			//echo count($data["hasil"]);
			
			if(count($data["hasil"]) > 0 ){
				$row=$data["hasil"];
				$data_update=array(
						   "actived" => "1",
						   );
				$this->db->where("member_id", $row["member_id"]);
				$this->db->update("member", $data_update);
				$data["status"]="SUCCESS";
				$data["message"]="";
				$this->load->view("activation_form",$data);
			}else{
				$data["status"]="ERROR";
				$data["message"]="INVALID TOKEN";
				$this->load->view("activation_form",$data);
			}
			
			
			
		}else{
			$data["status"]="INVALID AKSES";
			$data["message"]="ERROR 404";
			$this->load->view("activation_form",$data);
		}
	}
	/*function open_image(){
		$this->db->select("*");
		$this->db->from("log_upload");
		$query=$this->db->get();
		
		$a=$query->result_array();
		print_r($a);
		
		
	}*/
	
	function edit(){

		if( $this->input->post() OR $this->input->get() ){
		
			$member_name=$this->input->get_post("MEMBER_NAME");
			$email=$this->input->get_post("MEMBER_EMAIL");
			$phone=$this->input->get_post("MEMBER_PHONE");
			
			$member_id=$this->input->get_post("MEMBER_ID");
			
			$sql = " select * from member where member_id='".$member_id."'";
			$que = $this->db->query($sql);
			$num = $que->num_rows();
			
			if($num > 0){
			$this->db->select("member_email");
			$this->db->from("member");
			$this->db->where("member_email","$email");
			$this->db->where("member_id <>","$member_id");
			$email_row=$this->db->get();
			$email_count=$email_row->num_rows();
				if($email_count < 1){
					if($this->input->post("IMAGE_BASE64")!=""){
							
							
						$temp_android="";
						$base64=$this->input->post("IMAGE_BASE64");
						
						define('UPLOAD_DIR', './media/member/');
						$base64img = str_replace('data:image/jpeg;base64,', '', $base64);
						$data1 = base64_decode($base64img);
						$file = UPLOAD_DIR . uniqid() . '.jpg';
						file_put_contents($file, $data1);
						$xxx=explode("/",$file);
						$image= $xxx[3];
						$this->image_resize($image);
						
						$img = array("member_image" => $this->cek_null($image));
						$this->db->where("member_id",$member_id);
						$this->db->update("member_profile",$img);
					}
					
					
					$input1 = array(
						"member_email" => $email,
						
					);
					$this->db->where("member_id",$member_id);
					$this->db->update("member",$input1);

					$input2 = array(
						"member_name" => $member_name,
						"member_phone" => $phone,
						
					);
					$this->db->where("member_id",$member_id);
					$this->db->update("member_profile",$input2);
					
		            $check = $this->member_model->check_user($member_id);
		            

					$data["STATUS"]="SUCCESS";
					$data["MESSAGE"]="EDIT SUCCESS";
					$data["DATA"]=$this->get_data($check);
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="EMAIL ADDRESS ALREADY REGISTERED";
					$data["DATA"]=(object) array();
				}
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="INVALID PASSWORD";
				$data["DATA"]=(object) array();
			}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT VALID DATA";
			$data["DATA"]=(object) array();
		}
		
		echo json_encode($data);

	}
	
	function reset(){
		if($this->uri->segment(4)){
			$hash = $this->uri->segment(4);
			
			$data["hasil"] = $this->member_model->cek_email_hash($hash);
			//print_r($data["hasil"]);
			//echo count($data["hasil"]);
			
			if(count($data["hasil"]) > 0 ){
				$now=date("Y-m-d H:i:s");
			$start=$data["hasil"]["reset_date"];
			$now2=date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($start)));
				if($now2 > $now){
					$data["status"]="SUKSES";
					$data["message"]="";
					$this->load->view("reset_form",$data);
				}
				else{
					$data["status"]="ERROR";
					$data["message"]="EXPIRED SESSION";
					$this->load->view("reset_form",$data);
				}
				
			}else{
				$data["status"]="ERROR";
				$data["message"]="INVALID TOKEN";
				$this->load->view("reset_form",$data);
			}
			
			
			
		}else{
			$data["status"]="INVALID AKSES";
			$data["message"]="ERROR 404";
			$this->load->view("reset_form",$data);
		}
	}
	
	function reset_(){
		$email = $this->input->post("email");
		$new_pass1 = $this->input->post("new_pass1");
		$new_pass2 = $this->input->post("new_pass2");
		$hash = $this->uri->segment(4);
		$data["hasil"] = $this->member_model->cek_email_hash($hash);
		if($new_pass1==$new_pass2){
			$cek = $this->member_model->cek_email($email);
			$input = array(
							"password" => md5($new_pass1)
							);
							
			$this->db->where("member_id",$cek["member_id"]);
			
			if( $this->db->update("member",$input) ){
				
				$input = array (
								"reset_hash" => "",
								"reset_date" => "0000-00-00",
								);
								
				$this->db->where("member_id",$cek["member_id"]);
				$this->db->update("member",$input);
				
				$data["status"]="ERROR";
				$data["message"]="You have successfully changed your password";
				$this->load->view("reset_form",$data);
			}else{
				$data["status"]="ERROR";
				$data["message"]="FAILED CHANGE PASSWORD";
				$this->load->view("reset_form",$data);
			}
		}
		else{
			$data["status"]="SUKSES";
			$data["message"]="PASSWORD NOT SAME";
			$this->load->view("reset_form",$data);
		}
		
	}
	
	
	
	
	function image_resize($image){

		$config2['image_library'] = 'gd2';
		$config2['source_image'] = './media/member/'.$image.'';
		$config2['new_image'] = './media/member/low/'.$image.'';
		$config2['create_thumb'] = FALSE;
		$config2['maintain_ratio'] = TRUE;
		$config2['width'] = 400;
		//$config2['height'] = 400;

		$this->load->library('image_lib', $config2);
		$this->image_lib->initialize($config2);

		$this->image_lib->resize();

	}
	
	function cek_gender(){
		if( empty($var) ){
			return "M";
		}else{
			return $var;
		}
	}
	
	
	function cek_null($var){
	
		if( empty($var) ){
			return "";
		}else{
			return $var;
		}
		
	}
	
	function cek_date($var){
		if( empty($var) ){
			return "1994-12-12";
		}else if( $var == "0000-00-00"){
			return "1994-12-12";
		}else{
			return $var;
		}
	}
	
	function skip_login(){
	
		$api["MEMBER_ID"]="0";
		$api["MEMBER_USERNAME"]="Guest";
		$api["MEMBER_NAME"]="Guest";
		$api["MEMBER_DOB"]=date("Y-m-d");
		$api["MEMBER_GENDER"]="M";
		$api["MEMBER_PHONE"]="021-XXXXXXX";
		$api["MEMBER_ADDRESS"]="No Address";
		$api["MEMBER_IMAGE"]=base_url()."media/member/default.jpg";
		$api["MEMBER_IMAGE_LOW"]=base_url()."media/member/low/default.jpg";
		$api["MEMBER_EMAIL"]="guest@email.com";
	
	
		$json["STATUS"] = "SUCCESS";
		$json["MESSAGE"] = "SKIP LOGIN SUCCESS";
		$json["DATA"] = $api;
		
		
		echo json_encode($json);
	}
	
}
