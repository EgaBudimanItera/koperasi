<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('M_anggota','M_rekening','M_pendaftaran','M_ref_agama','M_ref_pekerjaan','M_ref_setting_simpanan','M_ref_dok_identitas','M_simpan','M_pembiayaan','M_bayar_pembiayaan'));
        
		if($this->session->userdata('usr_anggota')==0){
            echo '<script>alert("Maaf, anda tidak boleh mengakses halaman ini")</script>';
            echo'<script>window.location.href="'.base_url().'";</script>';
        }
	}

	public function index(){
		$data = array(
			'page' => 'admin/anggota/index',
			'link' => 'anggota',
			'link2'=>'',
            'script'=>'script/anggota/anggota_script',
			'list'=>$this->M_anggota->get_all_data(),
            'nomor_anggota'=>$this->M_anggota->nomor_anggota(),
            'nomor_rekening'=>$this->M_rekening->nomor_rekening(),
            'ref_agama'=>$this->M_ref_agama->get_all_data(),
            'ref_pekerjaan'=>$this->M_ref_pekerjaan->get_all_data(),
            'ref_dok_identitas'=>$this->M_ref_dok_identitas->get_all_data(),
			'simpanan_wajib'=>$this->M_ref_setting_simpanan->get_simpanan('SPW'),
			'simpanan_pokok'=>$this->M_ref_setting_simpanan->get_simpanan('SPP'),
		);
	
		$this->load->view('template/wrapper',$data);

	}

	
	public function detail($id){
		$output=array();
		$pembiayaan=$this->M_pembiayaan->get_data_parameter($id);
		foreach($pembiayaan as $p){
			$byr_tbi_id=$p->tbi_id;
			$bayar_pembiayaan=$this->M_bayar_pembiayaan->get_data_parameter($byr_tbi_id);
			$p->bayar=$bayar_pembiayaan;
			$output[]=$p;
		}
		$data = array(
			'page' => 'admin/anggota/detail',
			'link' => 'anggota',
			'link2'=>'',
            'script'=>'script/anggota/anggota_script',
			'list'=>$this->M_anggota->get_detail($id),
            'list_simpanan'=>$this->M_simpan->get_data_parameter($id),
			'list_pembiayaan'=>$output,
            'ref_agama'=>$this->M_ref_agama->get_all_data(),
            'ref_pekerjaan'=>$this->M_ref_pekerjaan->get_all_data(),
            'ref_dok_identitas'=>$this->M_ref_dok_identitas->get_all_data(),
		);
		// var_dump($data);
		$this->load->view('template/wrapper',$data);
	}
	public function anggota_data(){
		$data=$this->M_anggota->get_all_data();
        echo json_encode($data);
	}
	public function get_anggota_param(){
		$data=$this->M_anggota->get_a_data();
		echo json_encode($data);
	}
	public function get_anggota_param_comp(){
		$data=$this->M_anggota->get_a_data_comp();
		echo json_encode($data);
	}
	function save(){
        $nama_pembuat=$this->session->userdata('usr_nama');
		$dft_id=$this->M_pendaftaran->save_data();
		// $dft_id='1';
		$tsi_simpanan_pokok=str_replace(',', '', $this->input->post('tsi_simpanan_pokok',true));
		$tsi_simpanan_wajib=str_replace(',', '', $this->input->post('tsi_simpanan_wajib',true));
		$tsi_simpanan_sukarela=str_replace(',', '', $this->input->post('tsi_simpanan_sukarela',true));
		$birthDate = date("m/d/Y", strtotime($this->input->post('ang_tanggal_lahir',true)));
		// $birthDate = "12/17/1983";
		//explode the date to get month, day and year
		$birthDate = explode("/", $birthDate);
		//get age from date or birthdate
		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
		  ? ((date("Y") - $birthDate[2]) - 1)
		  : (date("Y") - $birthDate[2]));
		if($age<17){
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan! Usia Kurang dari 17</div>';
			echo'<script>location.reload();</script>';
			exit();
		}
		// $tsi_simpanan_pokok=str_replace('.', '', $this->input->post('tsi_simpanan_pokok',true));
		$data=array(
            'ang_nomor'=>$this->input->post('ang_nomor',true),
            'ang_nama'=>$this->input->post('ang_nama',true),
            'ang_tempat_lahir'=>$this->input->post('ang_tempat_lahir',true),
            'ang_tanggal_lahir'=>date("Y-m-d", strtotime($this->input->post('ang_tanggal_lahir',true))),
            'ang_jk'=>$this->input->post('ang_jk',true),
            'ang_agm_id'=>$this->input->post('ang_agm_id',true),
            'ang_krj_id'=>$this->input->post('ang_krj_id',true),
            'ang_nama_ayah'=>$this->input->post('ang_nama_ayah',true),
            'ang_nama_ibu'=>$this->input->post('ang_nama_ibu',true),
            'ang_alamat'=>$this->input->post('ang_alamat',true),
            'ang_no_hp'=>$this->input->post('ang_no_hp',true),
            'ang_idn_id'=>$this->input->post('ang_idn_id',true),
            'ang_no_identitas'=>$this->input->post('ang_no_identitas',true),
            'ang_nama_ahli_waris'=>$this->input->post('ang_nama_ahli_waris',true),
            'ang_alamat_ahli_waris'=>$this->input->post('ang_alamat_ahli_waris',true),
            'ang_hub_keluarga'=>$this->input->post('ang_hub_keluarga',true),
            'ang_dft_id'=>$dft_id,
            'ang_created_by'=>$nama_pembuat,
			'ang_created_at'=>date('Y-m-d H:i:s'),
        );
		
        $ang_id=$this->M_anggota->save_data($data);
		$data1=array(
            'rek_ang_id'=>$ang_id,
            'rek_no_rekening'=>$this->input->post('rek_no_rekening',true),
            'rek_created_by'=>$nama_pembuat,
			'rek_created_at'=>date('Y-m-d H:i:s'),
        );
        $rek_id=$this->M_rekening->save_data($data1);
		//simpanan Pokok
		$id_simpanan_pokok=$this->M_ref_setting_simpanan->get_simpanan('SPP')->ssi_id;
		$id_simpanan_wajib=$this->M_ref_setting_simpanan->get_simpanan('SPW')->ssi_id;
		$id_simpanan_sukarela=$this->M_ref_setting_simpanan->get_simpanan('SPS')->ssi_id;
		$no_transaksi=$this->M_simpan->nomor_simpan().date('dmY');
		$tgl_created=date('Y-m-d H:i:s');
		$tsi_tanggal_simpan=date("Y-m-d", strtotime($this->input->post('tsi_tanggal_simpan',true)));
		$data3=array(
			array(
				'tsi_ang_id'=>$ang_id,
				'tsi_no_simpan'=>$no_transaksi,
				'tsi_rek_id'=>$rek_id,
				'tsi_tanggal_simpan'=>$tsi_tanggal_simpan,
				'tsi_ssi_id'=>$id_simpanan_pokok,
				'tsi_nominal'=>$tsi_simpanan_pokok,
				'tsi_created_by'=>$nama_pembuat,
				'tsi_created_at'=>$tgl_created
			),
			array(
				'tsi_ang_id'=>$ang_id,
				'tsi_no_simpan'=>$no_transaksi,
				'tsi_rek_id'=>$rek_id,
				'tsi_tanggal_simpan'=>$tsi_tanggal_simpan,
				'tsi_ssi_id'=>$id_simpanan_wajib,
				'tsi_nominal'=>$tsi_simpanan_wajib,
				'tsi_created_by'=>$nama_pembuat,
				'tsi_created_at'=>$tgl_created,
			),
			array(
				'tsi_ang_id'=>$ang_id,
				'tsi_no_simpan'=>$no_transaksi,
				'tsi_rek_id'=>$rek_id,
				'tsi_tanggal_simpan'=>$tsi_tanggal_simpan,
				'tsi_ssi_id'=>$id_simpanan_sukarela,
				'tsi_nominal'=>$tsi_simpanan_sukarela,
				'tsi_created_by'=>$nama_pembuat,
				'tsi_created_at'=>$tgl_created,
			),
		);

		

		$simpan=$this->M_simpan->save_data_batch($data3);
        if($simpan){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Disimpan !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal disimpan !</div>';
		}
		
    }
 
    function update(){
        $data=$this->M_anggota->edit_data();
        if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Diubah !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Diubah !</div>';
		}
    }
 
    function delete(){
        $data=$this->M_anggota->delete_data();
		if($data){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Berhasil Dihapus !</div>';
            echo'<script>location.reload();</script>';
		}else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a>Gagal Dihapus !</div>';
		}
    }
}