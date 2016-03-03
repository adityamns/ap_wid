<?php

/* Siak help controller class */

class Siak_help extends Siak_controller {
	
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->siak_view->siak_render('siak_help/index', false);
		// parent::siak_render('Siak_help/index', false);
	}

	public function test($var,$var2,$var3){
		echo $var.$var2.$var3;
		$this->siak_view->blah = $this->siak_model->blah();
	}
}
?>