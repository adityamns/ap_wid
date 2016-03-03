<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_keputusan_pembekalan extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "pembekalan" && $value['kode'] == "keputusan_pembekalan") {
				$this->siak_view->loads   = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->data_keputusan();
	}

	function data_keputusan(){
		$datanilai = $this->siak_model->siak_query("select", "select a.nim, b.pembekalan sum(a.nilai_total) / (select count(materi_id) from materi_pembekalan) as rata_rata from nilai_mahasiswa_pembekalan a, mahasiswa b where a.nim = b.nim and b.pembekalan != 2 group by a.nim;");
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT a.nim, a.status, a.prodi_id, a.pembekalan, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id UNION SELECT a.nim, a.status, a.prodi_id, a.pembekalan, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id ORDER BY nim;");
		$this->siak_view->data_jml_nilai = $this->siak_model->siak_query("select", "select count(*),nim from nilai_mahasiswa_pembekalan group by nim;");
		$this->siak_view->data_materi = $this->siak_model->siak_data_list("materi_pembekalan","*");
		$this->siak_view->data_nilai = $this->siak_model->siak_data_list("nilai_mahasiswa_pembekalan","*");
		$this->siak_view->data_aturan_nilai = $this->siak_model->siak_data_list("aturan_nilai","*");
		foreach ($datanilai as $key => $value) {
			foreach ($this->siak_view->data_aturan_nilai as $key => $valz) {
				if ($valz['nilaimin'] <= (int)$value['rata_rata'] && $valz['nilaimax'] >= (int)$value['rata_rata']) {
					if($valz['lulus']=="Y"){
						$this->siak_model->siak_query("update","UPDATE mahasiswa set pembekalan = 2 WHERE nim = '".$value['nim']."'; ");
					}else{
						$this->siak_model->siak_query("update","UPDATE mahasiswa set pembekalan = 1 WHERE nim = '".$value['nim']."'; ");
					}
				}
			}
		}
		$this->siak_view->siak_render('siak_keputusan_pembekalan/index', false);
	}

	function lulus($nim){
		$this->siak_model->siak_query("update", "UPDATE mahasiswa set pembekalan = 2 WHERE nim = '".$nim."';");
		header('location: ' . URL . 'siak_keputusan_pembekalan');
	}

}

?>