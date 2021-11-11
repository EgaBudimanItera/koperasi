<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
	}

	public function index(){
		$data = array(
			'page' => 'beranda',
			'link' => 'beranda',
            
		);
	
		$this->load->view('template/wrapper', $data);

	}
}