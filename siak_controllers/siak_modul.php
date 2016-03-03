<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak modul controller class */

class Siak_modul extends Siak_controller{

	function __construct(){
		parent::__construct();
		$this->role = array('owner');
		parent::siak_logstat();
	}

	//////////EDIT
	
	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$sql = "select * from menu order by id";
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render('siak_modul/data', true);
	}
	
	function tambah(){
	      $nama = $_POST['nama'];
	      $parent = $_POST['parent'];
	      $sort = $_POST['sort'];
	      $url = $_POST['url'];
	      $status = $_POST['status'];
	      
	      $sql = "insert into menu(nama_modul, url, parent, urutan, status) values('$nama', '$url', '$parent', '$sort', '$status')";
// 	      echo $sql;die();
	      $this->siak_model->siak_query("insert", $sql);
	      header('location: '.URL.'siak_pengaturan');
	}
	


	public function siak_add(){
		$sql = "select * from menu order by id";
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render('siak_modul/add', true);
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "menu", "*");
		$sql = "select id,nama_modul from menu order by id";
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render('siak_modul/edit', true);
	}

	public function update($id){
		$nama = $_POST['nama'];
		$parent = $_POST['parent'];
		$sort = $_POST['sort'];
		$url = $_POST['url'];
		$status = $_POST['status'];
		
		$sql = "update menu set nama_modul = '$nama', url = '$url', parent = '$parent', urutan = '$sort', status = '$status' where id = '$id'";
//   	      echo $sql;die();
		$this->siak_model->siak_query("update", $sql);
		header('location: '.URL.'siak_pengaturan');
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pengaturan');
	}
	
	/////////////////END

}

?>