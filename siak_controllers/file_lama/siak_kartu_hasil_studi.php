<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak rencana_studi controller class */

class Siak_kartu_hasil_studi extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}
	
	
	function index(){
		$where2 = array('nim' => '120140103001' ,'semester' => '1');
		$this->siak_view->data_nilai = $this->siak_model->siak_edit($where2, "nilai_mahasiswa", "*");
		$this->siak_view->siak_render('siak_kartu_hasil_studi/index', false);
	}
	
	public function pdf_khs(){

		$nimZ = $_POST['nim_pdf'];
		$semesterZ = $_POST['smstr'];

		$where1 = array('nim' => $nimZ);
		$where2 = array('nim' => $nimZ ,'semester' => $semesterZ);

		$prodi = $this->siak_model->siak_edit($where1, "mahasiswa", "*");

		foreach ($prodi as $key => $value) {
		$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semesterZ);
		}
		$this->siak_view->data = $this->siak_model->siak_edit($kondisi, "matakuliah", "*");
		$this->siak_view->data_nilai = $this->siak_model->siak_edit($where2, "nilai_mahasiswa", "*");

		//var_dump($this->siak_view->data_nilai);die();
		$this->siak_view->nim = $nimZ;
		$this->siak_view->semester = $semesterZ;

		$this->siak_view->siak_render('siak_kartu_hasil_studi/pdf_khs', true);

	}

	public function siak_cek($nim,$semester){
		
		$where1 = array('nim' => $nim);
		$where2 = array('nim' => $nim ,'semester' => $semester);
				
		$prodi = $this->siak_model->siak_edit($where1, "mahasiswa", "*");
		
		
		$sql_evaluasi = "select * from evaluasi_dosen where nim = '$nim' and semester = '$semester'";
		$evaluasi = $this->siak_model->siak_query("select", $sql_evaluasi);
		
		foreach ($prodi as $key => $value) {
			$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semester);
		}
		
