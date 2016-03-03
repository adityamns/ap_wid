<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak group controller class */

class Siak_group extends Siak_controller{

	function __construct(){
		parent::__construct();
		$this->role = array('owner');
		parent::siak_logstat();
	}

	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("grup", "*");
		$this->siak_view->siak_render('siak_group/data', true);
	}

	public function siak_add(){
		$this->siak_view->siak_render('siak_group/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pengaturan');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "grup", "*");
		$this->siak_view->siak_render('siak_group/edit', true);
	}

	public function siak_edit_save($id){
		$where = array('id' => $id,);
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