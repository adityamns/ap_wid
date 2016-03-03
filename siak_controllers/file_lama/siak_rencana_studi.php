<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak rencana_studi controller class */

class Siak_rencana_studi extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->siak_render('siak_rencana_studi/index', false);
	}

	public function siak_cek($nim, $semester){
		$this->siak_view->nim = $nim;
		$this->siak_view->semester = $semester;
		$where = array('nim' => $nim);
		$prodi = $this->siak_model->siak_edit($where, "mahasiswa", "prodi_id,cohort");
		foreach ($prodi as $key => $value) {
			// if ($semester != 0) {
			// 	$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semester);
			// }else{
			// 	$kondisi = array('prodi_id' => $value['prodi_id']);
			// }
			$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semester);
			$this->siak_view->cohort = $value['cohort'];
		}
		$this->siak_view->data = $this->siak_model->siak_edit($kondisi, "matakuliah", "*");
		$this->siak_view->siak_render('siak_rencana_studi/irs', true);
	}
	
	public function siak_ok(){
		$this->siak_view->siak_data = $this->siak_model->siak_query("update", "UPDATE mahasiswa set semester = '".$_POST['semester']."', status = '1' WHERE nim = '".$_POST['nim']."'; ");
		header('location: ' . URL . 'siak_rencana_studi');
	}

	public function form_cuti($nim, $semester, $cohort){
		$where = array('nim' => $nim);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "mahasiswa", "*");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->semester = $semester;
		$this->siak_view->siak_render('siak_rencana_studi/form_cuti', true);
	}

	public function insert_cuti(){
		$this->siak_model->siak_query("insert","insert into cuti values ('','".$_POST['nim']."','".$_POST['prodi_id']."', ".$_POST['semester'].", '".$_POST['lama_cuti']."', '".$_POST['tgl_mulai']."', '".$_POST['tgl_selesai']."', '".$_POST['alamat_cuti']."', '".$_POST['telp_cuti']."', 2)");
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
}

?>