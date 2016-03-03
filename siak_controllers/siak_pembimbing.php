	<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Dosen Pembimbing controller class */

class Siak_pembimbing extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "pembimbing") {
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
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("pembimbing", "*");
		$this->siak_view->siak_render('siak_pembimbing/data', false);
	}

	public function siak_add(){
		$where = array('jenis' => 2);
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_pembimbing = sizeof($this->siak_model->siak_edit($where, "pembimbing", "*"));
		$this->siak_view->siak_render('siak_pembimbing/add', true);
	}
	
	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pembimbing');
	}
	
	public function siak_create_ajax(){
		$where1 =$_POST['NIP'];
		$data['nama'] = $this->siak_model->siak_query('select', "Select a.*,b.prodi_homebase from dosen a, akademik_dosen b where a.nip=b.nip AND a.nip='$where1' ");
		
		echo json_encode($data);
	}
	public function cek($kode){
		$data = $this->siak_model->siak_query('select', "Select *from pembimbing where kode='$kode'");
		$result['res'] = 'ADA';
		if($data == null){
			$result['res'] = 'KOSONG';
		}
		echo json_encode($result);
	}

	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pembimbing", "*");
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_render('siak_pembimbing/edit', true);
	}
	
	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pembimbing');
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pembimbing');
	}
	
}

?>