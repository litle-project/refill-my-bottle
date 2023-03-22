<?php

class Admin_leather_model extends CI_Model {
	function get_data($id=""){       
                $this->db->select("*");
                $this->db->join("leather_category b","a.leather_category_id =b.leather_category_id","left");
                $this->db->where("a.deleted","0");
                if($id!=""){
                        $this->db->where("a.leather_id",$id);
                }
                $this->db->order_by("a.leather_id","desc");
                $query=$this->db->get("leather a");
                return $query->result_array();
         }
	
	
	function get_data_image($id=""){       
                $this->db->select("*");
                //$this->db->join("category b","a.category_id =b.category_id","left");
                $this->db->where("a.deleted","0");
                if($id!=""){
                        $this->db->where("a.leather_id",$id);
                }
                $this->db->order_by("a.leather_image_id","desc");
                $query=$this->db->get("leather_image a");
                return $query->result_array();
        }
}