<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Dosen Mata Kuliah controller class */

class Siak_dosen_matakuliah extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		$this->role = array('owner');
		parent::siak_logstat();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "mahasiswa") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
				$this->prodi_id = $value['prodi_id'];
			}
		}
		$this->prodi = $_SESSION['prodi'];
	}

	function index(){
		$this->siak_datalist();
	}

///////////////////////////////////////// ASLI :D EDIT -> HARI
// 	public function siak_datalist(){
// 		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("dosen_matakuliah", "*");
// 		$this->siak_view->siak_dosen = $this->siak_model->siak_data_list("dosen", "nip,nama");
// 		$this->siak_view->siak_render('siak_dosen_matakuliah/data', true);
// 	}
	public function siak_datalist(){
		$prodi = $this->prodi;
		
		if($prodi == ''){
		  $this->siak_view->siak_data_list = $this->siak_model->siak_data_list("dosen_matakuliah", "*");
		}
		else{
		  $sql = "
			    select * from dosen_matakuliah where prodi_id = '$prodi'
		  ";
		  $this->siak_view->siak_data_list = $this->siak_model->siak_query("select",$sql);		
		}
		
		$this->siak_view->siak_dosen = $this->siak_model->siak_data_list("dosen", "nip,nama");
		$this->siak_view->siak_render('siak_dosen_matakuliah/data', false);
	}
//
////////////////////////////////////// HARI :D

	public function siak_add(){
		$this->siak_view->prodi = $this->prodi;
	
		$this->siak_view->dosen_utama = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama FROM dosen a ');
		$this->siak_view->dosen_pendamping = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama FROM dosen a ');
		$this->siak_view->topik = $this->siak_model->siak_data_list("topik", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_dosen_matakuliah/add', true);
	}

// 	public function siak_add(){
// 		$this->siak_view->dosen_utama = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama, b.prodi_mengajar FROM dosen a, akademik_dosen b WHERE a.nip = b.nip AND b.status_dosen = 1 AND b.jenis_dosen = 1');
// 		$this->siak_view->dosen_pendamping = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama, b.prodi_mengajar FROM dosen a, akademik_dosen b WHERE a.nip = b.nip AND b.status_dosen = 1 AND b.jenis_dosen = 1');
// 		$this->siak_view->topik = $this->siak_model->siak_data_list("topik", "*");
// 		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
// 		$this->siak_view->siak_render('siak_dosen_matakuliah/add', true);
// 	}
	
	public function siak_create(){
		$_POST['dosen_utama'] = implode(',', $_POST['dosen_utama']);
		$_POST['dosen_pendamping'] = implode(',', $_POST['dosen_pendamping']);
// 		$dosen_utama = implode(',', $_POST['dosen_utama']);
// 		$dosen_pendamping = implode(',', $_POST['dosen_pendamping']);
		
		$data = array(
			      'prodi_id' => $_POST['prodi_id'],
			      'kode_matkul' => $_POST['kode_matkul'],
			      'dosen_utama' => $_POST['dosen_utama'],
			      'dosen_pendamping' => $_POST['dosen_pendamping']
			      );
			      
		$this->siak_model->insert_data($data, "dosen_matakuliah");
		
// 		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_persiapan_kuliah/siak_dosen_matakuliah');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->dosen_utama = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama, b.prodi_mengajar FROM dosen a, akademik_dosen b WHERE a.nip = b.nip AND b.status_dosen = 1 AND b.jenis_dosen = 1');
		$this->siak_view->dosen_pendamping = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama, b.prodi_mengajar FROM dosen a, akademik_dosen b WHERE a.nip = b.nip AND b.status_dosen = 1 AND b.jenis_dosen = 1');
		$this->siak_view->topik = $this->siak_model->siak_data_list("topik", "*");
		$this->siak_view->matakuliah = $this->siak_model->siak_data_list("matakuliah", "kode_matkul,nama_matkul");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "dosen_matakuliah", "*");
		$this->siak_view->siak_render('siak_dosen_matakuliah/edit', true);
	}
	
	public function siak_edit_save($id){
		$where = array('id' => $id);
		$_POST['dosen_utama'] = implode(',', $_POST['dosen_utama']);
		$_POST['dosen_pendamping'] = implode(',', $_POST['dosen_pendamping']);
		$_POST['kode_topik'] = implode(',', $_POST['kode_topik']);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_persiapan_kuliah/siak_dosen_matakuliah');
	}

	public function siak_detail($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "dosen_matakuliah", "*");
		$this->siak_view->siak_render('siak_dosen_matakuliah/view', false);
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_persiapan_kuliah/siak_dosen_matakuliah');
	}

	public function matkul($prodi,$smstr){
		$this->siak_view->siak_prodi = $prodi;
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT * FROM matakuliah WHERE prodi_id = '".$prodi."' and semester = '".$smstr."';");
		$this->siak_view->siak_render('siak_dosen_matakuliah/matkul', true);
	}
}

?>