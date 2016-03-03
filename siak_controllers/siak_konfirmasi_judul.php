<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_konfirmasi_judul extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	public function index(){
		$this->siak_view->config = "Siak Widyatama - Konfirmasi Proposal Tesis";
	
		$this->siak_view->judul = "Konfirmasi Proposal Tesis";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Konfirmasi Proposal Tesis','href'=>''. URL . 'siak_konfirmasi_judul'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "konfirmasi_judul") {
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
		
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("pembimbing", "*");
		$this->siak_view->siak_mahasiswa = $this->siak_model->siak_data_list("view_mahasiswa", "*");
		$cek = $this->siak_model->siak_query("select","select * from users where username='".Siak_session::siak_get('username')."'");
		
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
		
		foreach($cek as $c => $ek){
			$ada = $ek['prodi_id'];
		}
		if(Siak_session::siak_get('level') == '16'){
			$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".Siak_session::siak_get('username')."' and judultesis_id not in(".$isis.")");
		}else{
			if($ada == ""){
				$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where judultesis_id not in(".$isis.")");
			}else{
				$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where prodi_id='".$ada."' and judultesis_id not in(".$isis.")");
			}
		}
		
		$this->siak_view->siak_render('siak_konfirmasi_judul/data', false);
	}

	public function siak_add(){
		$where1 = array('jenis_dosen_pembimbing' => 1);
		$where2 = array('jenis_dosen_pembimbing' => 2);
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_edit($where1, "dosen_pembimbing", "*");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_edit($where2, "dosen_pembimbing", "*");
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_data_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_konfirmasi_judul/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_konfirmasi_judul');
	}

	public function siak_edit($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_judul_tesis", "*");
		
		//DOSEN
		foreach($this->siak_view->siak_data as $key => $value){
			$nim = $value['nim'];
			$this->siak_view->dosen_pembimbing1 = $value['dosen_pembimbing1'];
			$this->siak_view->dosen_pembimbing2 = $value['dosen_pembimbing2'];
			$this->siak_view->dosen_pembimbing3 = $value['dosen_pembimbing3'];
		}
		
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 1");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 2");
		$this->siak_view->siak_pembimbing3 = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = 3");
		
		
		//MAHASISWA
		$wher = array('nim' => $nim);
		foreach($this->siak_model->siak_edit($wher, "mahasiswa", "*") as $key => $value){
			$jenis = $value['jenis'];
			$prodi = $value['prodi_id'];
		}
		if($jenis == 'umum'){
		
			$this->siak_view->siak_mhs = $this->siak_model->siak_edit($wher, "data_pribadi_umum", "*");
			
		} else if($jenis == 'pns') {
		
			$this->siak_view->siak_mhs = $this->siak_model->siak_edit($wher, "data_pribadi_pns", "*");
			
		}
		
		$whe = array('prodi_id' => $prodi);
		$this->siak_view->siak_prodi = $this->siak_model->siak_edit($whe, "prodi", "*");
		
		$this->siak_view->siak_render('siak_konfirmasi_judul/edit', true);
	}
	public function siak_detail($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_judul_tesis", "*");
		$this->siak_view->siak_render('siak_konfirmasi_judul/view', false);
	}

	public function siak_edit_save2($judultesis_id){
		if($_POST['dosen_pembimbing1'] != NULL){
			$prodi=$_POST['prodi_id'];
			$where = $_POST['dosen_pembimbing1'];
			
			$sql = "SELECT 
					* 
				FROM 
					(
					  SELECT 
						b.id,
						a.kode,
						a.nama,
						b.jenis_dosen_pembimbing,
						b.jml_mahasiswa_max,
						b.penguji, 
						a.prodi_homebase, 
						b.jumlah_homebase, 
						b.jumlah_lain 
					  FROM 
						pembimbing as a,
						dosen_pembimbing as b 
					  WHERE 
						a.kode = b.nip 
					  UNION 
					  SELECT 
						b.id,
						a.kode as id_penguji, 
						a.nama, 
						b.jenis_dosen_pembimbing, 
						b.jml_mahasiswa_max,
						b.penguji,
						null as prodi_homebase,
						null as jumlah_homebase,
						null as jumlah_lain 
					  FROM 
						penguji as a,
						dosen_pembimbing as b 
					  WHERE 
						a.kode = b.nip
					) as result 
				where kode = '$where'
				";
			
			$cek =$this->siak_model->siak_query("select", $sql);
			
			foreach($cek as $key => $value){
				$jml_max = $value['jml_mahasiswa_max'];
				$jml_lain = $value['jumlah_lain'];
				$jml_prodi = $value['jumlah_homebase'];
				$dosen_homebase = $value['prodi_homebase'];
			}
				if($prodi==$dosen_homebase){
					$jumlah_pem1=$jml_prodi;
					$alert='Quota Dosen Pembimbing 1 untuk Prodi '.$dosen_homebase.' Sudah Penuh';
				}
				elseif($dosen_homebase != ''){
					$jumlah_pem1=$jml_lain;
					$alert='Quota Dosen Pembimbing 1 Penuh';
				}
				else{
					$jumlah_pem1=$jml_max;
					$alert='Quota Dosen Pembimbing 1 Penuh sdfsdf';
				}
				
			$jumlah_mhs1 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_judul_tesis WHERE dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."' AND status <> '3' AND status = '2' AND prodi_id='$prodi';"));
			
			if($jumlah_mhs1 >= $jumlah_pem1){
				echo "<script>alert('$alert');window.location.href='".URL."siak_konfirmasi_judul';</script>";
				return 0;
				
			} else {
			
				$satu = "dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$satu.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				
// 				echo "UPDATE pendaftaran_judul_tesis SET ".$satu.",status = '2' WHERE judultesis_id = '".$judultesis_id."';<br>";
				//header('location: ' . URL . 'siak_konfirmasi_judul');
			}
		}
		else {
				$satu = "dosen_pembimbing1 = ''";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$satu.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
// 				echo "UPDATE pendaftaran_judul_tesis SET ".$satu.",status = '2' WHERE judultesis_id = '".$judultesis_id."';<br>";
				header('location: ' . URL . 'siak_konfirmasi_judul');
		}
		
		if($_POST['dosen_pembimbing2'] != NULL){
			$prodi=$_POST['prodi_id'];
			$where = $_POST['dosen_pembimbing2'];
			// $cek=$this->siak_model->siak_edit($where, "dosen_pembimbing", "*");
			$cek =$this->siak_model->siak_query("select", "select *from (SELECT b.id,a.kode,a.nama,b.jenis_dosen_pembimbing,b.jml_mahasiswa_max,b.penguji, a.prodi_homebase, b.jumlah_homebase, b.jumlah_lain FROM pembimbing as a,dosen_pembimbing as b WHERE a.kode = b.nip 
			UNION 
			SELECT b.id,a.kode as id_penguji, a.nama, b.jenis_dosen_pembimbing, b.jml_mahasiswa_max,b.penguji,null as prodi_homebase,null as jumlah_homebase,null as jumlah_lain 
			FROM penguji as a,dosen_pembimbing as b WHERE a.kode = b.nip) as result where kode='$where'");
			foreach($cek as $key => $value){
				$jml_max = $value['jml_mahasiswa_max'];
				$jml_lain = $value['jumlah_lain'];
				$jml_prodi = $value['jumlah_homebase'];
				$dosen_homebase = $value['prodi_homebase'];
			}
				if($prodi==$dosen_homebase){
					$jumlah_pem2=$jml_prodi;
					$alert='Quota Dosen Pembimbing 2 untuk Prodi '.$dosen_homebase.' Sudah Penuh';
				}
				elseif($dosen_homebase!=''){
					$jumlah_pem2=$jml_lain;
					$alert='Quota Dosen Pembimbing 2 Penuh';
				}
				else{
					$jumlah_pem2=$jml_max;
					$alert='Quota Dosen Pembimbing 2 Penuh';
				}
				$jumlah_mhs2 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_judul_tesis WHERE dosen_pembimbing1 = '".$_POST['dosen_pembimbing2']."' AND status <> '3' AND status = '2' AND prodi_id='$prodi';"));
			if($jumlah_mhs2 >= $jumlah_pem2){
				echo "<script>alert('$alert');window.location.href='".URL."siak_konfirmasi_judul';</script>";
				return 0;
			} else{
				$dua = "dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$dua.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				
// 				echo "UPDATE pendaftaran_judul_tesis SET ".$dua.",status = '2' WHERE judultesis_id = '".$judultesis_id."';<br>";
// 				header('location: ' . URL . 'siak_konfirmasi_judul');
			}
		} else {
				$dua = "dosen_pembimbing2 = ''";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$dua.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				
// 				echo "UPDATE pendaftaran_judul_tesis SET ".$dua.",status = '2' WHERE judultesis_id = '".$judultesis_id."';<br>";
				header('location: ' . URL . 'siak_konfirmasi_judul');
		}
