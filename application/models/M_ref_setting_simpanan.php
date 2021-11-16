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

   public function get_a_data(){
        $id = $this->input->post('id',true);
        $hasil=$this->db->from('ref_setting_simpanan')->where(array('ssi_id'=>$id))->get()->row();
        return $hasil;
    }

    public function get_simpanan($kode){
        // $kode= $this->input->post('kode',true);
        $hasil=$this->db->from('ref_setting_simpanan')->where(array('ssi_tanda'=>$kode))->get()->row();
        return $hasil;
    }

    
    public function edit_data(){
        $data=array(
            'ssi_nominal'=>str_replace(',', '', $this->input->post('ssi_nominal',true)),
        );
        $ssi_id=$this->input->post('ssi_id',true);
        return $this->db->update('ref_setting_simpanan', $data, array('ssi_id'=>$ssi_id));
    }
}