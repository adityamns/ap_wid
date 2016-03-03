<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak pengampu_pembekalan controller class */

class Siak_pengampu_pembekalan extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Pengampu Pembekalan";
		
		$this->siak_view->judul = "Pengampu Pembekalan";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Pembekalan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Pengampu Pembekalan','href'=>'' .URL. 'siak_pengampu_pembekalan'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "pembekalan" && $value['kode'] == "pengampu_pembekalan") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();
	}

	function siak_datalist(){
		$this->siak_view->status_pengampu = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("pengampu_pembekalan", "*");
		$this->siak_view->siak_render('siak_pengampu_pembekalan/data', false);
	}

	function siak_add(){
		$this->siak_view->status_pengampu = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_render('siak_pengampu_pembekalan/add', true);
	}

	public function siak_create(){
		// $_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pengampu_pembekalan');
	}

	public function siak_edit($pengampu_id){
		$where = array('pengampu_id' => $pengampu_id);
		$this->siak_view->status_pengampu = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pengampu_pembekalan", "*");
		$this->siak_view->siak_render('siak_pengampu_pembekalan/edit', true);
	}

	public function siak_edit_save($pengampu_id){
		$where = array('pengampu_id' => $pengampu_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pengampu_pembekalan');
	}

	public function siak_delete($pengampu_id){
		$where = array('pengampu_id' => $pengampu_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pengampu_pembekalan');
	}
}

?>