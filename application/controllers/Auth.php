<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_auth');
	}

	public function index()
	{
		$this->load->view('login');
	}

    public function signin(){
        $hasil=$this->M_auth->get_data_param();
        // echo $hasil;
        // print_r($this->session->all_userdata());
        if($hasil==1){
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Username Dan Password Tidak Boleh Kosong !</div>';
        }elseif($hasil==2){
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Username Tidak Ditemukan !</div>';
        }elseif ($hasil==3) {
            echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> User ditemukan, sedang menyambungkan !</div>';
			echo'<script>window.location.href="'.base_url().'beranda";</script>';
        }elseif ($hasil==4) {
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Password salah !</div>';
        }
    }
	public function signout(){
        echo 'Please wait...';
        $this->session->sess_destroy();
        echo'<script>window.location.href="'.base_url().'";</script>';
    }
}