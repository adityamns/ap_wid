<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_hasil_sidang extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
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
		$this->siak_datalist();	
	}

	public function siak_datalist(){
		$nimnim = $this->siak_model->siak_query("select", "SELECT pendaftaran_judul_tesis.nim FROM hasil_sidang,pendaftaran_judul_tesis WHERE hasil_sidang.judultesis_id = pendaftaran_judul_tesis.judultesis_id");
		
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
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "
		SELECT * FROM (SELECT 
			pendaftaran_judul_tesis.nim,
			pendaftaran_judul_tesis.judultesis_id,
			pendaftaran_judul_tesis.judul,
			jadwal_sidang.ruang_id ,
			hasil_sidang.nilai as sumnilai,
			(SELECT nama FROM aturan_nilai WHERE nilaimin <= hasil_sidang.nilai AND nilaimax >= hasil_sidang.nilai) as grade,hasil_sidang.hasil
		FROM 
			jadwal_sidang,
			hasil_sidang,
			pendaftaran_judul_tesis
		WHERE
			jadwal_sidang.judultesis_id = pendaftaran_judul_tesis.judultesis_id AND 
			jadwal_sidang.judultesis_id = hasil_sidang.judultesis_id AND 
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
			null as hasil
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
			a.hasil
		");
		$this->siak_view->siak_mahasiswa = $this->siak_model->siak_data_list("view_mahasiswa", "*");
		$this->siak_view->siak_nilai = $this->siak_model->siak_query("select", "SELECT judultesis_id,nilai,(SELECT nama FROM aturan_nilai WHERE nilaimin <= nilai AND nilaimax >= nilai) FROM hasil_sidang;");		
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
	
}

?>