// 		$sqlx = "select * from matakuliah where prodi_id = '' and semester=''";
		
		$this->siak_view->data = $this->siak_model->siak_edit($kondisi, "matakuliah", "*");
		$this->siak_view->data_nilai = $this->siak_model->siak_edit($where2, "nilai_mahasiswa", "*");
		
		
		///////////////////////////////////////
		//Cek NIM yang di input
		///////////////
		if($nim != Siak_session::siak_get('username') && Siak_session::siak_get('level') == 16) {
			echo "<div class='alert alert-danger'>Maaf anda tidak dapat melihat data NIM ".$nim."</div>";
			die();
		}
		///////
		//End
		/////////////////////////////////////////
		
		///////////////////////////////////////
		//Cek NIM & SEMESTER Aktif
		///////////////
		
		
		if($nim == Siak_session::siak_get('username') && $semester > $value['semester'] || sizeof($this->siak_view->data_nilai) <= 0) {
			echo "<div class='alert alert-danger'>Maaf KHS Semester ".$semester." belum dapat dilihat atau Nilai belum ada. </div>";
			die();
		}else{
		
			if(Siak_session::siak_get('level') == 16 && sizeof($evaluasi) <= 0){
			echo	"
				<div class='alert alert-danger'>
					Silahkan isi Evaluasi Dosen terlebih dahulu untuk mencetak KHS
					<a href='".URL."siak_kartu_hasil_studi/ev_dos/".$nim."/".$value['prodi_id']."/".$semester."'>Klik Disini</a>
				</div>
				";
			die();
			}
			
		}
		
		///////
		//End
		/////////////////////////////////////////
		
		foreach($this->siak_view->data_nilai as $ass => $hole){
		
			$cek_ev_dos = $this->data_matkul($hole['matkul_id'],$hole['nim']);
			
			$dosen_utama[] = explode(",", $cek_ev_dos[0]['dosen_utama']);
			
			$asshole = $this->cek_ev_dos($dosen_utama[0][$ass],$hole['prodi_id'],$hole['matkul_id'],$hole['nim']);
			
			if($dosen_utama[0][$ass] == $asshole[$ass]['nip'] && Siak_session::siak_get('level') == 16){
				echo	"
					<div class='alert alert-danger'>
						Silahkan isi Evaluasi Dosen terlebih dahulu untuk mencetak KHS
						<a href='".URL."siak_kartu_hasil_studi/ev_dos/".$nim."/".$value['prodi_id']."/".$semester."'>Klik Disini</a>
					</div>
					";
				die();
			}
		}
		$this->siak_view->siak_render('siak_kartu_hasil_studi/ikhs', true);
	}
	
	function cek_ev_dos($nip,$prodi_id,$matkul_id,$nim){
		$sql_cek_ev_dos = "select nip from evaluasi_dosen where prodi_id = '$prodi_id' and nim = '$nim' and kode_matkul = '$matkul_id' group by nip";
		
		
// 		echo $sql_cek_ev_dos;die();
		$data = $this->siak_model->siak_query("select", $sql_cek_ev_dos);
		
		return $data;
	}
	
	public function siak_ok(){
		$this->siak_view->siak_data = $this->siak_model->siak_query("update", "UPDATE mahasiswa set semester = '".$_POST['semester']."', status = 1 WHERE nim = ".$_POST['nim']."; ");
		header('location: ' . URL . 'siak_rencana_studi');
	}

	public function data_matkul($matkul_id,$nim){
		$sql1 = "select * from dosen_matakuliah where kode_matkul = '".$matkul_id."'";
		$sql = "
			SELECT
			nilai_mahasiswa.prodi_id,
			nilai_mahasiswa.nim,
			nilai_mahasiswa.matkul_id,
			dosen_matakuliah.dosen_utama,
			dosen_matakuliah.dosen_pendamping
			
			FROM 
			nilai_mahasiswa,
			dosen_matakuliah
			
			WHERE
			nilai_mahasiswa.prodi_id = dosen_matakuliah.prodi_id AND
			nilai_mahasiswa.matkul_id = dosen_matakuliah.kode_matkul AND
			nilai_mahasiswa.matkul_id = '".$matkul_id."' AND nilai_mahasiswa.nim = '".$nim."'";
// 		echo $sql;die();
		$data = $this->siak_model->siak_query("select", $sql);
		return $data;
	}
	
	function isi_evaluasi($nim,$matkul_id,$semester,$char){
	
		$sql = "
		select * from soal_evaluasi_dosen
		";
		$soal = $this->siak_model->siak_query("select",$sql);
		$this->siak_view->soal = $soal;
		$this->siak_view->char = $char;
		$this->siak_view->semester = $semester;
		
		$sqlX = "select * from dosen_matakuliah where kode_matkul = '".$matkul_id."'";
// 		$this->siak_view->data_matkul = $this->siak_model->siak_query("select", $sqlX);
		
		$this->siak_view->data_matkul = $this->data_matkul($matkul_id,$nim);
		
		$sql_dosen = "
				select nip from evaluasi_dosen where nim = '".$nim."' and semester = '".$semester."' and kode_matkul = '".$matkul_id."'
				";
				
// 		var_dump($sqlX);die();
		$this->siak_view->cek_dosen = $this->siak_model->siak_query("select", $sql_dosen);
		
		$this->siak_view->siak_render('evaluasi/index', true);
	}
	
	function ev_dos($nim,$prodi,$semester){
		
		$this->siak_view->nim_mhs = $nim;
		$this->siak_view->prodi_mhs = $prodi;
		$this->siak_view->smstr_mhs = $semester;
		$sql = "
			SELECT 
				nilai_mahasiswa.prodi_id, 
				nilai_mahasiswa.nim, 
				nilai_mahasiswa.matkul_id, 
				matakuliah.semester 
			FROM 
				nilai_mahasiswa, 
				matakuliah 
			WHERE 
				nilai_mahasiswa.matkul_id = matakuliah.kode_matkul AND 
				matakuliah.prodi_id = '".$prodi."' AND 
				nilai_mahasiswa.nim = '".$nim."' AND 
				nilai_mahasiswa.semester = '".$semester."'
				";
			
// 		echo $sql;die();
		$this->siak_view->data_nilai = $this->siak_model->siak_query("select", $sql);
		
		$this->siak_view->siak_render('evaluasi/ev_dos', false);
	}
	
	function tambah($nim,$matkul_id,$dosen,$prodi,$semester){
        $sql = "
		select * from soal_evaluasi_dosen
		";
		$soal = $this->siak_model->siak_query("select",$sql);
		$this->siak_view->soal = $soal;
		$this->siak_view->dosen = $dosen;
		$this->siak_view->smstr_mhs = $semester;
		
		$sql1 = "select * from dosen_matakuliah where kode_matkul = '".$matkul_id."'";
		
		$sql = "
			SELECT
			nilai_mahasiswa.prodi_id,
			nilai_mahasiswa.nim,
			nilai_mahasiswa.matkul_id,
			dosen_matakuliah.dosen_utama,
			dosen_matakuliah.dosen_pendamping
			
			FROM 
			nilai_mahasiswa,
			dosen_matakuliah
			
			WHERE
			nilai_mahasiswa.prodi_id = dosen_matakuliah.prodi_id AND
			nilai_mahasiswa.matkul_id = dosen_matakuliah.kode_matkul AND
			nilai_mahasiswa.matkul_id = '".$matkul_id."' AND nilai_mahasiswa.nim = '".$nim."'";
// 		echo $sql;die();
		$this->siak_view->data_matkul = $this->siak_model->siak_query("select", $sql);
        $this->siak_view->siak_render('evaluasi/tambah', true);
    }
    
    function simpan($prodi,$semester){
        $sql = "
		select * from soal_evaluasi_dosen
		";
        $soal = $this->siak_model->siak_query("select",$sql);
	
        foreach($soal as $row => $rec){
            $poll = $_POST['poll'.$rec['soal_id']];
            $alasan = $_POST['soal'.$rec['soal_id']];
            $soal_id = $_POST['soal_id'.$rec['soal_id']];
            $prodi_id = $_POST['prodi_id'.$rec['soal_id']];
            $nim = $_POST['nim'.$rec['soal_id']];
            $dosen_id = $_POST['dosen_id'.$rec['soal_id']];
            $matkul_id = $_POST['matkul_id'.$rec['soal_id']];
	    
	    
	    
            $count = count($nim);
            for($z=0;$z < $count; $z++){

		if($poll == NULL){
		    $pool = 0;
		}else{
		    $pool = $poll;
		}
		
		$sql_insert = "insert into evaluasi_dosen(prodi_id,nip,kode_matkul,nim,soal_id,jawaban,penjelasan,semester) values('".$prodi_id."','".$dosen_id."','".$matkul_id."','".$nim."','".$soal_id."','".$pool."','".$alasan."','".$semester."')";
// 		echo $sql_insert."<br>";
		$this->siak_model->siak_query("insert", $sql_insert);
            }
        }
        header('location:'.URL.'siak_kartu_hasil_studi/ev_dos/'.$nim.'/'.$prodi.'/'.$semester);
    }
}

?>