<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak prodi controller class */

class Siak_prodi extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "universitas") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->siak_render('siak_prodi/data', true);
	}

	public function siak_add($fakID){
		$this->siak_view->siak_fakID = $fakID;
		$this->siak_view->siak_render('siak_prodi/add', true);
	}

	public function siak_create(){
// 		echo "<pre>";
// 		var_dump($_POST);
// 		echo "</pre>";die();
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_fakultas');
	}

	public function siak_edit($prodi_id){
	
		$where = array('prodi_id' => $prodi_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "prodi", "*");
		$this->siak_view->siak_render('siak_prodi/edit', true);
	}
	public function siak_detail($prodi_id){
		$where = array('prodi_id' => $prodi_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "prodi", "*");
		$this->siak_view->siak_render('siak_prodi/view', false);
	}

	public function siak_edit_save($prodi_id){
		$where = array('prodi_id' => $prodi_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_fakultas');
	}

	public function siak_delete($prodi_id){
		$where = array('prodi_id' => $prodi_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_fakultas');
	}

}

?>