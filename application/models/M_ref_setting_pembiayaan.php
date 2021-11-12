<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ref_setting_pembiayaan extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        return $query = $this->db->get('ref_setting_pembiayaan')->result();  
    }

    public function get_a_data(){
        $id = $this->input->post('id',true);
        $hasil=$this->db->from('ref_setting_pembiayaan')->where(array('sbi_id'=>$id))->get()->row();
        return $hasil;
    }

    public function save_data(){
        $data=array(
            'sbi_kode'=>$this->input->post('sbi_kode',true),
            'sbi_nama'=>$this->input->post('sbi_nama',true),
            'sbi_max_plafon'=>$this->input->post('sbi_max_plafon',true),
            'sbi_max_waktu_pinjam'=>$this->input->post('sbi_max_waktu_pinjam',true),
            'sbi_bunga'=>$this->input->post('sbi_bunga',true),
            'sbi_created_at'=>date('Y-m-d H:i:s'),
        );
        return $this->db->insert('ref_setting_pembiayaan', $data);
    }

    public function edit_data(){
        $data=array(
            'sbi_kode'=>$this->input->post('sbi_kode',true),
            'sbi_nama'=>$this->input->post('sbi_nama',true),
            'sbi_max_plafon'=>$this->input->post('sbi_max_plafon',true),
            'sbi_max_waktu_pinjam'=>$this->input->post('sbi_max_waktu_pinjam',true),
            'sbi_bunga'=>$this->input->post('sbi_bunga',true),
        );
        $sbi_id=$this->input->post('sbi_id',true);
        return $this->db->update('ref_setting_pembiayaan', $data, array('sbi_id'=>$sbi_id));
    }

    public function delete_data(){
        $sbi_id=$this->input->post('id',true);
        return $this->db->delete('ref_setting_pembiayaan', array('sbi_id'=>$sbi_id));
    }

    
}