<?php

class Admin_model extends CI_Model {
    
        function user_group($id=""){
		$sql="select * from sliding where deleted='0'";
		
		
		
		$query=$this->db->query($sql);
		
		return $query->result_array();
	}
}