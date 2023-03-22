<?php
class Master_model extends CI_Controller{
	
	function get_city($limit="",$offset=""){
		$this->db->select("*");
                $this->db->from("wifren_city a");
                $this->db->where("a.deleted", "0");
		
                $query = $this->db->get();
                
		return $query->result_array();
	}
        
        function get_sliding($limit="",$offset=""){
	
		$this->db->select("*");
		$this->db->from("sliding a");
		
		$this->db->where("a.deleted","0");
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
		$query=$this->db->get();
		
		return $query->result_array();
	}
        
	function get_todolist_category(){
		$this->db->select("*");
		$this->db->from("wifren_todolist_category");
		$this->db->where("deleted", "0");
		$this->db->order_by("wifren_todolist_category_name", "asc");
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function get_page($limit="",$offset=""){
	
		$this->db->select("*");
		$this->db->from("wifren_category_log a");
		
		$this->db->where("a.deleted","0");
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
        function get_content($id,$limit="",$offset=""){
	
		$this->db->select("*");
		$this->db->from("content a");
		$this->db->where("a.content_location",$id);
		$this->db->where("a.deleted","0");
		
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	function get_jobs(){
	
		$this->db->select("*");
		$this->db->from("job a");
		
		$this->db->where("a.deleted","0");
		
		
		
		$query=$this->db->get();
		
		return $query->result_array();
	}
	
	function get_hobys(){
	
		$this->db->select("*");
		$this->db->from("hoby a");
		
		$this->db->where("a.deleted","0");
		
		
		
		$query=$this->db->get();
		
		return $query->result_array();
	}
}