<?php

class Order_model extends CI_Model {
	
	function order_list($id=""){
		
		$this->db->select("*");
		$this->db->from("order a");
		$this->db->where("a.deleted","0");
		$this->db->order_by("a.order_id", "desc");
		if($id!=""){
			$this->db->where("a.order_id",$id);
		}
		
		$query = $this->db->get();
		$i=0;
		foreach ($query->result_array() as $row){
			$this->db->select("*");
			$this->db->where("order_id",$row["order_id"]);			
			$this->db->where("deleted","0");			
			$query_image=$this->db->get("order_image");
			$data[]=$row;
			$data[$i]["detail_image"]=$query_image->result_array();
			
			
			$i++;
		}
		return $data;
		
	}

	function claim($id=""){
		
		$this->db->select("*");
		$this->db->from("claim a");
		$this->db->join("member_profile b", "a.member_id=b.member_id", "left");
		$this->db->join("member_polis c", "a.member_polis_id=c.member_polis_id", "left");
		$this->db->where("a.deleted","0");
		$this->db->order_by("a.claim_id", "desc");
		if($id!=""){
			$this->db->where("a.claim_id",$id);
		}
		
		$query = $this->db->get();
		$i=0;
		foreach ($query->result_array() as $row){
			$this->db->select("*");
			$this->db->where("claim_id",$row["claim_id"]);			
			$this->db->where("deleted","0");			
			$query_image=$this->db->get("claim_photo");
			$data[]=$row;
			$data[$i]["detail_image"]=$query_image->result_array();
			
			
			$i++;
		}
		return $data;
		
	}

	function workshop($location_id="",$limit="",$offset=""){
        $this->db->select("*");
        $this->db->from("location a");
        /*$this->db->join("comment_list b", "a.tips_id=b.tips_id", "left");
        $this->db->join("like_tips c", "a.tips_id=c.tips_id", "left");*/
        $this->db->where("a.deleted", "0");
        if($location_id !=""){
            $this->db->where("a.location_id",$location_id);
        }
        if($limit !="" OR $offset !=""){
            $this->db->limit($limit,$offset);
        }
        else{
            $this->db->limit(10);
        }
        $this->db->order_by("a.location_id", "desc");
        $data = $this->db->get();
        return $data->result_array();
    }

    function news($news_id="",$limit="",$offset=""){
        $this->db->select("*");
        $this->db->select("date_format(a.created_date,'%d %M %Y') as created_date",false);
        $this->db->from("news a");
        /*$this->db->join("comment_list b", "a.tips_id=b.tips_id", "left");
        $this->db->join("like_tips c", "a.tips_id=c.tips_id", "left");*/
        $this->db->where("a.deleted", "0");
        if($news_id !=""){
            $this->db->where("a.news_id",$news_id);
        }
        if($limit !="" OR $offset !=""){
            $this->db->limit($limit,$offset);
        }
        else{
            $this->db->limit(10);
        }
        $this->db->order_by("a.news_id", "desc");
        $data = $this->db->get();
        return $data->result_array();
    }

    function faq($faq_id="",$limit="",$offset=""){
        $this->db->select("*");
        $this->db->select("date_format(a.created_date,'%d %M %Y') as created_date",false);
        $this->db->from("faq a");
        /*$this->db->join("comment_list b", "a.tips_id=b.tips_id", "left");
        $this->db->join("like_tips c", "a.tips_id=c.tips_id", "left");*/
        $this->db->where("a.deleted", "0");
        if($faq_id !=""){
            $this->db->where("a.faq_id",$faq_id);
        }
        if($limit !="" OR $offset !=""){
            $this->db->limit($limit,$offset);
        }
        else{
            $this->db->limit(10);
        }
        $this->db->order_by("a.faq_id", "desc");
        $data = $this->db->get();
        return $data->result_array();
    }

    function config_api($id=""){
        $this->db->select("*");
        //$this->db->select("date_format(a.created_date,'%d %M %Y') as created_date",false);
        $this->db->from("config_api a");
        /*$this->db->join("comment_list b", "a.tips_id=b.tips_id", "left");
        $this->db->join("like_tips c", "a.tips_id=c.tips_id", "left");*/
        $this->db->where("a.deleted", "0");
        if($id !=""){
        	$this->db->where("a.config_api_id",$id);
        }

        $data = $this->db->get();
        return $data->result_array();
    }

    function emergency($emergency_id="",$limit="",$offset=""){
        $this->db->select("*");
        $this->db->select("date_format(a.created_date,'%d %M %Y') as created_date",false);
        $this->db->from("emergency a");
        /*$this->db->join("comment_list b", "a.tips_id=b.tips_id", "left");
        $this->db->join("like_tips c", "a.tips_id=c.tips_id", "left");*/
        $this->db->where("a.deleted", "0");
        if($emergency_id !=""){
            $this->db->where("a.emergency_id",$emergency_id);
        }
        if($limit !="" OR $offset !=""){
            $this->db->limit($limit,$offset);
        }
        else{
            $this->db->limit(10);
        }
        $this->db->order_by("a.emergency_id", "desc");
        $data = $this->db->get();
        return $data->result_array();
    }
}