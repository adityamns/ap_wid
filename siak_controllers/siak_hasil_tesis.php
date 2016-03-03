<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_hasil_tesis extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->siak_view->config = "Siak Widyatama - Hasil Sidang Tesis";
	
		$this->siak_view->judul = "Hasil Sidang Tesis";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Hasil Sidang Tesis','href'=>''. URL . 'siak_hasil_tesis'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "hasil_tesis") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_hasil_tesis();
	}

	function siak_hasil_tesis(){
		if(Siak_session::siak_get('level')==16){
			$mhs = $this->siak_model->siak_query("select","select * from view_mahasiswa where nim='".Siak_session::siak_get('username')."'");
			foreach($mhs as $maha => $siswa){
				$tahun = $siswa['tahun_masuk'];
				$this->siak_view->tahuns = $siswa['tahun_masuk'];
				$prodi = $siswa['prodi_id'];
				$this->siak_view->prodis = $siswa['prodi_id'];
			}
			
			$bobot_tesis = $this->siak_model->siak_query("select","select * from bobot_tesis where tahun_id='".$tahun."' and prodi_id='".$prodi."'");
		
		foreach($bobot_tesis as $bobot => $tesis){
			$matkul_tesis = $tesis['matkul_id'];
		}
			
			$this->siak_view->mahasiswa = $this->siak_model->siak_query("select", "
				SELECT 
				jadwal_sidang_tesis.id,
				a.nim,
				a.tahun_masuk,
				a.nama_depan,
				a.nama_belakang,
				a.prodi_id,
				a.prodi
				 
			FROM 
				view_mahasiswa a,
				pendaftaran_tesis b,
				jadwal_sidang_tesis
				
				
			WHERE 
			a.nim='".Siak_session::siak_get('username')."' and
				a.nim=jadwal_sidang_tesis.nim AND jadwal_sidang_tesis.judulsidangtesis_id=b.id");
			$this->siak_view->nm = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where matkul_id='".$matkul_tesis."' and nim='".Siak_session::siak_get('username')."'");
			$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
			$this->siak_view->siak_render('siak_hasil_tesis/tabel', false);
		}else{
			if(Siak_session::siak_get('prodi') == ""){
				$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
				$this->siak_view->siak_render('siak_hasil_tesis/index', false);
			}else{
				$this->siak_view->proprodi = Siak_session::siak_get('prodi');
				$this->siak_view->coi = "a";
				$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
				$this->siak_view->siak_render('siak_hasil_tesis/index', false);
			}
		}
	}
	
	function getbobot($tahun,$prodi){
		$bobot_tesis = $this->siak_model->siak_query("select","select * from bobot_tesis where tahun_id='".$tahun."' and prodi_id='".$prodi."'");
		
		foreach($bobot_tesis as $bobot => $tesis){
			$matkul_tesis = $tesis['matkul_id'];
		}
		
		$this->siak_view->mahasiswa = $this->siak_model->siak_query("select", "
				SELECT 
			jadwal_sidang_tesis.id,
			a.nim,
			a.tahun_masuk,
			a.nama_depan,
			a.nama_belakang,
			a.prodi_id,
			a.prodi
			 
		FROM 
			view_mahasiswa a,
			pendaftaran_tesis b,
			jadwal_sidang_tesis
			
			
		WHERE 
			a.nim=jadwal_sidang_tesis.nim AND jadwal_sidang_tesis.judulsidangtesis_id=b.id  AND a.tahun_masuk = '".$tahun."' AND a.prodi_id = '".$prodi."'


		");
		
		$this->siak_view->nm = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where matkul_id='".$matkul_tesis."'");
		$this->siak_view->siak_render('siak_hasil_tesis/tabel', true);
	}
	
	function siak_data(){
		
		$tahun = $_POST['TAHUN'];
		$prodi = $_POST['PRODI'];
		
		$bobot_tesis = $this->siak_model->siak_query("select","select * from bobot_tesis where tahun_id='".$tahun."' and prodi_id='".$prodi."'");
		
		foreach($bobot_tesis as $bobot => $tesis){
			$matkul_tesis = $tesis['matkul_id'];
		}
		
		$data['mahasiswa'] = $this->siak_model->siak_query("select", "
				SELECT 
			jadwal_sidang_tesis.id,
			a.nim,
			a.tahun_masuk,
			a.nama_depan,
			a.nama_belakang,
			a.prodi_id,
			a.prodi
			 
		FROM 
			view_mahasiswa a,
			jadwal_sidang_tesis
			
			
		WHERE 
			a.nim=jadwal_sidang_tesis.nim  AND a.tahun_masuk = '".$tahun."' AND a.prodi_id = '".$prodi."'


		");
		
		$data['nm'] = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where matkul_id='".$matkul_tesis."'");
		echo json_encode($data);
	}
	
	function siak_nilai($nim){
		$where = array('nim' => $nim);
		foreach($this->siak_model->siak_edit($where, "mahasiswa", "*") as $key => $value){
			$jenis = $value['jenis'];
			$prodi = $value['prodi_id'];
			$tahun_masuk = $value['tahun_masuk'];
		}
		$this->siak_view->siak_mhs = $this->siak_model->siak_edit($where, "view_mahasiswa", "*");
		
		foreach($this->siak_model->siak_edit($where, "pendaftaran_tesis", "*") as $key => $value){
			// $where_jadwal = array('judulsidangtesis_id' => $value['judultesis_id']);
			$this->siak_view->sad = $value['judultesis_id'];
			$where_jadwal = array('judulsidangtesis_id' => $value['id']);
			$pembimbing[1] = $value['dosen_pembimbing1'];
			$pembimbing[2] = $value['dosen_pembimbing2'];
			$pembimbing[3] = $value['dosen_pembimbing3'];
		}
		
		for($a=1;$a<=2;$a++){
			$this->siak_view->siak_pembimbing[$a] = $this->siak_model->siak_query("select", "SELECT a.nip,b.nama FROM dosen_pembimbing as a,pembimbing as b WHERE a.nip = b.kode AND a.jenis_dosen_pembimbing = ".$a." AND a.nip = '".$pembimbing[$a]."'");
		}
		
		$this->siak_view->siak_penguji = $this->siak_model->siak_query("select", "
		SELECT a.*, b.nama from dosen_pembimbing a, pembimbing b where b.kode=a.nip and penguji='TRUE'
		union
		SELECT a.*, b.nama from dosen_pembimbing a, penguji b where b.kode=a.nip and penguji='TRUE'
		");
		
		$this->siak_view->siak_jadwal = $this->siak_model->siak_edit($where_jadwal, "jadwal_sidang_tesis", "*");
		$i=1;
				$judul=array();
				$all_penguji=array();
		foreach ($this->siak_view->siak_jadwal as $key => $values){
			$p = explode(',', $values['penguji_id']);
			$pengujinya1 = $this->siak_model->siak_query("select","select * from penguji where kode='".$p[0]."'");
			foreach($pengujinya1 as $pengu1 => $jinya1){
				$this->siak_view->pengujinya[0] = $jinya1['nama'];
			}
			$pengujinya2 = $this->siak_model->siak_query("select","select * from penguji where kode='".$p[1]."'");
			foreach($pengujinya2 as $pengu2 => $jinya2){
				$this->siak_view->pengujinya[1] = $jinya2['nama'];
			}
			$pengujinya3 = $this->siak_model->siak_query("select","select * from penguji where kode='".$p[2]."'");
			foreach($pengujinya3 as $pengu3 => $jinya3){
				$this->siak_view->pengujinya[2] = $jinya3['nama'];
			}
			$this->siak_view->JP = sizeof($p);
			for($x=0 ; $x < $this->siak_view->JP; $x++){
				$judul['data']=$p[$x];
				array_push($all_penguji,$judul);
			}
		}
		$this->siak_view->all_penguji=$all_penguji;
		
		$bobot_where = array('tahun_id' => $tahun_masuk, 'prodi_id' => $prodi);
		foreach($this->siak_model->siak_edit($bobot_where, "bobot_tesis", "*") as $key => $value){
			$id_bobot_tesis = array('id_bobot_tesis' => $value['id']);
			$this->siak_view->pembimbing = $value['pembimbing'];
			$this->siak_view->penguji = $value['penguji'];
			$this->siak_view->matkul_tesis = $value['matkul_id'];
		}
		
		$this->siak_view->siak_komponen = $this->siak_model->siak_edit($id_bobot_tesis, "komponen_tesis", "*");
		$this->siak_view->jml = sizeof($this->siak_view->siak_komponen);
		$i = 1;
		foreach($this->siak_view->siak_komponen as $key => $value){
			$id_komponen_tesis = array('id_komponen_tesis' => $value['id']);
			$this->siak_view->siak_sub_komponen[$i] = $this->siak_model->siak_edit($id_komponen_tesis, "sub_komponen_tesis", "*");
			$i++;
		}
		
		$this->siak_view->proto = $this->siak_model->siak_edit($where,"proto","*");
		
		$this->siak_view->nm = $this->siak_model->siak_query("select","select * from nilai_mahasiswa where nim='".$nim."' and matkul_id='".$this->siak_view->matkul_tesis."'");
		
		$this->siak_view->siak_render('siak_hasil_tesis/add', false);
	}
	
	function siak_create($nim){
		$where = array('nim' => $nim);
		foreach($this->siak_model->siak_edit($where, "mahasiswa", "*") as $key => $value){
			$jenis = $value['jenis'];
			$prodi = $value['prodi_id'];
			$tahun_masuk = $value['tahun_masuk'];
		}
		
		foreach($this->siak_model->siak_edit($where, "pendaftaran_tesis", "*") as $key => $value){
			// $where_jadwal = array('judulsidangtesis_id' => $value['judultesis_id']);
			$where_jadwal = array('judulsidangtesis_id' => $value['id']);
		}
		
		$this->siak_view->siak_jadwal = $this->siak_model->siak_edit($where_jadwal, "jadwal_sidang_tesis", "*");
		$i=1;
				$judul=array();
				$all_penguji=array();
		foreach ($this->siak_view->siak_jadwal as $key => $values){
			$p = explode(',', $values['penguji_id']);
			$this->siak_view->JP = sizeof($p);
			for($x=0 ; $x < $this->siak_view->JP; $x++){
				$judul['data']=$p[$x];
				array_push($all_penguji,$judul);
			}
		}
		
		$bobot_where = array('tahun_id' => $tahun_masuk, 'prodi_id' => $prodi);
		foreach($this->siak_model->siak_edit($bobot_where, "bobot_tesis", "*") as $key => $value){
			$id_bobot_tesis = array('id_bobot_tesis' => $value['id']);
			$this->siak_view->pembimbing = $value['pembimbing'];
			$this->siak_view->penguji = $value['penguji'];
			$this->siak_view->matkul_id = $value['matkul_id'];
		}
		
		$this->siak_view->siak_komponen = $this->siak_model->siak_edit($id_bobot_tesis, "komponen_tesis", "*");
		$this->siak_view->jml = sizeof($this->siak_view->siak_komponen);
		$i = 1;
		foreach($this->siak_view->siak_komponen as $key => $value){
			$id_komponen_tesis = array('id_komponen_tesis' => $value['id']);
			$this->siak_view->siak_sub_komponen[$i] = $this->siak_model->siak_edit($id_komponen_tesis, "sub_komponen_tesis", "*");
			$i++;
		}
		
		$hitung_pembimbing = array();
		$hitung_penguji = array();
		$coba_persen = "";
		$persen_pembimbing = 0;
		$isi = "";
		$ex_values = "";
		
		for($a=1;$a<=2;$a++){
			if($_POST['hasil_pembimbing'.$a] != NULL and $_POST['hasil_pembimbing'.$a] != "NaN"){
				array_push($hitung_pembimbing,$a);
				$i = 1;
				$k = 1;
				$persen[$a] = 0;
				$values[$a] = "";
				foreach($this->siak_view->siak_komponen as $key => $value){
					$ar = array();
					$itung = 0;
					foreach($this->siak_view->siak_sub_komponen[$i] as $sub => $komponen){
						$values[$a] = $values[$a].$_POST['nilai_komponen'.$a.$k].",";
						array_push($ar,$_POST['nilai_komponen'.$a.$k]);
						$itung = $itung + $_POST['nilai_komponen'.$a.$k];
						$k++;
					}
					$jml_ar = sizeof($ar);
					$jml_nk = $itung / $jml_ar;
					$persen[$a] = $persen[$a] + ($jml_nk * ( $_POST['hidden_persentase'.$a.$i] / 100 ));
					$i++;
				}
				$hps_koma_values[$a] = strlen($values[$a]);
				$hps_koma_values[$a] = $hps_koma_values[$a] - 1;
				$values[$a] = substr($values[$a],0,$hps_koma_values[$a]);
				
				$ex_values = $ex_values."'".$values[$a]."',";
				
				$persen[$a] = substr($persen[$a],0,5);
				
				$persen_pembimbing = $persen_pembimbing + $persen[$a];
				$isi = $isi."pembimbing".$a.",";
			}
		}
		
		$persen_penguji = 0;
		
		$x = 4;
		for($a=1;$a<=3;$a++){
			if($_POST['hasil_penguji'.$a] != NULL and $_POST['hasil_penguji'.$a] != "NaN"){
				array_push($hitung_penguji,$a);
				$i = 1;
				$k = 1;
				$persen[$x] = 0;
				$values[$x] = "";
				foreach($this->siak_view->siak_komponen as $key => $value){
					$ar = array();
					$itung = 0;
					foreach($this->siak_view->siak_sub_komponen[$i] as $sub => $komponen){
						$values[$x] = $values[$x].$_POST['nilai_komponen'.$x.$k].",";
						array_push($ar,$_POST['nilai_komponen'.$x.$k]);
						$itung = $itung + $_POST['nilai_komponen'.$x.$k];
						$k++;
					}
					$jml_ar = sizeof($ar);
					$jml_nk = $itung / $jml_ar;
					$persen[$x] = $persen[$x] + ($jml_nk * ( $_POST['hidden_persentase'.$x.$i] / 100 ));
					$i++;
				}
				$hps_koma_values[$x] = strlen($values[$x]);
				$hps_koma_values[$x] = $hps_koma_values[$x] - 1;
				$values[$x] = substr($values[$x],0,$hps_koma_values[$x]);
				
				$ex_values = $ex_values."'".$values[$x]."',";
				
				$persen[$x] = substr($persen[$x],0,5);
				
				$persen_penguji = $persen_penguji + $persen[$x];
				$isi = $isi."penguji".$a.",";
			}
			$x++;
		}
		
		$coba_persen = $persen[1].",".$persen[2].",".$persen[4].",".$persen[5].",".$persen[6];
		
		$size_pembimbing = sizeof($hitung_pembimbing);
		$size_penguji = sizeof($hitung_penguji);
		$tot_pembimbing = ($persen_pembimbing / $size_pembimbing) * $this->siak_view->pembimbing / 100;
		$tot_pembimbing = number_format($tot_pembimbing,2,'.','');
		$tot_penguji = ($persen_penguji / $size_penguji) * $this->siak_view->penguji / 100;
		$tot_penguji = number_format($tot_penguji,2,'.','');
		$total = $tot_pembimbing + $tot_penguji;
		$total = number_format($total,2,'.','');
		
		$sad = $_POST['sad'];
		
		$this->siak_model->siak_query("insert","insert into proto(".$isi."nim,hasil,pembimbing,penguji,total,judultesis_id) values(".$ex_values."'".$nim."','".$coba_persen."','".$tot_pembimbing."','".$tot_penguji."','".$total."','".$sad."')");
		header('location: ' . URL . 'siak_hasil_tesis/siak_nilai/'.$nim);
		
		if($prodi == "SPS"){
			$prodi_isi = "3";
		}else{
			$prodi_isi = "4";
		}
		
		$this->siak_view->aturan_nilai = $this->siak_model->siak_query("select","select * from aturan_nilai where prodi_id='".$prodi."'");
		foreach($this->siak_view->aturan_nilai as $aturan => $nilai){
			if($total <= $nilai['nilaimax'] and $total >= $nilai['nilaimin']){
				$grade = $nilai['nama'];
				$bobot = $nilai['bobot'];
			}
		}
		
		$lulus = $_POST['hasil'];
		
		$ket = $_POST['keterangan'];
		
		$proto_all = $this->siak_model->siak_query("select","select * from proto where nim='".$nim."'");
		
		foreach($proto_all as $pro => $to_all){
			$id_proto = $to_all['id'];
		}
		
		$this->siak_model->siak_query("insert","insert into nilai_mahasiswa(prodi_id,semester,nim,matkul_id,komponen,nilai,nilai_total,grade,bobot,ket,hasil) values('".$prodi."','".$prodi_isi."','".$nim."','".$this->siak_view->matkul_id."','".$id_proto."','".$tot_pembimbing.",".$tot_penguji."','".$total."','".$grade."','".$bobot."','".$ket."','".$lulus."')");
		// $this->siak_model->siak_query("insert","insert into nilai_mahasiswa(prodi_id,semester,nim,matkul_id,komponen,nilai,nilai_total,grade,bobot,ket,hasil) values('DRK','4','120140103001','S-DR4213','1','49.50,40.50','90.00','A','4','as','TRUE')");
	}
	
	function siak_edit_save($nim){
		$where = array('nim' => $nim);
		foreach($this->siak_model->siak_edit($where, "mahasiswa", "*") as $key => $value){
			$jenis = $value['jenis'];
			$prodi = $value['prodi_id'];
			$tahun_masuk = $value['tahun_masuk'];
		}
		
		foreach($this->siak_model->siak_edit($where, "pendaftaran_tesis", "*") as $key => $value){
			// $where_jadwal = array('judulsidangtesis_id' => $value['judultesis_id']);
			$where_jadwal = array('judulsidangtesis_id' => $value['id']);
		}
		
		$this->siak_view->siak_jadwal = $this->siak_model->siak_edit($where_jadwal, "jadwal_sidang_tesis", "*");
		$i=1;
				$judul=array();
				$all_penguji=array();
		foreach ($this->siak_view->siak_jadwal as $key => $values){
			$p = explode(',', $values['penguji_id']);
			$this->siak_view->JP = sizeof($p);
			for($x=0 ; $x < $this->siak_view->JP; $x++){
				$judul['data']=$p[$x];
				array_push($all_penguji,$judul);
			}
		}
		
		$bobot_where = array('tahun_id' => $tahun_masuk, 'prodi_id' => $prodi);
		foreach($this->siak_model->siak_edit($bobot_where, "bobot_tesis", "*") as $key => $value){
			$id_bobot_tesis = array('id_bobot_tesis' => $value['id']);
			$this->siak_view->pembimbing = $value['pembimbing'];
			$this->siak_view->penguji = $value['penguji'];
			$this->siak_view->matkul_id = $value['matkul_id'];
		}
		
		$this->siak_view->siak_komponen = $this->siak_model->siak_edit($id_bobot_tesis, "komponen_tesis", "*");
		$this->siak_view->jml = sizeof($this->siak_view->siak_komponen);
		$i = 1;
		foreach($this->siak_view->siak_komponen as $key => $value){
			$id_komponen_tesis = array('id_komponen_tesis' => $value['id']);
			$this->siak_view->siak_sub_komponen[$i] = $this->siak_model->siak_edit($id_komponen_tesis, "sub_komponen_tesis", "*");
			$i++;
		}
		$nilai_komponen = array();
		
		$hitung_pembimbing = array();
		$hitung_penguji = array();
		$coba_persen = "";
		$persen_pembimbing = 0;
		$gabung = "";
		
		for($a=1;$a<=2;$a++){
			if($_POST['hasil_pembimbing'.$a] != NULL){
				if($_POST['hasil_pembimbing'.$a] != "NaN"){
					array_push($hitung_pembimbing,$a);
				}
				$i = 1;
				$k = 1;
				$persen[$a] = 0;
				$values[$a] = "";
				foreach($this->siak_view->siak_komponen as $key => $value){
					$ar = array();
					$itung = 0;
					foreach($this->siak_view->siak_sub_komponen[$i] as $sub => $komponen){
						$values[$a] = $values[$a].$_POST['nilai_komponen'.$a.$k].",";
						array_push($ar,$_POST['nilai_komponen'.$a.$k]);
						$itung = $itung + $_POST['nilai_komponen'.$a.$k];
						$k++;
					}
					$jml_ar = sizeof($ar);
					$jml_nk = $itung / $jml_ar;
					if($_POST['hasil_pembimbing'.$a] == "NaN"){
						$persen[$a] = "";
					}else{
						$persen[$a] = $persen[$a] + ($jml_nk * ( $_POST['hidden_persentase'.$a.$i] / 100 ));
					}
					$i++;
				}
				$hps_koma_values[$a] = strlen($values[$a]);
				$hps_koma_values[$a] = $hps_koma_values[$a] - 1;
				$values[$a] = substr($values[$a],0,$hps_koma_values[$a]);
				
				$persen_pembimbing = $persen_pembimbing + $persen[$a];
				
				$gabung = $gabung."pembimbing".$a."='".$values[$a]."',";
			}
		}
		
		$persen_penguji = 0;
		
		$x = 4;
		for($a=1;$a<=3;$a++){
			if($_POST['hasil_penguji'.$a] != NULL){
				if($_POST['hasil_penguji'.$a] != "NaN"){
					array_push($hitung_penguji,$a);
				}
				$i = 1;
				$k = 1;
				$persen[$x] = 0;
				$values[$x] = "";
				foreach($this->siak_view->siak_komponen as $key => $value){
					$ar = array();
					$itung = 0;
					foreach($this->siak_view->siak_sub_komponen[$i] as $sub => $komponen){
						$values[$x] = $values[$x].$_POST['nilai_komponen'.$x.$k].",";
						array_push($ar,$_POST['nilai_komponen'.$x.$k]);
						$itung = $itung + $_POST['nilai_komponen'.$x.$k];
						$k++;
					}
					$jml_ar = sizeof($ar);
					$jml_nk = $itung / $jml_ar;
					if($_POST['hasil_penguji'.$a] == "NaN"){
						$persen[$x] = "";
					}else{
						$persen[$x] = $persen[$x] + ($jml_nk * ( $_POST['hidden_persentase'.$x.$i] / 100 ));
					}
					$i++;
				}
				$hps_koma_values[$x] = strlen($values[$x]);
				$hps_koma_values[$x] = $hps_koma_values[$x] - 1;
				$values[$x] = substr($values[$x],0,$hps_koma_values[$x]);
				
				$persen_penguji = $persen_penguji + $persen[$x];
				
				$gabung = $gabung."penguji".$a."='".$values[$x]."',";
			}
			$x++;
		}
		
		$coba_persen = $persen[1].",".$persen[2].",".$persen[4].",".$persen[5].",".$persen[6];
		
		$hps_koma_gabung = strlen($gabung);
		$hps_koma_gabung = $hps_koma_gabung - 1;
		$gabung = substr($gabung,0,$hps_koma_gabung);
		
		$size_pembimbing = sizeof($hitung_pembimbing);
		$size_penguji = sizeof($hitung_penguji);
		$tot_pembimbing = ($persen_pembimbing / $size_pembimbing) * $this->siak_view->pembimbing / 100;
		$tot_pembimbing = number_format($tot_pembimbing,2,'.','');
		$tot_penguji = ($persen_penguji / $size_penguji) * $this->siak_view->penguji / 100;
		$tot_penguji = number_format($tot_penguji,2,'.','');
		$total = $tot_pembimbing + $tot_penguji;
		$total = number_format($total,2,'.','');
		
		$this->siak_model->siak_query("update","update proto set ".$gabung.",hasil='".$coba_persen."',pembimbing='".$tot_pembimbing."',penguji='".$tot_penguji."',total='".$total."' where nim='".$nim."'");
		header('location: ' . URL . 'siak_hasil_tesis/siak_nilai/'.$nim);
		
		if($prodi == "SPS"){
			$prodi_isi = "3";
		}else{
			$prodi_isi = "4";
		}
		
		$this->siak_view->aturan_nilai = $this->siak_model->siak_query("select","select * from aturan_nilai where prodi_id='".$prodi."'");
		foreach($this->siak_view->aturan_nilai as $aturan => $nilai){
			if($total <= $nilai['nilaimax'] and $total >= $nilai['nilaimin']){
				$grade = $nilai['nama'];
				$bobot = $nilai['bobot'];
			}
		}
		
		$lulus = $_POST['hasil'];
		
		$ket = $_POST['keterangan'];
		
		$this->siak_model->siak_query("update","update nilai_mahasiswa set nilai='".$tot_pembimbing.",".$tot_penguji."',nilai_total='".$total."',grade='".$grade."',bobot='".$bobot."',ket='".$ket."',hasil=".$lulus." where nim='".$nim."' and matkul_id='".$this->siak_view->matkul_id."'");
	}
	
	
}

?>