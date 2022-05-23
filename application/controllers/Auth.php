<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Include librari PhpSpreadsheet


class Auth extends CI_Controller {
	function __construct() {
		parent::__construct();

        $this->load->model(array('Migrasi'));
		$this->db=$this->load->database('default',true);
		$this->source=$this->load->database('source',true);
    }

    public function index($bra){
        $this->login($bra);
    }
    public function login($bra){
        if($bra==null || $bra=""){
            echo '<script>alert("Tidak Dapat Diakses,Silahkan Login Dahulu");window.location.href = "https://fmm-eps.com/";</script>';
        }else{
            $sess = array(
                'branch_id'=>$bra,
            );
            $this->session->set_userdata($sess);
            redirect(base_url());
        }
        
    }
}