<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ref_dok_identitas extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        return $query = $this->db->get('ref_dok_identitas')->result();  
    }

    public function get_a_data(){
        $id = $this->input->post('id',true);
        $hasil=$this->db->from('ref_dok_identitas')->where(array('idn_id'=>$id))->get()->row();
        return $hasil;
    }

    public function save_data(){
        $data=array(    
            'idn_nama'=>$this->input->post('idn_nama',true),
            'idn_created_at'=>date('Y-m-d H:i:s'),
        );
        return $this->db->insert('ref_dok_identitas', $data);
    }

    public function edit_data(){
        $idn_nama=$this->input->post('idn_nama',true);
        $idn_id=$this->input->post('idn_id',true);
        
        $this->db->set('idn_nama', $idn_nama);
        
        $this->db->where('idn_id', $idn_id);
        $result=$this->db->update('ref_dok_identitas');
        return $result;
    }

    public function delete_data(){
        $idn_id=$this->input->post('id',true);
        
        $this->db->where('idn_id', $idn_id);
        $result=$this->db->delete('ref_dok_identitas');
        return $result;
    }

    
}