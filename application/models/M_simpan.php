<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_simpan extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $hasil=$this->db->from('simpan')
                        ->join('anggota','tsi_ang_id=ang_id')
                        ->join('rekening','tsi_rek_id=rek_id')
                        ->where(array('tsi_is_deleted'=>'1'))->get()->result();
        return $hasil;
    }

    public function get_data_parameter($id){
        $hasil=$this->db->from('simpan')
                        ->join('ref_setting_simpanan','tsi_ssi_id=ssi_id')
                        ->where(array('md5(tsi_ang_id)'=>$id))->get()->result();
        return $hasil;
    }

    public function nomor_simpan(){
        $randnum = rand(1111111111,9999999999);
        return $randnum;
    } 

    public function save_data($data){
        return $this->db->insert('simpan', $data);
    }

    public function save_data_batch($data){
        return $this->db->insert_batch('simpan', $data);
    }

    public function edit_data($data,$param){
        return $this->db->update('simpan', $data, $param);
    }

    public function delete_data($param){
        return $this->db->delete('simpan', $param);
    }

    
}