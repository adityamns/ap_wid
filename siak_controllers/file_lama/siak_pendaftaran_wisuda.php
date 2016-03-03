<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_pendaftaran_wisuda extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "wisuda" && $value['kode'] == "pendaftaran_wisuda") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->loads  = $value['loads'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();	
	}

	public function siak_datalist(){
		/*echo "asdasd";die();*/
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("pendaftaran_wisuda", "*");
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/data', false);
	}

	public function siak_add(){
		//$this->siak_view->no_pendaftaran=101;
		$this->siak_view->siak_data_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pendaftaran_wisuda');
	}

	public function siak_edit($wisuda_id){
		$where = array('wisuda_id' => $wisuda_id);
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_wisuda", "*");
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/edit', true);
	}
	public function siak_detail($wisuda_id){
		$where = array('wisuda_id' => $wisuda_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_wisuda", "*");
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/view', false);
	}

	public function siak_edit_save($wisuda_id){
		$where = array('wisuda_id' => $wisuda_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pendaftaran_wisuda');
	}

	public function siak_delete($wisuda_id){
		$where = array('wisuda_id' => $wisuda_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pendaftaran_wisuda');
	}

}

?>