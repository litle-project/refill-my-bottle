<?php

class Station_master extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('global_model');
		$this->load->model('Aktiviti_log_model');
		$this->load->model('station_model');
		$this->load->library('excel');
	}

	public function index($id='')
	{
		$data['title']	= "Manage Station";
		$data['page'] 	= "station/view";
		$data['data']	= $this->global_model->get_data("*","station", "where status ='1'")->result_array();
		// $data['rating']	= $this->global_model->get_data("*","log_refill", "where status ='1'")->result_array();
		// $data['data']	= $this->station_model->get_data();
		// echo "<pre>"; print_r($data['uniq']); die();
		// foreach ($data['data'] as $key) {
		// 	echo $key['rating'];
		// }

		// die();

		$this->load->view('admin', $data);
	}

	function detail($id)
	{
		$data['title']		= "Detail Station";
		$data['page'] 		= "station/detail";
		$data['data']		= $this->global_model->get_data("*","station","where station_id='".$id."'")->result_array();
		$data['category']	= $this->global_model->get_data("*","station_category", "where status ='1'")->result_array();
		$data['type']		= $this->global_model->get_data("*","type_of_station", "where status ='1'")->result_array();
		$data['type_water']	= $this->global_model->get_data("*","type_of_water", "where status ='1'")->result_array();
		$data['rate']		= $this->global_model->get_data("*","rating","where station_id='".$id."'")->result_array();
		// echo "<pre>"; print_r($data['rate']); die();
		
		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();

			// $uniq_id						= explode("-", $post['uniq_id']);
			$input['station_name'] 			= $post['station_name'];
			$input['category_id']			= $post['category_id'];
			$input['type_id']				= $post['type_id'];
			$input['type_water_id']			= $post['type_water_id'];
			$input['station_desc']			= $post['station_desc'];
			$input['station_address']		= $post['station_address'];
			$input['station_lat']			= $post['lat'];
			$input['station_long']			= $post['long'];
			$input['station_phone']			= $post['station_phone'];
			$input['station_open_hour']		= $post['open'];
			$input['station_close_hour']	= $post['close'];
			$input['opening_days']			= implode(',', $this->input->post('opening_days',TRUE));
			$input['fb_id']					= $post['fb_id'];
			
				if (!empty($post['website'])) {
					$input['website']			= $post['website'];
				}else{
					$input['website']			= "";
				}

				if (!empty($post['station_point'])) {
					
					$input['station_point']			= $post['station_point'];
					$input['general_point']			= '0';

				}else{

					$input['station_point']			= 10;
					$input['general_point']			= '1';
				}
			
			$input['cost']					= $post['cost'];
			$input['station_address']		= $post['station_address'];
			$input['station_tag']			= $post['station_tag'];
			$input['uniq_id']				= $post['uniq_id'];
			// $input['uniq_id']				= $uniq_id[1];
			// $input['uniq_name']				= "RMB";
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';

			// echo "<pre>"; print_r($input); die();


			$config['upload_path']  		= './media/station/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);

            if($this->upload->do_upload('station_image'))
            {
                $file = $this->upload->data();
                $input['station_image']		= $file['file_name'];

            }

            else {
                $input['station_image']		= 'default_refill.jpeg';
        	}

        	// echo "<pre>"; print_r($input); die();
			$this->db->insert("station", $input);

			$action="Add New Station " .$post['station_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('station_master');
		}

		$data['title']	= "Add New Station";
		$data['page'] 	= "station/add";
		$data['data']	= $this->global_model->get_data("*","station_category","where status='1'")->result_array();
		$data['type']	= $this->global_model->get_data("*","type_of_station","where status='1'")->result_array();
		$data['type_water']	= $this->global_model->get_data("*","type_of_water", "where status ='1'")->result_array();
		$data['uniq']	= $this->global_model->get_data("*, MAX(uniq_id) as uniq", "station", "where status ='1'")->result_array();

		// echo "<pre>"; print_r($data['uniq']); die();
		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($this->input->post()); die();
			$data	= $this->global_model->get_data("*","station","where station_id='".$id."'")->result_array();
			// $input['uniq_name'] 			= "RMB";
			$input['uniq_id'] 				= $post['uniq_id'];
			$input['station_name'] 			= $post['station_name'];
			$input['category_id']			= $post['category_id'];
			$input['type_id']				= $post['type_id'];
			$input['type_water_id']			= $post['type_water_id'];
			$input['station_desc']			= $post['station_desc'];
			$input['station_address']		= $post['station_address'];
			$input['station_lat']			= $post['lat'];
			$input['station_long']			= $post['long'];
			$input['station_phone']			= $post['station_phone'];
			$input['station_open_hour']		= $post['open'];
			$input['station_close_hour']	= $post['close'];
			$input['opening_days']			= implode(',', $this->input->post('opening_days',TRUE));
			$input['fb_id']					= $post['fb_id'];
				if (!empty($post['general_point'])) {
					
					$input['station_point']			= $post['station_point'];
					$input['general_point']			= '0';

				}else{

					$input['station_point']			= 10;
					$input['general_point']			= '1';
				}
			$input['cost']					= $post['cost'];
			$input['station_address']		= $post['station_address'];
			$input['station_tag']			= $post['station_tag'];
			$input['created_date']			= date("Y-m-d");
			$input['created_by']			= $this->session->userdata("admin_id");
			$input['status']				= '1';
			$config['upload_path']  		= './media/station/';
            $config['allowed_types']  		= 'jpg|jpeg|png';

            $this->load->library('upload', $config);

            if($this->upload->do_upload('station_image'))
            {
                $file = $this->upload->data();
                $input['station_image']		= $file['file_name'];

            }

            else
            {
            	$input['station_image'] = $data[0]['station_image'];
        	}

        	// echo "<pre>"; print_r($input); die();
			$this->db->where("station_id", $id);
			$this->db->update("station", $input);

			$action="Edit Station " .$post['station_name'];
            $this->Aktiviti_log_model->create($action);

			redirect('station_master');
		}

		$data['title']		= "Edit New Station";
		$data['page'] 		= "station/edit";
		$data['data']		= $this->global_model->get_data("*","station","where station_id='".$id."'")->result_array();
		$data['category']	= $this->global_model->get_data("*", "station_category", "where status = '1'")->result_array();
		$data['type_water']	= $this->global_model->get_data("*","type_of_water", "where status ='1'")->result_array();
		$data['type']		= $this->global_model->get_data("*", "type_of_station", "where status = '1'")->result_array();
		// echo "<pre>"; print_r($data['data']); die();


		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'station_id', 'station');

		$action="Delete Station With Id" .$id;
        $this->Aktiviti_log_model->create($action);

		redirect("station_master");
	}

	public function import()
	{
		priv('add');
		//echo "here";
		if($this->input->post()){
		    // $fileName = $_FILES['import']['name'];
            // $config['upload_path'] = "./media/contract/";
      //       $config['file_name'] = $fileName;
      //       $config['allowed_types'] = '*';
      //       $config['max_size']      = 10000;

      //       $this->load->library('upload');
      //       $this->upload->initialize($config);

      //       if(! $this->upload->do_upload('import') )
      //           $this->upload->display_errors();

            // $media = $this->upload->data('import');
            $config['upload_path'] = './assets/file/station/';
            $config['allowed_types'] = "*";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);		

		    $file="import";
            if ( ! $this->upload->do_upload($file)){
                print_r($this->upload->display_errors());
                $image 	= "sample.xlsx";
            }else{
                $name 	= $this->upload->data($file);
                $image 	= $name['file_name'];
            }           
            $inputFileName = './assets/file/station/'.$image;
            // echo $inputFileName; die();
            $objReader 		= PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel 	= $objReader->load($inputFileName);
            $sheetData 		= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

            // echo "<pre>";
            // print_r($sheetData);
            // die();

            if(count($sheetData)>1) {
            	foreach ($sheetData as $row) {
            		if(!empty($row["A"])){
            			if ($row != $sheetData[1]) {
            				$input["uniq_id"] 			= $row["A"];
            				$input["station_name"] 		= $row["B"];
            				$input["category_id"] 		= $row["C"];
            				$input["type_id"] 			= $row["D"];
            				$input["type_water_id"] 	= $row["E"];
            				$input["station_address"] 	= $row["F"];
            				$input["station_desc"] 		= $row["G"];

            				if (!empty($row["H"])) {
            					$input['station_lat'] 	= $row["H"];
            				}else{
            					$input['station_lat']	= "-8.416339099788033";
            				}
            				// space
            				if (!empty($row["I"])) {
            					$input['station_long'] 	= $row["I"];
            				}else{
            					$input['station_long'] 	= "115.17376840625002";
            				}

            				$input["station_phone"] 	= $row["J"];

            				if (!empty($row["K"])) {
	            				$input["station_point"] = $row["K"];
	            				$input["general_point"] = "0";
            				}else{
            					$input["station_point"] = 10;
	            				$input["general_point"] = "1";
            				}

            				$input["cost"]		 		= $row["L"];
            				$input["station_open_hour"] = $row["M"];
            				$input["station_close_hour"]= $row["N"];
            				$input["opening_days"] 		= $row["O"];
            				$input["fb_id"] 			= $row["P"];
            				$input["website"] 			= $row["Q"];
            				$input["station_tag"] 		= $row["R"];
            				$input["created_date"] 		= date("Y-m-d H:i:s");
            				$input["created_by"] 		= $this->session->userdata("admin_id");
            				$input["status"] 			= "1";

            				// echo "<pre>"; print_r($input); die();
            				$this->db->insert("station", $input);

				            $action="Add New Station With Import Excel " .$row['A'];
				            $this->Aktiviti_log_model->create($action);
            			}
            			
            		}
            	}
            }


            redirect("station_master");
		}
		$data["image_sample"]	=	"sample.PNG";
		$data["excel_sample"]	=	"sample.xlsx";
		$data["control"]		=	"Contract";
		$data["page"]			=	"station/excel";
		$data["title"]			=	"Add New Station";
		$this->load->view('admin',$data);
	}

}