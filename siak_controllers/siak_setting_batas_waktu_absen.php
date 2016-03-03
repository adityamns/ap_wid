<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak batas_waktu_absen controller class */

class Siak_setting_batas_waktu_absen extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Hak Akses
		$method_or_uri = 'siak_setting_batas_waktu_absen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->config = "Siak Widyatama  - Setting Batas Waktu Absen";
	
		$this->siak_view->judul = "Setting Batas Waktu Absen";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Setting Batas Waktu Absen','href'=>''. URL . 'siak_setting_batas_waktu_absen'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("batas_waktu_absen", "*");
		$this->siak_view->siak_render('siak_setting_batas_waktu_absen/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_render('siak_setting_batas_waktu_absen/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_setting_batas_waktu_absen');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "batas_waktu_absen", "*");
		$this->siak_view->siak_render('siak_setting_batas_waktu_absen/edit', true);
	}

	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_setting_batas_waktu_absen');
	}

	public function siak_detail($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "batas_waktu_absen", "*");
		$this->siak_view->siak_render('siak_setting_batas_waktu_absen/view', false);
	}
	
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_setting_batas_waktu_absen');
	}

}

?>