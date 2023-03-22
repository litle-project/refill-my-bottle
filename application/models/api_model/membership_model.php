<?php
class Membership_model extends CI_Model {
        function get_data($merchant="",$limit="",$offset=""){
		$this->db->select("*");
		$this->db->from("wifren_membership a");
		//$this->db->join("wifren_membership_detail b", "a.wifren_membership_id=b.wifren_membership_id","left");
		$this->db->join("wifren_merchant c", "a.merchant_id=c.merchant_id","left");
		
                
                
		//$this->db->join("wifren_city d", "b.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
                //$this->db->where("b.deleted","0");
               // $this->db->where("c.deleted","0");
		
		if($merchant!=""){
			$this->db->where("a.member_id",$merchant);
		}
		
		
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
                $this->db->order_by("c.merchant_name", "asc");
                $this->db->group_by("a.wifren_membership_id");
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	function get_data2($merchant="",$limit="",$offset=""){
		$this->db->select("*");
		$this->db->from("wifren_membership a");
		//$this->db->join("wifren_membership_detail b", "a.wifren_membership_id=b.wifren_membership_id","left");
		$this->db->join("wifren_merchant c", "a.merchant_id=c.merchant_id","left");
		
                
                
		//$this->db->join("wifren_city d", "b.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
                //$this->db->where("b.deleted","0");
               // $this->db->where("c.deleted","0");
		
		if($merchant!=""){
			$this->db->where("a.wifren_membership_id",$merchant);
		}
		
		
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
                $this->db->order_by("c.merchant_name", "asc");
                $this->db->group_by("a.wifren_membership_id");
		$query=$this->db->get();
		
		return $query->result_array();
	}
        
        
}