<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member_log extends CI_Controller{
	
function __construct(){
	parent::__construct();
	header('Content-Type: application/json');
	// $this->load->model('global_model');
	$this->load->model("api_model/member_model");
	$this->load->library('get_api');
	}

	function get_data($data){
	
		$row = $data;
		
		$api["MEMBER_ID"]=$row["member_id"];
		$api["MEMBER_EMAIL"]=$row["member_email"];
		$api["MEMBER_FIRST_NAME"]=$row["first_name"];
		$api["MEMBER_LAST_NAME"]=$row["last_name"];
      	$api["DATE_OF_BIRTH"]=$row["member_date_of_birth"];
		$this->db->select("*");
		$this->db->from("member a");
		$this->db->join("member_profile b","a.member_id = b.member_id","left");
		$this->db->join("country c","b.country_id = c.country_id","left");
		$this->db->join("city d","b.city_id = d.city_id","left");
		// $this->db->join("area e","b.area_id = e.area_id","left");
		$this->db->where("a.deleted","0");		
		$this->db->where("a.member_id",$row["member_id"]);
		
		$query = $this->db->get();
		$all = array();
		foreach($query->result_array() as $raw){
			// $caw["MEMBER_ID"]=$raw["member_id"];
			// $caw["MEMBER_FULL_NAME"]=$raw["member_full_name"];
		
			$caw["COUNTRY"]=$raw["country_id"];
			$caw["CITY"]=$raw["city_id"];
			//$caw["AREA"]=$raw["area_id"];
			// $caw["MEMBER_STREET"]=$raw["member_street"];
			
			$all=$caw;
		}

		$api["MEMBER_DETAIL"]= $all;
		$api["MEMBER_IMAGE"]=base_url()."media/member/".$row["member_image"];
		$email = $row["member_email"];
		$password = $row["member_password"];
		$spar_token = hash("sha256", $password.$email.date("Ymd"));
							$input = array(
								"token" => $spar_token
								);
							$this->db->where("member_email",$email);
							$this->db->update("member",$input);
		$api["TOKEN"] = hash("sha256", $password.$email.date("Ymd"));;

		return $api;
	}

	function get_data2($data){
		
		$row = $data;

		$api["MEMBER_ID"]=$row["member_id"];
		$api["MEMBER_EMAIL"]=$row["member_email"];
		$api["MEMBER_FIRST_NAME"]=$row["first_name"];
		$api["MEMBER_LAST_NAME"]=$row["last_name"];
        $api["DATE_OF_BIRTH"]=$row["member_date_of_birth"];
        $api["MEMBER_BOTTLE_POINT"]=$row["member_bottle_point"];
        $api["MEMBER_POINT"]=$row["member_point"];
        $api["MEMBER_PROGRESS"]=$row["member_progress"];
        $api["BOTTLE_SIZE_ID"]=$row["bottle_size_id"];

		$this->db->select("*");
		$this->db->from("member a");
		$this->db->join("member_profile b","a.member_id = b.member_id","left");
	 	$this->db->join("country c","b.country_id = c.country_id","left");
		// $this->db->join("city d","b.city_id = d.city_id","left");
		// $this->db->join("area e","b.area_id = e.area_id","left");
		$this->db->join("bottle_size f","b.bottle_size_id = f.bottle_size_id","left");
		$this->db->where("a.deleted","0");		
		$this->db->where("a.member_id",$row["member_id"]);
			
			$query = $this->db->get();
			$all = array();

				foreach($query->result_array() as $raw){
				      
						$caw["BOTTLE_CAPACITY"]=$raw['value'];
						$caw["ID_COUNTRY"]=$raw["country_id"];
						// $caw["ID_CITY"]=$raw["city_id"];
						// $caw["ID_AREA"]=$raw["area_id"];
						$caw["COUNTRY"]=$raw["country_name"];
						// $caw["CITY"]=$raw["city_name"];
						// $caw["AREA"]=$raw["area_name"];
						// $caw["STREET"]=$raw["member_street"];


						$all=$caw;
					
					
				}

			$api["MEMBER_DETAIL"]= $all;
			$api["MEMBER_IMAGE"]=base_url()."media/member/".$row["member_image"];
			if($row["member_image"]==""){
				$api["MEMBER_IMAGE"]=base_url()."media/member/default_refill.jpeg";
			}
			$email = $row["member_email"];
			$password = $row["member_password"];
			$spar_token = hash("sha256", $password.$email.date("Ymd"));
								$input = array(
									"token" => $spar_token
									);
								$this->db->where("member_email",$email);
								$this->db->update("member",$input);
			$api["TOKEN"] = hash("sha256", $password.$email.date("Ymd"));
		
			return $api;
		}

function get_profile(){
	$id = $this->input->get_post("MEMBER_ID");

		$headers = apache_request_headers();
        if(!empty($headers['APP_TOKEN'])){
            $data = $this->member_model->check_user($id);
            

           
                    $json['STATUS'] = 'SUCCESS';
                    $json['MESSAGE'] = 'GET PROFILE';
                    $json['DATA'] = $this->get_data2($data);
      
                
            }else{
                $json['STATUS'] = 'FAILED';
                $json['MESSAGE'] = 'INVALID APP_TOKEN';
                $json['DATA'] = (object) array();
            }
        echo json_encode($json);
    }


			

	function register(){
		$headers
		 = apache_request_headers();


		// Mandatory Field
		$email = $this->input->get_post("EMAIL");
		$pass  = $this->input->get_post("PASSWORD");
		$confirm_password = $this->input->get_post("CONFIRM_PASSWORD");
		// $first = $this->input->get_post("FIRST_NAME");
		// $last = $this->input->get_post("LAST_NAME");
		$dob  = $this->input->get_post("DATE_OF_BIRTH");
		$country  = $this->input->get_post("COUNTRY");
		$street  = $this->input->get_post("STREET");
		$isi = $this->input->get_post("BOTTLE_SIZE_ID");

		// Non Mandatory Field
		$city = $this->input->get_post("CITY");
		$area  = $this->input->get_post("AREA");
		$image  = $this->input->get_post("MEMBER_PHOTO");
		// print_r($email2);die();

		if(!empty($headers["APP_TOKEN"])){
			$data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            if(count($data_app)>0){
            	if ($email != "") {
            		$this->db->select("member_email");
					$this->db->from("member");
					$this->db->where("member_email", $email);
					$email_row = $this->db->get();
					$email_count = $email_row->num_rows();
					if($email_count == 0){
						if(!empty($pass)){
							 if($pass==$confirm_password){
							if($this->input->post("MEMBER_PHOTO")!=""){
								$temp_android="";
								$base64=$this->input->post("MEMBER_PHOTO");
								$base64Exploded = explode(',', $base64);
								define('UPLOAD_DIR', './media/member/');
								$base64img = str_replace($base64Exploded[0].',', '', $base64);
								$data1 = base64_decode($base64img);
								$file = UPLOAD_DIR . uniqid() . '.jpg';
								file_put_contents($file, $data1);
								$xxx=explode("/",$file);
								$image= $xxx[3];
							}else{
								$image = "default_refill.jpeg";
							}
						
							$random_key = mt_rand(1000, 99999);
							$hash = md5($random_key);
							$salt = "Gre@t$#132";
							$input=array(
								
								"member_email" => $email,
								"token" =>"sgdasyg",
								"member_password" => md5($pass),
								"key_activated" => $hash,
								"created_date" => date("Y-m-d H:i:s"),
								"deleted"=>"0",
								"status"=>"1"

							);
							$this->db->insert("member",$input);
							$id = $this->db->insert_id();
							
							$inputprof=array(
								"member_id" => $id,
								// "first_name"  => $first,
								// "last_name"  => $last,
								"member_email"  => $email,
								"member_date_of_birth"=>date($dob),
								"member_password" => md5($pass),
								"country_id"=>$country,
								"city_id"=>$city,
								"area_id"=>$area,
								"member_street"=>$street,
								"bottle_size_id"=>$isi,
								"member_image" => $this->cek_null($image),
								"created_date" => date("Y-m-d H:i:s"),
								"deleted" =>  "0",

								
							);
							$this->db->insert("member_profile",$inputprof);
							
							$check = $this->member_model->check_login($email,$pass);
							//$this->send_key($email,$hash);
							// print_r($check);die();
							$data["STATUS"]="SUCCESS";
							$data["MESSAGE"]="REGISTRATION SUCCESS";
							//$data["MESSAGE_up"]="one more step to do, complete your personal information on profile menu";
							
							$data["DATA"]= $this->get_data2($check);
						}else{
						$data["STATUS"]="FAILED";
						$data["MESSAGE"]="PASSWORD NOT SAME WITH CONFIRM PASSWORD";
						$data["DATA"]=(object) array();
						}
						}else{
							$data["STATUS"]="FAILED";
							$data["MESSAGE"]="PASSWORD REQUIRED";
							$data["DATA"]=(object)array();
						}				
					}else{
						$data["STATUS"]="FAILED";
						$data["MESSAGE"]="EMAIL ADDRESS ALREADY REGISTERED";
						$data["DATA"]=(object) array();
					}
            	}else{
            		$data["STATUS"]="FAILED";
					$data["MESSAGE"]="PLEASE COMPLETE DATA";
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

	function login(){
 			$email = $this->input->post("MEMBER_EMAIL");
            $password = $this->input->post("MEMBER_PASSWORD");

            $headers = apache_request_headers();
            if($email!="" && $password!="" && !empty($headers["APP_TOKEN"])){
            	$data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            	if(count($data_app)>0){
            			$check = $this->member_model->check_login($email, $password);
            			if(count($check)>0){
	            			 if($check["status"]=='1'){
	            			 	$json["STATUS"] = "SUCCESS";
		            			$json["MESSAGE"] = "LOGIN SUCCESS";
		            			$json["DATA"] = $this->get_data2($check);
		            		}  else{

                           $json["STATUS"] = "FAILED";
		            			$json["MESSAGE"] = "ACCOUNT WAS UNACTIVATED, CHECK YOUR EMAIL FOR ACTIVATION OR CHECK SPAM IN YOUR EMAIL, IF YOU STILL NOT FOUND ACTIVATION, PLEASE CONTACT ADMIN FOR HELP";
		            			$json["DATA"] = (object)array();
		            		} 		            		
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
	
	function cek_null($var){
	
		if( empty($var) ){
			return "";
		}else{
			return $var;
		}
	}


	function send_key($email,$hash){

		$url = site_url('api/member_log/cek_key?code='.$hash.'&email='.$email);
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
										Thanks for register Please Click link on this email to Activated your account"s. 
										<br>
									</p>
									<p>
										<table border="0" cellpadding="0" cellspacing="0" class="emailButton" style=" border-collapse:separate; border-radius:4px; border: 1px solid #f7f550;">
											<tr>
												<td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;">
													<a href="'.$url.'" target="_blank" style="color:#FFFFFF; display:block; text-decoration:none; width:100%;">Activation Acount</a>
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
			
			$from = "admin-refillmybottle@RefillMyBottle.com";
			$name = "admin-refillmybottle";
			$to = $email;
			
			
			$subject = "Activation RefillMyBottle acount's";
			
			
			
			
			$this->load->library('email');
			$config = array();
		    $config['charset'] = 'utf-8';
		    $config['useragent'] = 'Codeigniter';
		    $config['protocol']= "smtp";
		    $config['mailtype']= "html";
		    $config['smtp_host']= "mail.smtp2go.com";
		    $config['smtp_port']= "2525";
		    $config['smtp_timeout']= "400";
		    $config['smtp_user']= "lope";
		    $config['smtp_pass']= "ZWVhaWQxZnl5dnQw";
		    $config['crlf']="\r\n"; 
		    $config['newline']="\r\n"; 
		    $config['wordwrap'] = TRUE;

			$this->email->initialize($config);			
			$this->email->from($from, $name);
			$this->email->to($to);
			
			

			$this->email->subject($subject);
			$this->email->message($msg);
			$this->email->send();
	}	
	
	function cek_key(){
			
		header('Content-Type: HTML');

			$email=$_GET["email"];
			$key=$_GET["code"];
			$this->db->select("*");
			$this->db->from("member");
			$this->db->where("member_email", $email);
			$this->db->where("key_activated",$key);
			$query=$this->db->get();
			$data_query=$query->result_array();

			if(count($data_query)>0){
				$data_update=array(
						   "status" => "1",
						   );
				$this->db->where("member_email", $email);
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
		
		echo  "<script type='text/javascript'>";
		echo "window.close();";
		echo "</script>";
			
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
						   "status" => "1",
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

	function change_password(){

		$headers = apache_request_headers();
		if(!empty($headers['APP_TOKEN']) && !empty($headers['USER_TOKEN'])){
			$data_app = $this->member_model->check_app($headers['APP_TOKEN']);
			if(count($data_app) > 0){
				$data_user = $this->member_model->check_member($headers['USER_TOKEN'],$this->input->get_post('MEMBER_ID'));
				if(count($data_user) > 0){
					$pass1=$this->input->get_post("MEMBER_PASSWORD_OLD");
					$pass2=$this->input->get_post("MEMBER_PASSWORD_NEW");
					$pass3=$this->input->get_post("MEMBER_PASSWORD_NEW2");
					
					$member_id=$this->input->get_post("MEMBER_ID");

					if(!empty($pass1)){
						if(!empty($pass2)){
							if(!empty($pass3)){
								if(!empty($member_id)){
									$sql = " select * from member where member_id = '".$member_id."' AND member_password='".md5($pass1)."' ";
									$que = $this->db->query($sql);
									$num = $que->num_rows();

									if($num > 0){
										if($pass2 == $pass3 ){
											if($pass1!=$pass3){
											$input=array(
												"member_password" => md5($pass3),
											);

											$this->db->where("member_id",$member_id);
											$update = $this->db->update("member",$input);
											$input2=array(
												"member_password" => md5($pass3),
											);

											$this->db->where("member_id",$member_id);
											$update = $this->db->update("member_profile",$input2);
											if($update){
												$data["STATUS"]="SUCCESS";
												$data["MESSAGE"]="CHANGE PASSWORD SUCCESS";
												$data["DATA"]=array();		
											}else{
												$data["STATUS"]="FAILED";
												$data["MESSAGE"]="An Error Accoured When Updating Data";
												$data["DATA"]=array();
											}
										}else{
											$data["STATUS"]="FAILED";
												$data["MESSAGE"]="PASSWORD SAME WITH OLD PASSWORD";
												$data["DATA"]=array();
										}
										}else{
											$data["STATUS"]="FAILED";
											$data["MESSAGE"]="NEW PASSWORD AND PASSWORD CONFIRMATION NOT PAIR";
											$data["DATA"]=array();
										}
									}else{
										$data["STATUS"]="FAILED";
										$data["MESSAGE"]="INVALID OLD PASSWORD";
										$data["DATA"]=array();
									}
								}else{
									$data["STATUS"]="FAILED";
									$data["MESSAGE"]="MEMBER_ID REQUIRED";
									$data["DATA"]=array();
								}
							}else{
								$data["STATUS"]="FAILED";
								$data["MESSAGE"]="MEMBER_PASSWORD_NEW2 REQUIRED";
								$data["DATA"]=array();
							}
						}else{
							$data["STATUS"]="FAILED";
							$data["MESSAGE"]="MEMBER_PASSWORD_NEW REQUIRED";
							$data["DATA"]=array();
						}
					}else{
						$data["STATUS"]="FAILED";
						$data["MESSAGE"]="MEMBER_PASSWORD_OLD REQUIRED";
						$data["DATA"]=array();
					}
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="INVALID USER TOKEN PLEASE RE-LOGIN";
					$data["DATA"]=array();
				}
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="INVALID APP_TOKEN";
				$data["DATA"]=array();
			}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="APP_TOKEN AND USER TOKEN REQUIRED";
			$data["DATA"]=array();
		}		
		echo json_encode($data);
	}







function change_email(){

		$headers = apache_request_headers();
			if(!empty($headers['APP_TOKEN']) && !empty($headers['USER_TOKEN'])){
			$data_app = $this->member_model->check_app($headers['APP_TOKEN']);
			if(count($data_app) > 0){
				$data_user = $this->member_model->check_member($headers['USER_TOKEN'],$this->input->get_post('MEMBER_ID'));
				if(count($data_user) > 0){
					$mail1=$this->input->get_post("MEMBER_EMAIL_CURRENT");
					$mail2=$this->input->get_post("MEMBER_EMAIL_NEW");
					$mail3=$this->input->get_post("MEMBER_EMAIL_NEW2");
					$pass=$this->input->get_post("MEMBER_PASSWORD");
					
					$member_id=$this->input->get_post("MEMBER_ID");

					if(!empty($mail1)){
						if(!empty($mail2)){
							if(!empty($mail3)){
								if(!empty($member_id)){
									$sql = " select * from member where member_id = '".$member_id."' AND member_email='".$mail1."' ";
									$que = $this->db->query($sql);
									$num = $que->num_rows();

									if($num > 0){

									$sql2 = " select * from member where member_id = '".$member_id."' AND member_email='".$mail1."' AND member_password ='".md5($pass)."' ";
									$que2 = $this->db->query($sql2);
									$num2 = $que2->num_rows();
                                       if($num2>0){
										if($mail2 == $mail3 ){
									$sql5 = " select * from member where  member_email='".$mail2."' ";
									$que5 = $this->db->query($sql5);
									$num5 = $que5->num_rows();
											 if(!$num5>0){

											$input=array(
												"member_email" => $mail3,
											);

											$this->db->where("member_id",$member_id);
											$update = $this->db->update("member",$input);
											$input2=array(
												"member_email" => $mail3,
											);

											$this->db->where("member_id",$member_id);
											$update = $this->db->update("member_profile",$input2);
											if($update){
												$data["STATUS"]="SUCCESS";
												$data["MESSAGE"]="CHANGE EMAIL SUCCESS";
												$data["DATA"]=array();		
											}else{
												$data["STATUS"]="FAILED";
												$data["MESSAGE"]="An Error Accoured When Updating Data";
												$data["DATA"]=array();
											}
										}else{
											$data["STATUS"]="FAILED";
											$data["MESSAGE"]="EMAIL HAS TAKEN";
											$data["DATA"]=array();

									}
										}else{
											$data["STATUS"]="FAILED";
											$data["MESSAGE"]="NEW EMAIL AND EMAIL CONFIRMATION NOT PAIR";
											$data["DATA"]=array();
										}
									}else{
										$data["STATUS"]="FAILED";
										$data["MESSAGE"]="INVALID PASSWORD INPUT";
										$data["DATA"]=array();
										}
									}else{
										$data["STATUS"]="FAILED";
										$data["MESSAGE"]="INVALID CURRENT EMAIL";
										$data["DATA"]=array();
									}
								}else{
									$data["STATUS"]="FAILED";
									$data["MESSAGE"]="MEMBER_ID REQUIRED";
									$data["DATA"]=array();
								}
							}else{
								$data["STATUS"]="FAILED";
								$data["MESSAGE"]="MEMBER_EMAIL_NEW2 REQUIRED";
								$data["DATA"]=array();
							}
						}else{
							$data["STATUS"]="FAILED";
							$data["MESSAGE"]="MEMBER_EMAIL_NEW REQUIRED";
							$data["DATA"]=array();
						}
					}else{
						$data["STATUS"]="FAILED";
						$data["MESSAGE"]="MEMBER_EMAIL_CURRENT REQUIRED";
						$data["DATA"]=array();
					}
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="INVALID USER TOKEN PLEASE RE-LOGIN";
					$data["DATA"]=array();
				}
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="INVALID APP_TOKEN";
				$data["DATA"]=array();
			}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="APP_TOKEN AND USER TOKEN REQUIRED";
			$data["DATA"]=array();
		}		
		echo json_encode($data);
	}






function edit_profile(){

$headers = apache_request_headers();
	

		if(!empty($headers['APP_TOKEN']) && !empty($headers['USER_TOKEN'])){
			$data_app = $this->member_model->check_app($headers['APP_TOKEN']);
			if(count($data_app) > 0){
				$data_user = $this->member_model->check_member($headers['USER_TOKEN'],$this->input->get_post('MEMBER_ID'));
				if(count($data_user) > 0){

		if( $this->input->post() OR $this->input->get() ){

		
			$first_name=$this->input->get_post("FIRST_NAME");
			$last_name=$this->input->get_post("LAST_NAME");
			// $street=$this->input->get_post("MEMBER_STREET");
			$country_id=$this->input->get_post("COUNTRY_ID");
			$city_id=$this->input->get_post("CITY_ID");
			// $area_id=$this->input->get_post("AREA_ID");

			// $dof=$this->input->get_post("MEMBER_DATE_OF_BIRTH");
			$isi = $this->input->get_post("BOTTLE_SIZE_ID");
			$member_id=$this->input->get_post("MEMBER_ID");
			
			$sql = " select * from member where member_id='".$member_id."'";
			$que = $this->db->query($sql);
			$num = $que->num_rows();
			
		if($num > 0){
			// $this->db->select("member_email");
			// $this->db->from("member");
			// $this->db->where("member_email",$email);
			// $this->db->where("member_id <>",$member_id);
			// $email_row=$this->db->get();
			// $email_count=$email_row->num_rows();
			
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
					
					$input2 = array(
						"first_name" => $first_name,
						"last_name" => $last_name,
						// "member_street" => $street,
						"country_id" => $country_id,
						"city_id" => $city_id,
						// "area_id" => $area_id,
						// "member_date_of_birth" => $dof,
						"bottle_size_id"=>$isi,
						
					);
					$this->db->where("member_id",$member_id);
					$this->db->update("member_profile",$input2);
					
		            $check = $this->member_model->check_user($member_id);
		            

					$data["STATUS"]="SUCCESS";
					$data["MESSAGE"]="EDIT SUCCESS";
					$data["DATA"]=$this->get_data2($check);
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
			}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="INVALID USER TOKEN PLEASE RE-LOGIN";
					$data["DATA"]=(object)array();
				}
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="INVALID APP_TOKEN";
				$data["DATA"]=(object)array();
			}
			}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="APP_TOKEN AND USER TOKEN REQUIRED";
			$data["DATA"]=(object)array();
		}	
		
		
		echo json_encode($data);

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
					$tes = md5($email.$now);
					$hash = substr($tes,0,7);
					// $new_pass = mt_rand(1000, 999999);					
					 
					$input = array(
								"reset_password_key" =>$hash,
								// "reset_key"	=> md5($new_pass)
								"reset_date" => date("Y-m-d H:m:s")
								);
									
					$this->db->where("member_email",$email);
					$this->db->update("member",$input);
					
					
					$msg = '
							<html>
							<head>
							</head>
							<body>
							<table style="border-collapse:collapse; border-radius: 10px;" align="center">
								<tr>
									<td>
										
											<p style="padding:10px; color: #738a8e; font-family: calibri;">
												Dear '.$cek["first_name"].',
												<br>
												<br/>
												We`ve received a request to reset your password. 
												<br>
												if you didn`t make the request, just ignore this message.Otherwise, you can reset your password using this link :
											</p>
											<p>
											<center>
												<table border="0" cellpadding="0" cellspacing="0" class="emailButton" style=" border-collapse:separate; border-radius:4px; border: 1px solid #0095c2; background-color: #0095c2;">
													<tr>
														<td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica; font-size:18px; font-weight:bold; line-height:100%; padding:15px; text-align:center;">
															<a href="'.site_url('/api/changePassword?id='.$cek["member_id"].'&hash='.$hash.'').'" target="_blank" style="color:#FFFFFF; display:block; text-decoration:none; width:100%;">Click Here to reset your password</a>
														</td>
													</tr>
												</table>
												</center>
											</p>
											<p style="padding:10px; color: #738a8e; font-family: calibri;">
												Thank you,
												<br/>
												RefillMyBottle team
											</p>
										
									</td>
								</tr>
							</table>
							</body>
							</html>
							';
					
					$from = "Admin@RefillMyBottle.com";
					$name = "RefillMyBottle";
					$to = $email;
					
					
					$subject = "Reset your password";					
					
					
					// $config = array();
				 //    $config['charset'] = 'utf-8';
				 //    $config['useragent'] = 'Codeigniter';
				 //    $config['protocol']= "smtp";
				 //    $config['mailtype']= "html";
				 //    $config['smtp_host']= "ssl://smtp.gmail.com";
				 //    $config['smtp_port']= "465";
				 //    $config['smtp_timeout']= "400";
				 //    $config['smtp_user']= "seagleax700@gmail.com"; //this for senen
				 //    $config['smtp_pass']= "Windows8";
				 //    $config['crlf']="\r\n"; 
				 //    // $config['newline']="\r\n";
				 //    $config['wordwrap'] = TRUE;
					// $this->load->library('email', $config);
					// $this->email->set_newline("\r\n");

					$this->load->library('email');
					$config = array();
				    $config['charset'] = 'utf-8';
				    $config['useragent'] = 'Codeigniter';
				    $config['protocol']= "smtp";
				    $config['mailtype']= "html";
				    $config['smtp_host']= "mail.smtp2go.com"; //this for done jum'at
				    $config['smtp_port']= "2525";
				    $config['smtp_timeout']= "400";
				    $config['smtp_user']= "pratama@codelabs.co.id";
				    $config['smtp_pass']= "Windows8";
				    $config['crlf']="\r\n"; 
				    $config['newline']="\r\n"; 
				    $config['wordwrap'] = TRUE;

					// $config = array(
					//      'protocol' => 'smtp',
					//      'smtp_host' => 'svr30.internet-webhosting.com',
					//      'smtp_port' => '25',
					//      'smtp_user' => 'development@codelabs.co.id',
					//      'smtp_pass' => 'Pdevelopment312',
					//      'mailtype' => 'html',
					//      'charset' => 'iso-8859-1',
					//      'wordwrap' => TRUE
					// );



					$this->email->initialize($config);			
					$this->email->from($from, $name);
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($msg);
					$this->email->send();
					// echo $this->email->print_debugger(); die();
					
						// $subject = "RefillMyBottle Reset Password";
					 //    $data2["Layout"] ="admin/member/password";
					 //    $data2["Subject"] = $subject;
					 //    $data2['email'] = $email;
					 //    $data2['password'] = $new_pass;
					 //    $data2['url'] = site_url('/api/member_log/res_pass?id='.$cek["member_id"].'&newpass='.$new_pass.'');
						// $sendMail = $this->sendEmail($email,'admin@RefillMyBottle.com','admin-refillmybottle','',$subject,'',$data2);


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

	function login_sosmed(){

		$post=$this->input->post();

		$facebook_id = $this->input->get_post("FACEBOOK_ID");
		$first_name=$this->input->get_post("FIRST_NAME");
		$google_id = $this->input->get_post("GOOGLE_ID");
		$last_name=$this->input->get_post("LAST_NAME");
		$email=$this->input->get_post("MEMBER_EMAIL");
		$isi = $this->input->get_post("BOTTLE_SIZE_ID");
		$pass  = $this->input->get_post("PASSWORD");
		$confirm_password = $this->input->get_post("CONFIRM_PASSWORD");
		$dob  = $this->input->get_post("DATE_OF_BIRTH");
		$gcm_regid  = $this->input->get_post("GCM_REGID");
		$image  = $this->input->get_post("MEMBER_PHOTO");
		
		// $device_os = $this->input->get_post("DEVICE_OS");
		// $type_os = $this->input->get_post("TYPE_OS");
		// $device_model = $this->input->get_post("DEVICE_MOCEL");
		// $login_first = "0";
		// $check = $this->member_model->check_login($user,$pass);
		
		$this->db->select("*");
		$this->db->from("member a");
		$this->db->join('member_profile b', 'a.member_id = b.member_id', 'left');
		// $this->db->where("a.member_email", $email);
		if($facebook_id!=""){
			$this->db->where("a.facebook_id", $facebook_id);

        }elseif ($google_id!="") {
        	$this->db->where("a.google_id", $google_id);
        }else{
		}

		$data_member= $this->db->get()->row_array();
		
		if(count($data_member) > 0){
                 if($facebook_id!="" || $google_id!=""){  
            		$this->db->select("facebook_id");
					$this->db->from("member");
					$this->db->where("facebook_id", $facebook_id);
					// $this->db->where("email", $email);
					$fb_row = $this->db->get();
					$fb_count = $fb_row->num_rows();
		if($fb_count == 0){

			$this->member_model->set_fb($facebook_id,$email);
		
		}

		$this->db->select("google_id");
					$this->db->from("member");
					$this->db->where("google_id", $google_id);
					// $this->db->where("email", $email);
					$g_row = $this->db->get();
					$g_count = $g_row->num_rows();
		if($g_count == 0){

			$this->member_model->set_google($google_id,$email);
		
		}

		if($pass!=$confirm_password){
			$json["STATUS"] = "FAILED";
			$json["MESSAGE"] = "PASSWORD WITH CONFIRM PASSWORD IS NOT MATCH";
			$json["DATA"] = (object) array();
			}else{
			$json["STATUS"] = "SUCCESS";
			$json["MESSAGE"] = "LOGIN SUCCESS";
			$json["DATA"] = $this->get_data2($data_member, $gcm_regid);
			$member_id = $json["DATA"]["MEMBER_ID"];
			}

			}else{
			$json["STATUS"] = "FAILED";
			$json["MESSAGE"] = "INPUT FACEBOOK ID OR GOOGLE ID";
			$json["DATA"] = (object) array();
	}
			// $this->insert_log($member_id, $device_os, $type_os, $device_model, $login_first);
		}
	

				else{
						$check_mail = $this->member_model->check_email($email);
                       if(count($check_mail) > 0){

					$input1 = array(
						
						"facebook_id" => $this->cek_null($facebook_id),
						"google_id" => $this->cek_null($google_id),
					);
					$this->db->where("member_email",$email);
					$this->db->update("member",$input1);
						
						$json["STATUS"]="SUCCESS";
						$json["MESSAGE"]="EMAIL ALREADY REGISTERED, UPDATE YOUR DATA SOCIAL MEDIA ";
						$json["DATA"]=$this->get_data2($check_mail, $gcm_regid);

                       }
                       else{

                       		// if($pass!=""){
                       		// 	if($confirm_password!=""){
                       		// 		if($pass==$confirm_password){
                       					// if($isi!=""){
        			
		
								if($this->input->post("MEMBER_PHOTO")!=""){
								$temp_android="";
								$base64=$this->input->post("MEMBER_PHOTO");
								$base64Exploded = explode(',', $base64);
								define('UPLOAD_DIR', './media/member/');
								$base64img = str_replace($base64Exploded[0].',', '', $base64);
								$data1 = base64_decode($base64img);
								$file = UPLOAD_DIR . uniqid() . '.jpg';
								file_put_contents($file, $data1);
								$xxx=explode("/",$file);
								$image= $xxx[3];
								}else{
								$image = "default_refill.jpeg";
							}

						$now = date("Y-m-d H:i:s");
						$tes = md5($email.$now);
						$hash = substr($tes,0,7);
						$input=array(
						"member_email" => $email, 
						"member_password" => md5($pass),
						"facebook_id" => $this->cek_null($facebook_id),
						"google_id" => $this->cek_null($google_id),
						"created_date" => date("Y-m-d H:i:s"),
				
						"status" =>  "1",		
						);
						$this->db->insert("member",$input);
	
						$id = $this->db->insert_id();
						$input2 = array(
							"member_id" => $this->cek_null($id),
							"first_name" =>$first_name,
						 	"last_name" => $last_name,
						    "member_date_of_birth" =>date($dob),
						 	"member_email" => $email, 
							"member_password" => md5($pass),
							"bottle_size_id"=>$isi,
							"member_image" => $this->cek_null($image),
							
							);
						$this->db->insert("member_profile",$input2);
			
		
						$check = $this->member_model->check_login($email,$pass,"1");
						
						// $subject = "RefillMyBottle Login Social Media";
					 //    $data["Layout"] ="admin/member/social";
					 //    $data["Subject"] = $subject;
					 //    $data['data'] = $input;
					 //    $data['hash'] = $hash;
					 //    $data['url'] = site_url('api/member_log/cek_key?code='.$hash.'&email='.$email);
						// $sendMail = $this->sendEmail($email,'admin@RefillMyBottle.com','admin-refillmybottle','',$subject,'',$data);
						
						$json["STATUS"]="SUCCESS";
						$json["MESSAGE"]="REGISTER SUCCESS";
						$json["DATA"]=$this->get_data2($check, $gcm_regid);
						// $member_id = $id;
						// $device_os = $this->input->get_post("DEVICE_OS");
						// $type_os = $this->input->get_post("TYPE_OS");
						// $device_model = $this->input->get_post("DEVICE_MOCEL");
						// $login_first = "1";
						// $this->insert_log($member_id, $device_os, $type_os, $device_model, $login_first);
						// }else{
						// $json["STATUS"]="FAILED";
						// $json["MESSAGE"]="BOTTLE SIZE REQUIRED";
						// $json["DATA"]=(object) array();
						// }
	// 				}else{

	// 					$json["STATUS"]="FAILED";
	// 					$json["MESSAGE"]="PASSWORD NOT SAME WITH CONFIRM PASSWORD";
	// 					$json["DATA"]=(object) array();
	// 				}
	// 	}else{
	// 					$json["STATUS"]="FAILED";
	// 					$json["MESSAGE"]="CONFIRM PASSWORD REQUIRED";
	// 					$json["DATA"]=(object) array();
	// }	
	// }else{
	// 					$json["STATUS"]="FAILED";
	// 					$json["MESSAGE"]="PASSWORD REQUIRED";
	// 					$json["DATA"]=(object) array();
	//  }


	}
	}
		echo json_encode($json);
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

function check_hash(){
		$headers = apache_request_headers();
		if(!empty($headers["APP_TOKEN"])){
			$id = $this->input->get_post("MEMBER_ID");
			$hash = $this->input->get_post("HASH");	
			$checkhash = $this->member_model->checkhash($id,$hash);
			if(count($checkhash)>0){
				$data["STATUS"]="SUCCESS";
				$data["MESSAGE"]="RESET PASSWORD HAS BEEN SUCCESS";
				$data["DATA"]=array();
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="CANT USE THIS LINK";
				$data["DATA"]=array();
			}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT APP TOKEN";
			$data["DATA"]=array();
		}
		echo json_encode($data);
	}

		function res_pass(){
		$headers = apache_request_headers();
		if(!empty($headers["APP_TOKEN"])){
			$data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
			if (count($data_app)>0) {
				$id = $this->input->get_post("MEMBER_ID");
				$hash = $this->input->get_post("HASH");
				if(!empty($id) && !empty($hash)){
					$checkhash = $this->member_model->checkhash($id,$hash);
					if(count($checkhash)>0){
						$pass1 = $this->input->get_post("PASSWORD1");
						$pass2 = $this->input->get_post("PASSWORD2");
						if($pass1 === $pass2){
							$input['member_password'] = md5($pass1);
							$input['reset_password_key'] = "0";
							$input['updated_date'] = date('Y-m-d H:i:s');

							$this->db->where('member_id', $id);
							$this->db->update('member', $input);

								$data["STATUS"]="SUCCESS";
								$data["MESSAGE"]="RESET PASSWORD HAS BEEN SUCCESS";
								$data["DATA"]=array();
						}else{
							$data["STATUS"]="FAILED";
							$data["MESSAGE"]="PASSWORD NOT SAME";
							$data["DATA"]=array();
						}
					}else{
						$data["STATUS"]="FAILED";
						$data["MESSAGE"]="CANT USE THIS LINK";
						$data["DATA"]=array();
					}
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="CANT USE THIS LINK";
					$data["DATA"]=array();
				}
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="INVALID APP TOKEN";
				$data["DATA"]=array();
			}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="PLEASE INPUT APP TOKEN";
			$data["DATA"]=array();
		}
		echo json_encode($data);
	}

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

 function sendEmail($to,$from,$name,$msg,$subject,$attachment="",$data) {
        $msg2 = $this->load->view($data['Layout'],$data,true);
        

		$this->load->library('email');
	    // does not have to be gmail
	  	 $config = array();
		    $config['charset'] = 'utf-8';
		    $config['useragent'] = 'Codeigniter';
		    $config['protocol']= "smtp";
		    $config['mailtype']= "html";
		    $config['smtp_host']= "mail.smtp2go.com";
		    $config['smtp_port']= "2525";
		    $config['smtp_timeout']= "400";
		    $config['smtp_user']= "lope";
		    $config['smtp_pass']= "ZWVhaWQxZnl5dnQw";
		    $config['crlf']="\r\n"; 
		    $config['newline']="\r\n"; 
		    $config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		
		$this->email->from($from, $name);
		$this->email->to($to);
		// $this->email->cc($cc);

		$this->email->subject($subject);
		$this->email->message($msg2);
		$r = $this->email->send();
    }

	// function updateProfile(){
	// 	$headers = apache_request_headers();
	// 	if(!empty($headers['APP_TOKEN']) && !empty($headers['USER_TOKEN'])){
	// 		$data_app = $this->member_model->check_app($headers['APP_TOKEN']);
	// 		if(count($data_app) > 0){
	// 			$data_user = $this->member_model->check_member($headers['USER_TOKEN'],$this->input->get_post('MEMBER_ID'));
	// 			if(count($data_user) > 0){
	// 				$memberID = $this->input->get_post('MEMBER_ID');
	// 				// $memberName = $this->input->get_post('MEMBER_NAME');
	// 				$memberSalutation = $this->input->get_post('MEMBER_SALUTATION');
	// 				$memberFirstName = $this->input->get_post('MEMBER_FIRSTNAME');
	// 				$memberLastName = $this->input->get_post('MEMBER_LASTNAME');
	// 				$memberCity = $this->input->get_post('MEMBER_CITY');
	// 				$memberCountry = $this->input->get_post('MEMBER_COUNTRY');
	// 				$memberDestination = $this->input->get_post('MEMBER_DESTINATION');
	// 				$memberCountryName = $this->input->get_post('MEMBER_COUNTRY_NAME');
	// 				$memberDestinationName = $this->input->get_post('MEMBER_DESTINATION_NAME');
	// 				$memberEmail = $this->input->get_post('MEMBER_EMAIL');
	// 				$memberImage = $this->input->get_post('MEMBER_IMAGE');
	// 				// $memberPhone = $this->input->get_post('MEMBER_PHONE');
	// 				$memberPhoneCode = $this->input->get_post('MEMBER_PHONE_CODE');
	// 				$memberPhoneDetail = $this->input->get_post('MEMBER_PHONE_DETAIL');
	// 				$memberLastFourDigit = $this->input->get_post('MEMBER_LAST_FOUR_DIGIT');

	// 				if(!empty($memberID)){
	// 					// $input['member_image'] = "";

	// 					if($this->input->post("MEMBER_IMAGE")!=""){
								
								
	// 						$temp_android="";
	// 						$base64=$this->input->post("MEMBER_IMAGE");
							
	// 						define('UPLOAD_DIR', './media/member/');
	// 						$base64img = str_replace('data:image/jpeg;base64,', '', $base64);
	// 						$data1 = base64_decode($base64img);
	// 						$file = UPLOAD_DIR . uniqid() . '.png';
	// 						file_put_contents($file, $data1);
	// 						$xxx=explode("/",$file);
	// 						$image= $xxx[3];
	// 						$this->image_resize($image);
							
	// 						// $input['member_image'] = $this->cek_null($image);
	// 						$input['member_image'] = $this->cek_null($image);

	// 						$checkImage = $this->member_model->checkImage($memberID);
	// 						if(!empty($checkImage['member_image']) && $checkImage['member_image'] != 'default.png'){
	// 							$file = UPLOAD_DIR . $checkImage['member_image'];
	// 							unlink($file);
	// 						}
	// 					}
	// 					if($memberEmail != ""){
	// 						$inputEmail['member_email'] = $memberEmail;
	// 						$this->db->where('member_id', $memberID);
	// 						$this->db->update('member', $inputEmail);
	// 					}

	// 					$memberName = $memberSalutation.' '.$memberFirstName.' '.$memberLastName;
	// 					$memberPhone = $memberPhoneCode.$memberPhoneDetail;

	// 					$input['member_name'] = $this->cek_null($memberName);
	// 					$input['member_salutation'] = $this->cek_null($memberSalutation);
	// 					$input['member_firstname'] = $this->cek_null($memberFirstName);
	// 					$input['member_lastname'] = $this->cek_null($memberLastName);
	// 					$input['member_city'] = $this->cek_null($memberCity);
	// 					$input['member_phone'] = $this->cek_null($memberPhone);
	// 					$input['member_phone_code'] = $this->cek_null($memberPhoneCode);
	// 					$input['member_phone_detail'] = $this->cek_null($memberPhoneDetail);
	// 					$input['member_last_four_digit'] = $this->cek_null($memberLastFourDigit);
	// 					$input['member_country'] = $this->cek_null($memberCountry);
	// 					$input['member_destination'] = $this->cek_null($memberDestination);
	// 					$input['member_country_name'] = $this->cek_null($memberCountryName);
	// 					$input['member_destination_name'] = $this->cek_null($memberDestinationName);
	// 					// print_r($input);die();
	// 					$this->db->where('member_id', $memberID);
	// 					$update = $this->db->update('member_profile', $input);
	// 					unset($input['member_image']);
	// 					$existImage = $this->member_model->checkImage($memberID);
	// 					$input['member_image'] = base_url().'media/member/'.$existImage['member_image']; 
	// 					if($update){
	// 						$json['STATUS'] = 'SUCCESS';
	// 						$json['MESSAGE'] = 'MEMBER PROFILE UPDATED';
	// 						$json['DATA'] = $input;
	// 					}else{
	// 						$json['STATUS'] = 'FAILED';
	// 						$json['MESSAGE'] = 'An Error Accoured When Updating Data';
	// 						$json['DATA'] = array();
	// 					}
	// 				}else{
	// 					$json['STATUS'] = 'FAILED';
	// 					$json['MESSAGE'] = 'MEMBER_ID REQUIRED';
	// 					$json['DATA'] = array();
	// 				}
	// 			}else{
	// 				$json['STATUS'] = 'FAILED';
	// 				$json['MESSAGE'] = 'INVALID USER TOKEN PLEASE RE-LOGIN';
	// 				$json['DATA'] = array();
	// 			}
	// 		}else{
	// 			$json['STATUS'] = 'FAILED';
	// 			$json['MESSAGE'] = 'INVALID APP TOKEN';
	// 			$json['DATA'] = array();
	// 		}
	// 	}else{
	// 		$json['STATUS'] = 'FAILED';
	// 		$json['MESSAGE'] = 'APP TOKEN REQUIRED';
	// 		$json['DATA'] = array();
	// 	}

	// 	echo json_encode($json);
	// }
	

}












