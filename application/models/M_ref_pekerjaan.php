<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ref_pekerjaan extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        return $query = $this->db->get('ref_pekerjaan')->result();  
    }

    public function get_a_data(){
        $id = $this->input->post('id',true);
        $hasil=$this->db->from('ref_pekerjaan')->where(array('krj_id'=>$id))->get()->row();
        return $hasil;
    }

    public function save_data(){
        $data=array(
            'krj_nama'=>$this->input->post('krj_nama',true),
            'krj_created_at'=>date('Y-m-d H:i:s'),
        );
        return $this->db->insert('ref_pekerjaan', $data);
    }

    public function edit_data(){
        $krj_nama=$this->input->post('krj_nama',true);
        $krj_id=$this->input->post('krj_id',true);
        
        $this->db->set('krj_nama', $krj_nama);
        
        $this->db->where('krj_id', $krj_id);
        $result=$this->db->update('ref_pekerjaan');
        return $result;
    }

    public function delete_data(){
        $krj_id=$this->input->post('id',true);
        
        $this->db->where('krj_id', $krj_id);
        $result=$this->db->delete('ref_pekerjaan');
        return $result;
    }

    
}