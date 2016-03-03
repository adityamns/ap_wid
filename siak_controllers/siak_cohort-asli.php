<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Atur Cohort controller class */

class Siak_cohort extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "persiapan_perkuliahan" && $value['kode'] == "aktivasi_cohort") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
				$this->prodi_id = $value['prodi_id'];
			}
		}
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Aktivasi Cohort";
	
		$this->siak_view->judul = "Aktivasi Cohort";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Aktivasi Cohort','href'=>''. URL . 'siak_cohort'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("cohort", "*");
		$this->siak_view->siak_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_cohort/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_cohort/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		$this->siak_model->siak_query("update", "UPDATE mahasiswa set cohort = ".$_POST['cohort']." WHERE prodi_id = '".$_POST['prodi_id']."' AND tahun_masuk = ".$_POST['tahun_masuk'].";");
		header('location: ' . URL . 'siak_cohort');
	}

	public function siak_edit($id_cohort){
		$where = array('id_cohort' => $id_cohort);
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "cohort", "*");
		$this->siak_view->siak_render('siak_cohort/edit', true);
	}
	
	public function siak_edit_save($id_cohort){
		$where = array('id_cohort' => $id_cohort);
		$this->siak_model->siak_edit_save($where);
		$this->siak_model->siak_query("update", "UPDATE mahasiswa set cohort = ".$_POST['cohort']." WHERE prodi_id = '".$_POST['prodi_id']."' AND tahun_masuk = ".$_POST['tahun_masuk'].";");
		header('location: ' . URL . 'siak_cohort');
	}

	public function siak_delete($id_cohort){
		$where = array('id_cohort' => $id_cohort);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_cohort');
	}

	public function kapasitas($ruang_id){
		$where = array('ruang_id' => $ruang_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "ruang", "kapasitas");
		$this->siak_view->siak_render('siak_atur_pembekalan/kapasitas', true);
	}
}

?>