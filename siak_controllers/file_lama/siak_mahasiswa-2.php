<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak mahasiswa controller class */

class Siak_mahasiswa extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "mahasiswa") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
				$this->prodi_id = $value['prodi_id'];
			}
		}
		//echo '<pre>'; print_r($this->siak_session->siak_getAll());echo '</pre>'; die();
	}

	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->status = $this->siak_model->siak_data_list("status", "*");
		$prodi 	 = explode(',', $this->prodi_id);
		if($this->prodi_id != 0){
			$kondisi = "AND (a.prodi_id = ";
			foreach ($prodi as $value) {
				$kondisi .= "'".$value."' OR a.prodi_id = ";
			}
			$kondisi = substr($kondisi, 0, sizeof($kondisi) -18);
			$kondisi.= ")";
		}else{
			$kondisi = "";
		}
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.*, b.nama_depan, b.nama_belakang, b.telp_rumah, b.handphone, b.alamat_rumah, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id $kondisi UNION SELECT a.*, b.nama_depan, b.nama_belakang, b.telp_rumah, b.handphone, b.alamat_rumah, c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id $kondisi;");
		$this->siak_view->siak_render('siak_mahasiswa/data', false);
	}

	public function data_pribadi($nim, $jenis, $act){
		$this->siak_view->nim = $nim;
		$this->siak_view->jenis = $jenis;
		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nama as status_kawin, c.nama as agama FROM $table a, status_perkawinan b, agama c WHERE a.nim = '$nim' AND a.status_perkawinan_id = b.id AND a.agama_id = c.id;");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/'.$table, true); }
		elseif($act == "edit"){
			$this->siak_view->perkawinan = $this->siak_model->siak_data_list("status_perkawinan", "*");
			$this->siak_view->agama = $this->siak_model->siak_data_list("agama", "*");
			$this->siak_view->kelamin = $this->siak_model->siak_data_list("kelamin", "*");
			$this->siak_view->jenis_pns = $this->siak_model->siak_data_list("jenis_pns", "*");
			$this->siak_view->golongan = $this->siak_model->siak_data_list("golongan", "*");
			$this->siak_view->pangkat = $this->siak_model->siak_data_list("pangkat", "*");
			$this->siak_view->siak_render('siak_mahasiswa/'.$table.'_edit', true); }
	}

	public function data_keluarga($nim, $jenis, $act){
		$this->siak_view->nim = $nim;
		$this->siak_view->jenis = $jenis;
		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.kelamin_kode, b.status_perkawinan_id FROM keluarga_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_keluarga', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_keluarga_edit', true); }
	}

	public function data_pendidikan($nim, $jenis, $act){
		$this->siak_view->nim = $nim;
		$this->siak_view->jenis = $jenis;
		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM pendidikan_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_pendidikan', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_pendidikan_edit', true); }
	}

	public function data_bahasa_asing($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM bahasa_asing_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and ");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_bahasa_asing', true); }
		elseif($act == "edit"){
			$this->siak_view->status = $this->siak_model->siak_data_list("status", "*");
			$this->siak_view->siak_render('siak_mahasiswa/data_bahasa_asing_edit', true); }
	}

	public function data_kursus_latihan($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM kursus_latihan_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and ");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_kursus_latihan', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_kursus_latihan_edit', true); }
	}

	public function data_karya_ilmiah($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM karya_ilmiah_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and ");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_karya_ilmiah', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_karya_ilmiah_edit', true); }
	}

	public function data_seminar_ilmiah($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM seminar_ilmiah_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and ");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_seminar_ilmiah', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_seminar_ilmiah_edit', true); }
	}

	public function data_prestasi($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM prestasi_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and ");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_prestasi', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_prestasi_edit', true); }
	}

	public function data_pekerjaan($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM pekerjaan_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and ");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_pekerjaan', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_pekerjaan_edit', true); }
	}

	public function data_riwayat_pendidikan($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM riwayat_pendidikan_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and ");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_riwayat_pendidikan', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_riwayat_pendidikan_edit', true); }
	}

	public function data_riwayat_pangkat($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM riwayat_pangkat_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and ");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_riwayat_pangkat', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_riwayat_pangkat_edit', true); }
	}

	public function siak_edit_save($nim, $id, $table, $jenis){
		if($table == "bahasa_asing_mahasiswa" || $table == "kursus_latihan_mahasiswa" || $table == "riwayat_pangkat_mahasiswa" || $table == "riwayat_pendidikan_mahasiswa" || $table == "prestasi_mahasiswa" || $table == "seminar_ilmiah_mahasiswa" || $table == "karya_ilmiah_mahasiswa" || $table == "kursus_latihan_mahasiswa"){ 
			$where = array('id' => $id,);
		}else{ $where = array('nim' => $nim,);}
		$this->siak_model->siak_update_save($table, $where);
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}

	public function siak_insert_save($nim, $id, $table, $jenis){
		// var_dump($_POST); die();
		$this->siak_model->siak_custom_create ($table);
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}

	public function siak_delete($nim, $table, $id){
		$where = array('id' => $id);
		$this->siak_model->siak_custom_delete($table, $where);
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim);
	}

}