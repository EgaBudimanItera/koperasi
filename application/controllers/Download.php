<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Include librari PhpSpreadsheet

class Download extends CI_Controller {
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

    public function donlodexcel($cust,$vendor,$grupcd,$branchid,$year,$refnbr)
	{
		//echo "Loading";
		ini_set("memory_limit","512M");
		$test = $this->load->library('PHPExcel', 'phpexcel');
		$object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		$table_columns = array("ID", "COMPANY ID", "BRANCH ID", "TRAN DATE", "FIN PERIOD ID",
			"YEAR","MONTH","SUB ID","BATCH NBR","REF NBR","CUSTOMER NAME","SECTOR BUSSINESS",
			"SALES PERSON","TRAN DESC","BRANCH CD","GROUP CD","SUB","INVENTORY ID","INVENTORY CD",
			"INVENTORY NAME","VENDOR CLASS","PRINCIPAL CODE","VENDOR","TYPE ITEM","TYPE PRODUCT","DEBIT","CREDIT","AMOUNT");
		$column = 0;
		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			// $object->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
			$column++;
		}
		if($cust=="kosong" && $refnbr=="kosong" && $vendor=="kosong" && $grupcd=="kosong" && $branchid=="kosong" ){
			$query="SELECT top 3000 * FROM tb_stagging where 1=1";
		}else{
			$query="SELECT * FROM tb_stagging where 1=1";
		}
		// $query="SELECT * FROM tb_stagging where 1=1";
		if($cust != "kosong"){
			$query.=" AND CustomerName like '%$cust%'";
		}
		if($refnbr != "kosong"){
			$query.=" AND RefNbr like '%$refnbr%'";
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
			$query.=" AND Vendor like '%$vendor%'";
		}
		$query.=" Order by TranDate asc";
		
