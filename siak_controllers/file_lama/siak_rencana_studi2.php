<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak rencana_studi controller class */

class Siak_rencana_studi extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi = $_SESSION['prodi'];
		$this->level = $_SESSION['level'];
	}

	function index(){
		$this->siak_view->config = "Siak Unhan - Isian Rencana Studi";
	
		$this->siak_view->judul = "Isian Rencana Studi";
		
		///BreadCrumbs
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Isian Rencana Studi','href'=>''. URL . 'siak_rencana_studi'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		////
		
		$this->siak_view->siak_tahun_akademik = $this->siak_model->siak_data_list("tahun_akademik", "*");
		
		$nim = $_POST['nim'];
		if($nim == TRUE){
			$where = "where nim = '$nim'";
		}
		
		$sql = "select * from mahasiswa $where";
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		
		if($this->level != 16){
			$this->siak_view->siak_render('konfirmasi_irs/index', false);
		}else{
			$this->siak_view->siak_render('siak_rencana_studi/index', false);
		}
	}

	public function siak_cek($nim, $semester){
		$this->siak_view->nim = $nim;
		$this->siak_view->semester = $semester;
		$where = array('nim' => $nim, 'status' => 1);
		$prodi = $this->siak_model->siak_edit($where, "mahasiswa", "id,semester,prodi_id,cohort,tahun_akademik");
// 		var_dump($where);

		// TAMBAHAN
		$mhs = $this->siak_model->siak_query("select","select prodi_id from mahasiswa where nim='".$nim."'");
		foreach($mhs as $mh => $s){
			$this->siak_view->prod = $s['prodi_id'];
		}
		
		foreach ($prodi as $key => $value) {
			// if ($semester != 0) {
			// 	$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semester);
			// }else{
			// 	$kondisi = array('prodi_id' => $value['prodi_id']);
			// }
			
// 			$sql = "select * from nilai_mahasiswa where ";
			
			$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semester, 'jenismatkul_id' => 2);
			$this->siak_view->cohort = $value['cohort'];
			$this->siak_view->id_mhs = $value['id'];
			$this->siak_view->data = $this->siak_model->siak_edit($kondisi, "matakuliah", "*");
			
// 			if(){
// 			
// 			}

			$query = "";
			foreach ($this->siak_view->data as $key => $valu) {
				$query .= "SELECT * FROM nilai_mahasiswa WHERE prodi_id = '".$value['prodi_id']."' AND semester = ".$semester." AND nim = '".$nim."' AND matkul_id = '".$valu['kode_matkul']."' UNION  ";
			}

			$query = substr($query, 0, sizeof($query) -8);
			$query .= ";";
			

			
			
			$aturan_nilai = $this->siak_model->siak_data_list("aturan_nilai", "*");
			
			if($value['prodi_id'] != $this->prodi && $this->level != '1' && $this->level != '16'){
			    echo "<div class='alert alert-danger'>Mahasiswa dengan NPM : <u style='color:blue'>".$nim."</u> tidak terdaftar pada Prodi $this->prodi.</div>";
			    exit;
			}
			
			$this->siak_view->data_nilai = $this->siak_model->siak_query("select", $query);
			$nilai = array();
			foreach ($this->siak_view->data_nilai as $key => $values) {
				foreach ($aturan_nilai as $key => $valu) {
					if($values['grade']==$valu['nama']){
						$nilai[] = $valu['lulus'];
					}
				}
			}
			// echo $value['semester']+1;
			if ($semester == $value['semester']+1 && in_array("N", $nilai)) {
				$this->siak_view->siak_render('siak_rencana_studi/irs', true);
			}
			elseif ($semester == $value['semester']+1 && !in_array("N", $nilai)) {
				$this->siak_view->siak_render('siak_rencana_studi/irs', true);
			}
			elseif($semester < $value['semester']+1 && !in_array("N", $nilai)) {
				echo "<div class='alert alert-danger'>Anda Sudah Pernah Mengisi IRS Semester ". $semester ."</div>";
			}
			elseif($semester > $value['semester']+1 && !in_array("N", $nilai)) {
				echo "<div class='alert alert-danger'>Anda Belum Bisa Mengisi IRS Semester ". $semester ."</div>";
			}
			elseif($semester < $value['semester']+1 && in_array("N", $nilai)){ 
				echo "<div class='alert alert-warning'>Nilai Anda pada Semester ". $semester ." masih ada yang kurang, Silahkan tekan tombol perpanjang tahun akademik untuk bisa mengisi IRS kembali</div>";
				echo '<a href = "siak_rencana_studi/perpanjang/'.$nim.'/'.$semester.'/'.$value['tahun_akademik'].' "><input type = "button" value = "PERPANJANG TAHUN AKADEMIK" class = "btn btn-medium btn-primary "/></a>';
			}
		}
	}
	
	public function perpanjang($nim, $semester, $tahun_akademik){
		$semester = $semester-1;
		$this->siak_model->siak_query("update","UPDATE mahasiswa set semester = ".$semester." WHERE nim = '".$nim."';");
		header('location: ' . URL . 'siak_rencana_studi');
	}

	public function siak_ok(){
		$prodi_id = $this->prodi;
// 		$prodi_id = $_POST['prodi_id'];
		$smstr = $_POST['semester'];
		$nim = $_POST['nim'];
		
		$id = $_POST['id_mhs'];
		
		$prod_mhs = $_POST['prod_mhs'];
// 		var_dump($this->prodi);
		
		/////
		//Value of edit_id is '0' for original data & '-1' for insert data & 'real (id) value of table' for edited data
		
		if($this->level == 16){
			$where = "edit_id = '$id',";
		}

		
		foreach ($_POST['kode_matkul'] as $key => $value) {
		
			// $sql1 = "insert into tbl_matakuliah_all(prodi_id,semester,nim,matkul_id,edit_id) values('".$prodi_id."','".$smstr."','".$nim."','".$value."','-1')";
			$this->siak_model->siak_query("insert","insert into tbl_matakuliah_all(prodi_id,semester,nim,matkul_id,edit_id) values('".$prodi_id."','".$smstr."','".$nim."','".$value."','0')");
			// $this->siak_model->siak_query("insert","insert into tbl_matakuliah_all(prodi_id,semester,nim,matkul_id,edit_id) values('DRK','3','120140203001','M-MB3211','0')");
// 			$this->siak_model->siak_query("insert",$sql1);
			//echo $sql1."<br>";
		}
		
// 		die();
		// echo "UPDATE mahasiswa set $where semester = '".$_POST['semester']."', tahun_akademik = '".$_POST['tahun_akademik']."', status = '1' WHERE nim = '".$_POST['nim']."'; "; die();
		// $this->siak_view->siak_data = $this->siak_model->siak_query("update", "UPDATE mahasiswa set $where semester = '".$_POST['semester']."', tahun_akademik  = '".$_POST['tahun_akademik']."', status = '1' WHERE nim = '".$_POST['nim']."'; ");
		$this->siak_view->siak_data = $this->siak_model->siak_query("update", "UPDATE mahasiswa set edit_id='0', semester = '".$_POST['semester']."', tahun_akademik  = '".$_POST['tahun_akademik']."', status = '1' WHERE nim = '".$_POST['nim']."'; ");
		
		header('location: ' . URL . 'siak_rencana_studi');
		
		$url = "siak_rencana_studi";
		
		if($this->level == 16){
			$this->siak_model->notifInsertbaru($prod_mhs,$url,$this->level);
		}
	}

	public function form_cuti($nim, $semester, $cohort){
		$where = array('nim' => $nim);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "mahasiswa", "*");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->semester = $semester;
		$this->siak_view->siak_render('siak_rencana_studi/form_cuti', true);
	}

	public function form_matkul_pilihan($nim, $semester, $cohort){
		$where = array('nim' => $nim);
		$prodi = $this->siak_model->siak_edit($where, "mahasiswa", "prodi_id,cohort");
		
		
		foreach ($prodi as $key => $value) {
			$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semester, 'jenismatkul_id' => 1);
			$x = $value['prodi_id'];
		}
		
		$sql = "select * from matakuliah where jenismatkul_id = 1 AND prodi_id = '$x' AND semester = '$semester'";
		
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		
		$kondisi2 = array('prodi_id' => $x, 'semester' => $semester, 'jenismatkul_id' => 2);
		$this->siak_view->data2 = $this->siak_model->siak_edit($kondisi2, "matakuliah", "*");
		
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "mahasiswa", "*");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->semester = $semester;
		$this->siak_view->nim = $nim;
		$this->siak_view->cohort = $cohort;
		$this->siak_view->siak_render('siak_rencana_studi/form_matkul_pilihan', true);
	}

	public function insert_cuti(){
		$this->siak_model->siak_query("insert","insert into cuti values ('','".$_POST['nim']."','".$_POST['prodi_id']."', ".$_POST['semester'].", '".$_POST['lama_cuti']."', '".$_POST['tgl_mulai']."', '".$_POST['tgl_selesai']."', '".$_POST['alamat_cuti']."', '".$_POST['telp_cuti']."', 2)");
		header('location: ' . URL . 'siak_rencana_studi');
	}

	public function insert_matkul_pilihan(){
		$prodi_id = $_POST['prodi_id'];
		$smstr = $_POST['semester'];
		$nim = $_POST['nim'];
		
		foreach ($_POST['kode_matkul'] as $key => $value) {
		
			$sql1 = "insert into tbl_matakuliah_all(prodi_id,semester,nim,matkul_id) values('".$prodi_id."','".$smstr."','".$nim."','".$value."')";
			$this->siak_model->siak_query("insert",$sql1);
// 			echo $sql1."<br>";
		}
		foreach ($_POST['matkul_id'] as $key => $value) {
		
			$sql2 = "insert into tbl_matakuliah_all(prodi_id,semester,nim,matkul_id) values('".$prodi_id."','".$smstr."','".$nim."','".$value."')";
			$this->siak_model->siak_query("insert",$sql2);
// 			echo "<hr>".$sql2."<br>";
		}
// 		die();
		header('location: ' . URL . 'siak_rencana_studi');
	}

	public function tampil_cuti(){
		$where = array('status' => 2);
		$this->siak_view->data = $this->siak_model->siak_edit($where, "cuti", "*");
		$this->siak_view->siak_render('siak_rencana_studi/tampil_cuti', false);
	}

	public function form_confirm_cuti($id_cuti){
		$where = array('id_cuti' => $id_cuti);
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "cuti", "*");
		foreach ($this->siak_view->siak_data as $key => $value) {
			$kondisi = array('nim' => $value['nim']);
			$this->siak_view->cohort = $this->siak_model->siak_edit($kondisi, "mahasiswa", "cohort");
		}
		$this->siak_view->siak_render('siak_rencana_studi/form_confirm_cuti', true);
	}

	public function confirm_cuti($id_cuti, $nim){
		$confirm = $this->siak_model->siak_query("update","update cuti set status = 1 where id_cuti = ".$id_cuti.";");
		if ($confirm == true) {
			$this->siak_model->siak_query("update","update mahasiswa set status = 3 where nim = ".$nim."; ");
		}
		header('location: ' . URL . 'siak_rencana_studi/tampil_cuti');
	}
	
	public function set_edit_id($nim_set,$smt){
		$this->siak_model->siak_query("update","update mahasiswa set edit_id='1' where nim='".$nim_set."'");
		$this->siak_model->siak_query("update","update tbl_matakuliah_all set edit_id='1' where nim='".$nim_set."' and semester='".$smt."'");
		header('location: ' . URL . 'siak_rencana_studi');
	}
}

?> 