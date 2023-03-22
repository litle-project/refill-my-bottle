<?php
error_reporting(0);
class Place extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		//$this->load->model("api_model/place_model");
	}
	
	function get_data(){       
		
		$product_id=$this->input->get_post("PRODUCT_ID");		
		$category_id=$this->input->get_post("CATEGORY_ID");		
		$limit = $this->input->get_post("LIMIT");
		$offset = $this->input->get_post("OFFSET");
		
		$this->db->select("*");
		$this->db->join("category b","a.category_id=b.category_id","left");
		if(!empty($product_id)){				
			$this->db->where("a.product_id",$product_id);
		}
		if(!empty($category_id)){				
			$this->db->where("a.category_id",$category_id);
		}
		$this->db->order_by("a.product_name","asc");
		if($limit !="" OR $offset !=""){
			$this->db->limit($limit,$offset);
		}
		
			$this->db->where("a.deleted","0");
		
		$query=$this->db->get("product a");
		$hasil_query=$query->result_array();
		
		if(!empty($hasil_query)){
			
			$i=0;
			foreach ($hasil_query as $row){
			
				$data[$i]["PRODUCT_ID"]=$row["product_id"];
				$data[$i]["CATEGORY_ID"]=$row["category_id"];
				$data[$i]["CATEGORY"]=$row["category_name"];
				$data[$i]["PRODUCT_NAME"]=$row["product_name"];				
				$data[$i]["PRODUCT_IMAGE_LIST"]=base_url()."media/product/".$row["product_image_list"];  
				$data[$i]["PRODUCT_DESC"]=$row["product_desc"];
			
			
				$this->db->select("*");
				$this->db->where("product_id",$row["product_id"]);
				$this->db->where("deleted","0");
				$query_image=$this->db->get("product_image");
				
				$image_array=$query_image->result_array();
				$data[$i]["MAIN_IMAGE_LOW"]=base_url()."media/product/low/".$image_array[0]["product_image_link"];
				$data[$i]["MAIN_IMAGE_HIGH"]=base_url()."media/product/".$image_array[0]["product_image_link"];
				
				if($query_image->result_array()){  
					$no=0;
					foreach($query_image->result_array() as $db_image){
							$image[$no]["IMAGE_ID"]=$db_image["product_image_id"];
							$image[$no]["IMAGE_LOW"]=base_url()."media/product/low/".$db_image["product_image_link"];
							$image[$no]["IMAGE_HIGH"]=base_url()."media/product/".$db_image["product_image_link"];
							$image[$no]["IMAGE_SLIDER"]=base_url()."media/product/slider/".$db_image["product_image_link"];
						
						$no++;
					}
					
					$data[$i]["DETAIL_IMAGE"]=$image;
				}else{
					$data[$i]["DETAIL_IMAGE"]=array();
				}
				
				$i++;
			}
			
			$all["PRODUCT_LIST"]=$data;
		}else{
			$all["PRODUCT_LIST"]=array();
		}
		
		echo json_encode($all);
    }
	
}
