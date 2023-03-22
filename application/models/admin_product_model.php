<?php

class Admin_product_model extends CI_Model {
	function get_data($id=""){       
                $this->db->select("*");
                $this->db->join("category b","a.category_id =b.category_id","left");
                $this->db->where("a.deleted","0");
                if($id!=""){
                        $this->db->where("a.product_id",$id);
                }
                $this->db->order_by("a.product_id","desc");
                $query=$this->db->get("product a");
                return $query->result_array();
         }
	
	
	function get_data_image($id=""){       
                $this->db->select("*");
                //$this->db->join("category b","a.category_id =b.category_id","left");
                $this->db->where("a.deleted","0");
                if($id!=""){
                        $this->db->where("a.product_id",$id);
                }
                $this->db->order_by("a.product_image_id","desc");
                $query=$this->db->get("product_image a");
                return $query->result_array();
        }
}