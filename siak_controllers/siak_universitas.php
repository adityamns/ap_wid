<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak mahasiswa controller class */

class Siak_universitas extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->rolePages = $this->siak_session->siak_getAll();
	}

	function index(){
// 		foreach ($this->siak_session->siak_getAll() as $key => $value) {
// 			if ($value['groups'] == "master" && $value['kode'] == "universitas") {
// 				$this->siak_view->creates = $value['creates'];
// 				$this->siak_view->reades  = $value['reades'];
// 				$this->siak_view->updates = $value['updates'];
// 				$this->siak_view->deletes = $value['deletes'];
// 			}
// 		}
		
		//Hak Akses
		$method_or_uri = $this->uri->getUri(2);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePages, $method_or_uri);
		$this->siak_view->role = $this->rolePages;
		//
		
		$this->siak_view->config = "Siak Widyatama - Identitas Universitas";
		
		$this->siak_view->judul = "Identitas Universitas";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Universitas','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Identitas Universitas','href'=>'' .URL. 'siak_universitas'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("universitas", "*");
		$this->siak_view->siak_render('siak_universitas/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_render('siak_universitas/add', true);
	}

	public function siak_create(){
// 		echo "<pre>";
// 		var_dump($_POST);
// 		echo "</pre>";
// 		die();
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_universitas');
	}

	public function siak_edit($kode){
		$where = array('kode' => $kode);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "universitas", "*");
		$this->siak_view->siak_render('siak_universitas/edit', true);
	}
	public function siak_detail($kode){
		$where = array('kode' => $kode);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "universitas", "*");
		$this->siak_view->siak_render('siak_universitas/view', false);
	}

	public function siak_edit_save($kode){
		$where = array('kode' => $kode);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_universitas');
	}

	public function siak_delete($kode){
		$where = array('kode' => $kode);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_universitas');
	}

}

?>