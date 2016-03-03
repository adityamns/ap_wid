<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak mahasiswa controller class */

class Siak_dosen extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->level = $_SESSION['level'];
		$this->user = $_SESSION['username'];
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Daftar Dosen";
	
		$this->siak_view->judul = "Daftar Dosen";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Daftar Dosen','href'=>''. URL . 'siak_dosen'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		$this->siak_datalist();

	}
	function getDosen_json(){
		
		$siak_data = $this->siak_model->siak_query("select", "select *from dosen");
		
		$data = array();
		
				$result = array();
		
		foreach ($siak_data as $dos => $row ){
		
			//$data_tahun['tahun_id']=$row['tahun_id'];
			$data['nama']=$row['gelar_depan']." ".$row['nama']." ".$row['gelar_blkng'];
			$data['nip']=$row['nip'];
			array_push($result,$data);
		}
		
		print json_encode($result);
	}
	public function siak_datalist(){
		$this->siak_view->siak_data_list_umum = $this->siak_model->siak_query("select", "SELECT * FROM dosen");
		$this->siak_view->siak_data=$this->siak_model->siak_query("pendidikan_dosen","*");
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		
		/*if ($this->prodi_id > 0) {
			$prodi 	 = explode(',', $this->prodi_id);
			$kondisi = "AND (b.prodi_homebase = ";
			foreach ($prodi as $value) {
				$kondisi .= "'".$value."' OR b.prodi_homebase = ";
			}
			$kondisi = substr($kondisi, 0, sizeof($kondisi) -24);
			$kondisi.= ");";
		}else{
			$kondisi = ';';
		}

		$this->siak_view->siak_data_list_umum = $this->siak_model->siak_query("select", "SELECT a.* FROM dosen a,akademik_dosen b WHERE a.nip = b.nip $kondisi");
		$this->siak_view->siak_data=$this->siak_model->siak_query("pendidikan_dosen","*");*/
		if($_SESSION['level'] == 16 || $_SESSION['level'] != 18  ){
			$this->siak_view->siak_render('siak_dosen/data', false);
		}else{
			header('Location:'.URL.'siak_master/siak_dosen/'.$this->user, false);
		}
	}

	public function siak_add(){
		$this->siak_view->siak_data_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("agama", "id,nama");
		$this->siak_view->siak_data_jk= $this->siak_model->siak_data_list("kelamin","kode,nama");
		$this->siak_view->siak_render('siak_dosen/add', true);
	}

	public function siak_add_data($nip){
		$this->siak_view->nip = $nip;
		$this->siak_view->siak_render('siak_dosen/pendidikan/data_pendidikan_add', true);
	}

	public function siak_datapop(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_dosen/popup', true);
	}

	public function siak_create_data($tbl){
		// var_dump($_POST);die();
		$this->siak_model->siak_custom_create($tbl);
		header('location: ' . URL . 'siak_master/siak_dosen/'.$_POST['nip'].'');
	}


	public function siak_create(){
		//echo "insert into riwayat_jabatan_dosen(nip,jabatan_id,jabatan_dikti) values ('".$_POST['nip']."',6,'10')"; die();
		$this->siak_model->siak_create();
// 		die()
;// 		$this->siak_model->siak_query("insert","insert into alamat_dosen(nip) values ('".$_POST['nip']."')");
// 		$this->siak_model->siak_query("insert","insert into akademik_dosen(nip) values ('".$_POST['nip']."')");
		//$this->siak_model->siak_query("insert","insert into riwayat_jabatan_dosen(nip,jabatan_id,jabatan_dikti) values ('".$_POST['nip']."',6,'10')");
		header('location: ' . URL . 'siak_dosen');
	}
	
	////////For Tabs

	public function data_pribadi($nip, $act){
		$this->siak_view->nip = $nip;
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM dosen WHERE nip = '$nip'");
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($act == "data"){
			$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
			$this->siak_view->kelamin= $this->siak_model->siak_data_list("kelamin","kode,nama");
			$this->siak_view->agama= $this->siak_model->siak_data_list("agama","id,nama"); 
			$this->siak_view->siak_render('siak_dosen/data_pribadi', true); 
		}
	}

	public function data_alamat($nip, $act){
		$this->siak_view->nip = $nip;
		//var_dump($nip);die();
		// echo "SELECT a.* FROM alamat_dosen a, dosen b WHERE a.nip = b.nip AND a.nip=$nip"; die();
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.* FROM alamat_dosen a, dosen b WHERE a.nip = b.nip AND a.nip='$nip'");
		//echo "SELECT a.* FROM alamat_dosen a, dosen b WHERE a.nip = b.nip AND a.nip='$nip'";die()
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($act == "data"){
			$this->siak_view->siak_render('siak_dosen/data_alamat', true); 
		}
		
	}

	public function data_akademik($nip, $act){
		$this->siak_view->nip = $nip;
		//var_dump($nip);die();
// 		echo "SELECT a.* FROM akademik_dosen a, dosen b WHERE a.nip = b.nip AND a.nip='$nip'"; die();
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.* FROM akademik_dosen a, dosen b WHERE a.nip = b.nip AND a.nip='$nip'");
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($act == "data"){
			$this->siak_view->status_ikatan = $this->siak_model->siak_data_list("status_ikatan_kerja", "status_id,nama");
			$this->siak_view->status_dosen = $this->siak_model->siak_data_list("status", "*");
			$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
			$this->siak_view->jenis_dosen = $this->siak_model->siak_data_list("jenis_dosen", "*");
			$this->siak_view->kd_peng = $this->siak_model->fieldNew("select penguji from akademik_dosen where nip = '$nip'", "penguji");
			$this->siak_view->kd_pem = $this->siak_model->fieldNew("select pembimbing from akademik_dosen where nip = '$nip'", "pembimbing");
			$this->siak_view->siak_render('siak_dosen/data_akademik', true); 
		}
		
	}

	public function data_pendidikan($nip, $act, $id){
		$this->siak_view->id= $id;
		$this->siak_view->nip = $nip;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nip FROM pendidikan_dosen a, dosen b WHERE a.nip='$nip' AND a.nip = b.nip $and");
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($act == "data"){
			$this->siak_view->siak_render('siak_dosen/pendidikan/data_pendidikan', true); 
		}
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_dosen/pendidikan/data_pendidikan_edit', true); 
		}
		
	}

	
	public function data_jabatan($nip, $act, $id){
		$this->siak_view->id= $id;
		$this->siak_view->nip = $nip;
		
		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}
		
