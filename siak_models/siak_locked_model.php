<?php

/**
* 
*/
class Siak_locked_model extends Siak_model{
	
	function __construct(){
		parent::__construct();
	}

	public function siak_run_lock(){
		parent::siak_locked();
	}
}

?>