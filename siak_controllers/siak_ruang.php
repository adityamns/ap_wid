<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak ruang controller class */

class Siak_ruang extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Hak Akses
		$method_or_uri = 'siak_ruang';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->config = "Siak Widyatama - Ruangan";
	
		$this->siak_view->judul = "Ruangan";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Ruangan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Ruangan','href'=>''. URL . 'siak_ruangan'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("ruang", "*");
		$this->siak_view->siak_render('siak_ruang/data', false);
	}

	public function siak_add(){
		$this->siak_view->gedung = $this->siak_model->siak_query("select", "select * from gedung where status = 1");
		$this->siak_view->jenis_ruang = $this->siak_model->siak_data_list("jenis_ruang", "*");
		$this->siak_view->status_ruang = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_render('siak_ruang/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_ruang');
	}

	public function siak_edit($ruang_id){
		$where = array('ruang_id' => $ruang_id);
		$this->siak_view->gedung = $this->siak_model->siak_query("select", "select * from gedung where status = 1");
		$this->siak_view->jenis_ruang = $this->siak_model->siak_data_list("jenis_ruang", "*");
		$this->siak_view->status_ruang = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "ruang", "*");
		$this->siak_view->siak_render('siak_ruang/edit', true);
	}

	public function siak_edit_save($ruang_id){
		$where = array('ruang_id' => $ruang_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_ruang');
	}

	public function siak_detail($ruang_id){
		$where = array('ruang_id' => $ruang_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "ruang", "*");
		$this->siak_view->siak_render('siak_ruang/view', false);
	}
	
	public function siak_delete($ruang_id){
		$where = array('ruang_id' => $ruang_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_ruang');
	}
	function getRuang(){
		
		$siak_data = $this->siak_model->siak_data_list("ruang", "*");
		//var_dump($siak_data);
		$data_ruang = array();
		
				$result = array();
		foreach ($siak_data as $nilai => $row ){
			//var_dump($nilai);
			$data_ruang['ruang_id']=$row['ruang_id'];
			$data_ruang['nama_ruang']=$row['nama_ruang'];
			
			
			array_push($result,$data_ruang);
		}
		
		print json_encode($result);
	}

}

?>