// 		echo ":p";
// 		die();
		
		if($_POST['dosen_pembimbing3'] != NULL){
			$prodi=$_POST['prodi_id'];
			$where = $_POST['dosen_pembimbing3'];
			// $cek=$this->siak_model->siak_edit($where, "dosen_pembimbing", "*");
			$cek =$this->siak_model->siak_query("select", "select *from (SELECT b.id,a.kode,a.nama,b.jenis_dosen_pembimbing,b.jml_mahasiswa_max,b.penguji, a.prodi_homebase, b.jumlah_homebase, b.jumlah_lain FROM pembimbing as a,dosen_pembimbing as b WHERE a.kode = b.nip 
			UNION 
			SELECT b.id,a.kode as id_penguji, a.nama, b.jenis_dosen_pembimbing, b.jml_mahasiswa_max,b.penguji,null as prodi_homebase,null as jumlah_homebase,null as jumlah_lain 
			FROM penguji as a,dosen_pembimbing as b WHERE a.kode = b.nip) as result where kode='$where'");
			foreach($cek as $key => $value){
				$jml_max = $value['jml_mahasiswa_max'];
				$jml_lain = $value['jumlah_lain'];
				$jml_prodi = $value['jumlah_homebase'];
				$dosen_homebase = $value['prodi_homebase'];
			}
				if($prodi==$dosen_homebase){
					$jumlah_pem2=$jml_prodi;
					$alert='Quota Dosen Pembimbing 3 untuk Prodi '.$dosen_homebase.' Sudah Penuh';
				}
				elseif($dosen_homebase!=''){
					$jumlah_pem2=$jml_lain;
					$alert='Quota Dosen Pembimbing 3 Penuh';
				}
				else{
					$jumlah_pem2=$jml_max;
					$alert='Quota Dosen Pembimbing 3 Penuh';
				}
				$jumlah_mhs2 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_judul_tesis WHERE dosen_pembimbing1 = '".$_POST['dosen_pembimbing3']."' AND status <> '3' AND status = '2' AND prodi_id='$prodi';"));
			if($jumlah_mhs3 >= $jumlah_pem3){
				echo "<script>alert('$alert');window.location.href='".URL."siak_konfirmasi_judul';</script>";return 0;
			} else {
				$tiga = "dosen_pembimbing3 = '".$_POST['dosen_pembimbing3']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$tiga.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				header('location: ' . URL . 'siak_konfirmasi_judul');
			}
		} else {
			$tiga = "dosen_pembimbing3 = ''";
			$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$tiga.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
			header('location: ' . URL . 'siak_konfirmasi_judul');
		}
		
	}
	
	public function siak_edit_save($judultesis_id){
		/* if($_POST['dosen_pembimbing1'] != NULL){
			$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET dosen_pembimbing1='".$_POST['dosen_pembimbing1']."',status = '2' WHERE judultesis_id = '".$judultesis_id."';");
		}
		$dospem = $this->siak_model->siak_query("select","select * from dosen_pembimbing where nip='".$_POST['dosen_pembimbing1']."'");
		foreach($dospem as $dos => $pem){
			$jml_mhs = $pem['jml_mahasiswa'];
		}
		$jml_mhs_plus = $jml_mhs + 1;
		$this->siak_model->siak_query("update","update dosen_pembimbing set jml_mahasiswa='".$jml_mhs_plus."' where nip='".$_POST['dosen_pembimbing1']."'");
		
		if($_POST['dosen_pembimbing2'] != NULL){
			$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET dosen_pembimbing2='".$_POST['dosen_pembimbing2']."',status = '2' WHERE judultesis_id = '".$judultesis_id."';");
		}
		$dospem2 = $this->siak_model->siak_query("select","select * from dosen_pembimbing where nip='".$_POST['dosen_pembimbing2']."'");
		foreach($dospem2 as $dos2 => $pem2){
			$jml_mhs2 = $pem2['jml_mahasiswa'];
		}
		$jml_mhs_plus2 = $jml_mhs2 + 1;
		$this->siak_model->siak_query("update","update dosen_pembimbing set jml_mahasiswa='".$jml_mhs_plus2."' where nip='".$_POST['dosen_pembimbing2']."'");
		header('location: ' . URL . 'siak_konfirmasi_judul'); */
		
		$cek_mhs_lulustesis = $this->siak_model->siak_query("select","select nim from nilai_mahasiswa where hasil=TRUE group by nim");
		$mhs_nya = "";
		foreach($cek_mhs_lulustesis as $cek_mhs => $lulustesis){
			$mhs_nya = $mhs_nya."'".$lulustesis['nim']."',";
		}
		$hapuskoma1 = strlen($mhs_nya);
		$hapuskoma1 = $hapuskoma1 - 1;
		$mhs_nm = substr($mhs_nya,0,$hapuskoma1);
			
		if($cek_mhs_lulustesis == NULL){
			$mhs_nm =  "''";
		}
		
		if($_POST['dosen_pembimbing1'] != NULL){
			$where = array('nip' => $_POST['dosen_pembimbing1']);
			foreach($this->siak_model->siak_edit($where, "dosen_pembimbing", "*") as $key => $value){
				$jumlah_pem1 = $value['jml_mahasiswa_max'];
			}
			
			$jumlah_mhs1 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_judul_tesis WHERE dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."' and nim not in(".$mhs_nm.");"));
			$jumlah_mhs1_tesis = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_tesis WHERE dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."' and nim not in(".$mhs_nm.");"));
			if(($jumlah_mhs1 + $jumlah_mhs1_tesis) >= $jumlah_pem1){
				$ada_dosen1 = "ada";
				/* echo "<script>alert('Quota Dosen Pembimbing 1 Penuh');window.location.href='".URL."siak_konfirmasi_judul';</script>";
				return 0; */
			} /* else {
				$satu = "dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$satu.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				// header('location: ' . URL . 'siak_konfirmasi_judul');
			} */
		}
		/* else {
				$satu = "dosen_pembimbing1 = ''";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$satu.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				// header('location: ' . URL . 'siak_konfirmasi_judul');
		} */
		
		if($_POST['dosen_pembimbing2'] != NULL){
			$where1 = array('nip' => $_POST['dosen_pembimbing2']);
			foreach($this->siak_model->siak_edit($where1, "dosen_pembimbing", "*") as $key => $value){
				$jumlah_pem2 = $value['jml_mahasiswa_max'];
			}
			$jumlah_mhs2 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_judul_tesis WHERE dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."' and nim not in(".$mhs_nm.");"));
			$jumlah_mhs2_tesis = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_tesis WHERE dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."' and nim not in(".$mhs_nm.");"));
			if(($jumlah_mhs2 + $jumlah_mhs2_tesis) >= $jumlah_pem2){
				$ada_dosen2 = "ada";
				/* echo "<script>alert('Quota Dosen Pembimbing 2 Penuh');window.location.href='".URL."siak_konfirmasi_judul';</script>";
				return 0; */
			}/* else{
				$dua = "dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$dua.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				// header('location: ' . URL . 'siak_konfirmasi_judul');
			} */
		} /* else {
				$dua = "dosen_pembimbing2 = ''";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$dua.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				// header('location: ' . URL . 'siak_konfirmasi_judul');
		} */
		
		if($ada_dosen1 == "ada" and $ada_dosen2 == "ada"){
			echo "<script>alert('Quota Dosen Pembimbing 1 dan Dosen Pembimbing 2 Penuh');window.location.href='".URL."siak_konfirmasi_judul';</script>";
			return 0;
		}else if($ada_dosen1 == "ada"){
			echo "<script>alert('Quota Dosen Pembimbing 1 Penuh');window.location.href='".URL."siak_konfirmasi_judul';</script>";
			return 0;
		}else if($ada_dosen2 == "ada"){
			echo "<script>alert('Quota Dosen Pembimbing 2 Penuh');window.location.href='".URL."siak_konfirmasi_judul';</script>";
			return 0;
		}
		
		if($_POST['dosen_pembimbing1'] != NULL and $_POST['dosen_pembimbing2'] != NULL){
			if($ada_dosen1 != "ada" and $ada_dosen2 != "ada"){
				$satu = "dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$satu.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				$dua = "dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$dua.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				header('location: ' . URL . 'siak_konfirmasi_judul');
			}
		}else if($_POST['dosen_pembimbing1'] != NULL){
			if($ada_dosen1 != "ada"){
				$satu = "dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$satu.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				header('location: ' . URL . 'siak_konfirmasi_judul');
			}
		}else if($_POST['dosen_pembimbing2'] != NULL){
			if($ada_dosen2 != "ada"){
				$dua = "dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$dua.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				header('location: ' . URL . 'siak_konfirmasi_judul');
			}
		}
		
		/* if($_POST['dosen_pembimbing3'] != NULL){
			$where2 = array('nip' => $_POST['dosen_pembimbing3']);
			foreach($this->siak_model->siak_edit($where2, "dosen_pembimbing", "*") as $key => $value){
				$jumlah_pem3 = $value['jml_mahasiswa_max'];
			}
			$jumlah_mhs3 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_judul_tesis WHERE dosen_pembimbing3 = '".$_POST['dosen_pembimbing3']."' AND status <> '3' AND status = '2';"));
			if($jumlah_mhs3 >= $jumlah_pem3){
				echo "<script>alert('Quota Dosen Pembimbing 3 Penuh');window.location.href='".URL."siak_konfirmasi_judul';</script>";return 0;
			} else {
				$tiga = "dosen_pembimbing3 = '".$_POST['dosen_pembimbing3']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$tiga.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
				header('location: ' . URL . 'siak_konfirmasi_judul');
			}
		} else {
			$tiga = "dosen_pembimbing3 = ''";
			$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis SET ".$tiga.",status = '2' WHERE judultesis_id = '".$judultesis_id."';");
			header('location: ' . URL . 'siak_konfirmasi_judul');
		} */
	}

	public function siak_delete($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_konfirmasi_judul');
	}
	
	public function siak_batal($judultesis_id){
		$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis set status = 1,dosen_pembimbing1='',dosen_pembimbing2='' WHERE judultesis_id = ".$judultesis_id.";");
		header('location: ' . URL . 'siak_konfirmasi_judul');
	}

}

?>