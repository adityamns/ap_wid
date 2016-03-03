<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak bobot pembekalan controller class */

class Siak_bobot_pembekalan extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "pembekalan" && $value['kode'] == "bobot_pembekalan") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_view->materi = $this->siak_model->siak_data_list("materi_pembekalan", "*");
		$this->siak_view->tahun = $this->siak_model->siak_data_list("tahun_akademik", "*");
		$this->siak_view->komponen = $this->siak_model->siak_data_list("komponen_pembekalan", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("bobot_pembekalan", "*");
		$this->siak_view->siak_render('siak_bobot_pembekalan/data', false);
	}

	public function siak_add(){
		$this->siak_view->materi = $this->siak_model->siak_data_list("materi_pembekalan", "*");
		$this->siak_view->siak_render('siak_bobot_pembekalan/add', true);
	}

	public function siak_create(){
		$materi=$_POST['materi_id'];

		$komponen=$_POST['komponen'];
		$total = count($_POST['komponen']);
		$persentase=$_POST['persentase'];
		$keterangan=$_POST['keterangan'];

		$this->siak_model->siak_query("insert", "insert into bobot_pembekalan (materi_id) VALUES ('$materi')");
		$id=$this->siak_model->siak_query("select","SELECT id FROM bobot_pembekalan ORDER BY id DESC LIMIT 1");
		foreach ($id as $key => $ida ){
			$id_bobot=$ida['id'];
		}
		for ($i=0 ; $i < $total; $i++){
			$this->siak_model->siak_query("insert", "insert into komponen_pembekalan (id_bobot, komponen, persentase, keterangan) VALUES ('".$id_bobot."', '".$komponen[$i]."', '".$persentase[$i]."', '".$keterangan[$i]."')");
		}
		header('location: ' . URL . 'siak_bobot_pembekalan');
	}

	public function siak_edit($id){
		$this->siak_view->materi = $this->siak_model->siak_data_list("materi_pembekalan", "*");
		$where = array('id' => $id);
		$where2 = array('id_bobot' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "bobot_pembekalan", "*");
		$this->siak_view->siak_data_komponen = $this->siak_model->siak_edit($where2, "komponen_pembekalan", "*");
		$this->siak_view->siak_render('siak_bobot_pembekalan/edit', true);
	}

	public function siak_edit_save($id){
		$materi=$_POST['materi_id'];
		$komponen=$_POST['komponen'];
		$persentase=$_POST['persentase'];
		$id_komponen=$_POST['id'];
		$total = count($id_komponen);
		$this->siak_model->siak_query("update", "update bobot_pembekalan set materi_id = '$materi' where id = '$id'; ");
		for ($i=0 ; $i < $total; $i++){
			$this->siak_model->siak_query("update", "update komponen_pembekalan set komponen = '".$komponen[$i]."', persentase = '".$persentase[$i]."', keterangan = '".$keterangan[$i]."' where id = '".$id_komponen[$i]."';");
		}
		header('location: ' . URL . 'siak_bobot_pembekalan');
	}

	public function siak_detail($ruang_id){
		$where = array('ruang_id' => $ruang_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "bobot", "*");
		$this->siak_view->siak_render('siak_bobot/view', false);
	}
	
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		$this->siak_model->siak_query("delete", "delete from komponen_pembekalan where id_bobot = ".$id.";");
		header('location: ' . URL . 'siak_bobot_pembekalan');
	}

}

?>