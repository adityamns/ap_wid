<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak role controller class */

class Siak_role extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "pengaturan") {
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
		$this->siak_view->siak_modul = $this->siak_model->siak_data_list("modul","*");
		$this->siak_view->siak_group = $this->siak_model->siak_data_list("grup","*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT group_id, count(id) as jml_hak FROM role GROUP BY group_id;");
		$this->siak_view->siak_render('siak_role/data', true);
	}

	public function siak_pengaturan($group_id){
		$where = array('group_id' => $group_id);
		$this->siak_view->siak_modul = $this->siak_model->siak_data_list("modul","*");
		$this->siak_view->siak_group = $this->siak_model->siak_data_list("grup","*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_edit($where, "role", "*");
		$this->siak_view->group_id = $group_id;
		$this->siak_view->siak_render('siak_role/data_role', false);
	}

	public function siak_add($group_id){
		$where = array('id' => $group_id);
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");	
		$this->siak_view->siak_modul = $this->siak_model->siak_data_list("modul","*");
		$this->siak_view->siak_group = $this->siak_model->siak_edit($where, "grup","*");
		$this->siak_view->siak_render('siak_role/add', true);
	}

	public function siak_create(){
		$_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pengaturan');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");	
		$this->siak_view->siak_modul = $this->siak_model->siak_data_list("modul","*");
		$this->siak_view->siak_group = $this->siak_model->siak_data_list("grup","*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "role", "*");
		$this->siak_view->siak_render('siak_role/edit', true);
	}

	public function siak_edit_save($id){
		$_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pengaturan');
	}

	public function siak_roledelete($group_id){
		$where = array('group_id' => $group_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pengaturan');
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pengaturan');
	}


}

?>