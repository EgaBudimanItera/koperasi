<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembiayaan extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $hasil=$this->db->from('pembiayaan')->where(array('tbi_is_deleted'=>'1'))->get()->result();
        return $hasil;
    }

    public function get_data_parameter($id){
        $hasil=$this->db->from('pembiayaan')->join('ref_setting_pembiayaan','tbi_sbi_id=sbi_id')->where(array('md5(tbi_ang_id)'=>$id))->get()->result();
        return $hasil;
    }

    public function save_data($data){
        return $this->db->insert('pembiayaan', $data);
    }

    public function edit_data($data,$param){
        return $this->db->update('pembiayaan', $data, $param);
    }

    public function delete_data($param){
        return $this->db->delete('pembiayaan', $param);
    }

    public function nomor_pembiayaan(){
        //DFT
        $this->db->select('RIGHT(tbi_no_pembiayaan,5) as kode', FALSE);
        $this->db->order_by('tbi_id','DESC');
        $this->db->limit(1);
        $query = $this->db->get('pembiayaan');
        if($query->num_rows() <> 0){      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        }
        else {       
            $kode = 1;
        }
        $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodejadi = 'PINJ'.date('Y').$kodemax;
        return $kodejadi;
    } 
    
}