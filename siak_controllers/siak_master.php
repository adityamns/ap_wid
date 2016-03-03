<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_master extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		$this->siak_kalender();
	}

	function siak_universitas(){
		//Hak Akses
		$method_or_uri = $this->uri->getUri(3);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_view->siak_render('siak_master/universitas', false);
	}

	function siak_persiapan_kuliah(){
		//Hak Akses
		$method_or_uri = $this->uri->getUri(3);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_view->siak_render('siak_master/persiapan_kuliah', false);
	}


	function siak_nilai(){
		//Hak Akses
		$method_or_uri = $this->uri->getUri(3);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_view->siak_render('siak_master/nilai', false);
	}

	function siak_ruang(){
		//Hak Akses
		$method_or_uri = $this->uri->getUri(3);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_view->siak_render('siak_master/ruangan', false);
	}
	
	function siak_dosen_matakuliah(){
		//Hak Akses
		$method_or_uri = $this->uri->getUri(3);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_view->siak_render('siak_master/dosenmatakuliah', false);
	}

	function siak_tahun_akademik(){
		//Hak Akses
		$method_or_uri = $this->uri->getUri(3);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_view->siak_render('siak_master/tahun_akademik', false);
	}

	function siak_mahasiswa($nim, $jenis){
		$this->siak_view->config = "Siak Unhan - Detail Mahasiswa";
		
		$this->siak_view->judul = "Detail Mahasiswa";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Daftar Mahasiswa','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Detail Mahasiswa','href'=>'' .URL. 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis.''));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		//Hak Akses
// 		$method_or_uri = $this->uri->getUri(3);
		
		//URL diambil dari setting Modul dan sekarang untuk halaman yang mengarah dari siak_master belum dibuatkan Modul(tidak masuk dalam setting Modul)
		//Hasilnya URL diambil dari url induk
		
		//Misal untuk melihat detail mahasiswa, harus mengarahkan link ke siak_mahasiswa, baru tampil list dari Mahasiswa, dan ketika di klik Nim akan 
		//mengarahkan ke detail dimana URL detail ini dari siak_master/
		$method_or_uri = "siak_mahasiswa"; 
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->nim = $nim;
		$this->siak_view->jenis = $jenis;
		$this->siak_view->siak_render('siak_master/mahasiswa', false);
	}

	function siak_dosen($nip){
		$this->siak_view->config = "Siak Unhan - Detail Dosen";
		
		$this->siak_view->judul = "Detail Dosen";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Daftar Dosen','href'=>'' .URL. 'siak_dosen'));
		$this->siak_breadcrumbs->add(array('title'=>'Detail Dosen','href'=>'' .URL. 'siak_master/siak_mahasiswa/'.$nip.''));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		//Hak Akses
// 		$method_or_uri = $this->uri->getUri(3);
		$method_or_uri = "siak_dosen";
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->nip = $nip;
		$this->siak_view->siak_render('siak_master/dosen', false);
	}

	function siak_kalender(){
		$this->siak_view->tahun = $_GET['tahun'];
		$this->siak_view->siak_render('siak_master/kalender', false);
	}
	function siak_event(){
		//Hak Akses
		$method_or_uri = $this->uri->getUri(3);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_view->siak_render('siak_event/data', false);
	}

}

?>