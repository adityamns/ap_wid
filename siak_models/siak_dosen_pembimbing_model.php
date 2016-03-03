<?php

/* Siak umahasiswa model class */

class Siak_dosen_pembimbing_model extends Siak_model{
	
	function __construct(){
		parent::__construct();
		$this->table = "aturan_nilai";
	}

}

?>