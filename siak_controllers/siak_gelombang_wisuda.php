<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_gelombang_wisuda extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Setting Wisuda";
	
		$this->siak_view->judul = "Setting Wisuda";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Wisuda','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Setting Wisuda','href'=>''. URL . 'siak_gelombang_wisuda'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "wisuda" && $value['kode'] == "gelombang_wisuda") {
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
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("gelombang_wisuda", "*");
		$this->siak_view->siak_render('siak_gelombang_wisuda/data', false);
	}
	
	public function siak_add(){
		$this->siak_view->siak_render('siak_gelombang_wisuda/add', true);
	}
	
	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_gelombang_wisuda');
	}
	
	public function siak_edit($kode){
		$where = array('kode' => $kode);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "gelombang_wisuda", "*");
		$this->siak_view->siak_render('siak_gelombang_wisuda/edit', true);
	}
	
	public function siak_edit_save($kode){
		$where = array('kode' => $kode);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_gelombang_wisuda');
	}
	
	public function siak_delete($kode){
		$where = array('kode' => $kode);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_gelombang_wisuda');
	}
	
}

?>