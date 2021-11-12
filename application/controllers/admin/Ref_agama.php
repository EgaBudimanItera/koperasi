<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_agama extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_ref_agama');
        
	}

	public function index(){
		$data = array(
			'page' => 'admin/ref_agama/index',
			'link' => 'ref_agama',
            'script'=>'script/ref_agama/ref_agama_script',
			'list'=>$this->M_ref_agama->get_all_data(),
		);
	
		$this->load->view('template/wrapper',$data);

	}

	public function ref_agama_data(){
		$data=$this->M_ref_agama->get_all_data();
        echo json_encode($data);
	}
	public function get_agama_param(){
		$data=$this->M_ref_agama->get_a_data();
		echo json_encode($data);
	}
	function save(){
        $data=$this->M_ref_agama->save_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Disimpan !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
		}
		
    }
 
    function update(){
        $data=$this->M_ref_agama->edit_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Diubah !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Diubah !</div>';
		}
    }
 
    function delete(){
        $data=$this->M_ref_agama->delete_data();
		if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Dihapus !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Dihapus !</div>';
		}
    }
}