<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ref_setting_simpanan extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        return $query = $this->db->get('ref_setting_simpanan');  
    }

    public function get_a_data($id){
        $hasil=$this->db->from('ref_setting_simpanan')->where(array('ssi_id'=>$id))->get()->row();
        return $hasil;
    }

    public function save_data($data){
        return $this->db->insert('ref_setting_simpanan', $data);
    }

    public function edit_data($data,$param){
        return $this->db->update('ref_setting_simpanan', $data, $param);
    }

    public function delete_data($param){
        return $this->db->delete('ref_setting_simpanan', $param);
    }

    
}