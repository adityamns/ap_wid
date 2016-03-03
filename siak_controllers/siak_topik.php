<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak matakuliah controller class */

class Siak_topik extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi = $_SESSION['prodi'];
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Hak Akses
		$method_or_uri = 'siak_topik';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->config = "Siak Widyatama - Topik";
		
		$this->siak_view->judul = "Topik";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Matakuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Topik','href'=>'' .URL. 'siak_topik'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_datalist();
	}

	public function siak_datalist(){

		$prodi_id = $this->prodi;

		if($prodi_id != NULL){
		    $split = explode(',', $prodi_id);
		    if(sizeof($split)>1){

			foreach($split as $p){
			  $new[] = "'".$p."'";
			}
			$new = implode(',', $new);
			$where = "AND matakuliah.prodi_id in (".$new.")";
		    }else{
			$where = "AND matakuliah.prodi_id in ('".$prodi_id."')";
		    }
		}else{
		    $where = "";
		}

		$sql = "
			select 
				topik.*,
				matakuliah.* 
			from 
				topik,
				matakuliah
			where 
				matakuliah.kode_matkul = topik.kode_matkul
				$where
		      ";

		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render('siak_topik/data', false);
	}

	public function siak_add(){
		$prodi_id = $this->prodi;

		if($prodi_id != NULL){
		    $split = explode(',', $prodi_id);
		    if(sizeof($split)>1){

			foreach($split as $p){
			  $new[] = "'".$p."'";
			}
			$new = implode(',', $new);
			$where = "where prodi_id in (".$new.")";
		    }else{
			$where = "where prodi_id in ('".$prodi_id."')";
		    }
		}else{
		    $where = "";
		}

		$sql = "select * from matakuliah $where";
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
		$prodi = $this->prodi;
		if($this->prodi == NULL){
			$where = '';
		}else{
			$where = " where prodi_id = '$prodi'";
		}
		$sql = "select * from matakuliah $where";
		$this->siak_view->siak_data_matkul = $this->siak_model->siak_query("select", $sql);
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