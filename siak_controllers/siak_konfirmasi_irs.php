<?php if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Siak_konfirmasi_irs extends Siak_controller{
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}
	
	function index(){
		$nim = $_POST['nim'];
		if($nim == TRUE){
			$where = "where nim = '$nim'";
		}
		
		$sql = "select * from mahasiswa $where";
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render("konfirmasi_irs/index", false);
	}
}