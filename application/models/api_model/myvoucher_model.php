<?php
class Myvoucher_model extends CI_Model {
        function get_data($member_id,$limit="",$offset="",$id=""){
            $this->db->select("*, wrl.wifren_reedem_id as wri, wr.promo_id as pi, wmp.merchant_id as mi, wrl.wifren_reedem_log_id as wrli");
            $this->db->from("wifren_reedem_log wrl");
            
            
            $this->db->join("wifren_reedem_code wrc", "wrc.wifren_reedem_code_id=wrl.wifren_reedem_code", "left");
            $this->db->join("wifren_reedem wr","wrl.wifren_reedem_id=wr.wifren_reedem_id", "left");
            $this->db->join("wifren_merchant_promo wmp", "wmp.promo_id=wr.promo_id", "left");
            $this->db->join("wifren_merchant wm", "wmp.merchant_id=wm.merchant_id", "left");
            if($member_id!=""){
                $this->db->where("wrl.member_id", $member_id);
            }
            
            if($id!=""){
                $this->db->where("wrl.wifren_reedem_log_id", $id);
            }
            
            $this->db->order_by("wrl.wifren_reedem_log_id", "desc");
            
            
            
            $query = $this->db->get();
            
            return $query->result_array();
        }
}