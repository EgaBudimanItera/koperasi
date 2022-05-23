<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Include librari PhpSpreadsheet

class Dasboard extends CI_Controller {
	function __construct() {
		parent::__construct();
        // if($this->session->userdata('branch_id') == ''||$this->session->userdata('branch_id') == NULL){
        //     echo '<script>alert("Tidak Dapat Diakses,Silahkan Login Dahulu");window.location.href = "https://fmm-eps.com/";</script>';
		// 	exit();
        // }   
        $this->load->model(array('Migrasi'));
		$this->db=$this->load->database('default',true);
		$this->source=$this->load->database('source',true);
    }

	public function index()
	{
		
		$branchidget=$this->input->get('branchid',true);
		$yearget=$this->input->get('year',true);	
		$kategoriget=$this->input->get('kategori',true);
		$grupcdget=$this->input->get('grupcd',true);
		
		$skr=date('Y');
		$akhir=$skr+8;
		$year="";
		for($x=2015;$x<=$akhir;$x++){
			if($yearget==''){
				// $year.="<option value='$x'>$x</option>";
				if($x==$skr){
					$year.="<option value='$x' selected>$x</option>";
				}
				else{
					$year.="<option value='$x'>$x</option>";
				}
			}
			else{
				if($x==$yearget){
					$year.="<option value='$x' selected>$x</option>";
				}
				else{
					$year.="<option value='$x'>$x</option>";
				}
			}
			
			
		}
		$thbranch="";
		$bc=$this->db->select('branchID,BranchCD')
				 ->from('tb_stagging')
				 ->group_by('BranchCD,branchID')
				 ->order_by('BranchCD','asc')
				 ->get()
				 ->result();
		
		foreach($bc as $b){
			if($branchidget==$b->branchID){
				$thbranch.="<option value='$b->branchID' selected>$b->BranchCD</option>";
			}else{
				$thbranch.="<option value='$b->branchID'>$b->BranchCD</option>";
			}
			
		
		}
		
		$selectedtop="";
		if($kategoriget!=""){
			if($kategoriget=='10'){
				$top="<option value='10' selected>Top 10</option>";
			}else {
				$top="<option value='10'>Top 10</option>";
			}
			if($kategoriget=='50'){
				$top.="<option value='50' selected>Top 50</option>";
			}else{
				$top.="<option value='50'>Top 50</option>";
			}

			if($kategoriget=='100'){
				$top.="<option value='100' selected>Top 100</option>";
			}else{
				$top.="<option value='100'>Top 100</option>";
			}
			
			
		}else{
			$top="<option value='10'>Top 10</option>";
			$top.="<option value='50'>Top 50</option>";
			$top.="<option value='100'>Top 100</option>";
		}
		

		$grupcd=$this->db->select('GroupCD')
				 ->from('tb_stagging')
				 ->where("GroupCD in ('LBI', 'CNM', 'ITE', 'SVS', 'PCE', 'RTE', 'AMS', 'PRJ')")
				 ->order_by('GroupCD','asc')
				 ->group_by('GroupCD')
				 ->get()
				 ->result();
		$thbc="";
		if(!empty($grupcd)){
			foreach($grupcd as $b){
				if($grupcdget!=""){
					if($b->GroupCD==$grupcdget){
						$thbc.="<option value='$b->GroupCD' selected>$b->GroupCD</option>";
					}else{
						$thbc.="<option value='$b->GroupCD'>$b->GroupCD</option>";
					}
				}else{
					$thbc.="<option value='$b->GroupCD'>$b->GroupCD</option>";
				}
			}
		}
		
		$thnya='';
		$field="CustomerName,SectorBusiness";
		$tdnya="";
		$totalfield='(0';
		$no=1;
		foreach($grupcd as $g){
			$thnya.="<th>$g->GroupCD</th>";
			$field.=",'$g->GroupCD' as G_$no,coalesce(sum(case when GroupCDa='$g->GroupCD' then amount end),0) as F_$no";
			$totalfield.="+F_$no";
			$no++;
		};
		$thtahunnya='';
		$skr_1=date('Y');
		$akhir_1=$skr_1-4;
		$year_1="";
		$no_1=1;
		$field_1="CustomerName,SectorBusiness";
		$totalfield_1='(0';
		$avgfield_1='((0';
		for($x=$skr_1;$x>=$akhir_1;$x--){
			$thtahunnya.="<th>".$x."</th>";
			$field_1.=", '$x' as Tahun_$no_1,sum(case when year='$x' then amount else 0 end) as 'tahun_$x'";
			$totalfield_1.="+F_$no_1";
			$avgfield_1.="+tahun_$x";
			$no_1++;
		}
		$totalfield_1.=") as total,";
		$avgfield_1.=")/5) as avg_year";
		
		$totalfield.=") as total";
		$limit="";
		if($kategoriget==""){
			$kategoriget='10';
		}
		if($kategoriget!=""){
			$limit=" TOP $kategoriget ";
		}
		$query="SELECT $limit *,$totalfield FROM (SELECT $field FROM tb_stagging WHERE 1=1";
		$query_1="SELECT $limit *,$avgfield_1 FROM (SELECT $field_1 FROM tb_stagging WHERE 1=1";
		$query_1.=" Group By CustomerName,SectorBusiness) as dt ORDER BY avg_year desc";
		
		// var_dump($hasil);
		// die();
		if($yearget!=""){
			$query.=" AND year='$yearget' ";
		}else{
			$query.=" AND year='$skr' ";
		}
		if($branchidget!=''){
			
			$query.=" AND branchID='$branchidget' ";
		}
		if($grupcdget!=''){
			
			$query.=" AND GroupCD='$grupcdget' ";
		}
		$query.=" Group By CustomerName,SectorBusiness) as dt ORDER BY total desc";
		$hasil=array();
		// $hasil=$this->db->query($query)->result();
		$hasil=$this->db->query($query_1)->result();
		$this->load->view('templates/site_tpl', array (
			'content' => 'dashboard',
			'year'=>$year,
			'bc'=>$thbranch,
			'top'=>$top,
			'grupcd'=>$thbc,
			'thnya'=>$thnya,
			'thtahunnya'=>$thtahunnya,
			'hasil'=>$hasil,
			'kolom'=>$no,
			'grupcdisi'=>$grupcd,
			'tdnya'=>$tdnya,
			'link'=>'customer'
		));
	}

