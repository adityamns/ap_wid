<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak mahasiswa controller class */

class Siak_laporan_mahasiswa extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->level = $_SESSION['level'];
		$this->user = $_SESSION['username'];
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Laporan Mahasiswa";
	
		$this->siak_view->judul = "Rekap Mahasiswa";
		
		$this->siak_breadcrumbs->add(array('title'=>'Laporan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Laporan Mahasiswa','href'=>''. URL . 'siak_laporan_mahasiswa'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_view->siak_render('siak_laporan_mahasiswa/index', false);
	}

	public function siak_datalist($status){
		$this->siak_view->mhs = $this->siak_model->siak_query("select","select prodi_id,cohort,count(prodi_id) as jumlah from mahasiswa where status='".$status."' group by prodi_id,cohort");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi","*");
		$max_cohort_mhs = $this->siak_model->siak_query("select","select max(cohort) as max from mahasiswa");
		foreach($max_cohort_mhs as $max => $cohort_mhs){
			$this->siak_view->max_cohort_mhs = $cohort_mhs['max'];
		}
		$this->siak_view->status = $status;
		$this->siak_view->siak_render('siak_laporan_mahasiswa/data', true);
	}
	
	public function detail($prodi,$cohort,$status){
		$prodiy = $this->siak_model->siak_query("select","select * from prodi where prodi_id='".$prodi."'");
		foreach($prodiy as $pro => $diy){
			$this->siak_view->prodi = $diy['prodi'];
		}
		$this->siak_view->cohort = $cohort;
		$this->siak_view->detail_mhs = $this->siak_model->siak_query("select","select * from mahasiswa where prodi_id='".$prodi."' and cohort='".$cohort."' and status='".$status."'");
		$this->siak_view->data_pribadi = $this->siak_model->siak_query("select","select nim,no_ktp,agama_id,telp_rumah,kelamin_kode,tanggal_lahir,alamat_rumah,nama_depan,nama_belakang from data_pribadi_umum union select nim,no_ktp,agama_id,telp_rumah,kelamin_kode,tanggal_lahir,alamat_rumah,nama_depan,nama_belakang from data_pribadi_pns");
		$this->siak_view->keluarga = $this->siak_model->siak_data_list("keluarga","*");
		$this->siak_view->agama = $this->siak_model->siak_data_list("agama","*");
		$this->siak_view->transkrip = $this->siak_model->siak_data_list("transkrip_nilai","*");
		
		$this->siak_view->config = "Siak Unhan - Laporan Mahasiswa";
	
		$this->siak_view->judul = "Laporan Mahasiswa";
		
		$this->siak_breadcrumbs->add(array('title'=>'Laporan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Laporan Mahasiswa','href'=>''. URL . 'siak_laporan_mahasiswa'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_view->siak_render('siak_laporan_mahasiswa/detail', false);
	}

}