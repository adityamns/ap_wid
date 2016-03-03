<?php

/* Siak absensi mahasiswa controller class */

class Siak_absensi_mahasiswa extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi = $_SESSION['prodi'];
	}

	//======================== ABSENSI MAHASISWA =======================//
	
	function index(){
		$this->siak_view->config = "Siak Widyatama - Absensi Mahasiswa";
	
		$this->siak_view->judul = "Absensi Mahasiswa";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Absensi Mahasiswa','href'=>''. URL . 'siak_absensi_mahasiswa'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		$nim = $_SESSION['username'];
		$mhs = $this->siak_model->siak_query("select","select nim,cohort,nama_depan,nama_belakang,substring(prodi,15) as prodi,prodi_id,foto from view_mahasiswa where nim = '$nim'");
		foreach($mhs as $row => $rec): $prodi_new = $rec['prodi_id'];$cohort = $rec['cohort']; endforeach;
		
			if($mhs!=null){
				$where = array('prodi_id' => $prodi_new);
				$this->siak_view->cohort=$cohort;
				$this->siak_view->mahasiswa=$mhs;
				$this->siak_view->tahun = $this->siak_model->siak_data_list("tahun_akademik", "*");
				$this->siak_view->matakuliah = $this->siak_model->siak_edit($where, "matakuliah", "*");
				$this->siak_view->siak_render('siak_absensi_mahasiswa/absen_mhs', false);
			}
			else{
				$where = array('status' => 1);
				$this->siak_view->kurikulum = $this->siak_model->siak_edit($where, "kurikulum", "*");
				$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
				$this->siak_view->mahasiswa = $this->siak_model->siak_query("select", "SELECT b.prodi, COUNT(a.nim) as jml_mhs, b.prodi_id FROM mahasiswa a, prodi b WHERE a.prodi_id = b.prodi_id AND a.status = 1 AND a.kurikulum_id != 0 GROUP BY a.prodi_id, b.prodi_id;");
				$this->siak_view->siak_render('siak_absensi_mahasiswa/index', false);
			}
	}
	
	
	//=========================== ABSENSI DOSEN ===========================//
	
	public function absensi_dosen(){
		$where = array('nip' => $_SESSION['username']);
		$this->siak_view->dosen = $this->siak_model->siak_edit($where, "dosen", "*");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->tahun = $this->siak_model->siak_data_list("tahun_akademik", "*");
		$this->siak_view->matakuliah = $this->siak_model->siak_data_list("matakuliah", "*");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/absen_dosen', false);		
	}
	// public function konfirmasi_dosen(){
		// $cohort		= $_POST['cohort'];
		// $prodi 		= $_POST['prodi'];
		// $pertemuan 	= $_POST['pertemuanke'];
		// $matkul 	= $_POST['matkul'];
		// $this->siak_view->siak_data = $this->siak_model->siak_query("select", "select a.*, to_char(a.tanggal,'dd-mm-yyyy') as waktu, b.nama_matkul, b.en_matkul,b.singkatan,
		// (select c.nama_topik from topik c where a.kode_topik=c.kode_topik) as topik 
		// from absensi_dosen a,matakuliah b where a.kode_matkul=b.kode_matkul 
		// and a.prodi_id='".$prodi."' and a.cohort='".$cohort."' and a.kode_matkul='".$matkul."' and a.pertemuanke='".$pertemuan."'");
		// $this->siak_view->siak_render('siak_absensi_mahasiswa/konfirmasi_dosen', false);		
	// }
	public function konfirmasi_dosen(){
		$cohort		= $_POST['cohort'];
		$prodi 		= $_POST['prodi'];
		$pertemuan 	= $_POST['pertemuanke'];
		$matkul 	= $_POST['matkul'];
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "select a.*, to_char(a.tanggal,'DD-MM-yyyy hh:mm:ss') as tgl, b.nama_matkul, b.en_matkul,b.singkatan,c.nama,c.gelar_blkng,c.gelar_depan,
		(select c.nama_topik from topik c where a.kode_topik=c.kode_topik) as topik 
		from absensi_dosen a,matakuliah b, dosen c where a.kode_matkul=b.kode_matkul and c.nip=a.nip 
		and a.prodi_id='".$prodi."' and a.cohort='".$cohort."' and a.kode_matkul='".$matkul."' and a.pertemuanke='".$pertemuan."'");
		
		
		$this->siak_view->siak_render('siak_absensi_mahasiswa/konfirmasi_dosen', false);		
	}

	public function cohort($prodi_id){
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT DISTINCT(cohort) FROM mahasiswa a, prodi b WHERE a.prodi_id = b.prodi_id AND a.prodi_id = '".$prodi_id."' order by cohort ASC");
		$this->siak_view->prodi = $prodi_id;
		$this->siak_view->siak_render('siak_absensi_mahasiswa/cohort', true);
	}
	public function form_absen($prodi_id,$cohort){
		$this->siak_view->tahun = $this->siak_model->siak_data_list("tahun_akademik", "*");
		$this->siak_view->cohort = $cohort;
		$this->siak_view->idprodi = $prodi_id;
		$this->siak_view->siak_render('siak_absensi_mahasiswa/form_absen2', true);
	}

	public function absensi($cohort){
		$prodi_id = $_POST['prodi'];
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT *from view_mahasiswa WHERE prodi_id = '".$prodi_id."' AND cohort = ".$cohort." Order By nim asc");
			
		$this->siak_view->jadwal = $this->siak_model->siak_query("select", "SELECT dosen_utama,kode_matkul, date(mulai) as tgl from jadwal_kuliah Where prodi_id = '".$prodi_id."' AND cohort = ".$cohort." and kode_matkul = '".$_POST['matkul']."' and date(mulai) = '".$_POST['tanggal']."' ");
		  foreach ($this->siak_view->jadwal as $key => $value) {
			 $kondisi = array('nip' => $value['dosen_utama']);
			 $this->siak_view->dosen = $this->siak_model->siak_edit($kondisi, "dosen", "*");
		 }
		
		$where = array('prodi_id' => $prodi_id);
		$wheretopik = array('kode_topik' => $_POST['topik']);
		$this->siak_view->prodi = $this->siak_model->siak_edit($where, "prodi", "prodi_id, prodi, fakultas_id");
		$this->siak_view->data_topik = $this->siak_model->siak_edit($wheretopik, "topik", "*");
		$this->siak_view->fakultas = $this->siak_model->siak_data_list("fakultas", "*");
		$this->siak_view->cohort = $cohort;
		$this->siak_view->tgl = $_POST['tanggal'];
		$this->siak_view->data_matkul = $this->siak_model->siak_data_list("matakuliah", "kode_matkul, nama_matkul");
		$jml_mhs = sizeof($this->siak_view->siak_data_list);
		$this->siak_view->siak_render('siak_absensi_mahasiswa/absen', false);
	}

	public function matkul($prodi_id, $semester){
		$where = array('prodi_id' => $prodi_id, 'semester' => $semester);
		$this->siak_view->data_matkul = $this->siak_model->siak_edit($where, "matakuliah", "kode_matkul, nama_matkul, semester");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/matkul', true);
	}
	public function matkul_dosen($prodi_id, $semester, $NIP){
		$this->siak_view->data_matkul = $this->siak_model->siak_query("select", "select b.*, dosen_utama,dosen_pendamping from dosen_matakuliah a,matakuliah b where a.kode_matkul=b.kode_matkul AND semester='".$semester."' AND a.prodi_id='".$prodi_id."' AND dosen_utama='".$NIP."'
		UNION
		select b.*, dosen_utama,dosen_pendamping from dosen_matakuliah a,matakuliah b where a.kode_matkul=b.kode_matkul AND semester='".$semester."' AND a.prodi_id='".$prodi_id."' AND dosen_pendamping like '%".$NIP."%' ");
		
		//echo "select b.*, dosen_utama,dosen_pendamping from dosen_matakuliah a,matakuliah b where a.kode_matkul=b.kode_matkul AND semester='".$semester."' AND a.prodi_id='".$prodi_id."' AND dosen_utama='".$NIP."'
		//UNION
		//select b.*, dosen_utama,dosen_pendamping from dosen_matakuliah a,matakuliah b where a.kode_matkul=b.kode_matkul AND semester='".$semester."' AND a.prodi_id='".$prodi_id."' AND dosen_pendamping like '%".$NIP."%'";
		$this->siak_view->siak_render('siak_absensi_mahasiswa/matkul', true);
	}

	public function topik($kode_matkul){
		$where = array('kode_matkul' => $kode_matkul);
		$this->siak_view->data_topik = $this->siak_model->siak_edit($where, "topik", "kode_topik, nama_topik, kode_matkul");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/topik', true);
	}
		
	
	//======================== KONFIRMASI ABSEN =======================//
	
	public function konfirmasi(){
		$this->siak_view->config = "Siak Widyatama - Absensi Mahasiswa";
		$this->siak_view->judul = "Konfirmasi Absen";
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Konfirmasi Absen','href'=>''. URL . 'siak_absensi_mahasiswa'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		//$where = array('kode_matkul' => $kode_matkul);
		//$this->siak_view->data_list = $this->siak_model->siak_query("select", "select cohort,a.kode_matkul,nama_matkul,a.prodi_id,tanggal,(select c.akhir from jadwal_kuliah c where c.kode_matkul=a.kode_matkul and c.cohort=a.cohort and c.pertemuanke=a.pertemuanke) as akhir,count(nim) as jumlah,a.kode_topik,pertemuanke,case when a.konfirmasi is null then 'belum' ELSE 'sudah' END as status  from absensi a,matakuliah b where a.kode_matkul=b.kode_matkul group by cohort,a.kode_matkul,a.prodi_id,tanggal,a.kode_topik,pertemuanke,nama_matkul,konfirmasi order by a.kode_matkul,a.kode_topik,konfirmasi ASC");
		
		$prodi_id = $_SESSION['prodi'];
		//var_dump($prodi_id);die()
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
		
// 		echo $prodi;
// 		die();
		$this->siak_view->data_list = $this->siak_model->siak_query("select", "select cohort,a.kode_matkul,nama_matkul,a.prodi_id,to_char(tanggal,'DD-MM-yyyy  HH12:MI:SS') as tanggal2, tanggal,(select c.akhir from jadwal_kuliah c where c.kode_matkul=a.kode_matkul and c.cohort=a.cohort and c.pertemuanke=a.pertemuanke) as akhir,count(nim) as jumlah,a.kode_topik,pertemuanke,case when a.konfirmasi is null then 'belum' ELSE 'sudah' END as status  from absensi a,matakuliah b where a.kode_matkul=b.kode_matkul $prodi group by cohort,a.kode_matkul,a.prodi_id,tanggal,a.kode_topik,pertemuanke,nama_matkul,konfirmasi order by a.kode_matkul,a.kode_topik,konfirmasi ASC");
		
		$this->siak_view->siak_render('siak_absensi_mahasiswa/data_konfirmasi', false);
	}
	public function delete_absen(){
		$this->siak_model->siak_query("delete", "delete from table absensi where kode_matkul='".$_POST['kode_matkul']."' and pertemuanke='".$_POST['pertemuanke']."' and tanggal='".$_POST['tanggal']."' and cohort='".$_POST['cohort']."'");
		header('location: ' . URL . 'siak_absensi_mahasiswa/konfirmasi');
	}
	public function save_absen(){
		$total = count($_POST['nim']);
		$nim = $_POST['nim'];
		$status = $_POST['hadir'];
		$confirm = $_POST['confirm'];
		$this->siak_view->jadwal = $this->siak_model->siak_query("select", "SELECT dosen_utama,pertemuanke, date(mulai) as tgl from jadwal_kuliah Where prodi_id = '".$_POST['prodi_id']."' AND cohort = '".$_POST['cohort']."' and kode_matkul = '".$_POST['matakuliah']."' and date(mulai) = '".$_POST['tgl']."' ");
		foreach ($this->siak_view->jadwal as $key => $value) {
			$kondisi = array('nip' => $value['dosen_utama']);
			$pertemuanke =  $value['pertemuanke'];
		}
		
		for ($i=0 ; $i < $total; $i++){
		 $this->siak_model->siak_query("insert","insert into absensi (nim, prodi_id, cohort,kode_matkul,kode_topik,tanggal,status,pertemuanke) values ('".$nim[$i]."','".$_POST['prodi_id']."', '".$_POST['cohort']."', '".$_POST['matakuliah']."', '".$_POST['topik']."', '".$_POST['tgl']."', 4,'".$pertemuanke."');");
		 
		}
			$this->siak_view->dosen = $this->siak_model->siak_edit($kondisi, "dosen", "*");
			foreach ($this->siak_view->dosen as $key => $val) {
				 $this->siak_model->siak_query("insert","insert into absensi_dosen (nip,prodi_id,cohort,kode_matkul,kode_topik,tanggal,status,pertemuanke) values ('".$val['nip']."','".$_POST['prodi_id']."', '".$_POST['cohort']."', '".$_POST['matakuliah']."', '".$_POST['topik']."', '".$_POST['tgl']."', 4,'".$pertemuanke."');");
				
			}
	
			header('location: ' . URL . 'siak_absensi_mahasiswa/konfirmasi');
					
	}
	public function confirm_absen(){
		
		$total 	 = count($_POST['nim']);
		$nim 	 = $_POST['nim'];
		$status  = $_POST['ket'];
		//$confirm = $_POST['confirm'];
		$waktu_kuliah = $_POST['tanggal'];
		
		$tgl = $_POST['tgl'];
		
		//var_dump($total." - ".$nim[0]." - ".$status[0]." - ".$confirm[0]." - ". $_POST['cohort']." - ".$_POST['prodi_id']." - ".$_POST['tgl']." - waktu kuliah : ".$waktu_kuliah[1]);die();
		for ($i=0 ; $i < $total; $i++){
		/* $sq = "update absensi set status = ".$status[$i].", konfirmasi=1, waktu = now() where nim = '".$nim[$i]."' and tanggal = '".$waktu_kuliah[$i]."'";
		var_dump($sq);die(); */
		$this->siak_model->siak_query("update","update absensi set status = ".$status[$i].", konfirmasi=1, waktu = now() where nim = '".$nim[$i]."' and tanggal = '".$waktu_kuliah[$i]."';");
		//$this->siak_model->siak_query("update","update absensi set status = ".$status[$i].", konfirmasi='".$confirm[$i]."' where nim = '".$nim[$i]."' and cohort = '".$_POST['cohort']."' and prodi_id = '".$_POST['prodi_id']."' and tanggal = '".$_POST['tgl']."';");
			if($status[$i] != 1){
				//echo $status[$i]."+".$nim[$i]."<br>";
				//Send Notif utk MHS yg Tidak Masuk (S/I/A)
				$url = "siak_izin/index/".$nim[$i]."/".$_POST['cohort']."/".$_POST['tgl'];
				$this->siak_model->notifAbsen($nim[$i], $url);
			}
		}
		header('location: ' . URL . 'siak_absensi_mahasiswa/DATA_KONFIRMASI');
	}
	
	public function pilih_absensi(){
		$this->siak_view->siak_render('siak_absensi_mahasiswa/pilih_absensi');
	}
	
	public function DATA_KONFIRMASI(){
		$nip 		= $_SESSION['username'];
		$tgl_now 	= date("Y-m-d");
		$tgl_awal 	= $tgl_now." 07:00:00";
		$tgl_akhir 	= $tgl_now." 23:59:00"; 
		 
		$cohort		= $_POST['cohort'];
		/* $prodi_id 	= $_POST['prodi']; */
		$prodi_id 	= $_SESSION['prodi'];
		$topik 		= $_POST['kode_topik'];
		$matkul 	= $_POST['kode_matkul'];
		$nama_kelas = $_POST['kelas_id'];
		$jam_kuliah = $_POST['jam_kuliah'];
		//var_dump($_POST['tanggal']);die();
		
		if(isset($_POST['Filter'])){
			$this->generate_absen();
		}
			 if($prodi_id != NULL){
				$split = explode(',', $prodi_id);
				if(sizeof($split)>1){

				foreach($split as $p){
				  $new[] = "'".$p."'";
				}
				$new = implode(',', $new);
				$where = "where prodi_id in (".$new.")";
				}else{
				$where = "where prodi_id in ('".$prodi_id."')";
				}
			}else{
				$where = "";
			}
			 $sql4 = "SELECT a.prodi_id, b.prodi FROM jadwal_kuliah a, prodi b WHERE a.prodi_id = b.prodi_id AND mulai BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND dosen_utama = '".$nip."' ORDER BY mulai ASC";
			 //var_dump($sql4);die();
			 $this->siak_view->siak_prodi = $this->siak_model->siak_query("select", $sql4);
			 
			 $sql1 = "SELECT DISTINCT a.kode_matkul,b.nama_matkul FROM jadwal_kuliah a, matakuliah b WHERE a.kode_matkul=b.kode_matkul AND a.mulai BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND a.dosen_utama = '".$nip."' ORDER BY a.kode_matkul ASC";
			 $this->siak_view->siak_data_matkul = $this->siak_model->siak_query("select", $sql1);
			 
			 $sql2 = "select a.kelas_id, b.nama_kelas from jadwal_kuliah a, master_kelas b where a.kelas_id = b.kelas_id and a.dosen_utama = '".$nip."' and a.mulai BETWEEN '2016-02-17 07:00:00' and '2016-02-17 23:00:00' and mulai = '2016-02-17 13:00:00'";
			 $this->siak_view->siak_data_kelas = $this->siak_model->siak_query("select", $sql2);
			 
			 $sql3 = "SELECT DISTINCT mulai FROM jadwal_kuliah WHERE mulai BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND dosen_utama = '".$nip."' ORDER BY mulai ASC";
			 $this->siak_view->siak_jam_mulai_akhir = $this->siak_model->siak_query("select", $sql3);
			
			$sql_ku = "SELECT a.*,to_char(waktu,'dd-mm-yyyy hh:mm:ss') AS time,nama_depan,nama_belakang,foto,konfirmasi FROM absensi a,data_pribadi_umum b WHERE a.nim=b.nim AND a.kode_matkul = '".$_POST['kode_matkul']."' AND a.tanggal = '".$_POST['jam_kuliah']."' AND a.kelas='".$_POST['kelas_id']."' ORDER BY a.nim ASC"; 
			
			$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", $sql_ku);			
			/* $this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.*,to_char(waktu,'dd-mm-yyyy hh:mm:ss') AS time, nama_depan,nama_belakang,prodi,foto,konfirmasi FROM absensi a,view_mahasiswa b WHERE a.nim=b.nim AND a.kode_matkul = '".$_POST['matkul']."' AND a.pertemuanke = '".$_POST['pertemuanke']."' AND date(a.tanggal) = '".$_POST['tanggal']."' AND a.prodi_id='".$prodi_id."' AND a.cohort = '".$_POST['cohort']."' ORDER BY a.nim ASC"); */

			$this->siak_view->siak_status = $this->siak_model->siak_query("select", "select status,count(status) as jumlah from absensi where kode_topik = '".$_POST['topik']."' and date(tanggal) = '".$_POST['jam_kuliah']."' and cohort = '".$_POST['cohort']."' group by status");
			$this->siak_view->siak_dosen = $this->siak_model->siak_query("select", "select * from absensi_dosen  where kode_topik = '".$_POST['topik']."' and date(tanggal) = '".$_POST['jam_kuliah']."' and cohort = '".$_POST['cohort']."'");
			$this->siak_view->dosen = $this->siak_model->siak_data_list("dosen", "*");
			$this->siak_view->jadwal = $this->siak_model->siak_query("select", "SELECT *, date(mulai) as tgl from jadwal_kuliah Where prodi_id = '".$prodi_id."' AND cohort = ".$cohort." and kode_matkul = '".$_POST['matkul']."' and pertemuanke = '".$_POST['pertemuanke']."' and date(mulai) = '".$_POST['tanggal']."' ");
			$where = array('prodi_id' => $prodi_id);
			
			$this->siak_view->prodi = $this->siak_model->siak_edit($where, "prodi", "prodi_id, prodi, fakultas_id");
			$this->siak_view->fakultas = $this->siak_model->siak_data_list("fakultas", "*");
			//var_dump($this->siak_view->fakultas);die();
			$this->siak_view->tgl = $_POST['jam_kuliah'];
			$this->siak_view->data_matkul = $this->siak_model->siak_data_list("matakuliah", "kode_matkul, nama_matkul");
			//$this->siak_view->waktu_kuliah = 
			$jml_mhs = sizeof($this->siak_view->siak_data_list);
			
			$this->siak_view->siak_render('siak_absensi_mahasiswa/confirm_absen', false);		

	}
	
	public function generate_absen(){
		$nip = $_SESSION['username'];
		$tgl_now = date("Y-m-d");
		$tgl_awal = $tgl_now." 07:00:00";
		$tgl_akhir = $tgl_now." 23:59:00"; 
		$prodi 	= $_POST['prodi'];
		
		/* $check_kelas = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE tanggal BETWEEN '2016-02-09 07:00:00' AND '2016-02-09 23:59:00'"); */
		$check_kelas = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE tanggal = '".$_POST['jam_kuliah']."' AND kode_matkul = '".$_POST['kode_matkul']."' AND prodi_id = '".$prodi."' AND kelas = '".$_POST['kelas_id']."' AND dosen_utama = '".$nip."'");
		
		//var_dump($nip);die();
		if(empty($check_kelas)){
			/* 
				$insert_kls = "SELECT m.*, n.cohort FROM (SELECT a.nim, a.kd_prodi, a.kd_matkul, a.kelas, c.kode_topik, c.mulai,
						c.pertemuanke, c.kode_matkul, c.prodi_id, c.dosen_utama
						FROM frs a
						INNER JOIN jadwal_kuliah c
						ON a.kd_matkul = c.kode_matkul WHERE c.mulai BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' AND c.dosen_utama='".$nip."') m
						INNER JOIN mahasiswa n
						ON m.nim= n.nim
						order by nim";  
			*/
						
			$insert_kls = "SELECT result.kelas, result.nim, result.prodi_id, result.kode_matkul, result.mulai, result.pertemuanke, result.dosen_utama, result.cohort
							FROM (SELECT a.*, b.*
							FROM (SELECT nim, kd_matkul, kelas, prodi_id as id_prodi
							FROM frs WHERE kd_matkul = '".$_POST['kode_matkul']."' and kelas = '".$_POST['kelas_id']."' and prodi_id = '".$prodi."') a
							LEFT JOIN ( SELECT * FROM jadwal_kuliah WHERE mulai = '".$_POST['jam_kuliah']."') b
							ON a.kd_matkul = b.kode_matkul) result";
															
			//var_dump($insert_kls);die();
			$this->siak_view->insert_kls = $this->siak_model->siak_query("select", $insert_kls);
			//var_dump($this->siak_view->insert_kls);die();
			foreach($this->siak_view->insert_kls as $key => $value) {
				$nim = $value['nim'];
				$prodi = $value['prodi_id'];
				$cohort = $value['cohort'];
				$kd_matkul = $value['kode_matkul'];
				$tanggal = $value['mulai'];
				$waktu = $value['mulai'];
				$pertemuan = $value['pertemuanke'];
				$kelas = $value['kelas'];
				//var_dump($nim." - ".$prodi." - ".$cohort." - kode matkul = ".$kd_matkul."<br>");
				$sql_insert="insert into absensi (nim,prodi_id,cohort,kode_matkul,kode_topik,tanggal,waktu,status,pertemuanke,keterangan,catatan,konfirmasi,bukti_surat,edit_id,dosen_utama,kelas) values ('".$nim."','".$prodi."','".$cohort."','".$kd_matkul."','-','".$tanggal."','".$waktu."',1,'".$pertemuan."',0,'-',0,'-',0,".$nip.",".$kelas.")";						
				//var_dump($sql_insert);die();
				$this->siak_model->siak_query("select", $sql_insert);
			}
			
		}
	}
	
	public function get_kelas(){
		$mulai = $_POST['sesi'];
		/* 
			$sql2 = "select a.kelas_id, b.nama_kelas from jadwal_kuliah a, master_kelas b where a.kelas_id = b.kelas_id and a.dosen_utama = '".$nip."' and a.mulai BETWEEN '2016-02-17 07:00:00' and '2016-02-17 23:00:00' and mulai = '".$mulai."'";
			$this->siak_data_kelas = $this->siak_model->siak_query("select", $sql2);
			echo json_encode($this->siak_data_kelas); 
		*/
		$siak_data = $this->siak_model->siak_query("select", "select a.kelas_id, b.nama_kelas from jadwal_kuliah a, master_kelas b where a.kelas_id = b.kelas_id and a.dosen_utama = '".$nip."' and a.mulai BETWEEN '2016-02-17 07:00:00' and '2016-02-17 23:00:00' and mulai = '".$mulai."'");
		$data_kelas = array();
		$result = array();

		foreach ($siak_data as $nilai => $row ){
			$data_kelas['kelas_id']=$row['kelas_id'];
			$data_kelas['nama_kelas']=$row['nama_kelas'];
			array_push($result,$data_kelas);
		}
		print json_encode($result);
	}
	
	public function absensi_cetak($jenis){
		$cohort		= $_POST['cohort'];
		$prodi_id 	= $_POST['prodi'];
		$topik 		= $_POST['kode_topik'];
		
		$sqlDTLST = "select  nama_depan,nama_belakang,b.prodi,foto,a.status,a.nim from absensi a, view_mahasiswa b where a.pertemuanke = '".$_POST['pertemuanke']."' and a.nim=b.nim and a.cohort = '".$_POST['cohort']."' and a.kode_matkul = '".$_POST['matkul']."' AND b.prodi_id='$prodi_id' order by a.nim";
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", $sqlDTLST);
		
// 		echo $sqlDTLST;
// 		echo "<pre>";
// 		var_dump($this->siak_view->siak_data_list);
// 		echo "</pre>";
// 		die();
		
// 		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "select  nama_depan,nama_belakang,prodi,foto from view_mahasiswa b where cohort = '".$_POST['cohort']."' AND prodi_id='$prodi_id' order by nim");
		$this->siak_view->dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->jadwal = $this->siak_model->siak_query("select", "SELECT *, dosen_utama as nip, date(mulai) as tgl from jadwal_kuliah Where prodi_id = '".$prodi_id."' AND cohort = ".$cohort." and kode_matkul = '".$_POST['matkul']."' and kode_topik = '".$_POST['topik']."' and date(mulai) = '".$_POST['tanggal']."' ");
		if($jenis!=''){
			$this->siak_view->siak_dosen = $this->siak_view->jadwal;
		}else{
			$this->siak_view->siak_dosen = $this->siak_model->siak_query("select", "select * from absensi_dosen  where kode_topik = '".$_POST['topik']."' and date(tanggal) = '".$_POST['tanggal']."' and cohort = '".$_POST['cohort']."'");
		}
		$where = array('prodi_id' => $prodi_id);
		
		$this->siak_view->prodi = $this->siak_model->siak_edit($where, "prodi", "prodi_id, prodi, fakultas_id");
		$this->siak_view->fakultas = $this->siak_model->siak_data_list("fakultas", "*");
		$this->siak_view->cohort = $cohort;
		$this->siak_view->data_matkul = $this->siak_model->siak_data_list("matakuliah", "kode_matkul, nama_matkul");
		$jml_mhs = sizeof($this->siak_view->siak_data_list);
		$this->siak_view->siak_render('siak_absensi_mahasiswa/absen2', true);
	}

	public function pengganti($status){
		if ($status!=1) {
			$this->siak_view->dosen = $this->siak_model->siak_data_list("dosen", "nip,nama,gelar_depan,gelar_blkng");
			$this->siak_view->siak_render('siak_absensi_mahasiswa/pengganti', true);
		}
	}
	public function load_jadwal($tahunid,$prodi,$cohort,$topik,$matkul){
		$this->siak_view->data_list = $this->siak_model->siak_query("select", "select a.id, tahun_id, b.nama_ruang, a.ruang_id,mulai, akhir,semester, to_char(mulai,'YYYY-MM-DD')as tanggal,kode_topik,cohort,prodi_id,kode_matkul,pertemuanke, (select id from absensi s where s.kode_matkul='$matkul' and s.prodi_id='$prodi' and s.pertemuanke = '$topik' and s.tanggal=mulai limit 1) as absen from jadwal_kuliah a, ruang b where b.ruang_id=a.ruang_id AND prodi_id='$prodi' AND kode_matkul='$matkul' AND pertemuanke='$topik' AND cohort='$cohort' and a.tahun_id='$tahunid'");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/jadwal', true);
		
	}
	public function getAbsen($nim,$prodi,$cohort,$topik,$matkul){
		$this->siak_view->data_list = $this->siak_model->siak_query("select", "Select *,to_char(tanggal,'HH12:MI')as time ,to_char(tanggal,'dd-mm-yyyy')as jadwal from absensi where status=4 AND waktu is null AND nim='$nim' AND cohort='$cohort' AND kode_matkul='$matkul' AND prodi_id='$prodi' AND pertemuanke='$topik'");
		//echo "Select *,to_char(tanggal,'HH12:MI')as time ,to_char(tanggal,'dd-mm-yyyy')as jadwal from absensi where status=4 AND waktu is null AND nim='$nim' AND cohort='$cohort' AND kode_matkul='$matkul' AND prodi_id='$prodi' AND pertemuanke='$topik'";
		
		$this->siak_view->data = $this->siak_model->siak_query("select", "Select *,to_char(tanggal,'HH12:MI')as time from absensi where waktu is not null AND nim='$nim' AND cohort='$cohort' AND prodi_id='$prodi' AND kode_matkul='$matkul' AND pertemuanke='$topik'");
		$this->siak_view->data_ngawur = $this->siak_model->siak_query("select", "Select *,to_char(tanggal,'HH12:MI')as time from absensi where nim='$nim' AND cohort='$cohort' AND prodi_id='$prodi' AND kode_matkul='$matkul' AND pertemuanke='$topik'");
		// echo "Select *,to_char(tanggal,'HH12:MI')as time from absensi where waktu is not null AND nim='$nim' AND cohort='$cohort' AND prodi_id='$prodi' AND kode_matkul='$matkul' AND pertemuanke='$topik'";
		foreach ($this->siak_view->data_list as $v=>$mhs){
			$tanggal=$mhs['tanggal'];
		}
		$jadwal = $this->siak_model->siak_query("select", "SELECT *, to_char(akhir,'HH12:MI')as batas from jadwal_kuliah Where kode_matkul='".$matkul."' and prodi_id = '".$prodi."' AND cohort = ".$cohort." and pertemuanke = '".$topik."' and date(mulai) = '".$tanggal."' ");
		//echo "SELECT *, to_char(akhir,'HH12:MI')as batas from jadwal_kuliah Where kode_matkul='".$matkul."' and prodi_id = '".$prodi."' AND cohort = ".$cohort." and pertemuanke = '".$topik."' and date(mulai) = '".$tanggal."' " ;
		$this->siak_view->dosen=$this->siak_model->siak_edit($where,"dosen","*");
			foreach($jadwal as $bro => $val){
				$mulai=$val['mulai'];
				$akhir=$val['akhir'];
			}
		
		
		$wkt = $this->siak_model->siak_query("select","select waktu from batas_waktu_absen");
		foreach($wkt as $row => $rec): $batas_waktu = $rec['waktu']; endforeach;
		
		$batasan = strtotime($mulai);
// 		$WaktuAbsen = date("Y-m-d H:i:s", strtotime('+15 minutes', $batasan));
// 		$time1=date("Y-m-d H:i:s", strtotime('-15 minutes', $batasan));
		$WaktuAbsen = date("Y-m-d H:i:s", strtotime('+'.$batas_waktu.' minutes', $batasan));
		$time1=date("Y-m-d H:i:s", strtotime('-'.$batas_waktu.' minutes', $batasan));
		$time2=$WaktuAbsen;
		$time4=$akhir;
		$dt = new DateTime(); 
		$dt->format('Y-m-d H:i:s');
		$time3=$dt->format('Y-m-d H:i:s');
		
			 if (strtotime($time3) > strtotime($time1) && strtotime($time3) < strtotime($time2)){
					 $this->siak_view->statusAbsen ="BISA";
					 $this->nim=$nim;
					 $this->prodi=$prodi;
				}
			else if (strtotime($time3) > strtotime($time1) && strtotime($time3) > strtotime($time2)){
					$this->siak_view->statusAbsen = "HABIS";
					}
			else {
					$this->siak_view->statusAbsen = "BUKAN";
				}
					$this->siak_view->nim = $nim;
					$this->siak_view->prodi = $prodi;
					$this->siak_view->cohort = $cohort;
// 		echo "<pre>";
// 		var_dump(strtotime($time3) > strtotime($time1) && strtotime($time3) > strtotime($time2));
// 		var_dump(strtotime($time3), strtotime($time1), strtotime($time3), strtotime($time2));
// 		var_dump("Time 3 ".$time3, "Min ".$time1, "Time 3 ".$time3, "Max ".$time2);
// 		echo "<pre>";
		//var_dump($this->siak_view->data_list);	
		$this->siak_view->siak_render('siak_absensi_mahasiswa/data_absen', true);
	}
	public function getAbsenDosen($nip,$prodi,$cohort,$topik){
		$this->siak_view->data_list = $this->siak_model->siak_query("select", "Select *,to_char(tanggal,'HH12:MI')as time from absensi_dosen where waktu is null AND status=4 AND cohort='$cohort' AND prodi_id='$prodi' AND pertemuanke='$topik'");
		$this->siak_view->data = $this->siak_model->siak_query("select", "Select *,to_char(tanggal,'HH12:MI')as time from absensi_dosen where waktu is not null AND cohort='$cohort' AND prodi_id='$prodi' AND kode_topik='$topik'");
		foreach ($this->siak_view->data_list as $v=>$dos){
			$where=array('nip'=>$dos['nip']);
			$tanggal=$dos['tanggal'];
		}
		
		$jadwal = $this->siak_model->siak_query("select", "SELECT *, to_char(akhir,'HH12:MI')as batas from jadwal_kuliah Where prodi_id = '".$prodi."' AND cohort = ".$cohort." and pertemuanke = '".$topik."' and date(mulai) = '".$tanggal."' ");
		$this->siak_view->dosen=$this->siak_model->siak_edit($where,"dosen","*");
			foreach($jadwal as $bro => $val){
				$akhir=$val['akhir'];
			}
		
		$wkt = $this->siak_model->siak_query("select","select waktu from batas_waktu_absen");
		foreach($wkt as $row => $rec): $batas_waktu = $rec['waktu']; endforeach;
		
		$batasan = strtotime($akhir);
		$WaktuAbsen = date("Y-m-d H:i:s", strtotime('-'.$batas_waktu.' minutes', $batasan));
		$time1=$WaktuAbsen;
		$time2=$akhir;
		$dt = new DateTime(); 
		$dt->format('Y-m-d H:i:s');
		$time3=$dt->format('Y-m-d H:i:s');
		
				 if (strtotime($time3) > strtotime($time1) && strtotime($time3) < strtotime($time2)){
					 $this->siak_view->statusAbsen ="BISA";
				}
				else if (strtotime($time3) > strtotime($time1) && strtotime($time3) > strtotime($time2)){
					$this->siak_view->statusAbsen = "HABIS";
					}
				else {
						$this->siak_view->statusAbsen = "BUKAN";
					}
					//var_dump( $this->siak_view->statusAbsen);
		$this->siak_view->siak_render('siak_absensi_mahasiswa/data_absenDosen', true);
	}
	// public function jadwalAbsen($cohort,$matkul,$prodi,$semes){
		// $data_list =$this->siak_model->siak_query("select","select *,  to_char(mulai,'DD, MONTH YYYY')as waktu from jadwal_kuliah where kode_matkul='$matkul' and cohort='$cohort' and semester='$semes' order by mulai asc;");
		// foreach($data_list as $key=>$row){
			// echo "<option value='".$row['mulai']."'>".$row['waktu']."-".$row['kode_topik']."</option>";		
			// }
		
	// }
	public function UpdateAbsen($cohort){
		if($_POST['hadir']!=''){
			$status = $_POST['hadir'];
		}else{
			$status=$_POST['keterangan'];
		}
		
		//Upload Bukti
		//
		/*
		if(isset($_FILES['bukti'])){
			if(is_uploaded_file($_FILES['bukti']['tmp_name'])) {
				$file_tmp = $_FILES['bukti']['tmp_name'];
				$path = "siak_public/siak_upload/Mahasiswa";
				$newpath = $path."/Bukti";
				
				$name = $_POST['nim'].'_'.$_FILES['bukti']['name'];
				
				if(is_dir($path)==false){
					$old_umask = umask(0);
					mkdir("$path", 0777);		// Create directory if it does not exist
					umask($old_umask);
					
					if(is_dir($newpath)==false){
						$old_umask = umask(0);
						mkdir("$newpath", 0777);		// Create directory if it does not exist
						umask($old_umask);
					}
					
				}
				
				$targetPath = $newpath.'/'.$name;
				move_uploaded_file($file_tmp,$targetPath);
				$sql_up = "update absensi set bukti_surat = '".$name."', status = '".$status."',waktu = '".$_POST['waktu']."', catatan='".$_POST['catatan']."' where nim = '".$_POST['nim']."' and cohort = '".$cohort."' and prodi_id = '".$_POST['prodi']."' and tanggal = '".$_POST['tgl']."';";
			}
		}else{
			$sql_up = "update absensi set status = '".$status."',waktu = '".$_POST['waktu']."', catatan='".$_POST['catatan']."' where nim = '".$_POST['nim']."' and cohort = '".$cohort."' and prodi_id = '".$_POST['prodi']."' and tanggal = '".$_POST['tgl']."';";
		}
		*/
		
		$sql_up = "update absensi set status = '".$status."',waktu = '".$_POST['waktu']."', catatan='".$_POST['catatan']."' where nim = '".$_POST['nim']."' and cohort = '".$cohort."' and prodi_id = '".$_POST['prodi']."' and tanggal = '".$_POST['tgl']."';";
		
		$this->siak_model->siak_query("update",$sql_up);
		header('location: ' . URL . 'siak_absensi_mahasiswa');
	}
	public function UpdateAbsenDosen($cohort){
	//die();
		if($_POST['nip_pengganti']!=''){
			 $this->siak_model->siak_query("update","update absensi_dosen set status = ".$_POST['keterangan'].", keterangan = '".$_POST['catatan']."', nip_pengganti = '".$_SESSION['username']."',waktu = '".$_POST['waktu']."',keterlambatan = '".$_POST['telat']."' where nip = '".$_POST['nip']."' and cohort = '".$_POST['cohort']."' and prodi_id = '".$_POST['prodi']."' and tanggal = '".$_POST['tgl']."';");
			
		}
		else{
			 $this->siak_model->siak_query("update","update absensi_dosen set status = ".$_POST['keterangan'].", keterangan = '".$_POST['catatan']."',waktu = '".$_POST['waktu']."',keterlambatan = '".$_POST['telat']."' where nip = '".$_SESSION['username']."' and cohort = '".$_POST['cohort']."' and prodi_id = '".$_POST['prodi']."' and tanggal = '".$_POST['tgl']."';");
			 echo "update absensi_dosen set status = ".$_POST['keterangan'].", keterangan = '".$_POST['catatan']."',waktu = '".$_POST['waktu']."' where nip = '".$_SESSION['username']."' and cohort = '".$_POST['cohort']."' and prodi_id = '".$_POST['prodi']."' and tanggal = '".$_POST['tgl']."';";
		}
		header('location: ' . URL . 'siak_absensi_mahasiswa/');
	}
	
	//======================== REPORT =======================//
	
	public function Report_absen(){
		$this->siak_view->config = "Siak Widyatama - View Absen Mahasiswa";
	
		$this->siak_view->judul = "View Absen Mahasiswa";
			
		$this->siak_breadcrumbs->add(array('title'=>'Laporan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Report Absen Mahasiswa','href'=>''. URL . 'siak_absensi_mahasiswa/report_absen'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_view->siak_render('siak_absensi_mahasiswa/report_absen', false);
	}
	function getReport($prodi,$cohort,$semes,$matkul){
		$this->siak_view->prodi    = $prodi;
		$this->siak_view->semester = $semes;
		$this->siak_view->matkul   = $matkul;
		$this->siak_view->cohort   = $cohort;
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='$prodi' AND cohort='$cohort' ");
		$this->siak_view->data_alpa = $this->siak_model->siak_query("select", "SELECT nim,kode_matkul, count(nim) as jumlah FROM absensi WHERE prodi_id='$prodi' AND cohort='$cohort' AND kode_matkul='$matkul' AND status='2' group by nim,kode_matkul order by nim asc ");
		$this->siak_view->data_hadir = $this->siak_model->siak_query("select", "SELECT nim,kode_matkul, count(nim) as jumlah FROM absensi WHERE prodi_id='$prodi' AND cohort='$cohort' AND kode_matkul='$matkul' AND status='1' group by nim,kode_matkul order by nim asc ");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/report_absen_mhs', true);
	}
	function getCohort($prodi){
		$this->siak_view->cohort = $this->siak_model->siak_query("select", "SELECT * FROM cohort WHERE prodi_id='$prodi'");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/getCohort', true);
	}
	function getDetail($prodi,$semester,$nim,$matkul,$cohort){
                $this->siak_view->prodi = $prodi;
                $this->siak_view->semester = $semester;
                $this->siak_view->matkul = $matkul;
                $this->siak_view->cohort = $cohort;
                $this->siak_view->nim = $nim;
		$this->siak_view->matkuls=$this->siak_model->siak_query("select", "SELECT *from matakuliah where kode_matkul='$matkul'");
		$this->siak_view->mhs = $this->siak_model->siak_query("select", "SELECT * from view_mahasiswa where nim='$nim'");
		$this->siak_view->detail = $this->siak_model->siak_query("select", "SELECT *from view_jadwal_kuliah where kode_matkul='$matkul' and cohort='$cohort' order by pertemuanke asc");
		$this->siak_view->absen = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='$prodi' AND cohort='$cohort' AND kode_matkul='$matkul' AND nim='$nim' ");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/getDetail', true);
	}
	function rekap_absen_print(){
                $this->siak_view->prodi = $_POST['prodi'];
                $this->siak_view->cohort = $_POST['cohort'];
                $this->siak_view->semester = $_POST['semester'];
                $this->siak_view->matkul = $_POST['matkul'];
                $this->siak_view->data_filter = $this->siak_model->siak_query("select", "SELECT prodi.prodi, cohort.cohort, matakuliah.semester,	matakuliah.nama_matkul FROM	cohort,	matakuliah, prodi WHERE	prodi.prodi_id = '".$_POST['prodi']."' AND cohort.cohort = '".$_POST['cohort']."' AND matakuliah.kode_matkul = '".$_POST['matkul']."' AND matakuliah.semester = '".$_POST['semester']."' ");
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='".$_POST['prodi']."' AND cohort='".$_POST['cohort']."' ");
		$this->siak_view->data_mahasiswa2 = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='".$_POST['prodi']."' AND cohort='".$_POST['cohort']."' ");
		$this->siak_view->data_alpa = $this->siak_model->siak_query("select", "SELECT nim,kode_matkul, count(nim) as jumlah FROM absensi WHERE prodi_id='".$_POST['prodi']."' AND cohort='".$_POST['cohort']."' AND kode_matkul='".$_POST['matkul']."' AND status='2' group by nim,kode_matkul order by nim asc");
		$this->siak_view->data_hadir = $this->siak_model->siak_query("select", "SELECT nim,kode_matkul, count(nim) as jumlah FROM absensi WHERE prodi_id='".$_POST['prodi']."' AND cohort='".$_POST['cohort']."' AND kode_matkul='".$_POST['matkul']."' AND status='1' group by nim,kode_matkul order by nim asc ");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/report_absen_cetak', true);
	}
	function rekap_absen_print_det(){
                $this->siak_view->prodi = $_POST['prodi'];
                $this->siak_view->semester = $_POST['semester'];
                $this->siak_view->matkul = $_POST['matkul'];
                $this->siak_view->cohort = $_POST['cohort'];
                $this->siak_view->nim = $_POST['nim'];
		$this->siak_view->matkuls=$this->siak_model->siak_query("select", "SELECT *from matakuliah where kode_matkul='".$_POST['matkul']."'");
		$this->siak_view->mhs = $this->siak_model->siak_query("select", "SELECT * from view_mahasiswa where nim='".$_POST['nim']."'");
		$this->siak_view->detail = $this->siak_model->siak_query("select", "SELECT *from view_jadwal_kuliah where kode_matkul='".$_POST['matkul']."' and cohort='".$_POST['cohort']."' order by pertemuanke asc");
		$this->siak_view->absen = $this->siak_model->siak_query("select", "SELECT * FROM absensi WHERE prodi_id='".$_POST['prodi']."' AND cohort='".$_POST['cohort']."' AND kode_matkul='".$_POST['matkul']."' AND nim='".$_POST['nim']."' ");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/report_absen_cetak_det', true);
	}
	
	//======================== END REPORT =======================//
	
	//======================== ABSENSI UJIAN =======================//
	public function absen_ujian(){
		$this->siak_view->config = "Siak Widyatama - Absen Ujian";
	
		$this->siak_view->judul = "Absen Ujian";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Absen Ujian','href'=>''. URL . 'siak_absensi_mahasiswa/absen_ujian'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_view->data_prodi =$this->siak_model->siak_data_list('prodi','prodi_id,prodi');
		$this->siak_view->siak_render('siak_absensi_mahasiswa/form_absen_ujian', false);
	}
	public function view_absen_ujian($matkul,$cohort,$prodi){
		$this->siak_view->bobot_absen =$this->siak_model->siak_data_list('bobot_absen','*');
		$this->siak_view->cohort = $cohort;
		$this->siak_view->matkul = $matkul;
		$this->siak_view->prodi = $prodi;
		$this->siak_view->data =$this->siak_model->siak_query('select',"select b.nim, nama_depan,nama_belakang,(select count(a.nim) from absensi a where a.nim=b.nim and pertemuanke between 1 and 7 and kode_matkul='$matkul' and konfirmasi='1' and a.status=1 group by a.nim) as uts,(select count(c.nim) from absensi c where c.nim=b.nim and pertemuanke between 1 and 14 and kode_matkul='$matkul' and konfirmasi='1' and c.status=1 group by c.nim) as uas  from view_mahasiswa b where prodi_id='$prodi' and cohort='$cohort'order by b.nim asc");
		
		$this->siak_view->siak_render('siak_absensi_mahasiswa/view_absen_ujian', true);
	}
	public function getPertemuan($prodi,$cohort,$matkul){
		$query="select pertemuanke, tanggal, to_char(tanggal,'dd-mm-yyyy PUKUL HH:MI:SS') as waktu from absensi where cohort='$cohort' and prodi_id='$prodi' and kode_matkul='$matkul' group by pertemuanke,tanggal order by pertemuanke asc";
		$this->siak_view->pertemuan = $this->siak_model->siak_query("select", $query);	
		$this->siak_view->siak_render('siak_absensi_mahasiswa/getPertemuan', true);
	}
	public function absensi_ujian($ujian){
		
		$prodi = $_POST['prodi'];
        $matkul = $_POST['matkul'];
        $cohort = $_POST['cohort'];
		if($ujian=='uts'){
			$kondisi='uts as ujian';
			$kondisi2='and uts>=5';
			$this->siak_view->minpertemuan=5;
		}else{
			$this->siak_view->minpertemuan=12;
			$kondisi='uas as ujian';
			$kondisi2='and uas>=12';
		}
        
		$query="select foto,nim,prodi,prodi_id,nama_depan,nama_belakang,kode_matkul, ".$kondisi." from view_absen_ujian where cohort='$cohort' and prodi_id='$prodi' and kode_matkul='$matkul' ".$kondisi2."  order by nim asc";
				
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", $query);	
		$this->siak_view->siak_render('siak_absensi_mahasiswa/absen_ujian', false);
		
	}
	
	//======================== END ABSENSI UJIAN =======================//

}

?>
