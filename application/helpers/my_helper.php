<?php

function konfigurasi_wablas()
{
	return array (
		'url_api' => 'https://console.wablas.com',
		'token' => 'scOkBZSnnCxMLIFhj26qUhiUdbLz04GyIgaQQpuIx5hMsSAKQDzTkj2rIUFmvmn2',
		'encode_url_api' => 'aHR0cHM6Ly9jb25zb2xlLndhYmxhcy5jb20=',
	);
}

function hash_kata_sandi($kata_sandi)
{
	return md5("SAHAM-{$kata_sandi}-BALAM");
}
function menulv1( $uri = '',$id_pengguna_grup){
	$CI =& get_instance();
	$sql=$CI->db->query("
		SELECT * FROM pengguna_grup_menu a
		JOIN menu b on b.id=a.id_menu
		JOIN pengguna_grup c on c.id=a.id_pengguna_grup
		WHERE id_pengguna_grup='$id_pengguna_grup' and b.uri like '%$uri%'
	")->num_rows();
	return $sql;
}
function searchForId($id, $array) {
	foreach ($array as $key => $val) {
		if ($val['uri'] === $id) {
			return "ada";
		}
		var_dump($val);
	}
	return "tidak";
 }
function session_pengguna($kunci)
{
	$ci =& get_instance();
	
	$pengguna = $ci->session->userdata('pengguna');
	
	if ( ! $pengguna) {
		return null;
	}
	else {
		return $pengguna->$kunci;
	}
}


function session_menu()
{
	$ci =& get_instance();
	
	return $ci->session->userdata('menu');
}

function angka($integer)
{
	if ($integer == '') return null;
	else return number_format($integer, 0, '.', ',');
}

function rupiah($angka)
{
	if ($angka == '') return null;
	else if ($angka==0) return 'Rp0';
	else return 'Rp'.angka($angka);
}

function rupiah2($angka)
{
	if ($angka == 0) return 'Rp0';
	else return 'Rp'.number_format((float)$angka, 2, '.', ',');
}

function rupiah3($angka)
{
	if ($angka == 0) return 'Rp0';
	else return 'Rp'.number_format((float)$angka, 2, '.', ',');
}

function kode_vendor(){
	//AK0001
	$ci =& get_instance();
	$query = $ci->db->query("SELECT RIGHT(kode,4) as kode FROM vendor ORDER by id desc limit 1 ");
	
	if($query->num_rows() <> 0){      
	$data = $query->row();
	$kode = intval($data->kode) + 1;
	}
	else {       
	$kode = 1;
	}
	$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
	$kodejadi = 'V'.$kodemax;
	return $kodejadi;
}


function options_grup_pengguna($selected='',$id_vendor){
	$ci =& get_instance();
	
	$q="SELECT * FROM pengguna_grup where is_deleted='1' ";
	if($id_vendor!='1'){
		$q.="AND id_vendor='$id_vendor'";
	}
	$q.="order by id_vendor,urutan asc";
	$query = $ci->db->query($q)->result();

	$options = "";

	foreach ($query as $data) {
		$options .= "<option value='$data->id' " .($selected == $data->id ? 'selected' : ''). ">$data->nama ( $data->kode )</option>";
	}

	return $options;
}


function options_vendor($selected=''){
	$ci =& get_instance();
	$query = $ci->db->query("SELECT * FROM vendor where is_deleted='1' order by nama_vendor asc ")->result();

	$options = "";

	foreach ($query as $data) {
		$options .= "<option value='$data->id' " .($selected == $data->id ? 'selected' : ''). ">$data->nama_vendor</option>";
	}

	return $options;
}

function options_akun2($selected=''){
	$ci =& get_instance();
	$query = $ci->db->query("SELECT * FROM akun join sekuritas on seku_id=akun_seku_id  where akun_is_deleted='1' order by seku_nama asc ")->result();

	$options = "";

	foreach ($query as $data) {
		$options .= "<option value='$data->akun_id' " .($selected == $data->akun_id ? 'selected' : ''). ">$data->seku_nama - No SID : $data->akun_no_sid</option>";
	}

	return $options;
}
function options_bank($selected=''){
	$ci =& get_instance();
	$query = $ci->db->query("SELECT * FROM bank where bank_is_deleted='1' order by bank_judul asc")->result();

	$options = "";

	foreach ($query as $data) {
		$options .= "<option value='$data->bank_id' " .($selected == $data->bank_id ? 'selected' : ''). ">$data->bank_judul</option>";
	}

	return $options;
}

function strip_num_separator($str_num)
{
	$num = trim($str_num);
	$num = str_replace(',', '', $num);
	return $num;
}

function strip_num_separator2($str_num)
{
	$num = trim($str_num);
	$num = str_replace('.', '', $num);
	return $num;
}

function options($src, $id, $ref_val, $text_field, $data_attr = array())
{
	$options = '';
	
	foreach ($src->result() as $row) {
		
		$opt_value	= $row->$id;
		$text_value	= $row->$text_field;
		
		$data_attr_str = '';
		
		foreach ($data_attr as $class => $data_field) {
			$data_attr_str .= 'data-'.$class.'="'.$row->$data_field.'" ';
		}
		
		if ($row->$id == $ref_val) {
			$options .= '<option value="'.$opt_value.'" '.$data_attr_str.'selected>'.$text_value.'</option>';
		}
		else {
			$options .= '<option value="'.$opt_value.'" '.$data_attr_str.'>'.$text_value.'</option>';
		}
	}
	
	return $options;
}

function options_multiple($src, $id, $ref_val = array(), $text_field, $data_attr = array())
{
	$options = '';
	
	foreach ($src->result() as $row) {
		
		$opt_value	= $row->$id;
		$text_value	= $row->$text_field;
		
		$data_attr_str = '';
		
		foreach ($data_attr as $class => $data_field) {
			$data_attr_str .= 'data-'.$class.'="'.$row->$data_field.'" ';
		}
		
		if (in_array($row->$id, $ref_val)) {
			$options .= '<option value="'.$opt_value.'" '.$data_attr_str.'selected>'.$text_value.'</option>';
		}
		else {
			$options .= '<option value="'.$opt_value.'" '.$data_attr_str.'>'.$text_value.'</option>';
		}
	}
	
	return $options;
}

function data_post($kunci = array())
{
	$ci =& get_instance();
	$data = array();
	
	foreach ($kunci as $k_str) {
		
		$k_arr = explode('|', $k_str);
		
		if (isset($k_arr[1])) {
			switch ($k_arr[1]) {
				case 'number': {
					$nilai = trim($ci->input->post($k_arr[0]));
					$nilai = str_replace(',', '', $nilai);
					break;
				}
			}
		}
		else {
			$nilai = trim($ci->input->post($k_arr[0]));
		}
		
		if ($nilai != '') {
			$data[$k_arr[0]] = $nilai;
		}
	}
	
	return $data;
}

function nomor($id_perusahaan, $kode)
{
	$ci =& get_instance();
	
	
	$nomor = $ci->db
		->from('nomor')
		->where('id_vendor', $id_perusahaan)
		->where('kode', $kode)
		->get()
		->row();
	
	if ($nomor->tahun_sekarang == date('Y')) {
		if ($nomor->bulan_sekarang == date('m')) {
			$serial = $nomor->serial_berikutnya;
			$update = array('serial_berikutnya' => $serial + 1);
		}
		else {
			$update = array (
				'bulan_sekarang' => date('m'),
			);
			
			if ($nomor->reset_serial == 'bulanan') {
				$serial = 1;
				$update['serial_berikutnya'] = 2;
			}
			else {
				$serial = $nomor->serial_berikutnya;
				$update['serial_berikutnya'] = $serial + 1;
			}
		}
	}
	else {
		$serial = 1;
		$update = array (
			'tahun_sekarang' => date('Y'),
			'bulan_sekarang' => date('m'),
			'serial_berikutnya' => 2,
		);
	}
	
	$where = array('id_vendor' => $id_perusahaan, 'kode' => $kode);
	$ci->db->update('nomor', $update, $where);
	
	$serial_str = str_pad($serial, $nomor->digit_serial, '0', STR_PAD_LEFT);
	
	$wildcard = array('@y4', '@y2', '@m', '@serial');
	$replace = array(date('Y'), date('y'), date('m'), $serial_str);
	
	return str_replace($wildcard, $replace, $nomor->format_nomor);
}

function status($kode)
{
	return strtoupper(str_replace('_', ' ', $kode));
}

function kata_sandi_acak()
{
	$vokal = array('a', 'i', 'u', 'e', 'o');
	$konsonan = array();
	
	for ($i = 'a'; $i <= 'z'; $i++) {
		if (array_search($i, $vokal) === false) {
			$konsonan[] = $i;
		}
	}
	
	$kata_sandi = '';
	
	for ($i = 1; $i <= 6; $i++) {
		if ($i % 2 == 1) { # GANJIL = KONSONAN
			$idx = mt_rand(0, 20);
			$kata_sandi .= $konsonan[$idx];
		}
		
		if ($i % 2 == 0) { # GENAP = VOKAL
			$idx = mt_rand(0, 4);
			$kata_sandi .= $vokal[$idx];
		}
	}
	
	return $kata_sandi;
}

function cleansing_no_hp($no_hp)
{
	# HILANGKAN MINUS (-)
	$no_hp = str_replace('-', '', $no_hp);
	
	# HILANGKAN SPASI
	$no_hp = str_replace(' ', '', $no_hp);
	
	# HILANGKAN TITIK
	$no_hp = str_replace('.', '', $no_hp);
	
	# GANTI +62 DENGAN 0
	$no_hp = str_replace('+62', '0', $no_hp);
	
	# JIKA NOMOR DEPAN 62, GANTI DENGAN 0
	if (substr($no_hp, 0, 2) == '62') {
		$no_belakang = substr($no_hp, 2);
		$no_hp = '0'.$no_belakang;
	}
	
	return $no_hp;
}

function wablas_status()
{
	$wablas = konfigurasi_wablas();
	
	$response = json_decode(file_get_contents($wablas['url_api'].'/api/device/info?token='.$wablas['token']));
	
	$status = 'disconnected';
	
	if (isset($response->data->whatsapp->status)) {
		$status = $response->data->whatsapp->status;
	}
	
	return $status;
}

function wablas_url_qr()
{
	$wablas = konfigurasi_wablas();
	$url = $wablas['url_api'].'/generate/qr.php?token='.$wablas['token'].'&url='.$wablas['encode_url_api'];
	return $url;
}

function wablas_kirim($no_wa_tujuan, $pesan = '')
{
	$no_wa_tujuan = cleansing_no_hp($no_wa_tujuan);
	
	$wablas = konfigurasi_wablas();
	
	if ($pesan == '') $pesan = 'Uji coba pesan WA dari ASNET. Waktu kirim: '.date('d M Y H:i:s');
	
	$curl = curl_init();
	
	$data = array (
		'phone' => $no_wa_tujuan,
		'message' => $pesan,
	);

	curl_setopt ($curl, CURLOPT_HTTPHEADER,
		array (
			"Authorization: {$wablas['token']}",
		)
	);
	
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($curl, CURLOPT_URL, $wablas['url_api'].'/api/send-message');
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	
	$response = curl_exec($curl);
	curl_close($curl);
}

function kode_unik($nominal)
{
	$ci =& get_instance();
	
	$maks = 999;
	
	$sql = "
		select total - ? as kode_unik
		from invoice
		where
			status = 'belum_lunas'
			and floor(total / 1000) * 1000 = ?
			and is_hapus = 0
	";
	
	$src = $ci->db->query($sql, array($nominal, $nominal));
	
	if ($src->num_rows() == 0) {
		return mt_rand(1, $maks);
	}
	else {
		/*
		$kode_unik_arr = array();
		
		foreach ($src->result() as $row) {
			$kode_unik_arr[] = $row->kode_unik;
		}
		
		do {
			$kode_unik = mt_rand(1, $maks);
		}
		while (in_array($kode_unik, $kode_unik_arr));
		*/
		
		$kode_unik = mt_rand(1, $maks);
		return $kode_unik;
	}
}

function kode_unik_serial($tagihan)
{
	$ci =& get_instance();
	
	$sql = "
		select kode_unik
		from pelanggan_layanan
		where
			is_hapus = 0
			and status != 'off'
			and tagihan = ?
			and kode_unik != 0
		order by kode_unik
	";
	
	$src = $ci->db->query($sql, array($tagihan));
	
	$i = 1;
	
	foreach ($src->result() as $row) {
		if ($row->kode_unik != $i) {
			return $i;
		}
		
		$i++;
	}
	
	return $i;
}

function tgl_isolir_baru($tgl_numerik){

	$tgl_numerik = (int) $tgl_numerik;
	
	$tgl_array = array(
			'1' => 15,
			'2' => 16,
			'3' => 17,
			'4' => 18,
			'5' => 19,
			'6' => 20,
			'7' => 21,
			'8' => 22,
			'9' => 23,
			'10' => 24,
			'11' => 25,
			'12' => 26,
			'13' => 27,
			'14' => 28,
			'15' => 28,
			'16' => 1,
			'17' => 2,
			'18' => 3,
			'19' => 4,
			'20' => 5,
			'21' => 6,
			'22' => 7,
			'23' => 8,
			'24' => 9,
			'25' => 10,
			'26' => 11,
			'27' => 12,
			'28' => 13,
			'29' => 14,
			'30' => 15,
			'31' => 16,
		);

	return $tgl_array[$tgl_numerik];

}

function filterdata($data)
{
    $param = "";
    $totalparam = 0;
    foreach ($data as $index => $val) {
        $param .= $val != "" ? "/".$val : "/-";
        $totalparam += $val != "" ? 1 : 0;
    }

    $filer = $totalparam > 0 ? "/index".$param : "";

    return $filer;
}

function import_xls($data)
{
    $param = "";
    $totalparam = 0;
    foreach ($data as $index => $val) {
        $param .= $val != "" ? "/".$val : "/-";
        $totalparam += $val != "" ? 1 : 0;
    }

    $filer = $totalparam > 0 ? $param : "";

    return $filer;
}

function cekTransaksiBeforeDelete($master,$id){
	$ci =& get_instance();
	$hasil=0;
	if($master=="vendor"){
		$hasil=$ci->db->query("(SELECT * FROM vendor where id='$id' and is_deleted='1')")->num_rows();
	}
	else if($master=="pelanggan"){
		$hasil=$ci->db->query("(SELECT * FROM invoice where id_pelanggan='$id' and is_deleted='1')")->num_rows();
	}
	else if($master=="produk"){
		$hasil=$ci->db->query("(SELECT * FROM det_invoice a JOIN invoice b on a.id_invoice=b.id where a.id_produk='$id' and b.is_deleted='1')")->num_rows();
	}
	return $hasil;
}

