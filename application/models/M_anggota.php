<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_anggota extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $hasil=$this->db->from('anggota')->where(array('ang_is_deleted'=>'1'))->get()->result();
        return $hasil;
    }

    public function get_a_data($id){
        $hasil=$this->db->from('anggota')->where(array('ang_id'=>$id))->get()->row();
        return $hasil;
    }

    public function save_data($data){
        return $this->db->insert('anggota', $data);
    }

    public function edit_data($data,$param){
        return $this->db->update('anggota', $data, $param);
    }

    public function delete_data($param){
        return $this->db->delete('anggota', $param);
    }

    
}