<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak pengaturan controller class */

class Siak_pengaturan extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
		
			$this->loads[] = $value['loads'];
// 			$this->creates = $value['creates'];
// 			$this->reades  = $value['reades'];
// 			$this->updates = $value['updates'];
// 			$this->deletes = $value['deletes'];
// 			$this->nama_modul = $value['nama_modul'];
			$this->url_modul[] = $value['url'];
// 			$this->prodi_id = $value['prodi_id'];
				
		}
		
		$this->size_url_modul = sizeof($this->url_modul);
// 		echo "<pre>";
// 		var_dump($this->siak_session->siak_getAll());
// 		echo "<pre>";
// 		die();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Setting Hak Akses User";
	
		$this->siak_view->judul = "Setting Hak Akses User";
		
		$this->siak_breadcrumbs->add(array('title'=>'Setting Hak Akses User','href'=>''. URL . 'siak_pengaturan'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_user();
	}

	function siak_user(){
		$c = $this->size_url_modul;
		for($i=0;$i<$c;$i++){
			if(){
				$this->siak_view->url_modul = $this->url_modul;
			}
		}
		$this->siak_view->loads = $this->loads;
		$this->siak_view->siak_render('siak_pengaturan/users', false);
	}

}

?>