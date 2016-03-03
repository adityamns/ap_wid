<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_hasil_sidang extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		// $this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "hasil_sidang") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->loads  = $value['loads'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_view->config = "Siak Unhan - Hasil Sidang Proposal";
	
		$this->siak_view->judul = "Hasil Sidang Proposal";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Hasil Sidang Proposal','href'=>''. URL . 'siak_hasil_sidang'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_datalist();	
	}

	public function siak_datalist(){
		$nimnim = $this->siak_model->siak_query("select", "SELECT pendaftaran_judul_tesis.nim FROM proto_sidang,pendaftaran_judul_tesis WHERE proto_sidang.judultesis_id = pendaftaran_judul_tesis.judultesis_id");
		
		$kode=array();
		foreach ($nimnim as $key => $row)
		{
			array_push($kode,"'".$row['nim']."'");
		}
		
		if($kode != NULL){
			$implode = implode($kode,',');
		} else {
			$implode = "''";
		}
		
		// $method_or_uri = 'siak_hasil_sidang';
		// $this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "
		SELECT * FROM (SELECT 
			pendaftaran_judul_tesis.nim,
			pendaftaran_judul_tesis.judultesis_id,
			pendaftaran_judul_tesis.judul,
			jadwal_sidang.ruang_id ,
			proto_sidang.total as sumnilai,
			(SELECT nama FROM aturan_nilai WHERE nilaimin <= proto_sidang.total AND nilaimax >= proto_sidang.total) as grade,proto_sidang.hasil_lulus
		FROM 
			jadwal_sidang,
			proto_sidang,
			pendaftaran_judul_tesis
		WHERE
			jadwal_sidang.judultesis_id = pendaftaran_judul_tesis.judultesis_id AND 
			jadwal_sidang.judultesis_id = proto_sidang.judultesis_id AND 
			pendaftaran_judul_tesis.status <> '1' AND
			pendaftaran_judul_tesis.status <> '2'
		UNION
		SELECT
			pendaftaran_judul_tesis.nim,
			pendaftaran_judul_tesis.judultesis_id,
			pendaftaran_judul_tesis.judul,
			jadwal_sidang.ruang_id,
			0 as sumnilai,
			'-' as grade,
			null as hasil_lulus
		FROM 
			jadwal_sidang,
			pendaftaran_judul_tesis
		WHERE 
			pendaftaran_judul_tesis.nim NOT IN (".$implode.") AND
			jadwal_sidang.judultesis_id = pendaftaran_judul_tesis.judultesis_id AND 
			pendaftaran_judul_tesis.status <> '1' AND
			pendaftaran_judul_tesis.status <> '2' ) as a
		GROUP BY
			a.nim,
			a.judultesis_id,
			a.judul,
			a.ruang_id,
			a.sumnilai,
			a.grade,
			a.hasil_lulus
		");
		$this->siak_view->siak_mahasiswa = $this->siak_model->siak_data_list("view_mahasiswa", "*");
		$this->siak_view->siak_nilai = $this->siak_model->siak_query("select", "SELECT judultesis_id,total,(SELECT nama FROM aturan_nilai WHERE nilaimin <= total AND nilaimax >= total) FROM proto_sidang;");
		$this->siak_view->mahasiswa = $this->siak_model->siak_query("select","select * from mahasiswa");
		$this->siak_view->matakuliah = $this->siak_model->siak_query("select","select * from matakuliah");
		$this->siak_view->nm = $this->siak_model->siak_query("select","select * from nilai_mahasiswa");
		$this->siak_view->siak_render('siak_hasil_sidang/data', false);
	}
	
	public function siak_edit($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_view->siak_dosen = $this->siak_model->siak_query("select", "
		SELECT a.*, b.nama from dosen_pembimbing a, pembimbing b where b.kode=a.nip and penguji='TRUE'
		union
		SELECT a.*, b.nama from dosen_pembimbing a, penguji b where b.kode=a.nip and penguji='TRUE'
		");
		$this->siak_view->siak_jadwal = $this->siak_model->siak_edit($where, "jadwal_sidang", "*");
		
		foreach($this->siak_model->siak_edit($where, "pendaftaran_judul_tesis", "*") as $key => $value){
			$pem1 = array('kode' => $value['dosen_pembimbing1']);
			$pem2 = array('kode' => $value['dosen_pembimbing2']);
			$pem3 = array('kode' => $value['dosen_pembimbing3']);
		}
		
		$this->siak_view->pembimbing1 = $this->siak_model->siak_edit($pem1, "pembimbing", "*");
		$this->siak_view->pembimbing2 = $this->siak_model->siak_edit($pem2, "pembimbing", "*");
		$this->siak_view->pembimbing3 = $this->siak_model->siak_edit($pem3, "pembimbing", "*");
		
		//MAHASISWA
		foreach($this->siak_model->siak_edit($where, "pendaftaran_judul_tesis", "*") as $key => $value){
			$where1 = array('nim' => $value['nim']);
		}
		
			$this->siak_view->siak_mhs = $this->siak_model->siak_edit($where1, "view_mahasiswa", "*");
		
		
		$this->siak_view->judultesis_id = $judultesis_id;
		$this->siak_view->siak_render('siak_hasil_sidang/edit', true);
	}
	
	public function siak_create(){
		$judultesis_id 	= $_POST['judultesis_id'];	
		$nilai			= $_POST['nilai'];
		$keterangan		= $_POST['keterangan'];
		$hasil			= $_POST['hasil'];		
		$total			= count($_POST['nip']);		
		$nip			= $_POST['nip'];		
		$nim			= $_POST['nim'];		
		$nilaipenguji	= $_POST['nilaipenguji'];		
		$jenis			= $_POST['jenis'];		
		$this->siak_model->siak_query("insert", "INSERT INTO hasil_sidang (judultesis_id,nilai,keterangan,hasil) VALUES ('".$judultesis_id."','".$nilai."','".$keterangan."','".$hasil."')");
		$id = $this->siak_model->siak_query("select","SELECT id FROM hasil_sidang ORDER BY id DESC LIMIT 1");
		foreach ($id as $key => $ida ){
			$hasil_sidang_id = $ida['id'];
		}
		for ($i=0 ; $i < $total; $i++){
			$this->siak_model->siak_query("insert", "INSERT INTO hasil_sidang_detail (hasil_sidang_id,nip,nilai,jenis) VALUES ('".$hasil_sidang_id."','".$nip[$i]."','".$nilaipenguji[$i]."','".$jenis[$i]."')");
		}
		
		$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis set status = 4 WHERE judultesis_id = ".$judultesis_id.";");
		header('location: ' . URL . 'siak_hasil_sidang');
	}
	
	public function siak_edit_hasil($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_view->siak_sidang = $this->siak_model->siak_edit($where, "hasil_sidang", "*");		
		foreach($this->siak_view->siak_sidang as $key => $value){
			$hasil_sidang_id = $value['id'];
		}
		$this->siak_view->siak_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_jadwal = $this->siak_model->siak_edit($where, "jadwal_sidang", "*");
		$this->siak_view->siak_detail_hasil_penguji = $this->siak_model->siak_query("select", "
		SELECT penguji.id,nama,hasil_sidang_detail.id as id_hasil,hasil_sidang_id,nilai 
		FROM penguji,hasil_sidang_detail 
		WHERE penguji.id = hasil_sidang_detail.nip AND hasil_sidang_id = '".$hasil_sidang_id."'
		");
		
		foreach($this->siak_model->siak_edit($where, "pendaftaran_judul_tesis", "*") as $key => $value){
			$pem1 = $value['dosen_pembimbing1'];
			$pem2 = $value['dosen_pembimbing2'];
			$pem3 = $value['dosen_pembimbing3'];
		}
		
		$this->siak_view->pembimbing1 = $this->siak_model->siak_query("select", "SELECT pembimbing.id,kode,nama,hasil_sidang_detail.id as id_hasil,hasil_sidang_id,nilai FROM pembimbing,hasil_sidang_detail WHERE pembimbing.id = hasil_sidang_detail.nip AND hasil_sidang_id ='".$hasil_sidang_id."' AND kode = '".$pem1."';");
		$this->siak_view->pembimbing2 = $this->siak_model->siak_query("select", "SELECT pembimbing.id,kode,nama,hasil_sidang_detail.id as id_hasil,hasil_sidang_id,nilai FROM pembimbing,hasil_sidang_detail WHERE pembimbing.id = hasil_sidang_detail.nip AND hasil_sidang_id ='".$hasil_sidang_id."' AND kode = '".$pem2."';");
		$this->siak_view->pembimbing3 = $this->siak_model->siak_query("select", "SELECT pembimbing.id,kode,nama,hasil_sidang_detail.id as id_hasil,hasil_sidang_id,nilai FROM pembimbing,hasil_sidang_detail WHERE pembimbing.id = hasil_sidang_detail.nip AND hasil_sidang_id ='".$hasil_sidang_id."' AND kode = '".$pem3."';");
		
		//MAHASISWA
		foreach($this->siak_model->siak_edit($where, "pendaftaran_judul_tesis", "*") as $key => $value){
			$where1 = array('nim' => $value['nim']);
		}
		foreach($this->siak_model->siak_edit($where1, "mahasiswa", "*") as $key => $value){
			$jenis = $value['jenis'];
			$prodi = $value['prodi_id'];
		}
		if($jenis == 'umum'){
			$this->siak_view->siak_mhs = $this->siak_model->siak_edit($where1, "data_pribadi_umum", "*");
		} else if($jenis == 'pns') {
			$this->siak_view->siak_mhs = $this->siak_model->siak_edit($where1, "data_pribadi_pns", "*");
		}
		
		$this->siak_view->judultesis_id = $judultesis_id;
		$this->siak_view->siak_render('siak_hasil_sidang/edit_hasil', true);
	}
	
	public function siak_update(){
		$judultesis_id 	= $_POST['judultesis_id'];
		$nilai 			= $_POST['nilai'];
		$keterangan 	= $_POST['keterangan'];
		$hasil		  	= $_POST['hasil'];
		$id			  	= $_POST['id'];
		$nip		  	= $_POST['nip'];
		$nim		  	= $_POST['nim'];
		$nilaipenguji	= $_POST['nilaipenguji'];
		$total			= count($id);
		$this->siak_model->siak_query("update", "UPDATE hasil_sidang set nilai = '".$nilai."', keterangan = '".$keterangan."', hasil = '".$hasil."' WHERE judultesis_id = '".$judultesis_id."';");
		for ($i=0 ; $i < $total; $i++){
			$this->siak_model->siak_query("update", "UPDATE hasil_sidang_detail set nilai = '".$nilaipenguji[$i]."' where id = '".$id[$i]."';");
		}
		// $id = $this->siak_model->siak_query("select","SELECT id FROM yudisium WHERE nim = '".$nim."'");
		// if($hasil == 1 && $id == NULL){
			// $this->siak_model->siak_query("insert", "INSERT INTO yudisium (nim,status) VALUES ('".$nim."','1')");
		// } elseif($hasil == 2) {
			// $this->siak_model->siak_query("delete", "DELETE FROM yudisium WHERE nim = '".$nim."'");
		// }
		header('location: ' . URL . 'siak_hasil_sidang');
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
			$where_jadwal = array('judulsidangtesis_id' => $value['judultesis_id']);
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
		}
		
		$this->siak_view->siak_komponen = $this->siak_model->siak_edit($id_bobot_tesis, "komponen_tesis", "*");
		$this->siak_view->jml = sizeof($this->siak_view->siak_komponen);
		$i = 1;
		foreach($this->siak_view->siak_komponen as $key => $value){
			$id_komponen_tesis = array('id_komponen_tesis' => $value['id']);
			$this->siak_view->siak_sub_komponen[$i] = $this->siak_model->siak_edit($id_komponen_tesis, "sub_komponen_tesis", "*");
			$i++;
		}
		
		$this->siak_view->proto_sidang = $this->siak_model->siak_edit($where,"proto_sidang","*");
		
		$this->siak_view->nm = $this->siak_model->siak_edit($where,"nilai_mahasiswa","*");
		
		$this->siak_view->judultesis_id = $this->siak_model->siak_edit($where,"pendaftaran_judul_tesis","*");
		
		$this->siak_view->siak_render('siak_hasil_sidang/edit', false);
	}
	
	function siak_create_sidang($nim){
		$where = array('nim' => $nim);
		foreach($this->siak_model->siak_edit($where, "mahasiswa", "*") as $key => $value){
			$jenis = $value['jenis'];

			$prodi = $value['prodi_id'];
			$tahun_masuk = $value['tahun_masuk'];
		}
		
		foreach($this->siak_model->siak_edit($where, "pendaftaran_tesis", "*") as $key => $value){
			$where_jadwal = array('judulsidangtesis_id' => $value['judultesis_id']);
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
		
		$lulus = $_POST['hasil'];
		
		$ket = $_POST['keterangan'];
		
		$judultesis_id = $_POST['judultesis_id'];
		
		$this->siak_model->siak_query("insert","insert into proto_sidang(".$isi."nim,hasil,pembimbing,penguji,total,hasil_lulus,ket,judultesis_id) values(".$ex_values."'".$nim."','".$coba_persen."','".$tot_pembimbing."','".$tot_penguji."','".$total."',".$lulus.",'".$ket."','".$judultesis_id."')");
		header('location: ' . URL . 'siak_hasil_sidang/siak_nilai/'.$nim);
	}
	
	function siak_edit_save($nim){
		$where = array('nim' => $nim);
		foreach($this->siak_model->siak_edit($where, "mahasiswa", "*") as $key => $value){
			$jenis = $value['jenis'];
			$prodi = $value['prodi_id'];
			$tahun_masuk = $value['tahun_masuk'];
		}
		
		foreach($this->siak_model->siak_edit($where, "pendaftaran_tesis", "*") as $key => $value){
			$where_jadwal = array('judulsidangtesis_id' => $value['judultesis_id']);
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
		
		$lulus = $_POST['hasil'];
		
		$ket = $_POST['keterangan'];
		
		$this->siak_model->siak_query("update","update proto_sidang set ".$gabung.",hasil='".$coba_persen."',pembimbing='".$tot_pembimbing."',penguji='".$tot_penguji."',total='".$total."',hasil_lulus=".$lulus.",ket='".$ket."' where nim='".$nim."'");
		header('location: ' . URL . 'siak_hasil_sidang/siak_nilai/'.$nim);
	}
	
}

?>