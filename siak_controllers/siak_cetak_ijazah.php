<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_cetak_ijazah extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "yudisium" && $value['kode'] == "siak_cetak_ijazah") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
			$this->siak_view->config = "Siak Widyatama - Cetak Ijazah";
	
		$this->siak_view->judul = "Cetak Ijazah";
		
		$this->siak_breadcrumbs->add(array('title'=>'Ijazah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Cetak Ijazah','href'=>''. URL . 'ijazah/cetak ijazah'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		$this->siak_view->cohort = $this->siak_model->siak_query("select", "select cohort from cohort group by cohort order by cohort asc");
		$this->siak_view->siak_render('siak_cetak_ijazah/index', false);
	}
	
	public function cohort($cohort_id){
		
		$this->siak_view->data_prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->siak_render('siak_cetak_ijazah/prodi', true);
	}
	
	function getbobot($cohort_id,$prodi_id){
	
		
		$this->siak_view->laporan = $this->siak_model->siak_query("select", "
			select 
				a.no_ijazah,
				a.nim,
				e.nama_depan,
				e.nama_belakang,
				a.prodi_id,
				a.apdekan,
				a.apakademik,
				a.apwarek
			  from 
				 ijazah a,
				  cohort b,
				  prodi c,
				  mahasiswa d,
				  data_pribadi_umum e
			 where
			 a.nim=e.nim and
			 a.nim=d.nim and
			b.cohort=d.cohort and
			 a.prodi_id=c.prodi_id and
			 b.prodi_id=c.prodi_id and 
			 a.apdekan='1' and
			 a.apakademik='1' and
			 a.apwarek='1' and
			a.prodi_id='".$prodi_id."' and
			 b.cohort='".$cohort_id."'

			union

			select 
				a.no_ijazah,
				a.nim,
				e.nama_depan,
				e.nama_belakang,
				a.prodi_id,
				a.apdekan,
				a.apakademik,
				a.apwarek
			  from 
				 ijazah a,
				  cohort b,
				  prodi c,
				  mahasiswa d,
				  data_pribadi_pns e
			 where
			 a.nim=e.nim and
			 a.nim=d.nim and
			b.cohort=d.cohort and
			 a.prodi_id=c.prodi_id and
			 b.prodi_id=c.prodi_id and 
			  a.apdekan='1' and
			 a.apakademik='1' and
			 a.apwarek='1' and
			a.prodi_id='".$prodi_id."' and
			 b.cohort='".$cohort_id."'

			
			 
			
					");
		$this->siak_view->cohort = $cohort_id;
		$this->siak_view->prodi = $prodi_id;
		$this->siak_view->siak_render('siak_cetak_ijazah/tabel', true);
	}
	
public function saveaprov()
	{
		# code...
		$nim = $_POST['nim_baru'];
		$apdekan = $_POST['apdekan'];
		$apakademik = $_POST['apakademik'];
		$apwarek = $_POST['apwarek'];

		foreach ($nim as $key => $value) {
			# code...
			$sql = "update ijazah set apdekan = '$apdekan[$key]', apakademik='$apakademik[$key]', apwarek='$apwarek[$key]' where nim = '$value'";
			//if($status[$key] == NULL){
				//echo $sql." kosong ga perlu update<br>";
			//}else{
				//echo $sql."<br>"; 
				
			//}

		$this->siak_model->siak_query("update", $sql);
		}

		 header('location: ' . URL . 'siak_cetak_ijazah');
	}
	
	

function ijazahok($nim){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['no_ijazah'] == "ijazah") {
				$this->siak_view->loads   = $value['loads'];
			}
		}
		$this->siak_view->nim = $nim;

	
		$query = "
			  select 
				  a.nim,
				  a.nama_depan,
				   a.nama_belakang,
				   a.tempat_lahir,
				   a.tanggal_lahir,
				   c.no_ijazah
				  
			  from 
				  data_pribadi_umum a,
				  mahasiswa b,
				  ijazah c
				  
				
			  where 
			  		a.nim=c.nim and
				  a.nim=b.nim and 
				 
				  a.nim='$_POST[x]'
			union
				select 
				  a.nim,
				  a.nama_depan,
				   a.nama_belakang,
				   a.tempat_lahir,
				   a.tanggal_lahir,
				   c.no_ijazah
				  
			  from 
				  data_pribadi_pns a,
				  mahasiswa b,
				  ijazah c
				  
				
			  where 
			  		a.nim=c.nim and
				  a.nim=b.nim and 
				 
				  a.nim='$_POST[x]'
				
			  ";

			  $query2 = "
			 select 			c.nim,
				  a.prodi,
				  a.prodi_id,
				   b.nama_belakang,
				   b.tempat_lahir,
				   d.fakultas_id,
				   d.fakultas
				  
			  from 
			  		prodi a,
				  data_pribadi_umum b,
				  mahasiswa c,
				  fakultas d
				  
				  
				
			  where 
			  	a.prodi_id=c.prodi_id and
				  c.nim=b.nim and 
				  a.fakultas_id=d.fakultas_id and
				 
				 
				  c.nim='$_POST[x]'

			union
				 select 			c.nim,
				  a.prodi,
				  a.prodi_id,
				   b.nama_belakang,
				   b.tempat_lahir,
				   d.fakultas_id,
				   d.fakultas
				  
			  from 
			  		prodi a,
				  data_pribadi_pns b,
				  mahasiswa c,
				  fakultas d
				  
				  
				
			  where 
			  	a.prodi_id=c.prodi_id and
				  c.nim=b.nim and 
				  a.fakultas_id=d.fakultas_id and
				 
				 
				  c.nim='$_POST[x]'

			  ";


			  
		$this->siak_view->data = $this->siak_model->siak_query("select", $query);
		$this->siak_view->data2 = $this->siak_model->siak_query("select", $query2);
		
		
				$this->siak_view->siak_render('siak_cetak_ijazah/ijazahok', false);
	}


