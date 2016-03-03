<?php

/* Siak dashboard controller class */

class Siak_grafik_juga extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		if($_GET['tahun1']){
			$tahun=$_GET['tahun1'];
		}
		else{
			$now=date('Y');
			$tahun=$now ;
		}
		
		// $this->siak_view->tahun_cohort = $this->siak_model->siak_query("select","select tahun_masuk from cohort group by tahun_masuk order by tahun_masuk asc");
		
		$this->siak_view->tahun_cohort = $this->siak_model->siak_query("select","select tahun_masuk from mahasiswa group by tahun_masuk order by tahun_masuk asc");
		
		// $this->siak_view->prodi = $this->siak_model->siak_query("select","select * from cohort where tahun_masuk='".$tahun."'");
		
		// $this->siak_view->prodi = $this->siak_model->siak_query("select","select prodi_id from mahasiswa where tahun_masuk='".$tahun."' group by prodi_id");
		
		$this->siak_view->prodi = $this->siak_model->siak_query("select","select prodi_id from prodi");
		
		$mhs_aktif = "";
		foreach($this->siak_view->prodi as $pro => $di){
			// $aktif = $this->siak_model->siak_query("select","select count(status) from mahasiswa where status='1' and prodi_id='".$di['prodi_id']."' and cohort='".$di['cohort']."'");
			
			$aktif = $this->siak_model->siak_query("select","select count(status) from mahasiswa where status='1' and prodi_id='".$di['prodi_id']."' and tahun_masuk='".$tahun."'");
			foreach($aktif as $ak => $tif){
				$x = $tif['count'];
			}
			$mhs_aktif = $mhs_aktif.$x.",";
		}
		$hps = strlen($mhs_aktif);
		$hpss = $hps - 1;
		$hasil = substr($mhs_aktif,0,$hpss);
		$this->siak_view->aktif = $hasil;
		
		$mhs_alumni = "";
		foreach($this->siak_view->prodi as $pro => $di){
			// $alumni = $this->siak_model->siak_query("select","select count(prodi_id) from alumni where prodi_id='".$di['prodi_id']."' and cohort='".$di['cohort']."' and tahun_masuk='".$tahun."'");
			
			$alumni = $this->siak_model->siak_query("select","select count(prodi_id) from alumni where prodi_id='".$di['prodi_id']."' and tahun_masuk='".$tahun."'");
			foreach($alumni as $alum => $ni){
				$z = $ni['count'];
			}
			$mhs_alumni = $mhs_alumni.$z.",";
		}
		$hpz = strlen($mhs_alumni);
		$hpzz = $hpz - 1;
		$hasiz = substr($mhs_alumni,0,$hpzz);
		$this->siak_view->alumni = $hasiz;
		
		$this->siak_view->tahun = $tahun;
		
		$this->siak_view->siak_render('siak_grafik_juga/index', false);
		
	}
}

?>