<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Aturan Nilai controller class */

class Siak_kalender_akademik extends Siak_controller{
	
	function __construct(){
		// $this->css  = array('siak_public/siak_css/siak_default.css');
		// $this->js  = array('siak_public/siak_css/siak_default.css');
		parent::__construct();
		$this->role = array('owner');
		parent::siak_logstat();
	}

	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("dosen_matakuliah", "*");
		$this->siak_view->siak_render('siak_kalender_akademik/data', true);
	}

	public function siak_add(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_kalender_akademik/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_persiapan_kuliah/siak_kalender_akademik');
	}

	public function siak_edit($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "dosen_matakuliah", "*");
		$this->siak_view->siak_render('siak_kalender_akademik/edit', true);
	}
	public function siak_edit_save($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_persiapan_kuliah/siak_kalender_akademik');
	}

	public function siak_detail($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "dosen_matakuliah", "*");
		$this->siak_view->siak_render('siak_kalender_akademik/view', false);
	}

	public function siak_delete($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_kalender_akademik/siak_datalist');
	}



}

?>