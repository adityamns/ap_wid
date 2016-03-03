<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak data absensi controller class */

class Siak_data_absensi extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Hak Akses
		$method_or_uri = 'siak_data_absensi';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_datalist();
	}

	public function siak_datalist(){	
		$nip 		= $_SESSION['username'];	
		$now		= date('Y-m-d H:i:s');
		$tgl_now 	= date("Y-m-d");
		
		$this->siak_view->config = "Siak Widyatama - Data Absensi";
		$this->siak_view->judul = "Data Absensi";
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Absensi','href'=>''. URL . 'siak_data_absensi'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		if(isset($_POST['tanggal'])){
			$tgl_now 	= $_POST['tanggal'];
			$tgl_awal 	= $tgl_now." 07:00:00";
			$tgl_akhir 	= $tgl_now." 23:00:00";
			if($nip != "admin"){
				$data_query = "select a.*,b.nama_depan from absensi a,data_pribadi_umum b where a.nim = b.nim and a.tanggal between '".$tgl_awal."' and '".$tgl_akhir."' and a.dosen_utama = '".$nip."'";
				$this->siak_view->siak_data_list = $this->siak_model->siak_query("select",$data_query);
			}else{
				$data_query = "select a.*,b.nama_depan from absensi a,data_pribadi_umum b where a.nim = b.nim and a.tanggal between '".$tgl_awal."' and '".$tgl_akhir."' order by a.nim asc";
				$this->siak_view->siak_data_list = $this->siak_model->siak_query("select",$data_query);
			}
		}else{	
			$tgl_awal 	= $tgl_now." 07:00:00";
			if($nip != "admin"){
				$data_query = "select a.*,b.nama_depan from absensi a,data_pribadi_umum b where a.nim = b.nim and a.tanggal between '".$tgl_awal."' and '".$now."' and a.dosen_utama = '".$nip."'";
				$this->siak_view->siak_data_list = $this->siak_model->siak_query("select",$data_query);
			}else{
				$data_query = "select a.*,b.nama_depan from absensi a,data_pribadi_umum b where a.nim = b.nim and a.tanggal between '".$tgl_awal."' and '".$now."' order by a.nim asc";
				$this->siak_view->siak_data_list = $this->siak_model->siak_query("select",$data_query);
			}
		}
		
		$this->siak_view->siak_render('siak_data_absensi/data', false);
	}

	public function siak_add(){
		$this->siak_view->status_gedung = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_render('siak_data_absensi/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_data_absensi');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->status_ruang = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "absensi", "*");
		$this->siak_view->siak_render('siak_data_absensi/edit', true);
	}

	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_data_absensi');
	}

	public function siak_detail($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "absensi", "*");
		$this->siak_view->siak_render('siak_data_absensi/view', false);
	}
	
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_gedung');
	}

}

?>