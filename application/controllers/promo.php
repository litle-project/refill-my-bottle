<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Promo extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("global_model");
		$page=$this->uri->segment(2);
		
		if($page=='') priv('view');
		else if(($page=='add') or ($page=='save')) priv('add');
		else if(($page=='edit') or ($page=='update')) priv('edit');
		else if($page=='delete') priv('delete');
		else  priv('other');
		
	}
	

	public function index(){
		
		$data["data"] 	= $this->global_model->get_data_join("*","promo_list a","where a.status='1'", "left join station as b on b.station_id = a.station_id")->result_array();
		$data["page"]	= "promo/view";
		$data["title"]	= "Manage Promo";

		$this->load->view('admin',$data);
	}
	
	  function add(){
		
	    		
		$data["page"]	= "promo/add";
		$data["title"]	= "Add New Promo";
		$data["data"]	= $this->global_model->get_data("*", "station", "where status='1'")->result_array();		
		
		$this->load->view('admin',$data);
		
		if($this->input->post()){
			$post=$this->input->post();
			// print_r($post); die();
			$config['upload_path'] = './media/promo/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '100';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("promo_image"))
			{
				// $error = array('error' => $this->upload->display_errors());
				// print_r("<pre>");
				// print_r($error);
				// print_r("</pre>");
				// $this->load->view('upload_form', $error);
				// redirect("promo/add");
				$date_exp = explode("-", $post['expired']);
				$result1 = date("Y-m-d", strtotime($date_exp[0]));				
				$result2 = date("Y-m-d", strtotime($date_exp[1]));				
				$input	= array(
							"promo_name" 	=> $post["promo_name"],
							"station_id"	=> $post["station_id"],
							"start_date"	=> $result1,
							"end_date"		=> $result2,
							"transaction"	=> $post["transaction"],
							"promo_desc" 	=> $post["promo_desc"],						
							"terms" 		=> $post["terms"],						
							"promo_image" 	=> "default_refill.jpeg",						
							"created_date" 	=> date("Y-m-d H:i:s"),
							"created_by" 	=> $this->session->userdata("admin_id"),
							);
						
				$this->db->insert("promo_list", $input);
				
				// input log
				$action="Create Promo ".$post["promo_name"];
				$this->Aktiviti_log_model->create($action);
			}
			else
			{
				$file 	= $this->upload->data();
				$date_exp = explode("-", $post['expired']);
				$result1 = date("Y-m-d", strtotime($date_exp[0]));				
				$result2 = date("Y-m-d", strtotime($date_exp[1]));				
				$input	= array(
							"promo_name" 	=> $post["promo_name"],
							"station_id"	=> $post["station_id"],
							"start_date"	=> $result1,
							"end_date"		=> $result2,
							"transaction"	=> $post["transaction"],
							"promo_desc" 	=> $post["promo_desc"],						
							"terms" 		=> $post["terms"],						
							"promo_image" 	=> $file["file_name"],						
							"created_date" 	=> date("Y-m-d H:i:s"),
							"created_by" 	=> $this->session->userdata("admin_id"),
							);
						
				$this->db->insert("promo_list", $input);
				
				// input log
				$action="Create Promo ".$post["promo_name"];
				$this->Aktiviti_log_model->create($action);
			}
			
			
			redirect("promo");
		}		
	}

	public function detail($id)
	{
		
	    
		$data["data"]	= $this->global_model->get_data_join("*","promo_list a","where a.promo_id='".$id."'","left join station as b on b.station_id = a.station_id")->result_array();
		// echo "<pre>"; print_r($data['data']); die();		
		$data["page"]	= "promo/detail";
		$data["title"]	= "Promo Detail";

		$this->load->view('admin',$data);
	}
	
	public function edit($id)
	{
		$data["data"] 		= $this->global_model->get_data_join("*","promo_list a","where a.promo_id='".$id."'", "left join station as b on b.station_id = a.station_id")->result_array();
		// echo"<pre>"; print_r($data['data']); die();
		$data["station"] 	= $this->global_model->get_data("*", "station", "where status ='1'")->result_array();
		$data["page"]		= "promo/edit";
		$data["title"]		= "Edit Promo";

		$this->load->view('admin',$data);

		if($this->input->post()){
			$post=$this->input->post();
			// print_r($post); die();
			$config['upload_path'] = './media/promo/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_size']	= '100';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';

			$this->load->library('upload', $config);
			$image_global = $this->global_model->get_data("*", "promo_list", "where promo_id ='".$id."'")->result_array();

			$date_exp = explode("-", $post['expired']);
			$result1 = date("Y-m-d", strtotime($date_exp[0]));				
			$result2 = date("Y-m-d", strtotime($date_exp[1]));				
			$input	= array(
						"promo_name" 	=> $post["promo_name"],
						"station_id"	=> $post["station_id"],
						"start_date"	=> $result1,
						"end_date"		=> $result2,
						"transaction"	=> $post["transaction"],
						"promo_desc" 	=> $post["promo_desc"],						
						"terms" 		=> $post["terms"],						
						"promo_image" 	=> $file["file_name"],						
						"created_date" 	=> date("Y-m-d H:i:s"),
						"created_by" 	=> $this->session->userdata("admin_id"),
						);

			if($this->upload->do_upload("promo_image"))
			{
				$file 	= $this->upload->data();
				$input['promo_image'] = $file['file_name'];
			}
			else
			{
				$input['promo_image'] = $image_global[0]['promo_image'];
			}
			
			$this->db->where("promo_id", $id);
			$this->db->update("promo_list", $input);
			
			// input log
			$action="Create Promo ".$post["promo_name"];
			$this->Aktiviti_log_model->create($action);

			
				redirect('promo');
		}
	}
	
	function delete($id){
		
		 
		$this->global_model->delete_data($id, 'promo_id', 'promo_list');
		redirect("promo");
	}
	
	function image_resize($image){
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = './media/user/'.$image.'';
			$config2['new_image'] = './media/user/low/'.$image.'';
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = FALSE;
			$config2['width'] = 400;
			$config2['height'] = 400;

			$this->load->library('image_lib', $config2);
			$this->image_lib->initialize($config2);

			if ( ! $this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
			}
	}
}

