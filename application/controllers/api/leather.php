<?php
error_reporting(0);
class Leather extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		//$this->load->model("api_model/place_model");
	}
	
	function get_data(){       
		
		$leather_id=$this->input->get_post("LEATHER_ID");		
		$leather_category_id=$this->input->get_post("LEATHER_CATEGORY_ID");		
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
		
		$this->db->select("*");
		$this->db->join("leather_category b","a.leather_category_id=b.leather_category_id","left");
		if(!empty($leather_id)){				
			$this->db->where("a.leather_id",$leather_id);
		}
		if(!empty($leather_category_id)){				
			$this->db->where("a.leather_category_id",$leather_category_id);
		}
		$this->db->order_by("a.leather_name","desc");
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
			$this->db->where("a.deleted","0");
		
		$query=$this->db->get("leather a");
		$hasil_query=$query->result_array();
		
		if(!empty($hasil_query)){
			
			$i=0;
			foreach ($hasil_query as $row){
			
				$data[$i]["LEATHER_ID"]=$row["leather_id"];
				$data[$i]["LEATHER_CATEGORY_ID"]=$row["leather_category_id"];
				$data[$i]["CATEGORY"]=$row["leather_category_name"];
				$data[$i]["LEATHER_NAME"]=$row["leather_name"];				
				$data[$i]["LEATHER_IMAGE_LIST"]=base_url()."media/product/".$row["leather_image_list"];  
				$data[$i]["LEATHER_DESC"]=$row["leather_desc"];
			
			
				$this->db->select("*");
				$this->db->where("leather_id",$row["leather_id"]);
				$this->db->where("deleted","0");
				$query_image=$this->db->get("leather_image");
				
				$image_array=$query_image->result_array();
				$data[$i]["MAIN_IMAGE_LOW"]=base_url()."media/product/low/".$image_array[0]["leather_image_link"];
				$data[$i]["MAIN_IMAGE_HIGH"]=base_url()."media/product/".$image_array[0]["leather_image_link"];
				
				if($query_image->result_array()){  
					$no=0;
					foreach($query_image->result_array() as $db_image){
						
							$image[$no]["IMAGE_LOW"]=base_url()."media/product/low/".$db_image["leather_image_link"];
							$image[$no]["IMAGE_HIGH"]=base_url()."media/product/".$db_image["leather_image_link"];
							$image[$no]["IMAGE_SLIDER"]=base_url()."media/product/slider/".$db_image["leather_image_link"];
						
						$no++;
					}
					
					$data[$i]["DETAIL_IMAGE"]=$image;
				}else{
					$data[$i]["DETAIL_IMAGE"]=array();
				}
				
				$i++;
			}
			
			$all["LEATHER_LIST"]=$data;
		}else{
			$all["LEATHER_LIST"]=array();
		}
		
		echo json_encode($all);
    }
	
}
