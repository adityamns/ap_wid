<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Atur Pembekalan controller class */

class Siak_atur_pembekalan extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "pembekalan" && $value['kode'] == "pengampu_pembekalan") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();
	}

	/*function index(){
		$this->siak_datalist();
	}*/

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("atur_pembekalan", "*");
		$this->siak_view->siak_ruang = $this->siak_model->siak_data_list("ruang", "*");
		$this->siak_view->siak_materi = $this->siak_model->siak_data_list("materi_pembekalan", "*");
		$this->siak_view->siak_render('siak_atur_pembekalan/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_ruang = $this->siak_model->siak_data_list("ruang", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("materi_pembekalan", "materi_id,materi,prodi_id");
		$this->siak_view->siak_render('siak_atur_pembekalan/add', true);
	}

	public function siak_create(){
		$absensi = $this->siak_model->siak_query("select", "SELECT * from absensi_pembekalan Where materi_id = '".$_POST['materi_id']."' ;");
		if (sizeof($absensi) > 0) {
			$nim = "AND(a.nim != ";
			foreach ($absensi as $key => $vals) {
				$nim .= "'".$vals['nim']."' AND a.nim != ";
			}
			$nim  =  substr($nim, 0, sizeof($nim) -15);
			$nim .= ")";
		}else{
			$nim = " AND a.pembekalan = 1";
		}

		// echo $nim;
		$this->siak_model->siak_create();
		if ($_POST['prodi_id']!="") {
			$prodi = explode(',', $_POST['prodi_id']);
			foreach ($prodi as $key) {
				$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$key."' $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$key."' $nim ORDER BY nim ASC LIMIT ".$_POST['jumlah_mhs'].";");
			}
		}elseif ($_POST['prodi_id']=="") {
			$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id $nim ORDER BY nim ASC LIMIT ".$_POST['jumlah_mhs'].";");
			// echo "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id $nim ORDER BY nim ASC LIMIT ".$_POST['jumlah_mhs'].";";
		}
		// var_dump($this->siak_view->siak_data_list);
		// die();
		foreach ($this->siak_view->siak_data_list as $key => $value) {
			$this->siak_model->siak_query("insert","insert into absensi_pembekalan (nim,materi_id,ruang_id,tanggal,status) values ('".$value['nim']."','".$_POST['materi_id']."', '".$_POST['ruang_id']."', NULL, 1);");
			// $this->siak_model->siak_query("update","update mahasiswa set pembekalan=3 where nim = '".$value['nim']."';");
		}
		// die();
		header('location: ' . URL . 'siak_atur_pembekalan');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("materi_pembekalan", "materi_id,materi");
		$this->siak_view->siak_ruang = $this->siak_model->siak_data_list("ruang", "*");
		$this->siak_view->siak_materi = $this->siak_model->siak_data_list("materi_pembekalan", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "atur_pembekalan", "*");
		$this->siak_view->siak_render('siak_atur_pembekalan/edit', true);
	}
	
	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_atur_pembekalan');
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_atur_pembekalan');
	}

	public function kapasitas($ruang_id){
		$where = array('ruang_id' => $ruang_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "ruang", "kapasitas");
		$this->siak_view->siak_render('siak_atur_pembekalan/kapasitas', true);
	}

	public function prodi($materi_id){
		$where = array('materi_id' => $materi_id);
		$siak_data = $this->siak_model->siak_edit($where, "materi_pembekalan", "prodi_id");
		foreach ($siak_data as $key => $value) {
			echo "<input type='hidden' name='prodi_id' value='".$value['prodi_id']."'>";
		}
	}
}

?>