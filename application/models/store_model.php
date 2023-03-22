<?php

class Store_model extends CI_Model {
		
	
	function get_data($id=""){       
       $this->db->select("*");	   
	   $this->db->where("a.deleted","0");
	   if($id!=""){
		   $this->db->where("a.store_id",$id);
	   }
	   $this->db->order_by("a.store_id","desc");
	   $query=$this->db->get("store a");
	   foreach( $query->result_array() as $row){
		   $this->db->select("*");
		   $this->db->where("a.store_id",$row["store_id"]);
		   $query2=$this->db->get("store_image a");
		   $row["image"]=$query2->result_array();
		   $all[]=$row;
	   }
	   return $all;
    }
	
	
	
}