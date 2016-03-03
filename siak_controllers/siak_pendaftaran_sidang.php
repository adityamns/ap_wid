<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_pendaftaran_sidang extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Pendaftaran Sidang Proposal Tesis";
	
		$this->siak_view->judul = "Pendaftaran Sidang Proposal Tesis";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Pendaftaran Sidang Proposal Tesis','href'=>''. URL . 'siak_pendaftaran_sidang'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		if (Siak_session::siak_get('level')==16){
			$this->siak_view->siak_render('siak_pendaftaran_sidang/data_mhs', false);
		}
		else{
			foreach ($this->siak_session->siak_getAll() as $key => $value) {
				if ($value['groups'] == "tugas_akhir" && $value['kode'] == "pendaftaran_sidang") {
					$this->siak_view->creates = $value['creates'];
					$this->siak_view->loads  = $value['loads'];
					$this->siak_view->reades  = $value['reades'];
					$this->siak_view->updates = $value['updates'];
					$this->siak_view->deletes = $value['deletes'];
				}
			}
			$this->siak_datalist();	
		}
	}

	public function siak_datalist(){
		$this->siak_view->siak_render('siak_pendaftaran_sidang/data', false);
	}

	public function siak_cek($nim, $semester){
		$this->siak_view->nim = $nim;
		$where = array('nim' => $nim, 'status' => 2);
		
		$this->siak_view->cek_mhs = $this->siak_model->siak_query("select","select * from mahasiswa where nim='".$nim."'");
		
		$cek_pro_sid = $this->siak_model->siak_query("select","select * from proto_sidang");
		$gr = "";
		foreach($cek_pro_sid as $ceki => $poi){
			if($poi['judultesis_id'] == ""){
				$poi['judultesis_id'] = "-1";
			}
			$gr = $gr."'".$poi['judultesis_id']."',";
		}
		$haps = strlen($gr);
		$haps = $haps - 1;
		$isis = substr($gr,0,$haps);
			
		if($cek_pro_sid == NULL){
			$isis = "'-1'";
		}
		$this->siak_view->data_judul = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".$nim."' and status='2' and judultesis_id not in(".$isis.")");
		
		$this->siak_view->over = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".$nim."' and status > '2' and judultesis_id not in(".$isis.")");
		
		//MAHASISWA
		$wher = array('nim' => $nim);
		foreach($this->siak_model->siak_edit($wher, "mahasiswa", "*") as $key => $value){
			$jenis = strtolower($value['jenis']);
			$prodi = $value['prodi_id'];
		}
		if($jenis == 'umum'){
			$this->siak_view->siak_mhs = $this->siak_model->siak_edit($wher, "data_pribadi_umum", "*");
		} else if($jenis == 'pns') {
			$this->siak_view->siak_mhs = $this->siak_model->siak_edit($wher, "data_pribadi_pns", "*");
		}
		
		$whe = array('prodi_id' => $prodi);
		$this->siak_view->siak_prodi = $this->siak_model->siak_edit($whe, "prodi", "*");
		
		//DOSEN
		foreach($this->siak_view->data_judul as $key => $value){
			$judultesis_id = $value['judultesis_id'];
			$dosen_pembimbing1 = $value['dosen_pembimbing1'];
			$dosen_pembimbing2 = $value['dosen_pembimbing2'];
			$dosen_pembimbing3 = $value['dosen_pembimbing3'];
		}
		$where1 = array('kode' => $dosen_pembimbing1);
		$where2 = array('kode' => $dosen_pembimbing2);
		$where3 = array('kode' => $dosen_pembimbing3);
		$this->siak_view->siak_pembimbing1 = $this->siak_model->siak_edit($where1, "pembimbing", "*");
		$this->siak_view->siak_pembimbing2 = $this->siak_model->siak_edit($where2, "pembimbing", "*");
		$this->siak_view->siak_pembimbing3 = $this->siak_model->siak_edit($where3, "pembimbing", "*");
		
		$this->siak_view->siak_render('siak_pendaftaran_sidang/sidang', true);
	}

	public function siak_ok($judultesis_id){
		$this->siak_model->siak_query("update", "UPDATE pendaftaran_judul_tesis set status = 3 WHERE judultesis_id = ".$judultesis_id.";");
		header('location: ' . URL . 'siak_pendaftaran_sidang');
	}

}

?>