<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak group controller class */

class Siak_jadwal_pembekalan extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_jadwal();
	}

	public function siak_jadwal(){
		$tahun =$_POST['tahun_ak'];
		$tahunid =$_POST['tahun_id'];
		if ($tahun==""){
				$this->siak_view->bulan = '';
				$this->siak_view->tahun = 0;
			}
		
		else{
				$this->siak_view->tahun = $tahun;
				$this->siak_view->tahunid = $tahunid;
				$this->siak_view->bulan = $bulan;
			}
			
		$START = $this->siak_model->siak_query("select", "SELECT to_char(kalender.mulai,'YYYY') AS tahun, to_char(kalender.mulai,'MM') AS bulan,to_char(kalender.mulai,'DD') AS hari FROM kalender JOIN event ON kalender.event_id=event.id WHERE kalender.tahun_id='$tahunid' AND event='MARTIKULASI/PEMBEKALAN' ORDER BY kalender.mulai ASC LIMIT 1 
 
 
		");
		
		$END = $this->siak_model->siak_query("select", "SELECT to_char(kalender.akhir,'YYYY') AS tahun, to_char(kalender.akhir,'MM') AS bulan,to_char(kalender.akhir,'DD') AS hari FROM kalender JOIN event ON kalender.event_id=event.id WHERE kalender.tahun_id='$tahunid' AND event='MARTIKULASI/PEMBEKALAN' ORDER BY kalender.akhir DESC LIMIT 1 
 
		");
		foreach ($START as $val1 => $mulai){
			$this->siak_view->tahunawl = $mulai['tahun'];
			$this->siak_view->bulanawl = $mulai['bulan'];
			$this->siak_view->hariawl = $mulai['hari'];
		}
		foreach ($END as $val2 => $akhir){
			$this->siak_view->tahunakhr = $akhir['tahun'];
			$this->siak_view->bulanakhr = $akhir['bulan'];
			$this->siak_view->hariakhr = $akhir['hari'];
		}
		
		if($mulai !=null){
			$this->siak_view->ruang = $this->siak_model->siak_query("select", "SELECT *from ruang");
			$this->siak_view->pengampu = $this->siak_model->siak_query("select", "SELECT *from pengampu_pembekalan");
			$this->siak_view->siak_render('siak_jadwal_pembekalan/index', false);
		}
		else{
			//header('location: ' . URL . 'siak_jadwal/siak_add');
			echo"<script>alert('MAAF JADWAL MARTIKULASI DI TAHUN AJARAN ".$tahun." BELUM TERSEDIA SILAHKAN UNTUK MEMBUAT TERLEBIH DAHULU DI KALENDER TAHUN AJARAN ".$tahun." ');
			window.location.href='".URL."siak_jadwal_pembekalan/siak_add';
			</script>";
			
		}
	}

	public function siak_add(){
		$this->siak_view->config = "Siak Unhan - Jadwal Pembekalan";
		
		$this->siak_view->judul = "Jadwal Pembekalan";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Pembekalan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Jadwal Pembekalan','href'=>'' .URL. 'siak_jadwal_pembekalan/siak_add'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_view->siak_render('siak_jadwal_pembekalan/add', false);
	}

	public function siak_create(){
		$materi=$_POST['materi_id'];
		$tahun=$_POST['tahun'];
		$start=$_POST['start'];
		$end=$_POST['end'];
		
		$ruang=$_POST['ruang'];
		$pengampu=$_POST['pengampu'];
		
		
		$total = count($_POST['ruang']);
		

		$this->siak_model->siak_query("insert", "insert into jadwal_pembekalan (tahun_id, mulai, akhir, materi_id) VALUES ('$tahun','$start','$end','$materi')");
		$id=$this->siak_model->siak_query("select","SELECT id FROM jadwal_pembekalan ORDER BY id DESC LIMIT 1");
		foreach ($id as $key => $ida ){
					$id_jadwal=$ida['id'];
					}
		for ($i=0 ; $i < $total; $i++){
		$this->siak_model->siak_query("insert", "insert into detail_jadwal_pembekalan (id_jadwal, pengampu_id, ruang_id) VALUES ('".$id_jadwal."', '".$pengampu[$i]."', '".$ruang[$i]."')");
		}
		$this->siak_model->siak_create();
	}
	// public function load_materi($tahunid){
		// $this->siak_view->siak_materi = $this->siak_model->siak_query("select", "SELECT *from materi_pembekalan where tahun_akademik='$tahunid'");
		// $this->siak_view->siak_render('siak_jadwal_pembekalan/materi', true);
	// }
	function load_materi($tahunid){
		$siak_data = $this->siak_model->siak_query("select", "SELECT *from materi_pembekalan where tahun_akademik='$tahunid'");
		$data_materi = array();
		
				$result = array();
		
		foreach ($siak_data as $nilai => $row ){
			//var_dump($nilai);
			$data_materi['materi_id']=$row['materi_id'];
			$data_materi['materi']=$row['materi'];
			
			
			array_push($result,$data_materi);
		}
		
       print json_encode($result);
		
	}
	function load_detil($id){
		$siak_data = $this->siak_model->siak_query("select", "SELECT detail_jadwal_pembekalan.id AS id_detail, ruang.nama_ruang,ruang.ruang_id, pengampu_pembekalan.nama_dosen, pengampu_pembekalan.pengampu_id FROM detail_jadwal_pembekalan 
		LEFT JOIN pengampu_pembekalan ON detail_jadwal_pembekalan.pengampu_id=pengampu_pembekalan.pengampu_id
		LEFT JOIN ruang ON detail_jadwal_pembekalan.ruang_id=ruang.ruang_id where id_jadwal='$id'");
		$data_detil = array();
		
				$result = array();
		
		foreach ($siak_data as $nilai => $row ){
			//var_dump($nilai);
			$data_detil['ruang_id']=$row['ruang_id'];
			$data_detil['nama_ruang']=$row['nama_ruang'];
			$data_detil['pengampu_id']=$row['pengampu_id'];
			$data_detil['nama_dosen']=$row['nama_dosen'];
			
			
			array_push($result,$data_detil);
		}
		
       print json_encode($result);
		
	}
	public function siak_edit($id){
		$where = array('id' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "grup", "*");
		$this->siak_view->siak_render('siak_group/edit', true);
	}

	public function siak_edit_save($id){
		$where = array('id' => $id,);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_pengaturan');
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		
	}
	function getRuang(){
		
		$siak_data = $this->siak_model->siak_data_list("ruang", "*");
		//var_dump($siak_data);
		$data_ruang = array();
		
				$result = array();
		foreach ($siak_data as $nilai => $row ){
			//var_dump($nilai);
			$data_ruang['ruang_id']=$row['ruang_id'];
			$data_ruang['nama_ruang']=$row['nama_ruang'];
			
			
			array_push($result,$data_ruang);
		}
		
		print json_encode($result);
	}
	function load_jadwal($id){
		
		$siak_data = $this->siak_model->siak_query("select", "SELECT id,tahun_id, jadwal_pembekalan.materi_id, jadwal_pembekalan.mulai, jadwal_pembekalan.akhir, materi_pembekalan.materi AS title, allDay FROM jadwal_pembekalan LEFT JOIN materi_pembekalan ON jadwal_pembekalan.materi_id=materi_pembekalan.materi_id where tahun_id='$id' ORDER BY mulai");
		$data_jadwal = array();
		
				$result = array();
		
		foreach ($siak_data as $nilai => $row ){
			$data_jadwal['id']=$row['id'];
			$data_jadwal['materi_id']=$row['materi_id'];
			$data_jadwal['title']=$row['title'];
			$data_jadwal['start']=$row['mulai'];
			$data_jadwal['end']=$row['akhir'];
			$data_jadwal['tahun_id']=$row['tahun_id'];
			$data_jadwal['allDay']=$row['allDay'];
			
			
			array_push($result,$data_jadwal);
		}
		
		$json = json_encode($result);
		$json = str_replace('"true"','true',$json);
		$json = str_replace('"false"','false',$json);
		print $json;
	}
	public function load_title($id){
		$siak_title = $this->siak_model->siak_query("select", "SELECT materi from materi_pembekalan where materi_id='$id'");
		
		foreach ($siak_title as $nilai => $row ){
					echo $row['materi'];
		}
		
	}

}

?>