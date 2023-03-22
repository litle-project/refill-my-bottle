<?php 

class Station_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get_data($longtitude,$latitude,$radius){
		//print_r($query);die();
		if(!empty($radius)){
        	$radius = intval($radius);
        }else{
        	$radius=5;	
        }
       
		$query = "SELECT *, (6371 * acos 
				( cos ( radians($latitude) )
			  * cos( radians( a.station_lat ) )
		      * cos( radians( a.station_long ) - radians($longtitude) )
		      + sin ( radians($latitude) )
		      * sin( radians( a.station_lat ) )
		    )
		  ) AS distance
		FROM station as a
		LEFT JOIN station_category as b on a.category_id = b.category_id
		-- LEFT JOIN rating as c on c.station_id = a.station_id
		-- GROUP BY a.station_id
		WHERE a.status='1'
		-- GROUP BY a.id_store_master
		HAVING distance < $radius
		ORDER BY distance
		LIMIT 0 , 20";

		$query2 = $this->db->query($query)->result_array();			
		return $query2;
	}

	function get_data_detail($store,$latitude,$longtitude){
		//print_r($query);die();
		// if(!empty($radius)){
  //       	$radius = intval($radius);
  //       }else{
  //       	$radius=5;	
  //       }
       
		// $query = "SELECT *, (6371 * acos 
		// 		( cos ( radians($latitude) )
		// 	  * cos( radians( a.station_lat ) )
		//       * cos( radians( a.station_long ) - radians($longtitude) )
		//       + sin ( radians($latitude) )
		//       * sin( radians( a.station_lat ) )
		//     )
		//   ) AS distance
		// FROM station as a
		// LEFT JOIN station_category as b on a.category_id = b.category_id
		// -- LEFT JOIN rating as c on c.station_id = a.station_id
		// -- GROUP BY a.station_id
		// WHERE a.status='1'
		// AND a.station_idn= $store
		// -- GROUP BY a.id_store_master
		
		// ORDER BY distance
		// LIMIT 0 , 20";

		 $query = "SELECT *, (6371 * acos 
                        ( cos ( radians($latitude) )
                      * cos( radians( a.station_lat ) )
                      * cos( radians( a.station_long ) - radians($longtitude) )
                      + sin ( radians($latitude) )
                      * sin( radians( a.station_lat ) )
                    )
                  ) AS distance
                FROM station as a
                LEFT JOIN station_category as b on a.category_id = b.category_id
                
                WHERE a.status='1'
                 AND a.station_id= $store
                
                
                LIMIT 0 , 20";

		$query2 = $this->db->query($query)->result_array();	

		return $query2;
	}

	function get_data_filter($longtitude,$latitude,$radius,$category_id=""){
		//print_r($query);die();
		if(!empty($radius)){
        	$radius = intval($radius);
        }else{
        	$radius=5;	
        }
       
		$query = "SELECT *, (6371 * acos 
				( cos ( radians($latitude) )
			  * cos( radians( a.station_lat ) )
		      * cos( radians( a.station_long ) - radians($longtitude) )
		      + sin ( radians($latitude) )
		      * sin( radians( a.station_lat ) )
		    )
		  ) AS distance
		FROM station as a
		LEFT JOIN station_category as b on a.category_id = b.category_id
		WHERE a.status='1'
		AND a.category_id='$category_id'
		HAVING distance < $radius
		ORDER BY distance
		LIMIT 0 , 20";

		$query2 = $this->db->query($query)->result_array();			
		return $query2;
	}
}