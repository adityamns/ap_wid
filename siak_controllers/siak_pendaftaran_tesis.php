<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_pendaftaran_tesis extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "pendaftaran_tesis") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->loads  = $value['loads'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_roles();
	}

	function index(){
		
		$this->siak_view->config = "Siak Widyatama - Pengajuan Tesis";
	
		$this->siak_view->judul = "Pengajuan Tesis";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Pengajuan Tesis','href'=>''. URL . 'siak_pendaftaran_tesis'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		if (Siak_session::siak_get('level')==16){
		$this->siak_add();
		}else{$this->siak_datalist();
		}
	}

	public function siak_datalist(){
		$cek_pro_sid = $this->siak_model->siak_query("select","select * from proto");
		$gr = "";
		foreach($cek_pro_sid as $ceki => $poi){
			if($poi['judultesis_id'] == ""){
				$poi['judultesis_id'] = "-1";
			}
			$gr = $gr."'".$poi['judultesis_id']."',";
		}
		$haps = strlen($gr);
		$haps = $haps - 1;
		$isis = substr($gr,0,$haps);
			
		if($cek_pro_sid == NULL){
			$isis = "'-1'";
		}
		
		if(Siak_session::siak_get('prodi') != ""){
			$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","select * from pendaftaran_tesis where prodi_id='".Siak_session::siak_get('prodi')."' and judultesis_id not in(".$isis.")");
		}else{
			$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","select * from pendaftaran_tesis where judultesis_id not in(".$isis.")");
		}
		$this->siak_view->siak_mahasiswa = $this->siak_model->siak_data_list("view_mahasiswa", "*");
		$this->siak_view->siak_render('siak_pendaftaran_tesis/data', false);
	}
	
	public function siak_add(){
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 1");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 2");
		$this->siak_view->siak_pembimbing3 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 3");
		$this->siak_view->jenis_dosen = $this->siak_model->siak_query("select","select * from dosen_pembimbing where jenis_dosen_pembimbing='1'");
		$this->siak_view->dosen_pembimbing = $this->siak_model->siak_data_list("pembimbing","*");
		if (Siak_session::siak_get('level')==16){
			$nim = Siak_session::siak_get('username');
			/* $cen = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where nim='".Siak_session::siak_get('username')."' and hasil='TRUE'");
			if($cen != NULL){
				$this->siak_view->sudah = "sudah";
			}
			
			$cek_pro_sid = $this->siak_model->siak_query("select","select * from proto where nim='".Siak_session::siak_get('username')."'");
			$gr = "";
			foreach($cek_pro_sid as $ceki => $poi){
				if($poi['judultesis_id'] == ""){
				$poi['judultesis_id'] = "-1";
			}
				$gr = $gr."'".$poi['judultesis_id']."',";
			}
			$haps = strlen($gr);
			$haps = $haps - 1;
			$isis = substr($gr,0,$haps);
			
			if($cek_pro_sid == NULL){
				$isis = "'-1'";
			}
			
			$cek = $this->siak_model->siak_query("select","select * from pendaftaran_tesis where nim='".Siak_session::siak_get('username')."' and judultesis_id not in(".$isis.")");
			$pembimbing_proposal = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".Siak_session::siak_get('username')."'");
			foreach($pembimbing_proposal as $pembimbing1 => $proposal1){
				$this->siak_view->pembimbing1 = $proposal1['dosen_pembimbing1'];
			}
			foreach($cek as $c => $ek){
				$this->siak_view->d = "ada";
			}
			$this->siak_view->cek = $this->siak_model->siak_query("select","select * from proto_sidang where nim='".Siak_session::siak_get('username')."' and hasil_lulus='TRUE'"); */
			
			$cek_dulu = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where nim='".$nim."' and hasil='TRUE'");
			if($cek_dulu != NULL){
				$this->siak_view->lulus_tesis = "lulus";
			}
			
			$cek_po = $this->siak_model->siak_query("select","select * from proto where nim='".$nim."'");
			$gr = "";
			foreach($cek_po as $ceki => $poi){
				if($poi['judultesis_id'] == ""){
					$poi['judultesis_id'] = "-1";
				}
				$gr = $gr."'".$poi['judultesis_id']."',";
			}
			$haps = strlen($gr);
			$haps = $haps - 1;
			$isis = substr($gr,0,$haps);
			
			if($cek_po == NULL){
				$isis = "'-1'";
			}
			// echo var_dump($isis);die();
			
			$cekan = $this->siak_model->siak_query("select","select * from pendaftaran_tesis where nim='".$nim."' and judultesis_id not in(".$isis.")");
			if(sizeof($cekan) > 0){
				$this->siak_view->afg = "ada";
			}
			
			$cek_por = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".$nim."'");
			$grr = "";
			foreach($cek_por as $cekir => $poir){
				if($poir['judultesis_id'] == ""){
					$poir['judultesis_id'] = "-1";
				}
				$grr = $grr."'".$poir['judultesis_id']."',";
			}
			$hapsr = strlen($grr);
			$hapsr = $hapsr - 1;
			$isisr = substr($grr,0,$hapsr);
			
			if($cek_por == NULL){
				$isisr = "'-1'";
			}
			
			$cek = $this->siak_model->siak_query("select","select * from proto_sidang where nim='".$nim."' and hasil_lulus='TRUE' and judultesis_id not in(".$isis.")"); // syarat daftar tesis
			$this->siak_view->mhs = $this->siak_model->siak_query("select","select * from view_mahasiswa where nim='".$nim."'");
			$this->siak_view->ada = sizeof($cek);
			// echo var_dump(sizeof($cek));die();
			$this->siak_view->jenis_dosen = $this->siak_model->siak_query("select","select * from dosen_pembimbing where jenis_dosen_pembimbing='1'");
			$this->siak_view->dosen_pembimbing = $this->siak_model->siak_data_list("pembimbing","*");
			$dosen_proposal = $this->siak_model->siak_query("select","select a.* from pendaftaran_judul_tesis a,proto_sidang b where a.nim='".$nim."' and b.hasil_lulus='TRUE' and a.judultesis_id=b.judultesis_id and a.judultesis_id not in(".$isis.")");
			foreach($dosen_proposal as $dosen => $proposal){
				$this->siak_view->jud_id = $proposal['judultesis_id'];
				$this->siak_view->dosen_proposal = $proposal['dosen_pembimbing1'];
			}
			
		$this->siak_view->siak_render('siak_pendaftaran_tesis/add_mhs', false);
		}else{
		$this->siak_view->siak_render('siak_pendaftaran_tesis/add', true);
		}
	}
	
	public function siak_create(){
		if($_POST['judul'] == "" and $_POST['metodelogi'] == "" and $_POST['tujuan'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Judul Tesis, Metodelogi, Tujuan, dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['metodelogi'] == "" and $_POST['tujuan'] == ""){
			echo "<script>alert('Judul Tesis, Metodelogi, dan Tujuan Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['metodelogi'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Judul Tesis, Metodelogi, dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['tujuan'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Judul Tesis, Tujuan, dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['metodelogi'] == "" and $_POST['tujuan'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Metodelogi, Tujuan, dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['metodelogi'] == ""){
			echo "<script>alert('Judul dan Metodelogi Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['tujuan'] == ""){
			echo "<script>alert('Judul dan Tujuan Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Judul dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['metodelogi'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Metodelogi dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['metodelogi'] == "" and $_POST['tujuan'] == ""){
			echo "<script>alert('Metodelogi dan Tujuan Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['tujuan'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Tujuan dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['judul'] == ""){
			echo "<script>alert('Judul Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['metodelogi'] == ""){
			echo "<script>alert('Metodelogi Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['tujuan'] == ""){
			echo "<script>alert('Tujuan Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}else if($_POST['referensi'] == ""){
			echo "<script>alert('Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_tesis';</script>";
			return 0;
		}
		
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pendaftaran_tesis');
	}
	
	public function siak_create_ajax(){
		$hasil = $this->siak_model->siak_query("select", "
		SELECT * FROM pendaftaran_judul_tesis as a, proto_sidang as b WHERE a.judultesis_id = b.judultesis_id AND b.hasil_lulus = 'TRUE' AND a.nim = '".$_POST['NIM']."'
		");
		
		if($hasil != NULL){
			$where1 = array('nim' => $_POST['NIM']);
			foreach($this->siak_model->siak_edit($where1, "mahasiswa", "*") as $key => $value){
				$jenis = $value['jenis'];
				$prodi = $value['prodi_id'];
			}
			if($jenis == 'Umum'){
				$data['nama'] = $this->siak_model->siak_edit($where1, "data_pribadi_umum", "*");
			} else if($jenis == 'pns') {
				$data['nama'] = $this->siak_model->siak_edit($where1, "data_pribadi_pns", "*");
			}
			
			$where2 = array('prodi_id' => $prodi);
			$data['prodi'] = $this->siak_model->siak_edit($where2, "prodi", "*");
			$data['pendaftaran'] = $this->siak_model->siak_edit($where1, "pendaftaran_judul_tesis", "*");
			foreach($data['pendaftaran'] as $key =>  $value){
				$dosen1 = $value['dosen_pembimbing1'];
				$dosen2 = $value['dosen_pembimbing2'];
				$dosen3 = $value['dosen_pembimbing3'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 1 AND a.nip = '".$dosen1."'") as $key => $val){
				$data['dosen1'] = $val['nama'];
				$data['nip1'] = $val['nip'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 2 AND a.nip = '".$dosen2."'") as $key => $val){
				$data['dosen2'] = $val['nama'];
				$data['nip2'] = $val['nip'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 3 AND a.nip = '".$dosen3."'") as $key => $val){
				$data['dosen3'] = $val['nama'];
				$data['nip3'] = $val['nip'];
			}
			$data['message'] = "";
		} else {
			$data['nama'] = "";
			$data['prodi'] = "";
			$data['pendaftaran'] = "";
			$data['message'] = "Mahasiswa tidak lulus sidang proposal";
		}		
		echo json_encode($data);
	}
	
	public function siak_edit_ajax(){
		$hasil = $this->siak_model->siak_query("select", "
		SELECT * FROM pendaftaran_tesis as a, hasil_sidang as b WHERE a.judultesis_id = b.judultesis_id AND b.hasil = 1 AND a.nim = '".$_POST['NIM']."'
		");
		
		if($hasil != NULL){
			$where1 = array('nim' => $_POST['NIM']);
			foreach($this->siak_model->siak_edit($where1, "mahasiswa", "*") as $key => $value){
				$jenis = $value['jenis'];
				$prodi = $value['prodi_id'];
			}
			if($jenis == 'umum'){
				$data['nama'] = $this->siak_model->siak_edit($where1, "data_pribadi_umum", "*");
			} else if($jenis == 'pns') {
				$data['nama'] = $this->siak_model->siak_edit($where1, "data_pribadi_pns", "*");
			}
			
			$where2 = array('prodi_id' => $prodi);
			$data['prodi'] = $this->siak_model->siak_edit($where2, "prodi", "*");
			$data['pendaftaran'] = $this->siak_model->siak_edit($where1, "pendaftaran_tesis", "*");
			foreach($data['pendaftaran'] as $key =>  $value){
				$dosen1 = $value['dosen_pembimbing1'];
				$dosen2 = $value['dosen_pembimbing2'];
				$dosen3 = $value['dosen_pembimbing3'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 1 AND a.nip = '".$dosen1."'") as $key => $val){
				$data['dosen1'] = $val['nama'];
				$data['nip1'] = $val['nip'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 2 AND a.nip = '".$dosen2."'") as $key => $val){
				$data['dosen2'] = $val['nama'];
				$data['nip2'] = $val['nip'];
			}
			foreach($this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 3 AND a.nip = '".$dosen3."'") as $key => $val){
				$data['dosen3'] = $val['nama'];
				$data['nip3'] = $val['nip'];
			}
			$data['message'] = "";
		} else {
			$data['nama'] = "";
			$data['prodi'] = "";
			$data['pendaftaran'] = "";
			$data['message'] = "Mahasiswa tidak lulus sidang proposal";
		}		
		echo json_encode($data);
	}
	
	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_tesis", "*");
		
		//NAMA & PRODI
		foreach($this->siak_view->siak_data as $key => $value){
			$nim = $value['nim'];
		}
		
		$where4 = array('nim' => $nim);
		$query = $this->siak_model->siak_edit($where4, "mahasiswa", "*");
		foreach($query as $key => $value){
			$jenis = strtolower($value['jenis']);
			$prodi = $value['prodi_id'];
		}
		
		if($jenis == 'umum'){
			$this->siak_view->siak_nama = $this->siak_model->siak_edit($where4, "data_pribadi_umum", "*");
		} else if($jenis == 'pns') {
			$this->siak_view->siak_nama = $this->siak_model->siak_edit($where4, "data_pribadi_pns", "*");
		}
		
		$where5 = array('prodi_id' => $prodi);
		$this->siak_view->siak_prodi = $this->siak_model->siak_edit($where5, "prodi", "*");
		//END NAMA & PRODI
		
		$this->siak_view->jenis_dosen = $this->siak_model->siak_query("select","select * from dosen_pembimbing where jenis_dosen_pembimbing='1'");
		$this->siak_view->dosen_pembimbing = $this->siak_model->siak_data_list("pembimbing","*");
		
		$this->siak_view->siak_render('siak_pendaftaran_tesis/edit', true);
	}
	
	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pendaftaran_tesis');
	}
	
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pendaftaran_tesis');
	}
	
	public function cobax($nim){
		$cekan = $this->siak_model->siak_query("select","select * from pendaftaran_tesis where nim='".$nim."'");
		foreach($cekan as $cek => $an){
			$this->siak_view->afg = "ada";
		}
		$cek = $this->siak_model->siak_query("select","select * from proto_sidang where nim='".$nim."' and hasil_lulus='TRUE'");
		$this->siak_view->mhs = $this->siak_model->siak_query("select","select * from view_mahasiswa where nim='".$nim."'");
		$this->siak_view->ada = sizeof($cek);
		$this->siak_view->jenis_dosen = $this->siak_model->siak_query("select","select * from dosen_pembimbing where jenis_dosen_pembimbing='1'");
		$this->siak_view->dosen_pembimbing = $this->siak_model->siak_data_list("pembimbing","*");
		$dosen_proposal = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".$nim."'");
		foreach($dosen_proposal as $dosen => $proposal){
			$this->siak_view->dosen_proposal = $proposal['dosen_pembimbing1'];
		}
		$this->siak_view->siak_render('siak_pendaftaran_tesis/coba', true);
	}
	
	public function coba($nim){
		$this->siak_view->cek_mhs = $this->siak_model->siak_query("select","select * from mahasiswa where nim='".$nim."'");
		
		$cek_dulu = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where nim='".$nim."' and hasil='TRUE'");
		if($cek_dulu != NULL){
			$this->siak_view->lulus_tesis = "lulus";
		}
		
		$cek_po = $this->siak_model->siak_query("select","select * from proto where nim='".$nim."'");
		$gr = "";
		foreach($cek_po as $ceki => $poi){
			if($poi['judultesis_id'] == ""){
				$poi['judultesis_id'] = "-1";
			}
			$gr = $gr."'".$poi['judultesis_id']."',";
		}
		$haps = strlen($gr);
		$haps = $haps - 1;
		$isis = substr($gr,0,$haps);
		
		if($cek_po == NULL){
			$isis = "'-1'";
		}
		
		$cekan = $this->siak_model->siak_query("select","select * from pendaftaran_tesis where nim='".$nim."' and judultesis_id not in(".$isis.")");
		if(sizeof($cekan) > 0){
			$this->siak_view->afg = "ada";
		}
		
		$cek_por = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".$nim."'");
		$grr = "";
		foreach($cek_por as $cekir => $poir){
			if($poir['judultesis_id'] == ""){
				$poir['judultesis_id'] = "-1";
			}
			$grr = $grr."'".$poir['judultesis_id']."',";
		}
		$hapsr = strlen($grr);
		$hapsr = $hapsr - 1;
		$isisr = substr($grr,0,$hapsr);
		
		if($cek_por == NULL){
			$isisr = "'-1'";
		}
		
		// $cek = $this->siak_model->siak_query("select","select * from proto_sidang where nim='".$nim."' and hasil_lulus='TRUE' and judultesis_id not in(".$isis.") and judultesis_id in(".$isisr.")"); // syarat daftar tesis
		$cek = $this->siak_model->siak_query("select","select * from proto_sidang where nim='".$nim."' and hasil_lulus='TRUE' and judultesis_id not in(".$isis.")"); // syarat daftar tesis
		$this->siak_view->mhs = $this->siak_model->siak_query("select","select * from view_mahasiswa where nim='".$nim."'");
		$this->siak_view->ada = sizeof($cek);
		$this->siak_view->jenis_dosen = $this->siak_model->siak_query("select","select * from dosen_pembimbing where jenis_dosen_pembimbing='1'");
		$this->siak_view->dosen_pembimbing = $this->siak_model->siak_data_list("pembimbing","*");
		$dosen_proposal = $this->siak_model->siak_query("select","select a.* from pendaftaran_judul_tesis a,proto_sidang b where a.nim='".$nim."' and b.hasil_lulus='TRUE' and a.judultesis_id=b.judultesis_id and a.judultesis_id not in(".$isis.")");
		foreach($dosen_proposal as $dosen => $proposal){
			$this->siak_view->jud_id = $proposal['judultesis_id'];
			$this->siak_view->dosen_proposal = $proposal['dosen_pembimbing1'];
		}
		/* $judul_nim = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".$nim."'");
		foreach($judul_nim as $judi => $nimi){
			$this->siak_view->tesiss = $nimi[''];
		} */
		$this->siak_view->siak_render('siak_pendaftaran_tesis/coba', true);
	}
	
}

?>