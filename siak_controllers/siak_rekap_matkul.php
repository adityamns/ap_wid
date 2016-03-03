<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_rekap_matkul extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Rekap Matakuliah";
	
		$this->siak_view->judul = "Rekap Matakuliah";
		
		$this->siak_breadcrumbs->add(array('title'=>'Laporan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Rekap Matakuliah','href'=>''. URL . 'siak_rekap_matkul'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		/* foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "omerta" && $value['kode'] == "rekap_matkul") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		} */
		$method_or_uri = 'siak_rekap_matkul';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->semester = $this->siak_model->siak_query("select","select semester from matakuliah group by semester
		order by semester");
		$this->siak_view->siak_render('siak_rekap_matkul/index', false);
	}
	
	function getbobot($prodi_id,$semester){
		$this->siak_view->prodi = $prodi_id;
		$this->siak_view->semester = $semester;
		$this->siak_view->data = $this->siak_model->siak_query("select", "select a.*,b.prodi from matakuliah a,prodi b where
		a.prodi_id='$prodi_id' and a.semester='$semester' and a.prodi_id=b.prodi_id");
		$this->siak_view->siak_render('siak_rekap_matkul/tabel', true);
	}
	
	public function pdf(){
		$this->siak_view->prodi = $_POST['prodi_id'];
		$this->siak_view->nm_prodi = $_POST['prodi'];
		$this->siak_view->semester = $_POST['semester'];
		$this->siak_view->data = $this->siak_model->siak_query("select","select * from matakuliah where
		prodi_id='$_POST[prodi_id]' and semester='$_POST[semester]'");
		$this->siak_view->jml_sks = $this->siak_model->siak_query("select","select sum(sks) as jumlah_sks from matakuliah where
		prodi_id='$_POST[prodi_id]' and semester='$_POST[semester]'");
        $this->siak_view->siak_render('siak_rekap_matkul/pdf', true);
        
    }
	
	function getDetail($kd_matkul,$nm,$singkatan,$en,$sks,$pertemuan,$pj,$prodi,$nm_prodi,$semester){
		$decode_kd_matkul = base64_decode($kd_matkul);
		$decode_nm = base64_decode($nm);
		$decode_singkatan = base64_decode($singkatan);
		$decode_en = base64_decode($en);
		$decode_sks = base64_decode($sks);
		$decode_pertemuan = base64_decode($pertemuan);
		$decode_pj = base64_decode($pj);
		$decode_prodi = base64_decode($prodi);
		$decode_nm_prodi = base64_decode($nm_prodi);
		$decode_semester = base64_decode($semester);
		
		$this->siak_view->kd_matkul = $decode_kd_matkul;
		$this->siak_view->nm = $decode_nm;
		$this->siak_view->singkatan = $decode_singkatan;
		$this->siak_view->en = $decode_en;
		$this->siak_view->sks = $decode_sks;
		$this->siak_view->pertemuan = $decode_pertemuan;
		$this->siak_view->pj = $decode_pj;
		$this->siak_view->prodi = $decode_prodi;
		$this->siak_view->nm_prodi = $decode_nm_prodi;
		$this->siak_view->semester = $decode_semester;
		$this->siak_view->matkul=$this->siak_model->siak_query("select", "SELECT * from matakuliah where kode_matkul='$matkul'");
		$this->siak_view->siak_render('siak_rekap_matkul/pdf_per_matkul', true);
	}
}

?>