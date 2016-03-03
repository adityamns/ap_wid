<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_ba_tesis extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - BA Tesis";
	
		$this->siak_view->judul = "BA Tesis";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'BA Tesis','href'=>''. URL . 'siak_ba_tesis'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		if(Siak_session::siak_get('level')==16){
			$cek_mhs = $this->siak_model->siak_query("select","select * from view_mahasiswa where nim='".Siak_session::siak_get('username')."'");
			foreach($cek_mhs as $cek => $mhs){
				$tahun_mhs = $mhs['tahun_masuk'];
				$this->siak_view->tahun_mhs = $tahun_mhs;
				$prodi_mhs = $mhs['prodi_id'];
				$this->siak_view->prodi_mhs = $prodi_mhs;
			}
			$matkul_mhs = $this->siak_model->siak_query("select","select * from matakuliah where prodi_id='".$prodi_mhs."'");
			foreach($matkul_mhs as $mat_mhs => $kul_mhs){
				$lower_mhs = strtolower($kul_mhs['nama_matkul']);
				if($lower_mhs == "tesis"){
					$tesis_mhs = $kul_mhs['kode_matkul'];
				}
			}
			$this->siak_view->data = $this->siak_model->siak_query("select","select a.nim,a.tahun_masuk,a.prodi_id,a.nama_depan,a.nama_belakang,b.judul,b.dosen_pembimbing1,b.dosen_pembimbing2,c.penguji_id,d.hasil,d.ket,e.hasil as hasil_proto,f.pembimbing,f.penguji from view_mahasiswa a,pendaftaran_tesis b,jadwal_sidang_tesis c,nilai_mahasiswa d,proto e,bobot_tesis f where a.nim='".Siak_session::siak_get('username')."' and a.tahun_masuk='".$tahun_mhs."' and a.prodi_id='".$prodi_mhs."' and a.nim=b.nim and a.nim=c.nim and b.judultesis_id=c.judulsidangtesis_id and a.nim=d.nim and d.matkul_id='".$tesis_mhs."' and a.nim=e.nim and f.matkul_id='".$tesis_mhs."'");
			$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
			$this->siak_view->siak_render('siak_ba_tesis/tabel', false);
		}else{
			if(Siak_session::siak_get('prodi') == ""){
				$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
				$this->siak_view->siak_render('siak_ba_tesis/index', false);
			}else{
				$this->siak_view->prodi_users = "ada";
				$this->siak_view->prodi = $this->siak_model->siak_query("select","select * from prodi where prodi_id='".Siak_session::siak_get('prodi')."'");
				foreach($this->siak_view->prodi as $pro => $di){
					$this->siak_view->pro_pro = $di['prodi_id'];
				}
				$this->siak_view->siak_render('siak_ba_tesis/index', false);
			}
		}
	}
	
	function getbobot($tahun,$prodi){
		$this->siak_view->tahun = $tahun;
		$this->siak_view->prodi = $prodi;
		$matkul = $this->siak_model->siak_query("select","select * from matakuliah where prodi_id='".$prodi."'");
		foreach($matkul as $mat => $kul){
			$lower = strtolower($kul['nama_matkul']);
			if($lower == "tesis"){
				$tesis = $kul['kode_matkul'];
			}
		}
		$this->siak_view->data = $this->siak_model->siak_query("select","select a.nim,a.tahun_masuk,a.prodi_id,a.nama_depan,a.nama_belakang,b.judul,b.dosen_pembimbing1,b.dosen_pembimbing2,c.penguji_id,d.hasil,d.ket,e.hasil as hasil_proto,f.pembimbing,f.penguji from view_mahasiswa a,pendaftaran_tesis b,jadwal_sidang_tesis c,nilai_mahasiswa d,proto e,bobot_tesis f where a.tahun_masuk='".$tahun."' and a.prodi_id='".$prodi."' and a.nim=b.nim and a.nim=c.nim and b.judultesis_id=c.judulsidangtesis_id and a.nim=d.nim and d.matkul_id='".$tesis."' and a.nim=e.nim and f.matkul_id='".$tesis."'");
		$this->siak_view->siak_render('siak_ba_tesis/tabel', true);
	}
	
	function getDetail($nim,$nd,$nb,$judul,$dpa,$dpb,$penguji,$hasil,$ket,$prodi,$tahun,$hasil_proto,$pembim,$pengu){
		$this->siak_view->nim = $nim;
		$this->siak_view->nd = $nd;
		$this->siak_view->nb = $nb;
		$this->siak_view->judul = $judul;
		if($dpa != ""){
			$ds = $this->siak_model->siak_query("select","select * from pembimbing where kode='".$dpa."'");
			foreach($ds as $dosen => $satu){
				$this->siak_view->dpa = $satu['nama'];
			}
		}else{
			$this->siak_view->dpa = "asd";
		}
		if($dpb != ""){
			$dd = $this->siak_model->siak_query("select","select * from pembimbing where kode='".$dpb."'");
			foreach($dd as $dosen => $dua){
				$this->siak_view->dpb = $dua['nama'];
			}
		}else{
			$this->siak_view->dpb = "xyz";
		}
		$ex = explode(",",$penguji);
		foreach($ex as $e => $x){
			$dftr_penguji = $this->siak_model->siak_query("select","select * from penguji where kode='".$x."'");
			foreach($dftr_penguji as $daftar => $ujinya){
				$this->siak_view->penguji[$e] = $ujinya['nama'];
			}
		}
		$this->siak_view->hasil = $hasil;
		$this->siak_view->ket = $ket;
		$prodi = $this->siak_model->siak_query("select","select * from prodi where prodi_id='".$prodi."'");
		foreach($prodi as $pro => $di){
			$this->siak_view->prodi = $di['prodi'];
		}
		$this->siak_view->tahun = $tahun;
		$ex_hasil_proto = explode(",",$hasil_proto);
		foreach($ex_hasil_proto as $exhasil => $xproto){
			$this->siak_view->hasil_proto[$exhasil] = $xproto;
		}
		$this->siak_view->pembim = $pembim;
		$this->siak_view->pengu = $pengu;
		$this->siak_view->siak_render('siak_ba_tesis/pdf', true);
	}
}

?>