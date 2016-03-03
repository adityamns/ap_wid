<?php if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Uas extends Siak_controller{
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}
	
	function index(){
		$this->siak_view->config = "Siak Widyatama - Ujian Akhir Semester";
	
		$this->siak_view->judul = "Ujian Akhir Semester";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Penilaian','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Nilai Ujian Akhir Semester','href'=>''. URL . 'uas'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		
		$this->siak_view->siak_render("uas/index", false);
	}
	
	function cek_nilai($nim,$semester){
		
		$where1 = array('nim' => $nim);
		$where2 = array('nim' => $nim ,'semester' => $semester);
				
		$prodi = $this->siak_model->siak_edit($where1, "mahasiswa", "*");
				
		foreach ($prodi as $key => $value) {
			$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semester);
		}
				
		$this->siak_view->data = $this->siak_model->siak_edit($kondisi, "matakuliah", "*");
		
		$this->siak_view->nim = $nim;
		$this->siak_view->smstr = $semester;
		
		$this->siak_view->siak_render('uas/uas', true);
	}
}