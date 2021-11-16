<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_setting_simpanan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_ref_setting_simpanan');
        
		if($this->session->userdata('usr_setting_simpanan')==0){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'admin/ref_setting_simpanan/index',
			'link' => 'ref_setting_simpanan',
			'link2'=>'master',
            'script'=>'script/ref_setting_simpanan/ref_setting_simpanan_script',
			'list'=>$this->M_ref_setting_simpanan->get_all_data()->result(),
		);
	
		$this->load->view('template/wrapper',$data);

	}

	public function ref_setting_simpanan_data(){
		$data=$this->M_ref_setting_simpanan->get_all_data();
        echo json_encode($data);
	}
	public function get_ref_setting_simpanan_param(){
		$data=$this->M_ref_setting_simpanan->get_a_data();
		echo json_encode($data);
	}
	public function get_simpanan(){
		$data=$this->M_ref_setting_simpanan->get_simpanan();
		echo json_encode($data);
	}
    function update(){
        $data=$this->M_ref_setting_simpanan->edit_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Diubah !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Diubah !</div>';
		}
    }
}