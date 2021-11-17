<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembiayaan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('M_anggota','M_rekening','M_pendaftaran','M_ref_agama','M_ref_pekerjaan','M_ref_setting_pembiayaan','M_ref_dok_identitas','M_simpan','M_pembiayaan','M_bayar_pembiayaan'));
        
		if($this->session->userdata('usr_pembiayaan')==0){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'admin/pembiayaan/index',
			'link' => 'pembiayaan',
			'link2'=>'',
            'script'=>'script/pembiayaan/pembiayaan_script',
			'list'=>$this->M_pembiayaan->get_all_data(),
            'nomor_pembiayaan'=>$this->M_pembiayaan->nomor_pembiayaan(),
            'anggota'=>$this->M_anggota->get_all_data(),
            'setting_pembiayaan'=>$this->M_ref_setting_pembiayaan->get_all_data(),
		);
	
		$this->load->view('template/wrapper',$data);

	}
}