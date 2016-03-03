<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_rekap_nilai extends Siak_controller{

    function __construct(){
        parent::__construct();
        parent::siak_logstat();
        $this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
    }

    function index(){
        $this->siak_rekap_nilai();
    }
	
	function siak_rekap_nilai(){
        // foreach ($this->siak_session->siak_getAll() as $key => $value) {
            // if ($value['groups'] == "nilai" && $value['kode'] == "nilai_mahasiswa") {
                // $this->siak_view->loads = $value['loads'];
                // $this->siak_view->creates = $value['creates'];
                // $this->siak_view->reades  = $value['reades'];
                // $this->siak_view->updates = $value['updates'];
                // $this->siak_view->deletes = $value['deletes'];
            // }
        // }
		$method_or_uri = 'siak_rekap_nilai';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		
        $this->siak_view->siak_render('siak_rekap_nilai/index', false);
    }	    
	
	function getRekap($tahun,$fakultas,$prodi,$cohort,$semester,$matkul,$dosen,$nilai){
        $this->siak_view->tahun = $tahun;
        $this->siak_view->fakultas = $fakultas;
        $this->siak_view->prodi    = $prodi;
        $this->siak_view->cohort   = $cohort;
        $this->siak_view->semester = $semester;
        $this->siak_view->matkul   = $matkul;				
		$this->siak_view->dosen    = $dosen;				
		$this->siak_view->nilai    = $nilai;				
		
		$this->siak_view->nama_fak = $this->siak_model->siak_getfield("fakultas", "fakultas", "fakultas_id = '".$fakultas."'");
		$this->siak_view->nama_prodi = $this->siak_model->siak_getfield("prodi", "prodi", "prodi_id = '".$prodi."'");
						
		if(($nilai != "0") and ($dosen == "0") and ($matkul == "0")){
			// $sql = "select a.prodi_id, a.tahun_masuk, a.cohort, a.semester, a.nim, b.nama_depan, b.nama_belakang, c.grade from mahasiswa a
					// inner join data_pribadi_umum b on (a.nim = b.nim) 
					// inner join nilai_mahasiswa c on (a.nim = b.nim)					
					// where a.prodi_id = '".$prodi."' and tahun_masuk = '".$tahun."' and cohort = '".$cohort."' and a.semester = '".$semester."' and grade = '".$nilai."' order by nim";
			$sql = "select * from nilai_mahasiswa
					where prodi_id = '".$prodi."' and semester = '".$semester."' and grade = '".$nilai."' order by nim";
			$this->siak_view->data_nilai = $this->siak_model->siak_query("select", $sql);
			$this->siak_view->siak_render('siak_rekap_nilai/per_nilai', true);     
			exit;
		}
		
		if(($nilai == "0") and ($dosen == "0") and ($matkul != "0")){
			$this->siak_view->nama_matkul = $this->siak_model->siak_getfield("nama_matkul", "matakuliah", "kode_matkul = '".$matkul."'");
			$this->siak_view->data_komponen = $this->siak_model->siak_query("select", "SELECT *, komponen.id as id_komponen, komponen.persentase FROM komponen LEFT JOIN bobot ON bobot.id=komponen.id_bobot where prodi_id='".$prodi."' AND tahun_id='".$tahun."' AND matkul_id='".$matkul."' AND semester='".$semester."'");
			
			$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='".$prodi."' AND tahun_masuk='".$tahun."' AND semester='".$semester."'");						
			$this->siak_view->siak_render('siak_rekap_nilai/per_mk', true);     
			exit;
		}
		
		$this->siak_view->nama_matkul = $this->siak_model->siak_getfield("nama_matkul", "matakuliah", "kode_matkul = '".$matkul."'");			
		
		if($matkul == "0") $where_matkul = ""; else $where_matkul = "and a.matkul_id = '".$matkul."'";
		if($dosen == "0") $where_dosen = ""; else $where_dosen = "and b.dosen_utama like '%".$dosen."%'";
		if($nilai == "0") $where_nilai = ""; else $where_nilai = "and a.grade = '".$nilai."'";				
		$sql = "select a.nim, a.grade, b.dosen_utama, a.matkul_id from nilai_mahasiswa a
				inner join dosen_matakuliah b on (a.matkul_id = b.kode_matkul )
				where a.prodi_id = '".$prodi."' ".$where_matkul." and semester = '".$semester."' ".$where_nilai." ".$where_dosen." order by nim";
		// echo $sql;exit;
		$this->siak_view->data_nilai = $this->siak_model->siak_query("select", $sql);
			
		// $this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='".$prodi."' AND tahun_masuk='".$tahun."' AND semester='".$semester."'");	
		$this->siak_view->siak_render('siak_rekap_nilai/nilai_all', true);      
    }  
	
	function print_nilai_permk(){        		
		$this->siak_view->tahun 	= $_POST['tahun'];
        $this->siak_view->fakultas = $_POST['fakultas'];
        $this->siak_view->prodi    = $_POST['prodi'];
        $this->siak_view->cohort   = $_POST['cohort'];
        $this->siak_view->semester = $_POST['semester'];
        $this->siak_view->matkul   = $_POST['matkul'];						
		
		$this->siak_view->nama_fak = $this->siak_model->siak_getfield("fakultas", "fakultas", "fakultas_id = '".$this->siak_view->fakultas."'");
		$this->siak_view->nama_prodi = $this->siak_model->siak_getfield("prodi", "prodi", "prodi_id = '".$this->siak_view->prodi."'");		
		
		$this->siak_view->nama_matkul = $this->siak_model->siak_getfield("nama_matkul", "matakuliah", "kode_matkul = '".$this->siak_view->matkul."'");
		$this->siak_view->data_komponen = $this->siak_model->siak_query("select", "SELECT *, komponen.id as id_komponen, komponen.persentase FROM komponen LEFT JOIN bobot ON bobot.id=komponen.id_bobot where prodi_id='".$this->siak_view->prodi."' AND tahun_id='".$this->siak_view->tahun."' AND matkul_id='".$this->siak_view->matkul."' AND semester='".$this->siak_view->semester."'");
			
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='".$this->siak_view->prodi."' AND tahun_masuk='".$this->siak_view->tahun."' AND semester='".$this->siak_view->semester."'");						
		$this->siak_view->siak_render('siak_rekap_nilai/print_per_mk', true);        		
    } 
	
	function print_nilai_pernilai(){    
		$this->siak_view->fakultas = $_POST['fakultas'];
        $this->siak_view->prodi    = $_POST['prodi'];
        $this->siak_view->semester = $_POST['semester'];
        $this->siak_view->nilai   = $_POST['nilai'];		
		
		$this->siak_view->nama_fak = $this->siak_model->siak_getfield("fakultas", "fakultas", "fakultas_id = '".$this->siak_view->fakultas."'");
		$this->siak_view->nama_prodi = $this->siak_model->siak_getfield("prodi", "prodi", "prodi_id = '".$this->siak_view->prodi."'");
		
		$sql = "select * from nilai_mahasiswa
					where prodi_id = '".$this->siak_view->prodi."' and semester = '".$this->siak_view->semester."' and grade = '".$this->siak_view->nilai."' order by nim";
		$this->siak_view->data_nilai = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render('siak_rekap_nilai/print_per_nilai', true); 
	}
	
	function print_nilai_all(){    						
		$this->siak_view->tahun 	= $_POST['tahun'];
        $this->siak_view->fakultas = $_POST['fakultas'];
        $this->siak_view->prodi    = $_POST['prodi'];
        $this->siak_view->cohort   = $_POST['cohort'];
        $this->siak_view->semester = $_POST['semester'];
        $this->siak_view->matkul   = $_POST['matkul'];				
		$this->siak_view->dosen    = $_POST['dosen'];				
		$this->siak_view->nilai    = $_POST['nilai'];
		$this->siak_view->nama_fak = $this->siak_model->siak_getfield("fakultas", "fakultas", "fakultas_id = '".$this->siak_view->fakultas."'");
		$this->siak_view->nama_prodi = $this->siak_model->siak_getfield("prodi", "prodi", "prodi_id = '".$this->siak_view->prodi."'");		
		$this->siak_view->nama_matkul = $this->siak_model->siak_getfield("nama_matkul", "matakuliah", "kode_matkul = '".$this->siak_view->matkul."'");					
		if($this->siak_view->matkul == "0") $where_matkul = ""; else $where_matkul = "and a.matkul_id = '".$this->siak_view->matkul."'";
		if($this->siak_view->dosen == "0") $where_dosen = ""; else $where_dosen = "and b.dosen_utama like '%".$this->siak_view->dosen."%'";
		if($this->siak_view->nilai == "0") $where_nilai = ""; else $where_nilai = "and a.grade = '".$this->siak_view->nilai."'";				
		$sql = "select a.nim, a.grade, b.dosen_utama, a.matkul_id from nilai_mahasiswa a
				inner join dosen_matakuliah b on (a.matkul_id = b.kode_matkul )
				where a.prodi_id = '".$this->siak_view->prodi."' ".$where_matkul." and semester = '".$this->siak_view->semester."' ".$where_nilai." ".$where_dosen." order by nim";
		// echo $sql;exit;
		$this->siak_view->data_nilai = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render('siak_rekap_nilai/print_nilai_all', true); 
	}
	
	function load_fakultas(){
		$siak_data = $this->siak_model->siak_query("select", "SELECT fakultas_id,fakultas from fakultas");
		$data_fak = array();
		$result = array();		
		foreach ($siak_data as $nilai => $row ){			
			$data_fak['fakultas_id']=$row['fakultas_id'];
			$data_fak['fakultas']=$row['fakultas'];						
			array_push($result,$data_fak);
		}		
       print json_encode($result);
		
	}
	
	function load_prodi($fakultas){
        $this->siak_view->data_prodi = $this->siak_model->siak_query("select", "SELECT * from prodi where fakultas_id='".$fakultas."'");
        $this->siak_view->siak_render('siak_rekap_nilai/prodi', true);
    }
	
	function load_cohort($prodi){
        $this->siak_view->data_cohort = $this->siak_model->siak_query("select", "SELECT * from cohort where prodi_id='".$prodi."'");
        $this->siak_view->siak_render('siak_rekap_nilai/cohort', true);
    }
	
	function load_matkul($prodi,$semes){
        $this->siak_view->data_matkul = $this->siak_model->siak_query("select", "SELECT *from matakuliah where prodi_id='$prodi' and semester='$semes'");
        $this->siak_view->siak_render('siak_rekap_nilai/matkul', true);
    }
	
	function load_dosen(){
		$siak_data = $this->siak_model->siak_query("select", "SELECT nip, gelar_depan, gelar_blkng, nama from dosen");
		$data_dosen = array();
		$result = array();		
		foreach ($siak_data as $nilai => $row ){			
			$data_dosen['nip']=$row['nip'];
			$data_dosen['nama']=$row['nama'];						
			$data_dosen['gelar_depan']=$row['gelar_depan'];						
			$data_dosen['gelar_blkng']=$row['gelar_blkng'];						
			array_push($result,$data_dosen);
		}		
		print json_encode($result);
		
	}
	
	function load_nilai(){
		$siak_data = $this->siak_model->siak_query("select", "SELECT nama from aturan_nilai");
		$data_nilai = array();
		$result = array();		
		foreach ($siak_data as $nilai => $row ){			
			// $data_nilai['nama']=$row['nama'];
			$data_nilai['nama']=$row['nama'];						
			array_push($result,$data_nilai);
		}		
		print json_encode($result);
		
	}
}

?>