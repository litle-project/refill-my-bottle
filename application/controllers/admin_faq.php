<?php

class Admin_faq extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model("admin_faq_model");
		$this->load->model("global_model");
		$this->load->model("Aktiviti_log_model");
	}

	public function index()
	{
		$data['title']	= "Manage FAQs";
		$data['page']	= "faq/view";
		$data['data']	= $this->admin_faq_model->get_data();

		$this->load->view('admin', $data);
	}

	function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post();

			$input['ask'] 			= $post['ask'];
			$input['answer']		= $post['answer'];
			$input['created_date']	= date("Y-m-d");
			$input['created_by']	= $this->session->userdata("admin_id");
			$input['status']		= '1';

			$this->db->insert("faq", $input);

			$action="Add New Question ".$post['ask']."and Answer ".$post['answer'];
			$this->Aktiviti_log_model->create($action);

			redirect('admin_faq');
		}

		$data['title']	= "Add New FAQs";
		$data['page']	= "faq/add";

		$this->load->view('admin', $data);
	}

	function edit($id)
	{
		if ($this->input->post()) {
			$post = $this->input->post();

			$input['ask'] 			= $post['ask'];
			$input['answer']		= $post['answer'];
			$input['created_date']	= date("Y-m-d");
			$input['created_by']	= $this->session->userdata("admin_id");
			$input['status']		= '1';

			$this->db->where("faq_id", $id);
			$this->db->update("faq", $input);

			$action="Edit Question ".$post['ask']."and Answer ".$post['answer'];
			$this->Aktiviti_log_model->create($action);

			redirect('admin_faq');
		}

		$data['title']	= "Add New FAQs";
		$data['page']	= "faq/edit";
		$data['data']	= $this->admin_faq_model->get_data($id);


		$this->load->view('admin', $data);
	}

	function delete($id)
	{
		$this->global_model->delete_data($id, 'faq_id', 'faq');

		$action="Delete Question With ID ".$id;
		$this->Aktiviti_log_model->create($action);

		redirect("admin_faq");
	}
}