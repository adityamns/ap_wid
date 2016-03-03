<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak kurikulum controller class */

class Siak_kurikulum extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		
		$this->siak_view->config = "Siak Widyatama - Kurikulum";
		$this->siak_view->judul = "Kurikulum";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Matakuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Kurikulum','href'=>'' .URL. 'siak_kurikulum'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		//Hak Akses
		$method_or_uri = 'siak_kurikulum';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_datalist();
		
	}

	public function siak_datalist(){
		$this->siak_view->status_kurikulum = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("kurikulum", "*");
		$this->siak_view->siak_render('siak_kurikulum/data', false);
	}

	public function siak_add(){
		$this->siak_view->status_kurikulum = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_kurikulum/add', true);
	}

	public function siak_create(){
		$_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_kurikulum');
	}

	public function siak_edit($kurikulum_id){
		$where = array('kurikulum_id' => $kurikulum_id);
		$this->siak_view->status_kurikulum = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "kurikulum", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_kurikulum/edit', true);
	}
	
	public function siak_edit_save($kurikulum_id){
		$where = array('kurikulum_id' => $kurikulum_id);
		$_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_kurikulum');
	}

	public function siak_detail($kurikulum_id){
		$where = array('kurikulum_id' => $kurikulum_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "kurikulum", "*");
		$this->siak_view->siak_render('siak_kurikulum/view', false);
	}

	public function siak_delete($kurikulum_id){
		$where = array('kurikulum_id' => $kurikulum_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_kurikulum');
	}

}

?>
