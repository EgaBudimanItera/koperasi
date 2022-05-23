<?php

class Migrasi extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->db=$this->load->database('default',true);
        $this->source=$this->load->database('source',true);
    }
    
    function getDataSourceByYear($year){
        $data=$this->source ->from('fmvSalesByJurnal')->where(array('Year'=>$year))
                            ->order_by('Year,Month','asc')
                            ->get()->result();
        return $data;
    }   
    function getDataSourceByYearMonth($year,$month){
        $data=$this->source->from('fmvSalesByJurnal')->where(array('Year'=>$year,'Month'=>$month))->get()->result();
        return $data;
    }   
}