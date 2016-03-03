<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak pengampu_pembekalan controller class */

class Siak_predikat_nilai extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "pembekalan" && $value['kode'] == "pengampu_pembekalan") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();
	}

	function siak_datalist(){
	$this->siak_view->config = "Siak Widyatama - Predikat Kelulusan";
	
		$this->siak_view->judul = "Predikat Kelulusan";
		
		$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Predikat Kelulusan','href'=>''. URL . 'Tugas Akhir / Predikat Kelulusan'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		$this->siak_view->status_pengampu = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "
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
				  data_pribadi_umum d
			 where
			 a.nim=d.nim and
			 a.cohort=b.cohort and
			 a.prodi_id=c.prodi_id and
			 b.prodi_id=c.prodi_id 
			 
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
			 b.prodi_id=c.prodi_id
			
			order by kurangan asc ,ipk desc 
");
		$this->siak_view->siak_render('siak_predikat_nilai/data', false);
	}

	function siak_add(){
		$this->siak_view->status_pengampu = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_render('siak_predikat_nilai/add', true);
	}

	public function siak_create(){
		// $_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_predikat_nilai');
	}

	public function siak_edit($pengampu_id){
		$where = array('pengampu_id' => $pengampu_id);
		$this->siak_view->status_pengampu = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pengampu_pembekalan", "*");
		$this->siak_view->siak_render('siak_predikat_nilai/edit', true);
	}

	public function siak_edit_save($pengampu_id){
		$where = array('pengampu_id' => $pengampu_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_predikat_nilai');
	}

	public function siak_delete($pengampu_id){
		$where = array('pengampu_id' => $pengampu_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_predikat_nilai');
	}



	public function simpanket()
	{
		# code...
		$nim = $_POST['nim_baru'];
		$ket = $_POST['ket'];
		$matkul_id = $_POST['matkul_id'];

		foreach ($nim as $key => $value) {
			# code...
			$sql = "update transkrip_nilai set ket = '$ket[$key]' where nim = '$value' ";
			//if($status[$key] == NULL){
				//echo $sql." kosong ga perlu update<br>";
			//}else{
				//echo $sql."<br>"; 
				
			//}

		$this->siak_model->siak_query("update", $sql);
		}

		 header('location: ' . URL . 'siak_predikat_nilai');
	}



	function datapredikat($nim){
		//$this->siak_view->nim =$_POST['nim'];
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

		$this->siak_view->data = $this->siak_model->siak_query("select", $query);
		$this->siak_view->data2 = $this->siak_model->siak_query("select", $query2);
		$this->siak_view->data3 = $this->siak_model->siak_query("select", $query3);
		$this->siak_view->data4 = $this->siak_model->siak_query("select", $query4);
		$this->siak_view->data5 = $this->siak_model->siak_query("select", $query5);
		$this->siak_view->siak_render('siak_predikat_nilai/datapredikat', false);
	}






	 public function pdftranskrip(){
	 	$this->siak_view->nim =$_POST['x'];
		
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

		//echo $query;
		// die();
		
		$this->siak_view->data = $this->siak_model->siak_query("select", $query);
		$this->siak_view->data2 = $this->siak_model->siak_query("select", $query2);
		$this->siak_view->data3 = $this->siak_model->siak_query("select", $query3);
		$this->siak_view->data4 = $this->siak_model->siak_query("select", $query4);
		$this->siak_view->data5 = $this->siak_model->siak_query("select", $query5);
        $this->siak_view->siak_render('siak_predikat_nilai/pdftranskrip', true);
        
    }

}

?>