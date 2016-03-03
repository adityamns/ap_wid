<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak materi_pembekalan controller class */

class Siak_materi_pembekalan extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "pembekalan" && $value['kode'] == "materi_pembekalan") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Materi Pembekalan";
		
		$this->siak_view->judul = "Materi Pembekalan";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Pembekalan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Materi Pembekalan','href'=>'' .URL. 'siak_materi_pembekalan'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		$this->siak_materi();
	}

	function siak_materi(){
		$this->siak_view->siak_render('siak_materi_pembekalan/materi_topik', false);
	}

	function siak_datalist(){
		$where = array('status' => 'Ya');
		$this->siak_view->siak_data_tahun = $this->siak_model->siak_edit($where, "tahun_akademik", "tahun_id,nama_tahun");
		$this->siak_view->status_materi = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("materi_pembekalan", "*");
		$this->siak_view->siak_render('siak_materi_pembekalan/data', true);
	}

	function siak_add(){
		$where = array('status' => 'Ya');
		$this->siak_view->siak_data_tahun = $this->siak_model->siak_edit($where, "tahun_akademik", "tahun_id,nama_tahun");
		$this->siak_view->status_kurikulum = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_materi_pembekalan/add', true);
	}

	public function siak_create(){
		$_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_materi_pembekalan');
	}

	public function siak_edit($materi_id){
		$kondisi = array('status' => 'Ya');
		$this->siak_view->siak_data_tahun = $this->siak_model->siak_edit($kondisi, "tahun_akademik", "tahun_id,nama_tahun");
		$where = array('materi_id' => $materi_id);
		$this->siak_view->status_kurikulum = $this->siak_model->siak_data_list("status", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "materi_pembekalan", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_render('siak_materi_pembekalan/edit', true);
	}

	public function siak_edit_save($materi_id){
		$where = array('materi_id' => $materi_id);
		
		if($_POST['prodi_id'] != NULL){
		$_POST['prodi_id'] = implode(',', $_POST['prodi_id']);
		}else{
		$_POST['prodi_id'] = $_POST['prodi_id'];
		}
		
// 		var_dump($_POST['prodi_id']);die();
		
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_materi_pembekalan');
	}

	public function siak_delete($materi_id){
		$where = array('materi_id' => $materi_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_materi_pembekalan');
	}

	public function prodi($status){
		if ($status == 2) {
// 			$this->siak_view->siak_render('siak_materi_pembekalan/prodi', true);
			$html = '
				<div class="row-fluid">
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="firstName">Program Studi</label>
							<div class="controls">
								<button class="btn purple mini" type="button" onClick="addVariable();">Tambah Prodi</button>
							</div>
						</div>
					</div>
					<div class="span8">
						<div class="control-group">
							<label class="control-label" for="firstName">Pilih Program Studi</label>
							<div class="controls">
								<div id="variablegroup">
								</div>
							</div>
						</div>
					</div>
				</div>';
			
			echo $html;	
		}
	}
}

?>