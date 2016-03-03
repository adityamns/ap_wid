<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_aproval_ijazah extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "yudisium" && $value['kode'] == "siak_aproval_ijazah") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
			$this->siak_view->config = "Siak Unhan - Aproval Ijazah";
	
		$this->siak_view->judul = "Aproval Ijazah";
		
		$this->siak_breadcrumbs->add(array('title'=>'Ijazah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Aproval Ijazah','href'=>''. URL . 'ijazah/aproval ijazah'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		$this->siak_view->cohort = $this->siak_model->siak_query("select", "select cohort from cohort group by cohort order by cohort asc");
		$this->siak_view->siak_render('siak_aproval_ijazah/index', false);
	}
	
	public function cohort($cohort_id){
		
		$this->siak_view->data_prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->siak_render('siak_aproval_ijazah/prodi', true);
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
			a.prodi_id='".$prodi_id."' and
			 b.cohort='".$cohort_id."'

			
			 
			
					");
		$this->siak_view->cohort = $cohort_id;
		$this->siak_view->prodi = $prodi_id;
		$this->siak_view->siak_render('siak_aproval_ijazah/tabel', true);
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

		 header('location: ' . URL . 'siak_aproval_ijazah');
	}
	
	
}

?>