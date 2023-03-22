<?php
class Bottle extends CI_Controller{
    
     function __construct(){
        parent::__construct();
        //$this->load->model("api_model/place_model");
        $this->load->model("global_model");
        $this->load->model("api_model/member_model");
        header('Content-Type: application/json');
        $this->load->library('get_api');
    }
    function get_bottle(){

		$headers = apache_request_headers();
		if(!empty($headers['APP_TOKEN']) && !empty($headers['USER_TOKEN'])){
			$data_app = $this->member_model->check_app($headers['APP_TOKEN']);
			if(count($data_app) > 0){
				$data_user = $this->member_model->check_member($headers['USER_TOKEN'],$this->input->get_post('MEMBER_ID'));
				if(count($data_user) > 0){
					
					$member_id=$this->input->get_post("MEMBER_ID");					
								if(!empty($member_id)){

									 	$this->db->select('*');
						                $this->db->from('member a');
						                $this->db->join('member_profile b', 'b.member_id = a.member_id');						      
						                $this->db->where('a.member_id', $member_id);
						                $this->db->where('a.status', '1');
						                $query = $this->db->get();
						                $get_bottle= $query->result_array();
									if(!empty($get_bottle)){
										
												$data["STATUS"]="SUCCESS";
												$data["MESSAGE"]="BOTTLE CAPACITY";
												$data["DATA"]=$get_bottle[0]['bottle_size_id'];		
											
										
									}else{
										$data["STATUS"]="FAILED";
										$data["MESSAGE"]="INVALID DATA";
										$data["DATA"]=array();
									}
								}else{
									$data["STATUS"]="FAILED";
									$data["MESSAGE"]="MEMBER_ID REQUIRED";
									$data["DATA"]=(object) array();
								}
							
						
					
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="INPUT USER TOKEN";
					$data["DATA"]=(object) array();
				}
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="INVALID APP_TOKEN";
				$data["DATA"]=(object) array();
			}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="APP_TOKEN AND USER TOKEN REQUIRED";
			$data["DATA"]=(object) array();
		}		
		echo json_encode($data);
	}



  function set_bottle(){

		$headers = apache_request_headers();
		if(!empty($headers['APP_TOKEN']) && !empty($headers['USER_TOKEN'])){
			$data_app = $this->member_model->check_app($headers['APP_TOKEN']);
			$bottlec=$this->input->get_post("BOTTLE_SIZE_ID");	
		if(count($data_app) > 0){
				$data_user = $this->member_model->check_member($headers['USER_TOKEN'],$this->input->get_post('MEMBER_ID'));
			if($bottlec!=""){
				if(count($data_user) > 0){
					
					$member_id=$this->input->get_post("MEMBER_ID");					
								if(!empty($member_id)){

									$sql = " select * from member where member_id = '".$member_id."' ";
									$que = $this->db->query($sql);
									$num = $que->num_rows();

									if($num > 0){
										
											$input2=array(
												"bottle_size_id" => $bottlec,
											);

											$this->db->where("member_id",$member_id);
											$update = $this->db->update("member_profile",$input2);
											if($update){
												$data["STATUS"]="SUCCESS";
												$data["MESSAGE"]="BOTTLE HAS BEEN CHANGED";
												$data["DATA"]=(object) array();		
											}else{
												$data["STATUS"]="FAILED";
												$data["MESSAGE"]="An Error Accoured When Updating Data";
												$data["DATA"]=(object) array();
											}
										
									}else{
										$data["STATUS"]="FAILED";
										$data["MESSAGE"]="INVALID DATA";
										$data["DATA"]=(object) array();
									}
								}else{
									$data["STATUS"]="FAILED";
									$data["MESSAGE"]="MEMBER_ID REQUIRED";
									$data["DATA"]=(object) array();
								}
					
				}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="INPUT USER TOKEN";
					$data["DATA"]=(object) array();
				}
			}else{
					$data["STATUS"]="FAILED";
					$data["MESSAGE"]="REQUIRED BOTTLE";
					$data["DATA"]=(object) array();
			}
			}else{
				$data["STATUS"]="FAILED";
				$data["MESSAGE"]="INVALID APP_TOKEN";
				$data["DATA"]=(object) array();
			}
		}else{
			$data["STATUS"]="FAILED";
			$data["MESSAGE"]="APP_TOKEN AND USER TOKEN REQUIRED";
			$data["DATA"]=(object) array();
		}		
		echo json_encode($data);
	}

}
