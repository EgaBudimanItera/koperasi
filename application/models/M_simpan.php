<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_simpan extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $hasil=$this->db->from('simpan')->where(array('byr_is_deleted'=>'1'))->get()->result();
        return $hasil;
    }

    public function get_data_parameter($id,$param){
        $hasil=$this->db->from('simpan')->where($param)->get();
        return $hasil;
    }

    public function nomor_simpan(){
        $randnum = rand(1111111111,9999999999);
        return $randnum;
    } 

    public function save_data($data){
        return $this->db->insert('simpan', $data);
    }

    public function edit_data($data,$param){
        return $this->db->update('simpan', $data, $param);
    }

    public function delete_data($param){
        return $this->db->delete('simpan', $param);
    }

    
}