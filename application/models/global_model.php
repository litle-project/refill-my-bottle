<?php

class Global_model extends CI_Model {
	
	function get_dropdown($table, $where,$id ,$view ){
		$query = 'SELECT * FROM '.$table.' '.$where;
		$hasil=$this->db->query($query);
		$data[""]=" -- Select -- ";	
		foreach($hasil->result_array() as $row){
			$data["".$row[$id].""]=$row[$view];
		}
        return $data;
	}
	
	function get_data($select, $table, $where){       
        $query = 'SELECT '.$select.' FROM '.$table.' '.$where;
        return $this->db->query($query);
    }
	
	function get_data_join($select, $table, $where, $join){       
        $query = 'SELECT '.$select.' FROM '.$table.' '.$join.' '.$where;
        return $this->db->query($query);
    }
  
 function save_data($data, $table){
        $return = FALSE;
        if ($this->db->insert($table, $data)){
            $return = TRUE;
        }
         
        return $return;
    }
  
 function update_data($id, $field, $data, $table){
        $return = FALSE;
        $this->db->where($field, $id);
        if ($this->db->update($table, $data)){
            $return = TRUE;
        }
         
        return $return;
    }
  
 function delete_data($id, $field, $table){
        $return = FALSE;
		$data=array(
			"status"=>"0"
		);
        $this->db->where($field, $id);
        if ($this->db->update($table,$data)){
            $return = TRUE;
        }
         
        return $return;
    }
	
}