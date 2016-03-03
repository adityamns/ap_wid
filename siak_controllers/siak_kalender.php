<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak kalender controller class */

class Siak_kalender extends Siak_controller{
	
	function __construct(){
		// $this->css  = array('siak_public/siak_css/siak_default.css');
		// $this->js  = array('siak_public/siak_css/siak_default.css');
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
	}
	function index($tahunid,$jenis,$tahun){
		
			if ($tahunid==''){
				//echo "<script>alert('sip');</script>";
				$tahun=$_POST['tahun_ak'];
				$tahunid =$_POST['tahun_id'];
				$jenis =$_POST['jenis'];
			}
	
		
		
	if($tahunid){
		if ($bulan == "" && $tahun==""){
				//echo'<script>alert("if");</script>';
				$this->siak_view->bulan = 0;
				$this->siak_view->tahun = 0;
				$this->siak_view->tahun_id = 0;			
			}
		else{
				//echo'<script>alert("else");</script>';
				$this->siak_view->tahun = $tahun;
				$this->siak_view->bulan = $bulan;
				$this->siak_view->tahunid = $tahunid;
				$this->siak_view->tahunak = $tahun+1 ;
			}
		$this->siak_view->jenis = $jenis;
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT *from event");
		
		if($jenis=='SPS'){
			//echo'<script>alert("SPS");</script>';
			$this->siak_view->siak_render('siak_kalender/createSPS', false);
		}
		elseif($jenis=='NONSPS'){
			//echo'<script>alert("NON");</script>';
			$this->siak_view->siak_render('siak_kalender/createNON', false);
		}
		else{
			echo"<script>alert('Maaf Tahun belum Terisi');
			window.location.href='".URL."siak_kalender/create';
			</script>";
		}
		}
		else{
			echo"<script>alert('Maaf Tahun belum Terisi');
			window.location.href='".URL."siak_kalender/create';
			</script>";
		}
		
		
	}
	function form($jenis,$id){
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT *from event");
		$this->siak_view->jenis=$jenis;
				if($jenis=='edit'){
					$this->siak_view->id=$id;
					$this->siak_view->judul="EDIT EVENT KALENDER";
				}else{
					$this->siak_view->id=0;
					$this->siak_view->judul="CREATE EVENT KALENDER";
				}
		$this->siak_view->siak_render('siak_kalender/form', true);
	}
	function create($tahun,$bulan,$tahun_id){
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT  SUBSTRING(tahun_akademik.nama_tahun,1,4) AS tahun, tahun_akademik.nama_tahun, tahun_akademik.tahun_id FROM tahun_akademik");
		$this->siak_view->siak_render('siak_kalender/add', true);
	}
	public function siak_create(){
		
		$this->siak_model->siak_create();
		
	}
	function LoadEvent($id){
		
		$siak_data = $this->siak_model->siak_query("select", "SELECT *from event where event.id='$id'");
		
		$data_event = array();
		
				$result = array();
		
		foreach ($siak_data as $nilai => $row ){
		
			$data_event['warna']=$row['warna'];
			$data_event['event']=$row['event'];
			
			array_push($result,$data_event);
		}
		
		print json_encode($result);
	}
	function getTahun_akademik(){
		
		$siak_data = $this->siak_model->siak_query("select", "SELECT  SUBSTRING(tahun_akademik.nama_tahun,1,4) AS tahun, tahun_akademik.nama_tahun, tahun_akademik.tahun_id FROM tahun_akademik");
		
		$data_tahun = array();
		
				$result = array();
		
		foreach ($siak_data as $nilai => $row ){
		
			//$data_tahun['tahun_id']=$row['tahun_id'];
			$data_tahun['tahun']=$row['tahun'];
			$data_tahun['nama_tahun']=$row['nama_tahun'];
			$data_tahun['tahun_id']=$row['tahun_id'];
			array_push($result,$data_tahun);
		}
		
		print json_encode($result);
	}
	function getTahun_ID($tahun){
		
		$siak_data = $this->siak_model->siak_query("select", "SELECT tahun_akademik.tahun_id FROM tahun_akademik LEFT JOIN (SELECT SUBSTRING(tahun_akademik.nama_tahun,1,4) AS tahun, tahun_id FROM tahun_akademik) AS conect ON conect.tahun_id=tahun_akademik.tahun_id WHERE conect.tahun='$tahun'");
		// echo "SELECT tahun_akademik.tahun_id FROM tahun_akademik LEFT JOIN (SELECT SUBSTRING(tahun_akademik.nama_tahun,1,4) AS tahun, tahun_id FROM tahun_akademik) AS conect ON conect.tahun_id=tahun_akademik.tahun_id WHERE conect.tahun='$tahun'";
		
		// die();
		foreach ($siak_data as $nilai => $row ){
			echo $row['tahun_id'];
		}
		
		
	}

	function getEvent(){
		
		$siak_data = $this->siak_model->siak_query("select", "SELECT *from event");
		
		$data_event = array();
		
				$result = array();
		
		foreach ($siak_data as $nilai => $row ){
		
			$data_event['id']=$row['id'];
			$data_event['event']=$row['event'];
			
			array_push($result,$data_event);
		}
		
		print json_encode($result);
	}
	
	
	public function cek_kalender($id,$jenis){
		$siak_data = $this->siak_model->siak_query("select", "select tahun_id from kalender where tahun_id='$id' and jenis='$jenis' group by tahun_id");
		
		if($siak_data== null){
			echo 'KOSONG';
			
		}
		else{
			echo 'ADA';
			
		}
	}
	public function data_list(){
		$this->siak_view->config = "Siak Unhan - Kalender Akademik Universitas";
	
		$this->siak_view->judul = "Kalender Akademik Universitas";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Kalender Akademik Universitas','href'=>''. URL . 'siak_kalender/data_list'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "select  a.tahun_id,nama_tahun,SUBSTRING(b.nama_tahun,1,4) AS tahun, jenis from kalender a,tahun_akademik b where b.tahun_id=a.tahun_id group by a.tahun_id, nama_tahun,jenis");
		$this->siak_view->siak_render('siak_kalender/data', false);
	}
	public function view(){
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT tahun_akademik.tahun_id, tahun_akademik.nama_tahun, event.event, kalender.mulai, kalender.akhir FROM tahun_akademik LEFT JOIN kalender ON kalender.tahun_id=tahun_akademik.tahun_id LEFT JOIN event ON kalender.event_id=event.id");
		$this->siak_view->siak_render('siak_kalender/view', true);
	}
	public function load_event($id,$jenis){
		
		$siak_data = $this->siak_model->siak_query("select", "SELECT kalender.id,kalender.mulai,kalender.akhir,event.event AS title, event.warna AS warna, kalender.event_id FROM kalender JOIN event ON kalender.event_id=event.id where kalender.tahun_id='$id' and kalender.jenis='$jenis' ORDER BY id");
		$data_event = array();
		
				$result = array();
		
		foreach ($siak_data as $nilai => $row ){
		
			$data_event['id']=$row['id'];
			$data_event['start']=$row['mulai'];
			$data_event['end']=$row['akhir'];
			$data_event['title']=$row['title'];
			$data_event['warna']='#'.$row['warna'];
			$data_event['event_id']=$row['event_id'];
			
			array_push($result,$data_event);
		}
		
		print json_encode($result);
	}
	
	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		//header('location: ' . URL . 'siak_master/siak_persiapan_kuliah');
	}
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		//header('location: ' . URL . 'siak_master/siak_persiapan_kuliah');
	}
	
}

?>