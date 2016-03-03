<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Dosen Mata Kuliah controller class */

class Siak_dosen_matakuliah extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		$this->role = array('owner');
		parent::siak_logstat();
		$this->rolePage = $this->siak_session->siak_getAll();
		$this->prodi = $_SESSION['prodi'];
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Setting Dosen Matakuliah";
	
		$this->siak_view->judul = "Setting Dosen Matakuliah";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Setting Dosen Matakuliah','href'=>''. URL . 'siak_jenis_ruang'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		//Hak Akses
		$method_or_uri = 'siak_dosen_matakuliah';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_datalist();
	}

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
		
		$this->siak_view->dosen_utama = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama FROM dosen a ');
		$this->siak_view->dosen_pendamping = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama FROM dosen a ');
		$this->siak_view->topik = $this->siak_model->siak_data_list("topik", "*");
		
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
		
		$this->siak_view->kurikulum = $this->siak_model->siak_query("select", 'SELECT * FROM kurikulum ; ');
		
		$this->siak_view->siak_render('siak_dosen_matakuliah/add', true);
	}
	
	public function siak_create(){
	
		$_POST['dosen_pendamping'] = implode(',', $_POST['dosen_pendamping']);
		
		$data = array(
			      'prodi_id' => $_POST['prodi_id'],
			      'kode_matkul' => $_POST['kode_matkul'],
			      'kurikulum_id' => $_POST['kurikulum_id'],
			      'dosen_utama' => $_POST['dosen_utama'],
			      'dosen_pendamping' => $_POST['dosen_pendamping']
			      );
// 		var_dump($_POST);die();
		$this->siak_model->insert_data($data, "dosen_matakuliah");
		
		header('location: ' . URL . 'siak_dosen_matakuliah');
	}

	public function siak_edit($id){
		$this->siak_view->prodi = $this->prodi;
		$where = array('id' => $id);
		$this->siak_view->dosen_utama = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama, b.prodi_mengajar FROM dosen a, akademik_dosen b WHERE a.nip = b.nip AND b.status_dosen = 1 AND b.jenis_dosen = 2');
		$this->siak_view->dosen_pendamping = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama, b.prodi_mengajar FROM dosen a, akademik_dosen b WHERE a.nip = b.nip AND b.status_dosen = 1 AND b.jenis_dosen = 1');
// 		var_dump($this->siak_view->dosen_pendamping);
// 		die();
		$this->siak_view->dosen_utama2 = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama FROM dosen a ');
		$this->siak_view->dosen_pendamping2 = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama FROM dosen a ');
		
		$this->siak_view->topik = $this->siak_model->siak_data_list("topik", "*");
		$this->siak_view->matakuliah = $this->siak_model->siak_data_list("matakuliah", "kode_matkul,nama_matkul,semester");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "dosen_matakuliah", "*");
		
		$this->siak_view->kurikulum = $this->siak_model->siak_query("select", 'SELECT * FROM kurikulum ; ');
		
		$this->siak_view->siak_render('siak_dosen_matakuliah/edit', true);
	}
	
	public function siak_edit_save($id){
		$where = array('id' => $id);
// 		$_POST['dosen_utama'] = implode(',', $_POST['dosen_utama']);
		$_POST['dosen_pendamping'] = implode(',', $_POST['dosen_pendamping']);
		$_POST['kode_topik'] = implode(',', $_POST['kode_topik']);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_dosen_matakuliah');
	}

	public function siak_detail($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "dosen_matakuliah", "*");
		$this->siak_view->siak_render('siak_dosen_matakuliah/view', false);
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_dosen_matakuliah');
	}

	public function matkul($prodi,$smstr){
		$this->siak_view->siak_prodi = $prodi;
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT * FROM matakuliah WHERE prodi_id = '".$prodi."' and semester = '".$smstr."';");
		$this->siak_view->siak_render('siak_dosen_matakuliah/matkul', true);
	}
}

?>