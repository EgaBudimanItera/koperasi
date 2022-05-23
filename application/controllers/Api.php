<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// use chriskacerguis\RestServer\RestController;

class Api extends CI_Controller {
    function __construct() {
		parent::__construct();
        
        $this->load->model(array('Migrasi'));
		$this->db=$this->load->database('default',true);
    }
    public function index_get(){
        $branchid=$this->input->get('branchid',true);
		$year=$this->input->get('year',true);	
		$kategori=$this->input->get('kategori',true);
		$grupcd=$this->input->get('grupcd',true);
        $cust = $this->input->get('cust');
        $vendor=$this->input->get('vendor');

        $query="SELECT TOP $kategori * from tb_stagging WHERE 1=1";

        // $this->db->select('TOP '.$kategori.' *')
        //          ->from('tb_stagging');
        if($branchid !=""){
            // $this->db->where('branchID',$branchid);
            $query.=" AND branchID='$branchid'";
        }
        if($year !=""){
            // $this->db->where('Year',$year);
            $query.=" AND Year='$year'";
        }
        if($grupcd !=""){
            // $this->db->where('GroupCD',$grupcd);
            $query.=" AND GroupCD='$grupcd'";
        }

        if($cust !=""){
            // $this->db->like('CustomerName ',str_replace('%20',' ',$cust));
            $cust=str_replace('%20',' ',$cust);
            $query.=" AND CustomerName like '%$cust%'";
        }

        if($vendor !=""){
            // $this->db->like('Vendor',str_replace('%20',' ',$vendor));
            $vendor=str_replace('%20',' ',$vendor);
            $query.=" AND Vendor like '%$vendor%'";
        }
        
        
        $data=$this->db->query($query)->result();
        echo json_encode($data);
        // return 
    }
    
}
