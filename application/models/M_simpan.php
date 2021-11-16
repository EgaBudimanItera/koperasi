<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_simpan extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $hasil=$this->db->from('simpan')
                        ->join('anggota','tsi_ang_id=ang_id')
                        
                        ->join('ref_setting_simpanan','tsi_ssi_id=ssi_id')
                        ->where(array('tsi_is_deleted'=>'1'))
                        ->order_by('tsi_id','desc')
                        ->order_by('tsi_tanggal_simpan','desc')
                        ->order_by('tsi_ang_id','asc')
                        ->order_by('ssi_id','asc')
                        ->get()->result();
        return $hasil;
    }

    public function get_data_parameter($id){
        $hasil=$this->db->from('simpan')
                        ->join('ref_setting_simpanan','tsi_ssi_id=ssi_id')
                        ->where(array('md5(tsi_ang_id)'=>$id))->get()->result();
        return $hasil;
    }

    public function nomor_simpan(){
        $randnum = rand(1111111111,9999999999);
        return $randnum;
    } 

    public function save_data(){
        $id_simpanan_pokok=$this->M_ref_setting_simpanan->get_simpanan('SPP')->ssi_id;
		$id_simpanan_wajib=$this->M_ref_setting_simpanan->get_simpanan('SPW')->ssi_id;
		$id_simpanan_sukarela=$this->M_ref_setting_simpanan->get_simpanan('SPS')->ssi_id;
		$no_transaksi=$this->M_simpan->nomor_simpan().date('dmY');
		$tgl_created=date('Y-m-d H:i:s');
		$tsi_tanggal_simpan=date("Y-m-d", strtotime($this->input->post('tsi_tanggal_simpan',true)));
        $tsi_simpanan_wajib=str_replace(',', '', $this->input->post('tsi_simpanan_wajib',true));
		$tsi_simpanan_sukarela=str_replace(',', '', $this->input->post('tsi_simpanan_sukarela',true));
        $ang_id=$this->input->post('tsi_ang_id',true);
        $nama_pembuat=$this->session->userdata('usr_nama');
        $data=array(
            array(
				'tsi_ang_id'=>$ang_id,
				'tsi_no_simpan'=>$no_transaksi,
				// 'tsi_rek_id'=>$rek_id,
				'tsi_tanggal_simpan'=>$tsi_tanggal_simpan,
				'tsi_ssi_id'=>$id_simpanan_wajib,
				'tsi_nominal'=>$tsi_simpanan_wajib,
				'tsi_created_by'=>$nama_pembuat,
				'tsi_created_at'=>$tgl_created,
			),
			array(
				'tsi_ang_id'=>$ang_id,
				'tsi_no_simpan'=>$no_transaksi,
				// 'tsi_rek_id'=>$rek_id,
				'tsi_tanggal_simpan'=>$tsi_tanggal_simpan,
				'tsi_ssi_id'=>$id_simpanan_sukarela,
				'tsi_nominal'=>$tsi_simpanan_sukarela,
				'tsi_created_by'=>$nama_pembuat,
				'tsi_created_at'=>$tgl_created,
			),
        );
        return $this->M_simpan->save_data_batch($data);
    }

    public function save_data_batch($data){
        return $this->db->insert_batch('simpan', $data);
    }

    public function delete_data(){
        $nama_pembuat=$this->session->userdata('usr_nama');
        $tsi_id=$this->input->post('id',true);
        $data=array(
            'tsi_updated_by'=>$nama_pembuat,
            'tsi_updated_at'=>date('Y-m-d H:i:s'),
            'tsi_is_deleted'=>'0'
        );
        return $this->db->update('simpan', $data, array('tsi_id'=>$tsi_id));
    }

    
}