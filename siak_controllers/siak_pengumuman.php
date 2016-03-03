	<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Aturan Nilai controller class */

class Siak_pengumuman extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//var_dump($this->siak_session->siak_getAll());die();
		//Hak Akses
		$method_or_uri = 'siak_pengumuman';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_datalist();
		
	}

	public function siak_datalist(){
		$this->siak_view->config = "Siak Widyatama - Data Kegiatan";
	
		$this->siak_view->judul = "Data Kegiatan";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Kegiatan','href'=>''. URL . 'siak_pengumuman'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("agenda_acara", "*");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_pengumuman/data', false);
	}

	public function siak_add(){
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->cohort = $this->siak_model->siak_data_list("cohort", "id_cohort,cohort");
		$this->siak_view->kategori = $this->siak_model->siak_data_list("kategori_pengumuman", "kategori_id,jenis_kategori");
		$this->siak_view->siak_render('siak_pengumuman/add', true);
	}

	public function siak_create(){
		//var_dump($_POST);die();
		$kategori = $_POST['kategori_id'];
		$status = $_POST['status'];
		$info = $_POST['pengumuman'];
		$judul = $_POST['judul'];
		$mulai = $_POST['tanggal_mulai'];
		$akhir = $_POST['tanggal_akhir'];
		
		$_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		$_POST['id_cohort']= implode(',',$_POST['id_cohort']);

		if($kategori==1){
			$this->siak_model->siak_query("insert", "insert into agenda_acara ( judul, kategori_id, isi_acara, tanggal_mulai, status) VALUES ('$judul', '$kategori', '$info', '$mulai', '$status')");
			//echo "insert into agenda_acara ( judul, kategori_id, isi_acara, tanggal_mulai, status) VALUES ( '$judul', '$kategori', '$info', '$mulai', '$status')";die();
		}else{
			$this->siak_model->siak_query("insert", "insert into agenda_acara ( judul, kategori_id, isi_acara, tanggal_mulai, tanggal_akhir, prodi_id, id_cohort,status) VALUES ( '$judul', '$kategori', '$info', '$mulai', '$akhir','".$_POST['prodi_id']."','".$_POST['id_cohort']."','$status')");
// 			echo "insert into agenda_acara ( judul, kategori_id, isi_acara, tanggal_mulai, tanggal_akhir, prodi_id, id_cohort,status) VALUES ( '$judul', '$kategori', '$info', '$mulai', '$akhir','".$_POST['prodi_id']."','".$_POST['id_cohort']."','$status')";die();
		}
		//echo "insert into pengumuman ( prodi_id, id_cohort, pengumuman, tanggal_awal, tanggal_akhir,status) VALUES ( '".$_POST['prodi_id']."','".$_POST['id_cohort']."','$info','$mulai','$akhir','$status')";die();
		//$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pengumuman');
	}

	public function siak_edit($acara_id, $kategori){
// 		echo $acara_id;die();
		//echo "halol".'$pengumuman_id';die();
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT * FROM agenda_acara WHERE acara_id = '$acara_id'");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->cohort = $this->siak_model->siak_data_list("cohort", "id_cohort,cohort");
		$this->siak_view->kategori = $this->siak_model->siak_data_list("kategori_pengumuman", "kategori_id,jenis_kategori");
		
		if($kategori == 1){
		      $this->siak_view->siak_render('siak_pengumuman/edit', true);
		}else{
		      $this->siak_view->siak_render('siak_pengumuman/edit2', true);
		}
	}
	public function siak_edit_save($acara_id){
		
		$judul = $_POST['judul'];
		$kategori = $_POST['kategori_id'];
		$mulai = $_POST['tanggal_mulai'];
		$akhir = $_POST['tanggal_akhir'];
		$info = $_POST['pengumuman'];
		$status = $_POST['status'];
		
		$_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		$_POST['id_cohort'] = implode(',',$_POST['id_cohort']);
		
		$sql_up = "update set judul = '$judul', kategori_id = '$kategori', isi_acara = '$info', tanggal_mulai = '$mulai', status = '$status', tanggal_akhir = '$akhir', prodi_id = '".$_POST['prodi_id']."', id_cohort = '".$_POST['id_cohort']."' where acara_id = '$acara_id'";
		$sql_up2 = "update set judul = '$judul', kategori_id = '$kategori', isi_acara = '$info', tanggal_mulai = '$mulai', status = '$status' where acara_id = '$acara_id'";
		
		if($kategori == 1){
		      $update =  $sql_up2;
		}else{
		      $update = $sql_up;
		}
		
// 		echo $update;
		$this->siak_model->siak_query("update", $update);
		header('location: ' . URL . 'siak_pengumuman');
	}

	public function siak_detail($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "aturan_nilai", "*");
		$this->siak_view->siak_render('siak_pengumuman/view', false);
	}

	public function siak_delete($nilai_id){
		$where = array('nilai_id' => $nilai_id);
		
		$sql = "delete from agenda_acara where acara_id = '$nilai_id'";
		$this->siak_model->siak_query("delete", $sql);
// 		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pengumuman');
	}

	public function check_form($kategori_id){
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->cohort = $this->siak_model->siak_data_list("cohort", "id_cohort,cohort");
		if($kategori_id == '1'){
			$this->siak_view->siak_render('siak_pengumuman/umum', true);
		}else{
			$this->siak_view->siak_render('siak_pengumuman/berita', true);
		}
	}
	
	public function cohort($prodi){
		//var_dump($prodi);die();
		$this->siak_view->siak_prodi = $prodi;
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", 'SELECT * FROM cohort ;');
		$this->siak_view->siak_render('siak_pengumuman/cohort', true);
	}

}

?>