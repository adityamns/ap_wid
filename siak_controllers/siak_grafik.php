<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak fakultas controller class */

class Siak_grafik extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}
	
	function index(){
		if($_GET['tahun1']){
			$tahun=$_GET['tahun1'];
		}
		else{
			$now=date('Y');
			$tahun=$now ;
		}
		
		if($_GET['prodi']){
			$decode_prodi = base64_decode($_GET['prodi']);
			$this->siak_view->matkul = $this->siak_model->siak_query("select","select * from matakuliah where prodi_id='".$decode_prodi."'");
		}
		
		if($_GET['matkul']){
			$decode_matkul = base64_decode($_GET['matkul']);
			$this->siak_view->prodi_akhir = $decode_prodi;
			$matkul = $this->siak_model->siak_query("select","select * from matakuliah where kode_matkul='".$decode_matkul."'");
			foreach($matkul as $mat => $kul){
				$nm_matkul = $kul['nama_matkul'];
			}
			$this->siak_view->matkul_akhir = $nm_matkul;
			$this->siak_view->data_akhir = $this->siak_model->siak_query("select", "select a.prodi_id,a.matkul_id,count(a.prodi_id) as jumlah,a.grade,b.nilai_id from nilai_mahasiswa a,aturan_nilai b where a.prodi_id='".$decode_prodi."' and a.matkul_id='".$decode_matkul."' and a.grade=b.nama group by a.prodi_id,a.matkul_id,a.grade,b.nilai_id order by nilai_id asc");
		}
		
		$this->siak_view->siak_tahun = $this->siak_model->siak_query("select", "select tahun_masuk from mahasiswa where status=1 group by tahun_masuk order by tahun_masuk asc");
		$this->siak_view->siak_prodi = $this->siak_model->siak_query("select", "select count(*) as jumlah,tahun_masuk,prodi.prodi_id, fakultas.fakultas,fakultas.fakultas_kd from mahasiswa left join prodi on prodi.prodi_id=mahasiswa.prodi_id left join fakultas on fakultas.fakultas_id=prodi.fakultas_id where status=1 and tahun_masuk=$tahun group by tahun_masuk,fakultas,fakultas.fakultas_kd,prodi.prodi_id");
		$this->siak_view->jtahun=$tahun;
		
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi","*");
		
		$this->siak_view->siak_render('siak_grafik/index', false);
	}
	
	/*function index($prodi_id,$matkul_id){
		$this->siak_view->prodi = $prodi_id;
		$this->siak_view->matkul = $matkul_id;
		$this->siak_view->data = $this->siak_model->siak_query("select", "select a.prodi_id,a.matkul_id,count(a.prodi_id) as jumlah,a.grade,b.nilai_id from nilai_mahasiswa a,aturan_nilai b where a.prodi_id='".$prodi_id."' and a.matkul_id='".$matkul_id."' and a.grade=b.nama group by a.prodi_id,a.matkul_id,a.grade,b.nilai_id order by nilai_id asc");*/
		/*if($_GET['tahun1']){
			$tahun=$_GET['tahun1'];
		}
		else{
			$now=date('Y');
			$tahun=$now ;
		}
		
		$this->siak_view->siak_tahun = $this->siak_model->siak_query("select", "select tahun_masuk from mahasiswa where status=1 group by tahun_masuk order by tahun_masuk asc");
		$this->siak_view->siak_prodi = $this->siak_model->siak_query("select", "select count(*) as jumlah,tahun_masuk,prodi.prodi_id, fakultas.fakultas,fakultas.fakultas_kd from mahasiswa left join prodi on prodi.prodi_id=mahasiswa.prodi_id left join fakultas on fakultas.fakultas_id=prodi.fakultas_id where status=1 and tahun_masuk=$tahun group by tahun_masuk,fakultas,fakultas.fakultas_kd,prodi.prodi_id");
		$this->siak_view->jtahun=$tahun;
		
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi","*");*/
		
		/*if($_GET['prodi'] and $_GET['matkul']){
			$this->siak_view->prodi = $_GET['prodi'];
			$this->siak_view->matkul = $_GET['matkul'];
			$this->siak_view->open = "open";
		}
		
		$this->siak_view->siak_render('siak_grafik/index', false);
	}*/
	
	public function prodi($prodi_id){
		$where = array('prodi_id' => $prodi_id);
		$this->siak_view->data_matkul = $this->siak_model->siak_edit($where,"matakuliah","*");
		$this->siak_view->siak_render('siak_grafik/matkul', true);
	}
	
	/*function getbobot($prodi_id,$matkul_id){
		$this->siak_view->prodi = $prodi_id;
		$this->siak_view->matkul = $matkul_id;
		$this->siak_view->data = $this->siak_model->siak_query("select", "select a.prodi_id,a.matkul_id,count(a.prodi_id) as jumlah,a.grade,b.nilai_id from nilai_mahasiswa a,aturan_nilai b where a.prodi_id='".$prodi_id."' and a.matkul_id='".$matkul_id."' and a.grade=b.nama group by a.prodi_id,a.matkul_id,a.grade,b.nilai_id order by nilai_id asc");
		$this->siak_view->siak_render('siak_grafik/grafik', true);
	}*/

}

?>