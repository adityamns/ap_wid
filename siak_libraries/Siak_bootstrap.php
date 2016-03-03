<?php

/*  */

class Siak_bootstrap{
	
	function __construct(){
		
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);

		if (empty($url[0])) {
			require 'siak_controllers/siak_index.php';
			$siak_controller = new siak_index();
			$siak_controller->index();
			return false;
		}

		$file = 'siak_controllers/' . $url[0] . '.php';
		if (file_exists($file)) {
			require $file;
		}else{
			$this->error();
		}


		$siak_controller = new $url[0];
		$siak_controller->siak_load_model($url[0]);

		// Calling methods
		$method = "$url[1](";
		for ($i=2; $i <= count($url); $i++) {
			if ($i != count($url)) {
				if ($i > 2) {
					$method .= ",";
				}
					$method .= "'$url[$i]'";
			}
		}
		$method .= ");";
		
		if (isset($url[2])) {
			if (method_exists($siak_controller, $url[1])) {
				$ads = '$siak_controller->'.$method.'';
				eval($ads);
			}else{
				$this->error();
			}
		}else{
			if (isset($url[1])) {
				if (method_exists($siak_controller, $url[1])) {
					$siak_controller->{$url[1]}();
				}else{
					$this->error();
				}
			}else{
				$siak_controller->index();
			}
		}
	}

	function error(){
		require 'siak_controllers/siak_error.php';
		$siak_controller = new Siak_error();
		$siak_controller->index();
		return false;
	}

}

?>