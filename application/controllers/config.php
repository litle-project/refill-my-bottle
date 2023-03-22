<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model("login_admin_model");
        $this->load->model("config_model");
	}

	public function index(){
		$data["title"]="Website Configuration";
		$data["page"]="admin_page/update";     
        $con=$this->login_admin_model->get_config();
        $data["data"]=$con->result_array();
		$this->load->view('config',$data);
	}
        
    public function admin_page(){
        if($this->input->post()){
            $post=$this->input->post();
            
            if($post["photo_status"]==1){
                $config['upload_path'] = './media/config/';
                $config['allowed_types'] = 'gif|jpg|png';
                // $config['max_size']	= '100';
                // $config['max_width']  = '1024';
                // $config['max_height']  = '768';

                $this->load->library('upload', $config);
                $this->upload->do_upload("logo");
                
                $file = $this->upload->data();
                $input["logo"]=$file["file_name"];

                $img = $post["logoold"];
                unlink(FCPATH . "media/config" ."/". $img);
            }
            if($post["loginimg_status"]==1){
                $config['upload_path'] = "assets/site/img/";
                $config['allowed_types'] = 'gif|jpg|png';
                // $config['max_size']	= '100';
                // $config['max_width']  = '1024';
                // $config['max_height']  = '768';

                $this->load->library('upload', $config);
                $this->upload->do_upload("loginimg");
                
                $file = $this->upload->data();
                $input["loginimg"]=$file["file_name"];

                $img2 = $post["loginimgold"];
                // print_r($img2); die();
                unlink(FCPATH . "assets/site/img" ."/". $img2);
            }
            $input["web_title"]=$post["web_title"];
            $input["web_name"]=$post["web_name"];
            $input["web_url"]=$post["web_url"];
            $input["footer_desc"]=$post["footer_desc"];
            $input["web_desc"]=$post["web_desc"];
            $input["theme"]=$post["theme"];
			$input["type"]=$post["type"];
                        
            $this->db->where("config_id","1");
            $this->db->update("config",$input);
        }

		$data["title"]="Website Configuration";
		$data["page"]="admin_page/update";
                
        $con=$this->login_admin_model->get_config();
        $data["data"]=$con->result_array();
		$this->load->view('config',$data);
	}
	
	
	public function home_page()
	{
                if($this->input->post()){
                    $post=$this->input->post();
                    
                    if($post["photo_status"]==1){
			
                            $config['upload_path'] = './media/config/';
                            $config['allowed_types'] = 'gif|jpg|png';
                            //$config['max_size']	= '100';
                            //$config['max_width']  = '1024';
                            //$config['max_height']  = '768';

                            $this->load->library('upload', $config);
                            $this->upload->do_upload("logo");
                            
                            $file = $this->upload->data();
                            $input["logo"]=$file["file_name"];

                    }
                    
                    
                        $input["web_title"]=$post["web_title"];
                        $input["web_name"]=$post["web_name"];
                        $input["web_url"]=$post["web_url"];
                        $input["footer_desc"]=$post["footer_desc"];
                        $input["web_desc"]=$post["web_desc"];
                        $input["theme"]=$post["theme"];
                        
                        
                        
                        $this->db->where("config_id","1");
                        $this->db->update("config",$input);
                }
		$data["title"]="Website Configuration";
		$data["page"]="admin_page/update";
                
                $con=$this->login_admin_model->get_config();
                $data["data"]=$con->result_array();
		$this->load->view('config',$data);
	}
        
        public function front_page()
	{
		$data["title"]="SEO Configuration";
		$data["page"]="front/view";
                $data["data"]=$this->config_model->get_front();
		$this->load->view('config',$data);
	}
        
        public function front_edit($id="")
	{
                if($this->input->post()){
                        $post=$this->input->post();
                        
                        $input["title"]=$post["title"];
                        $input["description"]=$post["description"];
                        $input["keyword"]=$post["keyword"];
                        $input["url"]=$post["url"];
                        $input["index_id"]=$post["index_id"];
                        
                        $this->db->where("index_id",$post["index_id"]);
                        $this->db->update("index",$input);
                        redirect("config/front_page");
                }
		$data["title"]="Value Edit";
		$data["page"]="front/edit";
                $data["data"]=$this->config_model->get_front($id);
		$this->load->view('config',$data);
	}
        
        public function front_add()
	{
                if($this->input->post()){
                        $post=$this->input->post();
                        
                        $input["title"]=$post["title"];
                        $input["description"]=$post["description"];
                        $input["keyword"]=$post["keyword"];
                        $input["url"]=$post["url"];
                        $input["index_id"]=$post["index_id"];
                        
                        $this->db->insert("index",$input);
                        redirect("config/front_page");
                }
		$data["title"]="Add New Value";
		$data["page"]="front/add";
		$this->load->view('config',$data);
	}
        
        public function front_delete($id="")
	{
                
                        $input["deleted"]="1";
                        $this->db->where("index_id",$id);
                        $this->db->update("index",$input);
                        redirect("config/front_page");
                
		
	}
	
	
	public function menu_view()
	{
		$data["title"]="Menu List";
		$data["page"]="menu/view";
                $data["data"]=$this->config_model->get_menu();
		$this->load->view('config',$data);
	}
	
	public function menu_edit($id="")
	{
                if($this->input->post()){
                        $post=$this->input->post();
                        
                        $input["menu_name"]=$post["menu_name"];
                        $input["menu_desc"]=$post["menu_desc"];
                        $input["group_menu_id"]=$post["group_menu_id"];
                        $input["menu_url"]=$post["menu_url"];
                        
                        $this->db->where("menu_id",$post["menu_id"]);
                        $this->db->update("menu",$input);
			
			$input2["menu_view"]="1";
                        $input2["menu_add"]=$post["menu_add"];
                        $input2["menu_edit"]=$post["menu_edit"];
                        $input2["menu_delete"]=$post["menu_delete"];
			$input2["menu_other"]=$post["menu_other"];
                        
                        $this->db->where("menu_id",$post["menu_id"]);
                        $this->db->update("menu_privileges",$input2);
			
                        redirect("config/menu_view");
                }
		$data["title"]="Config";
		$data["page"]="menu/edit";
                $data["data"]=$this->config_model->get_menu($id);
		$data["group"]=$this->config_model->get_menu_group();
		$this->load->view('config',$data);
	}
	
	public function menu_add()
	{
                if($this->input->post()){
                        $post=$this->input->post();
                        
                        $input["menu_name"]=$post["menu_name"];
                        $input["menu_desc"]=$post["menu_desc"];
                        $input["group_menu_id"]=$post["group_menu_id"];
                        $input["menu_url"]=$post["menu_url"];
                        
                        $this->db->insert("menu",$input);
			
			$id=$this->db->insert_id();
			$input2["menu_id"]=$id;
			$input2["menu_view"]="1";
			
			if(empty($post["menu_add"])){
				$post["menu_add"]="0";
			}
			
			if(empty($post["menu_edit"])){
				$post["menu_edit"]="0";
			}
			
			if(empty($post["menu_delete"])){
				$post["menu_delete"]="0";
			}
			
			if(empty($post["menu_other"])){
				$post["menu_other"]="0";
			}
			
                        $input2["menu_add"]=$post["menu_add"];
                        $input2["menu_edit"]=$post["menu_edit"];
                        $input2["menu_delete"]=$post["menu_delete"];
			$input2["menu_other"]=$post["menu_other"];
                        
                        $this->db->insert("menu_privileges",$input2);
			
			
			
			
                        redirect("config/menu_view");
                }
		$data["title"]="Add New Menu";
		$data["group"]=$this->config_model->get_menu_group();
		$data["page"]="menu/add";
		$this->load->view('config',$data);
	}
	
	
	public function menu_delete($id="")
	{
                
                        $input["deleted"]="1";
                        $this->db->where("menu_id",$id);
                        $this->db->update("menu",$input);
                        redirect("config/menu_view");
                
		
	}
	
	
	public function group_view()
	{
		$data["title"]="Group Menu List";
		$data["page"]="group/view";
                $data["data"]=$this->config_model->list_menu_group();
		$this->load->view('config',$data);
	}
	
	public function group_edit($id="")
	{
                if($this->input->post()){
                        $post=$this->input->post();
                        
                        $input["group_menu_name"]=$post["group_menu_name"];
                        $input["group_menu_desc"]=$post["group_menu_desc"];
                        $input["icon"]=$post["icon"];
                        
                        $this->db->where("group_menu_id",$post["group_menu_id"]);
                        $this->db->update("group_menu",$input);
			
			
			
                        redirect("config/group_view");
                }
		$data["title"]="Group Menu Edit";
		$data["page"]="group/edit";
                $data["data"]=$this->config_model->list_menu_group($id);
		
		$this->load->view('config',$data);
	}
	
	public function group_add()
	{
                if($this->input->post()){
                        $post=$this->input->post();
                        
                        $input["group_menu_name"]=$post["group_menu_name"];
                        $input["group_menu_desc"]=$post["group_menu_desc"];
                        $input["icon"]=$post["icon"];
                        
                        
                        $this->db->insert("group_menu",$input);
			
			
			
                        redirect("config/group_view");
                }
		$data["title"]="Add New Group Menu";
		
		$data["page"]="group/add";
		$this->load->view('config',$data);
	}
	
	
	public function group_delete($id="")
	{
		$input["deleted"]="1";
		$this->db->where("group_menu_id",$id);
		$this->db->update("group_menu",$input);
		redirect("config/group_view");	
	}
}
