<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak jenismatkul controller class */

class Siak_jenismatkul extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "matkul") {
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
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("jenismatkul", "*");
		$this->siak_view->siak_render('siak_jenismatkul/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_jenismatkul/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_jenismatkul');
	}

	public function siak_edit($jenismatkul_id){
		$where = array('jenismatkul_id' => $jenismatkul_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "jenismatkul", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_jenismatkul/edit', true);
	}
	public function siak_detail($jenismatkul_id){
		$where = array('jenismatkul_id' => $jenismatkul_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "jenismatkul", "*");
		$this->siak_view->siak_render('siak_jenismatkul/view', false);
	}

	public function siak_edit_save($jenismatkul_id){
		$where = array('jenismatkul_id' => $jenismatkul_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_jenismatkul');
	}

	public function siak_delete($jenismatkul_id){
		$where = array('jenismatkul_id' => $jenismatkul_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_jenismatkul');
	}

}

?>