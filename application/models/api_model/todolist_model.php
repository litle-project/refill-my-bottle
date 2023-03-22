<?php
class Todolist_model extends CI_Model {
        function get_data($merchant="",$limit="",$offset=""){
		$this->db->select("*, DATEDIFF(`wifren_todolist_date`, CURDATE()) AS diff ");
		$this->db->from("wifren_todolist a");
		//$this->db->join("wifren_todolist_detail b", "a.wifren_todolist_id=b.wifren_todolist_id","left");
		$this->db->join("member_profile c", "a.member_id=c.member_id","left");
		$this->db->join("wifren_todolist_category d", "a.wifren_todolist_category_id=d.wifren_todolist_category_id", "left");
                
                
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
		
                $this->db->order_by("diff");
                $this->db->group_by("a.wifren_todolist_id");
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	function get_data2($todolist_id="",$limit="",$offset=""){
		$this->db->select("*");
		$this->db->from("wifren_todolist a");
		//$this->db->join("wifren_todolist_detail b", "a.wifren_todolist_id=b.wifren_todolist_id","left");
		$this->db->join("member_profile c", "a.member_id=c.member_id","left");
                $this->db->join("wifren_todolist_category d", "a.wifren_todolist_category_id=d.wifren_todolist_category_id", "left");
                
		//$this->db->join("wifren_city d", "b.wifren_city_id=d.wifren_city_id","left");
		$this->db->where("a.deleted","0");
               
               // $this->db->where("c.deleted","0");
		
		if($todolist_id!=""){
			$this->db->where("a.wifren_todolist_id",$todolist_id);
		}
		
		
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
                //$this->db->order_by("diff");
                $this->db->group_by("a.wifren_todolist_id");
		$query=$this->db->get();
		
		return $query->result_array();
	}
        
        
}