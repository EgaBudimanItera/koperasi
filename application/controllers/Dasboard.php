<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Include librari PhpSpreadsheet

class Dasboard extends CI_Controller {
	function __construct() {
		parent::__construct();
        if($this->session->userdata('branch_id') == ''||$this->session->userdata('branch_id') == NULL){
            echo '<script>alert("Tidak Dapat Diakses,Silahkan Login Dahulu");window.location.href = "https://fmm-eps.com/";</script>';
			exit();
        }   
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

		$thtahunnya='';
		$skr_1=date('Y');
		$akhir_1=$skr_1-4;
		$year_1="";
		$no_1=1;
		$field_1="Vendor";
		$totalfield_1='(0';
		$avgfield_1='((0';
		for($x=$skr_1;$x>=$akhir_1;$x--){
			$thtahunnya.="<th>".$x."</th>";
			$field_1.=", '$x' as Tahun_$no_1,sum(case when Year='$x' then amount else 0 end) as 'tahun_$x'";
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
		$query_1.=" Group By Vendor) as dt ORDER BY avg_year desc";
		$hasil=array();
		// $hasil=$this->db->query($query)->result();
		$hasil=$this->db->query($query_1)->result();
		$this->load->view('templates/site_tpl', array (
			'content' => 'dashboard_vendor',
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
			'link'=>'vendor',
			'tipeitem'=>$opttipe
		));
	}

	public function downloadExcell($branchid,$year,$kategori,$grupcds){
		
		// echo $branchid.'<br>';
		// echo $year.'<br>';
		// echo $kategori.'<br>';
		// echo $grupcds.'<br>';
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'LAPORAN CUSTOMER');

		//Header
		$sheet->setCellValue('A3', 'Customer');
		$sheet->setCellValue('B3', 'Bussiness Sector');


		$field="CustomerName,SectorBusiness";
		$grupcd=$this->db->select('GroupCD')
				 ->from('tb_stagging')
				//  ->where('GroupCD not in ()')
				 ->order_by('GroupCD','asc')
				 ->group_by('GroupCD')
				 ->get()
				 ->result();
		if(!empty($grupcd)){
			$no=1;
			$abjad_m = "C";
			$noexcel=3;
			foreach($grupcd as $g){
				$sheet->setCellValue($abjad_m.$noexcel, $g->GroupCD);
				$field.=",coalesce(sum(case when GroupCD='$g->GroupCD' then amount end),0) as F_$no";
				$no++;
				$abjad_m++;
			};
		}
		$sheet->setCellValue($abjad_m.$noexcel, 'Total');

		$limit="";
		
		$limit=" TOP $kategori ";
		$query="SELECT $limit $field,coalesce(sum(amount ),0) as total FROM tb_stagging WHERE 1=1";
		if($year!="kosong"){
			$query.=" AND year='$year' ";
			// echo "a AND year='$year' ";
		}
		if($branchid =="kosong"){
			
		}else{
			$query.=" AND branchID='$branchid' ";
			
		}
		if($grupcds=="kosong"){
			
		}else{
			$query.=" AND GroupCD='$grupcds' ";
			echo " AND GroupCD='$grupcd' ";
		}
		$query.=" Group By CustomerName,SectorBusiness ORDER BY total desc";

		$hasil=$this->db->query($query)->result();
		// var_dump($hasil);
		// die();
		$angkaurut=4;
		foreach($hasil as $h){
			$sheet->setCellValue('A'.$angkaurut, $h->CustomerName);
			$sheet->setCellValue('B'.$angkaurut, $h->SectorBusiness);
			$hurufurut="C";
			$no=1;
			foreach($grupcd as $g){
				$sheet->setCellValue($hurufurut.$angkaurut, $h->{'F_'.$no});
				$sheet->getStyle($hurufurut.$angkaurut)->getNumberFormat()->setFormatCode('#,##0');
				$hurufurut++;
				$no++;
			}
			$sheet->setCellValue($hurufurut.$angkaurut, $h->total);
			$sheet->getStyle($hurufurut.$angkaurut)->getNumberFormat()->setFormatCode('#,##0');
			$angkaurut++;
		}
		
		foreach ($sheet->getColumnIterator() as $column) {
			$sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
	 	}
		
		$styleArray1 = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN //细边框
                ]
            ]
        ];
        $last=$angkaurut-1;
		$sheet->getStyle('A3'.':'.$hurufurut.'3')->getFont()->setBold( true );
		$sheet->getStyle('A1'.':'.'A1')->getFont()->setBold( true );
		$sheet->mergeCells('A1:'.$hurufurut.'1');
		$sheet->getStyle('A1:'.'A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
		$sheet->getStyle('A1:'.'A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		$sheet->getStyle('A3:'.$hurufurut.'3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
		$sheet->getStyle('A3:'.$hurufurut.'3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A3'.':'.$hurufurut.$last)->applyFromArray($styleArray1);


		$writer = new Xlsx($spreadsheet);
		
		if (ob_get_contents()) ob_end_clean();
		header( "Content-type: application/vnd.ms-excel" );
		header('Content-Disposition: attachment; filename="laporan-Customer.xlsx"');
		header("Pragma: no-cache");
		header("Expires: 0");
		if (ob_get_contents()) ob_end_clean();
		$writer->save('php://output');

	}

	public function edit_form(){
		$skr=date('Y');
		$akhir=$skr+8;
		$year="";
		for($x=2015;$x<=$akhir;$x++){
			if($x==$skr){
				$year.="<option value='$x' selected>$x</option>";
			}else{
				$year.="<option value='$x'>$x</option>";
			}
			
		}
		
		$bc=$this->db->select('branchID,BranchCD')
				 ->from('tb_stagging')
				 ->group_by('BranchCD,branchID')
				 ->order_by('BranchCD','asc')
				 ->get()
				 ->result();
		$thbranch="";
		foreach($bc as $b){
			$thbranch.="<option value='$b->branchID'>$b->BranchCD</option>";
		}
		
		$top="<option value='10'>Top 10</option>";
		$top.="<option value='50'>Top 50</option>";
		$top.="<option value='100'>Top 100</option>";
		
		

		$grupcd=$this->db->select('GroupCD')
				 ->from('tb_stagging')
				//  ->where('GroupCD not in ()')
				 ->order_by('GroupCD','asc')
				 ->group_by('GroupCD')
				 ->get()
				 ->result();
		$thbc="";
		if(!empty($grupcd)){
			foreach($grupcd as $b){
				$thbc.="<option value='$b->GroupCD'>$b->GroupCD</option>";
			}	
		}	
		$src=$this->db->select('CustomerName')
					  ->from('tb_stagging')
					  ->Group_by('CustomerName')
					  ->order_by('CustomerName','asc')
					  ->get();
		$data=$src->result();
		$cust="";
		foreach($data as $b){
			$cust.="<option value='$b->CustomerName'>$b->CustomerName</option>";
		}
		$srcvendor=$this->db->select('Vendor')
					  ->from('tb_stagging')
					  ->Group_by('Vendor')
					  ->order_by('Vendor','asc')
					  ->get();
		$data=$srcvendor->result();
		$vendor="";
		foreach($data as $b){
			$vendor.="<option value='$b->Vendor'>$b->Vendor</option>";
		}
		$this->load->view('templates/site_tpl', array (
			'content' => 'edit_data',
			'link'=>'',
			'year'=>$year,
			'bc'=>$thbranch,
			'top'=>$top,
			'grupcd'=>$thbc,
			'cust'=>$cust,
			'vendor'=>$vendor,
		));
	}

	public function import_edit_form(){
		$skr=date('Y');
		$akhir=$skr+8;
		$year="";
		for($x=2015;$x<=$akhir;$x++){
			if($x==$skr){
				$year.="<option value='$x' selected>$x</option>";
			}else{
				$year.="<option value='$x'>$x</option>";
			}
		}
		
		$bc=$this->db->select('branchID,BranchCD')
				 ->from('tb_stagging')
				 ->group_by('BranchCD,branchID')
				 ->order_by('BranchCD','asc')
				 ->get()
				 ->result();
		$thbranch="";
		foreach($bc as $b){
			$thbranch.="<option value='$b->branchID'>$b->BranchCD</option>";
		}
		
		$top="<option value='10'>Top 10</option>";
		$top.="<option value='50'>Top 50</option>";
		$top.="<option value='100'>Top 100</option>";
		
		

		$grupcd=$this->db->select('GroupCD')
				 ->from('tb_stagging')
				//  ->where('GroupCD not in ()')
				 ->order_by('GroupCD','asc')
				 ->group_by('GroupCD')
				 ->get()
				 ->result();
		$thbc="";
		if(!empty($grupcd)){
			foreach($grupcd as $b){
				$thbc.="<option value='$b->GroupCD'>$b->GroupCD</option>";
			}	
		}	
		$src=$this->db->select('CustomerName')
					  ->from('tb_stagging')
					  ->Group_by('CustomerName')
					  ->order_by('CustomerName','asc')
					  ->get();
		$data=$src->result();
		$cust="";
		foreach($data as $b){
			$cust.="<option value='$b->CustomerName'>$b->CustomerName</option>";
		}
		$srcvendor=$this->db->select('Vendor')
					  ->from('tb_stagging')
					  ->Group_by('Vendor')
					  ->order_by('Vendor','asc')
					  ->get();
		$data=$srcvendor->result();
		$vendor="";
		foreach($data as $b){
			$vendor.="<option value='$b->Vendor'>$b->Vendor</option>";
		}
		$this->load->view('templates/site_tpl', array (
			'content' => 'import_edit_data',
			'link'=>'',
			'year'=>$year,
			'bc'=>$thbranch,
			'top'=>$top,
			'grupcd'=>$thbc,
			'cust'=>$cust,
			'vendor'=>$vendor,
		));
	}

	public function view_data(){
		$skr=date('Y');
		$akhir=$skr+8;
		$year="";
		for($x=2015;$x<=$akhir;$x++){
			$year.="<option value='$x'>$x</option>";
		}
		
		$bc=$this->db->select('branchID,BranchCD')
				 ->from('tb_stagging')
				 ->group_by('BranchCD,branchID')
				 ->order_by('BranchCD','asc')
				 ->get()
				 ->result();
		$thbranch="";
		foreach($bc as $b){
			$thbranch.="<option value='$b->branchID'>$b->BranchCD</option>";
		}
		
		$top="<option value='10'>Top 10</option>";
		$top.="<option value='50'>Top 50</option>";
		$top.="<option value='100'>Top 100</option>";
		
		

		$grupcd=$this->db->select('GroupCD')
				 ->from('tb_stagging')
				//  ->where('GroupCD not in ()')
				 ->order_by('GroupCD','asc')
				 ->group_by('GroupCD')
				 ->get()
				 ->result();
		$thbc="";
		if(!empty($grupcd)){
			foreach($grupcd as $b){
				$thbc.="<option value='$b->GroupCD'>$b->GroupCD</option>";
			}	
		}	
		$src=$this->db->select('CustomerName')
					  ->from('tb_stagging')
					  ->Group_by('CustomerName')
					  ->order_by('CustomerName','asc')
					  ->get();
		$data=$src->result();
		$cust="";
		foreach($data as $b){
			$cust.="<option value='$b->CustomerName'>$b->CustomerName</option>";
		}
		$srcvendor=$this->db->select('Vendor')
					  ->from('tb_stagging')
					  ->Group_by('Vendor')
					  ->order_by('Vendor','asc')
					  ->get();
		$data=$srcvendor->result();
		$vendor="";
		foreach($data as $b){
			$vendor.="<option value='$b->Vendor'>$b->Vendor</option>";
		}
		$this->load->view('templates/site_tpl', array (
			'content' => 'view_data',
			
			'year'=>$year,
			'bc'=>$thbranch,
			'top'=>$top,
			'grupcd'=>$thbc,
			'cust'=>$cust,
			'vendor'=>$vendor,
			'link'=>'',
		));
	}

	private function _data_detail()
	{
		$stagging = $this->input->post('stagging');
		
		$detail = array();
		
		foreach ($stagging['id'] as $i => $id) {
			$detail[] = array (
				'id' => $stagging['id'][$i],
				'BranchCD' => $stagging['BranchCD'][$i],
				'FinPeriodID' => $stagging['FinPeriodID'][$i],
				'Year' => $stagging['Year'][$i],
				'BatchNbr' => $stagging['BatchNbr'][$i],
				'GroupCD' => $stagging['GroupCD'][$i],
				'Vendor' => $stagging['Vendor'][$i],
				'debit' => strip_num_separator($stagging['debit'][$i]),
				'credit' => strip_num_separator($stagging['credit'][$i]),
				'amount' => strip_num_separator($stagging['amount'][$i]),
			);
		}
		
		return $detail;
	}

	public function simpan_perbaikan(){
		$stagging = $this->input->post('stagging');
		$queryi="";
		$detail = array();
		if(!empty($stagging)){
			foreach ($stagging['id'] as $i => $id) {
				$detail = array (
					'CompanyID' => $stagging['CompanyID'][$i],
					'branchID' => $stagging['branchID'][$i],
	
					'TranDate' => $stagging['TranDate'][$i],
					'FinPeriodID' => $stagging['FinPeriodID'][$i],
					'Year' => $stagging['Year'][$i],
	
					'Month' => $stagging['Month'][$i],
					'SubID' => $stagging['SubID'][$i],
					'BatchNbr' => $stagging['BatchNbr'][$i],
	
					'RefNbr' => $stagging['RefNbr'][$i],
					'CustomerName' => $stagging['CustomerName'][$i],
					'SectorBusiness' => $stagging['SectorBusiness'][$i],
	
					'SalesPerson' => $stagging['SalesPerson'][$i],
					'TranDesc' => $stagging['TranDesc'][$i],
					'BranchCD' => $stagging['BranchCD'][$i],
					
					'GroupCD' => $stagging['GroupCD'][$i],
					'Sub' => $stagging['Sub'][$i],
					'InventoryID' => $stagging['InventoryID'][$i],
					
					'InventoryCD' => $stagging['InventoryCD'][$i],
					'InventoryName' => $stagging['InventoryName'][$i],
					'VendorClass' => $stagging['VendorClass'][$i],
					'PrincipalCode' => $stagging['PrincipalCode'][$i],
					'Vendor' => $stagging['Vendor'][$i],
					'TypeItem' => $stagging['TypeItem'][$i],
					'TypeProduct' => $stagging['TypeProduct'][$i],
					'debit' => strip_num_separator($stagging['debit'][$i]),
	
					'credit' => strip_num_separator($stagging['credit'][$i]),
					'amount' => strip_num_separator($stagging['amount'][$i]),
				);
				$id = $stagging['id'][$i];
				
				// $this->db->trans_begin();
				$update=$this->db->update('tb_stagging', $detail, array('id'=>$id));
				$queryi.=$this->db->last_query();
			}
			// var_dump($queryi);
			// die();
			// if ($this->db->trans_status() === FALSE){
			// 	$this->db->trans_rollback();
			// 	echo '<script>alert("Gagal Disimpan")</script>';
			// 	echo'<script>window.location.href="'.base_url().'dasboard/edit_form";</script>';
			// 	exit();
			// }
			// else{
			// 	$this->db->trans_commit();
				echo '<script>alert("Berhasil Disimpan")</script>';
				echo'<script>window.location.href="'.base_url().'dasboard/edit_form";</script>';
			// 	exit();
			// }
		}else{
			echo '<script>alert("Data Kosong")</script>';
			echo'<script>window.location.href="'.base_url().'dasboard/edit_form";</script>';
			exit();
		}
		
	}

	public function ajax_stagging(){
		$cust = $this->input->post('cust');
		$year=$this->input->post('year');
		$branchid = $this->input->post('branchid');
		$grupcd=$this->input->post('grupcd');
		$vendor=$this->input->post('vendor');
		$refnbr=$this->input->post('refnbr');
		$query="SELECT * FROM tb_stagging WHERE 1=1 ";
		if($cust != "kosong"){
			$query.=" AND CustomerName='$cust'";
		}
		if($refnbr != "kosong"){
			$query.=" AND RefNbr like '%{$refnbr}%'";
		}
		if($year != "kosong"){
			$query.=" AND Year='$year'";
		}
		if($branchid != "kosong"){
			$query.=" AND branchID='$branchid'";
		}
		if($grupcd != "kosong"){
			$query.=" AND GroupCD='$grupcd'";
		}
		if($vendor != "kosong"){
			$query.=" AND Vendor='$vendor'";
		}
		$query.="ORDER by RefNbr asc";
		$src=$this->db->query($query);
		$type=$this->db->query("SELECT TypeProduct From tb_type_product GROUP By TypeProduct");
		$hasil=array(
			'data'=>$src->result(),
			'type'=>$type->result(),
		);
		header('Content-Type: application/json');
		echo json_encode($hasil);
	}

	public function ajax_type(){
		$type=$this->db->query("SELECT TypeProduct From tb_type_product GROUP By TypeProduct");
		header('Content-Type: application/json');
		echo json_encode($type->result());
	}

	public function getDataView($cust)
	{
		
		$src=$this->db->query("SELECT * FROM tb_stagging where CustomerName like '%$cust%'");
		
		$data = array();
		$no=1;
		foreach ($src->result() as $row) {
			$data[] = array (
				'id' => $row->id,
				'CompanyID' => $row->CompanyID,
				'branchID' => $row->branchID,
				'TranDate' => $row->TranDate,
				'FinPeriodID' => $row->FinPeriodID,
				'Year' => $row->Year,
                'Month' => $row->Month,
                'SubID' => $row->SubID,
                'BatchNbr'=>$row->BatchNbr,
				'RefNbr'=>$row->RefNbr,
				'CustomerName'=>$row->CustomerName,
				'SectorBusiness'=>$row->SectorBusiness,
				'SalesPerson'=>$row->SalesPerson,
				'TranDesc'=>$row->TranDesc,
				'BranchCD'=>$row->BranchCD,
				'GroupCD'=>$row->GroupCD,
				'Sub'=>$row->Sub,
				'InventoryID'=>$row->InventoryID,
				'InventoryCD'=>$row->InventoryCD,
				'InventoryName'=>$row->InventoryName,
				'VendorClass'=>$row->VendorClass,
				'Vendor'=>$row->Vendor,
				'TypeItem'=>$row->TypeItem,
				'debit'=>rupiah2($row->debit),
				'credit'=>rupiah2($row->credit),
				'amount'=>rupiah2($row->amount),
                'no'=>$no++,
			);
		}
		
		echo json_encode($data);
	}

	public function getDataViewVendor()
	{
		$vendor=$this->input->post('vendor');	
		
		$src=$this->db->query("SELECT * FROM tb_stagging where Vendor like '%$vendor%'");
		
		$data = array();
		$no=1;
		foreach ($src->result() as $row) {
			$data[] = array (
				'id' => $row->id,
				'CompanyID' => $row->CompanyID,
				'branchID' => $row->branchID,
				'TranDate' => $row->TranDate,
				'FinPeriodID' => $row->FinPeriodID,
				'Year' => $row->Year,
                'Month' => $row->Month,
                'SubID' => $row->SubID,
                'BatchNbr'=>$row->BatchNbr,
				'RefNbr'=>$row->RefNbr,
				'CustomerName'=>$row->CustomerName,
				'SectorBusiness'=>$row->SectorBusiness,
				'SalesPerson'=>$row->SalesPerson,
				'TranDesc'=>$row->TranDesc,
				'BranchCD'=>$row->BranchCD,
				'GroupCD'=>$row->GroupCD,
				'Sub'=>$row->Sub,
				'InventoryID'=>$row->InventoryID,
				'InventoryCD'=>$row->InventoryCD,
				'InventoryName'=>$row->InventoryName,
				'VendorClass'=>$row->VendorClass,
				'Vendor'=>$row->Vendor,
				'TypeItem'=>$row->TypeItem,
				'debit'=>rupiah2($row->debit),
				'credit'=>rupiah2($row->credit),
				'amount'=>rupiah2($row->amount),
                'no'=>$no++,
			);
		}
		
		echo json_encode($data);
	}
	
	public function getDataView2(){
		
		$draw = $this->input->post('draw');
		$offset = $this->input->post('start');
		$num_rows = $this->input->post('length');
		$order_index = $_POST['order'][0]['column'];
		$order_by = $_POST['columns'][$order_index]['data'];
		$order_direction = $_POST['order'][0]['dir'];
		$keyword = $_POST['search']['value'];
		$h=$offset+$num_rows;
		$bindings = array("%{$keyword}%","%{$keyword}%","%{$keyword}%","%{$keyword}%");
		$base_sql = "
			from tb_stagging
            
            where
				Vendor like ?
				or CustomerName like ?
				or BranchCD like ?
				or GroupCD like ?
		";
		$data_sql = "
			select
				*
				
			{$base_sql}
			order by
				{$order_by} {$order_direction}
				, id {$order_direction}
				OFFSET  $h ROWS 
				FETCH NEXT $num_rows ROWS ONLY 
		";
		
		$src = $this->db->query($data_sql, $bindings);
		$count_sql = "
			select count(*) AS total
			{$base_sql}
		";
		$total_records = $this->db->query($count_sql, $bindings)->row('total');
		$data = array();
		$no=1;
		foreach ($src->result() as $row) {
			$data[] = array (
				'id' => $row->id,
				'CompanyID' => $row->CompanyID,
				'branchID' => $row->branchID,
				'TranDate' => $row->TranDate,
				'FinPeriodID' => $row->FinPeriodID,
				'Year' => $row->Year,
                'Month' => $row->Month,
                'SubID' => $row->SubID,
                'BatchNbr'=>$row->BatchNbr,
				'RefNbr'=>$row->RefNbr,
				'CustomerName'=>$row->CustomerName,
				'SectorBusiness'=>$row->SectorBusiness,
				'SalesPerson'=>$row->SalesPerson,
				'TranDesc'=>$row->TranDesc,
				'BranchCD'=>$row->BranchCD,
				'GroupCD'=>$row->GroupCD,
				'Sub'=>$row->Sub,
				'InventoryID'=>$row->InventoryID,
				'InventoryCD'=>$row->InventoryCD,
				'InventoryName'=>$row->InventoryName,
				'VendorClass'=>$row->VendorClass,
				'Vendor'=>$row->Vendor,
				'TypeItem'=>$row->TypeItem,
				'debit'=>rupiah2($row->debit),
				'credit'=>rupiah2($row->credit),
				'amount'=>rupiah2($row->amount),
                'no'=>$no++,
				
			);
		}
		
		$response = array (
			'draw' => intval($draw),
			'iTotalRecords' => $src->num_rows(),
			'iTotalDisplayRecords' => $total_records,
			'aaData' => $data,
			'offset'=>$offset,
			'num'=>$num_rows,
		);
		
		echo json_encode($response);
	}	
	function get_tahun(){
		$skr=date('Y');
		$akhir=$skr-4;
		$retu="";
		for($x=$skr_1;$x>=$akhir_1;$x--){
			$retu.=$x.",";
		}
		return  rtrim($retu, ", ");
	}
	public function getDataView3(){
		$vendor=$this->input->post('nama');
		$grupcd=$this->input->post('grupcd');
		$branchid=$this->input->post('branchid');
		$year=$this->input->post('year');
		// var_dump($year);
		// die();
		$jenis=$this->input->post('jenis');
		// $tahun=$this->get_tahun();
		$draw = $this->input->post('draw');
		$offset = $this->input->post('start');
		$num_rows = $this->input->post('length');
		$order_index = $_POST['order'][0]['column'];
		$order_by = $_POST['columns'][$order_index]['data'];
		$order_direction = $_POST['order'][0]['dir'];
		$keyword = $_POST['search']['value'];
		if($offset==0){
			$h=0;
		}else{
			$h=$offset+$num_rows;
		}
		$bindings = array("");
		$base_sql = "
			from tb_stagging
            where
				1=1
		";
		
		if($jenis=='1'){
			if($year != 'kosong'){
				$base_sql.=" AND Year='$year'";
			}
		}
		else{
			$skr=date('Y');
			$akhir=$skr-4;
			$base_sql.=" AND Year >='$akhir' and Year<='$skr'";
		}
		
		if($vendor!=""){
			$base_sql.=" AND vendor like '%$vendor%'";
		}
		$data_sql = "
			select
				*
			{$base_sql}
			order by
				{$order_by} {$order_direction}
				, id {$order_direction}
				OFFSET  $h ROWS 
				FETCH NEXT $num_rows ROWS ONLY 
		";
		
		$src = $this->db->query($data_sql, $bindings);
		$count_sql = "
			select count(*) AS total
			{$base_sql}
		";
		$total_records = $this->db->query($count_sql, $bindings)->row('total');
		$data = array();
		$no=1+$offset;
		foreach ($src->result() as $row) {
			$data[] = array (
				'id' => $row->id,
				'CompanyID' => $row->CompanyID,
				'branchID' => $row->branchID,
				'TranDate' => $row->TranDate,
				'FinPeriodID' => $row->FinPeriodID,
				'Year' => $row->Year,
                'Month' => $row->Month,
                'SubID' => $row->SubID,
                'BatchNbr'=>$row->BatchNbr,
				'RefNbr'=>$row->RefNbr,
				'CustomerName'=>$row->CustomerName,
				'SectorBusiness'=>$row->SectorBusiness,
				'SalesPerson'=>$row->SalesPerson,
				'TranDesc'=>$row->TranDesc,
				'BranchCD'=>$row->BranchCD,
				'GroupCD'=>$row->GroupCD,
				'Sub'=>$row->Sub,
				'InventoryID'=>$row->InventoryID,
				'InventoryCD'=>$row->InventoryCD,
				'InventoryName'=>$row->InventoryName,
				'VendorClass'=>$row->VendorClass,
				'Vendor'=>$row->Vendor,
				'TypeItem'=>$row->TypeItem,
				'TypeProduct'=>$row->TypeProduct,
				'debit'=>rupiah2($row->debit),
				'credit'=>rupiah2($row->credit),
				'amount'=>rupiah2($row->amount),
                'no'=>$no++,
			);
		}
		
		$response = array (
			'draw' => intval($draw),
			'iTotalRecords' => $src->num_rows(),
			'iTotalDisplayRecords' => $total_records,
			'aaData' => $data,
			'offset'=>$offset,
			'num'=>$num_rows,
		);
		
		echo json_encode($response);
	}	

	public function getDataViewType(){
		$vendor=$this->input->post('nama');
		// $year=$this->input->post('year');
		
		$draw = $this->input->post('draw');
		$offset = $this->input->post('start');
		$num_rows = $this->input->post('length');
		$order_index = $_POST['order'][0]['column'];
		$order_by = $_POST['columns'][$order_index]['data'];
		$order_direction = $_POST['order'][0]['dir'];
		$keyword = $_POST['search']['value'];
		if($offset==0){
			$h=0;
		}else{
			$h=$offset+$num_rows;
		}
		$bindings = array("");
		$base_sql = "
			from tb_stagging
            where
				1=1
				
		";
		if($vendor!=""){
			$base_sql.=" AND vendor like '%$vendor%'";
		}
		// if($year != 'kosong'){
		// 	$base_sql.=" AND Year='$year'";
		// }
		$data_sql = "
			select
				Vendor,Year,TypeProduct,coalesce(sum(amount),0) as amount
			{$base_sql}
			Group by Vendor,Year,TypeProduct
			Order by TypeProduct asc
			OFFSET  $h ROWS 
			FETCH NEXT $num_rows ROWS ONLY 
		";
		// var_dump($data_sql);
		$src = $this->db->query($data_sql, $bindings);
		$count_sql = "
			select
			count(*) OVER () as total
			{$base_sql}
			Group by Vendor,Year,TypeProduct
		";
		
		$total_records = $this->db->query($count_sql, $bindings)->row('total');
		$data = array();
		$no=1+$offset;
		foreach ($src->result() as $row) {
			$data[] = array (
				'Vendor' => $row->Vendor,
				'Year' => $row->Year,
				'TypeProduct'=>$row->TypeProduct,
				'amount'=>rupiah2($row->amount),
                'no'=>$no++,
			);
		}
		
		$response = array (
			'draw' => intval($draw),
			'iTotalRecords' => $src->num_rows(),
			'iTotalDisplayRecords' => $total_records,
			'aaData' => $data,
			'offset'=>$offset,
			'num'=>$num_rows,
		);
		
		echo json_encode($response);
	}

	public function getDataViewBc(){
		$vendor=$this->input->post('nama');
		$year=$this->input->post('year');
		
		$draw = $this->input->post('draw');
		$offset = $this->input->post('start');
		$num_rows = $this->input->post('length');
		$order_index = $_POST['order'][0]['column'];
		$order_by = $_POST['columns'][$order_index]['data'];
		$order_direction = $_POST['order'][0]['dir'];
		$keyword = $_POST['search']['value'];
		if($offset==0){
			$h=0;
		}else{
			$h=$offset+$num_rows;
		}
		$bindings = array("");
		$base_sql = "
			from tb_stagging
            
            where
				1=1
				
		";
		
		if($vendor!=""){
			$base_sql.=" AND vendor like '%$vendor%'";
		}
		if($year != 'kosong'){
			$base_sql.=" AND Year='$year'";
		}
		
		$data_sql = "
			select
				Vendor,Year,BranchCD,coalesce(sum(amount),0) as amount
			{$base_sql}
			Group by Vendor,Year,BranchCD
			Order by BranchCD asc
			OFFSET  $h ROWS 
			FETCH NEXT $num_rows ROWS ONLY 
		";
		// var_dump($data_sql);
		$src = $this->db->query($data_sql, $bindings);
		$count_sql = "
			select
			count(*) OVER () as total
			{$base_sql}
			Group by Vendor,Year,BranchCD
		";
		
		$total_records = $this->db->query($count_sql, $bindings)->row('total');
		$data = array();
		$no=1+$offset;
		foreach ($src->result() as $row) {
			$data[] = array (
				'Vendor' => $row->Vendor,
				'Year' => $row->Year,
				'BranchCD'=>$row->BranchCD,
				'amount'=>rupiah2($row->amount),
                'no'=>$no++,
			);
		}
		
		$response = array (
			'draw' => intval($draw),
			'iTotalRecords' => $src->num_rows(),
			'iTotalDisplayRecords' => $total_records,
			'aaData' => $data,
			'offset'=>$offset,
			'num'=>$num_rows,
		);
		
		echo json_encode($response);
	}

	public function getDataViewBcDet(){
		$vendor=$this->input->post('nama');
		$year=$this->input->post('year');
		$type=$this->input->post('type');
		
		$draw = $this->input->post('draw');
		$offset = $this->input->post('start');
		$num_rows = $this->input->post('length');
		$order_index = $_POST['order'][0]['column'];
		$order_by = $_POST['columns'][$order_index]['data'];
		$order_direction = $_POST['order'][0]['dir'];
		$keyword = $_POST['search']['value'];
		if($offset==0){
			$h=0;
		}else{
			$h=$offset+$num_rows;
		}
		$bindings = array("");
		$base_sql = "
			from tb_stagging
            
            where
				1=1
				
		";
		
		if($vendor!=""){
			$base_sql.=" AND vendor like '%$vendor%'";
		}
		if($type!=""){
			$base_sql.=" AND TypeProduct like '%$type%'";
		}
		if($year != 'kosong'){
			$base_sql.=" AND Year='$year'";
		}
		
		$data_sql = "
			select
				Vendor,Year,BranchCD,coalesce(sum(amount),0) as amount
			{$base_sql}
			Group by Vendor,Year,BranchCD
			Order by BranchCD asc
			OFFSET  $h ROWS 
			FETCH NEXT $num_rows ROWS ONLY 
		";
		// var_dump($data_sql);
		$src = $this->db->query($data_sql, $bindings);
		$count_sql = "
			select
			count(*) OVER () as total
			{$base_sql}
			Group by Vendor,Year,BranchCD
		";
		
		$total_records = $this->db->query($count_sql, $bindings)->row('total');
		$data = array();
		$no=1+$offset;
		foreach ($src->result() as $row) {
			$data[] = array (
				'Vendor' => $row->Vendor,
				'Year' => $row->Year,
				'BranchCD'=>$row->BranchCD,
				'amount'=>rupiah2($row->amount),
                'no'=>$no++,
			);
		}
		
		$response = array (
			'draw' => intval($draw),
			'iTotalRecords' => $src->num_rows(),
			'iTotalDisplayRecords' => $total_records,
			'aaData' => $data,
			'offset'=>$offset,
			'num'=>$num_rows,
		);
		
		echo json_encode($response);
	}

	public function getDataView4(){
		// $vendora=str_replace('%20',' ',$vendor);
		// var_dump($vendora);
		$vendor=$this->input->post('nama');
		$grupcd=$this->input->post('grupcd');
		$branchid=$this->input->post('branchid');
		$year=$this->input->post('year');
		$jenis=$this->input->post('jenis');

		$draw = $this->input->post('draw');
		$offset = $this->input->post('start');
		$num_rows = $this->input->post('length');
		$order_index = $_POST['order'][0]['column'];
		$order_by = $_POST['columns'][$order_index]['data'];
		$order_direction = $_POST['order'][0]['dir'];
		$keyword = $_POST['search']['value'];
		if($offset==0){
			$h=0;
		}else{
			$h=$offset+$num_rows;
		}
		
		$bindings = array();
		$base_sql = "
			from tb_stagging
            where
				1=1
		";
		if($jenis=='1'){
			if($year != 'kosong'){
				$base_sql.=" AND Year='$year'";
			}
		}else{
			$skr=date('Y');
			$akhir=$skr-4;
			$base_sql.=" AND Year >='$akhir' and Year<='$skr'";
		}
		if($vendor == ''){
			$base_sql.=" AND CustomerName is null";
		}else{
			$base_sql.=" AND CustomerName like '%$vendor%'";
		}
		
		$data_sql = "
			select
				*
			{$base_sql}
			order by
				{$order_by} {$order_direction}
				, id {$order_direction}
				OFFSET  $h ROWS 
				FETCH NEXT $num_rows ROWS ONLY 
		";
		$src = $this->db->query($data_sql, $bindings);
		$count_sql = "
			select count(*) AS total
			{$base_sql}
		";
		$total_records = $this->db->query($count_sql, $bindings)->row('total');
		$data = array();
		$no=1+$offset;
		foreach ($src->result() as $row) {
			$data[] = array (
				'id' => $row->id,
				'CompanyID' => $row->CompanyID,
				'branchID' => $row->branchID,
				'TranDate' => $row->TranDate,
				'FinPeriodID' => $row->FinPeriodID,
				'Year' => $row->Year,
                'Month' => $row->Month,
                'SubID' => $row->SubID,
                'BatchNbr'=>$row->BatchNbr,
				'RefNbr'=>$row->RefNbr,
				'CustomerName'=>$row->CustomerName,
				'SectorBusiness'=>$row->SectorBusiness,
				'SalesPerson'=>$row->SalesPerson,
				'TranDesc'=>$row->TranDesc,
				'BranchCD'=>$row->BranchCD,
				'GroupCD'=>$row->GroupCD,
				'Sub'=>$row->Sub,
				'InventoryID'=>$row->InventoryID,
				'InventoryCD'=>$row->InventoryCD,
				'InventoryName'=>$row->InventoryName,
				'VendorClass'=>$row->VendorClass,
				'Vendor'=>$row->Vendor,
				'TypeItem'=>$row->TypeItem,
				'TypeProduct'=>$row->TypeProduct,
				'debit'=>rupiah2($row->debit),
				'credit'=>rupiah2($row->credit),
				'amount'=>rupiah2($row->amount),
                'no'=>$no++,
			);
		}
		$response = array (
			'draw' => intval($draw),
			'iTotalRecords' => $src->num_rows(),
			'iTotalDisplayRecords' => $total_records,
			'aaData' => $data,
			'offset'=>$offset,
			'num'=>$num_rows,
		);
		echo json_encode($response);
	}	

	public function getDataView5(){
		// $vendora=str_replace('%20',' ',$vendor);
		// var_dump($vendora);
		$cust = $this->input->post('cust');
		$year=$this->input->post('year');
		$branchid = $this->input->post('branchid');
		$grupcd=$this->input->post('grupcd');
		$vendor=$this->input->post('vendor');
		$refnbr=$this->input->post('refnbr');


		$draw = $this->input->post('draw');
		$offset = $this->input->post('start');
		$num_rows = $this->input->post('length');
		$order_index = $_POST['order'][0]['column'];
		$order_by = $_POST['columns'][$order_index]['data'];
		$order_direction = $_POST['order'][0]['dir'];
		$keyword = $_POST['search']['value'];
		if($offset==0){
			$h=0;
		}else{
			$h=$offset+$num_rows;
		}
		
		$bindings = array("");
		$base_sql = "
			from tb_stagging
            
            where
				1=1 
				
		";
		if($cust != "kosong"){
			$base_sql.=" AND CustomerName like '%$cust%'";
		}
		if($refnbr != "kosong"){
			$base_sql.=" AND RefNbr like '%$refnbr%'";
		}
		if($year != "kosong"){
			$base_sql.=" AND Year='$year'";
		}
		if($branchid != "kosong"){
			$base_sql.=" AND branchID='$branchid'";
		}
		if($grupcd != "kosong"){
			$base_sql.=" AND GroupCD='$grupcd'";
		}
		if($vendor != "kosong"){
			$base_sql.=" AND Vendor like '%$vendor%'";
		}
		$data_sql = "
			select
				*
				
			{$base_sql}
			order by

				 id {$order_direction}
				OFFSET  $h ROWS 
				FETCH NEXT $num_rows ROWS ONLY 
		";
		
		$src = $this->db->query($data_sql, $bindings);
		$count_sql = "
			select count(*) AS total
			{$base_sql}
		";
		$total_records = $this->db->query($count_sql, $bindings)->row('total');
		
		$data = array();
		$no=1+$offset;
		foreach ($src->result() as $row) {
			$data[] = array (
				'no'=>$no++,
				'id' => $row->id,
				'CompanyID' => $row->CompanyID,

				'branchID' => $row->branchID,
				
				'TranDate' => $row->TranDate,
				'FinPeriodID' => $row->FinPeriodID,
				'Year' => $row->Year,

                'Month' => $row->Month,
                'SubID' => $row->SubID,
                'BatchNbr'=>$row->BatchNbr,

				'RefNbr'=>$row->RefNbr,
				'CustomerName'=>$row->CustomerName,
				'SectorBusiness'=>$row->SectorBusiness,

				'SalesPerson'=>$row->SalesPerson,
				'TranDesc'=>$row->TranDesc,
				'BranchCD'=>$row->BranchCD,

				'GroupCD'=>$row->GroupCD,
				'Sub'=>$row->Sub,
				'InventoryID'=>$row->InventoryID,

				'InventoryCD'=>$row->InventoryCD,
				'InventoryName'=>$row->InventoryName,
				'VendorClass'=>$row->VendorClass,
				'PrincipalCode'=>$row->PrincipalCode,
				'Vendor'=>$row->Vendor,
				'TypeItem'=>$row->TypeItem,
				'TypeProduct'=>$row->TypeProduct,
				'debit'=>rupiah2($row->debit),

				'credit'=>rupiah2($row->credit),
				'amount'=>rupiah2($row->amount),
                
			);
		}
		
		$response = array (
			'draw' => intval($draw),
			'iTotalRecords' => $src->num_rows(),
			'iTotalDisplayRecords' => $total_records,
			'aaData' => $data,
			'offset'=>$offset,
			'num'=>$num_rows,
		);
		
		echo json_encode($response);
	}

	public function edit_proses(){
		$test = $this->load->library('PHPExcel', 'phpexcel');
		if (isset($_FILES["fileExcel"]["name"])) {
			$path = $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet){
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++){
					$id 			= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$CompanyID		= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$branchID		= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					// $cellValue  	= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    // $dateValue  	= PHPExcel_Shared_Date::ExcelToPHP($cellValue);                       
                    $TranDate   	= $worksheet->getCellByColumnAndRow(3, $row)->getValue();  
					$FinPeriodID 	= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$Year 			= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$Month 			= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$SubID 			= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$BatchNbr 		= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$RefNbr 		= $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$CustomerName 	= $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$SectorBusiness = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$SalesPerson 	= $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$TranDesc 		= $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$BranchCD 		= $worksheet->getCellByColumnAndRow(14, $row)->getValue();
					$GroupCD 		= $worksheet->getCellByColumnAndRow(15, $row)->getValue();
					$Sub	 		= $worksheet->getCellByColumnAndRow(16, $row)->getValue();
					$InventoryID 	= $worksheet->getCellByColumnAndRow(17, $row)->getValue();
					$InventoryCD 	= $worksheet->getCellByColumnAndRow(18, $row)->getValue();
					$InventoryName 	= $worksheet->getCellByColumnAndRow(19, $row)->getValue();
					$VendorClass 	= $worksheet->getCellByColumnAndRow(20, $row)->getValue();
					$PrincipalCode 	= $worksheet->getCellByColumnAndRow(21, $row)->getValue();
					$Vendor 		= $worksheet->getCellByColumnAndRow(22, $row)->getValue();
					$TypeItem 		= $worksheet->getCellByColumnAndRow(23, $row)->getValue();
					$TypeProduct 	= $worksheet->getCellByColumnAndRow(24, $row)->getValue();
					$debit 			= $worksheet->getCellByColumnAndRow(25, $row)->getValue();
					$credit 		= $worksheet->getCellByColumnAndRow(26, $row)->getValue();
					$amount 		= $worksheet->getCellByColumnAndRow(27, $row)->getValue();
					$temp_data[] = array(
						'id'			=> $id,
						'CompanyID'		=> $CompanyID,
						'branchID'		=> $branchID,
						'TranDate'		=> $TranDate,
						'FinPeriodID'	=> $FinPeriodID,
						'Year'			=> $Year,
						'Month'			=>$Month,
						'SubID'			=>$SubID,
						'BatchNbr'		=>$BatchNbr,
						'RefNbr'		=>$RefNbr,
						'CustomerName'	=>$CustomerName,
						'SectorBusiness'=>$SectorBusiness,
						'SalesPerson'	=>$SalesPerson,
						'TranDesc'		=>$TranDesc,
						'BranchCD'		=>$BranchCD,
						'GroupCD'		=>$GroupCD,
						'Sub'			=>$Sub,
						'InventoryID'	=>$InventoryID,
						'InventoryCD'	=>$InventoryCD,
						'InventoryName'	=>$InventoryName,
						'VendorClass'	=>$VendorClass,
						'PrincipalCode'	=>$PrincipalCode,
						'Vendor'		=>$Vendor,
						'TypeItem'		=>$TypeItem,
						'TypeProduct'	=>$TypeProduct,
						'debit'			=>$debit,
						'credit'		=>$credit,
						'amount'		=>$amount,	
					); 	
				}
			}
			var_dump(json_encode($temp_data));
			die();
			$this->db->trans_begin();
			$this->db->empty_table('tb_stagging_edit');
			$this->db->insert_batch('tb_stagging_edit', $temp_data);
			// die();
			$query="
				UPDATE stag
				SET 
				stag.CompanyID=stag_edit.CompanyID, 
				stag.branchID=stag_edit.branchID,
				stag.TranDate=stag_edit.TranDate,
				stag.FinPeriodID=stag_edit.FinPeriodID,
				stag.Year=stag_edit.Year,
				stag.Month=stag_edit.Month,
				stag.SubID=stag_edit.SubID,
				stag.BatchNbr=stag_edit.BatchNbr,
				stag.RefNbr=stag_edit.RefNbr,
				stag.CustomerName=stag_edit.CustomerName,
				stag.SectorBusiness=stag_edit.SectorBusiness,
				stag.SalesPerson=stag_edit.SalesPerson,
				stag.TranDesc=stag_edit.TranDesc,
				stag.BranchCD=stag_edit.BranchCD,
				stag.GroupCD=stag_edit.GroupCD,
				stag.Sub=stag_edit.Sub,
				stag.InventoryID=stag_edit.InventoryID,
				stag.InventoryCD=stag_edit.InventoryCD,
				stag.InventoryName=stag_edit.InventoryName,
				stag.VendorClass=stag_edit.VendorClass,
				stag.PrincipalCode=stag_edit.PrincipalCode,
				stag.Vendor=stag_edit.Vendor,
				stag.TypeItem=stag_edit.TypeItem,
				stag.TypeProduct=stag_edit.TypeProduct,
				stag.debit=stag_edit.debit,
				stag.credit=stag_edit.credit,
				stag.amount=stag_edit.amount
				FROM tb_stagging stag
				INNER JOIN
				tb_stagging_edit stag_edit
				ON stag.id = stag_edit.id
			";
			$this->db->query($query);
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				echo '<script>alert("Gagal Diubah")</script>';
				echo'<script>window.location.href="'.base_url().'dasboard/import_edit_form";</script>';
			}
			else{
				$this->db->trans_commit();
				echo '<script>alert("Berhasil Diubah")</script>';
				echo'<script>window.location.href="'.base_url().'dasboard/import_edit_form";</script>';
			}
			// var_dump(json_encode($temp_data));
		}
	}

}
