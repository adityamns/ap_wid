<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak prodidikti controller class */

class Siak_prodidikti extends Siak_controller{
	
	function __construct(){
		// $this->css  = array('siak_public/siak_css/siak_default.css');
		// $this->js  = array('siak_public/siak_css/siak_default.css');
		parent::__construct();
		$this->role = array('owner');
		parent::siak_logstat();
	}

	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodidikti", "*");
		$this->siak_view->siak_render('siak_prodidikti/data', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_master');
	}

	public function siak_edit($prodidikti_id){
		$where = array('prodidikti_id' => $prodidikti_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "prodidikti", "*");
		$this->siak_view->siak_render('siak_prodidikti/edit', false);
	}

	public function siak_edit_save($id_mahasiswa){
		$where = array('id_mahasiswa' => $id_mahasiswa,);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_master');
	}

	public function siak_delete($id_mahasiswa){
		$where = array('id_mahasiswa' => $id_mahasiswa);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_master');
	}

}

?>