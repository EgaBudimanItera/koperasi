<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Singkron extends CI_Controller {
	function __construct() {
		parent::__construct();
         
        $this->load->model(array('Migrasi'));
		$this->db=$this->load->database('default',true);
		$this->source=$this->load->database('source',true);
    }
    
    public function index(){
		// $tanggal=date('Y-m-d');
		$tanggal='2022-02-11';
		$simpan='a';
		$arr=array();
		$src=$this->source->query("SELECT * FROM fmvSalesByJurnal where CONVERT(DATE, LastModifiedDateTime) ='$tanggal'")->result();
		if(!empty($src)){
			// foreach($src as $v =>$val){

			// }
			$delete=$this->db->delete('tb_stagging',array('LastModifiedDateTime'=>$tanggal));
			
			$simpan=$this->db->insert_batch('tb_stagging',$src);
			if($simpan){
				$datalog=array(
					'tanggal'=>date('Y-m-d H:i:s'),
					'tanggal_pindah'=>$tanggal,
					'ket'=>"sukses",
				);
			}else{
				$datalog=array(
					'tanggal'=>date('Y-m-d H:i:s'),
					'tanggal_pindah'=>$tanggal,
					'ket'=>"gagal",
				);
			}
			$simpan_log=$this->db->insert('tb_log',$datalog);
		}
	}

	public function singkronyear(){
		// $tanggal=date('Y-m-d');
		$tanggal=date('Y-m-d');
		$tanggal1='2022-03-11';
		$tanggal2='2022-03-22';
		$simpan='a';
		$arr=array();
		$src=$this->source->query("SELECT * FROM fmvSalesByJurnal where CONVERT(DATE, LastModifiedDateTime) >= '$tanggal1' and CONVERT(DATE, LastModifiedDateTime) <='$tanggal2'")->result();
		if(!empty($src)){
			// foreach($src as $v =>$val){

			// }
			$delete=$this->db->delete('tb_stagging',array('CONVERT(DATE, LastModifiedDateTime)>='=>$tanggal1,'CONVERT(DATE, LastModifiedDateTime)<='=>$tanggal2));
			
			$simpan=$this->db->insert_batch('tb_stagging',$src);
			if($simpan){
				$datalog=array(
					'tanggal'=>date('Y-m-d H:i:s'),
					'tanggal_pindah'=>$tanggal,
					'ket'=>"sukses Year",
				);
			}else{
				$datalog=array(
					'tanggal'=>date('Y-m-d H:i:s'),
					'tanggal_pindah'=>$tanggal,
					'ket'=>"gagal Year",
				);
			}
			$simpan_log=$this->db->insert('tb_log',$datalog);
		}
	}
}