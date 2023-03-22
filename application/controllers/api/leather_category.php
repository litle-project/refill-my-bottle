<?php
	error_reporting(0);
class Leather_category extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		//$this->load->model("api_model/place_model");
	}
	
	function get_data(){       
		
		//$id=$this->input->get_post("PLACE_ID");		
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
		
		$this->db->select("*");
		$this->db->where("a.deleted","0");
		$this->db->order_by("a.leather_category_name","asc");
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		$query=$this->db->get("leather_category a");
		$hasil_query=$query->result_array();
		
		if(!empty($hasil_query)){
			
			$i=0;
			foreach ($hasil_query as $row){
							
				$data[$i]["LEATHER_CATEGORY_ID"]=$row["leather_category_id"];
				$data[$i]["LEATHER_CATEGORY_NAME"]=$row["leather_category_name"];
				$data[$i]["LEATHER_CATEGORY_DESC"]=$row["leather_category_desc"];
				$data[$i]["LEATHER_CATEGORY_ICON"]=base_url()."media/category/".$row["leather_category_icon"];
				
				
				$i++;
			}
			
			$all["CATEGORY_LIST"]=$data;
		}else{
			$all=array();
		}
		
		echo json_encode($all);
    }
	
}
