<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member extends CI_Controller{
	
			function __construct(){
		parent::__construct();
		header('Content-Type: application/json');
		$this->load->model('global_model');
		$this->load->model("api_model/member_model");
		$this->load->library('get_api');
		}


	function get_data($data){
		$headers=apache_request_headers();
		$row = $data;
		$api["MEMBER_ID"]=$row["member_id"];
		$api["MEMBER_EMAIL"]=$row["member_email"];
		$this->db->select("*");
		$this->db->from("member a");
		$this->db->join("member_profile b","a.member_id = b.member_id","left");
		$this->db->where("a.deleted","0");		
		$this->db->where("a.member_id",$row["member_id"]);
		
		$query = $this->db->get();
		$all = array();
	foreach($query->result_array() as $raw){
			 
			$caw["MEMBER_FIRST_NAME"]=$raw["first_name"];
			$caw["MEMBER_LAST_NAME"]=$raw["last_name"];
	        $caw["MEMBER_DATE_OF_BIRTH"]=$raw["date_of_birth"];
			
			$all=$caw;
		
		return $all;
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
		$api["TOKEN"] = hash("sha256", $password.$email.date("Ymd"));
	
		return $api;
	}

	function cek_null($var){
	
		if( empty($var) ){
			return "";
		}else{
			return $var;
		}
	}

	function login(){
		$headers=apache_request_headers();
		$email = $this->input->post("MEMBER_EMAIL");
            $password = $this->input->post("MEMBER_PASSWORD");
            if($email!="" && $password!="" && !empty($headers["APP_TOKEN"])){
            	$data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            	if(count($data_app)>0){
            			$check = $this->member_model->check_login($email,$password);
            			if(count($check)>0){
	            			            		
		            			$json["STATUS"] = "SUCCESS";
		            			$json["MESSAGE"] = "LOGIN SUCCESS";
		            			$json["DATA"] = $this->get_data($check);
		            		
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

		$first_name 		= $this->input->get_post("FIRST_NAME");
		$last_name 			= $this->input->get_post("LAST_NAME");
		$email 				= $this->input->get_post("EMAIL");
		$confirm_email			= $this->input->get_post("CONFRIM_EMAIL");
		$password 			= $this->input->get_post("PASSWORD");
		$confirm_password 			= $this->input->get_post("CONFIRM_PASSWORD");
		$dateofbirth = $this->input->get_post("DATE_OF_BIRTH");
		$country = $this->input->get_post("COUNTRY");
		$state = $this->input->get_post("STATE");
		$city = $this->input->get_post("CITY");
		$street = $this->input->get_post("STREET");
		$member_image = $this->input->get_post("MEMBER_IMAGE");

		$random_key = mt_rand(1000, 99999);
		$hash = md5($random_key);	

		if(!empty($headers["APP_TOKEN"])&&$email!=""&&$confirm_email!=""&&$password!=""&&$confirm_password!=""){
			$data_app = $this->member_model->check_app($headers["APP_TOKEN"]);
            if(count($data_app)>0){
            	// echo "gud"; die();
			$this->db->select("member_email");
				$this->db->from("member");
				$this->db->where("member_email",$email);
				$email_row=$this->db->get();
				$email_count=$email_row->num_rows();
				if($email_count == 0){
					if($password==$confirm_password){	
					
                      if($this->input->post("MEMBER_IMAGE")!=""){
							$temp_android="";
							$base64=$this->input->post("MEMBER_IMAGE");
							
							define('UPLOAD_DIR', './media/member/');
							$base64img = str_replace('data:image/jpeg;base64,', '', $base64);
							$data1 = base64_decode($base64img);
							// $data2 = uniqid() . '.jpg';
							$file = UPLOAD_DIR . uniqid(). '.png';
							file_put_contents($file, $data1);
							$xxx=explode("/",$file);
							$image= $xxx[3];
							$this->image_resize($image);
							}else{
							$image = "default_refill.jpeg ";
							}
							$input=array(
										"member_email"  => $email,
										"member_password" => md5($password),
										"key_actived" => $hash,
										"status" 				=>  "1",
										"token"=>"0",
										"facebook_id"=>"0",
										"reset_password_key"=>"0",
										"created_date" 			=> date("Y-m-d H:i:s"),
										"deleted"=>"0",
										
									);
			
									$this->db->insert("member",$input);
									$id = $this->db->insert_id();

									$inputprofile = array(

										"member_id" => $id,
										"first_name"  => $first_name,
										"last_name"  => $last_name,
										"member_email"  => $email,
										"member_image"=>$image,

										"member_password"=>$password,
										// "member_interest"=>$,
										// "member_bottle_point"=>$,
										// "member_point"=>$,
										// "member_progress"=>$,
										// "member_date_of_birth"=>$dateofbirth,
										// "member_country"=>$,
										// "member_state"=>$,
										// "member_city"=>$,
										"member_street"=>$street,
										"created_date" 			=> date("Y-m-d H:i:s"),
										"created_by"=>$first_name,
										"updated_by"=>$first_name,
										"deleted"=>"0"
									);
									$this->db->insert("member_profile",$inputprofile);
									$check = $this->member_model->check_login($email,$password);	
									$this->send_email($input, $check);

									// $put_data = $this->member_model->check_login($email);
											
									$data["STATUS"]="SUCCESS";
									$data["MESSAGE"]="REGISTRATION SUCCESS";
									$data["DATA"]= $this->get_data($check);
								}else{
						$data["STATUS"]="FAILED";
						$data["MESSAGE"]="PASSWORD NOT SAME";
						$data["DATA"]=(object) array();
					}else{
							$data["STATUS"]="FAILED";
							$data["MESSAGE"]="EMAIL HAS REGISTERED";
							$data["DATA"]=(object) array();
							}
					}else{
					$data["STATUS"]="FAILED";						
					$data["MESSAGE"]="APP TOKEN REQUIRED";
					$data["DATA"]=(object) array();
				}
			}else{
							$data["STATUS"]="FAILED";
							$data["MESSAGE"]="INVALID APP TOKEN";
							$data["DATA"]=(object) array();
						}
				
					echo json_encode($data);
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




	function login_sosmed(){
		$post=$this->input->post();
		$facebook_id = $this->input->get_post("FACEBOOK_ID");
		$user  = $this->input->get_post("MEMBER_USERNAME");
		$pass  = $this->input->get_post("MEMBER_PASSWORD");
		
		
		$device_os = $this->input->get_post("DEVICE_OS");
		$type_os = $this->input->get_post("TYPE_OS");
		$device_model = $this->input->get_post("DEVICE_MOCEL");
		$login_first = "0";
		$check = $this->member_model->check_login($user,$pass);
		$gcm_regid  = $this->input->get_post("GCM_REGID");
		
		
		$this->db->select("*");
		$this->db->from("Nmember");
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

		function send_email($data,$id){

		$msg = '
				<html>
                <head>
                </head>
                <body>
                    <p><b>Thank you for taking the time to register.</b></p>
                    <br>
                    <p>
                        These are the three things you need to do to get listed on the map and
                        get the most out of this initiative.
                    </p>
                        <div class="col-md-10">
                            <ol>
                                <li>
                                    <b>Display a sticker</b><br>
                                    to let users know that you’re a RefillStation. You have two options: collect
                                    it from your closest pickup point (find it here) or print it yourself (click
                                    here). To make sure your sticker
                                    attracts clients put it in a highly visible place (outside is better). You can
                                    display as many stickers as you want.
                                </li>
                                <li>
                                    <b>Take a Picture</b><br>
                                    picture with your sticker and your staff to advertise your
                                    RefillStation. We’ll upload you onto the map as soon as we see your photo on
                                    Facebook, Instagram and/or Twitter. Please don’t forget to tag us on Instagram
                                    @RefillMyBottle_ or Facebook: RefillMyBottle
                                    or and use #RefillMyBottle so we can find post.
                                </li>
                                <li>
                                    <b>Explain about system to your staff</b><br>
                                    To make sure you never run out of
                                    water and keep your Refillers happy, you’ll need to explain to your
                                    staff how it all works.
                                </li>
                            </ol>
                        </div>
                        <div class="clearfix"></div><br><br>
                    <p>
                        Before our system allows us to activate your account, we’ve got to make sure that all your details are
                        correct. Can you take a couple of minutes to check the form below? Email me at
                        <section style="text-decoration:underline;">iloveto@refillmybottle.com</section> in case you see
                        a mistake.
                    </p><br><br>
                    <p>
                        Thank you once again for<br>
                        taking action in the fight against plastic waste. I am very happy to welcome you<br>
                        to our community. <br><br>
                    </p>
                    <p>
                        <b>Regards,</b><br>
                        Christine Go<br>
                        RefillMyBottle Project<br>
                        Manager 
                    </p><br><br>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <center>
                            <table style="border: solid 1px rgb(238, 238, 238);">
                                <thead>
                                    <th style="color:orange; background-color: rgb(238, 238, 238);">Welcome to RefillMyBottle</th>
                                    <th style="background-color: rgb(238, 238, 238);"></th>
                                </thead>
                                <tr>
                                    <td><b>Unique ID : </b></td>
                                    <td>'.$id.'</td>
                                </tr>
                                <tr style="background-color: rgb(238, 238, 238);">
                                    <td><b>Your Name : </b></td>
                                    <td>'.$data["member_name"].'</td>
                                </tr>
                                <tr>
                                    <td><b>What is the name of your business : </b></td>
                                    <td>'.$data["business_name"].'</td>
                                </tr>
                                <tr style="background-color: rgb(238, 238, 238);">
                                    <td><b>Which kind of business are you :</b></td>
                                    <td>'.$data["business_type"].'</td>
                                </tr>
                                <tr>
                                    <td><b>If "other" type of business, please describe here :</b></td>
                                    <td>'.$data["business_type_name"].'</td>
                                </tr>
                                <tr style="background-color: rgb(238, 238, 238);">
                                    <td><b>What kind of water do you offer :</b></td>
                                    <td>'.$galon.'</td>
                                </tr>
                                <tr>
                                    <td><b>Is the water free :</b></td>
                                    <td>'.$price.'</td>
                                </tr>
                                <tr style="background-color: rgb(238, 238, 238);">
                                    <td><b>If not free, how much do you charge for a 1 litre bottle :</b></td>
                                    <td>'.$data["water_price"].'</td>
                                </tr>
                                <tr>
                                    <td><b>You are open on :</b></td>
                                    <td>'.$data["open_type"].'</td>
                                </tr>
                                <tr style="background-color: rgb(238, 238, 238);">
                                    <td><b>You are open from :</b></td>
                                    <td>'.$data["open_hour"].'</td>
                                </tr>
                                <tr>
                                    <td><b>You close at :</b></td>
                                    <td>'.$data["close_hour"].'</td>
                                </tr>
                                <tr style="background-color: rgb(238, 238, 238);">
                                    <td><b>Phone Number :</b></td>
                                    <td>'.$data["phone_number"].'</td>
                                </tr>
                                <tr>
                                    <td><b>E-mail :</b></td>
                                    <td>'.$data["email"].'</td>
                                </tr>
                                <tr style="background-color: rgb(238, 238, 238);">
                                    <td><b>Description of your place :</b></td>
                                    <td>'.$data["business_description"].'</td>
                                </tr>
                                <tr>
                                    <td><b>Which country are you located in :</b></td>
                                    <td>'.$data["country_id"].'</td>
                                </tr>
                                <tr style="background-color: rgb(238, 238, 238);">
                                    <td><b>Which local Refill community are you part of :</b></td>
                                    <td>'.$data["city_id"].'</td>
                                </tr>
                                <tr>
                                    <td><b>Upload a photo of the front of your business to display on the app :</b></td>
                                    <td><img src="'.$data["store_image"].'" style="width:100px; height:100px;"></td>
                                </tr>
                                <tr style="background-color: rgb(238, 238, 238);">
                                    <td><b>Please upload your logo here if you have one :</b></td>
                                    <td><img src="'.$data["store_logo"].'" style="width:100px; height:100px;"></td>
                                </tr>
                                <tr>
                                    <td><b>Please write down your full address :</b></td>
                                    <td>'.$data["address"].'</td>
                                </tr>
                            </table>
                        </center>
                    </div>
                </body>
                </html>
			';
		
		$from = "seagleax700@gmail.com";
		$name = "Refill My Bottle";
		$to = $data['email'];
		// $cc = "tollars00@gmail.com";
		
		$subject = "Thanks for Registering ".$data['business_name']." as a Refill Station";
		
		$this->load->library('email');
		$config['protocol'] 	= 'smtp';
		$config['smtp_host'] 	= 'mail.smtp2go.com'; 
    	$config['smtp_port'] 	= '2525';
    	$config['smtp_user'] 	= 'refilmybottle';
   		$config['smtp_pass'] 	= 'admin_refill';
   	 	$config['mailtype'] 	= 'html';
    	$config['charset'] 		= 'utf-8';
		$config['wordwrap'] 	= TRUE;
		$config['newline']		= "\r\n";
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");				    

		$this->email->from($from,$name);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($msg);
		$this->email->send();   

				}

	

	}













