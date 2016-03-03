<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_persiapan_kuliah extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->Siak_persiapan_kuliah();
	}

	function siak_dosen_matakuliah(){
		$this->siak_view->siak_render('siak_persiapan_kuliah/dosen_matakuliah', false);
	}

	function siak_kalender_akademik(){
		$this->siak_view->siak_render('siak_persiapan_kuliah/kalender_akademik', false);
	}

	function siak_kalender(){
		$this->siak_view->tahun = $_GET['tahun'];
		//var_dump($this->siak_view->tahun);
		$this->siak_view->siak_render('siak_master/kalender', false);
	}
}

?>