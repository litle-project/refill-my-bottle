<?php
class Admin_why_model extends CI_Model {
        function get_data($id=""){
		$type=" and content_type='3'";
		$get_id="";
		if (!empty($id)){
			$get_id=" and content_id='$id'";
			$type="";
		}
            
            $sql ="	select * from content
                                where deleted_flag='0' $type $get_id
				ORDER BY content_id DESC";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
	
	function get_data_module($type=""){
            $get_type="";
	    if(!empty($type)){
		$get_type=" and content_type_why='$type'";
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