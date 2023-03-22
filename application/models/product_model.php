<?php

class Product_model extends CI_Model {
		
	
	function get_data($id=""){       
       $this->db->select("*");
	   $this->db->join("printer b","a.printer_id =b.printer_id","left");
	   $this->db->where("a.deleted","0");
	   if($id!=""){
		   $this->db->where("a.product_id",$id);
	   }
	   $this->db->order_by("a.product_id","desc");
	   $query=$this->db->get("product a");
	   return $query->result_array();
    }
	
	
	
}