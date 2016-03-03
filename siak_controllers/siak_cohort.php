<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Atur Cohort controller class */

class Siak_cohort extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Aktivasi Cohort";
	
		$this->siak_view->judul = "Aktivasi Cohort";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Aktivasi Cohort','href'=>''. URL . 'siak_cohort'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		//Hak Akses
		$method_or_uri = 'siak_cohort';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("cohort", "*");
		$this->siak_view->siak_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->kurikulum = $this->siak_model->siak_query("select", 'SELECT * FROM kurikulum ; ');
		$this->siak_view->siak_render('siak_cohort/data', false);
	}

	public function siak_add(){
		$this->siak_view->siak_tahun_akademik = $this->siak_model->siak_data_list("tahun_akademik", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		
		$this->siak_view->kurikulum = $this->siak_model->siak_query("select", 'SELECT * FROM kurikulum ; ');
		
		$this->siak_view->siak_render('siak_cohort/add', true);
	}
	
	public function kurikulum($prodi){
		$siak_data_list = $this->siak_model->siak_query("select", 'SELECT * FROM kurikulum ; ');
		$html = '<select class="m-wrap span12" name="kurikulum_id">';
			foreach($siak_data_list as $key => $val){
			$prodi_new = explode(',', $val['prodi_id']);
			if (in_array($prodi, $prodi_new)) {
				$html .= "<option value='".$val['kurikulum_id']."'>".$val['nama_kurikulum']."</option>";
			} }
		$html .= '</select>';
		echo $html;
	}

	public function siak_create(){
// 		echo "<pre>";
// 		var_dump($_POST);
// 		echo "</pre>";
// 		echo "UPDATE mahasiswa set cohort = ".$_POST['cohort']." WHERE prodi_id = '".$_POST['prodi_id']."' AND tahun_masuk = ".$_POST['tahun_masuk'].";";
// 		die();
		$this->siak_model->siak_create();
		$this->siak_model->siak_query("update", "UPDATE mahasiswa set cohort = ".$_POST['cohort']." WHERE prodi_id = '".$_POST['prodi_id']."' AND tahun_masuk = ".$_POST['tahun_masuk'].";");
		header('location: ' . URL . 'siak_cohort');
	}

	public function siak_edit($id_cohort){
		$this->siak_view->siak_tahun_akademik = $this->siak_model->siak_data_list("tahun_akademik", "*");
		$where = array('id_cohort' => $id_cohort);
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "cohort", "*");
		
		$this->siak_view->kurikulum = $this->siak_model->siak_query("select", 'SELECT * FROM kurikulum ; ');
		
		$this->siak_view->siak_render('siak_cohort/edit', true);
	}
	
	public function siak_edit_save($id_cohort){
		$where = array('id_cohort' => $id_cohort);
		$this->siak_model->siak_edit_save($where);
		$this->siak_model->siak_query("update", "UPDATE mahasiswa set cohort = ".$_POST['cohort']." WHERE prodi_id = '".$_POST['prodi_id']."' AND tahun_masuk = ".$_POST['tahun_masuk'].";");
		header('location: ' . URL . 'siak_cohort');
	}

	public function siak_delete($id_cohort){
		$where = array('id_cohort' => $id_cohort);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_cohort');
	}

	public function kapasitas($ruang_id){
		$where = array('ruang_id' => $ruang_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "ruang", "kapasitas");
		$this->siak_view->siak_render('siak_atur_pembekalan/kapasitas', true);
	}
}

?>