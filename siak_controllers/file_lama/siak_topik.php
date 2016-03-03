<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak matakuliah controller class */

class Siak_topik extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi = $_SESSION['prodi'];
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "matkul") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$sql = "
			select 
				topik.*,
				matakuliah.* 
			from 
				topik,
				matakuliah
			where 
				matakuliah.kode_matkul = topik.kode_matkul AND
				matakuliah.prodi_id = '$this->prodi'
		      ";
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", $sql);
// 		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("topik", "*");
		$this->siak_view->siak_render('siak_topik/data', false);
	}

	public function siak_add(){
		$prodi = $this->prodi;
		$sql = "select * from matakuliah where prodi_id = '$prodi'";
		$this->siak_view->siak_data_matkul = $this->siak_model->siak_query("select", $sql);
// 		$this->siak_view->siak_data_matkul = $this->siak_model->siak_data_list("matakuliah","*");
		$this->siak_view->siak_render('siak_topik/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_topik');
	}

	public function siak_datapop(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("matakuliah", "*");
		$this->siak_view->siak_render('siak_matakuliah/popup', true);
	}
	
	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "topik", "*");
// 		echo "<pre>";
// 		var_dump($this->siak_view->siak_data);
// 		echo "</pre>";
// 		die();
		$this->siak_view->siak_data_matkul = $this->siak_model->siak_data_list("matakuliah","*");
		$this->siak_view->siak_render('siak_topik/edit', true);
	}

	public function siak_detail($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "topik", "*");
		$this->siak_view->siak_render('siak_topik/view', false);
	}

	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_topik');
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_topik');
	}
	public function kurikulum($prodi){
		$this->siak_view->siak_prodi = $prodi;
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", 'SELECT * FROM kurikulum ; ');
		$this->siak_view->siak_render('siak_matakuliah/kurikulum', true);
	}
}

?>