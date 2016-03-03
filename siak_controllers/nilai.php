<?php if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Nilai extends Siak_controller{
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}
	
	function index($page = false){
		$this->siak_view->msg = "The page doesn't exists";
		$this->siak_view->siak_render('siak_error/index', false);
	}
	
	/// UAS
	function uas(){
		$this->siak_view->config = "Siak Unhan - Ujian Akhir Semester";
	
		$this->siak_view->judul = "Ujian Akhir Semester";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Penilaian','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Nilai Ujian Akhir Semester','href'=>''. URL . 'uas'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$method_or_uri = 'nilai/uas';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		
		$this->siak_view->page = 'uas';
		$this->siak_view->siak_render("lihat_nilai/index", false);
	}
	///
	
	/// UTS
	function uts(){
		$this->siak_view->config = "Siak Unhan - Ujian Tengah Semester";
		$this->siak_view->judul = "Ujian Tengah Semester";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Lihat Nilai','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Nilai Ujian Tengah Semester','href'=>''. URL . 'uas'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$method_or_uri = 'nilai/uts';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		
		$this->siak_view->page = 'uts';
		$this->siak_view->siak_render("lihat_nilai/index", false);
	}
	///
	
	
	function cek_nilai($nim,$semester,$page){

		$where1 = array('nim' => $nim);
		$where2 = array('nim' => $nim ,'semester' => $semester);
				
		$prodi = $this->siak_model->siak_edit($where1, "mahasiswa", "*");
				
		foreach ($prodi as $key => $value) {
			$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semester);
		}
				
		$this->siak_view->data = $this->siak_model->siak_edit($kondisi, "matakuliah", "*");
		
		$this->siak_view->nim = $nim;
		$this->siak_view->smstr = $semester;
		
		if($page == 'uas'){
			$this->siak_view->siak_render('lihat_nilai/uas', true);
		}else if($page == 'uts'){
			$this->siak_view->siak_render('lihat_nilai/uts', true);
		}
	}
}