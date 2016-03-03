<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak jenis_ruang controller class */

class Siak_generate_transkrip extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "wisuda" && $value['kode'] == "yudisium") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		// $this->siak_datalist();
		$this->siak_view->siak_render('siak_generate_transkrip/index', false);
	}

	public function siak_datalist(){
		$where = array('status' => 4);
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "
		SELECT * FROM(
			SELECT 
				b.nim,
				b.nama_depan,
				b.nama_belakang,
				c.prodi,
				a.status,
				d.status as statusy
			FROM 
				pendaftaran_judul_tesis as a,
				data_pribadi_pns as b, 
				prodi as c ,
				yudisium as d
			WHERE 
				a.nim = b.nim AND
				d.nim = b.nim AND
				c.prodi_id = a.prodi_id
			UNION
			SELECT 
				b.nim,
				b.nama_depan,
				b.nama_belakang,
				c.prodi,
				a.status,
				d.status as statusy
			FROM 
				pendaftaran_judul_tesis as a,
				data_pribadi_umum as b, 
				prodi as c,
				yudisium as d
			WHERE 
				a.nim = b.nim AND
				d.nim = b.nim AND
				c.prodi_id = a.prodi_id ) as a
		WHERE a.status = '4'
		");
		$this->siak_view->siak_render('siak_generate_transkrip/data', false);
	}
	function matkul($prodi,$semes){
		$this->siak_view->data_matkul = $this->siak_model->siak_query("select", "SELECT *from matakuliah where prodi_id='$prodi' and semester='$semes'");
		$this->siak_view->siak_render('siak_generate_transkrip/matkul', true);
	}
	public function siak_edit($nim){
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM yudisium WHERE nim = '".$nim."'");
		$this->siak_view->siak_render('siak_generate_transkrip/edit', true);
	}
	
	public function siak_edit_save($nim){
		$where = array('nim' => $nim);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_generate_transkrip');
	}
	function Data_IPK($prodi,$tahunid){
		$this->siak_view->prodi    = $prodi;
		$this->siak_view->tahun    = $tahunid;
		$this->siak_view->semester = $semes;
		$this->siak_view->matkul   = $matkul;
		$this->siak_view->semester = $this->siak_model->siak_query("select", "select count(semester)as jumlah,semester from matakuliah where prodi_id='$prodi' group by semester ORDER BY SEMESTER");
		$this->siak_view->data = $this->siak_model->siak_query("select", "select singkatan,sks,semester from matakuliah where prodi_id='$prodi' ORDER BY SEMESTER");
		$this->siak_view->total_sks = $this->siak_model->siak_query("select", "select sum(sks) as jumlah from matakuliah where prodi_id='$prodi'");
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * From (SELECT a.*, b.nama_depan, b.nama_belakang, b.telp_rumah, b.handphone, b.alamat_rumah, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND c.prodi_id='$prodi' AND a.tahun_masuk='$tahunid'  UNION SELECT a.*, b.nama_depan, b.nama_belakang, b.telp_rumah, b.handphone, b.alamat_rumah, c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND c.prodi_id='$prodi' AND a.tahun_masuk='$tahunid') as Result order by nim ASC ");
		$this->siak_view->data_nilai = $this->siak_model->siak_query("select", "SELECT a.prodi_id,a.nim,a.matkul_id,a.nilai_total,a.grade,a.bobot, b.sks, b.singkatan, c.bobot, max(b.sks*a.bobot) as total FROM nilai_mahasiswa a, matakuliah b, aturan_nilai c WHERE b.kode_matkul=a.matkul_id and a.prodi_id='$prodi' and a.grade=c.nama group by a.prodi_id,a.nim,a.matkul_id,a.nilai_total,a.grade,a.bobot, b.sks, b.singkatan, c.bobot ");
		$this->siak_view->total_nilai = $this->siak_model->siak_query("select", "select SUM(total)as total, nim from (SELECT a.prodi_id,a.nim,a.matkul_id,a.nilai_total,a.grade,a.bobot, b.sks, b.singkatan,  max(b.sks*a.bobot) as total FROM nilai_mahasiswa a, matakuliah b 
		WHERE b.kode_matkul=a.matkul_id and a.prodi_id='$prodi'  group by a.prodi_id,a.nim,a.matkul_id,a.nilai_total,a.grade,a.bobot, b.sks, b.singkatan) as tot group by nim ");
		$this->siak_view->data_nilai_mhs = $this->siak_model->siak_query("select", "SELECT nim FROM nilai_mahasiswa WHERE prodi_id='$prodi' ");
		$this->siak_view->siak_render('siak_generate_transkrip/list_data', true);
	}

	function user_detail($user_id){
	      
	      $sql = "
		      select * from users where id = '$user_id'
	      ";
	      $data = $this->siak_model->siak_query("select" ,$sql);
	      $this->siak_view->data = $data;
	      $this->siak_view->siak_render('siak_generate_transkrip/index', false);
	}

	

	public function simpan_ipk()
	{
		# code...
		$nama = $_POST['nama_lengkap'];
		$nim = $_POST['nim_baru'];
		$ipk = $_POST['ipk'];
		$cohort = $_POST['cohort'];
		$prodi_id = $_POST['prodi_id'];
		date_default_timezone_set('Asia/Jakarta');
		$tahun_lulus = date('Y');

		
		// print_r($ipk);die();

		
		$ga_jelas = $this->siak_model->siak_data_list("predikat","*");

			foreach($ga_jelas as $ga => $jelas){
			foreach ($_POST[x] as $key => $value) {
				if($ipk[$key] >= $jelas['ipkmin'] && $ipk[$key] <= $jelas['ipkmax']){
					$grade = $jelas['nama'];
			$sql = "insert into transkrip_nilai (nim,cohort,prodi_id,ipk,predikat,ket,tahun_lulus) values ('".$nim[$key]."','".$cohort[$key]."','".$prodi_id[$key]."','".$ipk[$key]."','".$grade."','".$ket."','".$tahun_lulus."')";
				echo $sql."<br>";
				//$this->siak_model->siak_query("insert" ,$sql);
				}

			}
		}


		// var_dump($_POST[x]);
		// die();
		/*foreach ($_POST[x] as $key => $value) {
		

		if ($ipk[$key]>=3.8 && $ipk[$key]<=4) {
			$grade='Cum Laude';} 
		if ($ipk[$key]>=3.5 && $ipk[$key]<=3.7) {
			$grade='Sangat Memuaskan';} 
		if ($ipk[$key]>=2.75 && $ipk[$key]<=3.4) {
			$grade='Memuaskan';} 
		if ($ipk[$key]>=2.5 && $ipk[$key]<=2.74) {
			$grade='Cukup';} 
		if ($ipk[$key]>=2.0 && $ipk[$key]<=2.4) {
			$grade='Kurang';} 
		else {
			$grade = 'Sangat Kurang/Gagal';
		}


		// var_dump($ipk[$key]<=3);die();
			# code...
			// echo "<pre>";
			// var_dump($value);
			// echo "</pre>";
			$sql = "insert into transkrip_nilai (nim,cohort,prodi_id,ipk,predikat,ket,tahun_lulus) values ('".$nim[$key]."','".$cohort[$key]."','".$prodi_id[$key]."','".$ipk[$key]."','".$grade."','".$ket."','".$tahun_lulus."')";
			// var_dump($key);
			//echo $sql."<br>";
			$this->siak_model->siak_query("insert" ,$sql);
			
		}*/
		
		//$this->siak_view->siak_render('siak_generate_transkrip/index', false);
	}

}

?>