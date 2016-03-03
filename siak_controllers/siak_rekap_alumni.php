<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_rekap_alumni extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		/* foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "omerta" && $value['kode'] == "rekap_alumni") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		} */
		$method_or_uri = 'siak_rekap_alumni';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->siak_render('siak_rekap_alumni/index', false);
	}
	
	public function prodi($prodi_id){
		$where = array('prodi_id' => $prodi_id);
		$this->siak_view->data_cohort = $this->siak_model->siak_edit($where,"cohort", "*");
		$this->siak_view->siak_render('siak_rekap_alumni/cohort', true);
	}
	
	function getbobot($prodi_id,$cohort_id){
		$this->siak_view->prodi    = $prodi_id;
		$this->siak_view->cohort     = $cohort_id;
		$this->siak_view->laporan = $this->siak_model->siak_query("select", "select a.nama_depan,a.nama_belakang,b.*,c.prodi from
		data_pribadi_umum a,alumni b,prodi c where a.nim=b.nim and b.prodi_id='$prodi_id' and b.cohort='$cohort_id' and
		b.prodi_id=c.prodi_id");
		$this->siak_view->siak_render('siak_rekap_alumni/tabel', true);
	}
	
	public function pdf(){
		$this->siak_view->prodi = $_POST['prodi_id'];
		$this->siak_view->nm_prodi = $_POST['prodi'];
		$this->siak_view->cohort = $_POST['cohort'];
		$this->siak_view->data = $this->siak_model->siak_query("select","select a.nama_depan,a.nama_belakang,b.* from
		data_pribadi_umum a,alumni b where a.nim=b.nim and b.prodi_id='$_POST[prodi_id]' and b.cohort='$_POST[cohort]'");
        $this->siak_view->siak_render('siak_rekap_alumni/pdf', true);
        
    }
	
	/*public function cohort($prodi_id){
		$where = array('prodi_id' => $prodi_id);
		$this->siak_view->data_cohort = $this->siak_model->siak_edit($where, "cohort", "*");
		$this->siak_view->siak_render('siak_rekap_mahasiswa/c', true);
	}*/
}

?>