		$employee_data = $this->db->query($query);
		if($employee_data->num_rows()>1000){
			echo '<script>alert("Gagal Download !! Data Melebihi 1000")</script>';
			echo'<script>window.location.href="'.base_url().'dasboard/import_edit_form";</script>';
			exit();
		}
		$excel_row = 2;
		foreach($employee_data->result() as $row)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->CompanyID);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->branchID);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->TranDate);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->FinPeriodID);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->Year);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->Month);
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->SubID);
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->BatchNbr);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->RefNbr);
			$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->CustomerName);
			$object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->SectorBusiness);
			$object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->SalesPerson);
			$object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row->TranDesc);
			$object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row->BranchCD);
			$object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->GroupCD);
			$object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row->Sub);
			$object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $row->InventoryID);
			$object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row->InventoryCD);
			$object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $row->InventoryName);
			$object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, $row->VendorClass);
			$object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $row->PrincipalCode);
			$object->getActiveSheet()->setCellValueByColumnAndRow(22, $excel_row, $row->Vendor);
			$object->getActiveSheet()->setCellValueByColumnAndRow(23, $excel_row, $row->TypeItem);
			$object->getActiveSheet()->setCellValueByColumnAndRow(24, $excel_row, $row->TypeProduct);
			$object->getActiveSheet()->setCellValueByColumnAndRow(25, $excel_row, $row->debit);
			$object->getActiveSheet()->setCellValueByColumnAndRow(26, $excel_row, $row->credit);
			$object->getActiveSheet()->setCellValueByColumnAndRow(27, $excel_row, $row->amount);
			$excel_row++;
		}
		for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
			$object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data FMM.xls"');
		$object_writer->save('php://output');
	}

	public function donlodexcelajax()
	{
		$cust=$this->input->post('cust');
		$vendor=$this->input->post('vendor');
		$grupcd=$this->input->post('grupcd');
		$branchid=$this->input->post('$branchid');
		$year=$this->input->post('year');
		$refnbr=$this->input->post('refnbr');
		ini_set("memory_limit","512M");
		$test = $this->load->library('PHPExcel', 'phpexcel');
		$object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		$table_columns = array("ID", "COMPANY ID", "BRANCH ID", "TRAN DATE", "FIN PERIOD ID",
			"YEAR","MONTH","SUB ID","BATCH NBR","REF NBR","CUSTOMER NAME","SECTOR BUSSINESS",
			"SALES PERSON","TRAN DESC","BRANCH CD","GROUP CD","SUB","INVENTORY ID","INVENTORY CD",
			"INVENTORY NAME","VENDOR CLASS","PRINCIPAL CODE","VENDOR","TYPE ITEM","TYPE PRODUCT","DEBIT","CREDIT","AMOUNT");
		$column = 0;
		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			// $object->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
			$column++;
		}
		if($cust=="kosong" && $refnbr=="kosong" && $vendor=="kosong" && $grupcd=="kosong" && $branchid=="kosong" ){
			$query="SELECT top 3000 * FROM tb_stagging where 1=1";
		}else{
			$query="SELECT * FROM tb_stagging where 1=1";
		}
		// $query="SELECT * FROM tb_stagging where 1=1";
		if($cust != "kosong"){
			$query.=" AND CustomerName like '%$cust%'";
		}
		if($refnbr != "kosong"){
			$query.=" AND RefNbr like '%$refnbr%'";
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
			$query.=" AND Vendor like '%$vendor%'";
		}
		$query.=" Order by TranDate asc";
		
		$employee_data = $this->db->query($query);
		if($employee_data->num_rows()>1000){
			echo '<script>alert("Gagal Download !! Data Melebihi 1000")</script>';
			echo'<script>window.location.href="'.base_url().'dasboard/import_edit_form";</script>';
			exit();
		}
		$excel_row = 2;
		foreach($employee_data->result() as $row)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->CompanyID);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->branchID);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->TranDate);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->FinPeriodID);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->Year);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->Month);
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->SubID);
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->BatchNbr);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->RefNbr);
			$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->CustomerName);
			$object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->SectorBusiness);
			$object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->SalesPerson);
			$object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row->TranDesc);
			$object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row->BranchCD);
			$object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->GroupCD);
			$object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $row->Sub);
			$object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $row->InventoryID);
			$object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $row->InventoryCD);
			$object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $row->InventoryName);
			$object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, $row->VendorClass);
			$object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $row->PrincipalCode);
			$object->getActiveSheet()->setCellValueByColumnAndRow(22, $excel_row, $row->Vendor);
			$object->getActiveSheet()->setCellValueByColumnAndRow(23, $excel_row, $row->TypeItem);
			$object->getActiveSheet()->setCellValueByColumnAndRow(24, $excel_row, $row->TypeProduct);
			$object->getActiveSheet()->setCellValueByColumnAndRow(25, $excel_row, $row->debit);
			$object->getActiveSheet()->setCellValueByColumnAndRow(26, $excel_row, $row->credit);
			$object->getActiveSheet()->setCellValueByColumnAndRow(27, $excel_row, $row->amount);
			$excel_row++;
		}
		for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
			$object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
		}
		$objWriter = new PHPExcel_Writer_Excel2007($object);
		$response = array(
			'success' => true,
			'url' => $this->saveExcelToLocalFile($objWriter)
		);
		echo json_encode($response);
		exit();

	}
	function saveExcelToLocalFile($objWriter){
		// make sure you have permission to write to directory
		$filePath = '../tmp/saved_File.xlsx';
		$objWriter->save($filePath);
		return $filePath;
	}
    public function donlodtemplate()
	{
		ini_set("memory_limit","512M");
		$test = $this->load->library('PHPExcel', 'phpexcel');
		$object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		$table_columns = array("PRINCIPAL CODE","CODE","PRINCIPAL","TYPEPRODUCT");
		$column = 0;
		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			// $object->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
			$column++;
		}
        $query="SELECT * FROM tb_type_product";
		
		$employee_data = $this->db->query($query);
		if($employee_data->num_rows()>1000){
			echo '<script>alert("Gagal Download !! Data Melebihi 1000")</script>';
			echo'<script>window.location.href="'.base_url().'dasboard/import_edit_form";</script>';
			exit();
		}
		$excel_row = 2;
		foreach($employee_data->result() as $row)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->PrincipalCode);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->Code);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->Principal);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, rtrim($row->TypeProduct));
			
			$excel_row++;
		}
		for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
			$object->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data Type Product.xls"');
		$object_writer->save('php://output');
	}
}