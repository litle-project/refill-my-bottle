<?php
class Admin_about_model extends CI_Model {
        
	function get_data($id=""){

		$this->db->select("*");
		if (!empty($id)) {
			$this->db->where("content_id", $content_id);
		}
		$this->db->from("content");
		$this->db->where("content_type", "0");
		$query = $this->db->get();
		return $query->result_array();
	}

                                        
	
	function get_data_module($type=""){
            $get_type="";
	    if(!empty($type)){
		$get_type=" and content_type_about='$type'";
	    }
            $sql ="	select * from content
                                where deleted_flag='0' and content_type='0' $get_type
				ORDER BY content_id DESC";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        
        function insert($data){
		$this->db->insert("content",$data);
	}
}