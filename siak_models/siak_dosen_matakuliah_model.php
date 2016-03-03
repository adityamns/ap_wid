<?php

/* Siak umahasiswa model class */

class Siak_dosen_matakuliah_model extends Siak_model{
	
	function __construct(){
		parent::__construct();
		$this->table = "dosen_matakuliah";
	}

}

?>