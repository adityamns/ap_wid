<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_kelulusan extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "yudisium" && $value['kode'] == "siak_kelulusan") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_view->config = "Siak Widyatama - Penilaian Kelulusan - Predikat Kelulusan";
	
		$this->siak_view->judul = "Penilaian Kelulusan - Predikat Kelulusan";
		
		$this->siak_breadcrumbs->add(array('title'=>'Yudisium','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Penilaian Kelulusan - Predikat Kelulusan','href'=>''. URL . 'Yudisium/Predikat Kelulusan'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		$this->siak_view->cohort = $this->siak_model->siak_query("select", "select cohort from cohort group by cohort order by cohort asc");
		$this->siak_view->siak_render('siak_kelulusan/index', false);
	}
	
	public function cohort($cohort_id){
		
		$this->siak_view->data_prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->siak_render('siak_kelulusan/prodi', true);
	}
	
	function getbobot($cohort_id,$prodi_id){
		$this->siak_view->cohort     = $cohort_id;
		$this->siak_view->prodi    = $prodi_id;
		
		$this->siak_view->laporan = $this->siak_model->siak_query("select", "SELECT  
					a.nim,
				 	a.ipk,
				 	a.cohort,
					a.prodi_id,
				 	a.predikat,
				 	a.ket,
				 	a.status,
				 	a.tahun_lulus,
				 	b.tahun_masuk,
				 	(a.tahun_lulus - b.tahun_masuk)as kurangan 

			from 	transkrip_nilai a,
					cohort b,
					prodi c 

			where 	a.cohort=b.cohort and
			 		a.prodi_id=c.prodi_id and
			 		b.prodi_id=c.prodi_id and
			 		b.cohort='$cohort_id' and
					c.prodi_id='$prodi_id'
					 
			order by kurangan asc ,a.ipk desc
					");
		$this->siak_view->siak_render('siak_kelulusan/tabel', true);
	}
	

	public function simpanstatus()
	{
		# code...
		$nim = $_POST['nim_baru'];
		$status = $_POST['status'];
		$ket=$_POST['ket'];

		foreach ($nim as $key => $value) {
			# code...
			$sql = "update transkrip_nilai set status = '$status[$key]', ket='$ket[$key]' where nim = '$value'";
			//if($status[$key] == NULL){
				//echo $sql." kosong ga perlu update<br>";
			//}else{
				//echo $sql."<br>"; 
				
			//}

		$this->siak_model->siak_query("update", $sql);
		}

		 header('location: ' . URL . 'siak_kelulusan');
	}
	
}

?>