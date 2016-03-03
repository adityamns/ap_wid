<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_transkrip_nilai extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "yudisium" && $value['kode'] == "siak_transkrip_nilai") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
			$this->siak_view->config = "Siak Widyatama - Lihat Transkrip per Prodi";
	
		$this->siak_view->judul = "Lihat Transkrip Per Prodi";
		
		$this->siak_breadcrumbs->add(array('title'=>'Yudisium','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Lihat Transkrip Per Prodi','href'=>''. URL . 'yudisium/lihat transkrip per prodi'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		$this->siak_view->cohort = $this->siak_model->siak_query("select", "select cohort from cohort group by cohort order by cohort asc");
		$this->siak_view->siak_render('siak_transkrip_nilai/index', false);
	}
	
	public function cohort($cohort_id){
		
		$this->siak_view->data_prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->siak_render('siak_transkrip_nilai/prodi', true);
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
		$this->siak_view->siak_render('siak_transkrip_nilai/tabel', true);
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
		$this->siak_view->siak_render('siak_transkrip_nilai/transkripprodi', true);
	}
	
	
}

?>