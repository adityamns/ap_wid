<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_pendaftaran_judul extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "pendaftaran_judul") {
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
		if (Siak_session::siak_get('level')==16){
			
			$this->siak_view->config = "Siak Widyatama - Pengajuan Proposal Tesis";
	
			$this->siak_view->judul = "Pengajuan Proposal Tesis";
			
			$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
			$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
			$this->siak_breadcrumbs->add(array('title'=>'Pengajuan Proposal Tesis','href'=>''. URL . 'siak_pendaftaran_judul'));
			$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
			
			$this->siak_add();	
		}
		else{
			$this->siak_view->config = "Siak Unhan - Pengajuan Proposal Tesis";
	
			$this->siak_view->judul = "Pengajuan Proposal Tesis";
			
			$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
			$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
			$this->siak_breadcrumbs->add(array('title'=>'Pengajuan Proposal Tesis','href'=>''. URL . 'siak_pendaftaran_judul'));
			$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
			
			$this->siak_datalist();	
		}
	}

	public function siak_datalist(){
		$cek_pro_sid = $this->siak_model->siak_query("select","select * from proto_sidang");
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
		
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_mahasiswa = $this->siak_model->siak_data_list("view_mahasiswa", "*");
		if(Siak_session::siak_get('prodi') != ""){
			$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where prodi_id='".Siak_session::siak_get('prodi')."' and judultesis_id not in(".$isis.")");
		}else{
			$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where judultesis_id not in(".$isis.")");
		}
		$this->siak_view->siak_render('siak_pendaftaran_judul/data', false);
	}

	public function siak_add(){
		$where1 = array('jenis_dosen_pembimbing' => 1);
		$where2 = array('jenis_dosen_pembimbing' => 2);
		$where3 = array('jenis_dosen_pembimbing' => 3);
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_edit($where1, "dosen_pembimbing", "*");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_edit($where2, "dosen_pembimbing", "*");
		$this->siak_view->siak_pembimbing3 = $this->siak_model->siak_edit($where3, "dosen_pembimbing", "*");
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_data_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		if (Siak_session::siak_get('level')==16){
			$cen = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where nim='".Siak_session::siak_get('username')."' and hasil='TRUE'");
			if($cen != NULL){
				$this->siak_view->sudah = "sudah";
			}
			
			$cek_pro_sid = $this->siak_model->siak_query("select","select * from proto_sidang where nim='".Siak_session::siak_get('username')."'");
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
			
			$cek = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".Siak_session::siak_get('username')."' and judultesis_id not in(".$isis.")");
			if($cek != NULL){
				$this->siak_view->d = "ada";
			}
			
			$mhs = $this->siak_model->siak_query("select","select * from mahasiswa where nim='".Siak_session::siak_get('username')."'");
			foreach($mhs as $a => $b){
				$prodi_mhs = $b['prodi_id'];
			}
			$matkul = $this->siak_model->siak_query("select","select * from matakuliah where prodi_id='".$prodi_mhs."'");
			$tot_sks = 0;
			foreach($matkul as $c => $d){
				$tot_sks = $tot_sks + $d['sks'];
				$kecil = strtolower($d['nama_matkul']);
				if($kecil == "tesis"){
					$tesis = $d['semester'];
					$sks_tesis = $d['sks'];
				}
			}
			$tesis_belum = "sudah";
			foreach($mhs as $e => $f){
				if($f['semester'] != $tesis){
					/* echo "<script>alert('Anda belum aktif di semester ini');window.location.href='".URL."siak_pendaftaran_judul';</script>";
					return 0; */
					$this->siak_view->tesis = "belum";
					$tesis_belum = "belum";
				}
			}
			$nm = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where nim='".Siak_session::siak_get('username')."'");
			$tot_sks_mhs = 0;
			$grade_nm = "";
			foreach($nm as $nilai => $mhs){
				foreach($matkul as $g => $h){
					if($mhs['matkul_id'] == $h['kode_matkul']){
						$tot_sks_mhs = $tot_sks_mhs + $h['sks'];
					}
				}
				$grade_nm = $grade_nm.$mhs['grade'].",";
			}
			$x_grade = explode(",",$grade_nm);
			$grade_syarat = "lulus";
			foreach($x_grade as $plo => $de){
				if($de == "C-" or $de == "D+" or $de == "D" or $de == "E"){
					/* echo "<script>alert('Persyaratan untuk mengikuti tes masih belum lengkap');window.location.href='".URL."siak_pendaftaran_judul';</script>";
					return 0; */
					$this->siak_view->gagal = "ya";
					$grade_syarat = "gagal";
				}
			}
			$lengkap = "lengkap";
			if($tot_sks_mhs < ($tot_sks - $sks_tesis)){
				/* echo "<script>alert('Persyaratan untuk mengikuti tes masih belum lengkap');window.location.href='".URL."siak_pendaftaran_judul';</script>";
				return 0; */
				$this->siak_view->sks = "belum";
				$lengkap = "tidak";
			}
			
		$this->siak_view->siak_render('siak_pendaftaran_judul/add_mhs', false);
		}else{$this->siak_view->siak_render('siak_pendaftaran_judul/add', true);}
	}

	public function siak_create($nim){
		if($_POST['nim']){ $nim = $_POST['nim']; }
		$mhs = $this->siak_model->siak_query("select","select * from mahasiswa where nim='".$nim."'");
		// $ada = "ada";
		$ada = array();
		// if($mhs == NULL){
		foreach($mhs as $mahas => $siswas){
			array_push($ada,"ok");
		}
		if(sizeof($ada) == 0){
			echo "<script>alert('Mahasiswa ini tidak terdaftar');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}
			
			// $ada = "tidak";
		// }
		foreach($mhs as $a => $b){
			$prodi_mhs = $b['prodi_id'];
		}
		$matkul = $this->siak_model->siak_query("select","select * from matakuliah where prodi_id='".$prodi_mhs."'");
		$tot_sks = 0;
		foreach($matkul as $c => $d){
			$tot_sks = $tot_sks + $d['sks'];
			$kecil = strtolower($d['nama_matkul']);
			if($kecil == "tesis"){
				$tesis = $d['semester'];
				$sks_tesis = $d['sks'];
			}
		}
		$tesis_belum = "sudah";
		foreach($mhs as $e => $f){
			if($f['semester'] != $tesis){
				echo "<script>alert('Anda belum aktif di semester ini');window.location.href='".URL."siak_pendaftaran_judul';</script>";
				return 0;
				$tesis_belum = "belum";
			}
		}
		$nm = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where nim='".$nim."'");
		$tot_sks_mhs = 0;
		$grade_nm = "";
		foreach($nm as $nilai => $mhs){
			foreach($matkul as $g => $h){
				if($mhs['matkul_id'] == $h['kode_matkul']){
					$tot_sks_mhs = $tot_sks_mhs + $h['sks'];
				}
			}
			$grade_nm = $grade_nm.$mhs['grade'].",";
		}
		$x_grade = explode(",",$grade_nm);
		$grade_syarat = "lulus";
		foreach($x_grade as $plo => $de){
			if($de == "C-" or $de == "D+" or $de == "D" or $de == "E"){
				echo "<script>alert('Persyaratan untuk mengikuti tes masih belum lengkap');window.location.href='".URL."siak_pendaftaran_judul';</script>";
				return 0;
				$grade_syarat = "gagal";
			}
		}
		$lengkap = "lengkap";
		if($tot_sks_mhs < ($tot_sks - $sks_tesis)){
			echo "<script>alert('Persyaratan untuk mengikuti tes masih belum lengkap');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
			$lengkap = "tidak";
		}
		
		if($_POST['judul'] == "" and $_POST['metodelogi'] == "" and $_POST['tujuan'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Judul Tesis, Metodelogi, Tujuan, dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['metodelogi'] == "" and $_POST['tujuan'] == ""){
			echo "<script>alert('Judul Tesis, Metodelogi, dan Tujuan Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['metodelogi'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Judul Tesis, Metodelogi, dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['tujuan'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Judul Tesis, Tujuan, dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['metodelogi'] == "" and $_POST['tujuan'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Metodelogi, Tujuan, dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['metodelogi'] == ""){
			echo "<script>alert('Judul dan Metodelogi Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['tujuan'] == ""){
			echo "<script>alert('Judul dan Tujuan Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['judul'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Judul dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['metodelogi'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Metodelogi dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['metodelogi'] == "" and $_POST['tujuan'] == ""){
			echo "<script>alert('Metodelogi dan Tujuan Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['tujuan'] == "" and $_POST['referensi'] == ""){
			echo "<script>alert('Tujuan dan Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['judul'] == ""){
			echo "<script>alert('Judul Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['metodelogi'] == ""){
			echo "<script>alert('Metodelogi Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['tujuan'] == ""){
			echo "<script>alert('Tujuan Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}else if($_POST['referensi'] == ""){
			echo "<script>alert('Referensi Harap Diisi');window.location.href='".URL."siak_pendaftaran_judul';</script>";
			return 0;
		}
		
		if(sizeof($ada) == 0 or $tesis_belum == "belum" or $grade_syarat == "gagal" or $lengkap == "tidak"){
			
		}else{
			$this->siak_model->siak_create();
			header('location: ' . URL . 'siak_pendaftaran_judul');
		}
	}
	
	public function siak_create_ajax($nim){
		$where1 = array('nim' => $_POST['NIM']);
		//$data['prodi'] ='KOSONG';
			//*** CEK MAHASISWA ***\\
			$data['mahasiswa']=$this->siak_model->siak_query("select", "Select *from mahasiswa where nim='".$_POST['NIM']."'");
			if($data['mahasiswa']!=null){
				foreach($data['mahasiswa'] as $x=>$row){
					$prod=$row['prodi_id'];
				}
				$data['mahasiswa']='ADA';
			}
			else{
				$data['mahasiswa']='KOSONG';
			}
			
			//====     ====//
			
		if($prod!='SPS'){
			$kondisi='semester=4 AND';
		}
		else{
			$kondisi='semester=3 AND';
		}
		$mhs_nim = $this->siak_model->siak_query("select","select * from mahasiswa where nim='".$_POST['NIM']."'");
		$matakuliah = $this->siak_model->siak_query("select","select * from matakuliah where prodi_id='".$prod."'");
		$mahasiswa=$this->siak_model->siak_query("select", "Select *from mahasiswa where ".$kondisi." nim='".$_POST['NIM']."'");
		$nm = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where nim='".$_POST['NIM']."'");
		$mahasiswa_asli = $this->siak_model->siak_query("select","select * from mahasiswa where nim='".$_POST['NIM']."'");
		if($mahasiswa_asli!=null){
			$tot_sks = 0;
			foreach($matakuliah as $mat => $kul){
				$tot_sks = $tot_sks + $kul['sks'];
				$tesis = strtolower($kul['nama_matkul']);
				if($tesis == "tesis"){
					$data['tesis'] = "ada";
					$smt_tesis = $kul['semester'];
					$sks_tesis = $kul['sks'];
				}
			}
			foreach($mhs_nim as $maha => $siswa){
				if($siswa['semester'] == $smt_tesis){
					$data['smt_mhs'] = 'sudah';
				}
			}
			$tot_sks_mhs = 0;
			$mat_nm = "";
			foreach($nm as $nilai => $mhs){
				foreach($matakuliah as $kul => $mat){
					if($mhs['matkul_id'] == $mat['kode_matkul']){
						$tot_sks_mhs = $tot_sks_mhs + $mat['sks'];
					}
				}
				$grade_nm = $grade_nm.$mhs['grade'].",";
			}
			$ex_grade_nm = explode(",",$grade_nm);
			$grade_gagal = array();
			$an = $this->siak_model->siak_query("select","select * from aturan_nilai where nama in('C-','D+','D','E')");
			foreach($ex_grade_nm as $grade_nm => $nm){
				foreach($an as $aturan => $nilai){
					if($nm == $nilai['nama']){
						array_push($grade_gagal,"ok");
					}
				}
			}
			$data['grade_gagal_isi'] = sizeof($grade_gagal);
			$data['sks_kurang'] = "tidak";
			$data['total_sks_mhs'] = ($tot_sks - $sks_tesis) - $tot_sks_mhs;
			if($tot_sks_mhs < ($tot_sks - $sks_tesis)){
				$data['sks_kurang'] = "ya";
			}
			foreach($mahasiswa as $key => $value){
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
		}else{
			$data['prodi'] ='KOSONG';
		}
		
		echo json_encode($data);
	}

	public function siak_edit($judultesis_id){
		$where1 = array('jenis_dosen_pembimbing' => 1);
		$where2 = array('jenis_dosen_pembimbing' => 2);
		$where3 = array('jenis_dosen_pembimbing' => 3);
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_edit($where1, "dosen_pembimbing", "*");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_edit($where2, "dosen_pembimbing", "*");
		$this->siak_view->siak_pembimbing3 = $this->siak_model->siak_edit($where3, "dosen_pembimbing", "*");
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_judul_tesis", "*");
		
		//NAMA & PRODI
		foreach($this->siak_view->siak_data as $key => $value){
			$nim = $value['nim'];
		}
		
		$where4 = array('nim' => $nim);
		$query = $this->siak_model->siak_edit($where4, "mahasiswa", "*");
		foreach($query as $key => $value){
			$jenis = $value['jenis'];
			$prodi = $value['prodi_id'];
		}
		
		if($jenis == 'Umum'){
			$this->siak_view->siak_nama = $this->siak_model->siak_edit($where4, "data_pribadi_umum", "*");
		} else if($jenis == 'pns') {
			$this->siak_view->siak_nama = $this->siak_model->siak_edit($where4, "data_pribadi_pns", "*");
		}
		
		$where5 = array('prodi_id' => $prodi);
		$this->siak_view->siak_prodi = $this->siak_model->siak_edit($where5, "prodi", "*");
		//END NAMA & PRODI
		
		$this->siak_view->siak_render('siak_pendaftaran_judul/edit', true);
	}
	public function siak_detail($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_judul_tesis", "*");
		$this->siak_view->siak_render('siak_pendaftaran_judul/view', false);
	}

	public function siak_edit_save($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pendaftaran_judul');
	}

	public function siak_delete($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pendaftaran_judul');
	}
	
	public function coba($nim){
		$cek_nm = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where hasil='TRUE' and nim='".$nim."'");
		if($cek_nm != NULL){
			$this->siak_view->sudah = "sudah";
		}
		
		$cek_pro_sid = $this->siak_model->siak_query("select","select * from proto_sidang where nim='".$nim."'");
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
		
		$cekan = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".$nim."' and judultesis_id not in(".$isis.")");
		if($cekan != NULL){
			$this->siak_view->afg = "ada";
		}
		$this->siak_view->nim = $nim;
		$mhs = $this->siak_model->siak_query("select","select * from mahasiswa where nim='".$nim."'");
		if($mhs == NULL){
			$this->siak_view->ada_mhs = "tidak";
		}
		foreach($mhs as $a => $b){
			$prodi_mhs = $b['prodi_id'];
		}
		$matkul = $this->siak_model->siak_query("select","select * from matakuliah where prodi_id='".$prodi_mhs."'");
		$tot_sks = 0;
		foreach($matkul as $c => $d){
			$tot_sks = $tot_sks + $d['sks'];
			$kecil = strtolower($d['nama_matkul']);
			if($kecil == "tesis"){
				$tesis = $d['semester'];
				$sks_tesis = $d['sks'];
			}
		}
		foreach($mhs as $e => $f){
			if($f['semester'] == $tesis){
				$this->siak_view->mhs_tesis = "sudah";
			}
		}
		$nm = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where nim='".$nim."'");
		$tot_sks_mhs = 0;
		$grade_nm = "";
		foreach($nm as $nilai => $mhs){
			foreach($matkul as $g => $h){
				if($mhs['matkul_id'] == $h['kode_matkul']){
					$tot_sks_mhs = $tot_sks_mhs + $h['sks'];
				}
			}
			$grade_nm = $grade_nm.$mhs['grade'].",";
		}
		$x_grade = explode(",",$grade_nm);
		foreach($x_grade as $plo => $de){
			if($de == "C-" or $de == "D+" or $de == "D" or $de == "E"){
				$this->siak_view->grade_gagal = "ya";
			}
		}
		if($tot_sks_mhs < ($tot_sks - $sks_tesis)){
			$this->siak_view->kurang = "ya";
		}
		$this->siak_view->mhs = $this->siak_model->siak_query("select","select * from view_mahasiswa where nim='".$nim."'");
		$this->siak_view->siak_render('siak_pendaftaran_judul/coba', true);
	}

}

?>