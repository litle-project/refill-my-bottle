<?php
	function get_css(){
		$this->db->select("theme");
		$query = $this->db->get("config")->result_array();

		$data["theme"]=$query[0]['theme'];
	}
?>