// 		echo "SELECT a.* FROM riwayat_jabatan_dosen a, dosen b WHERE a.nip='$nip' AND a.nip = b.nip $and";
// 		die();

		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.* FROM riwayat_jabatan_dosen a, dosen b WHERE a.nip='$nip' AND a.nip = b.nip $and");
// 		$this->siak_view->jabatan = $this->siak_model->siak_data_list("jabatan_akademik", "jabatan_id,nama_jabatan");
		$this->siak_view->golongan = $this->siak_model->siak_data_list("golongan", "*");
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($act == "data"){ 

			$this->siak_view->siak_render('siak_dosen/jabatan/data_jabatan', true);
		}elseif($act == "edit"){
			$this->siak_view->siak_render('siak_dosen/jabatan/data_jabatan_edit', true);
		}elseif($act == "add"){
			//var_dump($_POST);die();
			$this->siak_view->siak_render('siak_dosen/jabatan/data_jabatan_add', true);
		}
	}

	public function data_pelatihan($nip, $act, $id){
		//echo "hallo";
		$this->siak_view->id= $id;
		$this->siak_view->nip = $nip;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//

		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nip FROM pelatihan_dosen a, dosen b WHERE a.nip='$nip' AND a.nip = b.nip $and");
		if($act == "data"){
			$this->siak_view->siak_render('siak_dosen/pelatihan/data_pelatihan', true); 
		}elseif($act == "edit"){
			$this->siak_view->siak_render('siak_dosen/pelatihan/data_pelatihan_edit', true); 
		}elseif($act == "add"){
			//var_dump($_POST);die();
			$this->siak_view->siak_render('siak_dosen/pelatihan/data_pelatihan_add', true);
		}


	}

	public function data_penelitian($nip, $act, $id){
		//echo "hallo";
		$this->siak_view->id= $id;
		$this->siak_view->nip = $nip;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nip FROM penelitian_dosen a, dosen b WHERE a.nip='$nip' AND a.nip = b.nip $and");
		$this->siak_view->jabatan = $this->siak_model->siak_data_list("jabatan_akademik", "jabatan_id,nama_jabatan");
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($act == "data"){
			$this->siak_view->siak_render('siak_dosen/penelitian/data_penelitian', true); 
		}elseif($act == "edit"){
			$this->siak_view->siak_render('siak_dosen/penelitian/data_penelitian_edit', true); 
		}elseif($act == "add"){
			$this->siak_view->siak_render('siak_dosen/penelitian/data_penelitian_add', true);
		}


	}

	public function data_seminar($nip, $act, $id){
		//echo "hallo";
		$this->siak_view->id= $id;
		$this->siak_view->nip = $nip;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nip FROM seminar_dosen a, dosen b WHERE a.nip='$nip' AND a.nip = b.nip $and");
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($act == "data"){
			$this->siak_view->siak_render('siak_dosen/seminar/data_seminar', true); 
		}elseif($act == "edit"){
			$this->siak_view->siak_render('siak_dosen/seminar/data_seminar_edit', true); 
		}elseif($act == "add"){
			$this->siak_view->siak_render('siak_dosen/seminar/data_seminar_add', true);
		}


	}

	
	public function data_pengabdian($nip, $act, $id){
		//echo "hallo";
		$this->siak_view->id= $id;
		$this->siak_view->nip = $nip;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nip FROM pengabdian_dosen a, dosen b WHERE a.nip='$nip' AND a.nip = b.nip $and");
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($act == "data"){
			$this->siak_view->siak_render('siak_dosen/pengabdian_masyarakat/data_abdimasyarakat', true); 
		}elseif($act == "edit"){
			$this->siak_view->siak_render('siak_dosen/pengabdian_masyarakat/data_abdimasyarakat_edit', true); 
		}elseif($act == "add"){
			$this->siak_view->siak_render('siak_dosen/pengabdian_masyarakat/data_abdimasyarakat_add', true);
		}


	}

	public function data_karyailmiah($nip, $act, $id){
		//echo "hallo";
		$this->siak_view->id= $id;
		$this->siak_view->nip = $nip;

		if (isset($id)) {
			$and = "AND a.id = $id";
		}else{
			$and = "";
		}

		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nip FROM karyailmiah_dosen a, dosen b WHERE a.nip='$nip' AND a.nip = b.nip $and");
		
		//Hak Akses
		$method_or_uri = 'siak_dosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($act == "data"){
			$this->siak_view->siak_render('siak_dosen/karya_ilmiah/data_karyailmiah', true); 
		}elseif($act == "edit"){
			$this->siak_view->siak_render('siak_dosen/karya_ilmiah/data_karyailmiah_edit', true); 
		}elseif($act == "add"){
			$this->siak_view->siak_render('siak_dosen/karya_ilmiah/data_karyailmiah_add', true);
		}


	}

	
	public function siak_edit_save($nip, $table, $id){
			// echo var_dump($_POST);die();	
		if($id == NULL){
			$where = array('nip' => $nip,);
		}else{
			$where = array('id' => $id,);
		}
		
// 		if($table == "dosen" || $table == "pendidikan_dosen" || $table == "alamat_dosen" || $table == "riwayat_jabatan_dosen" || $table == "pelatihan_dosen" || $table == "penelitian_dosen" || $table== "seminar_dosen" || $table== "pengabdian_dosen" || $table== "karyailmiah_dosen"){ 
// 			$where = array('id' => $id,);
// 		}else{ $where = array('nip' => $nip,);}

		if ($table == "akademik_dosen") {
			$_POST['prodi_mengajar'] = implode(',', $_POST['prodi_mengajar']);
		}
		
// 		var_dump($where);die();
		if($table == 'dosen'){
			if(isset($_FILES['foto'])){
				if(is_uploaded_file($_FILES['foto']['tmp_name'])) {
					$file_tmp = $_FILES['foto']['tmp_name'];
					$path = "siak_public/siak_upload/Dosen";
					
					$name = $_POST['nip'].'_'.$_FILES['foto']['name'];
					
					if(is_dir($path)==false){
						$old_umask = umask(0);
						mkdir("$path", 0777, true);		// Create directory if it does not exist
						umask($old_umask);					
					}
					
					$targetPath = $path.'/'.$name;
	// 				move_uploaded_file($file_tmp,$targetPath);
					
					if(move_uploaded_file($file_tmp,$targetPath)) {
						echo '<img src="'.URL.$targetPath.'" width="200px" height="250px" />';
					}
					
					$_POST['foto'] = $name;
				}else{
// 					$_POST['foto'] = '';
				}
			}
		}
		
// 		echo "<pre>";
// 		var_dump($_POST);
// 		echo "</pre>";
// 		die();
		
		//var_dump($_POST);die();
		$this->siak_model->siak_update_save($table, $where);
		header('location: ' . URL . 'siak_master/siak_dosen/'.$nip);
	}

	public function siak_delete($nip, $table, $id){
		$where = array('id' => $id);
		$this->siak_model->siak_custom_delete($table, $where);
		header('location: ' . URL . 'siak_master/siak_dosen/'.$nip);
	}

	public function siak_add_alamat($nip){
		$sql = "insert into alamat_dosen(nip, noktp, alamat, propinsi, kota, kodepos, telp_rumah, telp_hp, email) values ('".$nip."','".$_POST['noktp']."','".$_POST['alamat']."','".$_POST['propinsi']."','".$_POST['kota']."','".$_POST['kodepos']."','".$_POST['telp_rumah']."','".$_POST['telp_hp']."','".$_POST['email']."');";
// 		die();
		$this->siak_model->siak_query("insert",$sql);
		//echo "insert into alamat_dosen(nip, noktp, alamat, propinsi, kota, kodepos, telp_rumah, telp_hp, email) values ('".$nip."','".$_POST['noktp']."','".$_POST['alamat']."','".$_POST['propinsi']."','".$_POST['kota']."','".$_POST['kodepos']."','".$_POST['telp_rumah']."','".$_POST['telp_hp']."','".$_POST['email']."');";die();
		header('location: ' . URL . 'siak_master/siak_dosen/'.$nip);
	}

