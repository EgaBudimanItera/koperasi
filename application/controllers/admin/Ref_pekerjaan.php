<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_pekerjaan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_ref_pekerjaan');
        
		if($this->session->userdata('usr_ref_pekerjaan')==0){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'admin/ref_pekerjaan/index',
			'link' => 'ref_pekerjaan',
			'link2'=>'master',
            'script'=>'script/ref_pekerjaan/ref_pekerjaan_script',
			'list'=>$this->M_ref_pekerjaan->get_all_data(),
		);
	
		$this->load->view('template/wrapper',$data);

	}

	public function ref_pekerjaan_data(){
		$data=$this->M_ref_pekerjaan->get_all_data();
        echo json_encode($data);
	}
	public function get_pekerjaan_param(){
		$data=$this->M_ref_pekerjaan->get_a_data();
		echo json_encode($data);
	}
	function save(){
        $data=$this->M_ref_pekerjaan->save_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Disimpan !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
		}
		
    }
 
    function update(){
        $data=$this->M_ref_pekerjaan->edit_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Diubah !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Diubah !</div>';
		}
    }
 
    function delete(){
        $data=$this->M_ref_pekerjaan->delete_data();
		if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Dihapus !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Dihapus !</div>';
		}
    }
}