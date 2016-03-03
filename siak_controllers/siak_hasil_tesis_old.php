<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_hasil_tesis extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "hasil_tesis") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
	}

	function index(){
		$this->siak_hasil_tesis();
	}

	function siak_hasil_tesis(){
		
		$this->siak_view->siak_render('siak_hasil_tesis/index', false);
	}
	
	function siak_data(){
		$tahun = $_POST['TAHUN'];
		$prodi = $_POST['PRODI'];
		$data['mahasiswa'] = $this->siak_model->siak_query("select", '
				SELECT 
			jadwal_sidang_tesis.id,
			a.nim,
			a.tahun_masuk,
			a.nama_depan,
			a.nama_belakang,
			a.prodi_id,
			a.prodi
			 
		FROM 
			view_mahasiswa a,
			jadwal_sidang_tesis
			
			
		WHERE 
			a.nim=jadwal_sidang_tesis.nim  AND a.tahun_masuk = "2014" AND a.prodi_id = "DRK"


		');		
		var_dump($data);die();
		
		echo json_encode($data);
	}
	
	function siak_nilai($nim){
		$where = array('nim' => $nim);
		foreach($this->siak_model->siak_edit($where, "mahasiswa", "*") as $key => $value){
			$jenis = $value['jenis'];
			$prodi = $value['prodi_id'];
			$tahun_masuk = $value['tahun_masuk'];
		}
		$this->siak_view->siak_mhs = $this->siak_model->siak_edit($where, "view_mahasiswa", "*");
		
		foreach($this->siak_model->siak_edit($where, "pendaftaran_tesis", "*") as $key => $value){
			$where_jadwal = array('judulsidangtesis_id' => $value['judultesis_id']);
			$pembimbing1 = $value['dosen_pembimbing1'];
			$pembimbing2 = $value['dosen_pembimbing2'];
			$pembimbing3 = $value['dosen_pembimbing3'];
		}
		
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 1 AND a.nip = '".$pembimbing1."'");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 2 AND a.nip = '".$pembimbing2."'");
		$this->siak_view->siak_pembimbing3 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 3 AND a.nip = '".$pembimbing3."'");
		
		$this->siak_view->siak_penguji = $this->siak_model->siak_query("select", "
		SELECT a.*, b.nama from dosen_pembimbing a, pembimbing b where b.kode=a.nip and penguji='TRUE'
		union
		SELECT a.*, b.nama from dosen_pembimbing a, penguji b where b.kode=a.nip and penguji='TRUE'
		");
		
		$this->siak_view->siak_jadwal = $this->siak_model->siak_edit($where_jadwal, "jadwal_sidang_tesis", "*");
		$i=1;
				$judul=array();
				$all_penguji=array();
		foreach ($this->siak_view->siak_jadwal as $key => $values){
			$p = explode(',', $values['penguji_id']);
			$this->siak_view->JP = sizeof($p);
			for($x=0 ; $x < $this->siak_view->JP; $x++){
				$judul['data']=$p[$x];
				array_push($all_penguji,$judul);
			}
		}
		//var_dump($all_penguji);
		$this->siak_view->all_penguji=$all_penguji;
		//die();
		// echo "<pre>";
		// print_r($this->siak_view->siak_jadwal);
		// echo "<br />";
		// print_r($this->siak_view->siak_penguji);
		// echo "</pre>";
		// die();
		
		$bobot_where = array('tahun_id' => $tahun_masuk, 'prodi_id' => $prodi);
		foreach($this->siak_model->siak_edit($bobot_where, "bobot_tesis", "*") as $key => $value){
			$id_bobot_tesis = array('id_bobot_tesis' => $value['id']);
			$this->siak_view->pembimbing = $value['pembimbing'];
			$this->siak_view->penguji = $value['penguji'];
		}
		
		$this->siak_view->siak_komponen = $this->siak_model->siak_edit($id_bobot_tesis, "komponen_tesis", "*");
		$this->siak_view->jml = sizeof($this->siak_view->siak_komponen);
		$i = 1;
		foreach($this->siak_view->siak_komponen as $key => $value){
			$id_komponen_tesis = array('id_komponen_tesis' => $value['id']);
			$this->siak_view->siak_sub_komponen[$i] = $this->siak_model->siak_edit($id_komponen_tesis, "sub_komponen_tesis", "*");
			$i++;
		}
		
		$this->siak_view->siak_render('siak_hasil_tesis/add', false);
	}
	
	
}

?>