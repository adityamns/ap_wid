<?php

/* Siak user model class */

class Download_model extends Siak_model{
	
	function __construct(){
		parent::__construct();
		$this->table = "upload";
	}
	
}
