	<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Aturan Nilai controller class */

class siak_batasan_waktu_nilai extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Hak Akses
		$method_or_uri = 'siak_batasan_waktu_nilai';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_view->config = "Siak Widyatama - Batas Input Nilai";
	
		$this->siak_view->judul = "Batas Input Nilai";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Penilaian','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Batas Input Nilai','href'=>''. URL . 'siak_batasan_waktu_nilai'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "Select a.*,to_char(a.bts_input_awal,'dd-mm-yyyy') as awal,to_char(bts_input_akhir,'dd-mm-yyyy') as akhir, b.nama_matkul from batasan_waktu_nilai a,matakuliah b where a.matkul_id=b.kode_matkul");
		// var_dump($this->siak_view->siak_data_list);
		// die();
		$this->siak_view->siak_render('siak_batasan_waktu/data', false);
	}

	public function siak_add(){
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->matkul = $this->siak_model->siak_data_list("matakuliah", "*");	
		$this->siak_view->tahun_masuk = $this->siak_model->siak_query("select", "select distinct tahun_masuk from mahasiswa;");
		$this->siak_view->siak_render('siak_batasan_waktu/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_batasan_waktu_nilai');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->matkul = $this->siak_model->siak_data_list("matakuliah", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "Select a.*,to_char(a.bts_input_awal,'dd-mm-yyyy') as awal,to_char(bts_input_akhir,'dd-mm-yyyy') as akhir, b.nama_matkul from batasan_waktu_nilai a,matakuliah b where a.matkul_id=b.kode_matkul");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "batasan_waktu_nilai", "*");
		$this->siak_view->siak_render('siak_batasan_waktu/edit', true);
	}
	public function siak_edit_save($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_master/siak_nilai');
	}

	public function siak_detail($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "aturan_nilai", "*");
		$this->siak_view->siak_render('siak_batasan_waktu/view', false);
	}

	public function siak_delete($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_batasan_waktu/siak_datalist');
	}



}

?>