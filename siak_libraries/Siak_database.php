<?php

/**/

class Siak_database extends PDO{
	
	function __construct(){
		parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
	}
}

?>