	public function vendor()
	{
		$branchidget=$this->input->get('branchid',true);
		$yearget=$this->input->get('year',true);	
		$kategoriget=$this->input->get('kategori',true);
		$grupcdget=$this->input->get('grupcd',true);
		$typeitem=$this->input->get('typeitem',true);

		$skr=date('Y');
		$akhir=$skr+8;
		$year="";
		for($x=2015;$x<=$akhir;$x++){
			if($yearget==''){
				if($x==$skr){
					$year.="<option value='$x' selected>$x</option>";
				}
				else{
					$year.="<option value='$x'>$x</option>";
				}
			}
			else{
				if($x==$yearget){
					$year.="<option value='$x' selected>$x</option>";
				}
				else{
					$year.="<option value='$x'>$x</option>";
				}
			}
			
			
		}
		$thbranch="";
		$bc=$this->db->select('branchID,BranchCD')
				 ->from('tb_stagging')
				 ->group_by('BranchCD,branchID')
				 ->order_by('BranchCD','asc')
				 ->get()
				 ->result();
		
		foreach($bc as $b){
			if($branchidget==$b->branchID){
				$thbranch.="<option value='$b->branchID' selected>$b->BranchCD</option>";
			}else{
				$thbranch.="<option value='$b->branchID'>$b->BranchCD</option>";
			}
			
		
		}
		
		$selectedtop="";
		if($kategoriget!=""){
			if($kategoriget=='10'){
				$top="<option value='10' selected>Top 10</option>";
			}else {
				$top="<option value='10'>Top 10</option>";
			}
			if($kategoriget=='50'){
				$top.="<option value='50' selected>Top 50</option>";
			}else{
				$top.="<option value='50'>Top 50</option>";
			}

			if($kategoriget=='100'){
				$top.="<option value='100' selected>Top 100</option>";
			}else{
				$top.="<option value='100'>Top 100</option>";
			}
			
			
		}else{
			$top="<option value='10'>Top 10</option>";
			$top.="<option value='50'>Top 50</option>";
			$top.="<option value='100'>Top 100</option>";
		}
		

		$grupcd=$this->db->select('GroupCD')
				 ->from('tb_stagging')
				 ->where("GroupCD in ('LBI', 'CNM', 'ITE', 'SVS', 'PCE', 'RTE', 'AMS', 'PRJ')")
				 ->order_by('GroupCD','asc')
				 ->group_by('GroupCD')
				 ->get()
				 ->result();
		$thbc="";
		if(!empty($grupcd)){
			foreach($grupcd as $b){
				if($grupcdget!=""){
					if($b->GroupCD==$grupcdget){
						$thbc.="<option value='$b->GroupCD' selected>$b->GroupCD</option>";
					}else{
						$thbc.="<option value='$b->GroupCD'>$b->GroupCD</option>";
					}
				}else{
					$thbc.="<option value='$b->GroupCD'>$b->GroupCD</option>";
				}
			}
		}
		$tipeitemoption=$this->db->select("Coalesce(TypeItem,'Tidak Ada Tipe') as TypeItem")->from('tb_stagging')
						
						->group_by('TypeItem')
						->order_by('TypeItem','asc')
						->get()->result();
		$opttipe='';
		foreach($tipeitemoption as $t){
			if($typeitem==ltrim($t->TypeItem)){
				$opttipe.="<option value='".ltrim($t->TypeItem)."' selected>$t->TypeItem</option>";
			}
			else{
				$opttipe.="<option value='".ltrim($t->TypeItem)."'>$t->TypeItem</option>";
			}
		}
		$thnya='';
		$field="Vendor";
		$tdnya="";
		$totalfield='(0';
		$no=1;
		foreach($grupcd as $g){
			$thnya.="<th>$g->GroupCD</th>";
			$field.=",'$g->GroupCD' as G_$no,coalesce(sum(case when GroupCD='$g->GroupCD' then amount end),0) as F_$no";
			$totalfield.="+F_$no";
			$no++;
		};
		
		$totalfield.=") as total";
		$limit="";
		if($kategoriget==""){
			$kategoriget='10';
		}
		if($kategoriget!=""){
			$limit=" TOP $kategoriget ";
		}
		$query="SELECT $limit *,$totalfield FROM (SELECT $field FROM tb_stagging WHERE 1=1";
		
		if($yearget!=""){
			
			$query.=" AND year='$yearget' ";
		}else{
			$query.=" AND year='$skr' ";
		}
		if($branchidget!=''){
			
			$query.=" AND branchID='$branchidget' ";
		}
		if($grupcdget!=''){
			
			$query.=" AND GroupCD='$grupcdget' ";
		}
		if($typeitem != ''){
			if($typeitem =='Tidak Ada Tipe'){
				$query.=" AND TypeItem is null ";
			}else{
				$query.=" AND TypeItem like '%$typeitem%' ";
			}
		}
		$query.=" Group by Vendor) as dt ORDER BY total desc";

		$hasil=$this->db->query($query)->result();
		
		$this->load->view('templates/site_tpl', array (
			'content' => 'dashboard_vendor',
			'year'=>$year,
			'bc'=>$thbranch,
			'top'=>$top,
			'grupcd'=>$thbc,
			'thnya'=>$thnya,
			'hasil'=>$hasil,
			'kolom'=>$no,
			'grupcdisi'=>$grupcd,
			'tdnya'=>$tdnya,
			'link'=>'vendor',
			'tipeitem'=>$opttipe
		));
	}


}
