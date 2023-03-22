<?php
class Aktiviti_log_model extends CI_Model {

    var $site_id;

    function __construct()
    {
         parent::__construct();
    }
    
    function create($action){
	$insert = array(
            'action' =>$action ,
            'created_by' => $this->session->userdata('admin_id'),
            'ip_address' => $this->session->userdata('ip_address') ,       
        );			
        $this->db->insert('activiti_log', $insert);
    }
    
    function get_data($id=""){
            
            $sql ="select * from activiti_log as a
		    left join admin as b on a.created_by=b.admin_id
                   ORDER BY a.activiti_log_id DESC";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
	
	

}