<?php
if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Syarat_wisuda extends Siak_controller {
  function __construct(){
    parent::__construct();
    parent::siak_logstat();
    $this->siak_roles();
  }
  
  function index(){
		$this->siak_view->config = "Siak Widyatama - Master Syarat Wisuda";
	
		$this->siak_view->judul = "Master Syarat Wisuda";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Wisuda','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Master Syarat Wisuda','href'=>''. URL . 'syarat_wisuda'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
    $sql = "select * from dok_syarat_wisuda";
    $this->siak_view->data = $this->siak_model->siak_query("select", $sql);
    $this->siak_view->siak_render("syarat_wisuda/index", false);
  }
  
  function add(){
    $sql = "select * from dok_syarat_wisuda";
    $this->siak_view->data = $this->siak_model->siak_query("select", $sql);
    $this->siak_view->siak_render("syarat_wisuda/add", true);
  }
  
  function create(){
  
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $sql = "insert into dok_syarat_wisuda(nama,status) values('$nama','$status')";
    echo $sql;
    
    $this->siak_model->siak_query("insert", $sql);
    header('location: ' . URL . 'syarat_wisuda/index');
  }
  
  function edit($id){
    $sql = "select * from dok_syarat_wisuda where id = '$id'";
    $this->siak_view->data = $this->siak_model->siak_query("select", $sql);
    $this->siak_view->siak_render("syarat_wisuda/edit", true);
  }
  
  function update(){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $sql = "update dok_syarat_wisuda set nama = '$nama', status = '$status' where id = '$id'";
//     echo $sql;
//     die();
    $this->siak_model->siak_query("update", $sql);
    header('location: ' . URL . 'syarat_wisuda/index');
  }
  
  function delete($id){
    $where = array('id' => $id);
    $this->siak_model->siak_delete($where);
    header('location: ' . URL . 'syarat_wisuda/index');
  }
}