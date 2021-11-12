<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ref_agama extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        return $query = $this->db->get('ref_agama')->result();  
    }

    public function get_a_data(){
        $id = $this->input->post('id',true);
        $hasil=$this->db->from('ref_agama')->where(array('agm_id'=>$id))->get()->row();
        return $hasil;
    }

    public function save_data(){
        $data=array(
            'agm_nama'=>$this->input->post('agm_nama',true),
            'agm_created_at'=>date('Y-m-d H:i:s'),
        );
        return $this->db->insert('ref_agama', $data);
    }

    public function edit_data(){
        $agm_nama=$this->input->post('agm_nama',true);
        $agm_id=$this->input->post('agm_id',true);
        
        $this->db->set('agm_nama', $agm_nama);
        
        $this->db->where('agm_id', $agm_id);
        $result=$this->db->update('ref_agama');
        return $result;
    }

    public function delete_data(){
        $agm_id=$this->input->post('id',true);
        
        $this->db->where('agm_id', $agm_id);
        $result=$this->db->delete('ref_agama');
        return $result;
    }

    
}