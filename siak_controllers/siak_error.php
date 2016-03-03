<?php

/* Siak error controller class */

class Siak_error extends Siak_controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->siak_view->msg = "The page doesn't exists";
		$this->siak_view->siak_render('siak_error/index', false);
	}

	public function memcache(){
		// $mem = new Memcache();
	}

}

?>