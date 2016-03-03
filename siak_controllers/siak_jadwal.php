<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak jadwal controller class */

class Siak_jadwal extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	
	function index(){
		$this->create();
	}
	function take_prodi(){
		$prodi_id = $_SESSION['prodi'];
		$data='';
		//$prodi='';
		//echo "'".$prodi_id."'";
		 if($prodi_id != NULL){
			$data=array();
		     $split = explode(',', $prodi_id);

		    foreach($split as $p){
		      $new[] = "'".$p."'";
		    }
		     $new = implode(',', $new);
		     $data['where'] = "where prodi_id in (".$new.")";
		     $data['and'] = "and prodi_id in (".$new.")";
		     $data['id'] = $new;
		    // $data['prodi'] = $new;
		
		 }
		return $data;
	}

	public function siak_add(){	
		$filter_prodi=$this->take_prodi();
		//var_dump($filter_prodi);
		$this->siak_view->prodi = $this->siak_model->siak_query("select", "SELECT prodi_id,prodi from prodi  ".$filter_prodi['where']." ");
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT  SUBSTRING(tahun_akademik.nama_tahun,1,4) AS tahun, tahun_akademik.nama_tahun, tahun_akademik.tahun_id FROM tahun_akademik");
		$this->siak_view->siak_render('siak_jadwal/add', true);
	}
	public function siak_form($prodi){
		$this->siak_view->ruang= $this->siak_model->siak_query("select", "SELECT *from ruang");
		$this->siak_view->kurikulum= $this->siak_model->siak_query("select", "SELECT *from kurikulum where prodi_id like '%".$prodi."%'");
		$this->siak_view->siak_render('siak_jadwal/form', true);
	}
	public function siak_form_edit($id){
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "select a.id ,a.kode_matkul,a.kode_topik, a.semester,e.prodi_id, e.prodi, d.ruang_id,d.nama_ruang,dosen_utama,dosen_pendamping, mulai,akhir,pertemuanke,kurikulum_id from jadwal_kuliah a, ruang d, prodi e where a.prodi_id=e.prodi_id and a.ruang_id=d.ruang_id AND a.id='$id'");
			foreach($this->siak_view->siak_data_list as $val => $value){
					$matkul=$value['kode_matkul'];
					$prodi=$value['prodi_id'];
					$semes=$value['semester'];
					$kurikulum_id=$value['kurikulum_id'];
			}
		$kurikulum=$kurikulum_id!=''?"AND kurikulum_id='".$kurikulum_id."' ": "";
		$this->siak_view->kurikulum= $this->siak_model->siak_query("select", "SELECT *from kurikulum where prodi_id like '%".$prodi."%'");
		$this->siak_view->ruang= $this->siak_model->siak_query("select", "SELECT *from ruang");
		$this->siak_view->siak_matkul = $this->siak_model->siak_query("select", "SELECT *from matakuliah where prodi_id='$prodi' and semester='$semes' ".$kurikulum." ");
		$this->siak_view->siak_topik = $this->siak_model->siak_query("select", "SELECT *from topik where kode_matkul='$matkul'");
		$dosen_matakuliah = $this->siak_model->siak_query("select", "SELECT *from dosen_matakuliah where prodi_id='$prodi' and kode_matkul='$matkul' ".$kurikulum."");
		$gab=array();
		foreach($dosen_matakuliah as $v =>$val){
			$dosen_pengampu=$val['dosen_utama'];
			$team_teaching=$val['dosen_pendamping'];
		}
		$dosen="".$dosen_pengampu.",".$team_teaching."";
		$x = explode(",",$dosen);
		$a =array();
		foreach($x as $k){
			$a[] = "'".$k."'";
		}
		$hasil=implode(',',$a);
		$query="select *from dosen where nip in (".$hasil.")";
		$this->siak_view->siak_dosen = $this->siak_model->siak_query("select",$query);
		$this->siak_view->siak_render('siak_jadwal/form_edit', true);
	}
	public function matkul($jenis,$prodi,$semes,$kurikulum){
		$this->siak_view->siak_matkul = $this->siak_model->siak_query("select", "SELECT *from matakuliah where prodi_id='$prodi' and semester='$semes' and kurikulum_id='$kurikulum'");
		if($jenis=='insert'){
			$this->siak_view->siak_render('siak_jadwal/matkul', true);
		}
		elseif($jenis=='edit'){
			$data=array();
			$hasil=array();
			foreach ($this->siak_view->siak_matkul as $b =>$row){
				$data['kode']=$row['kode_matkul'];
				$data['nama']=$row['nama_matkul'];
			array_push($hasil,$data);
			}
			print json_encode($hasil);
		}
	}
	
	public function cek_data_absen($id){
		$jadwal = $this->siak_model->siak_query("select", "select * from jadwal_kuliah where id = '$id'");
		
		foreach($jadwal as $bro =>$row){
			$pertemuan=$row['pertemuanke'];
			$matkul=$row['kode_matkul'];
			$cohort=$row['cohort'];
			$prodi=$row['prodi_id'];
		}
			$absen = $this->siak_model->siak_query("select", "select * from absensi where prodi_id='".$prodi."' and prodi_id='".$prodi."' and cohort='".$cohort."' and kode_matkul = '".$matkul."' and pertemuanke = '".$pertemuan."' and status = 1");
		echo sizeof($absen);
		
	}
	public function siak_edit_save($id,$status){
		$where = array('id' => $id);
		
		if($status=='true'){
			$jadwal = $this->siak_model->siak_query("select", "select * from jadwal_kuliah where id = '$id'");
				foreach($jadwal as $bro =>$row){
					$pertemuan=$row['pertemuanke'];
					$matkul=$row['kode_matkul'];
					$cohort=$row['cohort'];
					$prodi=$row['prodi_id'];
				}
				$this->siak_model->siak_query("update","update absensi set waktu = NULL, status = 4 where prodi_id='$prodi' and cohort = '".$cohort."' and tanggal = '".$_POST['mulai']."' and kode_matkul = '".$matkul."' and pertemuanke = '".$pertemuan."'");
				//echo "update absensi set waktu = NULL, status = 4 where prodi_id='$prodi' and cohort = '".$cohort."' and tanggal = '".$_POST['mulai']."' and kode_matkul = '".$matkul."' and pertemuanke = '".$pertemuan."'";
		}
		
	//	$_POST['dosen_pendamping'] = implode(',', $_POST['dosen_pendamping']);
		
		$this->siak_model->siak_edit_save($where);
		
		$url = "siak_dashboard";
		$jadwal2 = $this->siak_model->siak_query("select", "select * from jadwal_kuliah where id = '$id'");
		$this->siak_model->notifJadwal($jadwal2, $url, 'edit');
		
	}
	public function siak_delete($id){
		
		$url = "siak_dashboard";
		$jadwal = $this->siak_model->siak_query("select", "select * from jadwal_kuliah where id = '$id'");
		$this->siak_model->notifJadwal($jadwal, $url, 'delete');
		
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
	}
	public function siak_delete_jadwal_prodi($id,$prodi,$kohort){
			
		$where = array('tahun_id' => $id,'prodi_id' => $prodi,'cohort' => $kohort);
		//var_dump($where);
		//$this->siak_model->siak_delete($where);
	}
	public function siak_create(){
		$r_id = $_POST['ruang_id'];
		$id = $_POST['kode_matkul'];
		$data_mahasiswa = $this->siak_model->siak_query("select", "SELECT nim from view_mahasiswa WHERE prodi_id = '".$_POST['prodi_id']."' AND cohort = ".$_POST['cohort']." Order By nim asc");
		$this->siak_model->siak_create();
		foreach($data_mahasiswa as $key =>$row){
			$this->siak_model->siak_query("insert","insert into absensi (nim, prodi_id, cohort,kode_matkul,kode_topik,tanggal,status,pertemuanke) values ('".$row['nim']."','".$_POST['prodi_id']."', '".$_POST['cohort']."', '".$_POST['kode_matkul']."', '".$_POST['kode_topik']."', '".$_POST['mulai']."', 4,'".$_POST['pertemuanke']."');");
		}
		$this->siak_model->siak_query("insert","insert into absensi_dosen (nip,prodi_id,cohort,kode_matkul,kode_topik,tanggal,status,pertemuanke) values ('".$_POST['dosen_utama']."','".$_POST['prodi_id']."', '".$_POST['cohort']."', '".$_POST['kode_matkul']."', '".$_POST['kode_topik']."', '".$_POST['mulai']."', 4,'".$_POST['pertemuanke']."');");
		$url = "siak_dashboard";
		$jadwal = $this->siak_model->siak_query("select", "select * from jadwal_kuliah where kode_matkul = '$id' and ruang_id = '$r_id' order by id desc limit 1");
		//$this->siak_model->notifJadwal($jadwal, $url, 'create');
	}

	public function dosen($kode_matkul,$kurikulum){
		$where = array('kode_matkul' => $kode_matkul);
		$where2 = array('kode_matkul' => $kode_matkul,'kurikulum_id'=>$kurikulum);
		$this->siak_view->siak_title = $this->siak_model->siak_edit($where2, "matakuliah", "*");
		$this->siak_view->siak_topik = $this->siak_model->siak_edit($where, "topik", "*");
		$dosen_matakuliah = $this->siak_model->siak_edit($where2, "dosen_matakuliah", "*");
		$gab=array();
		foreach($dosen_matakuliah as $v =>$val){
			$dosen_pengampu=$val['dosen_utama'];
			$team_teaching=$val['dosen_pendamping'];
		}
		$dosen="".$dosen_pengampu.",".$team_teaching."";
		$x = explode(",",$dosen);
		$a =array();
		foreach($x as $k){
			$a[] = "'".$k."'";
		}
		$hasil=implode(',',$a);
		$query="select *from dosen where nip in (".$hasil.")";
		$this->siak_view->siak_dosen = $this->siak_model->siak_query("select",$query);
		$this->siak_view->siak_render('siak_jadwal/data', true);
	}
	public function topik($matkul){
		$this->siak_view->siak_topik = $this->siak_model->siak_query("select", "SELECT *from topik where kode_matkul='$matkul'");
		
			$data=array();
			$hasil=array();
			foreach ($this->siak_view->siak_topik as $b =>$row){
				$data['kode']=$row['kode_topik'];
				$data['nama']=$row['nama_topik'];
			array_push($hasil,$data);
			}
			print json_encode($hasil);
		
	}
	public function ruang(){
		$ruang= $this->siak_model->siak_query("select", "SELECT *from ruang");
		
			$data=array();
			$hasil=array();
			foreach ($ruang as $b =>$row){
				$data['kode']=$row['ruang_id'];
				$data['nama']=$row['nama_ruang'];
			array_push($hasil,$data);
			}
			print json_encode($hasil);
		
	}
	function getData_jadwal($id){
				$siak_data_list = $this->siak_model->siak_query("select", "select a.id ,b.kode_matkul,nama_matkul,a.kode_topik, a.semester,e.prodi_id, e.prodi, d.ruang_id,d.nama_ruang,dosen_utama,dosen_pendamping, mulai,akhir,pertemuanke from jadwal_kuliah a, matakuliah b, ruang d, prodi e where a.kode_matkul=b.kode_matkul and a.prodi_id=e.prodi_id and a.ruang_id=d.ruang_id AND a.id='$id'");
		
		$data_event = array();
		
				$result = array();
		
		foreach ($siak_data_list as $nilai => $row ){
		
			$data_event['id']=$row['id'];
			$data_event['kode_matkul']=$row['kode_matkul'];
			$data_event['nama_matkul']=$row['nama_matkul'];
			$data_event['semester']=$row['semester'];
			$data_event['prodi_id']=$row['prodi_id'];
			$data_event['prodi']=$row['prodi'];
			$data_event['doma']=$row['dosen_utama'];
			$data_event['doping']=$row['dosen_pendamping'];
			$data_event['ruang_id']=$row['ruang_id'];
			$data_event['kode_topik']=$row['kode_topik'];
			$data_event['nama_topik']=$row['nama_topik'];
			$data_event['pertemuan']=$row['pertemuanke'];
			$data_event['mulai']=$row['kode_matkul'];
			$data_event['akhir']=$row['akhir'];
			
			array_push($result,$data_event);
		}
		
		print json_encode($result);
	}
	public function dosen_matakuliah($jenis,$kode_matkul){
		$dom=array();
		$dop=array();
		$result_dom=array();
		$result_dop=array();
		$where = array('kode_matkul' => $kode_matkul);
		$domat = $this->siak_model->siak_edit($where, "dosen_matakuliah", "*");
		$dosen = $this->siak_model->siak_data_list("dosen","*");
			foreach($domat as $v=>$row){
				$doma=explode(',',$row['dosen_utama']);
				$doping=explode(',',$row['dosen_pendamping']);
				foreach ($dosen as $key => $val) { 
						if (in_array($val['nip'],$doma)) {
							$dom['nip']=$val['nip'];
							$dom['nama']=$val['nama'];
							array_push($result_dom,$dom);
						}
						if (in_array($val['nip'],$doping)) {
							$dop['nip']=$val['nip'];
							$dop['nama']=$val['nama'];
							array_push($result_dop,$dop);
						}
						
					}
				
			}
			if($jenis='doma'){
				print json_encode($result_dom);
			}
			else{
				print json_encode($result_dop);
			}
	}
	public function cek_ruang(){
		$mulai=$_POST['mulai'];
		$akhir=$_POST['akhir'];
		$ruang=$_POST['ruang'];
		$doma=$_POST['doma'];
			if($_POST['id']){
				$id="AND id!='".$_POST['id']."'";
			}else{
				$id='';
			}
			
		
		$data['cek_ruang'] = $this->siak_model->siak_query("select", "select id from jadwal_kuliah where mulai between '$mulai' and '$akhir' AND ruang_id='$ruang' ".$id." or akhir between '$mulai' and '$akhir' AND ruang_id='$ruang' ".$id." ");
		//echo "select id from jadwal_kuliah where mulai between '$mulai' and '$akhir' AND ruang_id='$ruang' AND id!='$id' or akhir between '$mulai' and '$akhir' AND ruang_id='$ruang' AND id!='$id'";
		$data['cek_dosen'] = $this->siak_model->siak_query("select", "select id from jadwal_kuliah where mulai between '$mulai' and '$akhir' and dosen_utama='$doma' ".$id." or akhir between '$mulai' and '$akhir' and dosen_utama='$doma' ".$id." ");
		//echo "select id from jadwal_kuliah where mulai between '$mulai' and '$akhir' and dosen_utama='$doma' AND id!='$id' or akhir between '$mulai' and '$akhir' and dosen_utama='$doma' AND id!='$id' ";
		
		if($data['cek_ruang']==null){
			$data['cek_ruang']='KOSONG';
		}
		if($data['cek_dosen']==null){
			$data['cek_dosen']='KOSONG';
		}
		
		echo json_encode($data);
		 
	}
	
	public function cek_kalender($tahunid,$prodi){
		if($prodi=='SPS'){
			$jenis='SPS';
		}else{
			$jenis='NONSPS';
		}
		$cek = $this->siak_model->siak_query("select", "select *from kalender where tahun_id='$tahunid' and jenis='$jenis'");
		// echo "select *from kalender where tahun_id='$tahunid' and jenis='$jenis'";
		// die();
		if($cek == null){
			echo'KOSONG';
			
		}
		else{
			echo'ADA';
			
		}
	}
	public function cek_jadwal($tahunid,$prodi,$cohort){
		
		$cek = $this->siak_model->siak_query("select", "select a.tahun_id, nama_tahun,SUBSTRING(b.nama_tahun,1,4) AS tahun, cohort, semester, a.prodi_id, prodi 
		from jadwal_kuliah a, tahun_akademik b, prodi c
		where a.tahun_id=b.tahun_id and c.prodi_id=a.prodi_id and a.prodi_id='$prodi' and a.tahun_id='$tahunid' and cohort='$cohort'
		group by a.tahun_id, a.prodi_id, cohort, semester, nama_tahun, prodi");
		
		if($cek == null){
			echo'KOSONG';
		}
		else{
			echo'ADA';
		}
	}
		
	public function load_title($kodematkul){
		$siak_title = $this->siak_model->siak_query("select", "SELECT nama_matkul from matakuliah where kode_matkul='$kodematkul'");
		
		foreach ($siak_title as $nilai => $row ){
					echo $row['nama_matkul'];
		}
		
	}
	public function data_list(){
		$this->siak_view->config = "Siak Unhan - Kalender Akademik Fakultas";
		
		$this->siak_view->judul = "Kalender Akademik Fakultas";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Kalender Akademik Fakultas','href'=>'' .URL. 'siak_jadwal/data_list'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		//Hak Akses
		$method_or_uri = 'siak_jadwal/data_list';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$prodi_id = $_SESSION['prodi'];
		if($prodi_id != NULL){
		  if(is_array(explode(',', $prodi_id))){
		    $split = explode(',', $prodi_id);

		    foreach($split as $p){
		      $new[] = "'".$p."'";
		    }
		    $new = implode(',', $new);
		    $prodi = "and a.prodi_id in (".$new.")";
		  }else{
		    $prodi = "and a.prodi_id = '".$prodi_id."'";
		  }
		}
		$this->siak_view->query = "
		  SELECT 
		    a.tahun_id, 
		    nama_tahun,
		    SUBSTRING(b.nama_tahun,1,4) AS tahun, 
		    cohort,  
		    a.prodi_id, 
		    prodi 
		FROM 
		    jadwal_kuliah a, 
		    tahun_akademik b, 
		    prodi c
		WHERE 
		    a.tahun_id=b.tahun_id and 
		    c.prodi_id=a.prodi_id
		    $prodi
		GROUP BY 
		    a.tahun_id, 
		    a.prodi_id, 
		    cohort, 
		    nama_tahun, 
		    prodi";

		//$prodi_id = Siak_session::siak_get('prodi');
		//if($prodi_id != NULL){ $prodi = "and c.prodi_id = '".$prodi_id."'"; }else{ $prodi = ""; }


		$this->siak_view->siak_data = $this->siak_model->siak_query("select", 
		"
		  SELECT 
		    a.tahun_id, 
		    nama_tahun,
		    SUBSTRING(b.nama_tahun,1,4) AS tahun, 
		    cohort,  
		    a.prodi_id, 
		    prodi 
		FROM 
		    jadwal_kuliah a, 
		    tahun_akademik b, 
		    prodi c
		WHERE 
		    a.tahun_id=b.tahun_id and 
		    c.prodi_id=a.prodi_id
		    $prodi
		GROUP BY 
		    a.tahun_id, 
		    a.prodi_id, 
		    cohort, 
		    nama_tahun, 
		    prodi");
		$this->siak_view->siak_render('siak_jadwal/list', false);
	}
	function jadwal_kuliah(){
		
		$this->siak_view->siak_render('siak_jadwal/jadwal_kuliah', false);
	}
	function create($tahun,$tahunid,$prodi,$kohort){
		if ($tahunid==''){
				$tahun =$_POST['tahun_ak'];
				$tahunid =$_POST['tahun_id'];
				$prodi =$_POST['prodi'];
				$kohort =$_POST['kohort'];
			}
		
		if ($tahun==""){
			
			$this->siak_view->bulan = '';
			$this->siak_view->tahun = 0;
			
			}
		
		else{
			
			$this->siak_view->tahun = $tahun;
			$this->siak_view->bulan = $bulan;
			$this->siak_view->prodi = $prodi;
			$this->siak_view->kohort = $kohort;
			$this->siak_view->tahunid = $tahunid;
			}
		//$this->siak_view->siak_matkul = $this->siak_model->siak_data_list("matakuliah","*");
		$this->siak_view->siak_matkul = $this->siak_model->siak_query("select", "SELECT *from matakuliah where prodi_id='$prodi'");
		$this->siak_view->siak_ruang = $this->siak_model->siak_query("select", "SELECT *from ruang where status=1");
		$this->siak_view->siak_event = $this->siak_model->siak_query("select", "SELECT *from event");
		if($prodi=='SPS'){
					$this->siak_view->jenis 	= 'SPS';
					$this->siak_view->maxDate	= $tahun+1;
					$jenis =$this->siak_view->jenis;
					$this->siak_view->siak_render('siak_jadwal/createSPS', false);
				}
				else{
					$this->siak_view->jenis 	= 'NONSPS';
					$this->siak_view->maxDate	= $tahun+2;
					$jenis =$this->siak_view->jenis;
					$this->siak_view->siak_render('siak_jadwal/createSPS', false);
				}
		
	}
	 function bulan($b){
		
					if($b==01)
					{$bulan="JANUARI";}
					elseif($b==02)
					{$bulan="FEBRUARI";}
					elseif($b==03)
					{$bulan="MARET";}
					elseif($b==04)
					{$bulan="APRIL";}
					elseif($b==05)
					{$bulan="MEI";}
					elseif($b==06)
					{$bulan="JUNI";}
					elseif($b==07)
					{$bulan="JULI";}
					elseif($b==8)
					{$bulan="AGUSTUS";}
					elseif($b==9)
					{$bulan="SEPTEMBER";}
					elseif($b==10)
					{$bulan="OKTOBER";}
					elseif($b==11)
					{$bulan="NOVEMBER";}
					elseif($b==12)
					{$bulan="DESEMBER";}
				return $bulan;
		}
     function search($id,$jenis){
		$siak_data = $this->siak_model->siak_query("select", "SELECT kalender.id,kalender.mulai,kalender.akhir,event.event AS title,  kalender.event_id, to_char(kalender.mulai,'YYYY-MM-DD') AS tanggal, to_char(kalender.mulai,'YYYY') AS tahun, 
		to_char(kalender.mulai,'MM') AS bulan, to_char(kalender.mulai,'DD') AS hari 
		FROM kalender left join event on event.id=kalender.event_id where kalender.tahun_id='$id' and kalender.jenis='$jenis' ORDER BY kalender.mulai");
		
		 foreach ($siak_data as $nilai => $row) { 
		echo"<option value='".$row['tanggal']."'>".$row['title']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>".$this->bulan($row['bulan'])."&nbsp;".$row['hari']."&nbsp;".$row['tahun']."</strong></option>";
									 } 
		
           
		
	}
	function load_prodi(){
		$siak_data = $this->siak_model->siak_query("select", "SELECT prodi_id,prodi from prodi");
		$data_prodi = array();
		
				$result = array();
		
		foreach ($siak_data as $nilai => $row ){
			//var_dump($nilai);
			$data_prodi['prodi_id']=$row['prodi_id'];
			$data_prodi['prodi']=$row['prodi'];
			
			
			array_push($result,$data_prodi);
		}
		
       print json_encode($result);
		
	}
	function load_jadwal($id,$jenis,$prodi,$kohort){
		
		$siak_data = $this->siak_model->siak_query("select", "SELECT * FROM 
		(SELECT jadwal_kuliah.id, (matakuliah.nama_matkul || ' - per ' || pertemuanke ) AS title, jadwal_kuliah.mulai as START, jadwal_kuliah.akhir , NULL AS warna, jadwal_kuliah.tahun_id,jadwal_kuliah.ruang_id, jadwal_kuliah.dosen_utama,jadwal_kuliah.kurikulum_id,
		CASE WHEN cast(jadwal_kuliah.mulai as time)!='00:00:00'  THEN 'false' ELSE 'true' END AS allDay,(select count(*) from absensi ab where ab.prodi_id=jadwal_kuliah.prodi_id and jadwal_kuliah.cohort=ab.cohort and ab.pertemuanke=jadwal_kuliah.pertemuanke and
		 ab.kode_matkul=jadwal_kuliah.kode_matkul and jadwal_kuliah.mulai=ab.tanggal and ab.status !=4 ) as absen FROM jadwal_kuliah 
		LEFT JOIN matakuliah ON matakuliah.kode_matkul=jadwal_kuliah.kode_matkul WHERE jadwal_kuliah.tahun_id='$id' AND jadwal_kuliah.prodi_id='$prodi' AND jadwal_kuliah.cohort='$kohort' AND jadwal_kuliah.jenis='$jenis'
		UNION 
		SELECT kalender.id AS id, event.event AS title, kalender.mulai AS START, kalender.akhir AS END, event.warna, kalender.tahun_id,null as ruang_id,null as dosen_utama,null as kurikulum_id,
		CASE WHEN cast(kalender.mulai as time)!='00:00:00' THEN 'false' ELSE 'true' END AS allDay ,null as absen
		FROM kalender LEFT JOIN event ON event.id=kalender.event_id WHERE kalender.tahun_id='$id' AND kalender.jenis='$jenis') AS result  ORDER BY START");
		$data_jadwal = array();
		
				$result = array();
		
		foreach ($siak_data as $nilai => $row ){
			//var_dump($nilai);
			$data_jadwal['id']=$row['id'];
			if($row['absen']!=null){
				$data_jadwal['title']=$row['title']." Jml Mhs :".$row['absen'];	
			}else{
				$data_jadwal['title']=$row['title'];	
			}
			$data_jadwal['start']=$row['start'];
			$data_jadwal['end']=$row['akhir'];
			$data_jadwal['warna']='#'.$row['warna'];
			$data_jadwal['tahun_id']=$row['tahun_id'];
			$data_jadwal['allDay']=$row['allday'];
			$data_jadwal['ruang_id']=$row['ruang_id'];
			$data_jadwal['doma']=$row['dosen_utama'];
			$data_jadwal['kurikulum']=$row['kurikulum_id'];
			//$data_jadwal['disableResizing']=$row['disableResizing'];
			
			
			array_push($result,$data_jadwal);
		}
		
		$json = json_encode($result);
		$json = str_replace('"true"','true',$json);
		$json = str_replace('"false"','false',$json);
		print $json;
	}
	
public function siak_cetak($tahunid,$cohort,$matkul,$topik,$semes,$dosen,$from,$to){
	$tahunid=$_POST['tahun_id'];
	$cohort=$_POST['cohort'];
	$matkul=$_POST['matkul'];
	$prodi=$_POST['prodi'];
	$topik=$_POST['topik'];
	$semes=$_POST['semester'];
	$dosen=$_POST['dosen'];
	$from=$_POST['from'];
	$to=$_POST['to'];
	
		$this->siak_view->siak_data = $this->siak_model->siak_query("select","SELECT *, to_char(mulai,'HH24:MI') AS waktu_mulai,to_char(akhir,'HH24:MI') AS waktu_akhir,to_char(mulai,'YYYY-MM-DD') AS waktu,to_char(mulai,'DD') AS hari FROM view_jadwal_kuliah_notopik WHERE semester='".$semes."' AND cohort='".$cohort."' AND tahun_id='".$tahunid."' "
					. ($prodi ? "AND prodi_id = '$prodi' " :"")
					. ($matkul ? "AND kode_matkul = '$matkul' " :"")
					. ($topik ? "AND kode_topik like '$topik' " :"")
					. ($dosen ? "AND dosen_utama = '$dosen' " :"")
					. ($from ? "AND mulai between '$from' AND '$to'" :"")
					." ORDER BY mulai ASC ");
					
		$awal = $this->siak_model->siak_query("select","SELECT to_char(mulai,'DD') AS TAwal,to_char(mulai,'MM') AS BAwal FROM view_jadwal_kuliah_notopik WHERE semester='".$semes."' AND cohort='".$cohort."' AND tahun_id='".$tahunid."' "
					. ($prodi ? "AND prodi_id = '$prodi' " :"")
					. ($matkul ? "AND kode_matkul = '$matkul' " :"")
					. ($topik ? "AND kode_topik like '$topik' " :"")
					. ($dosen ? "AND dosen_utama = '$dosen' " :"")
					. ($from ? "AND mulai between '$from' AND '$to'" :"")
					." ORDER BY mulai ASC limit 1 ");
		foreach($awal as $i =>$row){
			$this->siak_view->TAwal=$row['tawal'];
			$this->siak_view->BAwal=$this->bulan($row['bawal']);
		}
		$akhir = $this->siak_model->siak_query("select","SELECT   to_char(mulai,'DD') AS TAkhir,to_char(mulai,'MM') AS BAkhir FROM view_jadwal_kuliah_notopik WHERE semester='".$semes."' AND cohort='".$cohort."' AND tahun_id='".$tahunid."' "
					. ($prodi ? "AND prodi_id = '$prodi' " :"")
					. ($matkul ? "AND kode_matkul = '$matkul' " :"")
					. ($topik ? "AND kode_topik like '$topik' " :"")
					. ($dosen ? "AND dosen_utama = '$dosen' " :"")
					. ($from ? "AND mulai between '$from' AND '$to'" :"")
					." ORDER BY mulai DESC limit 1 ");
		foreach($akhir as $i =>$row){
			$this->siak_view->TAkhir=$row['takhir'];
			$this->siak_view->BAkhir=$this->bulan($row['bakhir']);
		}
		$this->siak_view->semester = $semes;
		$this->siak_view->tahun = $tahunid;
		$this->siak_view->cohort = $cohort;
		$this->siak_view->matkul = $matkul;
		$this->siak_view->topik = $topik;
		$this->siak_view->prodi = $prodi;
		$this->siak_view->dosen = $dosen;
		$this->siak_view->from = $from;
		$this->siak_view->to = $to;
		$this->siak_view->siak_render('siak_jadwal/cetak', true);
	}
	
	public function print_jadwal(){
	$tahunid=$_POST['tahunid'];
	$semes=$_POST['semester'];
	$cohort=$_POST['cohort'];
	$prodi=$_POST['prodi'];
	$matkul=$_POST['matkul'];
	$topik=$_POST['topik'];
	$dosen=$_POST['dosen'];
	$from=$_POST['from'];
	$to=$_POST['to'];
	
		$this->siak_view->siak_data = $this->siak_model->siak_query("select","SELECT *, to_char(mulai,'HH24:MI') AS waktu_mulai,to_char(akhir,'HH24:MI') AS waktu_akhir,to_char(mulai,'YYYY-MM-DD') AS waktu,to_char(mulai,'DD') AS hari FROM view_jadwal_kuliah_notopik WHERE semester='".$semes."' AND cohort='".$cohort."' AND tahun_id='".$tahunid."' "
					. ($prodi ? "AND prodi_id = '$prodi' " :"")
					. ($matkul ? "AND kode_matkul = '$matkul' " :"")
					. ($topik ? "AND kode_topik like '$topik' " :"")
					. ($dosen ? "AND dosen_utama = '$dosen' " :"")
					. ($from ? "AND mulai between '$from' AND '$to'" :"")
					." ORDER BY mulai ASC ");
					
		$awal = $this->siak_model->siak_query(
					"select","SELECT to_char(mulai,'DD MONTH YYYY') AS awal
					FROM view_jadwal_kuliah_notopik WHERE semester='".$semes."' AND cohort='".$cohort."' AND tahun_id='".$tahunid."' "
					. ($matkul ? "AND kode_matkul = '$matkul' " :"")
					. ($prodi ? "AND prodi_id = '$prodi' " :"")
					. ($topik ? "AND kode_topik like '$topik' " :"")
					. ($dosen ? "AND dosen_utama = '$dosen' " :"")
					. ($from ? "AND mulai between '$from' AND '$to'" :"")
					." ORDER BY mulai ASC limit 1 ");
		foreach($awal as $i =>$row){
			$this->siak_view->awal=$row['awal'];
		}
		$akhir = $this->siak_model->siak_query(
					"select","SELECT   to_char(mulai,'DD MONTH YYYY') AS akhir 
					FROM view_jadwal_kuliah_notopik WHERE semester='".$semes."' AND cohort='".$cohort."' AND tahun_id='".$tahunid."' "
					. ($matkul ? "AND kode_matkul = '$matkul' " :"")
					. ($prodi ? "AND prodi_id = '$prodi' " :"")
					. ($topik ? "AND kode_topik like '$topik' " :"")
					. ($dosen ? "AND dosen_utama = '$dosen' " :"")
					. ($from ? "AND mulai between '$from' AND '$to'" :"")
					." ORDER BY mulai DESC limit 1 ");
		foreach($akhir as $i =>$row){
			$this->siak_view->akhir=$row['akhir'];
		}
		//echo $from;
		//echo $to;
		//exit;
		$this->siak_view->semester = $semes;
		$this->siak_view->siak_render('siak_jadwal/print_jadwal', true);
	}
	function cetak_jadwal(){
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "persiapan_perkuliahan" && $value['kode'] == "cetak_jadwal") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
				$this->prodi_id = $value['prodi_id'];
				
			}
		}
		$nim = $_SESSION['username'];
		$mhs = $this->siak_model->siak_query("select","select * from mahasiswa where nim = '$nim'");
		foreach($mhs as $row => $rec): $prodi_new = $rec['prodi_id']; endforeach;
		$prodi 	 = explode(',', $this->prodi_id);
		
		$ada = (!in_array($prodi_new, $prodi)) ? "tidak ada":"ada";
		if($this->prodi_id !=''){
		
			$this->siak_view->kondisi = $this->prodi_id;
			
			
		}
		else if($this->prodi_id != '' && $ada == "ada"){
		
			$this->siak_view->kondisi = $prodi_new;
		
		}
		else{
		
			$this->siak_view->kondisi = "";
		}
		
		$this->siak_view->dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->siak_render('siak_jadwal/cetak_jadwal', false);
	}
}

?>