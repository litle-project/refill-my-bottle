<?php

class Member_model extends CI_Model{
	
	function check_login($email,$password){
		
		$this->db->select("*");
		$this->db->from("member a");
		$this->db->join("member_profile b","a.member_id=b.member_id","left");
		// $this->db->join("country c","c.country_id=b.country_id","left");
		// $this->db->join("city d","d.city_id=b.city_id","left");
		// $this->db->join("area e","e.area_id=b.area_id","left");
		$this->db->where("a.deleted","0");
		$this->db->where("a.status","1");
		$this->db->where("a.member_email",$email);
	 	$this->db->where("a.member_password",md5($password));
		$query = $this->db->get();
		return $query->row_array();
		
	}
		
	function set_fb($fb,$email){
		$sql="update member set facebook_id = ? where member_email= ? ";
		$this->db->query($sql,array($fb,$email));

		
	}
	function set_google($google,$email){
		$sql="update member set google_id = ? where member_email= ? ";
		$this->db->query($sql,array($google,$email));

		
	}
	
	function check_email($email){
			
		$this->db->select("*");
		$this->db->from("member a");
		$this->db->join("member_profile b","a.member_id=b.member_id","left");
	
		$this->db->where("a.deleted","0");
		$this->db->where("a.status","1");
		$this->db->where("a.member_email",$email);
		$query = $this->db->get();
		return $query->row_array();
		

		
	}

	
	function check_user($id){
		
		$this->db->select("*");
		$this->db->from("member a");
		$this->db->join("member_profile b","a.member_id=b.member_id","left");
		$this->db->where("a.deleted","0");
		$this->db->where("a.status","1");
		$this->db->where("a.member_id",$id);
		
		
		$query = $this->db->get();
		
		return $query->row_array();
		
	}
	
	function get_log($member_id="",$type="",$limit,$offset){
		$this->db->select("*");
		$this->db->from("wifren_mobile_log");
		$this->db->where("member_id" ,$member_id);
		if($type!=""){
			$this->db->where("wifren_log_type", $type);
		}
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		$this->db->order_by("wifren_log_id", "desc");
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function cek_email($email){
		$this->db->select("*");
		$this->db->from("member a");
		$this->db->join("member_profile b","b.member_id = a.member_id","inner");
		$this->db->where("a.status","1");
		// $this->db->where("a.actived","1");
		
		$this->db->where("a.member_email",$email);
		
		
		$query = $this->db->get();
		
		return $query->row_array();
	}
	
	function cek_email_hash($hash,$status=""){
		$this->db->select("*");
		$this->db->from("member a");
		$this->db->join("member_profile b","b.member_id=a.member_id","inner");
		$this->db->where("a.deleted","0");
		if($status==""){
		$this->db->where("a.status","1");
		}
		$this->db->where("a.reset_hash",$hash);
		
		
		$query = $this->db->get();
		
		return $query->row_array();
	}
	
	function check_app($app_token){
	    $this->db->where("app_token", $app_token);
	    $data = $this->db->get("app_token");
	    return $data->num_rows();
	}	
	 function checkImage($memberId){
    	$this->db->select('member_image');
    	$this->db->where('member_id', $memberId);
    	return $this->db->get('member_profile')->row_array();
    }
	function check_member($user_token,$id=""){
	    $this->db->where("token", $user_token);
	    if($id!=""){
	        $this->db->where("member_id", $id);
	    }	    
	    
	    $data = $this->db->get("member");
	    return $data->result_array();
	}

	function check_token($token){
		
		$this->db->select("app_token");
		$this->db->from("app_token");
		$this->db->where("app_token",$token);
		$query = $this->db->get();
		return $query->result_array();
	}

	function cek_hash($id, $hash){
		$this->db->select("*");
		$this->db->from("member a");
		$this->db->join("member_profile b","b.member_id=a.member_id","inner");
		$this->db->where("a.deleted","0");
		$this->db->where("a.status","1");
		$this->db->where("a.member_id",$id);
		$this->db->where("a.reset_password_key",$hash);
		$query = $this->db->get();
		return $query->result_array();
	}
	 function checkHash($id,$hash){
    	$this->db->select('*');
    	$this->db->from('member');
    	$this->db->where('member_id', $id);
    	$this->db->where('reset_password_key', $hash);
    	$query = $this->db->get()->row_array();
    	return $query;
    }
}


