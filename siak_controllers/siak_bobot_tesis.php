<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak bobot controller class */

class Siak_bobot_tesis extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->siak_view->config = "Siak Widyatama - Bobot Nilai Tesis";
	
		$this->siak_view->judul = "Bobot Nilai Tesis";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Bobot Nilai Tesis','href'=>''. URL . 'siak_bobot_tesis'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	}

	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "bobot_tesis") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->matkul = $this->siak_model->siak_data_list("matakuliah", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("bobot_tesis", "*");
		$this->siak_view->siak_render('siak_bobot_tesis/data', false);
	}
	
	public function siak_add(){
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->matkul = $this->siak_model->siak_data_list("matakuliah", "*");	
		$this->siak_view->tahun_masuk = $this->siak_model->siak_query("select", "select distinct tahun_masuk from mahasiswa;");
		$this->siak_view->siak_render('siak_bobot_tesis/add', true);
	}
	
	public function siak_add_ajax(){
		$data['matkul'] = $this->siak_model->siak_query("select", "select kode_matkul,nama_matkul from matakuliah WHERE prodi_id = '".$_POST['ID']."' AND singkatan = 'TS';");
		echo json_encode($data);
	}
	
	public function siak_create(){
		$tahun		=$_POST['tahun_id'];
		$prodi		=$_POST['prodi_id'];
		$matkul		=$_POST['matkul_id'];
		$pembimbing	=$_POST['pembimbing'];
		$penguji	=$_POST['penguji'];

		// $komponen=$_POST['komponen'];
		// $sub_komponen = $_POST['sub_komponen'];
		$total = count($_POST['komponen']);
		// $persentase=$_POST['persentase'];
		$keterangan=$_POST['keterangan'];
		
		$no_komponen = 0;
		foreach($_POST['komponen'] as $kom => $ponen){
			$komponen[$no_komponen] = $ponen;
			$no_komponen++;
		}
		
		$no_persen = 0;
		foreach($_POST['persentase'] as $per => $sen){
			$persentase[$no_persen] = $sen;
			$no_persen++;
		}
		
		$numo = 0;
		foreach($_POST['number'] as $num => $ber){
			$fake = 0;
			foreach($_POST['sub_komponen'.$ber] as $bet => $ray){
				$sub_komponen[$numo.$fake] = $ray;
				$fake++;
			}
			$jum_sub[$numo] = sizeof($_POST['sub_komponen'.$ber]);
			$numo++;
		}
		
		/* $no_sub = 0;
		foreach($_POST['sub_komponen'] as $su => $ub){
			$sub_komponen[$no_sub] = $ub;
			$no_sub++;
		} */

		$this->siak_model->siak_query("insert", "insert into bobot_tesis (tahun_id, prodi_id, matkul_id, pembimbing, penguji) VALUES ('$tahun','$prodi','$matkul','$pembimbing','$penguji')");
		$id=$this->siak_model->siak_query("select","SELECT id FROM bobot_tesis ORDER BY id DESC LIMIT 1");
		foreach ($id as $key => $ida ){
			$id_bobot=$ida['id'];
		}
		for ($i=0 ; $i < $total; $i++){
			// $this->siak_model->siak_query("insert", "insert into komponen_tesis (id_bobot_tesis, komponen, persentase, keterangan) VALUES ('".$id_bobot."', '".$komponen[$i]."', '".$persentase[$i]."', '".$keterangan[$i]."')");
			$this->siak_model->siak_query("insert", "insert into komponen_tesis (id_bobot_tesis, komponen, persentase, keterangan) VALUES ('".$id_bobot."', '".$komponen[$i]."', '".$persentase[$i]."', '')");
			$id_kompon = $this->siak_model->siak_query("select","SELECT id FROM komponen_tesis ORDER BY id DESC LIMIT 1");
			foreach ($id_kompon as $key => $idkom ){
				$id_komponen=$idkom['id'];
			}
			// for ($x=0; $x < sizeof($_POST['sub_komponen'."$i"]); $x++) {
			for ($x=0; $x < $jum_sub[$i]; $x++) {
				// $this->siak_model->siak_query("insert", "INSERT INTO sub_komponen_tesis (id_komponen_tesis, sub_komponen, keterangan) VALUES (".$id_komponen.",'".$_POST['sub_komponen'."$i"][$x]."','');");
				$this->siak_model->siak_query("insert", "INSERT INTO sub_komponen_tesis (id_komponen_tesis, sub_komponen, keterangan) VALUES (".$id_komponen.",'".$sub_komponen[$i.$x]."','');");
				// echo "INSERT INTO sub_komponen_tesis (id_komponen, sub_komponen, keterangan) VALUES (".$id_komponen.",'".$_POST['sub_komponen'."$i"][$x]."','');";
			}
		}
		
		header('location: ' . URL . 'siak_bobot_tesis');
		
	}
	
	public function siak_edit($id){
		$where = array('id' => $id);
		$where2 = array('id_bobot_tesis' => $id);
		/*var_dump($where3);die();*/
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "bobot_tesis", "*");
		$this->siak_view->siak_komponen_tesis = $this->siak_model->siak_edit($where2, "komponen_tesis", "*");
		$this->siak_view->sub_komponen = $this->siak_model->siak_data_list("sub_komponen_tesis", "*");
		/*var_dump($this->siak_view->siak_komponen_tesis);die();*/
		$this->siak_view->siak_prodi = $this->siak_model->siak_data_list("prodi","*");
		$this->siak_view->siak_render('siak_bobot_tesis/edit', true);
	}

	public function siak_detail($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "bobot_tesis", "*");
		$this->siak_view->siak_render('siak_bobot_tesis/view', false);
	}

	public function siak_edit_save($id){
		$tahun		=$_POST['tahun_id'];
		$prodi		=$_POST['prodi_id'];
		$pembimbing	=$_POST['pembimbing'];
		$penguji	=$_POST['penguji'];

		// var_dump($_POST['id_sub']);die();
		
		if(count($_POST['id']) != 0){
			$komponen=$_POST['komponen'];
			$persentase=$_POST['persentase'];
			$id_komponen_tesis=$_POST['id'];
			$total = count($id_komponen_tesis);
			
			$sub_komponen=$_POST['sub_komponen'];
			$id_sub_komponen=$_POST['id_sub'];
			$total2 = sizeof($id_sub_komponen);
			//var_dump($id_sub_komponen);die();
	
			$this->siak_model->siak_query("update", "update bobot_tesis set tahun_id = $tahun, pembimbing = $pembimbing, penguji = $penguji where id = '$id';");
	
			for ($i=0 ; $i < $total; $i++){
				$this->siak_model->siak_query("update", "update komponen_tesis set komponen = '".$komponen[$i]."', persentase = '".$persentase[$i]."' where id = '".$id_komponen_tesis[$i]."';");
				//echo "update komponen_tesis set komponen = '".$komponen[$i]."', persentase = '".$persentase[$i]."' where id = '".$id_komponen_tesis[$i]."';";
			}
			
			for ($i=0 ; $i < $total2; $i++){
				$this->siak_model->siak_query("update", "update sub_komponen_tesis set sub_komponen = '".$sub_komponen[$i]."' where id = '".$id_sub_komponen[$i]."';");
				//echo "update sub_komponen_tesis set sub_komponen = '".$sub_komponen[$i]."' where id = '".$id_sub_komponen[$i]."';";
			}
			//die();
		}else{
			$total = count($_POST['komponene']);
			
			$no_komponen = 0;
			foreach($_POST['komponene'] as $kom => $ponen){
				$komponen[$no_komponen] = $ponen;
				$no_komponen++;
			}
			
			$no_persen = 0;
			foreach($_POST['persentasee'] as $per => $sen){
				$persentase[$no_persen] = $sen;
				$no_persen++;
			}
			
			$numo = 0;
			foreach($_POST['numbere'] as $num => $ber){
				$fake = 0;
				foreach($_POST['sub_komponene'.$ber] as $bet => $ray){
					$sub_komponen[$numo.$fake] = $ray;
					$fake++;
				}
				$jum_sub[$numo] = sizeof($_POST['sub_komponene'.$ber]);
				$numo++;
			}
			
			$id_tambah = $_POST['id_tambah'];
			
			for ($i=0 ; $i < $total; $i++){
				$this->siak_model->siak_query("insert", "insert into komponen_tesis (id_bobot_tesis, komponen, persentase, keterangan) VALUES ('".$id_tambah."', '".$komponen[$i]."', '".$persentase[$i]."', '')");
				$id_kompon = $this->siak_model->siak_query("select","SELECT id FROM komponen_tesis ORDER BY id DESC LIMIT 1");
				foreach ($id_kompon as $key => $idkom ){
					$id_komponen=$idkom['id'];
				}
				for ($x=0; $x < $jum_sub[$i]; $x++) {
					$this->siak_model->siak_query("insert", "INSERT INTO sub_komponen_tesis (id_komponen_tesis, sub_komponen, keterangan) VALUES (".$id_komponen.",'".$sub_komponen[$i.$x]."','');");
				}
			}
		}

		header('location: ' . URL . 'siak_bobot_tesis');
	}
	
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_bobot_tesis');
	}
	
	public function coba($prodi){
		$this->siak_view->matkul = $this->siak_model->siak_query("select", "select kode_matkul,nama_matkul from matakuliah WHERE prodi_id = '".$prodi."' AND singkatan = 'TS';");
		$this->siak_view->siak_render('siak_bobot_tesis/coba', true);
	}
	
}

?>