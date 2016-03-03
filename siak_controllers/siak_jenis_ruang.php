<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak jenis_ruang controller class */

class Siak_jenis_ruang extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Hak Akses
		$method_or_uri = 'siak_jenis_ruang';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->config = "Siak Widyatama  - Jenis Ruangan";
	
		$this->siak_view->judul = "Jenis Ruangan";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Ruangan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Jenis Ruangan','href'=>''. URL . 'siak_jenis_ruang'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("jenis_ruang", "*");
		$this->siak_view->siak_render('siak_jenis_ruang/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_render('siak_jenis_ruang/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_jenis_ruang');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "jenis_ruang", "*");
		$this->siak_view->siak_render('siak_jenis_ruang/edit', true);
	}

	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_jenis_ruang');
	}

	public function siak_detail($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "jenis_ruang", "*");
		$this->siak_view->siak_render('siak_jenis_ruang/view', false);
	}
	
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_jenis_ruang');
	}

}

?>