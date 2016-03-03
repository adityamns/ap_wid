<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak mahasiswa controller class */

class Siak_badan_hukum extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Hak Akses
		$method_or_uri = 'siak_fakultas';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->config = "Siak Widyatama - Badan Hukum";
		
		$this->siak_view->judul = "Badan Hukum";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Universitas','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Badan Hukum','href'=>'' .URL. 'siak_fakultas'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("badan_hukum", "*");
		$this->siak_view->siak_render('siak_badan_hukum/data', false);
	}

	public function siak_datapop(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("badan_hukum", "*");
		$this->siak_view->siak_render('siak_badan_hukum/popup', true);
	}

	public function coba(){
		$this->siak_model->siak_query("insert","INSERT INTO users VALUES(1,'asdas','sds','owner')");
	}

	public function siak_add(){
		$this->siak_view->siak_render('siak_badan_hukum/add', true);
	}

	public function siak_create(){
	
		
		$data = array(
			      'kode_kampus' => $_POST['kode_kampus'],
			      'singkatan' => $_POST['singkatan'],
			      'nama' => $_POST['nama'],
				   'alamat1' => $_POST['alamat1'],
				   'alamat2' => $_POST['alamat2'],
				    'kode_pos' => $_POST['kode_pos'],
					 'kota' => $_POST['kota'],
					 'telepon' => $_POST['telepon'],
					 'faksimil' => $_POST['faksimil'],
					 'tanggal_akta' => $_POST['tanggal_akta'],
					 'nama_akta' => $_POST['nama_akta'],
					 'tgl_pengesahan_peneg' => $_POST['tgl_pengesahan_peneg'],
					 'no_pengesahan_peneg' => $_POST['no_pengesahan_peneg'],
					 'alamat_email' => $_POST['alamat_email'],
					 'alamat_website' => $_POST['alamat_website'],
			      'tgl_pendirian' => $_POST['tgl_pendirian']
			      );
		var_dump($data);die();
		//$this->siak_model->insert_data($data, "badan_hukum");
		
		//header('location: ' . URL . 'siak_badan_hukum');
	}

	public function siak_edit($kode_kampus){
		$where = array('kode_kampus' => $kode_kampus);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "badan_hukum", "*");
		$this->siak_view->siak_render('siak_badan_hukum/edit', true);
	}
	public function siak_detail($kode_kampus){
		$where = array('kode_kampus' => $kode_kampus);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "badan_hukum", "*");
		$this->siak_view->siak_render('siak_badan_hukum/view', true);
	}

	public function siak_edit_save($kode_kampus){
		$where = array('kode_kampus' => $kode_kampus,);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_badan_hukum');
	}

	public function siak_delete($kode_kampus){
		$where = array('kode_kampus' => $kode_kampus);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_badan_hukum');
	}

}

?>