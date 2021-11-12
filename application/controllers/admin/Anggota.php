<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('M_anggota','M_rekening','M_pendaftaran','M_ref_agama','M_ref_pekerjaan','M_ref_dok_identitas'));
        
	}

	public function index(){
		$data = array(
			'page' => 'admin/anggota/index',
			'link' => 'anggota',
            'script'=>'script/anggota/anggota_script',
			'list'=>$this->M_anggota->get_all_data(),
            'nomor_anggota'=>$this->M_anggota->nomor_anggota(),
            'nomor_rekening'=>$this->M_rekening->nomor_rekening(),
            'ref_agama'=>$this->M_ref_agama->get_all_data(),
            'ref_pekerjaan'=>$this->M_ref_pekerjaan->get_all_data(),
            'ref_dok_identitas'=>$this->M_ref_dok_identitas->get_all_data(),
		);
	
		$this->load->view('template/wrapper',$data);

	}

	public function anggota_data(){
		$data=$this->M_anggota->get_all_data();
        echo json_encode($data);
	}
	public function get_anggota_param(){
		$data=$this->M_anggota->get_a_data();
		echo json_encode($data);
	}
	function save(){
        $dft_id=$this->M_pendaftaran->save_data();
        $ang_id=$this->M_anggota->save_data($dft_id);
        $rekening=$this->M_rekening->save_data($ang_id);

        if($rekening){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Disimpan !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
		}
		
    }
 
    function update(){
        $data=$this->M_anggota->edit_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Diubah !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Diubah !</div>';
		}
    }
 
    function delete(){
        $data=$this->M_anggota->delete_data();
		if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Dihapus !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Dihapus !</div>';
		}
    }
}