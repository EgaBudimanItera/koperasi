<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('is_login')){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		
		$data = array(
			'page' => 'beranda',
			'link' => 'beranda',
            'link2'=>'',
		);
	
		$this->load->view('template/wrapper', $data);

	}
}