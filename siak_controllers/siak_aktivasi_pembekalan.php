<?php

/* Siak setKurikulum controller class */

class Siak_aktivasi_pembekalan extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
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
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Aktivasi Pembekalan";
	
		$this->siak_view->judul = "Aktivasi Pembekalan";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Pembekalan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Aktivasi Pembekalan','href'=>''. URL . 'siak_aktivasi_pembekalan'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_view->mahasiswa = $this->siak_model->siak_query("select", "SELECT COUNT(a.nim) as jml_mhs, a.tahun_masuk, a.pembekalan FROM mahasiswa a WHERE status = 1 GROUP BY a.tahun_masuk, a.pembekalan ORDER BY a.tahun_masuk ASC;");
		// echo "SELECT COUNT(a.nim) as jml_mhs, a.cohort, a.tahun_masuk, a.pembekalan FROM mahasiswa a WHERE status = 1 GROUP BY a.cohort, a.tahun_masuk, a.pembekalan ORDER BY a.cohort ASC;"; die();
		$this->siak_view->siak_render('siak_aktivasi_pembekalan/index', false);
	}

	public function siak_set($tahun_masuk){
		$this->siak_model->siak_query("update", "UPDATE mahasiswa set pembekalan = 0; ");
		$this->siak_view->siak_data = $this->siak_model->siak_query("update", "UPDATE mahasiswa set pembekalan = 1 WHERE tahun_masuk = ".$tahun_masuk."; ");
		header('location: ' . URL . 'siak_aktivasi_pembekalan/');
	}

	public function siak_unset($tahun_masuk){
		$this->siak_view->siak_data = $this->siak_model->siak_query("update", "UPDATE mahasiswa set pembekalan = 0 WHERE tahun_masuk = ".$tahun_masuk."; ");
		header('location: ' . URL . 'siak_aktivasi_pembekalan/');
	}

	public function siak_mahasiswa($cohort){
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.*, b.nama_depan, b.nama_belakang, b.telp_rumah, b.handphone, b.alamat_rumah, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND cohort = ".$cohort." UNION SELECT a.*, b.nama_depan, b.nama_belakang, b.telp_rumah, b.handphone, b.alamat_rumah, c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND cohort = ".$cohort."");
		$this->siak_view->siak_render('siak_mahasiswa/data', false);
	}

}

?>