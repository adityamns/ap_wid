	<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Dosen Pembimbing controller class */

class Siak_dosen_pembimbing extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "setting_dosen") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "
		SELECT b.id,a.kode,a.nama,b.jenis_dosen_pembimbing,b.jml_mahasiswa_max,b.penguji FROM pembimbing as a,dosen_pembimbing as b WHERE a.kode = b.nip
		UNION
		SELECT b.id,a.kode as id_penguji,a.nama,b.jenis_dosen_pembimbing,b.jml_mahasiswa_max,b.penguji FROM penguji as a,dosen_pembimbing as b WHERE a.kode = b.nip
		");
		$this->siak_view->siak_render('siak_dosen_pembimbing/data', false);
	}
	public function cek_prodi(){
		$nip=$_POST['NIP'];
		$jenis=$_POST['Jenis'];
		if($jenis==4){
			$data['prodi']= 'KOSONG';
		}else{
			$data['prodi']= $this->siak_model->siak_query("select", "Select *from pembimbing where kode='$nip' ");
		}
		// $data['prodi']= $this->siak_model->siak_query("select", "Select *from pembimbing ");
		echo json_encode($data);
	}

	public function siak_add(){
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("pembimbing", "*");
		$this->siak_view->siak_data_penguji = $this->siak_model->siak_data_list("penguji", "*");
		$this->siak_view->siak_render('siak_dosen_pembimbing/add', true);
	}

	public function siak_create(){
		// $this->siak_model->siak_create();
		$this->siak_model->siak_query("insert","insert into dosen_pembimbing(jenis_dosen_pembimbing,penguji,nip,jml_mahasiswa_max,jml_mahasiswa) values('".$_POST['jenis_dosen_pembimbing']."','".$_POST['penguji']."','".$_POST['nip']."','".$_POST['jml_mahasiswa_max']."','0')");
		header('location: ' . URL . 'siak_dosen_pembimbing');
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("pembimbing", "*");
		$this->siak_view->siak_data_penguji = $this->siak_model->siak_data_list("penguji", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "dosen_pembimbing", "*");
		$this->siak_view->siak_render('siak_dosen_pembimbing/edit', true);
	}
	
	public function siak_edit_save($id){
		// $where = array('id' => $id);
		// $this->siak_model->siak_edit_save($where);
		$this->siak_model->siak_query("update","update dosen_pembimbing set jenis_dosen_pembimbing = '".$_POST['jenis_dosen_pembimbing']."',penguji = '".$_POST['penguji']."',nip = '".$_POST['nip']."',jml_mahasiswa_max = '".$_POST['jml_mahasiswa_max']."' where id='".$id."'");
		header('location: ' . URL . 'siak_dosen_pembimbing');
	}

	public function siak_delete($id){
		// $where = array('id' => $id);
		// $this->siak_model->siak_delete($where);
		$this->siak_model->siak_query("delete","delete from dosen_pembimbing where id='".$id."'");
		header('location: ' . URL . 'siak_dosen_pembimbing');
	}
	
	public function penguji($jenis){
		$this->siak_view->jenis = $jenis;
		$this->siak_view->pembimbing = $this->siak_model->siak_data_list("pembimbing", "*");
		$this->siak_view->penguji = $this->siak_model->siak_data_list("penguji", "*");
		$this->siak_view->siak_render('siak_dosen_pembimbing/penguji', true);
	}
	
	public function penguji_edit($jenis,$semua){
		$this->siak_view->jenis = $jenis;
		$pecah = explode(",",$semua);
		$this->siak_view->id_dospem = $this->siak_model->siak_query("select","select * from dosen_pembimbing where id='".$pecah[0]."'");
		$this->siak_view->kode = $pecah[1];
		$this->siak_view->jml = $pecah[2];
		$this->siak_view->pembimbing = $this->siak_model->siak_data_list("pembimbing", "*");
		$this->siak_view->penguji = $this->siak_model->siak_data_list("penguji", "*");
		$this->siak_view->siak_render('siak_dosen_pembimbing/penguji_edit', true);
	}

}

?>