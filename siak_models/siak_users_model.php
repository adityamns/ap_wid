<?php

/* Siak user model class */

class Siak_users_model extends Siak_model{
	
	function __construct(){
		parent::__construct();
		$this->table = "users";
	}
	
}

?>