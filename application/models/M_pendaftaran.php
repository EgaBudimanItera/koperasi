<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pendaftaran extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $hasil=$this->db->from('pendaftaran')->where(array('byr_is_deleted'=>'1'))->get()->result();
        return $hasil;
    }

    public function get_a_data(){
        $id = $this->input->post('id',true);
        $hasil=$this->db->from('pendaftaran')->where(array('dft_id'=>$id))->get()->row();
        return $hasil;
    }

    public function save_data(){
        $data=array(
            'dft_created_by'=>"Admin",
        );
        $this->db->insert('pendaftaran', $data);

        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }


    
}