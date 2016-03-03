<?php

/* Siak user model class */

class Siak_penilaian_absen_model extends Siak_model{
	
	function __construct(){
		parent::__construct();
		$this->table = "nilai_mahasiswa";
	}
	
}

?>