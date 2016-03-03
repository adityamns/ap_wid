<?php

class Siak_izin extends Siak_controller{
	function __construct(){
		  parent::__construct();
		  parent::siak_logstat();
		  $this->siak_roles();
	  
	}
	
	function upload($nim, $tgl){
		echo $nim." + ".$tgl;
	}
  
}