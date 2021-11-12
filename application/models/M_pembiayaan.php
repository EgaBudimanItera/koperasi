<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembiayaan extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $hasil=$this->db->from('pembiayaan')->where(array('tbi_is_deleted'=>'1'))->get()->result();
        return $hasil;
    }

    public function get_data_parameter($id,$param){
        $hasil=$this->db->from('pembiayaan')->where($param)->get();
        return $hasil;
    }

    public function save_data($data){
        return $this->db->insert('pembiayaan', $data);
    }

    public function edit_data($data,$param){
        return $this->db->update('pembiayaan', $data, $param);
    }

    public function delete_data($param){
        return $this->db->delete('pembiayaan', $param);
    }

    
}