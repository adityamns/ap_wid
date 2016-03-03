<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak gedung controller class */

class Siak_gedung extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Hak Akses
		$method_or_uri = 'siak_gedung';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->config = "Siak Widyatama - Gedung";
	
		$this->siak_view->judul = "Gedung";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Ruangan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Gedung','href'=>''. URL . 'siak_gedung'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		$this->siak_view->status_gedung = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("gedung", "*");
		$this->siak_view->siak_render('siak_gedung/data', false);
	}

	public function siak_add(){
		$this->siak_view->status_gedung = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_render('siak_gedung/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_gedung');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->status_ruang = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "gedung", "*");
		$this->siak_view->siak_render('siak_gedung/edit', true);
	}

	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_gedung');
	}

	public function siak_detail($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "gedung", "*");
		$this->siak_view->siak_render('siak_gedung/view', false);
	}
	
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_gedung');
	}

}

?>