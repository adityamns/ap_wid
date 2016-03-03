<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak modul controller class */

class Siak_bobot_absen extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->role = array('owner');
	}

	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		// $this->siak_view->status_modul = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("bobot_absen", "*");
		$this->siak_view->siak_render('siak_bobot_absen/data', false);
	}

	public function siak_add(){
		$this->siak_view->status_modul = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_render('siak_bobot_absen/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pengaturan');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		// $this->siak_view->status_modul = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "bobot_absen", "*");
		$this->siak_view->siak_render('siak_bobot_absen/edit', true);
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