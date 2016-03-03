<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak mahasiswa controller class */

class Siak_mahasiswa extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->level = $_SESSION['level'];
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
	
	$prodi_id = $_SESSION['prodi'];
	$nim = $_SESSION['username'];
	$mhs = $this->siak_model->siak_query("select","select * from mahasiswa where nim = '$nim' or prodi_id = '$prodi_id'");
	
// 	echo $prodi_id;die();
	
	foreach($mhs as $row => $rec): $prodi_new = $rec['prodi_id']; endforeach;
	
	
		$this->siak_view->status = $this->siak_model->siak_data_list("status", "*");
		
		$prodi 	 = explode(',', $this->prodi_id);
		
// 		$ada = (!in_array($prodi_new, $prodi)) ? "tidak ada":"ada";
// 		
// 		var_dump($this->prodi_id);die();
		
		if($prodi_id == NULL || $prodi_id == ''){
		      $kondisi = "";
		}else{
		      $kondisi = "AND a.prodi_id = '$prodi_id'";
		}
		
		if($nim == $rec['nim']){
				      
			$sql = "
				SELECT * 
				FROM 
					(
					  SELECT 
						a.*, 
						b.nama_depan, 
						b.nama_belakang, 
						b.telp_rumah, 
						b.handphone, 
						b.alamat_rumah, 
						c.prodi 
					  FROM 
						mahasiswa a, 
						data_pribadi_umum b, 
						prodi c 
					  WHERE 
						a.nim = b.nim AND 
						a.prodi_id = c.prodi_id 
						$kondisi 
					  UNION SELECT 
						a.*, 
						b.nama_depan, 
						b.nama_belakang, 
						b.telp_rumah, 
						b.handphone, 
						b.alamat_rumah, 
						c.prodi 
					  FROM 
						mahasiswa a, 
						data_pribadi_pns b, 
						prodi c 
					  WHERE 
						a.nim = b.nim AND 
						a.prodi_id = c.prodi_id 
						$kondisi
					) as x
				WHERE x.nim = '$nim'";
			    
		}else{
		
			$sql = "
				SELECT *from (SELECT 
				      a.*, 
				      b.nama_depan, 
				      b.nama_belakang, 
				      b.telp_rumah, 
				      b.handphone, 
				      b.alamat_rumah, 
				      c.prodi 
				FROM 
				      mahasiswa a, 
				      data_pribadi_umum b, 
				      prodi c 
				WHERE 
				      a.nim = b.nim AND 
				      a.prodi_id = c.prodi_id 
				      $kondisi 
				UNION SELECT 
				      a.*, 
				      b.nama_depan, 
				      b.nama_belakang, 
				      b.telp_rumah, 
				      b.handphone, 
				      b.alamat_rumah, 
				      c.prodi 
				FROM 
				      mahasiswa a, 
				      data_pribadi_pns b, 
				      prodi c 
				WHERE 
				      a.nim = b.nim AND 
				      a.prodi_id = c.prodi_id 
				      $kondisi)as result order by nim asc;";
				      
		}
		
		echo $sql;die();
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select",$sql);
		$this->siak_view->siak_render('siak_mahasiswa/data', false);
	
	}

	public function data_pribadi($nim, $jenis, $act){
		$this->siak_view->nim = $nim;
		$this->siak_view->jenis = $jenis;
		
		if ($jenis == 'Umum' || $jenis == 'umum') {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nama as status_kawin, c.nama as agama FROM $table a, status_perkawinan b, agama c WHERE a.nim = '$nim' AND a.status_perkawinan_id = b.id AND a.agama_id = c.id;");
		
// 		var_dump($table);die();
		
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
		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM keluarga WHERE nim = '$nim'");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_keluarga', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_keluarga_edit', true); }
	}

	public function data_pendidikan($nim, $jenis, $act, $id){
		//echo $nim." ".$jenis." ".$act;die();
		$this->siak_view->nim = $nim;
		$this->siak_view->jenis = $jenis;
		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM pendidikan_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_pendidikan', true); }
		elseif($act == "edit"){
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM pendidikan_mahasiswa WHERE nim = '$nim' and id = '$id'");
			$this->siak_view->siak_render('siak_mahasiswa/data_pendidikan_edit', true); }
	}
	
	function add_data_pendidikan($jenis,$nosel,$nim){
		$this->siak_view->jenis = $jenis;
		$this->siak_view->nosel = $nosel;
		$this->siak_view->nim = $nim;
		$this->siak_view->siak_render("siak_mahasiswa/add_data_pendidikan", true);
	}
	
	
	function tambah_pendidikan($nim,$jenis){
		//var_dump($jenis);die();
		$this->siak_model->siak_custom_create("pendidikan_mahasiswa");
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}
	
	////////////////////////////////////////////////////////////////////////////////////////
	////// BAHASA ASING
	////////////

	public function data_bahasa_asing($nim, $jenis, $act, $id){
		$this->siak_view->level = $this->level;
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM bahasa_asing a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM bahasa_asing a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'");
// 		echo "SELECT a.*, b.nim FROM bahasa_asing a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'";
// 		var_dump($this->siak_view->siak_data);
// 		die();
		
		if($act == "data"){ 
			$this->siak_view->nim = $nim;
			$this->siak_view->id = $id;
			$this->siak_view->jenis = $jenis;
			$this->siak_view->siak_render('siak_mahasiswa/bhs_asing/data_bahasa_asing', true); 
			
		}elseif($act == "edit"){
			$this->siak_view->status = $this->siak_model->siak_data_list("status", "*");
			$this->siak_view->siak_render('siak_mahasiswa/bhs_asing/data_bahasa_asing_edit', true); 
		}
	}
	
	function add_bahasa_asing($jenis,$nim){
		$this->siak_view->jenis = $jenis;
		$this->siak_view->nim = $nim;
		$this->siak_view->siak_render('siak_mahasiswa/bhs_asing/add_bahasa_asing', true);
	}
	
	function tambah_bhs($nim,$jenis){
		
// 		var_dump($_POST);die();
		$this->siak_model->siak_custom_create("bahasa_asing");
// 		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}
	
	function cek_bahasa_asing( $nim, $jenis, $id, $bahasa, $edit_idx){
		if($edit_idx == NULL){
			$edit_id = '0';
		}else{
			$edit_id = $edit_idx;
		}
	
		$sql = "select edit_id from bahasa_asing where nim = '$nim' and edit_id = '$id'";
		
		$result = $this->siak_model->siak_query("select", $sql);
		
// 		var_dump($result);die();
		
		if($result == NULL && $edit_id == '0'){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editMBH" onclick="editMBH(this)" link="'.URL.'siak_mahasiswa/data_bahasa_asing/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Edit</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMBH" onclick="kirim_id(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Delete</a>
		    ';
		}
		else if($this->level != '16'){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMBH" onclick="kirim_id2(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Approve</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMBH" onclick="kirim_id(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Disagree</a>
		    ';
		}
		
		else{
		  
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Approve</span>
			</span>';
		  
		}
		
	}
	
	////////////
	////// END BAHASA ASING
	////////////////////////////////////////////////////////////////////////////////////////
	
	////////////////////////////////////////////////////////////////////////////////////////
	////// KURSUS LATIHAN
	////////////

	public function data_kursus_latihan($nim, $jenis, $act, $id){
		$data = array($nim, $jenis, $act);
		
		$this->siak_view->nim = $nim;
		
		$this->siak_view->jenis = $jenis;
		
		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM kursus_latihan a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'");
		
		if($act == "data"){ 
			$this->siak_view->siak_render('siak_mahasiswa/kursus_latihan/data_kursus_latihan', true); 
		}elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/kursus_latihan/data_kursus_latihan_edit', true); 
		}
	}
	
	function add_kursus($jenis,$nim){
		$this->siak_view->jenis = $jenis;
		$this->siak_view->nim = $nim;
		$this->siak_view->siak_render('siak_mahasiswa/kursus_latihan/add_kursus', true);
	}
	
	function tambah_kursus($nim,$jenis){
		
// 		var_dump($_POST);die();
		$this->siak_model->siak_custom_create("kursus_latihan");
// 		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}
	
	function cek_kursus( $nim, $jenis, $id, $bahasas, $edit_idx){
		$bahasa = rawurldecode($bahasas);
		
// 		echo $bahasa;
		
		if($edit_idx == NULL){
			$edit_id = '0';
		}else{
			$edit_id = $edit_idx;
		}
		
		$data = array( $nim, $jenis, $id, $bahasa, $edit_id);
		
// 		var_dump($edit_idx);
		
		$sql = "select edit_id from kursus_latihan where nim = '$nim' and edit_id = '$id'";
		
		$result = $this->siak_model->siak_query("select", $sql);
		
// 		var_dump($sql);die();
		
		if($result == NULL && $edit_id == 0){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editMKL" onclick="editMKL(this)" link="'.URL.'siak_mahasiswa/data_kursus_latihan/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Edit</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMKL" onclick="kirim_idMKL(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Delete</a>
		    ';
		}
		else if($this->level != '16'){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMKL" onclick="kirim_id2MKL(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Approve</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMKL" onclick="kirim_idMKL(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Disagree</a>
		    ';
		}
		
		else{
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Approve</span>
			</span>';
		}
		
	}
	
	////////////
	////// END KURSUS LATIHAN
	////////////////////////////////////////////////////////////////////////////////////////
	
	////////////////////////////////////////////////////////////////////////////////////////
	////// KARYA ILMIAH
	////////////

	public function data_karya_ilmiah($nim, $jenis, $act, $id){
		$data = array($nim, $jenis, $act);
// 		var_dump($data);die();
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;
		
		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}
		
		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM karya_ilmiah a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0' ");
		
		if($act == "data"){ 
		    $this->siak_view->siak_render('siak_mahasiswa/karya_ilmiah/data_karya_ilmiah', true); 
		}elseif($act == "edit"){
		    $this->siak_view->siak_render('siak_mahasiswa/karya_ilmiah/data_karya_ilmiah_edit', true); 
		}
	}
	
	function add_karya($jenis,$nim){
		$this->siak_view->jenis = $jenis;
		$this->siak_view->nim = $nim;
		$this->siak_view->siak_render('siak_mahasiswa/karya_ilmiah/add_karya', true);
	}
	
	function tambah_karya($nim,$jenis){
		
// 		var_dump($_POST);die();
		$this->siak_model->siak_custom_create("karya_ilmiah");
// 		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}
	
	function cek_karya( $nim, $jenis, $id, $bahasa, $edit_idx){
// 		$x = url_decode($bahasa);
// 		echo $x;
// 		die();
	
		if($edit_idx == NULL){
			$edit_id = '0';
		}else{
			$edit_id = $edit_idx;
		}
		
		$data = array( $nim, $jenis, $id, $bahasa, $edit_id);
		
		$sql = "select edit_id from karya_ilmiah where nim = '$nim' and edit_id = '$id'";
		
		$result = $this->siak_model->siak_query("select", $sql);
		
// 		var_dump($sql);die();
		
		if($result == NULL && $edit_id == '0'){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editMKI" onclick="editMKI(this)" link="'.URL.'siak_mahasiswa/data_karya_ilmiah/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Edit</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMKI" onclick="kirim_idMKI(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Delete</a>
		    ';
		}
		else if($this->level != '16'){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMKI" onclick="kirim_id2MKI(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Approve</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMKI" onclick="kirim_idMKI(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Disagree</a>
		    ';
		}
		
		else{
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Approve</span>
			</span>';
		}
		
	}
	
	////////////
	////// END KARYA ILMIAH
	////////////////////////////////////////////////////////////////////////////////////////
	
	////////////////////////////////////////////////////////////////////////////////////////
	////// SEMINAR ILMIAH
	////////////

	public function data_seminar_ilmiah($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;
		
		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM seminar_ilmiah a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0' ");
		if($act == "data"){ 
		    $this->siak_view->siak_render('siak_mahasiswa/seminar_ilmiah/data_seminar_ilmiah', true); 
		}elseif($act == "edit"){
		
		    $this->siak_view->siak_render('siak_mahasiswa/seminar_ilmiah/data_seminar_ilmiah_edit', true); 
		
		}
	}
	
	function add_seminar($jenis,$nim){
		$this->siak_view->jenis = $jenis;
		$this->siak_view->nim = $nim;
		$this->siak_view->siak_render('siak_mahasiswa/seminar_ilmiah/add_seminar', true);
	}
	
	function tambah_seminar($nim,$jenis){
		
// 		var_dump($_POST);die();
		$this->siak_model->siak_custom_create("seminar_ilmiah");
// 		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}
	
	function cek_seminar( $nim, $jenis, $id, $bahasa, $edit_idx){
		if($edit_idx == NULL){
			$edit_id = '0';
		}else{
			$edit_id = $edit_idx;
		}
		
		$data = array( $nim, $jenis, $id, $bahasa, $edit_id);
		
		$sql = "select edit_id from seminar_ilmiah where nim = '$nim' and edit_id = '$id'";
		
		$result = $this->siak_model->siak_query("select", $sql);
		
// 		var_dump($edit_id);die();
		
		if($result == NULL && $edit_id == '0' || $edit_id == NULL){
// 		    echo $id;
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editMSI" onclick="editMSI(this)" link="'.URL.'siak_mahasiswa/data_seminar_ilmiah/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Edit</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMSI" onclick="kirim_idSem(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Delete</a>
		    ';
		}
		else if($this->level != '16'){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMSI" onclick="kirim_id2Sem(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Approve</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMSI" onclick="kirim_idSem(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Disagree</a>
		    ';
		}
		
		else{
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Approve</span>
			</span>';
		}
		
	}
	
	////////////
	////// END SEMINAR ILMIAH
	////////////////////////////////////////////////////////////////////////////////////////
	
	////////////////////////////////////////////////////////////////////////////////////////
	////// PRESTASI
	////////////

	public function data_prestasi($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM prestasi a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'");
		
		if($act == "data"){ 
		    $this->siak_view->siak_render('siak_mahasiswa/prestasi/data_prestasi', true); 
		}elseif($act == "edit"){
		    $this->siak_view->siak_render('siak_mahasiswa/prestasi/data_prestasi_edit', true); 
		}
	}
	
	function add_prestasi($jenis,$nim){
		$this->siak_view->jenis = $jenis;
		$this->siak_view->nim = $nim;
		$this->siak_view->siak_render('siak_mahasiswa/prestasi/add_prestasi', true);
	}
	
	function tambah_prestasi($nim,$jenis){
		
// 		var_dump($_POST);die();
		$this->siak_model->siak_custom_create("prestasi");
// 		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}
	
	function cek_prestasi( $nim, $jenis, $id, $bahasa, $edit_idx){
		if($edit_idx == NULL){
			$edit_id = '0';
		}else{
			$edit_id = $edit_idx;
		}
		
		$data = array( $nim, $jenis, $id, $bahasa, $edit_id);
		
		$sql = "select edit_id from prestasi where nim = '$nim' and edit_id = '$id'";
		
		$result = $this->siak_model->siak_query("select", $sql);
		
// 		var_dump($sql);die();
		
		if($result == NULL && $edit_id == '0'){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editMP" onclick="editMP(this)" link="'.URL.'siak_mahasiswa/data_prestasi/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Edit</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMP" onclick="kirim_idMP(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Delete</a>
		    ';
		}
		else if($this->level != '16'){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMP" onclick="kirim_id2MP(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Approve</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMP" onclick="kirim_idMP(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Disagree</a>
		    ';
		}
		
		else{
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Approve</span>
			</span>';
		}
		
	}
	////////////
	////// END PRESTASI
	////////////////////////////////////////////////////////////////////////////////////////

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

	public function siak_edit_save($nim, $x, $table, $jenis, $id){
		
		/// buat pengecekan siapa yg ngerubah data (mahasiswa / kaprodi / superuser) !!
		    
		    /// ini kalo mahasiswa (saat update data malah insert data baru)
		    if($table == "bahasa_asing" || $table == "kursus_latihan" || $table == "karya_ilmiah" || $table == "seminar_ilmiah" || $table == "prestasi"){
			      $this->siak_model->siak_custom_create($table);
		    }
		
		if($table == "keluarga" || $table == "bahasa_asing" || $table == "kursus_latihan_mahasiswa" || $table == "riwayat_pangkat_mahasiswa" || $table == "pendidikan_mahasiswa" || $table == "prestasi_mahasiswa" || $table == "seminar_ilmiah_mahasiswa" || $table == "karya_ilmiah_mahasiswa" || $table == "kursus_latihan_mahasiswa"){ 
			$where = array('id' => $id,'nim' => $nim,);
		}else{ $where = array('nim' => $nim,);}
// 		$this->siak_model->siak_update_save($table, $where);
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}

	public function siak_insert_save($nim, $id, $table, $jenis){
// 		echo "<pre>";
// 		var_dump($_POST);
// 		echo "</pre>";die();
		$this->siak_model->siak_custom_create ($table);
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}

	public function siak_delete($nim, $table, $id, $jenis){
		$data = array($nim, $table, $id, $jenis);
		$where = array('id' => $id);
		
		$sql_cek = "select * from $table where nim = '$nim' and edit_id = '$id'";
		$cek = $this->siak_model->siak_query("select", $sql_cek);
		$id_del = $cek[0][id];
		
// 		echo $id_del;die();
		
		if(count($cek) <= 0){
		
		      $sql_del = "delete from $table where id = '$id'";
		
		}else{
		
		      $sql_del = "delete from $table where id = '$id_del'";
		
		}
		
		$this->siak_model->siak_query("delete", $sql_del);
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}
	
	public function siak_approve($nim, $table, $id, $jenis){
		$data = array($nim, $table, $id, $jenis);
		$where = array('id' => $id);
		
		$sql_cek = "select * from $table where nim = '$nim' and edit_id = '$id'";
		$cek = $this->siak_model->siak_query("select", $sql_cek);
		$id_del = $cek[0][id];
		
		if(count($cek) <= 0){
		
		      $sql_up = "update $table set edit_id = '0' where id = '$id'";
		
		}else{
		
		      $sql_up = "update $table set edit_id = '0' where id = '$id_del'";
		      $sql_del = "delete from $table where id = '$id'";
		      $this->siak_model->siak_query("delete", $sql_del);
		
		}
		
		$this->siak_model->siak_query("update", $sql_up);
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}

}