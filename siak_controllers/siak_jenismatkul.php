<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak jenismatkul controller class */

class Siak_jenismatkul extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		
		$this->siak_view->config = "Siak Widyatama - Jenis Matakuliah";
		
		$this->siak_view->judul = "Jenis Matakuliah";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Matakuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Jenis Matakuliah','href'=>'' .URL. 'siak_jenismatkul'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		//Hak Akses
		$method_or_uri = 'siak_jenismatkul';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("jenismatkul", "*");
		$this->siak_view->siak_render('siak_jenismatkul/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_jenismatkul/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_jenismatkul');
	}

	public function siak_edit($jenismatkul_id){
		$where = array('jenismatkul_id' => $jenismatkul_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "jenismatkul", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_jenismatkul/edit', true);
	}
	public function siak_detail($jenismatkul_id){
		$where = array('jenismatkul_id' => $jenismatkul_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "jenismatkul", "*");
		$this->siak_view->siak_render('siak_jenismatkul/view', false);
	}

	public function siak_edit_save($jenismatkul_id){
		$where = array('jenismatkul_id' => $jenismatkul_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_jenismatkul');
	}

	public function siak_delete($jenismatkul_id){
		$where = array('jenismatkul_id' => $jenismatkul_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_jenismatkul');
	}

}

?>