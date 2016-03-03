<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak mahasiswa controller class */

class Siak_mahasiswa extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->level = $_SESSION['level'];
		$this->user = $_SESSION['username'];
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
		
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Daftar Mahasiswa";
	
		$this->siak_view->judul = "Daftar Mahasiswa";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Daftar Mahasiswa','href'=>''. URL . 'siak_mahasiswa'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_datalist();
		
	}

	
	public function siak_datalist(){
	
	$prodi_id = $_SESSION['prodi'];
	$nim = $_SESSION['username'];
	$mhs = $this->siak_model->siak_query("select","select * from mahasiswa where nim = '$nim' and prodi_id = '$prodi_id'");
		
	$query = "select * from mahasiswa where nim = '$nim' and prodi_id = '$prodi_id'";
	$this->siak_view->query = $this->siak_model->siak_query("select", "select * from view_mahasiswa");
	$this->siak_view->result = $mhs;

	foreach($mhs as $row => $rec): 
		$prodi_new = $rec['prodi_id']; 
		$no[] = $rec['nim'];
		$jenis = $rec['jenis'];
		
	endforeach;
	
// 	echo "<pre>";
// 	var_dump($mhs);
// 	echo "</pre>";
// 	
// 	die();
	
		$this->siak_view->status = $this->siak_model->siak_data_list("status", "*");
		
		$prodi = explode(',', $this->prodi_id);
		
		$ada = (!in_array($nim, $no)) ? "tidak ada":"ada";
		
		
		if($prodi_id == NULL || $prodi_id == ''){
		      $kondisi = "";
		}else{
		      $split = explode(',', $prodi_id);

		      if(sizeof($split)>1){

			  foreach($split as $p){
			    $new[] = "'".$p."'";
			  }
			  $new = implode(',', $new);
			  $kondisi = "where prodi_id in (".$new.")";
		      }else{
			  $kondisi = "where prodi_id in ('".$prodi_id."')";
		      }

		}
		
		if($ada == "ada"){
			$sql = "select * from view_mahasiswa where nim = '$nim'";
		}else{
			$sql = "select * from view_mahasiswa $kondisi";				      
		}
		
// 		echo $sql;die();
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select",$sql);
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($_SESSION['level'] != 16 ){
			$this->siak_view->siak_render('siak_mahasiswa/data', false);
		}else{
			header('Location:'.URL.'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis, false);
		}
	
	}
	
	////////////////////////////////////////////////////////////////////////////////////////
	////// DATA PRIBADI
	////////////
	public function data_pribadi($nim, $jenis, $act){
		$this->siak_view->nim = $nim;
		$this->siak_view->jenis = $jenis;
		
		if ($jenis == 'Umum' || $jenis == 'umum') {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM $table WHERE nim = '$nim' AND edit_id <= '0';");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nama as status_kawin, c.nama as agama FROM $table a, status_perkawinan b, agama c WHERE a.nim = '$nim' AND a.status_perkawinan_id = b.id AND a.agama_id = c.id and a.edit_id <= '0';");
		
// 		var_dump($this->siak_view->siak_data);die();
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
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
	
	function ajaxAplod($jenisx, $poto){
		if($jenisx == "Umum" || $jenisx == "umum"){
			$jenis = "Umum";
			$table = "data_pribadi_umum";
		}else{
			$jenis = "pns";
			$table = "data_pribadi_pns";
		}
		
		if(is_array($_FILES)) {
			
			if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
				$type = explode('/', $_FILES['userImage']['type']);
				
				if($type[1] == "jpeg"){
					$type[1] = "jpg";
				}
				
				$file_type = $type[1];
				$sourcePath = $_FILES['userImage']['tmp_name'];
// 				$path = "siak_public/siak_upload/Mahasiswa";
				$path = "siak_public/siak_images/uploads";
				$name = $_POST['nim'].'.'.$file_type.'.temp';
				
				
				if(is_dir($path)==false){
					$old_umask = umask(0);
					mkdir("$path", 0755);		// Create directory if it does not exist
					umask($old_umask);
				}
				
				$targetPath = $path.'/'.$name;
				
				$_POST['foto'] = $name;
				
				if(move_uploaded_file($sourcePath,$targetPath)) {
					echo '<img src="'.URL.$targetPath.'" width="200px" height="250px" />';
				}
			}
			else{
				$_POST['foto'] = $poto.".temp";
			}
		}
		
		foreach ($_POST as $key=>$val) {
			$param .= $key.",";
			$valu  .= ":".$key.",";
			$value[":".$key] = $val;
			$value2[$key] = $val;
		}
		
// 		echo "<pre>";
// 		var_dump($value2);
// 		echo "</pre>";
// 		die();
		
		$this->siak_model->insert_data($value2, $table);
		
		////skrip notipiskasi
		if($this->level == 16){
			$this->siak_model->notifInsert($table, $_POST['nim'], $jenis, $this->level);
		}
		/////
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$_POST['nim'].'/'.$jenis);
	}
	
	function cek_data( $nim, $jenis, $id, $edit_idx, $nama, $foto){
		if($edit_idx == NULL){
			$edit_id = '0';
		}else{
			$edit_id = $edit_idx;
		}
		
		if($jenis == "Umum" || $jenis == "umum"){
			$table = "data_pribadi_umum";
		}else{
			$table = "data_pribadi_pns";
		}
		
		$sql = "select edit_id from $table where nim = '$nim' and edit_id = '$id'";
		
		
		$result = $this->siak_model->siak_query("select", $sql);
		
// 		var_dump($result);die();
		
		if($result == NULL){
		    echo '
				<button id="btnsave" class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Simpan
				</button>
		    ';
		}
		else if($this->level != '16'){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveDPU" onclick="approveDPU(\''.$id.'\',\''.$nim.'\',\''.$nama.'\',\''.$foto.'\')"><i class="icon-ok"></i> Setuju</a>
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusDPU" onclick="hapusDPU(\''.$id.'\',\''.$nim.'\',\''.$nama.'\',\''.$foto.'\')"><i class="icon-trash"></i> Tidak Setuju</a>
		    ';
		}
		
		else{
		  echo '
		  <div class="row-fluid">
		  <div class="span6">
			  <div class="control-group">
				  <div class="controls">
					  <span class="progress progress-striped active">
						  <span class="bar" style="width: 100%;">Menunggu Persetujuan</span>
					  </span>
				  </div>
			  </div>
		  </div>
		  </div>
		  ';
		  
		}
		
	}
	
	function hapusDPU($nim, $table, $id, $jenis, $foto){
		
		$sql_cek = "select * from $table where nim = '$nim' and edit_id = '$id'";
		
		$cek = $this->siak_model->siak_query("select", $sql_cek);
		$id_del = $cek[0][id];
		
// 		echo $id_del;die();
		$sql_del = "delete from $table where id = '$id_del'";
		
		$this->siak_model->siak_query("delete", $sql_del);
		
		
// 		$dir = "siak_public/siak_upload/Mahasiswa";
		$path = "siak_public/siak_images/uploads";
		
		$cekdir = array_diff(scandir($dir), array('..', '.'));
		foreach($cekdir as $files){
			if($files == $foto.".temp"){
				$delfoto = $files;
				
				unlink($dir."/".$delfoto);
				
			}
		}
				
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}
	
	function approveDPU($nim, $table, $id, $jenis, $foto){
		
		$sql_cek = "select * from $table where nim = '$nim' and edit_id = '$id'";
		$cek = $this->siak_model->siak_query("select", $sql_cek);
		$id_del = $cek[0][id];
		$new_foto = substr($cek[0][foto], 0, -5);

		$sql_up = "update $table set foto = '$new_foto', edit_id = '0' where id = '$id_del'";
		
		$sql_del = "delete from $table where id = '$id'";
		
// 		echo $sql_up."<br>".$sql_del."<br>".$new_foto;die();
		
		$this->siak_model->siak_query("delete", $sql_del);
		
		
		$dir = "siak_public/siak_upload/Mahasiswa";
		
		$cekdir = array_diff(scandir($dir), array('..', '.'));
		foreach($cekdir as $files){
			if($files == $foto){
				$delfoto = $files;
// 				echo $delfoto;
				unlink($dir."/".$delfoto);
				
			}
		}
		
		$new_dir = $dir."/".$new_foto;
		rename($dir."/".$new_foto.".temp",$new_dir);
		
		$this->siak_model->siak_query("update", $sql_up);
		
		$this->siak_model->notifInsert($table, $nim, $jenis, $this->level);
		
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}
	
	////////////
	////// DATA PRIBADI
	////////////////////////////////////////////////////////////////////////////////////////
	public function data_keluarga($nim, $jenis, $act){
		$this->siak_view->nim = $nim;
		$this->siak_view->jenis = $jenis;
		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM keluarga WHERE nim = '$nim'");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_keluarga', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_keluarga_edit', true); }
	}

// 	public function data_pendidikan($nim, $jenis, $act, $id){
// 		//echo $nim." ".$jenis." ".$act;die();
// 		$this->siak_view->nim = $nim;
// 		$this->siak_view->jenis = $jenis;
// 		if ($jenis == "umum" || $jenis == "Umum") {
// 			$table = "data_pribadi_umum";
// 		}elseif ($jenis == "pns") {
// 			$table = "data_pribadi_pns";
// 		}
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM pendidikan_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim");
// 		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_pendidikan', true); }
// 		elseif($act == "edit"){
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM pendidikan_mahasiswa WHERE nim = '$nim' and id = '$id'");
// 			$this->siak_view->siak_render('siak_mahasiswa/data_pendidikan_edit', true); }
// 	}
// 	
// 	function add_data_pendidikan($jenis,$nosel,$nim){
// 		$this->siak_view->jenis = $jenis;
// 		$this->siak_view->nosel = $nosel;
// 		$this->siak_view->nim = $nim;
// 		$this->siak_view->siak_render("siak_mahasiswa/add_data_pendidikan", true);
// 	}
// 	
// 	
// 	function tambah_pendidikan($nim,$jenis){
// 		//var_dump($jenis);die();
// 		$this->siak_model->siak_custom_create("pendidikan_mahasiswa");
// 		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
// 	}
	
	////////////////////////////////////////////////////////////////////////////////////////
	////// PENDIDIKAN
	////////////

	public function data_pendidikan($nim, $jenis, $act, $id){
		$this->siak_view->level = $this->level;
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
// 			$and = "AND a.id = $id";
			$and = "AND id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM pendidikan_mahasiswa WHERE nim = '$nim' $and and edit_id <= '0'");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM bahasa_asing a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM bahasa_asing a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'");
// 		echo "SELECT a.*, b.nim FROM bahasa_asing a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'";
// 		echo "<pre>";
// 		var_dump($nim, $jenis, $act, $id);
// 		echo "</pre>";
// 		die();
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($act == "data"){ 
			$this->siak_view->nim = $nim;
			$this->siak_view->id = $id;
			$this->siak_view->jenis = $jenis;
			$this->siak_view->siak_render('siak_mahasiswa/data_pendidikan', true); 
			
		}elseif($act == "edit"){
			$this->siak_view->status = $this->siak_model->siak_data_list("status", "*");
			$this->siak_view->siak_render('siak_mahasiswa/data_pendidikan_edit', true); 
		}
	}
	
	function add_data_pendidikan($jenis,$nim){
		$this->siak_view->jenis = $jenis;
		$this->siak_view->nim = $nim;
		$this->siak_view->siak_render('siak_mahasiswa/add_data_pendidikan', true);
	}
	
	function tambah_pendidikan($nim,$jenis){
		
// 		echo "<pre>";
// 		var_dump($_POST);
// 		echo "</pre>";
// 		die();
		$this->siak_model->siak_custom_create("pendidikan_mahasiswa");
		
		if($this->level == 16){
		
			$this->siak_model->notifInsert("pendidikan_mahasiswa", $nim, $jenis, $this->level);
			  
		}
		
	}
	
	function cek_pendidikan( $nim, $jenis, $id, $bahasa, $edit_idx){
		if($edit_idx == NULL){
			$edit_id = '0';
		}else{
			$edit_id = $edit_idx;
		}
	
		$sql = "select edit_id from pendidikan_mahasiswa where nim = '$nim' and edit_id = '$id'";
		
		$result = $this->siak_model->siak_query("select", $sql);
		
// 		var_dump($nim, $jenis, $id, $bahasa, $edit_idx);die();
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($result == NULL && $edit_id == '0'){
// 		    echo '
// 		    <a class="btn blue mini" data-toggle="modal" data-target="#editMBH" onclick="editMBH(this)" link="'.URL.'siak_mahasiswa/data_bahasa_asing/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Ubah</a>
// 		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMBH" onclick="kirim_id(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Hapus</a>
// 		    ';
		    if($rolePage['updates'] == "t"){
		    echo '<a class="btn blue mini" data-toggle="modal" data-target="#editMDP" onclick="editMDP(this)" link="'.URL.'siak_mahasiswa/data_pendidikan/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i>Ubah</a>&nbsp;';
		    }
		    
		    if($rolePage['deletes'] == "t"){
		    echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusMDP" onclick="kirim_id(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i>Hapus</a>';
		    }
		    
		}
		else if($this->level != '16'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMDP" onclick="kirim_id2(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Setuju</a>';
		    }
		    
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMDP" onclick="kirim_id(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Tidak Setuju</a>
		    ';
		    }
		}
		
		else{
		  
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Persetujuan</span>
			</span>';
		  
		}
		
	}
	
	////////////
	////// END PENDIDIKAN
	////////////////////////////////////////////////////////////////////////////////////////
	
	////////////////////////////////////////////////////////////////////////////////////////
	////// BAHASA ASING
	////////////

	public function data_bahasa_asing($nim, $jenis, $act, $id){
		$this->siak_view->level = $this->level;
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
// 			$and = "AND a.id = $id";
			$and = "AND id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM bahasa_asing WHERE nim = '$nim' $and and edit_id <= '0'");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM bahasa_asing a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM bahasa_asing a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'");
// 		echo "SELECT a.*, b.nim FROM bahasa_asing a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'";
// 		echo "<pre>";
// 		var_dump($nim, $jenis, $act, $id);
// 		echo "</pre>";
// 		die();
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
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
		
		$this->siak_model->siak_custom_create("bahasa_asing");
		
		////skrip notipiskasi
		if($this->level == 16){
			$this->siak_model->notifInsert("bahasa_asing", $nim, $jenis, $this->level);
		}
		/////
		
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
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($result == NULL && $edit_id == '0'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editMBH" onclick="editMBH(this)" link="'.URL.'siak_mahasiswa/data_bahasa_asing/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Ubah</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMBH" onclick="kirim_id(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Hapus</a>
		    ';
		    }
		}
		else if($this->level != '16'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMBH" onclick="kirim_id2(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Setuju</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMBH" onclick="kirim_id(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Tidak Setuju</a>
		    ';
		    }
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
// 			$and = "AND a.id = $id";
			$and = "AND id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM kursus_latihan WHERE nim = '$nim' $and and edit_id <= '0'");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM kursus_latihan a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'");
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
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
		
		////skrip notipiskasi
		if($this->level == 16){
			$this->siak_model->notifInsert("kursus_latihan", $nim, $jenis, $this->level);
		}
		/////
		
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
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
// 		var_dump($sql);die();
		
		if($result == NULL && $edit_id == 0){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editMKL" onclick="editMKL(this)" link="'.URL.'siak_mahasiswa/data_kursus_latihan/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Ubah</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMKL" onclick="kirim_idMKL(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Hapus</a>
		    ';
		    }
		}
		else if($this->level != '16'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMKL" onclick="kirim_id2MKL(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Setuju</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMKL" onclick="kirim_idMKL(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Tidak Setuju</a>
		    ';
		    }
		}
		
		else{
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Persetujuan</span>
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
// 			$and = "AND a.id = $id";
			$and = "AND id = $id";
		}else{
			$and = "";
		}
		
		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM karya_ilmiah WHERE nim = '$nim' $and and edit_id <= '0' ");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM karya_ilmiah a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0' ");
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
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
		
		////skrip notipiskasi
		if($this->level == 16){
			$this->siak_model->notifInsert("karya_ilmiah", $nim, $jenis, $this->level);
		}
		/////
		
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
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($result == NULL && $edit_id == '0'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editMKI" onclick="editMKI(this)" link="'.URL.'siak_mahasiswa/data_karya_ilmiah/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Ubah</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMKI" onclick="kirim_idMKI(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Hapus</a>
		    ';
		    }
		}
		else if($this->level != '16'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMKI" onclick="kirim_id2MKI(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Setuju</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMKI" onclick="kirim_idMKI(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Tidak Setuju</a>
		    ';
		    }
		}
		
		else{
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Persetujuan</span>
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
// 			$and = "AND a.id = $id";
			$and = "AND id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM seminar_ilmiah WHERE nim = '$nim' $and and edit_id <= '0' ");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM seminar_ilmiah a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0' ");
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
		
		////skrip notipiskasi
		if($this->level == 16){
			$this->siak_model->notifInsert("seminar_ilmiah", $nim, $jenis, $this->level);
		}
		/////
		
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
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($result == NULL && $edit_id == '0' || $edit_id == NULL){
// 		    echo $id;
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editMSI" onclick="editMSI(this)" link="'.URL.'siak_mahasiswa/data_seminar_ilmiah/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Ubah</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMSI" onclick="kirim_idSem(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Hapus</a>
		    ';
		    }
		}
		else if($this->level != '16'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMSI" onclick="kirim_id2Sem(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Setuju</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMSI" onclick="kirim_idSem(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Tidak Setuju</a>
		    ';
		    }
		}
		
		else{
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Persetujuan</span>
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
// 			$and = "AND a.id = $id";
			$and = "AND id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum" || $jenis == "Umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM prestasi WHERE nim = '$nim' $and and edit_id <= '0'");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM prestasi a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and and a.edit_id <= '0'");
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
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
		
		////skrip notipiskasi
		if($this->level == 16){
			$this->siak_model->notifInsert("prestasi", $nim, $jenis, $this->level);
		}
		/////
		
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
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($result == NULL && $edit_id == '0'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editMP" onclick="editMP(this)" link="'.URL.'siak_mahasiswa/data_prestasi/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Ubah</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMP" onclick="kirim_idMP(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Hapus</a>
		    ';
		    }
		}
		else if($this->level != '16'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approveMP" onclick="kirim_id2MP(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Setuju</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusMP" onclick="kirim_idMP(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Tidak Setuju</a>
		    ';
		    }
		}
		
		else{
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Persetujuan</span>
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
// 			$and = "AND a.id = $id";
			$and = "AND id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM pekerjaan_mahasiswa WHERE nim = '$nim' $and ");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM pekerjaan_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and ");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_pekerjaan', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_pekerjaan_edit', true); }
	}

	public function data_riwayat_pendidikan($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
// 			$and = "AND a.id = $id";
			$and = "AND id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		/* $this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM riwayat_pendidikan_mahasiswa WHERE nim = '$nim' $and");
		if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_riwayat_pendidikan', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_riwayat_pendidikan_edit', true); } */
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM riwayat_pendidikan WHERE nim = '$nim' $and and edit_id <= '0'");
		if($act == "data"){ 
			$this->siak_view->siak_render('siak_mahasiswa/pendidikan/data_pendidikan', true); 
		}elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/pendidikan/data_pendidikan_edit', true); 
		}
	}

	public function data_riwayat_pangkat($nim, $jenis, $act, $id){
		$this->siak_view->nim = $nim;
		$this->siak_view->id = $id;
		$this->siak_view->jenis = $jenis;

		if (isset($id)) {
// 			$and = "AND a.id = $id";
			$and = "AND id = $id";
		}else{
			$and = "";
		}

		if ($jenis == "umum") {
			$table = "data_pribadi_umum";
		}elseif ($jenis == "pns") {
			$table = "data_pribadi_pns";
		}
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM riwayat_pangkat WHERE nim = '$nim' $and and edit_id <= '0'");
		// $this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM riwayat_pangkat_mahasiswa WHERE nim = '$nim' $and");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.*, b.nim FROM riwayat_pangkat_mahasiswa a, $table b WHERE a.nim = '$nim' AND a.nim = b.nim $and ");
		/* if($act == "data"){ $this->siak_view->siak_render('siak_mahasiswa/data_riwayat_pangkat', true); }
		elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/data_riwayat_pangkat_edit', true); } */
		if($act == "data"){ 
			$this->siak_view->siak_render('siak_mahasiswa/riwayat_pangkat/data_riwayat_pangkat', true); 
		}elseif($act == "edit"){
			$this->siak_view->siak_render('siak_mahasiswa/riwayat_pangkat/data_riwayat_pangkat_edit', true); 
		}
	}

	public function siak_edit_save($nim, $x, $table, $jenis, $id){
		
		/// buat pengecekan siapa yg ngerubah data (mahasiswa / kaprodi / superuser) !!
// 		if($_SESSION['level'] == 16){
		    /// ini kalo mahasiswa (saat update data malah insert data baru)
		    if($table == "bahasa_asing" || $table == "kursus_latihan" || $table == "karya_ilmiah" || $table == "seminar_ilmiah" || $table == "prestasi" || $table == "riwayat_pendidikan" || $table == "riwayat_pangkat" || $table == "pendidikan_mahasiswa"){
			      $this->siak_model->siak_custom_create($table);
// 			      echo "mahasiswa";
		    }
// 		}else{
// 		    if($table == "bahasa_asing" || $table == "kursus_latihan" || $table == "karya_ilmiah" || $table == "seminar_ilmiah" || $table == "prestasi"){
// 			      $this->siak_model->siak_update_save($table, $where);
// 		    }
// 		}
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
	
	///////// GET FILE LIST FROM DIRECTORY
	function getFileList($dir) { 
		// array to hold return value 
		$retval = array(); 
		// add trailing slash if missing 
		if(substr($dir, -1) != "/") $dir .= "/"; 
		// open pointer to directory and read list of files 
		$d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading"); 
			while(false !== ($entry = $d->read())) { 
			// skip hidden files 
				if($entry[0] == ".") continue; 
				if(is_dir("$dir$entry")) { 
					$retval[] = array( 
// 							  "name" => "$dir$entry/", 
							  "name" => "$entry/", 
							  "type" => filetype("$dir$entry"), 
							  "size" => 0, 
							  "lastmod" => filemtime("$dir$entry") 
							  ); 
				}elseif(is_readable("$dir$entry")) { 
					$retval[] = array( 
// 							  "name" => "$dir$entry", 
							  "name" => "$entry", 
							  "type" => mime_content_type("$dir$entry"), 
							  "size" => filesize("$dir$entry"), 
							  "lastmod" => filemtime("$dir$entry") 
							  ); 
				} 
			} 
		$d->close(); 
		return $retval;
	}

	public function siak_delete($nim, $table, $id, $jenis){
	
		$tab = $this->siak_model->cekTabs($table);
	
		$data = array($nim, $table, $id, $jenis);
		$where = array('id' => $id);
		
		$sql_cek = "select * from $table where nim = '$nim' and edit_id = '$id'";
		
		$cek = $this->siak_model->siak_query("select", $sql_cek);
		$id_del = $cek[0][id];
		
		
		if(count($cek) <= 0){
		
			$sql_del = "delete from $table where id = '$id'";
		
		}else{
		
			$sql_del = "delete from $table where id = '$id_del'";
		      
		}
		
// 		echo $sql_del;die();
		
		$this->siak_model->siak_query("delete", $sql_del);
		
		
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis.'/'.$tab);
	}
	
	public function siak_approve($nim, $table, $id, $jenis){
		
		$tab = $this->siak_model->cekTabs($table);
		
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
		
		if($this->level != 16){
		
// 			$this->siak_model->notifInsert($table, $_POST['nim'], $jenis, $this->level);
			$this->siak_model->notifInsert($table, $nim, $jenis, $this->level);
			  
		}
		
		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis.$tab);
	}
	
	function cek_riwayat( $nim, $jenis, $id, $bahasa, $edit_idx){
		if($edit_idx == NULL){
			$edit_id = '0';
		}else{
			$edit_id = $edit_idx;
		}
		
		$sql = "select edit_id from riwayat_pendidikan where nim = '$nim' and edit_id = '$id'";
		
		$result = $this->siak_model->siak_query("select", $sql);
		
// 		var_dump($sql);die();
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($result == NULL && $edit_id == 0){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editPEN" onclick="editPEN(this)" link="'.URL.'siak_mahasiswa/data_riwayat_pendidikan/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Ubah</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusPEN" onclick="kirim_idPEN(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Hapus</a>
		    ';
		    }
		}
		else if($this->level != '16'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approvePEN" onclick="kirim_id2PEN(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Setuju</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusPEN" onclick="kirim_idPEN(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Tidak Setuju</a>
		    ';
		    }
		}
		
		else{
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Persetujuan</span>
			</span>';
		}
		
	}
	
	function tambah_riwayat($nim,$jenis){
		
// 		var_dump($_POST);die();
		$this->siak_model->siak_custom_create("riwayat_pendidikan");
		
		////skrip notipiskasi
		if($this->level == 16){
			$this->siak_model->notifInsert("riwayat_pendidikan", $nim, $jenis, $this->level);
		}
		/////
		
// 		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}
	
	function add_riwayat($jenis,$nim){
		$this->siak_view->jenis = $jenis;
		$this->siak_view->nim = $nim;
		$this->siak_view->siak_render('siak_mahasiswa/pendidikan/add_pendidikan', true);
	}
	
	function add_riwayat_pangkat($jenis,$nim){
		$this->siak_view->jenis = $jenis;
		$this->siak_view->nim = $nim;
		$this->siak_view->siak_render('siak_mahasiswa/riwayat_pangkat/add_riwayat_pangkat', true);
	}
	
	function cek_riwayat_pangkat( $nim, $jenis, $id, $bahasa, $edit_idx){
		if($edit_idx == NULL){
			$edit_id = '0';
		}else{
			$edit_id = $edit_idx;
		}
		
		$sql = "select edit_id from riwayat_pangkat where nim = '$nim' and edit_id = '$id'";
		
		$result = $this->siak_model->siak_query("select", $sql);
		
// 		var_dump($sql);die();
		
		//Hak Akses
		$method_or_uri = 'siak_mahasiswa';
		$rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($result == NULL && $edit_id == 0){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn blue mini" data-toggle="modal" data-target="#editPKT" onclick="editPKT(this)" link="'.URL.'siak_mahasiswa/data_riwayat_pangkat/'.$nim.'/'.$jenis.'/edit/'.$id.'"><i class="icon-edit"></i> Ubah</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusPKT" onclick="kirim_idPKT(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Hapus</a>
		    ';
		    }
		}
		else if($this->level != '16'){
		    if($rolePage['updates'] == "t"){
		    echo '
		    <a class="btn green mini" data-toggle="modal" data-target="#approvePKT" onclick="kirim_id2PKT(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-ok"></i> Setuju</a>';
		    }
		    if($rolePage['deletes'] == "t"){
		    echo '
		    <a class="btn red mini" data-toggle="modal" data-target="#hapusPKT" onclick="kirim_idPKT(\''.$id.'\',\''.$nim.'\',\''.$bahasa.'\')"><i class="icon-trash"></i> Tidak Setuju</a>
		    ';
		    }
		}
		
		else{
		  echo '<span class="progress progress-striped active">
			<span class="bar" style="width: 100%;">Menunggu Persetujuan</span>
			</span>';
		}
		
	}
	
	function tambah_riwayat_pangkat($nim,$jenis){
		
// 		var_dump($_POST);die();
		$this->siak_model->siak_custom_create("riwayat_pangkat");
		
		////skrip notipiskasi
		if($this->level == 16){
			$this->siak_model->notifInsert("riwayat_pangkat", $nim, $jenis, $this->level);
		}
		/////
		
// 		header('location: ' . URL . 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis);
	}

}