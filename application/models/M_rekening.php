<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rekening extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $hasil=$this->db->from('rekening')->where(array('rek_is_deleted'=>'1'))->get()->result();
        return $hasil;
    }

    public function get_a_data(){
        $id = $this->input->post('id',true);
        $hasil=$this->db->from('rekening')->where(array('rek_id'=>$id))->get()->row();
        return $hasil;
    }
   
    public function nomor_rekening(){
        $randnum = rand(1111111111,9999999999);
        return $randnum;
    } 

    public function save_data($data){
        
        $this->db->insert('rekening', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
}