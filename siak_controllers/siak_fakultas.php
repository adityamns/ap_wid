<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_fakultas extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Hak Akses
		$method_or_uri = 'siak_fakultas';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->config = "Siak Widyatama - Fakultas";
		
		$this->siak_view->judul = "Fakultas";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Universitas','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Fakultas','href'=>'' .URL. 'siak_fakultas'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("fakultas", "*");
		$this->siak_view->siak_render('siak_fakultas/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_render('siak_fakultas/add', true);
	}

	public function siak_create(){
// 		var_dump($_POST);die();
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_fakultas');
	}

	public function siak_edit($fakultas_id){
		$where = array('fakultas_id' => $fakultas_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "fakultas", "*");
		$this->siak_view->siak_render('siak_fakultas/edit', true);
	}
	public function siak_detail($fakultas_id){
		$where = array('fakultas_id' => $fakultas_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "fakultas", "*");
		$this->siak_view->siak_render('siak_fakultas/view', false);
	}

	public function siak_edit_save($fakultas_id){
		$where = array('fakultas_id' => $fakultas_id);
		// $this->siak_model->siak_query("updates", "UPDATE fakultas SET fakultas_id = '".$_POST['fakultas_id']."',fakultas = '".$_POST['fakultas']."',tgl_berdiri = '".$_POST['tgl_berdiri']."', keterangan = '".$_POST['keterangan']."' WHERE fakultas_id = '".$fakultas_id."' ;");
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_fakultas');
	}

	public function siak_delete($fakultas_id){
		$where = array('fakultas_id' => $fakultas_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_fakultas');
	}

	public function siak_prodi($fakultas_id){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "universitas") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_view->siak_fakID = $fakultas_id;
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT * FROM prodi WHERE fakultas_id = '".$fakultas_id."'; ");
		$this->siak_view->siak_render('siak_prodi/data', true);
	}
}

?>