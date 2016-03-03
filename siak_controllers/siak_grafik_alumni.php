<?php

/* Siak dashboard controller class */

class Siak_grafik_alumni extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->id_user = Siak_session::siak_get('id');
		$this->siak_breadcrumbs->add(array('title'=>'Alumni / Grafik Alumni','href'=>'' . URL . 'siak_grafik_alumni'));
	}

	function index(){
			$this->siak_view->config = 'Siak Widyatama - Grafik Alumni';
			
			$this->siak_breadcrumbs->add(array('title'=>'','href'=>'#'));
	
			if($_GET['tahun1']){
				$tahun=$_GET['tahun1'];
			}
			
		
		$this->siak_view->siak_tahun = $this->siak_model->siak_query("select", "select tahun_masuk from alumni group by tahun_masuk order by tahun_masuk asc");
	
		$this->siak_view->siak_prodi = $this->siak_model->siak_query("select","select prodi_id,count(nim) as jumlah from alumni where tahun_masuk='$tahun' group by prodi_id");
		$this->siak_view->jtahun=$tahun;
		
		
		$this->siak_view->judul = "Grafik Alumni";
		
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());

		$this->siak_view->siak_render('siak_grafik_alumni/index', false);
		
	}

}

?>