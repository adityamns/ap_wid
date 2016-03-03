<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Aturan Nilai controller class */

class Siak_tahun_akademik extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Hak Akses
		$method_or_uri = 'siak_tahun_akademik';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->config = "Siak Widyatama - Setting Tahun Akademik";
	
		$this->siak_view->judul = "Setting Tahun Akademik";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Setting Tahun Akademik','href'=>''. URL . 'siak_tahun_akademik'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("tahun_akademik", "*");
		$this->siak_view->siak_render('siak_tahun_akademik/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_tahun_akademik/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		$query=$this->siak_model->siak_query("select","select *from tahun_akademik order by tahun_id desc limit 1");
		foreach($query as $v =>$row){
			$tahun_id=$row['tahun_id'];
			$nama_tahun=$row['nama_tahun'];
		}
		$tahun_nama=explode('/',$nama_tahun);
		
		for($i=1;$i<=2;$i++){
			$semester=$i==1?'ganjil':'genap';
			$this->siak_model->siak_query("insert","insert into detail_tahun_akademik (tahun_id,tahun,semester,status) values('".$tahun_id."','".$tahun_nama[0]."$i','".$semester."',1)");
		}
		
		header('location: ' . URL . 'siak_tahun_akademik');
	}

	public function siak_edit($tahun_id){
		
		$where = array('tahun_id' => $tahun_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "tahun_akademik", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_tahun_akademik/edit', true);
	}
	public function siak_edit_save($tahun_id){
		$where = array('tahun_id' => $tahun_id);
		$this->siak_model->siak_edit_save($where);
		$tahun_nama=explode('/',$_POST['nama_tahun']);
		
		for($i=1;$i<=2;$i++){
			$semester=$i==1?'ganjil':'genap';
			 $this->siak_model->siak_query("update","update detail_tahun_akademik set tahun='".$tahun_nama[0]."$i' where tahun_id=$tahun_id and semester='".$semester."' ");
		}
		header('location: ' . URL . 'siak_tahun_akademik');
	}

	public function siak_detail($tahun_id){
		$where = array('tahun_id' => $tahun_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "tahun_akademik", "*");
		$this->siak_view->siak_render('siak_tahun_akademik/view', false);
	}
	public function detail($tahun_id){
		$where = array('tahun_id' => $tahun_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "detail_tahun_akademik", "*");
		$this->siak_view->siak_render('siak_tahun_akademik/detail', true);
	}

	public function siak_delete($tahun_id){
		$where = array('tahun_id' => $tahun_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_tahun_akademik');
	}



}

?>