<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bayar_pembiayaan extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $hasil=$this->db->from('bayar_pembiayaan')->where(array('byr_is_deleted'=>'1'))->get()->result();
        return $hasil;
    }

    public function get_data_parameter($id){
        $hasil=$this->db->from('bayar_pembiayaan')->where(array('byr_tbi_id'=>$id))->get()->result();
        return $hasil;
    }

    public function save_data($data){
        return $this->db->insert('bayar_pembiayaan', $data);
    }

    public function edit_data($data,$param){
        return $this->db->update('bayar_pembiayaan', $data, $param);
    }

    public function delete_data($param){
        return $this->db->delete('bayar_pembiayaan', $param);
    }

    
}