<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak pengaturan controller class */

class Siak_pengaturan extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
		
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Setting Hak Akses User";
	
		$this->siak_view->judul = "Setting Hak Akses User";
		
		$this->siak_breadcrumbs->add(array('title'=>'Setting Hak Akses User','href'=>''. URL . 'siak_pengaturan'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		//Hak Akses
		$method_or_uri = 'siak_pengaturan';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_user();
	}

	function siak_user(){
		
		
// 		$this->siak_view->role = $this->siak_uri->getRolePage($this->url_modul, $this->loads);
		$this->siak_view->siak_render('siak_pengaturan/users', false);
	}

}

?>