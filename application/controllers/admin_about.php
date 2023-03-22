<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_about extends CI_Controller {
        
        
        public function __construct(){
		parent :: __construct();
		$this->load->model('admin_about_model');
		$this->load->model("global_model");
		$this->load->model('Aktiviti_log_model');
                //$this->load->model('files_model');
		$link=$this->uri->segment(2);
		if(empty($link))
		{
			$link="view";
		}
		
		if($link=="save"){
			$link="add";
		}
		
		if($link=="update"){
			$link="edit";
		}
		
		priv($link);
	}
        
	public function index()
	{
        if($this->input->post()){

            $post=$this->input->post();
			$config['image_library'] = 'gd2';
            $config['upload_path'] = './media/about/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['max_size']   = '2048';
            // $config['max_width']  = '1024';
            // $config['max_height']  = '768';

            $this->load->library('upload', $config);

	            if ($this->upload->do_upload("image_utama")){

	                $file = $this->upload->data();
	                $image						= $file['file_name'];
	                $input						= $file['file_name'];
	       
					$this->load->library('image_lib');
					$config2['image_library'] = 'gd2';
					$config2['source_image'] = './media/about/'.$image.'';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 400;
					$config2['height'] = 400;
					$config2['new_image'] 	= './media/about/image_resize/low_'.$image;

					$this->image_lib->clear(); // added this line
		       		$this->image_lib->initialize($config2); // added this line
		       		$this->image_lib->resize();
	            
	            }else{
	            	$image = $this->global_model->get_data("*","content","where content_id='1'")->result_array();
		            $input = $image[0]["image_utama"];
		            // return false;
	        	}



        	// print_r($this->sesion->id); die();
            $content=array(
            	// "content_id"		=> $post["content_id"],
                "content_type"		=> "0",
                "content_title_1"	=> $post['content_title_1'],
            	"content_title_2"	=> $post['content_title_2'],
            	"content_title_3"	=> $post['content_title_3'],
            	"content_1"			=> $post['content_1'],
            	"content_2"			=> $post['content_2'],
            	"content_3"			=> $post['content_3'],
            	"image_convert"		=> "low_".$image,
            	"image_utama"		=> $input,
                "created_date"		=> date("Y-m-d H:i:s"),
                "created_by"		=> $this->session->userdata("admin_id"),
            );
            $this->db->where("content_id", $post["content_id"]);
            $this->db->update("content", $content);
            
            $action="Update About Content " . $post['content_title_1'];
            $this->Aktiviti_log_model->create($action);
        }
        $data["data"] = $this->admin_about_model->get_data();
        $data["tukar"] = $this->global_model->get_data("*","about_us","where status ='1'")->result_array();
        // print_r($data["data"]); die();
		$data["page"]="about/view";
		$data["title"]="Manage About";
		$this->load->view('admin',$data);
	}
        
        
}

