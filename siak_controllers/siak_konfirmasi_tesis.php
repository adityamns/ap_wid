<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_konfirmasi_tesis extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Konfirmasi Tesis";
	
		$this->siak_view->judul = "Konfirmasi Tesis";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Konfirmasi Tesis','href'=>''. URL . 'siak_konfirmasi_judul'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "konfirmasi_tesis") {
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
		$cek_po = $this->siak_model->siak_query("select","select * from proto");
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
		
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("pembimbing", "*");
		$this->siak_view->siak_mahasiswa = $this->siak_model->siak_data_list("view_mahasiswa", "*");
		if(Siak_session::siak_get('level') == '16'){
			$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","select * from pendaftaran_tesis where nim='".Siak_session::siak_get('username')."' and judultesis_id not in(".$isis.")");
		}else{
			if(Siak_session::siak_get('prodi') == ""){
				$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","select * from pendaftaran_tesis where judultesis_id not in(".$isis.")");
			}else{
				$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","select * from pendaftaran_tesis where prodi_id='".Siak_session::siak_get('prodi')."'and judultesis_id not in(".$isis.")");
			}
		}
		$this->siak_view->siak_render('siak_konfirmasi_tesis/data', false);
	}

	public function siak_add(){
		$where1 = array('jenis_dosen_pembimbing' => 1);
		$where2 = array('jenis_dosen_pembimbing' => 2);
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_edit($where1, "dosen_pembimbing", "*");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_edit($where2, "dosen_pembimbing", "*");
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_data_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_konfirmasi_tesis/add', true);
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_konfirmasi_tesis');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_tesis", "*");
		
		//DOSEN
		foreach($this->siak_view->siak_data as $key => $value){
			$nim = $value['nim'];
			$this->siak_view->dosen_pembimbing1 = $value['dosen_pembimbing1'];
			$this->siak_view->dosen_pembimbing2 = $value['dosen_pembimbing2'];
			$this->siak_view->dosen_pembimbing3 = $value['dosen_pembimbing3'];
		}
		// $where1 = array('nip' => $dosen_pembimbing1);
		// $where2 = array('nip' => $dosen_pembimbing2);
		// $where3 = array('nip' => $dosen_pembimbing3);
		// $this->siak_view->siak_pembimbing1 = $this->siak_model->siak_edit($where1, "dosen", "*");
		// $this->siak_view->siak_pembimbing2 = $this->siak_model->siak_edit($where2, "dosen", "*");
		// $this->siak_view->siak_pembimbing3 = $this->siak_model->siak_edit($where3, "dosen", "*");
		
		// $a = array('id' => $id);
		// $this->siak_view->siak_data_pembimbing = $this->siak_model->siak_edit($a, "pendaftaran_tesis", "*");
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
		
		$this->siak_view->siak_render('siak_konfirmasi_tesis/edit', true);
	}
	public function siak_detail($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_tesis", "*");
		$this->siak_view->siak_render('siak_konfirmasi_tesis/view', false);
	}

	public function siak_edit_save($id){
		
		/* if($_POST['dosen_pembimbing1'] != NULL){
			$where = array('nip' => $_POST['dosen_pembimbing1']);
			foreach($this->siak_model->siak_edit($where, "dosen_pembimbing", "*") as $key => $value){
				$jumlah_pem1 = $value['jml_mahasiswa_max'];
			}
			$jumlah_mhs1 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_tesis WHERE dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."' AND status <> '3' AND status = '2';"));
			
			if($jumlah_mhs1 >= $jumlah_pem1){
				echo "<script>alert('Quota Dosen Pembimbing 1 Penuh');window.location.href='".URL."siak_konfirmasi_tesis';</script>";
				return 0;
			} else {
				$satu = "dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis SET ".$satu.",status = '2' WHERE id = '".$id."';");
				header('location: ' . URL . 'siak_konfirmasi_tesis');
			}
		} else {
				$satu = "dosen_pembimbing1 = ''";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis SET ".$satu.",status = '2' WHERE id = '".$id."';");
				header('location: ' . URL . 'siak_konfirmasi_tesis');
		}
		
		if($_POST['dosen_pembimbing2'] != NULL){
			$where1 = array('nip' => $_POST['dosen_pembimbing2']);
			foreach($this->siak_model->siak_edit($where1, "dosen_pembimbing", "*") as $key => $value){
				$jumlah_pem2 = $value['jml_mahasiswa_max'];
			}
			$jumlah_mhs2 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_tesis WHERE dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."' AND status <> '3' AND status = '2';"));
			
			if($jumlah_mhs2 >= $jumlah_pem2){
				echo "<script>alert('Quota Dosen Pembimbing 2 Penuh');window.location.href='".URL."siak_konfirmasi_tesis';</script>";
				return 0;
			} else{
				$dua = "dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis SET ".$dua.",status = '2' WHERE id = '".$id."';");
				header('location: ' . URL . 'siak_konfirmasi_tesis');
			}
		} else {
				$dua = "dosen_pembimbing2 = ''";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis SET ".$dua.",status = '2' WHERE id = '".$id."';");
				header('location: ' . URL . 'siak_konfirmasi_tesis');
		} */
		
		/* if($_POST['dosen_pembimbing3'] != NULL){
			$where2 = array('nip' => $_POST['dosen_pembimbing3']);
			foreach($this->siak_model->siak_edit($where2, "dosen_pembimbing", "*") as $key => $value){
				$jumlah_pem3 = $value['jml_mahasiswa_max'];
			}
			$jumlah_mhs3 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_tesis WHERE dosen_pembimbing3 = '".$_POST['dosen_pembimbing3']."' AND status <> '3' AND status = '2';"));
			if($jumlah_mhs3 >= $jumlah_pem3){
				echo "<script>alert('Quota Dosen Pembimbing 3 Penuh');window.location.href='".URL."siak_konfirmasi_tesis';</script>";
			} else {
				$tiga = "dosen_pembimbing3 = '".$_POST['dosen_pembimbing3']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis SET ".$tiga.",status = '2' WHERE id = '".$id."';");
				header('location: ' . URL . 'siak_konfirmasi_tesis');
			}
		} else {
			$tiga = "dosen_pembimbing3 = ''";
			$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis SET ".$tiga.",status = '2' WHERE id = '".$id."';");
			header('location: ' . URL . 'siak_konfirmasi_tesis');
		} */
		
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
			
			/* $jumlah_mhs1 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_judul_tesis WHERE dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."' AND status <> '3' AND status = '2' and nim not in(".$mhs_nm.");"));
			$jumlah_mhs1_tesis = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_tesis WHERE dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."' AND status <> '3' AND status = '2' and nim not in(".$mhs_nm.");")); */
			$jumlah_mhs1 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_judul_tesis WHERE dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."' and nim not in(".$mhs_nm.");"));
			$jumlah_mhs1_tesis = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_tesis WHERE dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."' and nim not in(".$mhs_nm.");"));
			if(($jumlah_mhs1 + $jumlah_mhs1_tesis) >= $jumlah_pem1){
				$ada_dosen1 = "ada";
			}
		}
		
		if($_POST['dosen_pembimbing2'] != NULL){
			$where1 = array('nip' => $_POST['dosen_pembimbing2']);
			foreach($this->siak_model->siak_edit($where1, "dosen_pembimbing", "*") as $key => $value){
				$jumlah_pem2 = $value['jml_mahasiswa_max'];
			}
			/* $jumlah_mhs2 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_judul_tesis WHERE dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."' AND status <> '3' AND status = '2' and nim not in(".$mhs_nm.");"));
			$jumlah_mhs2_tesis = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_tesis WHERE dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."' AND status <> '3' AND status = '2' and nim not in(".$mhs_nm.");")); */
			$jumlah_mhs2 = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_judul_tesis WHERE dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."' and nim not in(".$mhs_nm.");"));
			$jumlah_mhs2_tesis = sizeof($this->siak_model->siak_query("select", "SELECT * FROM pendaftaran_tesis WHERE dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."' and nim not in(".$mhs_nm.");"));
			if(($jumlah_mhs2 + $jumlah_mhs2_tesis) >= $jumlah_pem2){
				$ada_dosen2 = "ada";
			}
		}
		
		if($ada_dosen1 == "ada" and $ada_dosen2 == "ada"){
			echo "<script>alert('Quota Dosen Pembimbing 1 dan Dosen Pembimbing 2 Penuh');window.location.href='".URL."siak_konfirmasi_tesis';</script>";
			return 0;
		}else if($ada_dosen1 == "ada"){
			echo "<script>alert('Quota Dosen Pembimbing 1 Penuh');window.location.href='".URL."siak_konfirmasi_tesis';</script>";
			return 0;
		}else if($ada_dosen2 == "ada"){
			echo "<script>alert('Quota Dosen Pembimbing 2 Penuh');window.location.href='".URL."siak_konfirmasi_tesis';</script>";
			return 0;
		}
		
		if($_POST['dosen_pembimbing1'] != NULL and $_POST['dosen_pembimbing2'] != NULL){
			if($ada_dosen1 != "ada" and $ada_dosen2 != "ada"){
				$satu = "dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis SET ".$satu.",status = '2' WHERE id = '".$id."';");
				$dua = "dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis SET ".$dua.",status = '2' WHERE id = '".$id."';");
				header('location: ' . URL . 'siak_konfirmasi_tesis');
			}
		}else if($_POST['dosen_pembimbing1'] != NULL){
			if($ada_dosen1 != "ada"){
				$satu = "dosen_pembimbing1 = '".$_POST['dosen_pembimbing1']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis SET ".$satu.",status = '2' WHERE id = '".$id."';");
				header('location: ' . URL . 'siak_konfirmasi_tesis');
			}
		}else if($_POST['dosen_pembimbing2'] != NULL){
			if($ada_dosen2 != "ada"){
				$dua = "dosen_pembimbing2 = '".$_POST['dosen_pembimbing2']."'";
				$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis SET ".$dua.",status = '2' WHERE id = '".$id."';");
				header('location: ' . URL . 'siak_konfirmasi_tesis');
			}
		}
		
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_konfirmasi_tesis');
	}
	
	public function siak_batal($id){
		$this->siak_model->siak_query("update", "UPDATE pendaftaran_tesis set status = 1,dosen_pembimbing1='',dosen_pembimbing2='' WHERE id = ".$id.";");
		header('location: ' . URL . 'siak_konfirmasi_tesis');
	}

}

?>