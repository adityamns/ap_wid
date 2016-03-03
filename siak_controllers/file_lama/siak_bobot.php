<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak bobot controller class */

class Siak_bobot extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->config = "Siak Unhan - Setting Bobot Nilai";
	
		$this->siak_view->judul = "Setting Bobot Nilai";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Penilaian','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Setting Bobot Nilai','href'=>''. URL . 'siak_bobot'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_datalist();
	}

	public function siak_datalist(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "penilaian" && $value['kode'] == "penentuan_bobot_nilai") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->matkul = $this->siak_model->siak_data_list("matakuliah", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "select * from bobot order by id desc;");
		$this->siak_view->siak_render('siak_bobot/data', false);
	}

	public function siak_add(){
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->matkul = $this->siak_model->siak_data_list("matakuliah", "*");	
		$this->siak_view->tahun_masuk = $this->siak_model->siak_query("select", "select distinct tahun_masuk from mahasiswa;");
		$this->siak_view->siak_render('siak_bobot/add', true);
	}

	public function siak_create(){
		$tahun=$_POST['tahun_id'];
		$prodi=$_POST['prodi_id'];
		$matkul=$_POST['matkul_id'];
		$semes=$_POST['semester'];
		

		$komponen=$_POST['komponen'];
		$total = count($_POST['komponen']);
		$persentase=$_POST['persentase'];
		$keterangan=$_POST['keterangan'];
		$mulai=$_POST['mulai'];
		$akhir=$_POST['akhir'];

		// $this->siak_model->siak_query("insert", "insert into bobot (tahun_id, prodi_id, semester, matkul_id) VALUES ('$tahun','$prodi','$semes','$matkul')");
		echo "1. insert into bobot (tahun_id, prodi_id, semester, matkul_id) VALUES ('$tahun','$prodi','$semes','$matkul')<br>";
		$id=$this->siak_model->siak_query("select","SELECT id FROM bobot ORDER BY id DESC LIMIT 1");
		
		foreach ($id as $key => $ida ){
			$id_bobot=$ida['id'];
		}
		for ($i=0 ; $i < $total; $i++){
			// $this->siak_model->siak_query("insert", "insert into komponen (id_bobot, komponen, persentase, keterangan,mulai,akhir) VALUES ('".$id_bobot."', '".$komponen[$i]."', '".$persentase[$i]."', '".$keterangan[$i]."', '".$mulai[$i]."', '".$akhir[$i]."')");
			echo "2. insert into komponen (id_bobot, komponen, persentase, keterangan,mulai,akhir) VALUES ('".$id_bobot."', '".$komponen[$i]."', '".$persentase[$i]."', '".$keterangan[$i]."', '".$mulai[$i]."', '".$akhir[$i]."')<br>";
			$id_kompon = $this->siak_model->siak_query("select","SELECT id FROM komponen ORDER BY id DESC LIMIT 1");
			
			foreach ($id_kompon as $key => $idkom ){
				$id_komponen=$idkom['id'];
			}
			
			for ($x=0; $x < sizeof($_POST['sub_komponen'."$i"]); $x++) {
				//$this->siak_model->siak_query("insert", "INSERT INTO sub_komponen (id_komponen, sub_komponen, keterangan) VALUES (".$id_komponen.",'".$_POST['sub_komponen'."$i"][$x]."','');");
				echo "3. INSERT INTO sub_komponen (id_komponen, sub_komponen, keterangan) VALUES (".$id_komponen.",'".$_POST['sub_komponen'."$i"][$x]."','')<br>";
				//echo "INSERT INTO sub_komponen (id_komponen, sub_komponen, keterangan) VALUES (".$id_komponen.",'".$_POST['sub_komponen'."$i"][$x]."','');";
			}
		}
		die();
		header('location: ' . URL . 'siak_bobot');
	}

	public function siak_edit($id){
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->matkul = $this->siak_model->siak_data_list("matakuliah", "*");	
		$this->siak_view->tahun_masuk = $this->siak_model->siak_query("select", "select distinct tahun_masuk from mahasiswa;");
		$where = array('id' => $id);
		$where2 = array('id_bobot' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "bobot", "*");
		$this->siak_view->siak_data_komponen = $this->siak_model->siak_edit($where2, "komponen", "*");
		$this->siak_view->sub_komponen = $this->siak_model->siak_data_list("sub_komponen", "*");
		$this->siak_view->siak_render('siak_bobot/edit', true);
	}

	public function siak_edit_save($id){
		$tahun=$_POST['tahun_id'];
		$prodi=$_POST['prodi_id'];
		$matkul=$_POST['matkul_id'];
		$semes=$_POST['semester'];

		$komponen=$_POST['komponen'];
		$persentase=$_POST['persentase'];
		$keterangan=$_POST['keterangan'];
		$mulai=$_POST['mulai'];
		$akhir=$_POST['akhir'];
		$id_komponen=$_POST['id'];
		$total = count($id_komponen);
		
		$sub_komponen=$_POST['sub_komponen'];
		$id_sub_komponen=$_POST['id_sub'];
		$total2 = sizeof($id_sub_komponen);
	
		$this->siak_model->siak_query("update", "update bobot set matkul_id = '$matkul', prodi_id = '$prodi', tahun_id = $tahun, semester = '$semes' where id = '$id';");

		for ($i=0 ; $i < $total; $i++){
			$this->siak_model->siak_query("update", "update komponen set komponen = '".$komponen[$i]."', persentase = '".$persentase[$i]."', keterangan = '".$keterangan[$i]."', mulai = '".$mulai[$i]."', keterangan = '".$akhir[$i]."' where id = '".$id_komponen[$i]."';");
		}
		
		for ($i=0 ; $i < $total2; $i++){
			$this->siak_model->siak_query("update", "update sub_komponen set sub_komponen = '".$sub_komponen[$i]."' where id = '".$id_sub_komponen[$i]."';");
		}
		
		header('location: ' . URL . 'siak_bobot');
	}
	
	function ajaxDel(){
		var_dump($_POST);
	}

	public function siak_detail($ruang_id){
		$where = array('ruang_id' => $ruang_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "bobot", "*");
		$this->siak_view->siak_render('siak_bobot/view', false);
	}
	
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_bobot');
	}

	public function matkul($prodi_id,$semester){
		
		$this->siak_view->siak_data = $this->siak_model->siak_query('select', "select *from matakuliah where prodi_id='$prodi_id' and semester='$semester'");
		// var_dump($this->siak_view->siak_data);
		$this->siak_view->siak_render('siak_bobot/matkul', true);
	}

	public function dosen($matkul_id){
		$this->siak_view->dosen = $this->siak_model->siak_data_list("dosen", "*");
		$where = array('kode_matkul' => $matkul_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "dosen_matakuliah", "*");
		// var_dump($this->siak_view->siak_data);
		$this->siak_view->siak_render('siak_bobot/dosen', true);
	}

}

?>