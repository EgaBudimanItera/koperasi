<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_anggota extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_all_data(){
        $this->db->from('anggota ')
                 ->join('ref_agama ','ang_agm_id=agm_id')
                 ->join('ref_pekerjaan','ang_krj_id=krj_id')
                 ->join('ref_dok_identitas','ang_idn_id=idn_id')
                 ->where(array('ang_is_deleted'=>'1'));
        $hasil = $this->db->get()->result();
        return $hasil;
    }

    public function nomor_anggota(){
        //2001A0001
        $this->db->select('RIGHT(ang_nomor,4) as kode', FALSE);
        $this->db->order_by('ang_id','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('anggota');      //cek dulu apakah ada sudah ada kode di tabel.    
        if($query->num_rows() <> 0){      
         //jika kode ternyata sudah ada.      
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
        }
        else {      
         //jika kode belum ada      
         $kode = 1;    
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = date('Y')."A".$kodemax;    //2001A0001
        return $kodejadi;  
    }

    public function get_a_data(){
        $id = $this->input->post('id',true);
        
        $hasil=$this->db->from('anggota')->where(array('ang_id'=>$id))->get()->row();
        return $hasil;
    }

    public function save_data($dft_id){
        $data=array(
            'ang_nomor'=>$this->input->post('ang_nomor',true),
            'ang_nama'=>$this->input->post('ang_nama',true),
            'ang_tempat_lahir'=>$this->input->post('ang_tempat_lahir',true),
            'ang_tanggal_lahir'=>$this->input->post('ang_tanggal_lahir',true),
            'ang_jk'=>$this->input->post('ang_jk',true),
            'ang_agm_id'=>$this->input->post('ang_agm_id',true),
            'ang_krj_id'=>$this->input->post('ang_krj_id',true),
            'ang_nama_ayah'=>$this->input->post('ang_nama_ayah',true),
            'ang_nama_ibu'=>$this->input->post('ang_nama_ibu',true),
            'ang_alamat'=>$this->input->post('ang_alamat',true),
            'ang_no_hp'=>$this->input->post('ang_no_hp',true),
            'ang_idn_id'=>$this->input->post('ang_idn_id',true),
            'ang_no_identitas'=>$this->input->post('ang_no_identitas',true),
            'ang_nama_ahli_waris'=>$this->input->post('ang_nama_ahli_waris',true),
            'ang_alamat_ahli_waris'=>$this->input->post('ang_alamat_ahli_waris',true),
            'ang_hub_keluarga'=>$this->input->post('ang_hub_keluarga',true),
            'ang_dft_id'=>$dft_id,
            'ang_created_by'=>"admin",
        );
        $this->db->insert('anggota', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    public function edit_data($data,$param){
        return $this->db->update('anggota', $data, $param);
    }

    public function delete_data($param){
        return $this->db->delete('anggota', $param);
    }

    
}