<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak rencana_studi controller class */

class Siak_pencarian extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		//$this->prodi = Siak_session::siak_get('prodi');
		
	}
	function index(){
		$this->siak_view->siak_render('siak_pencarian/index');
	}
	
	function MSMHS(){
		$nim=$_POST['nim'];
		$prodi=$_POST['prodi'];
		$cohort=$_POST['tahun'];
		$this->siak_view->nim=$nim;
		$this->siak_view->prodi=$prodi;
		$this->siak_view->cohort=$cohort;
		$query="Select *from view_mahasiswa where  status=1"
					. ($nim ? "AND nim = '$nim' " :"")
					. ($prodi ? "AND prodi_id = '$prodi' " :"")
					. ($cohort ? "AND cohort = $cohort " :"")
				." order by nim asc
			";
			//echo $query;
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", $query);
		$this->siak_view->siak_render('siak_pencarian/data_mahasiswa',true);
		
	}
	
	function MSHS_EXCEL($nim,$prodi,$cohort){
		$this->siak_view->isi_table=implode(',',$_POST['isi_table']);
		$this->siak_view->header_table=implode(',',$_POST['header']);
		$query="Select *from view_mahasiswa where  status=1"
					. ($nim ? "AND nim = '$nim' " :"")
					. ($prodi ? "AND prodi_id = '$prodi' " :"")
					. ($cohort ? "AND cohort = $cohort " :"")
				." order by nim asc
			";
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", $query);
		die();
		//$this->siak_view->siak_render('siak_pencarian/excel_mshs',true);
	}
	
	function export($nim,$prodi,$cohort){
		$this->siak_view->isi_table=implode(',',$_POST['isi_table']);
		$this->siak_view->header_table=implode(',',$_POST['header']);
		
		foreach($_POST['dbfHead'] as $k => $d){
			$dbf[] = explode(',',$_POST['dbfHead'][$k]);
			$c = count($dbf[$k]);
			$db[] = (int)$dbf[$k][($c-1)];
			
		}
		
		echo "<pre>";
		var_dump($db);
		var_dump($dbf);
		echo "</pre>";
		die();
		
		$this->siak_view->dbfHead = $dbf;
		
		$query="Select *from view_mahasiswa where  status=1"
					. ($nim ? "AND nim = '$nim' " :"")
					. ($prodi ? "AND prodi_id = '$prodi' " :"")
					. ($cohort ? "AND cohort = $cohort " :"")
				." order by nim asc
			";
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", $query);
		
		
		$this->siak_view->siak_render("siak_pencarian/dbf_MSHS", true);
// 		die();
		//$this->siak_view->siak_render('siak_pencarian/excel_mshs',true);
	}
	
	function form_search($jenis){
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
				if($jenis=='mahasiswa'){
					$this->siak_view->siak_render('siak_pencarian/form_mahasiswa',true);
				}
				else{
					$this->siak_view->siak_render('siak_pencarian/form_dosen',true);
				}
	}
	function TRNLM(){
		$nim=$_POST['nim'];
		$prodi=$_POST['prodi'];
		$cohort=$_POST['tahun'];
		$semes=$_POST['semes'];
		$query="select a.nim,a.nama_depan,a.nama_belakang, b.prodi_id, b.matkul_id, b.grade, b.semester from view_mahasiswa a, nilai_mahasiswa b 
				where a.nim=b.nim "
					. ($nim ? "AND a.nim = '$nim' " :"")
					. ($prodi ? "AND b.prodi_id = '$prodi' " :"")
					. ($cohort ? "AND a.cohort = $cohort " :"")
					. ($semes ? "AND semes = $semes " :"")
				."
				order by b.matkul_id asc";
				//echo $query;
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", $query);
		$this->siak_view->siak_render('siak_pencarian/TRNLM',true);
	}
	function TRAKM(){
		$nama=$_POST['nama'];
		$nim=$_POST['nim'];
		$prodi=$_POST['prodi'];
		$cohort=$_POST['tahun'];
		$semes=$_POST['semes'];
		$query="select a.nim,b.nama_depan,b.nama_belakang,b.cohort,a.prodi_id,a.semester,sum(a.sks) as SKS_SEMESTER,sum(a.nilai) as IPS, (sum(a.nilai)/sum(a.sks)) as ips from view_nilai_permatakuliah a,view_mahasiswa b where a.nim=b.nim "
					. ($nim ? "AND a.nim = '$nim' " :"")
					. ($prodi ? "AND a.prodi_id = '$prodi' " :"")
					. ($cohort ? "AND b.cohort = $cohort " :"")
					. ($semes ? "AND semes = $semes " :"")
				."
		group by a.nim,b.nama_depan,b.nama_belakang,b.cohort,a.prodi_id,a.semester order by a.nim";
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", $query);
		
		$this->siak_view->nama = $nama;
		$this->siak_view->nim = $nim;
		$this->siak_view->prodi = $prodi;
		$this->siak_view->coh = $cohort;
		$this->siak_view->smes = $semes;
		
		$this->siak_view->siak_render('siak_pencarian/TRAKM',true);
	}
	
	function MSDOS(){
		$nip=$_POST['nip'];
		$prodi=$_POST['prodi'];
		$cohort=$_POST['tahun'];
		
		$query="Select *from dosen order by nip asc";
			//echo $query;
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", $query);
		$this->siak_view->siak_render('siak_pencarian/MSDOS',true);
		
	}
	function coba(){
		$this->siak_view->siak_render('siak_pencarian/coba',true);
	}
	
	function unduh(){
		
		$nim=$_POST['nimDbf'];
		$prodi=$_POST['prodiDbf'];
		$cohort=$_POST['cohDbf'];
		$nama=$_POST['namaDbf'];
		$semes=$_POST['smesDbf'];

		$sql = "SELECT 
				a.nim,
				b.nama_depan,
				b.nama_belakang,
				b.cohort,
				a.prodi_id,
				a.semester,
				sum(a.sks) as totsks,
				sum(a.nilai) as totips, 
				(sum(a.nilai)/sum(a.sks)) as ips 
			FROM 
				view_nilai_permatakuliah a,
				view_mahasiswa b 
			WHERE 
				a.nim=b.nim 
				"
					. ($nim ? "AND a.nim = '$nim' " :"")
					. ($prodi ? "AND a.prodi_id = '$prodi' " :"")
					. ($cohort ? "AND b.cohort = $cohort " :"")
					. ($semes ? "AND semes = $semes " :"")
				."
			GROUP BY 
				a.nim,
				b.nama_depan,
				b.nama_belakang,
				b.cohort,
				a.prodi_id,
				a.semester 
			ORDER BY 
				a.nim";
// 		echo $sql;
// 		die();
		$this->siak_view->data =$this->siak_model->siak_query("select", $sql);

		$this->siak_view->siak_render('siak_pencarian/unduh',true);
	
	}
	
	
	
}
?>