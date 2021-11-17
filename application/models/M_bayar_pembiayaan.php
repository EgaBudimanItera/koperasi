<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bayar_pembiayaan extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $hasil=$this->db->from('bayar_pembiayaan')->where(array('byr_is_deleted'=>'1'))->get()->result();
        return $hasil;
    }

    public function get_data_parameter($id){
        $hasil=$this->db->from('bayar_pembiayaan')->where(array('byr_tbi_id'=>$id))->get()->result();
        return $hasil;
    }

    public function save_data($data){
        return $this->db->insert('bayar_pembiayaan', $data);
    }

    public function edit_data($data,$param){
        return $this->db->update('bayar_pembiayaan', $data, $param);
    }

    public function delete_data($param){
        return $this->db->delete('bayar_pembiayaan', $param);
    }

    public function nomor_pembayaran(){
        //DFT
        $this->db->select('RIGHT(byr_no_pembayaran,5) as kode', FALSE);
        $this->db->order_by('byr_id','DESC');
        $this->db->limit(1);
        $query = $this->db->get('bayar_pembiayaan');
        if($query->num_rows() <> 0){      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        }
        else {       
            $kode = 1;
        }
        $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodejadi = 'BYR'.date('Y').$kodemax;
        return $kodejadi;
    } 
    
}