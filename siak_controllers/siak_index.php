<?php

/* Siak index controller class */

class Siak_index extends Siak_controller{
	
	function __construct(){
		$this->css = array('siak_views/siak_login/css/default.css');
		parent::__construct();
	}

	function index(){
		header('location: ' . URL . 'siak_login/');
		// $this->siak_view->siak_render('siak_login/index', false);
		// parent::siak_render('siak_index/index', true);
	}

}

?>