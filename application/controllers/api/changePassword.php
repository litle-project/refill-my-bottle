<?php
	class ChangePassword extends CI_Controller {
	    public function __construct(){
			parent :: __construct();
			
		}

		public function index() {
			$url = site_url('/api/member_log/check_hash');
			$MEMBER_ID = $this->input->get_post("id");
			$HASH = $this->input->get_post("hash");

			$post = array("MEMBER_ID"=>$MEMBER_ID, "HASH"=>$HASH);

			$data['check'] = $this->get_api->post_api_data($url,$post,"");

			// print_r($data["check"]);die();

			if($data['check']['STATUS'] != "FAILED"){
				$this->load->view('changePassword');
			} else {
				// echo "sorry, your activation for reset password unavailable";
		$this->load->view("unsuccessChangePass");
		echo  "<script type='text/javascript'>";
	    echo "window.alert('sorry, your activation for reset password unavailable');";
	    echo "</script>";
			}
		}

		public function successChangePass(){
			$this->load->view("successChangePass");
		}

		public function changePasswordSubmit(){
			$url = site_url('/api/member_log/res_pass');
			$post = $this->input->post();

			$data['changePassword'] = $this->get_api->post_api_data($url,$post,"");

			// $data['url'] = $data['changePassword']['DATA']['url'];

			if($data['changePassword']['STATUS'] == "SUCCESS"){
				$this->session->set_flashdata("success", "1");
			} else {
				$this->session->set_flashdata("success", "1");
			}

			$_SESSION['success_change'] =  $data['url'];
			

			header("location:".base_url()."api/changePassword/successChangePass");
			// $this->load->view('successChangePass', $data);
		}

		// public function changePasswordSubmit2(){
		// 	$urle = $GLOBALS['URL']."/api/member/get_email";
		// 	$poste = array(
		// 		"MEMBER_ID"=>$this->input->post("MEMBER_ID")
		// 	);
		// 	$data["getEmail"] = $this->get_api->post_api_data($urle,$poste,"");

		// 	// echo "<pre>";
		// 	// print_r($post);
		// 	// echo "</pre>";

		// 	// echo "<pre>";
		// 	// print_r($data["getEmail"]["DATA"]["member_email"]);
		// 	// echo "</pre>";die();

		// 	$url = $GLOBALS['URL_TOLLARS']."/api/member_corp/change_pass";
		// 	$post = array(
		// 			"PARTNER_ID"=>$GLOBALS['ID_PATNER_TOLLARS'],
		// 			"MEMBER_EMAIL"=>$data["getEmail"]["DATA"]["member_email"],
		// 			"NEW_PASSWORD"=>$this->input->post("PASSWORD1")
		// 		);
		// 	$header = array(
		// 		"APP_TOKEN: clabstollars"
		// 	);  

		// 	$data['changePassword'] = $this->get_api->post_api_data3($url,$post,$header);


		// 	if($data['changePassword']['STATUS'] == "SUCCESS"){
		// 		$this->session->set_flashdata("success", "1");
		// 	} else {
		// 		$this->session->set_flashdata("success", "1");
		// 	}

		// 	header("location:".base_url()."changePassword/successChangePass");
		// 	// $this->load->view('successChangePass', $data);
		// }
	}
?>	