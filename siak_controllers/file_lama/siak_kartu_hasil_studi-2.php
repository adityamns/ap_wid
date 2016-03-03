<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak rencana_studi controller class */

class Siak_kartu_hasil_studi extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}
	
	
	function index(){
		$this->siak_view->siak_render('siak_kartu_hasil_studi/index', false);
	}

	public function siak_cek($nim){
		$where = array('nim' => $nim);
				
		$prodi = $this->siak_model->siak_edit($where, "mahasiswa", "prodi_id");
		foreach ($prodi as $key => $value) {
			$kondisi = array('prodi_id' => $value['prodi_id']);
		}
		$this->siak_view->data = $this->siak_model->siak_edit($kondisi, "matakuliah", "*");
		$this->siak_view->siak_render('siak_kartu_hasil_studi/ikhs', true);
	}
	
	public function siak_ok(){
		$this->siak_view->siak_data = $this->siak_model->siak_query("update", "UPDATE mahasiswa set semester = '".$_POST['semester']."', status = 1 WHERE nim = ".$_POST['nim']."; ");
		header('location: ' . URL . 'siak_rencana_studi');
	}

	public function asd(){
		echo "string";
	}
}

?>