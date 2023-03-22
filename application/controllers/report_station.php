<?php

class Report_station extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');
		$this->load->model('report_model');
		// $this->load->library('pdfmyurl');
	}

	public function index()
	{
		$pdf = $this->input->get('pdf');

		$data['title']		= "Report Station List";
		$data['page'] 		= "report/station_master";
		$data['type']		= $this->global_model->get_data('*', 'type_of_station', 'where status = "1"')->result_array();
		$data['category']	= $this->global_model->get_data('*', 'station_category', 'where status = "1"')->result_array();
		
		$data['data']	= $this->global_model->get_data_join("*, COUNT(a.station_id) as total", "transaction a", "group by a.station_id", "left join station as b on b.station_id = a.station_id left join station_category as c on c.category_id = b.category_id left join type_of_station as d on d.type_id = b.type_id")->result_array();
		
		$this->load->view('admin', $data);
	}

	public function filter_date()
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($post); die();

			if (!empty($post['date'])) {
				$explode_date = explode(" - ", $post['date']);
				$date_1 	= $explode_date[0]; //start date
				$date_2 	= $explode_date[1]; // end date
				$start_date = date("Y-m-d", strtotime($date_1));
				$end_date 	= date("Y-m-d", strtotime($date_2));
	
				$data['data']	= $this->report_model->get_data($start_date, $end_date);
				$data['date1'] = $start_date;
				$data['date2'] = $end_date;
			}

			if (!empty($post['station_name'])) {
				$station_name 	= $post['station_name'];
				$data['data']	= $this->report_model->get_data_name($station_name);
				$data['name']	= $station_name;
				// echo "<pre>"; print_r($data['data']); die();	
			}

			if (!empty($post['station_type'])) {
				$station_type 	= $post['station_type'];
				$data['data']	= $this->report_model->get_data_type($station_type);
				$data['station_type']	= $station_type;
				// echo "<pre>"; print_r($data['station_type']); die();
			}

			$data['data'] = $data['data'];
		}


		$data['title']		= "Report Station List";
		$data['page'] 		= "report/station_filter";
		$data['type']		= $this->global_model->get_data('*', 'type_of_station', 'where status = "1"')->result_array();
		$data['category']	= $this->global_model->get_data('*', 'station_category', 'where status = "1"')->result_array();
		


		$pdf 	= $this->input->get('pdf');
		$date1 	= $this->input->get('date1');
		$date2 	= $this->input->get('date2');
		$name  	= $this->input->get('name');
		$type  	= $this->input->get('type');

		if (($pdf)) {
			if (!empty($date1) && !empty($date2)) {
				$print['data']		= $this->report_model->get_data($date1, $date2);
				$print['title']		= "Report Station List";
	            $this->SavePdf($print);
			}elseif(!empty($name)){
				$print2['data']		= $this->report_model->get_data_name($name);
				$print2['title']	= "Report Station List";
	            $this->SavePdf($print2);
			}elseif(!empty($type)){
				$print3['data']		= $this->report_model->get_data_type($type);
				$print3['title']	= "Report Station List";
	            $this->SavePdf($print3);
			}
		redirect('report_station');
        }
		$this->load->view('admin', $data);
	}

	public function SavePdf($all_data = array())
	{
		$this->load->library('pdf_exporter', '', 'pdf');
        $view = $this->load->view('admin/report/save_report_station', $all_data, TRUE);
        // print_r($view);die();
        $this->pdf->output_pdf($view, $all_data["title"] . '.pdf');
	}

	public function add()
	{
		$data['title']	= "Manage Impact";
		$data['page'] 	= "impact/add";
		$data['data']	= $this->global_model->get_data("*","impact","where status='1'")->result_array();
		// print_r($data['data']); die();
		$this->load->view('admin', $data);

		if ($this->input->post()) {
			$post = $this->input->post();
			// echo "<pre>"; print_r($post); die();

			$input['impact_total'] 		= $post['impact_total'];
			$input['impact_desc']		= $post['impact_desc'];
			$input['status']			= '1';
			$input['update_date']		= date("Y-m-d H:i:s");
			$input['update_by']			= $this->session->userdata("admin_id");
			$config['upload_path']  	= './media/impact/';
            $config['allowed_types']  	= 'jpg|jpeg|png';

            $this->load->library('upload', $config);
			$impact	= $this->global_model->get_data("*","impact","where impact_id='".$post['impact_id']."'")->result_array();
				
				
            if($this->upload->do_upload('impact_image'))
            {
                $file = $this->upload->data();
                $input['impact_image']		= $file['file_name'];

            }

            else {
            	$input['impact_image']		= $impact[0]['impact_image'];
        	}

			$this->db->where("impact_id", $post['impact_id']);
			$this->db->update("impact", $input);

			$action="Change Impact Total " .$post['impact_total'];
            $this->Aktiviti_log_model->create($action);

			redirect('impact');
		}
	}
}