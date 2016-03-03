<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_rekap_absen_per_matakuliah extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi = $_SESSION['prodi'];
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Rekap Absensi";
	
		$this->siak_view->judul = "Rekap Absensi";
		
		$this->siak_breadcrumbs->add(array('title'=>'Laporan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Rekap Absensi','href'=>''. URL . 'siak_rekap_absen_per_matakuliah'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());

		$method_or_uri = 'siak_rekap_absen_per_matakuliah';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		
		if($_SESSION['level']==16){
			$nim=$_SESSION['username'];
			$this->siak_view->mhs = $this->siak_model->siak_query("select", "SELECT * from view_mahasiswa where nim='$nim'");
			
			$this->siak_view->siak_render('siak_rekap_absen_per_matakuliah/getData', false);
		}else{
			$this->siak_view->siak_render('siak_rekap_absen_per_matakuliah/index', false);
		}
	}
	function load_prodi(){
		$prodi_id = $this->prodi;
		if($prodi_id == NULL || $prodi_id == ''){
		      $kondisi = "";
		}else{
		      $split = explode(',', $prodi_id);

		      if(sizeof($split)>1){

			  foreach($split as $p){
			    $new[] = "'".$p."'";
			  }
			  $new = implode(',', $new);
			  $kondisi = "where prodi_id in (".$new.")";
		      }else{
			  $kondisi = "where prodi_id in ('".$prodi_id."')";
		      }

		}
		$siak_data = $this->siak_model->siak_query("select", "SELECT prodi_id,prodi from prodi $kondisi");
		$data_prodi = array();
		
		$result = array();
		
		foreach ($siak_data as $nilai => $row ){

			$data_prodi['prodi_id']=$row['prodi_id'];
			$data_prodi['prodi']=$row['prodi'];
			array_push($result,$data_prodi);

		}
		
		
		print json_encode($result);
	}
	function detail($prodi,$nim,$matkul,$cohort){
                $this->siak_view->prodi = $prodi;
                $this->siak_view->matkul = $matkul;
                $this->siak_view->cohort = $cohort;
                $this->siak_view->nim = $nim;
		$this->siak_view->matkuls=$this->siak_model->siak_query("select", "SELECT *from matakuliah where kode_matkul='$matkul'");
		$this->siak_view->detail = $this->siak_model->siak_query("select", "SELECT *from view_jadwal_kuliah_notopik where kode_matkul='$matkul' and cohort='$cohort' order by pertemuanke asc");
		$this->siak_view->absen = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND cohort='$cohort' AND kode_matkul='$matkul' AND nim='$nim' ");
		$this->siak_view->siak_render('siak_rekap_absen_per_matakuliah/detail', true);
	}
	
	function getCohort($prodi){
		$this->siak_view->cohort = $this->siak_model->siak_query("select", "SELECT * FROM cohort WHERE prodi_id='$prodi'");
		$this->siak_view->siak_render('siak_rekap_absen_per_matakuliah/getCohort', true);
	}
	
	function getReport($prodi,$cohort,$semes,$matkul){
		$this->siak_view->prodi    = $prodi;
		$this->siak_view->semester = $semes;
		$this->siak_view->matkul   = $matkul;
		$this->siak_view->cohort   = $cohort;
		
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE
		prodi_id='$prodi' AND cohort='$cohort' ");
		
		$this->siak_view->data_alpa = $this->siak_model->siak_query("select", "SELECT nim,kode_matkul, count(nim) as jumlah FROM
		absensi WHERE prodi_id='$prodi' AND cohort='$cohort' AND kode_matkul='$matkul' AND status='2' group by nim,kode_matkul
		order by nim asc ");
		
		$this->siak_view->data_hadir = $this->siak_model->siak_query("select", "SELECT nim,kode_matkul, count(nim) as jumlah FROM
		absensi WHERE prodi_id='$prodi' AND cohort='$cohort' AND kode_matkul='$matkul' AND status='1' group by nim,kode_matkul
		order by nim asc ");
		
		$this->siak_view->detail = $this->siak_model->siak_query("select", "SELECT *from view_jadwal_kuliah_notopik where
		kode_matkul='$matkul' and cohort='$cohort' order by pertemuanke asc");
		
		$this->siak_view->p1 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='1'");
// 		var_dump($this->siak_view->p1);
		
		$this->siak_view->p2 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='2'");
		
		$this->siak_view->p3 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='3'");
		
		$this->siak_view->p4 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='4'");
		
		$this->siak_view->p5 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='5'");
		
		$this->siak_view->p6 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='6'");
		
		$this->siak_view->p7 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='7'");
		
		$this->siak_view->p8 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='8'");
		
		$this->siak_view->p9 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='9'");
		
		$this->siak_view->p10 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='10'");
		
		$this->siak_view->p11 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='11'");
		
		$this->siak_view->p12 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='12'");
		
		$this->siak_view->p13 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='13'");
		
		$this->siak_view->p14 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='14'");
		
		$this->siak_view->p15 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='15'");
		
		$this->siak_view->p16 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND
		cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='16'");
		
// 		echo "SELECT * FROM absensi WHERE prodi_id='$prodi' AND	cohort='$cohort' AND kode_matkul='$matkul' and pertemuanke='1'";
// 		echo "SELECT * from view_jadwal_kuliah_notopik where kode_matkul='$matkul' and cohort='$cohort' order by pertemuanke asc";
// 		echo "<pre>";
// 		var_dump($this->siak_view->p10);
// 		echo "</pre>";
// 		die();
		$this->siak_view->siak_render('siak_rekap_absen_per_matakuliah/report_absen_mhsc', true);
	}
	
	function getDetail($prodi,$semester,$nim,$matkul,$cohort){
		$this->siak_view->matkul=$this->siak_model->siak_query("select", "SELECT *from matakuliah where kode_matkul='$matkul'");
		$this->siak_view->mhs = $this->siak_model->siak_query("select", "SELECT *from view_mahasiswa where nim='$nim'");
		$this->siak_view->prodi = $this->siak_model->siak_query("select","select a.prodi from prodi a,mahasiswa b where a.prodi_id=b.prodi_id and b.nim='$nim'");
		$this->siak_view->detail = $this->siak_model->siak_query("select", "SELECT *from view_jadwal_kuliah where kode_matkul='$matkul' and cohort='$cohort' order by pertemuanke asc");
		$this->siak_view->absen = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND cohort='$cohort' AND kode_matkul='$matkul' AND nim='$nim' ");
		$this->siak_view->siak_render('siak_rekap_absen_per_matakuliah/getDetail', true);
	}
	
	public function pdf(){
		$this->siak_view->prodi = $_POST['prodi_id'];
		$this->siak_view->cohort = $_POST['cohort'];
		$this->siak_view->kd_matkul = $_POST['kd_matkul'];
		
		$this->siak_view->matkul = $this->siak_model->siak_query("select","select * from matakuliah where
		kode_matkul='$_POST[kd_matkul]'");
		
		foreach($this->siak_view->matkul as $a => $b){
			$this->siak_view->nm_matkul = $b['nama_matkul'];
		}
		
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select","select * from view_mahasiswa where
		prodi_id='$_POST[prodi_id]' and cohort='$_POST[cohort]'");
		
		$this->siak_view->detail = $this->siak_model->siak_query("select", "SELECT *from view_jadwal_kuliah where
		kode_matkul='$_POST[kd_matkul]' and cohort='$_POST[cohort]' order by pertemuanke asc");
		
		$this->siak_view->p1 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='1'");
		
		$this->siak_view->p2 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='2'");
		
		$this->siak_view->p3 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='3'");
		
		$this->siak_view->p4 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='4'");
		
		$this->siak_view->p5 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='5'");
		
		$this->siak_view->p6 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='6'");
		
		$this->siak_view->p7 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='7'");
		
		$this->siak_view->p8 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='8'");
		
		$this->siak_view->p9 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='9'");
		
		$this->siak_view->p10 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='10'");
		
		$this->siak_view->p11 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='11'");
		
		$this->siak_view->p12 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='12'");
		
		$this->siak_view->p13 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='13'");
		
		$this->siak_view->p14 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='14'");
		
		$this->siak_view->p15 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='15'");
		
		$this->siak_view->p16 = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$_POST[prodi_id]'
		AND cohort='$_POST[cohort]' AND kode_matkul='$_POST[kd_matkul]' and pertemuanke='16'");
		
        $this->siak_view->siak_render('siak_rekap_absen_per_matakuliah/pdf', true);
        
    }
}

?>