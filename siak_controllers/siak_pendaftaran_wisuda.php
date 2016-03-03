<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_pendaftaran_wisuda extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		
		$this->siak_view->config = "Siak Widyatama - Pendaftaran Wisuda";
	
		$this->siak_view->judul = "Pendaftaran Wisuda";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Wisuda','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Pendaftaran Wisuda','href'=>''. URL . 'siak_pendaftaran_wisuda'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
	
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "wisuda" && $value['kode'] == "pendaftaran_wisuda") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->loads  = $value['loads'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();	
	}

	public function siak_datalist(){
		/*echo "asdasd";die();*/
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("pendaftaran_wisuda", "*");
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/data', false);
	}

	public function siak_add(){
		//$this->siak_view->no_pendaftaran=101;
		$this->siak_view->gelombang = $this->siak_model->siak_data_list("gelombang_wisuda", "nama,kode");
		$this->siak_view->siak_data_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/add', true);
	}
	
	function data_verifikasi(){
	
		$sql = "select * from syarat_wisuda group by nim";
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/data_verifikasi', false);
	}
	
	function verifikasi(){
	
		$sql = "select * from dok_syarat_wisuda";
		$this->siak_view->syarat = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/verifikasi', false);
	}
	
	function verifikasi_insert(){
	
		$nim = $_POST['nim'];
		$count = $_POST['count'];
		$ket = $_POST['keterangan'];
		$id = $_POST['id'];
		$tgl = $_POST['tgl_kumpul'];
		foreach($tgl as $tang => $gal){
			$x = explode("-",$gal);
			$tes[] = $x[2]."-".$x[1]."-".$x[0];
			// $asd[] = $gal;
		}
		//echo var_dump($tes);die();
		$cek_syarat = $_POST['cek_syarat'];
		
		foreach($count as $row => $jml){
			//$x = explode("-",$tgl);
			//$y = $x[2]."-".$x[1]."-".$x[0];
			// echo var_dump($tgl);die();
		    $sql2 = "insert into syarat_wisuda(nim, keterangan, dok_syarat_wisuda_id, tgl_penyerahan, cek) values('$nim', '$ket[$row]', '$id[$row]', '$tes[$row]', '$cek_syarat[$row]')";
// 		    echo $sql2."<br>";
// echo var_dump($sql2);die();
		    $this->siak_model->siak_query("insert", $sql2);
		}
// 		die();
		header('location: ' . URL . 'siak_pendaftaran_wisuda');
	}

	public function siak_create(){
		$nim = $_POST['nim'];
		$gelombang = $_POST['gelombang'];
		$prodi_id = $_POST['prodi_id'];
		// $tgl_wisuda = $_POST['tanggal_wisuda'];
		$tgl_mulai_wisuda = $_POST['tanggal_mulai_wisuda'];
		$tgl_selesai_wisuda = $_POST['tanggal_selesai_wisuda'];
	
		
		// $sql1 = "insert into pendaftaran_wisuda(nim, gelombang_wisuda, prodi_id, tanggal_wisuda) values('$nim', '$gelombang', '$prodi_id', '$tgl_wisuda')";
		$sql1 = "insert into pendaftaran_wisuda(nim, gelombang_wisuda, prodi_id, tanggal_mulai_wisuda,tanggal_selesai_wisuda) values('$nim', '$gelombang', '$prodi_id', '$tgl_mulai_wisuda','$tgl_selesai_wisuda')";
// 		echo $sql1."<br>";
		$this->siak_model->siak_query("insert",$sql1);

// 		die();
		
		header('location: ' . URL . 'siak_pendaftaran_wisuda');
	}

	public function siak_edit($wisuda_id){
		$where = array('wisuda_id' => $wisuda_id);
		$this->siak_view->gelombang = $this->siak_model->siak_data_list("gelombang_wisuda", "nama,kode");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_wisuda", "*");
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/edit', true);
	}
	public function siak_detail($wisuda_id){
		$where = array('wisuda_id' => $wisuda_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_wisuda", "*");
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/view', false);
	}

	public function siak_edit_save($wisuda_id){
		$where = array('wisuda_id' => $wisuda_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pendaftaran_wisuda');
	}

	public function siak_delete($wisuda_id){
		$where = array('wisuda_id' => $wisuda_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pendaftaran_wisuda');
	}
	
	function gelombang($kode){
		$sql = "select * from gelombang_wisuda where kode = '$kode'";
		$data = $this->siak_model->siak_query("select", $sql);
// 		var_dump($kode);die();
		foreach($data as $row => $key){
		      $tgl = $key['tanggal_mulai']." s/d ".$key['tanggal_selesai'];
		}
		
		$this->siak_view->tgl = $tgl;
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/tgl_wisuda', true);
	}
	
	function cek_mhs($nim){
		$jml_syarat = "select count(id) from dok_syarat_wisuda";
		$hasil1 = $this->siak_model->siak_query("select", $jml_syarat);
		$fix = $hasil1[0]['count'];
		
		$count_syarat_from = "SELECT count(CASE WHEN cek THEN 1 ELSE null END) FROM syarat_wisuda where nim = '$nim'";
		$hasil2 = $this->siak_model->siak_query("select", $count_syarat_from);
		$aktual = $hasil2[0]['count'];
		
		echo ($fix != $aktual)? "<div class='alert alert-danger'>Jumlah != data[ ".$aktual." ]</div>":"<div class='alert alert-danger'>Jumlah == data[ ".$aktual." ]</div>";
		
	}
	
	public function pdf(){
		$this->siak_view->siak_data = $this->siak_model->siak_data_list("pendaftaran_wisuda","*");
		$this->siak_view->siak_render('siak_pendaftaran_wisuda/pdf', true);
	}

}

?>