public function ijazahku(){

		$this->siak_view->nim =$_POST['x'];

$query = "
			  select 
				  a.nim,
				  a.nama_depan,
				   a.nama_belakang,
				   a.tempat_lahir,
				   a.tanggal_lahir,
				   c.no_ijazah
				  
			  from 
				  data_pribadi_umum a,
				  mahasiswa b,
				  ijazah c
				  
				
			  where 
			  		a.nim=c.nim and
				  a.nim=b.nim and 
				 
				  a.nim='$_POST[x]'
			union
				select 
				  a.nim,
				  a.nama_depan,
				   a.nama_belakang,
				   a.tempat_lahir,
				   a.tanggal_lahir,
				   c.no_ijazah
				  
			  from 
				  data_pribadi_pns a,
				  mahasiswa b,
				  ijazah c
				  
				
			  where 
			  		a.nim=c.nim and
				  a.nim=b.nim and 
				 
				  a.nim='$_POST[x]'
				
			  ";

			  $query2 = "
			 select 			c.nim,
				  a.prodi,
				  a.prodi_id,
				   b.nama_belakang,
				   b.tempat_lahir,
				   d.fakultas_id,
				   d.fakultas
				  
			  from 
			  		prodi a,
				  data_pribadi_umum b,
				  mahasiswa c,
				  fakultas d
				  
				  
				
			  where 
			  	a.prodi_id=c.prodi_id and
				  c.nim=b.nim and 
				  a.fakultas_id=d.fakultas_id and
				 
				 
				  c.nim='$_POST[x]'

			union
				 select 			c.nim,
				  a.prodi,
				  a.prodi_id,
				   b.nama_belakang,
				   b.tempat_lahir,
				   d.fakultas_id,
				   d.fakultas
				  
			  from 
			  		prodi a,
				  data_pribadi_pns b,
				  mahasiswa c,
				  fakultas d
				  
				  
				
			  where 
			  	a.prodi_id=c.prodi_id and
				  c.nim=b.nim and 
				  a.fakultas_id=d.fakultas_id and
				 
				 
				  c.nim='$_POST[x]'

			  ";


			  
		$this->siak_view->data = $this->siak_model->siak_query("select", $query);
		$this->siak_view->data2 = $this->siak_model->siak_query("select", $query2);
		
		
        $this->siak_view->siak_render('siak_cetak_ijazah/ijazahku', true);
        
    }


}

?>