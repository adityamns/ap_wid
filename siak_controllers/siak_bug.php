<?php

class Siak_Bug extends Siak_controller{
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}
	
	function index(){
		//Hak Akses
		$method_or_uri = $this->uri->getUri(1);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->config = "Siak Widyatama - Lapor Masalah";
		
		$this->siak_view->judul = "Lapor Masalah";
		
		$this->siak_breadcrumbs->add(array('title'=>'Lapor Masalah','href'=>'#'));
// 		$this->siak_breadcrumbs->add(array('title'=>'Data Universitas','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Lapor Masalah','href'=>'' .URL. 'siak_bug'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$sql = "select * from laporbug order by id desc";
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		
		$this->siak_view->siak_render("laporbug/index", false);
	}
	
	function detailBug($id){
		
		$sql = "select * from laporbug where id = '".$id."'";
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render("laporbug/detail", true);
		
	}
	
	function hapusBug($id){
		
		$sql = "delete from laporbug where id = '".$id."'";
		$this->siak_model->siak_query("delete", $sql);
		header('location: ' . URL . 'siak_bug');
		
	}
	
	function updateBug($id){
		
		$sql = "update laporbug set status = true where id = '".$id."'";
		$this->siak_model->siak_query("update", $sql);
		header('location: ' . URL . 'siak_bug');
		
	}
}