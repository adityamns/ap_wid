<?php
if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');
/* Siak dashboard controller class */

class Siak_cetak extends Siak_controller{
	
	function __construct(){
		// $this->js = array('siak_views/siak_dashboard/js/default.js');
		// $this->css = array('siak_public/siak_css/siak_default.css');
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "mahasiswa") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
				$this->prodi_id = $value['prodi_id'];
			}
		}		
	
	}

	
	function get_data_event(){
	$siak_data = $this->siak_model->siak_query("SELECT","SELECT
  event.warna,
  event.event, 
  kalender.event_id, 
  kalender.title, 
  kalender.start, 
  kalender.end
  event.keterangan  
FROM 
  public.event, 
  public.kalender
WHERE 
  kalender.event_id = event.id and
kalender.start<='2014-01-01' and kalender.end>='2014-01-01' and keterangan='sps';");

		 $data_event = array();
		
				 $result = array();
		
		foreach ($siak_data as $nilai => $row ){
			// $data_event['tahun_id']=$row['tahun_id'];
			$data_event['warna']=$row['warna'];
			$data_event['event']=$row['event'];
			$data_event['title']=$row['title'];
			$data_event['start']=$row['start'];
			$data_event['end']=$row['end'];
			$data_event['keterangan']=$row['keterangan'];
			 array_push($result,$data_event);
		 }
	
	}
	function index(){
		$this->siak_view->siak_render('siak_laporan/index', false);
		 //parent::siak_render('Siak_dashboard/index', false);
	}
	function kalender_akademik(){
		$this->siak_view->siak_render('siak_laporan/kalender_akademik', false);
		 //parent::siak_render('Siak_dashboard/index', false);
	}
	function kalender_akademik_nonsps(){
		$this->siak_view->siak_render('siak_laporan/kalender_akademik_nonsps', false);
		 //parent::siak_render('Siak_dashboard/index', false);
	}
	function kalender_akademik3(){
		$this->siak_view->siak_render('siak_laporan/kalender_akademik3', true);	
		 //parent::siak_render('Siak_dashboard/index', false);
	}

	function kalender_akademik_view(){
		$this->siak_view->siak_render('siak_laporan/kalender_akademik_view', false);	
		 //parent::siak_render('Siak_dashboard/index', false);
	}

	function kalender_akademik_sps(){
		$this->siak_view->siak_render('siak_laporan/kalender_akademik_sps', false);
		 //parent::siak_render('Siak_dashboard/index', false);
	}
	function testtingtong(){
		$this->siak_view->siak_render('siak_laporan/test', true);
		 //parent::siak_render('Siak_dashboard/index', false);
	}
	
	function kalender_akademik_sps_cetak(){
		$this->siak_view->siak_render('siak_laporan/kalender_akademik_sps_cetak', false);
		 //parent::siak_render('Siak_dashboard/index', false);
	}

	function khs_daftar(){
		$this->siak_view->siak_render('siak_laporan/khs_daftar', false);
		 //parent::siak_render('Siak_dashboard/index', false);
	}

	function cetak_khs(){
		$this->siak_view->siak_render('siak_laporan/khs_cetak',true);
		 //parent::siak_render('Siak_dashboard/index', false);
	}

	function master_program_studi(){
		$this->siak_view->siak_render('siak_laporan/master/master_program_studi', false);
		 //parent::siak_render('Siak_dashboard/index', false);
	}
	
	public function absensi(){
		$prodi_id = $_POST['prodi_id'];
		$where = array('prodi_id' => $prodi_id);
		$this->siak_view->data_prodi = $this->siak_model->siak_edit($where, "prodi", "prodi");
		$this->siak_view->jadwal = $this->siak_model->siak_query("select", "SELECT *, date(start) as tgl from jadwal_pembekalan Where materi_id = '".$_POST['materi_id']."' and date(start) = '".$_POST['tanggal']."';");
		$jadwal = sizeof($this->siak_view->jadwal);
		if ($jadwal > 0) {
			foreach ($this->siak_view->jadwal as $key => $value) {
				$tgl = date($value['tgl']);
				$this->siak_view->detail_jadwal = $this->siak_model->siak_query("select", "SELECT * from detail_jadwal_pembekalan Where id_jadwal = '".$value['id']."' and ruang_id = '".$_POST['ruang_id']."';");
				foreach ($this->siak_view->detail_jadwal as $key => $val) {
					$this->siak_model->siak_query("insert","insert into absensi_pembekalan_dosen(pengampu_id,materi_id,ruang_id,tanggal,status,keterangan) values (".$val['pengampu_id'].",".$value['materi_id'].", '".$val['ruang_id']."', '".$tgl."', 1,'');");
					// echo "insert into absensi_pembekalan_dosen(pengampu_id,materi_id,ruang_id,tanggal,status,keterangan) values (".$val['pengampu_id'].",".$value['materi_id'].", '".$val['ruang_id']."', '".$tgl."', 1,'');";
					$this->siak_model->siak_query("update", "UPDATE absensi_pembekalan SET tanggal = '".$tgl."' , status = 1 WHERE materi_id = '".$_POST['materi_id']."' and ruang_id = '".$_POST['ruang_id']."';");
					// echo "UPDATE absensi_pembekalan SET tanggal = '".$tgl."' AND status = 1 WHERE materi_id = '".$_POST['materi_id']."' and ruang_id = '".$_POST['ruang_id']."';";
					$kondisi = array('pengampu_id' => $val['pengampu_id']);
					$this->siak_view->dosen = $this->siak_model->siak_edit($kondisi, "pengampu_pembekalan", "*");
					$this->siak_view->absensi = $this->siak_model->siak_query("select", "SELECT * from absensi_pembekalan Where materi_id = '".$_POST['materi_id']."' and ruang_id = '".$_POST['ruang_id']."';");
					// var_dump($this->siak_view->absensi); die();
					$nim = "AND(a.nim = ";
					foreach ($this->siak_view->absensi as $key => $vals) {
						$nim .= "'".$vals['nim']."' OR a.nim = ";
					}
					$nim  =  substr($nim, 0, sizeof($nim) -13);
					$nim .= ")";
					if ($_POST['status']==2) {
						$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' AND a.pembekalan = 1 $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' AND a.pembekalan = 3 $nim;");
						// echo "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' AND a.pembekalan = 1 $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' AND a.pembekalan = 3 $nim;";
					}elseif ($_POST['status']==1) {
						$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.pembekalan = 1 $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.pembekalan = 3 $nim;");
						// echo "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.pembekalan = 1 $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.pembekalan = 3 $nim;";
					}
				}
			}
			// var_dump($this->siak_view->siak_data_list); 
			// die();
		}else{
			echo "data tidak ada";
		}
		// echo "<br><br>";
		// var_dump($this->siak_view->siak_data_list);
		// die();

		// $where = array('prodi_id' => $prodi_id);
		// $this->siak_view->prodi = $this->siak_model->siak_edit($where, "prodi", "prodi_id, prodi, fakultas_id");
		$this->siak_view->tgl    = $_POST['tanggal'];
		$this->siak_view->materi_id = $_POST['materi_id'];
		$this->siak_view->ruang_id = $_POST['ruang_id'];
		$this->siak_view->materi = $this->siak_model->siak_data_list("materi_pembekalan", "materi_id, materi");
		$jml_mhs = sizeof($this->siak_view->siak_data_list);
		$this->siak_view->siak_render('siak_absensi_pembekalan_mahasiswa/absen', false);
	}
	
	
	function cetak_jadwal_pembekalan()
	{
		$this->siak_view->siak_render('siak_laporan/jadwal_pembekalan',false);
	}

}

?>