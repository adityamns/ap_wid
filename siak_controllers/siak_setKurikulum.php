<?php

/* Siak setKurikulum controller class */

class Siak_setKurikulum extends Siak_controller{
	
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
		$where = array('status' => 1);
		$this->siak_view->kurikulum = $this->siak_model->siak_edit($where, "kurikulum", "*");
		$this->siak_view->mahasiswa = $this->siak_model->siak_query("select", "SELECT b.prodi, COUNT(a.nim) as jml_mhs, b.prodi_id, a.cohort, a.kurikulum_id FROM mahasiswa a, prodi b WHERE a.prodi_id = b.prodi_id GROUP BY a.prodi_id, a.cohort ORDER BY a.cohort ASC;");
		$this->siak_view->siak_render('siak_setKurikulum/index', false);
	}

	public function siak_set($prodi_id, $cohort){
		$where = array('status' => 1);
		$this->siak_view->kurikulum = $this->siak_model->siak_edit($where, "kurikulum", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT b.prodi, COUNT(a.nim) as jml_mhs, b.prodi_id, a.cohort, a.kurikulum_id FROM mahasiswa a, prodi b WHERE a.prodi_id = b.prodi_id AND a.prodi_id = '".$prodi_id."' AND cohort = ".$cohort."; ");
		$this->siak_view->siak_render('siak_setKurikulum/set', true);
	}

	public function siak_set_save($prodi_id, $cohort){
		$this->siak_view->siak_data = $this->siak_model->siak_query("update", "UPDATE mahasiswa set kurikulum_id = '".$_POST['kurikulum_id']."' WHERE prodi_id = '".$prodi_id."' AND cohort = ".$cohort."; ");
		header('location: ' . URL . 'siak_setKurikulum/');
	}

	public function siak_mahasiswa($prodi_id, $cohort){
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.*, b.nama_depan, b.nama_belakang, b.telp_rumah, b.handphone, b.alamat_rumah, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' AND cohort = ".$cohort." UNION SELECT a.*, b.nama_depan, b.nama_belakang, b.telp_rumah, b.handphone, b.alamat_rumah, c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' AND cohort = ".$cohort."");
		$this->siak_view->siak_render('siak_mahasiswa/data', false);
	}

}

?>