<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak modul controller class */

class Siak_modul extends Siak_controller{

	function __construct(){
		parent::__construct();
		$this->role = array('owner');
		parent::siak_logstat();
	}

	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->status_modul = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("modul", "*");
		$this->siak_view->siak_render('siak_modul/data', true);
	}

	public function siak_add(){
		$this->siak_view->status_modul = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_render('siak_modul/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pengaturan');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->status_modul = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "modul", "*");
		$this->siak_view->siak_render('siak_modul/edit', true);
	}

	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pengaturan');
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pengaturan');
	}

}

?>