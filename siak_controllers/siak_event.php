<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak event controller class */

class Siak_event extends Siak_controller{
	
	function __construct(){
		// $this->css  = array('siak_public/siak_css/siak_default.css');
		// $this->js  = array('siak_public/siak_css/siak_default.css');
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "event") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
				$this->prodi_id = $value['prodi_id'];
			}
		}
	}

	function index(){
		$this->siak_datalist();
		
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("event", "*");
		$this->siak_view->siak_render('siak_event/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_render('siak_event/add', false);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_event');
	}
	/*public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'Siak_event/siak_datalist');
	}*/

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "event", "*");
		$this->siak_view->siak_render('Siak_event/edit', false);
	}
	public function siak_detail($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "event", "*");
		$this->siak_view->siak_render('Siak_event/view', false);
	}

	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_event');
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'Siak_event/siak_datalist');
	}

}

?>