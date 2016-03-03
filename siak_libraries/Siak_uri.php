<?php

/* Main Siak Paginator Class */

class Siak_Uri{
	public function __construct(){
// 		parent::__construct();
	}
	
	public function curPage() {
	
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		
		return explode('/',$pageURL);
	}
	
	function getUri($c){
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$l = strlen(URL);
		$res = substr($pageURL, ($l-1));
		$res = explode("/",$res);
		return $res[$c];
	}
	
	function getRolePage($data, $uri){
	
		foreach ($data as $key => $value) {
			if($uri == $value['url']){
				$RolePage['url_modul'] = $value['url'];
				$RolePage['loads'] = $value['loads'];
				$RolePage['creates'] = $value['creates'];
				$RolePage['reades'] = $value['reades'];
				$RolePage['updates'] = $value['updates'];
				$RolePage['deletes'] = $value['deletes'];
				$RolePage['prodi_id'] = $value['prodi_id'];
			}
		}
		
		return $RolePage;
	}
}