<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_penilaian_absen extends Siak_controller{

    function __construct(){
        parent::__construct();
        parent::siak_logstat();
        $this->siak_roles();
    }

    function index(){
	//BreadCrumbs
	$this->siak_view->config = "Siak Widyatama - Nilai Absensi";

	$this->siak_view->judul = "Nilai Absensi";
	
	$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
	$this->siak_breadcrumbs->add(array('title'=>'Penilaian','href'=>'#'));
	$this->siak_breadcrumbs->add(array('title'=>'Nilai Absensi','href'=>''. URL . 'siak_penilaian_absen'));
	$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	//
        $this->siak_penilaian_absen();
    }

    function getNilai($id){
        $siak_data = $this->siak_model->siak_query("select", "SELECT * FROM nilai_mahasiswa where nim='$id'");
        $data_nilai = array();
        $result = array();

        foreach ($siak_data as $nilai => $row ){
            $data_nilai['nim']=$row['nim'];
            $data_nilai['presentasi']=$row['presentasi'];
            $data_nilai['tugas_mandiri']=$row['tugas_mandiri'];
            $data_nilai['UTS']=$row['UTS'];
            $data_nilai['UAS']=$row['UAS'];
            array_push($result,$data_nilai);
        }
        print json_encode($result);
    }

    function siak_penilaian_absen(){
        foreach ($this->siak_session->siak_getAll() as $key => $value) {
            if ($value['groups'] == "nilai" && $value['kode'] == "nilai_mahasiswa") {
                $this->siak_view->loads = $value['loads'];
                $this->siak_view->creates = $value['creates'];
                $this->siak_view->reades  = $value['reades'];
                $this->siak_view->updates = $value['updates'];
                $this->siak_view->deletes = $value['deletes'];
            }
        }
        $this->siak_view->siak_render('siak_penilaian_absen/index', false);
    }

    function matkul($prodi,$semes){
        $this->siak_view->data_matkul = $this->siak_model->siak_query("select", "SELECT *from matakuliah where prodi_id='$prodi' and semester='$semes'");
        $this->siak_view->siak_render('siak_penilaian_absen/matkul', true);
    }

    function getbobot($prodi,$cohort,$semes,$matkul,$save=""){
        $this->siak_view->prodi    = $prodi;
        $this->siak_view->cohort    = $cohort;
        $this->siak_view->semester = $semes;
        $this->siak_view->matkul   = $matkul;				
		$jml_pertemuan = 0;
		
		if(!empty($save)){
			$this->siak_view->message = "Save Nilai Absen Berhasil";
		}else{
			$this->siak_view->message = "";
		}
		
		$this->siak_view->tot_pertemuan_matkul = $this->siak_model->siak_getfield("pertemuan", "matakuliah", "kode_matkul = '".$matkul."'");
		$sql = "select count(nim) as total from absensi 
				where prodi_id = '".$prodi."' and cohort = '".$cohort."' and kode_matkul = '".$matkul."' group by nim order by total desc limit 1";
		//echo $sql;
		$this->siak_view->data_pertemuan = $this->siak_model->siak_query("select", $sql);
		foreach($this->siak_view->data_pertemuan as $row => $key){
			$jml_pertemuan = $jml_pertemuan + $key['total'];			
		}
		$this->siak_view->jml_pertemuan = $jml_pertemuan;
		//echo "pertemuan ".$this->siak_view->jml_pertemuan;
		$this->siak_view->hadir = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 1");
		$this->siak_view->sakit = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 2");
		$this->siak_view->ijin = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 3");
		$this->siak_view->alpha = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 4");		
				
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='$prodi' AND cohort='$cohort'");		
		$this->siak_view->siak_render('siak_penilaian_absen/bobot_nilai', true);        
    }    
	
	function print_nilai(){		
		$this->siak_view->prodi    = $_POST['prodi'];
        $this->siak_view->cohort    = $_POST['cohort'];
        $this->siak_view->semester = $_POST['semester'];
        $this->siak_view->matkul   = $_POST['matkul'];		
		$this->siak_view->nama_matkul = $this->siak_model->siak_getfield("nama_matkul", "matakuliah", "kode_matkul = '".$_POST['matkul']."'");
		
		$this->siak_view->hadir = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 1");
		$this->siak_view->sakit = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 2");
		$this->siak_view->ijin = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 3");
		$this->siak_view->alpha = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 4");
		
		
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='".$_POST['prodi']."' and cohort='".$_POST['cohort']."'");		
		$this->siak_view->siak_render('siak_penilaian_absen/print_nilai', true);
	}
	
	function save_nilai($prodi,$tahunid,$semes,$matkul){	
		// $prodi    = $_POST['prodi'];
        // $tahun    = $_POST['tahun'];
        // $semester = $_POST['semester'];
        // $matkul   = $_POST['matkul'];
		$prodi    = $prodi;
        $cohort    = $cohort;
        $semester = $semes;
        $matkul   = $matkul;
		
		$hadir = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 1");
		$sakit = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 2");
		$ijin = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 3");
		$alpha = $this->siak_model->siak_getfield("nilai", "bobot_absen", "kode = 4");		
				
		$totpertemuan = $this->siak_model->siak_getfield("pertemuan", "matakuliah", "kode_matkul = '".$matkul."'");
		
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='$prodi' AND tahun_masuk='$tahun' ");
				
		foreach ($this->siak_view->data_mahasiswa as $key => $value) {
			$query = "select count(*) as total, status from absensi 
					where prodi_id = '".$prodi."' and cohort = '".$cohort."' and kode_matkul = '".$matkul."' and nim = '".$value['nim']."' group by status order by status";			
			$data_absen = $this->siak_model->siak_query("select",$query);						
			$absen = 0;	
			// echo $query;exit;
			
			foreach($data_absen as $row => $key){
				if($key['status'] == 1)
					$absen = ($absen + ($hadir * $key['total']));
				if($key['status'] == 2)
					$absen = ($absen + ($sakit * $key['total']));
				if($key['status'] == 3)
					$absen = ($absen + ($ijin * $key['total']));
				if($key['status'] == 4)
					$absen = ($absen + ($alpha * $key['total']));											
			}
			$nilaiakhir = $absen/$totpertemuan * 100;			
			$prosentase = number_format((float)(10/100) * $nilaiakhir, 2, '.', '');
			$cek_count = $this->siak_model->siak_count_custom("nilai_absen", "nim = '".$value['nim']."' and prodi = '".$prodi."' and tahun = '".$tahun."' and semester = ".$semester." and kode_matkul = '".$matkul."'");
			// echo $cek_count;exit;		
			if($cek_count == 0){
				$sql = "insert into nilai_absen (nim, prodi, tahun, semester, kode_matkul, nilai) 
						values ('".$value['nim']."','".$prodi."','".$tahun."',".$semester.",'".$matkul."',".$prosentase.")";
				$this->siak_model->siak_query("insert",$sql);				
			}else{
				$sql = "update nilai_absen set nilai = ".$prosentase." 
						where nim = '".$value['nim']."' and 
							prodi = '".$prodi."' and 
							tahun = '".$tahun."' and 
							semester = ".$semester." and 
							kode_matkul = '".$matkul."'";
				$this->siak_model->siak_query("update",$sql);	
			}			
		}	
		// header('location: ' . URL . 'siak_penilaian_absen/getbobot/'.$prodi.'/'.$tahun.'/'.$semester.'/'.$matkul.'/save_sukses');
		$this->getbobot($prodi,$tahun,$semester,$matkul,"save_sukses");
	}
	
	
}

?>