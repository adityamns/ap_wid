<?php

/* Siak absensi pembekalan mahasiswa model class */

class siak_batasan_waktu_nilai_model extends Siak_model{
	
	function __construct(){
		parent::__construct();
		$this->table = "batasan_waktu_nilai";
	}

}

?>