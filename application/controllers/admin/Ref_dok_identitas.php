<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_dok_identitas extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_ref_dok_identitas');
        
	}

	public function index(){
		$data = array(
			'page' => 'admin/ref_dok_identitas/index',
			'link' => 'ref_dok_identitas',
            'script'=>'script/ref_dok_identitas/ref_dok_identitas_script',
			'list'=>$this->M_ref_dok_identitas->get_all_data(),
		);
	
		$this->load->view('template/wrapper',$data);

	}

	public function ref_dok_identitas_data(){
		$data=$this->M_ref_dok_identitas->get_all_data();
        echo json_encode($data);
	}
	public function get_ref_dok_identitas_param(){
		$data=$this->M_ref_dok_identitas->get_a_data();
		echo json_encode($data);
	}

	function save(){
        $data=$this->M_ref_dok_identitas->save_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Disimpan !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
		}
		
    }
 
    function update(){
        $data=$this->M_ref_dok_identitas->edit_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Diubah !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Diubah !</div>';
		}
    }
 
    function delete(){
        $data=$this->M_ref_dok_identitas->delete_data();
		if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Dihapus !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Dihapus !</div>';
		}
    }
}