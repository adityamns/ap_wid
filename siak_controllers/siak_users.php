<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak users controller class */

class Siak_users extends Siak_controller{

	function __construct(){
		parent::__construct();
		$this->role = array('owner');
		parent::siak_logstat();
	}

	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_status = $this->siak_model->siak_data_list("status","*");
		$this->siak_view->siak_group = $this->siak_model->siak_data_list("grup","*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("users", "id,username,group_id,status");
		$this->siak_view->siak_render('siak_users/data', true);
	}

	public function siak_add(){
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_status = $this->siak_model->siak_data_list("status","*");
		$this->siak_view->siak_group = $this->siak_model->siak_data_list("grup","*");
		$this->siak_view->siak_render('siak_users/add', true);
	}

	public function siak_create(){
		$_POST['prodi_id'] = implode(',' , $_POST['prodi_id']);
		$this->siak_model->siak_xhrInsert();
		header('location: ' . URL . 'siak_pengaturan');
	}

	public function siak_edit($id,$username){
		$where = array('id' => $id, 'username' => $username);
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_status = $this->siak_model->siak_data_list("status","*");
		$this->siak_view->siak_group = $this->siak_model->siak_data_list("grup","*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "users", "id,username,group_id,status,prodi_id");
		$this->siak_view->siak_render('siak_users/edit', true);
	}

	public function siak_edit_save($id){
		$where = array('id' => $id,);
		$_POST['prodi_id'] = implode(',' , $_POST['prodi_id']);
		$this->siak_model->siak_xhrEdit($where);
		header('location: ' . URL . 'siak_pengaturan');
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pengaturan');
	}

}

?>