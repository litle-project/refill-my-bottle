<?php
class Store_model extends CI_Model {
        function get_data($merchant="",$category="",$city="",$limit="",$offset=""){
		$this->db->select("*");
		$this->db->from("wifren_merchant_location a");
		$this->db->join("wifren_merchant b", "a.merchant_id=b.merchant_id","left");
		$this->db->join("wifren_cat_merchant c", "b.wifren_cat_merchant_id=c.wifren_cat_merchant_id","left");
                
		$this->db->join("wifren_city d", "a.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
		
		if($merchant!=""){
			$this->db->where("a.merchant_id",$merchant);
		}
		if($category!=""){
			$this->db->where("b.wifren_cat_merchant_id",$category);
		}
                if($city!=""){
			$this->db->where("a.wifren_city_id",$city);
		}
		
		$this->db->order_by("a.id_location","desc");
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
		$query=$this->db->get();
		
		return $query->result_array();
	}
        
        function get_detail($location="",$limit="",$offset=""){
		$this->db->select("*");
		$this->db->from("wifren_merchant_location a");
		$this->db->join("wifren_merchant b", "a.merchant_id=b.merchant_id","left");
		$this->db->join("wifren_cat_merchant c", "b.wifren_cat_merchant_id=c.wifren_cat_merchant_id","left");
                
		$this->db->join("wifren_city d", "a.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
		
		if($location!=""){
			$this->db->where("a.id_location",$location);
		}
		
		
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
		$query=$this->db->get();
		
		return $query->result_array();
	}
        
        
        function get_com($id,$type=1){
		
		$this->db->select("*");
		$this->db->from("wifren_coment a");
		$this->db->where("a.deleted","0");
		$this->db->where("a.wifren_category_log_id",$type);
		$this->db->where("a.wifren_foreign_id",$id);
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function get_like($id,$type=1,$member_id=""){
		
		$this->db->select("*");
		$this->db->from("wifren_like a");
		$this->db->where("a.wifren_category_log_id",$type);
		$this->db->where("a.wifren_foreign_id",$id);
		
		if($member_id != ""){
			$this->db->where("a.member_id",$member_id);
		}else{
			$this->db->where("a.deleted","0");
		}
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function get_view($id,$type=1,$member_id=""){
		
		$this->db->select("*");
		$this->db->from("wifren_view a");
		//$this->db->where("a.deleted","0");
		$this->db->where("a.wifren_category_log_id",$type);
		$this->db->where("a.wifren_foreign_id",$id);
		
		if($member_id != ""){
			$this->db->where("a.member_id",$member_id);
		}
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
		
	function get_com_detail($id,$type=1,$limit="",$offset=""){
		
		$this->db->select("*");
		$this->db->from("wifren_coment a");
		$this->db->join("member b","b.member_id=a.member_id");
		$this->db->where("a.deleted","0");
		$this->db->where("a.wifren_category_log_id",$type);
		$this->db->where("a.wifren_foreign_id",$id);
		
		$this->db->group_by("a.wifren_coment_id");
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
}