<?php

/* Siak user model class */

class Siak_home_model extends Siak_model{
	
	function __construct(){
		parent::__construct();
		$this->table = "nilai_mahasiswa";
	}
	
}

?>