// 	public function siak_add_akademik($nip){
// 		$_POST['prodi_mengajar'] = implode(',', $_POST['prodi_mengajar']);
// 		//var_dump($_POST['prodi_mengajar']);die();
// 		$this->siak_model->siak_query("insert","insert into akademik_dosen(nip, status_dosen, status_kerja, jenis_dosen, prodi_homebase, prodi_mengajar) values ('".$nip."','".$_POST['status_dosen']."','".$_POST['status_kerja']."','".$_POST['jenis_dosen']."','".$_POST['prodi_homebase']."','".$_POST['prodi_mengajar']."')");
// 		// echo "insert into akademik_dosen(nip, status_dosen, status_kerja, jenis_dosen, prodi_homebase, prodi_mengajar) values ('".$nip."','".$_POST['status_dosen']."','".$_POST['status_kerja']."','".$_POST['jenis_dosen']."','".$_POST['prodi_homebase']."','".$_POST['prodi_mengajar']."')";die();
// 		header('location: ' . URL . 'siak_master/siak_dosen/'.$nip);
// 	}
	
	///////TAMBAH DATA AKADEMIK DOSEN
	public function siak_add_akademik($nip){
	
		$nama = $this->siak_model->fieldNew("select nama from dosen where nip = '$nip'", "nama");
		$_POST['prodi_mengajar'] = implode(',', $_POST['prodi_mengajar']);
		
// 		$this->siak_model->siak_query("insert","insert into akademik_dosen(nip, status_dosen, status_kerja, jenis_dosen, prodi_homebase, prodi_mengajar) values ('".$nip."','".$_POST['status_dosen']."','".$_POST['status_kerja']."','".$_POST['jenis_dosen']."','".$_POST['prodi_homebase']."','".$_POST['prodi_mengajar']."')");
// 		echo "insert into akademik_dosen(nip, status_dosen, status_kerja, jenis_dosen, prodi_homebase, prodi_mengajar) values ('".$nip."','".$_POST['status_dosen']."','".$_POST['status_kerja']."','".$_POST['jenis_dosen']."','".$_POST['prodi_homebase']."','".$_POST['prodi_mengajar']."')";
		// $sqlAk = "insert into akademik_dosen(nip, status_dosen, status_kerja, jenis_dosen, prodi_homebase, prodi_mengajar) values ('".$nip."','".$_POST['status_dosen']."','".$_POST['status_kerja']."','".$_POST['jenis_dosen']."','".$_POST['prodi_homebase']."','".$_POST['prodi_mengajar']."')";
		// $sqlAk = "insert into akademik_dosen(nip, status_dosen, status_kerja, jenis_pegawai, prodi_homebase, prodi_mengajar) values ('".$nip."','".$_POST['status_dosen']."','".$_POST['status_kerja']."','".$_POST['jenis_pegawai']."','".$_POST['prodi_homebase']."','".$_POST['prodi_mengajar']."')";
		$sqlAk = "insert into akademik_dosen(nip, status_dosen, status_kerja, jenis_pegawai, prodi_homebase, prodi_mengajar) values ('".$nip."','".$_POST['status_dosen']."','".$_POST['status_kerja']."','".$_POST['jenis_pegawai']."','".$_POST['prodi_homebase']."','".$_POST['prodi_mengajar']."')";
		$this->siak_model->siak_query('insert', $sqlAk);
		
		if($_POST['pembimbing'] == TRUE){
// 			echo "<br>insert into pembimbing(nama, kode, jenis, prodi_homebase) values ('".$nama."','".$nip."','".$_POST['jenis_dosen']."','".$_POST['prodi_homebase']."')";
			// $sqlPem = "insert into pembimbing(nama, kode, jenis, prodi_homebase) values ('".$nama."','".$nip."','".$_POST['jenis_dosen']."','".$_POST['prodi_homebase']."')";
			$sqlPem = "insert into pembimbing(nama, kode, prodi_homebase) values ('".$nama."','".$nip."','".$_POST['prodi_homebase']."')";
			$this->siak_model->siak_query('insert', $sqlPem);
		}
		if($_POST['penguji'] == TRUE){
// 			echo "<br>insert into penguji(nama, kode) values ('".$nama."','".$nip."')";
			$sqlPeng = "insert into penguji(nama, kode) values ('".$nama."','".$nip."')";
			$this->siak_model->siak_query('insert', $sqlPeng);
		}
// 		die();
		header('location: ' . URL . 'siak_master/siak_dosen/'.$nip);
	}
	
	//UPDATE AKADEMIK DOSEN
	function update_akademik_dosen(){
		// echo var_dump($_POST);die();
		$_POST['prodi_mengajar'] = implode(',', $_POST['prodi_mengajar']);
		$nip = $_POST['nip'];
		$nama = $this->siak_model->fieldNew("select nama from dosen where nip = '$nip'", "nama");
		
		$sqlCekPeng = $this->siak_model->fieldNew("select kode from penguji where kode = '$nip'", "kode");
		$sqlCekPem = $this->siak_model->fieldNew("select kode from pembimbing where kode = '$nip'", "kode");
		if($_POST['penguji'] == TRUE){
			if($sqlCekPeng == NULL || $sqlCekPeng == ''){
				$sqlInPeng = "insert into penguji(nama, kode) values ('".$nama."','".$nip."')";
// 				echo $sqlInPeng."<br>";
				$this->siak_model->siak_query('insert', $sqlInPeng);
			}
		}else{
			if($sqlCekPeng != NULL || $sqlCekPeng != ''){
				$sqlDelPeng = "delete from penguji where kode = '$nip'";
// 				echo $sqlDelPeng."<br>";
				$this->siak_model->siak_query('delete', $sqlDelPeng);
			}
		}
		if($_POST['pembimbing'] == TRUE){
			if($sqlCekPem == NULL || $sqlCekPem == ''){
				// $sqlInPem = "insert into pembimbing(nama, kode, jenis, prodi_homebase) values ('".$nama."','".$nip."','".$_POST['jenis_dosen']."','".$_POST['prodi_homebase']."')";
				$sqlInPem = "insert into pembimbing(nama, kode, jenis, prodi_homebase) values ('".$nama."','".$nip."','".$_POST['jenis_pegawai']."','".$_POST['prodi_homebase']."')";
// 				echo $sqlInPeng."<br>";
				$this->siak_model->siak_query('insert', $sqlInPem);
			}
		}else{
			if($sqlCekPem != NULL || $sqlCekPem != ''){
				$sqlDelPem = "delete from pembimbing where kode = '$nip'";
// 				echo $sqlDelPem."<br>";
				$this->siak_model->siak_query('delete', $sqlDelPem);
			}
		}
		
		if(sizeof($_POST['penguji']) == 0){
			$_POST['penguji'] = "FALSE";
		}
		if(sizeof($_POST['pembimbing']) == 0){
			$_POST['pembimbing'] = "FALSE";
		}
		// $sqlUp = "update akademik_dosen set status_dosen='".$_POST['status_dosen']."', jenis_dosen='".$_POST['jenis_dosen']."', prodi_mengajar='".$_POST['prodi_mengajar']."', prodi_homebase='".$_POST['prodi_homebase']."' where nip='$nip' and id=".$_POST['id']."";
		$sqlUp = "update akademik_dosen set status_dosen='".$_POST['status_dosen']."',status_kerja='".$_POST['status_kerja']."', jenis_pegawai='".$_POST['jenis_pegawai']."', prodi_mengajar='".$_POST['prodi_mengajar']."', prodi_homebase='".$_POST['prodi_homebase']."',penguji='".$_POST['penguji']."',pembimbing='".$_POST['pembimbing']."' where nip='$nip' and id=".$_POST['id']."";
 		// echo $sqlUp;
		$this->siak_model->siak_query('update', $sqlUp);
		
		header('location: ' . URL . 'siak_master/siak_dosen/'.$nip);
	}
}
?>