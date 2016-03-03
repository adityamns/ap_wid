<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_pendaftaran_judul extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "tugas_akhir" && $value['kode'] == "pendaftaran_judul") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->loads  = $value['loads'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_roles();
	}

	function index(){
		if (Siak_session::siak_get('level')==16){
			
			$this->siak_view->config = "Siak Widyatama - Daftar Judul Proposal Tesis";
	
			$this->siak_view->judul = "Daftar Judul Proposal Tesis";
			
			$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
			$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
			$this->siak_breadcrumbs->add(array('title'=>'Daftar Judul Proposal Tesis','href'=>''. URL . 'siak_pendaftaran_judul'));
			$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
			
			$this->siak_add();	
		}
		else{
			$this->siak_view->config = "Siak Unhan - Daftar Judul Proposal Tesis";
	
			$this->siak_view->judul = "Daftar Judul Proposal Tesis";
			
			$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
			$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
			$this->siak_breadcrumbs->add(array('title'=>'Daftar Judul Proposal Tesis','href'=>''. URL . 'siak_pendaftaran_judul'));
			$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
			
			$this->siak_datalist();	
		}
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_mahasiswa = $this->siak_model->siak_data_list("view_mahasiswa", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("pendaftaran_judul_tesis", "*");
		$this->siak_view->siak_render('siak_pendaftaran_judul/data', false);
	}

	public function siak_add(){
		$where1 = array('jenis_dosen_pembimbing' => 1);
		$where2 = array('jenis_dosen_pembimbing' => 2);
		$where3 = array('jenis_dosen_pembimbing' => 3);
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_edit($where1, "dosen_pembimbing", "*");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_edit($where2, "dosen_pembimbing", "*");
		$this->siak_view->siak_pembimbing3 = $this->siak_model->siak_edit($where3, "dosen_pembimbing", "*");
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_data_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		if (Siak_session::siak_get('level')==16){
		$this->siak_view->siak_render('siak_pendaftaran_judul/add_mhs', false);
		}else{$this->siak_view->siak_render('siak_pendaftaran_judul/add', true);}
	}

	public function siak_create(){
		$this->siak_model->siak_create();
		header('location: ' . URL . 'siak_pendaftaran_judul');
	}
	
	public function siak_create_ajax($nim){
		$where1 = array('nim' => $_POST['NIM']);
		$data['prodi'] ='KOSONG';
			//*** CEK MAHASISWA ***\\
			$data['mahasiswa']=$this->siak_model->siak_query("select", "Select *from mahasiswa where nim='".$_POST['NIM']."'");
			if($data['mahasiswa']!=null){
				foreach($data['mahasiswa'] as $x=>$row){
					$prod=$row['prodi_id'];
				}
				$data['mahasiswa']='ADA';
			}
			else{
				$data['mahasiswa']='KOSONG';
			}
			
			//====     ====//
			
		if($prod!='SPS'){
			$kondisi='semester=4 AND';
		}
		else{
			$kondisi='semester=3 AND';
		}
		$mahasiswa=$this->siak_model->siak_query("select", "Select *from mahasiswa where ".$kondisi." nim='".$_POST['NIM']."'");
		if($mahasiswa!=null){
			foreach($mahasiswa as $key => $value){
				$jenis = $value['jenis'];
				$prodi = $value['prodi_id'];
			}
			if($jenis == 'Umum'){
				$data['nama'] = $this->siak_model->siak_edit($where1, "data_pribadi_umum", "*");
			} else if($jenis == 'pns') {
				$data['nama'] = $this->siak_model->siak_edit($where1, "data_pribadi_pns", "*");
			}
		$where2 = array('prodi_id' => $prodi);
		$data['prodi'] = $this->siak_model->siak_edit($where2, "prodi", "*");
		}
		
		echo json_encode($data);
	}

	public function siak_edit($judultesis_id){
		$where1 = array('jenis_dosen_pembimbing' => 1);
		$where2 = array('jenis_dosen_pembimbing' => 2);
		$where3 = array('jenis_dosen_pembimbing' => 3);
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_edit($where1, "dosen_pembimbing", "*");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_edit($where2, "dosen_pembimbing", "*");
		$this->siak_view->siak_pembimbing3 = $this->siak_model->siak_edit($where3, "dosen_pembimbing", "*");
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_judul_tesis", "*");
		
		//NAMA & PRODI
		foreach($this->siak_view->siak_data as $key => $value){
			$nim = $value['nim'];
		}
		
		$where4 = array('nim' => $nim);
		$query = $this->siak_model->siak_edit($where4, "mahasiswa", "*");
		foreach($query as $key => $value){
			$jenis = $value['jenis'];
			$prodi = $value['prodi_id'];
		}
		
		if($jenis == 'Umum'){
			$this->siak_view->siak_nama = $this->siak_model->siak_edit($where4, "data_pribadi_umum", "*");
		} else if($jenis == 'pns') {
			$this->siak_view->siak_nama = $this->siak_model->siak_edit($where4, "data_pribadi_pns", "*");
		}
		
		$where5 = array('prodi_id' => $prodi);
		$this->siak_view->siak_prodi = $this->siak_model->siak_edit($where5, "prodi", "*");
		//END NAMA & PRODI
		
		$this->siak_view->siak_render('siak_pendaftaran_judul/edit', true);
	}
	public function siak_detail($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "pendaftaran_judul_tesis", "*");
		$this->siak_view->siak_render('siak_pendaftaran_judul/view', false);
	}

	public function siak_edit_save($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pendaftaran_judul');
	}

	public function siak_delete($judultesis_id){
		$where = array('judultesis_id' => $judultesis_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_pendaftaran_judul');
	}

}

?>