<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_pendaftaran_tesis extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "pendaftaran_tesis") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->loads  = $value['loads'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		if (Siak_session::siak_get('level')==16){
		$this->siak_add();
		}else{$this->siak_datalist();
		}
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("pendaftaran_tesis", "*");
		$this->siak_view->siak_render('siak_pendaftaran_tesis/data', false);
	}
	
	public function siak_add(){
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 1");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 2");
		$this->siak_view->siak_pembimbing3 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 3");
		if (Siak_session::siak_get('level')==16){
		$this->siak_view->siak_render('siak_pendaftaran_tesis/add_mhs', false);
		}else{
		$this->siak_view->siak_render('siak_pendaftaran_tesis/add', true);
		}
	}
	
	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pendaftaran_tesis');
	}
	
	public function siak_create_ajax(){
		$hasil = $this->siak_model->siak_query("select", "
		SELECT * FROM pendaftaran_judul_tesis as a, hasil_sidang as b WHERE a.judultesis_id = b.judultesis_id AND b.hasil = 1 AND a.nim = '".$_POST['NIM']."'
		");
		
		if($hasil != NULL){
			$where1 = array('nim' => $_POST['NIM']);
			foreach($this->siak_model->siak_edit($where1, "mahasiswa", "*") as $key => $value){
				$jenis = $value['jenis'];
				$prodi = $value['prodi_id'];
			}
			if($jenis == 'Umum'){
				$data['nama'] = $this->siak_model->siak_edit($where1, "data_pribadi_umum", "*");
			} else if($jenis == 'pns') {
				$data['nama'] = $this->siak_model->siak_edit($where1, "data_pribadi_pns", "*");
			}
			
			$where2 = array('prodi_id' => $prodi);
			$data['prodi'] = $this->siak_model->siak_edit($where2, "prodi", "*");
			$data['pendaftaran'] = $this->siak_model->siak_edit($where1, "pendaftaran_judul_tesis", "*");
			foreach($data['pendaftaran'] as $key =>  $value){
				$dosen1 = $value['dosen_pembimbing1'];
				$dosen2 = $value['dosen_pembimbing2'];
				$dosen3 = $value['dosen_pembimbing3'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 1 AND a.nip = '".$dosen1."'") as $key => $val){
				$data['dosen1'] = $val['nama'];
				$data['nip1'] = $val['nip'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 2 AND a.nip = '".$dosen2."'") as $key => $val){
				$data['dosen2'] = $val['nama'];
				$data['nip2'] = $val['nip'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 3 AND a.nip = '".$dosen3."'") as $key => $val){
				$data['dosen3'] = $val['nama'];
				$data['nip3'] = $val['nip'];
			}
			$data['message'] = "";
		} else {
			$data['nama'] = "";
			$data['prodi'] = "";
			$data['pendaftaran'] = "";
			$data['message'] = "Mahasiswa tidak lulus sidang proposal";
		}		
		echo json_encode($data);
	}
	
	public function siak_edit_ajax(){
		$hasil = $this->siak_model->siak_query("select", "
		SELECT * FROM pendaftaran_tesis as a, hasil_sidang as b WHERE a.judultesis_id = b.judultesis_id AND b.hasil = 1 AND a.nim = '".$_POST['NIM']."'
		");
		
		if($hasil != NULL){
			$where1 = array('nim' => $_POST['NIM']);
			foreach($this->siak_model->siak_edit($where1, "mahasiswa", "*") as $key => $value){
				$jenis = $value['jenis'];
				$prodi = $value['prodi_id'];
			}
			if($jenis == 'umum'){
				$data['nama'] = $this->siak_model->siak_edit($where1, "data_pribadi_umum", "*");
			} else if($jenis == 'pns') {
				$data['nama'] = $this->siak_model->siak_edit($where1, "data_pribadi_pns", "*");
			}
			
			$where2 = array('prodi_id' => $prodi);
			$data['prodi'] = $this->siak_model->siak_edit($where2, "prodi", "*");
			$data['pendaftaran'] = $this->siak_model->siak_edit($where1, "pendaftaran_tesis", "*");
			foreach($data['pendaftaran'] as $key =>  $value){
				$dosen1 = $value['dosen_pembimbing1'];
				$dosen2 = $value['dosen_pembimbing2'];
				$dosen3 = $value['dosen_pembimbing3'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 1 AND a.nip = '".$dosen1."'") as $key => $val){
				$data['dosen1'] = $val['nama'];
				$data['nip1'] = $val['nip'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 2 AND a.nip = '".$dosen2."'") as $key => $val){
				$data['dosen2'] = $val['nama'];
				$data['nip2'] = $val['nip'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 3 AND a.nip = '".$dosen3."'") as $key => $val){
				$data['dosen3'] = $val['nama'];
				$data['nip3'] = $val['nip'];
			}
			$data['message'] = "";
		} else {
			$data['nama'] = "";
			$data['prodi'] = "";
			$data['pendaftaran'] = "";
			$data['message'] = "Mahasiswa tidak lulus sidang proposal";
		}		
		echo json_encode($data);
	}
	
	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_tesis", "*");
		
		//NAMA & PRODI
		foreach($this->siak_view->siak_data as $key => $value){
			$nim = $value['nim'];
		}
		
		$where4 = array('nim' => $nim);
		$query = $this->siak_model->siak_edit($where4, "mahasiswa", "*");
		foreach($query as $key => $value){
			$jenis = $value['jenis'];
			$prodi = $value['prodi_id'];
		}
		
		if($jenis == 'umum'){
			$this->siak_view->siak_nama = $this->siak_model->siak_edit($where4, "data_pribadi_umum", "*");
		} else if($jenis == 'pns') {
			$this->siak_view->siak_nama = $this->siak_model->siak_edit($where4, "data_pribadi_pns", "*");
		}
		
		$where5 = array('prodi_id' => $prodi);
		$this->siak_view->siak_prodi = $this->siak_model->siak_edit($where5, "prodi", "*");
		//END NAMA & PRODI
		
		$this->siak_view->siak_render('siak_pendaftaran_tesis/edit', true);
	}
	
	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pendaftaran_tesis');
	}
	
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pendaftaran_tesis');
	}
	
}

?>