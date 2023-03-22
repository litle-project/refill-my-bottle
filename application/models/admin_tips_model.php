<?php
class Admin_tips_model extends CI_Model {
        function get_data($id=""){
		$type=" and content_type='4'";
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
	
	
}