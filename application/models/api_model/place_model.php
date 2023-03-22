<?php
class Promo_model extends CI_Model {
        function get_data($merchant="",$merchant_location="",$city="",$limit="",$offset=""){
		$this->db->select("*");
		$this->db->from("wifren_merchant_promo a");
		//$this->db->join("wifren_promo_location b", "a.promo_id=b.promo_id","left");
		$this->db->join("wifren_merchant c", "a.merchant_id=c.merchant_id","left");
                $this->db->join("wifren_reedem wr", "wr.promo_id=a.promo_id", "left");
                
		//$this->db->join("wifren_city d", "b.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
		$this->db->where("a.status","1");
                //$this->db->where("b.deleted","0");
                //$this->db->where("c.deleted","0");
		
		if($merchant!=""){
			$this->db->where("a.merchant_id",$merchant);
		}
		if($merchant_location!=""){
			//$this->db->where("b.id_location",$merchant_location);
		}
                /*if($city!=""){
			$this->db->where("a.wifren_city_id",$city);
		}*/
		
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
                $this->db->order_by("a.promo_id","desc");
                $this->db->group_by("a.promo_id");
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	
	function get_data2($promo="",$merchant_location="",$city="",$limit="",$offset=""){
		$this->db->select("*");
		$this->db->from("wifren_merchant_promo a");
		$this->db->join("wifren_promo_location b", "a.promo_id=b.promo_id","left");
		$this->db->join("wifren_merchant c", "a.merchant_id=c.merchant_id","left");
                $this->db->join("wifren_reedem wr", "wr.promo_id=a.promo_id", "left");
                
		//$this->db->join("wifren_city d", "b.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
		$this->db->where("a.status","1");
                //$this->db->where("b.deleted","0");
                //$this->db->where("c.deleted","0");
		
		if($promo!=""){
			$this->db->where("a.promo_id",$promo);
		}
		if($merchant_location!=""){
			$this->db->where("b.id_location",$merchant_location);
		}
                /*if($city!=""){
			$this->db->where("a.wifren_city_id",$city);
		}*/
		
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
                
                $this->db->group_by("a.promo_id");
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	function get_data3($merchant="",$merchant_location="",$city="",$limit="",$offset=""){
		$this->db->select("*,b.time_min as tm");
		$this->db->from("wifren_merchant_promo a");
		$this->db->join("wifren_criteria b", "a.promo_id=b.promo_id","left");
		$this->db->join("wifren_merchant c", "a.merchant_id=c.merchant_id","left");
                 $this->db->join("wifren_reedem wr", "wr.promo_id=a.promo_id", "left");
                $this->db->where('a.highlight','1');
		//$this->db->join("wifren_city d", "b.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
		$this->db->where("a.status","1");
                //$this->db->where("b.deleted","0");
                //$this->db->where("c.deleted","0");
		
		if($merchant!=""){
			$this->db->where("a.merchant_id",$merchant);
		}
		if($merchant_location!=""){
			//$this->db->where("b.id_location",$merchant_location);
		}
                /*if($city!=""){
			$this->db->where("a.wifren_city_id",$city);
		}*/
		
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
                $this->db->order_by("a.promo_id","desc");
                $this->db->group_by("a.promo_id");
		$query=$this->db->get();
		
		return $query->result_array();
	}
        
	
	function get_com($id,$type=2){
		
		$this->db->select("*");
		$this->db->from("wifren_coment a");
		$this->db->where("a.deleted","0");
		$this->db->where("a.wifren_category_log_id",$type);
		$this->db->where("a.wifren_foreign_id",$id);
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function get_like($id,$type=2,$member_id=""){
		
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
	
	function get_view($id,$type=2,$member_id=""){
		
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
	
		
	function get_com_detail($id,$type=2,$limit="",$offset=""){
		
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