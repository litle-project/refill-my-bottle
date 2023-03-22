<?php
class Reedem_model extends CI_Model {
        function get_data($merchant="",$merchant_location="",$city="",$limit="",$offset=""){
		$this->db->select("*");
		$this->db->from("wifren_reedem a");
		$this->db->join("wifren_reedem_location b", "a.wifren_reedem_id=b.wifren_reedem_id","left");
		$this->db->join("wifren_merchant c", "a.merchant_id=c.merchant_id","left");
                
                
		//$this->db->join("wifren_city d", "b.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
                $this->db->where("b.deleted","0");
                $this->db->where("c.deleted","0");
		
		if($merchant!=""){
			$this->db->where("a.merchant_id",$merchant);
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
		
                $this->db->order_by("a.wifren_reedem_id","desc");
                $this->db->group_by("a.wifren_reedem_id");
		$query=$this->db->get();
		
		return $query->result_array();
	}
        
	function get_data2($merchant="",$limit="",$offset=""){
		$this->db->select("*");
		$this->db->from("wifren_reedem a");
		//$this->db->join("wifren_reedem_location b", "a.wifren_reedem_id=b.wifren_reedem_id","left");
		//$this->db->join("wifren_merchant c", "a.merchant_id=c.merchant_id","left");
                
                
		//$this->db->join("wifren_city d", "b.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
                //$this->db->where("b.deleted","0");
                //$this->db->where("c.deleted","0");
		
		if($merchant!=""){
			$this->db->where("a.wifren_reedem_id",$merchant);
		}
		
		
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
                
                $this->db->group_by("a.wifren_reedem_id");
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	
        function get_data3($merchant="",$limit="",$offset=""){
		$this->db->select("*");
		$this->db->from("wifren_reedem a");
		$this->db->join("wifren_reedem_location b", "a.wifren_reedem_id=b.wifren_reedem_id","left");
		$this->db->join("wifren_merchant c", "a.merchant_id=c.merchant_id","left");
                
                
		//$this->db->join("wifren_city d", "b.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
                $this->db->where("b.deleted","0");
                $this->db->where("c.deleted","0");
		
		if($merchant!=""){
			$this->db->where("a.wifren_reedem_id",$merchant);
		}
		
		
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
                
                $this->db->group_by("a.wifren_reedem_id");
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	
	
	function get_com($id,$type=3){
		
		$this->db->select("*");
		$this->db->from("wifren_coment a");
		$this->db->where("a.deleted","0");
		$this->db->where("a.wifren_category_log_id",$type);
		$this->db->where("a.wifren_foreign_id",$id);
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function get_like($id,$type=3,$member_id=""){
		
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
	
	function get_view($id,$type=3,$member_id=""){
		
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
	
		
	function get_com_detail($id,$type=3,$limit="",$offset=""){
		
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