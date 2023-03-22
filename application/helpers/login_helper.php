<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function priv($text){
	$CI =& get_instance();
	$user_group_id=$CI->session->userdata('user_group_id');
	$text="a.menu_".$text;
	
	$sql = "select * from user_privileges as a
			INNER JOIN menu as b ON b.menu_id=a.menu_id
			WHERE a.deleted='0'
			AND $text='1'
			AND a.user_group_id='".$user_group_id."'
			AND b.menu_url like '".$CI->uri->segment(1)."%'
			
			";
	$que=$CI->db->query($sql);
	$cek=$que->num_rows();
	
	$userid = $CI->session->userdata('logged_in'); 
    if (empty($userid)){
			echo "<script>alert('please login to access this application!!!');window.location.href='".site_url("login_admin")."'</script>";
    }else{
		if($cek==0){
			$link=$CI->input->server('HTTP_REFERER', TRUE);
			echo "<script>alert('you are not authorized to access this module!!!');window.location.href='".$link."'</script>";
			die();
		}
	}
}

