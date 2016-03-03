<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak jenis_ruang controller class */

class siak_yudisium2 extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
	$this->siak_view->config = "Siak Widyatama - Lihat Transkrip Per Prodi";
	
		$this->siak_view->judul = "Lihat Transkrip Per Prodi";
			
		$this->siak_breadcrumbs->add(array('title'=>'Ijazah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Lihat Transkrip Per Prodi','href'=>'#'));
		
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
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
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->tahun_masuk = $this->siak_model->siak_data_list("cohort", "*");
		
		$this->siak_view->siak_render('siak_yudisium2/index', false);
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
		$this->siak_view->siak_render('siak_yudisium2/data', false);
	}
	function matkul($prodi,$semes){
		$this->siak_view->data_matkul = $this->siak_model->siak_query("select", "SELECT *from matakuliah where prodi_id='$prodi' and semester='$semes'");
		$this->siak_view->siak_render('siak_yudisium2/matkul', true);
	}
	public function siak_edit($nim){
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT * FROM yudisium WHERE nim = '".$nim."'");
		$this->siak_view->siak_render('siak_yudisium2/edit', true);
	}
	
	public function siak_edit_save($nim){
		$where = array('nim' => $nim);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_yudisium2');
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
		
		$this->siak_view->siak_render('siak_yudisium2/list_data', true);
	}

	function user_detail($user_id){
	      
	      $sql = "
		      select * from users where id = '$user_id'
	      ";
	      $data = $this->siak_model->siak_query("select" ,$sql);
	      $this->siak_view->data = $data;
	      $this->siak_view->siak_render('siak_yudisium2/index', false);
	
	}
	
	
	 function excel_yudisium($tahunid,$prodi){
		
		
		/*$sql= "select 
				 a.nim,
				 a.ipk,
				 d.nama_depan,
				 d.nama_belakang,
				 a.cohort,
				 a.prodi_id,
				 a.predikat,
				 a.ket,
				 a.tahun_lulus,
				 b.tahun_masuk
			  from 
				  transkrip_nilai a,
				  cohort b,
				  prodi c,
				  data_pribadi_umum d
			 where
			 a.nim=d.nim and
			 a.cohort=b.cohort and
			 a.prodi_id=c.prodi_id and
			 b.prodi_id=c.prodi_id and 
			 b.tahun_masuk='".$tahunid."' and
			 a.prodi_id='".$prodi."' 

			 UNION

			 select 
				 a.nim,
				 a.ipk,
				 d.nama_depan,
				 d.nama_belakang,
				 a.cohort,
				 a.prodi_id,
				 a.predikat,
				 a.ket,
				 a.tahun_lulus,
				 b.tahun_masuk
			  from 
				  transkrip_nilai a,
				  cohort b,
				  prodi c,
				  data_pribadi_pns d
			 where
			 a.nim=d.nim and
			 a.cohort=b.cohort and
			 a.prodi_id=c.prodi_id and
			 b.prodi_id=c.prodi_id and 
			 b.tahun_masuk='".$tahunid."' and
			 a.prodi_id='".$prodi."' 
			

					";
					// echo $sql;
		//$xsa = "select a.nim, a.ipk, d.nama_depan, d.nama_belakang, a.cohort, a.prodi_id, a.predikat, a.ket, a.tahun_lulus, b.tahun_masuk from transkrip_nilai a, cohort b, prodi c, data_pribadi_umum d where a.nim=d.nim and a.cohort=b.cohort and a.prodi_id=c.prodi_id and b.prodi_id=c.prodi_id and b.tahun_masuk='2013' and a.prodi_id='DRK'";
		  //$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		 // echo "<pre>";
		 // var_dump($data);
		 // echo "</pre>";
		 // die();
       $this->siak_view->siak_render('siak_yudisium2/excel_yudisium', true); */
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
		
       $this->siak_view->siak_render('siak_yudisium2/excel_yudisium', true);
	}



}

?>