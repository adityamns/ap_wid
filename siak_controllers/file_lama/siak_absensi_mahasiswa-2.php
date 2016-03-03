<?php

/* Siak absensi mahasiswa controller class */

class Siak_absensi_mahasiswa extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->config = "Siak Unhan - Absensi Mahasiswa";
	
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
	public function absensi_dosen(){
		$where = array('nip' => $_SESSION['username']);
		$this->siak_view->dosen=$this->siak_model->siak_edit($where, "dosen", "*");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->tahun = $this->siak_model->siak_data_list("tahun_akademik", "*");
		$this->siak_view->matakuliah = $this->siak_model->siak_data_list("matakuliah", "*");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/absen_dosen', false);		
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
		
		// foreach ($this->siak_view->siak_data_list as $key => $value) {
			
			  // $this->siak_model->siak_query("insert","insert into absensi (nim, prodi_id, cohort,kode_matkul,kode_topik,tanggal,status,pertemuanke) values ('".$value['nim']."','".$prodi_id."', ".$cohort.", '".$_POST['matkul']."', '".$_POST['topik']."', '".$_POST['tanggal']."', 4,'".$_POST['pertemuanke']."');");
			
			
		// }
		
		$this->siak_view->jadwal = $this->siak_model->siak_query("select", "SELECT dosen_utama,kode_matkul, date(mulai) as tgl from jadwal_kuliah Where prodi_id = '".$prodi_id."' AND cohort = ".$cohort." and kode_matkul = '".$_POST['matkul']."' and date(mulai) = '".$_POST['tanggal']."' ");
		  foreach ($this->siak_view->jadwal as $key => $value) {
			 $kondisi = array('nip' => $value['dosen_utama']);
			 $this->siak_view->dosen = $this->siak_model->siak_edit($kondisi, "dosen", "*");
			// foreach ($this->siak_view->dosen as $key => $val) {
				 // $this->siak_model->siak_query("insert","insert into absensi_dosen (nip,prodi_id,cohort,kode_matkul,kode_topik,tanggal,status,pertemuanke) values ('".$val['nip']."','".$prodi_id."', ".$cohort.", '".$_POST['matkul']."', '".$_POST['topik']."', '".$_POST['tanggal']."', 4,'".$_POST['pertemuanke']."');");
				
			// }
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
	public function matkul_dosen($prodi_id, $semester,$NIP){
		$this->siak_view->data_matkul = $this->siak_model->siak_query("select", "select b.*, dosen_utama,dosen_pendamping from dosen_matakuliah a,matakuliah b where a.kode_matkul=b.kode_matkul AND semester='".$semester."' AND a.prodi_id='".$prodi_id."' AND dosen_utama like '%".$NIP."%'
		UNION
		select b.*, dosen_utama,dosen_pendamping from dosen_matakuliah a,matakuliah b where a.kode_matkul=b.kode_matkul AND semester='".$semester."' AND a.prodi_id='".$prodi_id."' AND dosen_utama like '%".$NIP."%' ");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/matkul', true);
	}

	public function topik($kode_matkul){
		$where = array('kode_matkul' => $kode_matkul);
		$this->siak_view->data_topik = $this->siak_model->siak_edit($where, "topik", "kode_topik, nama_topik, kode_matkul");
		$this->siak_view->siak_render('siak_absensi_mahasiswa/topik', true);
	}
	public function konfirmasi(){
		
		//$where = array('kode_matkul' => $kode_matkul);
		$this->siak_view->data_list = $this->siak_model->siak_query("select", "select cohort,a.kode_matkul,nama_matkul,a.prodi_id,tanggal,count(nim) as jumlah,a.kode_topik,pertemuanke,case when a.konfirmasi is null then 'belum' ELSE 'sudah' END as status from absensi a,matakuliah b where a.kode_matkul=b.kode_matkul group by cohort,a.kode_matkul,a.prodi_id,tanggal,a.kode_topik,pertemuanke,nama_matkul,konfirmasi order by a.kode_matkul,a.kode_topik,konfirmasi ASC");
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
		
		$total = count($_POST['nim']);
		$nim = $_POST['nim'];
		$status = $_POST['ket'];
		$confirm = $_POST['confirm'];
		
		$tgl = $_POST['tgl'];
		
		for ($i=0 ; $i < $total; $i++){
		
			if($status[$i] != 1){
				echo $status[$i]."<br>";
				//Send Notif utk MHS yg Tidak Masuk (S/I/A)
				
				$url = "siak_dashboard";
				$this->siak_model->notifAbsen($nim, $url);
			}
			
			echo"update absensi set status = ".$status[$i].", konfirmasi='".$confirm[$i]."' where nim = '".$nim[$i]."' and cohort = '".$_POST['cohort']."' and prodi_id = '".$_POST['prodi_id']."' and tanggal = '".$_POST['tgl']."';<br>";
			// $this->siak_model->siak_query("update","update absensi set status = ".$status[$i].", konfirmasi='".$confirm[$i]."' where nim = '".$nim[$i]."' and cohort = '".$_POST['cohort']."' and prodi_id = '".$_POST['prodi_id']."' and tanggal = '".$_POST['tgl']."';");
		
		
		}
		die();
		
			header('location: ' . URL . 'siak_absensi_mahasiswa/konfirmasi');
	}

	public function DATA_KONFIRMASI(){
		
		$cohort		= $_POST['cohort'];
		$prodi_id 	= $_POST['prodi'];
		$topik 	= $_POST['kode_topik'];
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "select a.*, nama_depan,nama_belakang,prodi,foto,konfirmasi from absensi a,view_mahasiswa b where a.nim=b.nim and pertemuanke = '".$_POST['pertemuanke']."' and date(tanggal) = '".$_POST['tanggal']."' and a.cohort = '".$_POST['cohort']."' order by a.nim ASC");
		$this->siak_view->siak_status = $this->siak_model->siak_query("select", "select status,count(status) as jumlah from absensi where kode_topik = '".$_POST['topik']."' and date(tanggal) = '".$_POST['tanggal']."' and cohort = '".$_POST['cohort']."' group by status");
		$this->siak_view->siak_dosen = $this->siak_model->siak_query("select", "select * from absensi_dosen  where kode_topik = '".$_POST['topik']."' and date(tanggal) = '".$_POST['tanggal']."' and cohort = '".$_POST['cohort']."'");
		$this->siak_view->dosen = $this->siak_model->siak_data_list("dosen", "*");
		$this->siak_view->jadwal = $this->siak_model->siak_query("select", "SELECT *, date(mulai) as tgl from jadwal_kuliah Where prodi_id = '".$prodi_id."' AND cohort = ".$cohort." and kode_matkul = '".$_POST['matkul']."' and pertemuanke = '".$_POST['pertemuanke']."' and date(mulai) = '".$_POST['tanggal']."' ");
		$where = array('prodi_id' => $prodi_id);
		
		$this->siak_view->prodi = $this->siak_model->siak_edit($where, "prodi", "prodi_id, prodi, fakultas_id");
		$this->siak_view->fakultas = $this->siak_model->siak_data_list("fakultas", "*");
		$this->siak_view->cohort = $cohort;
		$this->siak_view->tgl = $_POST['tanggal'];
		$this->siak_view->data_matkul = $this->siak_model->siak_data_list("matakuliah", "kode_matkul, nama_matkul");
		$jml_mhs = sizeof($this->siak_view->siak_data_list);
		
		$this->siak_view->siak_render('siak_absensi_mahasiswa/confirm_absen', false);
	}
	public function absensi_cetak($jenis){
		$cohort		= $_POST['cohort'];
		$prodi_id 	= $_POST['prodi'];
		$topik 	= $_POST['kode_topik'];
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "select  nama_depan,nama_belakang,prodi,foto from view_mahasiswa b where cohort = '".$_POST['cohort']."' AND prodi_id='$prodi_id' order by nim");
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
		$this->siak_view->data_list = $this->siak_model->siak_query("select", "Select *,to_char(tanggal,'HH12:MI')as time from absensi where status=4 AND waktu is null AND nim='$nim' AND cohort='$cohort' AND kode_matkul='$matkul' AND prodi_id='$prodi' AND pertemuanke='$topik'");
		$this->siak_view->data = $this->siak_model->siak_query("select", "Select *,to_char(tanggal,'HH12:MI')as time from absensi where waktu is not null AND nim='$nim' AND cohort='$cohort' AND prodi_id='$prodi' AND kode_matkul='$matkul' AND pertemuanke='$topik'");
		// echo "Select *,to_char(tanggal,'HH12:MI')as time from absensi where waktu is not null AND nim='$nim' AND cohort='$cohort' AND prodi_id='$prodi' AND kode_matkul='$matkul' AND pertemuanke='$topik'";
		foreach ($this->siak_view->data_list as $v=>$mhs){
			$tanggal=$mhs['tanggal'];
		}
		$jadwal = $this->siak_model->siak_query("select", "SELECT *, to_char(akhir,'HH12:MI')as batas from jadwal_kuliah Where prodi_id = '".$prodi."' AND cohort = ".$cohort." and pertemuanke = '".$topik."' and date(mulai) = '".$tanggal."' ");
		$this->siak_view->dosen=$this->siak_model->siak_edit($where,"dosen","*");
			foreach($jadwal as $bro => $val){
				$mulai=$val['mulai'];
				$akhir=$val['akhir'];
			}
		$batasan = strtotime($mulai);
		$WaktuAbsen = date("Y-m-d H:i:s", strtotime('+15 minutes', $batasan));
		$time1=$mulai;
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
			else if (strtotime($time3) > strtotime($time1) && strtotime($time3) < strtotime($time4)){
					$this->siak_view->statusAbsen = "HABIS";
					}
			else {
					$this->siak_view->statusAbsen = "BISA";
				}
					$this->siak_view->nim = $nim;
					$this->siak_view->prodi = $prodi;
					$this->siak_view->cohort = $cohort;
				
		$this->siak_view->siak_render('siak_absensi_mahasiswa/data_absen', true);
	}
	public function getAbsenDosen($nip,$prodi,$cohort,$topik){
		$this->siak_view->data_list = $this->siak_model->siak_query("select", "Select *,to_char(tanggal,'HH12:MI')as time from absensi_dosen where waktu is null AND status=4 AND cohort='$cohort' AND prodi_id='$prodi' AND kode_topik='$topik'");
		$this->siak_view->data = $this->siak_model->siak_query("select", "Select *,to_char(tanggal,'HH12:MI')as time from absensi_dosen where waktu is not null AND cohort='$cohort' AND prodi_id='$prodi' AND kode_topik='$topik'");
		foreach ($this->siak_view->data_list as $v=>$dos){
			$where=array('nip'=>$dos['nip']);
			$tanggal=$dos['tanggal'];
		}
		
		$jadwal = $this->siak_model->siak_query("select", "SELECT *, to_char(akhir,'HH12:MI')as batas from jadwal_kuliah Where prodi_id = '".$prodi."' AND cohort = ".$cohort." and kode_topik = '".$topik."' and date(mulai) = '".$tanggal."' ");
		$this->siak_view->dosen=$this->siak_model->siak_edit($where,"dosen","*");
			foreach($jadwal as $bro => $val){
				$akhir=$val['akhir'];
			}
		$batasan = strtotime($akhir);
		$WaktuAbsen = date("Y-m-d H:i:s", strtotime('-15 minutes', $batasan));
		$time1=$WaktuAbsen;
		$time2=$akhir;
		$dt = new DateTime(); 
		$dt->format('Y-m-d H:i:s');
		$time3=$dt->format('Y-m-d H:i:s');
		
				 if (strtotime($time3) > strtotime($time1) && strtotime($time3) < strtotime($time2)){
					 $this->siak_view->statusAbsen ="BISA";
				}else{
					$this->siak_view->statusAbsen = "HABIS";
					}
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
	public function Report_absen(){
		$this->siak_view->config = "Siak Unhan - View Absen Mahasiswa";
	
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
	public function absen_ujian(){
		$this->siak_view->config = "Siak Unhan - Absen Ujian";
	
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
		die();
		// $this->siak_view->jadwal = $this->siak_model->siak_query("select", "SELECT dosen_utama,kode_matkul, date(mulai) as tgl from jadwal_kuliah Where prodi_id = '".$prodi_id."' AND cohort = ".$cohort." and kode_matkul = '".$_POST['matkul']."' and date(mulai) = '".$_POST['tanggal']."' ");
		  // foreach ($this->siak_view->jadwal as $key => $value) {
			 // $kondisi = array('nip' => $value['dosen_utama']);
			 // $this->siak_view->dosen = $this->siak_model->siak_edit($kondisi, "dosen", "*");
		 // }
		
		// $where = array('prodi_id' => $prodi_id);
		// $wheretopik = array('kode_topik' => $_POST['topik']);
		// $this->siak_view->prodi = $this->siak_model->siak_edit($where, "prodi", "prodi_id, prodi, fakultas_id");
		// $this->siak_view->data_topik = $this->siak_model->siak_edit($wheretopik, "topik", "*");
		// $this->siak_view->fakultas = $this->siak_model->siak_data_list("fakultas", "*");
		// $this->siak_view->cohort = $cohort;
		// $this->siak_view->tgl = $_POST['tanggal'];
		// $this->siak_view->data_matkul = $this->siak_model->siak_data_list("matakuliah", "kode_matkul, nama_matkul");
		// $jml_mhs = sizeof($this->siak_view->siak_data_list);
		// $this->siak_view->siak_render('siak_absensi_mahasiswa/absen', false);
	}
}

?>
