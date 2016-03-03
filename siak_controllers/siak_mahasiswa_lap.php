<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_mahasiswa_lap extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		/* foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "mahasiswa_laporan") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		} */
		$method_or_uri = 'siak_mahasiswa_lap';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		
		$this->siak_view->prodi = $this->siak_model->siak_query("select", "select * from prodi order by prodi_id");
		$this->siak_view->data = $this->siak_model->siak_query("select", "select prodi_id,cohort,status,count(nim) as jumlah from
		absensi where status='1' group by prodi_id,cohort,status");
		$this->siak_view->siak_render('siak_mahasiswa_lap/index', false);
	}
	
	public function status(){
		$this->siak_view->tahun = $this->siak_model->siak_query("select","select tahun_masuk from mahasiswa group by tahun_masuk
		order by tahun_masuk");
		$this->siak_view->siak_render('siak_mahasiswa_lap/tahun', true);
	}
	
	public function prodi($prodi_id){
		$where = array('prodi_id' => $prodi_id);
		$this->siak_view->data_cohort = $this->siak_model->siak_edit($where,"cohort", "*");
		$this->siak_view->siak_render('siak_rekap_mahasiswa/cohort', true);
	}
	
	function getbobot($status,$tahun){
		$this->siak_view->prodi = $this->siak_model->siak_query("select", "select * from prodi order by prodi_id");
		$this->siak_view->data = $this->siak_model->siak_query("select", "select prodi_id,cohort,status,tahun_masuk,count(nim) as
		jumlah from mahasiswa where status='$status' and tahun_masuk='$tahun' group by prodi_id,cohort,status,
		tahun_masuk");
		$this->siak_view->siak_render('siak_mahasiswa_lap/status', true);
	}
	
	public function pdf(){
		$this->siak_view->status = $_POST['status'] == 1?"AKTIF":"TIDAK AKTIF";
		$this->siak_view->tahun = $_POST['tahun'];
		$this->siak_view->prodi = $this->siak_model->siak_query("select", "select * from prodi order by prodi_id");
		$this->siak_view->data = $this->siak_model->siak_query("select", "select prodi_id,cohort,status,tahun_masuk,count(nim) as
		jumlah from mahasiswa where status='$_POST[status]' and tahun_masuk='$_POST[tahun]' group by prodi_id,cohort,status,
		tahun_masuk");
        $this->siak_view->siak_render('siak_mahasiswa_lap/pdf', true);
        
    }
	
	/*public function cohort($prodi_id){
		$where = array('prodi_id' => $prodi_id);
		$this->siak_view->data_cohort = $this->siak_model->siak_edit($where, "cohort", "*");
		$this->siak_view->siak_render('siak_rekap_mahasiswa/c', true);
	}*/
}

?>