<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak topik_pembekalan controller class */

class Siak_topik_pembekalan extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_datalist();
	}

	function siak_datalist(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "pembekalan" && $value['kode'] == "materi_pembekalan") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_view->siak_data_materi = $this->siak_model->siak_data_list("materi_pembekalan", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("topik_pembekalan", "*");
		$this->siak_view->siak_render('siak_topik_pembekalan/data', true);
	}

	function siak_add(){
		$this->siak_view->siak_data_materi = $this->siak_model->siak_data_list("materi_pembekalan", "*");
		$this->siak_view->siak_render('siak_topik_pembekalan/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_materi_pembekalan');
	}

	public function siak_edit($topik_materi_id){
		$where = array('topik_materi_id' => $topik_materi_id);
		$this->siak_view->siak_data_materi = $this->siak_model->siak_data_list("materi_pembekalan", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "topik_pembekalan", "*");
		$this->siak_view->siak_render('siak_topik_pembekalan/edit', true);
	}

	public function siak_edit_save($topik_materi_id){
		$where = array('topik_materi_id' => $topik_materi_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_materi_pembekalan');
	}

	public function siak_delete($topik_materi_id){
		$where = array('topik_materi_id' => $topik_materi_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_materi_pembekalan');
	}
}

?>