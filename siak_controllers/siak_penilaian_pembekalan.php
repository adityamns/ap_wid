<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_penilaian_pembekalan extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_penilaian();
	}

	function getNilai($id){
		$siak_data = $this->siak_model->siak_query("select", "SELECT * FROM nilai_mahasiswa where nim='$id'");
		$data_nilai = array();
		$result = array();
		foreach ($siak_data as $nilai => $row ){
			$data_nilai['nim']=$row['nim'];
			$data_nilai['presentasi']=$row['presentasi'];
			$data_nilai['tugas_mandiri']=$row['tugas_mandiri'];
			$data_nilai['UTS']=$row['UTS'];
			$data_nilai['UAS']=$row['UAS'];
			array_push($result,$data_nilai);
		}
		print json_encode($result);
	}

	function siak_penilaian(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "pembekalan" && $value['kode'] == "penilaian_pembekalan") {
				$this->siak_view->loads   = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_view->siak_render('siak_penilaian_pembekalan/index', false);
	}

	function matkul($prodi,$semes){
		$this->siak_view->data_matkul = $this->siak_model->siak_query("select", "SELECT *from matakuliah where prodi_id='$prodi' and semester='$semes'");
		$this->siak_view->siak_render('siak_penilaian_pembekalan/matkul', true);
	}

	function getbobot($materi_id,$ruang_id,$prodi_id){
		$this->siak_view->materi    = $materi_id;
		$this->siak_view->ruang     = $ruang_id;
		$this->siak_view->prodi     = $prodi_id;
		$this->siak_view->absensi = $this->siak_model->siak_query("select", "SELECT * from absensi_pembekalan Where materi_id = '".$materi_id."' and ruang_id = '".$ruang_id."';");
		$nim = "AND(a.nim = ";
		foreach ($this->siak_view->absensi as $key => $vals) {
			$nim .= "'".$vals['nim']."' OR a.nim = ";
		}
		$nim  =  substr($nim, 0, sizeof($nim) -13);
		$nim .= ")";
		if ($prodi_id!=1) {
			$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' $nim ORDER BY nim;");
		}elseif ($prodi_id==1) {
			$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id $nim ORDER BY nim;");
		}
		$this->siak_view->data = $this->siak_model->siak_query("select", "SELECT *, komponen_pembekalan.id as id_komponen FROM komponen_pembekalan LEFT JOIN bobot_pembekalan ON bobot_pembekalan.id=komponen_pembekalan.id_bobot where materi_id='$materi_id';");
		$this->siak_view->data_nilai = $this->siak_model->siak_query("select", "SELECT * FROM nilai_mahasiswa_pembekalan WHERE materi_id = '".$materi_id."';");
		$this->siak_view->data_nilai_mhs = $this->siak_model->siak_query("select", "SELECT nim FROM nilai_mahasiswa_pembekalan WHERE materi_id = '".$materi_id."';");
		$this->siak_view->siak_render('siak_penilaian_pembekalan/bobot_nilai', true);
	}

	function form_nilai($materi_id,$ruang_id,$nim,$prodi_id){
		$this->siak_view->nim 	   = $nim;
		$this->siak_view->materi    = $materi_id;
		$this->siak_view->ruang     = $ruang_id;
		$this->siak_view->prodi     = $prodi_id;
		$this->siak_view->data = $this->siak_model->siak_query("select", "SELECT *, komponen_pembekalan.id as id_komponen FROM komponen_pembekalan LEFT JOIN bobot_pembekalan ON bobot_pembekalan.id=komponen_pembekalan.id_bobot where materi_id='$materi_id';");
		$this->siak_view->data_nilai = $this->siak_model->siak_query("select", "SELECT * FROM nilai_mahasiswa_pembekalan WHERE nim='$nim' AND materi_id = '".$materi_id."';");
		// var_dump($this->siak_view->data_nilai); die();
		$this->siak_view->siak_render('siak_penilaian_pembekalan/form_nilai', true);
	}

	function insert_nilai(){
		$aturan= $this->siak_model->siak_data_list("aturan_nilai","*");
		foreach ($aturan as $key => $value) {
			if ($value['nilaimin'] <= (int)$_POST['total_nilai'] && $value['nilaimax'] >= (int)$_POST['total_nilai']) {
				$grade = $value['nama'];
				$bobot = $value['bobot'];
			}
		}
		$_POST['komponen'] = implode(',', $_POST['komponen']);
		$_POST['nilai'] = implode(',', $_POST['nilai']);
		$this->siak_model->siak_query("insert", "INSERT INTO nilai_mahasiswa_pembekalan(nim,komponen,nilai,nilai_total,grade,bobot,materi_id) VALUES('".$_POST['nim']."','".$_POST['komponen']."','".$_POST['nilai']."','".$_POST['total_nilai']."','".$grade."',".$bobot.",'".$_POST['materi']."');");
		header('location: ' . URL . 'siak_penilaian_pembekalan');
	}

	public function jenis($status){
		if ($status == 1) {
			$where = array('status' => $status);
			$this->siak_view->data_materi = $this->siak_model->siak_edit($where, "materi_pembekalan", "*");
			$this->siak_view->siak_render('siak_penilaian_pembekalan/materi', true);
		}elseif ($status == 2) {
			$this->siak_view->data_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id, prodi");
			$this->siak_view->siak_render('siak_penilaian_pembekalan/prodi', true);
		}
	}

	public function materi($prodi_id){
		$where = array('prodi_id' => $prodi_id, 'status' => 2);
		$this->siak_view->data_materi = $this->siak_model->siak_edit($where, "materi_pembekalan", "*");
		$this->siak_view->siak_render('siak_penilaian_pembekalan/materi2', true);
	}

	public function ruang($materi_id){
		$where = array('materi_id' => $materi_id);
		$this->siak_view->data_ruang = $this->siak_model->siak_edit($where, "atur_pembekalan", "*");
		$this->siak_view->master_ruang = $this->siak_model->siak_data_list("ruang", "*");
		$this->siak_view->siak_render('siak_penilaian_pembekalan/ruang', true);
	}

}

?>