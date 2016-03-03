<?php

/* Main Siak Session Class */

class Siak_session{
	
	function __construct(){

	}

	public static function siak_init(){
		@session_start();
	}

	public static function siak_set($key, $value){
		$_SESSION[$key] = $value;
	}

	public static function siak_get($key){
		if (isset($_SESSION[$key]))
		return $_SESSION[$key];
	}

	public static function siak_getAll(){
		return $_SESSION['rule'];
	}

	public static function siak_destroy(){
		// unset($_SESSION);
		session_destroy();
	}

}

?>