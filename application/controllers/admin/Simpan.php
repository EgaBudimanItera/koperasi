<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simpan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('M_simpan','M_anggota'));
        
	}

	public function index(){
		$data = array(
			'page' => 'admin/simpan/index',
			'link' => 'simpan',
			'link2'=>'transaksi',
            'script'=>'script/simpan/simpan_script',
			'list'=>$this->M_simpan->get_all_data(),
            'nomor_simpan'=>$this->M_simpan->nomor_simpan(),
            'anggota'=>$this->M_anggota->get_all_data(),
		);
	
		$this->load->view('template/wrapper',$data);

	}

	public function simpan_data(){
		$data=$this->M_simpan->get_all_data();
        echo json_encode($data);
	}
	public function get_setting_pembiayaan_param(){
		$data=$this->M_simpan->get_a_data();
		echo json_encode($data);
	}
	function save(){
        $data=$this->M_simpan->save_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Disimpan !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
		}
		
    }
 
    function update(){
        $data=$this->M_simpan->edit_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Diubah !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Diubah !</div>';
		}
    }
 
    function delete(){
        $data=$this->M_simpan->delete_data();
		if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Dihapus !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Dihapus !</div>';
		}
    }
}