<?php 
class Privileges extends CI_Model {
	
	function user_priv()
	{
		$priv=$this->session->userdata("user_group_id");
		//$priv=1;
				
				$sql="select * from group_menu as a
						INNER JOIN menu as b ON b.group_menu_id = a.group_menu_id
						INNER JOIN user_privileges as c ON c.menu_id=b.menu_id
						WHERE a.deleted='0'
						AND c.user_group_id='".$priv."'
						AND c.menu_view='1'
						GROUP BY a.group_menu_id
						
						";
						
				//echo $sql;
				$query=$this->db->query($sql);
				
				foreach($query->result_array() as $row){
					$sql2="select * from menu as a
							INNER JOIN user_privileges as b ON b.menu_id=a.menu_id
							where a.deleted='0' 
							AND a.group_menu_id='".$row['group_menu_id']."'
							AND b.user_group_id='".$priv."'
							AND b.menu_view='1'
							
							ORDER BY a.list ASC
							";
					$query2=$this->db->query($sql2);
					$row["menu"]=$query2->result_array();
					$menu[]=$row;
				}
				
				return $menu;
		
		
	}
	
}
