	<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Aturan Nilai controller class */

class Siak_aturan_nilai extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "penilaian" && $value['kode'] == "aturan_nilai") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("aturan_nilai", "*");
		$this->siak_view->siak_render('siak_aturannilai/data', true);
	}

	public function siak_add(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_aturannilai/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_master/siak_nilai');
	}

	public function siak_edit($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "aturan_nilai", "*");
		$this->siak_view->siak_render('siak_aturannilai/edit', true);
	}
	public function siak_edit_save($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_master/siak_nilai');
	}

	public function siak_detail($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "aturan_nilai", "*");
		$this->siak_view->siak_render('siak_aturannilai/view', false);
	}

	public function siak_delete($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_aturannilai/siak_datalist');
	}



}

?>