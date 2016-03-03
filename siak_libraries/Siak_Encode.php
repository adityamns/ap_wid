<?php

class Siak_Encode{
	public function __construct(){
// 		parent::__construct();
	}
	
	public function siakB64en($enc){
		$base_64 = base64_encode($enc);
		$nomor = rtrim($base_64, '=');
		return $nomor;
	}
	
	public function siakB64de($enc){
		$base_64 = $enc . str_repeat('=', strlen($enc) % 4);
		$nomor = base64_decode($base_64);
		return $nomor;
	}
}