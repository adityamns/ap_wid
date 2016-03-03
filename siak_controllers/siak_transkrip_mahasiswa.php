<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_transkrip_mahasiswa extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "yudisium" && $value['kode'] == "siak_transkrip_mahasiswa") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
			$this->siak_view->config = "Siak Widyatama - Cetak Transkrip Per Mahasiswa";
	
		$this->siak_view->judul = "Cetak Transkrip Per Mahasiswa";
		
		$this->siak_breadcrumbs->add(array('title'=>'Yudisium','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Cetak Transkrip Per Mahasiswa','href'=>''. URL . 'yudisium/cetak transkrip per mahasiswa'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		$this->siak_view->cohort = $this->siak_model->siak_query("select", "select cohort from cohort group by cohort order by cohort asc");
		$this->siak_view->siak_render('siak_transkrip_mahasiswa/index', false);
	}
	
	public function cohort($cohort_id){
		
		$this->siak_view->data_prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->siak_render('siak_transkrip_mahasiswa/prodi', true);
	}
	
	function getbobot($cohort_id,$prodi_id){
	
		
		$this->siak_view->laporan = $this->siak_model->siak_query("select", "select 
				 a.nim,
				 a.ipk,
				 d.nama_depan,
				 d.nama_belakang,
				 a.cohort,
				 a.prodi_id,
				 a.predikat,
				 a.ket,
				 a.tahun_lulus,
				 b.tahun_masuk,
				 (a.tahun_lulus - b.tahun_masuk)as kurangan
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
			 a.prodi_id='".$prodi_id."' and
			 a.cohort='".$cohort_id."'
			 
			 union
			 
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
				 b.tahun_masuk,
				 (a.tahun_lulus - b.tahun_masuk)as kurangan
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
			 a.prodi_id='".$prodi_id."' and
			 a.cohort='".$cohort_id."'
			 
			order by kurangan asc ,ipk desc 
					");
		$this->siak_view->cohort = $cohort_id;
		$this->siak_view->prodi = $prodi_id;
		$this->siak_view->siak_render('siak_transkrip_mahasiswa/tabel', true);
	}
	
function cetak_transkrip_perprodi($cohort_id,$prodi_id){
	
		$query2= "select 
				 a.cohort,
				 c.prodi,
				 c.prodi_id
				
			  from 
				  cohort a,
				
				  prodi c
				 
			 where
			
			
			 a.prodi_id=c.prodi_id and
			
			 a.prodi_id='".$prodi_id."' and
			 a.cohort='".$cohort_id."'
			
					";
		
		
		$query= "select 
				 a.nim,
				 a.ipk,
				 d.nama_depan,
				 d.nama_belakang,
				 a.cohort,
				 a.prodi_id,
				 a.predikat,
				 a.ket,
				 a.tahun_lulus,
				 b.tahun_masuk,
				 (a.tahun_lulus - b.tahun_masuk)as kurangan
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
			 a.prodi_id='".$prodi_id."' and
			 a.cohort='".$cohort_id."'
			 
			 union
			 
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
				 b.tahun_masuk,
				 (a.tahun_lulus - b.tahun_masuk)as kurangan
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
			 a.prodi_id='".$prodi_id."' and
			 a.cohort='".$cohort_id."'
			 
			order by kurangan asc ,ipk desc 
					";
					//echo $query;
					$this->siak_view->data = $this->siak_model->siak_query("select", $query);
					$this->siak_view->data2 = $this->siak_model->siak_query("select", $query2);
		$this->siak_view->siak_render('siak_transkrip_mahasiswa/transkripprodi', true);
	}
	
	
	//===============================================//
	function datapredikat($nim,$prodi_id,$cohort_id){
		//$this->siak_view->nim =$_POST['nim'];
		
		$this->siak_breadcrumbs->add(array('title'=>'Yudisium','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Transkrip Nilai','href'=>''. URL . 'yudisium/Transkrip Nilai'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());

		$query = "
			 select 
				  a.nim,
				  a.grade,
				  d.sks,
				  a.matkul_id,
				  d.nama_matkul
				  
			from 
				  nilai_mahasiswa a, 
				  matakuliah d 
				  
			where 
				  a.matkul_id=d.kode_matkul and
				  a.prodi_id=d.prodi_id and
				  a.semester=d.semester and
				  a.nim='".$nim."'
			  ";
			  //echo $query;


		$query2 = "
			 select 
				 nim,
				 ipk,
				 predikat
				  
			from 
				  transkrip_nilai
				  
			where 	
				 	nim='".$nim."'
			  ";

		$query3 = "
			 select 
				 a.nim,
				 a.nama_depan,
				 a.nama_belakang,
				 a.tempat_lahir,
				 a.tanggal_lahir,
				 c.prodi
				  
			from 
				  data_pribadi_umum a,
				  transkrip_nilai b,
				  prodi c
				  
			where 
				a.nim=b.nim and
				b.prodi_id=c.prodi_id and
				 a.nim='".$nim."'
			
			union
			
			 select 
				 a.nim,
				 a.nama_depan,
				 a.nama_belakang,
				 a.tempat_lahir,
				 a.tanggal_lahir,
				 c.prodi
				  
			from 
				  data_pribadi_pns a,
				  transkrip_nilai b,
				  prodi c
				  
			where 
				a.nim=b.nim and
				b.prodi_id=c.prodi_id and
				 a.nim='".$nim."'
			  ";

		$query4 = "
			select 
				
				 sum(b.sks) as totalsks
				  
			from 
				  transkrip_nilai a,
				  matakuliah b,
				  nilai_mahasiswa c

				  
			where 	a.nim=c.nim and
					b.semester=c.semester and
					a.prodi_id=c.prodi_id and
					b.kode_matkul=c.matkul_id and
					a.prodi_id=b.prodi_id and
				 	a.nim='".$nim."'
					group by a.nim




				";
		$query5 = "
			select 
				
				 judul
				  
			from 
				  pendaftaran_tesis

				  
			where 	
				 	nim='".$nim."'
					



				";

		$explode = explode(",",$prodi_id);
		$ok= $explode[0];

		$query7 = "
			select 
				
				 tgl_transkrip,
				 nama_pejabat,
				 jabatan_pejabat,
				 prodi_id,
				 cohort
				  
			from 
				  set_transkrip

				  
			where 	
				 	cohort='".$cohort_id."' and
				 	prodi_id like '%".$prodi_id."%'
					



				";
			

				$query8 = "
			select 
				
				no_ijazah
				  
			from 
				  ijazah

				  
			where 
				 	nim='".$nim."'
					



				";
$this->siak_view->cohort = $cohort_id;
		$this->siak_view->prodi = $prodi_id;
		$this->siak_view->data = $this->siak_model->siak_query("select", $query);
		$this->siak_view->data2 = $this->siak_model->siak_query("select", $query2);
		$this->siak_view->data3 = $this->siak_model->siak_query("select", $query3);
		$this->siak_view->data4 = $this->siak_model->siak_query("select", $query4);
		$this->siak_view->data5 = $this->siak_model->siak_query("select", $query5);
		$this->siak_view->data7 = $this->siak_model->siak_query("select", $query7);
		$this->siak_view->data8  = $this->siak_model->siak_query("select", $query8);
		$this->siak_view->siak_render('siak_transkrip_mahasiswa/datapredikat', false);
	}

	

	 public function pdftranskrip($cohort_id,$prodi_id){
	 	$this->siak_view->nim =$_POST['x'];
	 	$this->siak_view->cohort = $cohort_id;
		$this->siak_view->prodi = $prodi_id;
		
		$query = "
			  select 
				  a.nim,
				  a.grade,
				  d.sks,
				  a.matkul_id,
				  d.nama_matkul
				  
			from 
				  nilai_mahasiswa a, 
				  matakuliah d 
				  
			where 
				  a.matkul_id=d.kode_matkul and
				  a.prodi_id=d.prodi_id and
				  a.semester=d.semester and
				  a.nim='$_POST[x]'
			  ";
			  //echo $query;

		$query2 = "
				 select 
				 a.nim,
				 a.nama_depan,
				 a.nama_belakang,
				 a.tempat_lahir,
				 a.tanggal_lahir,
				 c.prodi
				  
			from 
				  data_pribadi_umum a,
				  transkrip_nilai b,
				  prodi c
				  
			where 
				a.nim=b.nim and
				b.prodi_id=c.prodi_id and
				a.nim='$_POST[x]'
			
			union
			 select 
				 a.nim,
				 a.nama_depan,
				 a.nama_belakang,
				 a.tempat_lahir,
				 a.tanggal_lahir,
				 c.prodi
				  
			from 
				  data_pribadi_pns a,
				  transkrip_nilai b,
				  prodi c
				  
			where 
				a.nim=b.nim and
				b.prodi_id=c.prodi_id and
				a.nim='$_POST[x]'


				";

		$query3 = "
				 select 
				 nim,
				 ipk,
				 predikat

			from 
				  transkrip_nilai
				 

				  
			where 
				 nim='$_POST[x]'


				";

		$query4 = "
			select 
				
				 sum(b.sks) as totalsks
				  
			from 
				  transkrip_nilai a,
				  matakuliah b,
				  nilai_mahasiswa c

				  
			where 	a.nim=c.nim and
					b.semester=c.semester and
					a.prodi_id=c.prodi_id and
					b.kode_matkul=c.matkul_id and
					a.prodi_id=b.prodi_id and
				 	a.nim='$_POST[x]'
					group by a.nim




				";


		$query5 = "
			select 
				
				 judul
				  
			from 
				  pendaftaran_tesis

				  
			where 	
				 	nim='$_POST[x]'
					



				";
		


		$query8 = "
			select 
				
				no_ijazah
				  
			from 
				  ijazah

				  
			where 
				 	nim='$_POST[x]'
					



				";

		$query7 = "
			select 
				
				 tgl_transkrip,
				 nama_pejabat,
				 jabatan_pejabat,
				 prodi_id,
				 cohort
				  
			from 
				  set_transkrip

				  
			where 	
				 	cohort='".$cohort_id."' and
				 	prodi_id like '%".$prodi_id."%'
					



				";

		//echo $query;
		// die();
		
		$this->siak_view->data = $this->siak_model->siak_query("select", $query);
		$this->siak_view->data2 = $this->siak_model->siak_query("select", $query2);
		$this->siak_view->data3 = $this->siak_model->siak_query("select", $query3);
		$this->siak_view->data4 = $this->siak_model->siak_query("select", $query4);
		$this->siak_view->data5 = $this->siak_model->siak_query("select", $query5);
		$this->siak_view->data7 = $this->siak_model->siak_query("select", $query7);
		$this->siak_view->data8 = $this->siak_model->siak_query("select", $query8);
        $this->siak_view->siak_render('siak_transkrip_mahasiswa/pdftranskrip', true);
        
    }




	
	
}

?>