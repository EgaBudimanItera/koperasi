<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_setting_pembiayaan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_ref_setting_pembiayaan');
        
		if($this->session->userdata('usr_setting_pembiayaan')==0){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'admin/ref_setting_pembiayaan/index',
			'link' => 'ref_setting_pembiayaan',
			'link2'=>'master',
            'script'=>'script/ref_setting_pembiayaan/ref_setting_pembiayaan_script',
			'list'=>$this->M_ref_setting_pembiayaan->get_all_data(),
		);
	
		$this->load->view('template/wrapper',$data);

	}

	public function ref_setting_pembiayaan_data(){
		$data=$this->M_ref_setting_pembiayaan->get_all_data();
        echo json_encode($data);
	}
	public function get_setting_pembiayaan_param(){
		$data=$this->M_ref_setting_pembiayaan->get_a_data();
		echo json_encode($data);
	}
	public function get_ref_setting_pembiayaan_param_comp(){
		$data=$this->M_ref_setting_pembiayaan->get_a_data_comp();
		echo json_encode($data);
	}
	function save(){
        $data=$this->M_ref_setting_pembiayaan->save_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Disimpan !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
		}
		
    }
 
    function update(){
        $data=$this->M_ref_setting_pembiayaan->edit_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Diubah !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Diubah !</div>';
		}
    }
 
    function delete(){
        $data=$this->M_ref_setting_pembiayaan->delete_data();
		if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Dihapus !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Dihapus !</div>';
		}
    }
}