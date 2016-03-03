<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_set_transkrip extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Setting Transkrip";
	
		$this->siak_view->judul = "Setting transkrip";
			
		$this->siak_breadcrumbs->add(array('title'=>'Yudisium','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Set Transkrip','href'=>'#'));
		
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "yudisium" && $value['kode'] == "set_transkrip") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->loads  = $value['loads'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();	
	}
	
	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("set_transkrip", "*");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->siak_render('siak_set_transkrip/data', false);
	}
	
	public function siak_add(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data_list2 = $this->siak_model->siak_data_list("jabatan", "kode,nama");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->cohort = $this->siak_model->siak_query("select", "select cohort from cohort group by cohort order by cohort asc");
		$this->siak_view->siak_render('siak_set_transkrip/add', true);
	}
	
	public function siak_create(){


	 $_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
	//$prodi_gabung = array($_POST['prodi_id'],$_POST['prodis']);
	//$implode = implode($prodi_gabung,",");
		$data = array(
			      'tgl_transkrip' => $_POST['tgl_transkrip'],
			      //'prodi_id' => $implode,
				  'cohort' => $_POST['cohort'],
			      'status' => $_POST['status'],
				   'nama_pejabat' => $_POST['nama_pejabat'],
				   'jabatan_pejabat' => $_POST['jabatan_pejabat'],
				   'prodi_id' => $_POST['prodi_id'],
			     
			      );
	//var_dump($data);die();
		$this->siak_model->insert_data($data, "set_transkrip");
		header('location: ' . URL . 'siak_set_transkrip');
	}
	
	public function siak_edit($id){

		$where = array('id' => $id);

		$this->siak_view->cohort = $this->siak_model->siak_query("select", "select cohort from cohort group by cohort order by cohort asc");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "set_transkrip", "*");
		$this->siak_view->siak_render('siak_set_transkrip/edit', true);
	}
	
	public function siak_edit_save($id){
		 
		$where = array('id' => $id);
		$_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_set_transkrip');
	}
	
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_set_transkrip');
	}
}

?>