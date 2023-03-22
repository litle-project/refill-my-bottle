<?php
	error_reporting(0);
class Category extends CI_Controller{
	
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
		$this->db->order_by("a.category_name","asc");
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		$query=$this->db->get("category a");
		$hasil_query=$query->result_array();
		
		if(!empty($hasil_query)){
			
			$i=0;
			foreach ($hasil_query as $row){
							
				$data[$i]["CATEGORY_ID"]=$row["category_id"];
				$data[$i]["CATEGORY_NAME"]=$row["category_name"];
				$data[$i]["CATEGORY_DESC"]=$row["category_desc"];
				$data[$i]["CATEGORY_ICON"]=base_url()."media/category/".$row["category_icon"];
				
				
				$i++;
			}
			
			$all["CATEGORY_LIST"]=$data;
		}else{
			$all=array();
		}
		
		echo json_encode($all);
    }
	
}
