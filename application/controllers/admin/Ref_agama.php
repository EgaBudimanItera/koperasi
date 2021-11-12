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
            'script'=>'script/ref_agama/ref_agama_script'
		);
	
		$this->load->view('template/wrapper',$data);

	}
}