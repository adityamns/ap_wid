<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_rekap_absendosen extends Siak_controller{

    function __construct(){
        parent::__construct();
        parent::siak_logstat();
        $this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
    }

    function index(){
		$this->siak_view->config = "Siak Widyatama - Rekap Dosen";
	
		$this->siak_view->judul = "Rekap Dosen";
		
		$this->siak_breadcrumbs->add(array('title'=>'Laporan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Rekap Dosen','href'=>''. URL . 'siak_rekap_absendosen'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
        $this->siak_rekap_absendosen();
    }

    function siak_rekap_absendosen(){
        /* foreach ($this->siak_session->siak_getAll() as $key => $value) {
            if ($value['groups'] == "omerta" && $value['kode'] == "rekap_absendosen") {
                $this->siak_view->loads = $value['loads'];
                $this->siak_view->reades  = $value['reades'];
				
            }
        } */
		$method_or_uri = 'siak_rekap_absendosen';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		
        $this->siak_view->siak_render('siak_rekap_absendosen/index', false);
    }

	function getCohort($prodi){
		$this->siak_view->cohort = $this->siak_model->siak_query("select", "SELECT * FROM cohort WHERE prodi_id='$prodi'");
		$this->siak_view->siak_render('siak_rekap_absendosen/getCohort', true);
	}

    function getRekap($dosen,$matkul){
        $this->siak_view->nip = $dosen;
        $this->siak_view->idmatkul = $matkul;	
		//echo $this->siak_model->siak_getrecord("matakuliah","kode_matkul='$matkul'");exit;
		$this->siak_view->data_jadwal = $this->siak_model->siak_query("select", "SELECT a.kode_matkul,a.dosen_utama,a.kode_topik,a.pertemuanke,a.mulai,a.akhir FROM jadwal_kuliah a WHERE a.dosen_utama = '$dosen' AND a.kode_matkul = '$matkul' order by pertemuanke asc");		
			
		$this->siak_view->dosen = $this->siak_model->siak_query("select", "SELECT nip,nama,gelar_depan,gelar_blkng from dosen WHERE nip = '$dosen' ");
		$this->siak_view->matkul = $this->siak_model->siak_getfield("nama_matkul","matakuliah","kode_matkul='$matkul'");
		$this->siak_view->siak_render('siak_rekap_absendosen/data_rekap',true);
		
    }  

	function print_rekap(){
        $dosen =$_POST['dosen'];
        $matkul =$_POST['matkul'];
		
		$this->siak_view->nip = $dosen;
	
		$this->siak_view->data_jadwal = $this->siak_model->siak_query("select", "
										SELECT a.kode_matkul,a.dosen_utama,a.kode_topik,a.pertemuanke,a.mulai,a.akhir FROM jadwal_kuliah a 
										WHERE a.dosen_utama = '$dosen' AND a.kode_matkul = '$matkul' order by pertemuanke asc;
			");		
			
		$this->siak_view->dosen = $this->siak_model->siak_query("select", "SELECT nip,nama,gelar_depan,gelar_blkng from dosen WHERE nip = '$dosen' ");
		$this->siak_view->matkul = $this->siak_model->siak_getfield("nama_matkul","matakuliah","kode_matkul='$matkul'");
		$this->siak_view->siak_render('siak_rekap_absendosen/print_rekap',true);
		 
    }  
	
	function load_dosen(){
		$siak_data = $this->siak_model->siak_query("select", "SELECT nip,nama,gelar_depan,gelar_blkng from dosen");
		$data_dosen = array();
		
				$result = array();
		
		foreach ($siak_data as $nilai => $row ){
			$data_dosen['nip']=$row['nip'];
			$data_dosen['nama']= $row['gelar_depan']." ".$row['nama']." ".$row['gelar_blkng'];
			
			
			array_push($result,$data_dosen);
		}
		
       print json_encode($result);
		
	}
	
	public function matkul($dosen){
		/*$this->siak_view->data_matkul = $this->siak_model->siak_query("select", 
									"SELECT a.kode_matkul, b.nama_matkul FROM dosen_matakuliah as a, matakuliah as b 
									WHERE a.kode_matkul = b.kode_matkul AND dosen_utama LIKE '%$dosen%'");*/
									
		$this->siak_view->data_matkul = $this->siak_model->siak_query("select", 
									"SELECT distinct(a.kode_matkul), b.nama_matkul FROM jadwal_kuliah as a, matakuliah as b 
									WHERE a.kode_matkul = b.kode_matkul AND a.dosen_utama = '$dosen'");
		$this->siak_view->siak_render('siak_rekap_absendosen/matkul', true);
	}
}

?>