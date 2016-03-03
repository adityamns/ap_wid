<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Siak_home extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}
	
	function index(){
		date_default_timezone_set('Asia/Jakarta');
		
		$this->siak_view->config = "Siak Widyatama - Beranda";
		$this->siak_view->judul = "Beranda";
		$this->siak_breadcrumbs->add(array('title'=>'','href'=>'#'));
		
		$this->siak_view->classroom = $this->siak_model->siak_query("select", "select * from ruang order by ruang_id asc");
		
		$this->siak_view->jml_classroom = count($this->siak_view->classroom);
		
		// SCHEDULE
		
		if($_GET['tgl']){
				$tahun=$_GET['tgl'];
				$x_tgl = explode("-",$_GET['tgl']);
				$this->siak_view->tanggal_fix = $x_tgl[1];
				$this->siak_view->bulan_fix = $x_tgl[2];
				$this->siak_view->tahun_fix = $x_tgl[0];
				$this->siak_view->get_fix = "1";
			}
			else{
				$now=date('Y');
				$tahun=$now ;
				$this->siak_view->tanggal_fix = date("d");
				$this->siak_view->bulan_fix = date("m");
				$this->siak_view->tahun_fix = date("Y");
				$this->siak_view->get_fix = "0";
			}
			
		$this->siak_view->siak_fakultas = $this->siak_model->siak_query("select", "select count(*) as jumlah,tahun_masuk, fakultas.fakultas,fakultas.fakultas_kd from mahasiswa left join prodi on prodi.prodi_id=mahasiswa.prodi_id left join fakultas on fakultas.fakultas_id=prodi.fakultas_id where status=1 and tahun_masuk=$tahun group by tahun_masuk,fakultas,fakultas.fakultas_kd");
		$this->siak_view->siak_tahun = $this->siak_model->siak_query("select", "select tahun_masuk from mahasiswa where status=1 group by tahun_masuk order by tahun_masuk asc");
		$this->siak_view->siak_prodi = $this->siak_model->siak_query("select", "select count(*) as jumlah,tahun_masuk,prodi.prodi_id, fakultas.fakultas,fakultas.fakultas_kd from mahasiswa left join prodi on prodi.prodi_id=mahasiswa.prodi_id left join fakultas on fakultas.fakultas_id=prodi.fakultas_id where status=1 and tahun_masuk=$tahun group by tahun_masuk,fakultas,fakultas.fakultas_kd,prodi.prodi_id");
		$this->siak_view->jtahun=$tahun;
		
		$this->siak_view->siak_jadwal = $this->siak_model->siak_query("select", "SELECT nama,prodi,pertemuanke,nama_ruang,singkatan,prodi_id,kode_matkul,nama_matkul,semester, to_char(mulai,'HH24:MI') AS waktu_mulai,to_char(akhir,'HH24:MI') AS waktu_akhir,to_char(mulai,'YYYY-MM-DD') AS waktu,to_char(mulai,'DD') AS hari FROM view_jadwal_kuliah_notopik ORDER BY mulai desc ");
		
		//
		
		$this->siak_view->siak_render('siak_home/index', false);
	}
	
	function cekClassroom(){
		$r = array(array("kelas"=>"satu","ruang"=>"A"));
		
		date_default_timezone_set('Asia/Jakarta');
		
		$h = date("h") + 12;
		
		//echo date($h.":i:s:a");die();
		
		$x = explode(" ","2016-02-09 13:00:00");
		
		//echo $x[1];die();
		
		//echo date("Y-m-d");die();
		
		//echo strtotime("02:59:00") - strtotime(date("h:i:s"));
		
		//echo " * ".strtotime(date("h:i:s"));die();
		
		//echo strtotime("2016-02-22") - strtotime(date("Y-m-d"));die();
		
		//echo strtotime(date("Y-m-d"))." * ".strtotime("2016-02-25");die();
		
		if(date("a") == "pm"){
			//echo date("h") + 12;die();
			$jam_fix = date("h") + 12;
			$jam_now = $jam_fix.":".date("i").":".date("s");
		}else{
			//echo date("h");die();
			$jam_now = date("h").":".date("i").":".date("s");
		}
		
		//echo $jam_now;die();
		
		//echo strtotime($jam_now) - strtotime("16:00:00");die();
		
		$ruang = $this->siak_model->siak_query("select","select * from ruang order by ruang_id asc");
		
		$jml_ruang = count($ruang);
		
		$arrPush = array();
		$arrRuang = array();
		foreach($ruang as $dataRuang){
			$jadwal = $this->siak_model->siak_query("select","select mulai,akhir from jadwal_kuliah where ruang_id='".$dataRuang['ruang_id']."'");
			
			$jml_yellow = 0;
			$jml_blue = 0;
			foreach($jadwal as $dataJadwal){
				$x_mulai = explode(" ",$dataJadwal['mulai']);
				$x_akhir = explode(" ",$dataJadwal['akhir']);
				
				if((strtotime($x_mulai[0]) <= strtotime(date("Y-m-d"))) and (strtotime($x_mulai[1]) <= strtotime($jam_now)) and (strtotime($x_akhir[0]) >= strtotime(date("Y-m-d"))) and (strtotime($x_akhir[1]) >= strtotime($jam_now))){
					$jml_yellow++;
				}else if((strtotime($x_mulai[0]) <= strtotime(date("Y-m-d"))) and (strtotime($x_akhir[0]) >= strtotime(date("Y-m-d")))){
					$jml_blue++;
				}
			}
			if($jml_yellow != 0){
				array_push($arrPush,"yellow");
			}else if($jml_blue != 0){
				array_push($arrPush,"blue");
			}else{
				array_push($arrPush,"black");
			}
			
			array_push($arrRuang,$dataRuang['nama_ruang']);
		}
		
		//echo var_dump($arrPush);die();
		
		echo json_encode(array("cek"=>$arrPush,"nama_ruang"=>$arrRuang,"jml_ruang"=>$jml_ruang));
	}
	
}

?>