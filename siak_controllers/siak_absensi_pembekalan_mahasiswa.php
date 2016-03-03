<?php

/* Siak absensi mahasiswa controller class */

class Siak_absensi_pembekalan_mahasiswa extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->config = "Siak Unhan - Absensi Pembekalan";
		
		$this->siak_view->judul = "Absensi Pembekalan";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Pembekalan','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Absensi Pembekalan','href'=>'' .URL. 'siak_absensi_pembekalan_mahasiswa'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "pembekalan" && $value['kode'] == "absensi_pembekalan") {
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_datalist();
	}	

	function siak_datalist(){
		$this->siak_view->data_materi = $this->siak_model->siak_data_list("materi_pembekalan", "*");
		$this->siak_view->siak_render('siak_absensi_pembekalan_mahasiswa/index', false);
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
						$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' $nim;");
						// echo "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' AND a.pembekalan = 1 $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' AND a.pembekalan = 3 $nim;";
					}elseif ($_POST['status']==1) {
						$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id $nim;");
						// echo "SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.pembekalan = 1 $nim UNION SELECT a.nim, a.status, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status != 2 AND a.prodi_id = c.prodi_id AND a.pembekalan = 3 $nim;";
					}
				}
			}
			foreach ($this->siak_view->siak_data_list as $key => $vap) {
				$this->siak_model->siak_query("update","update mahasiswa set pembekalan=3 where nim = '".$vap['nim']."';");
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

	public function jenis($status){
		if ($status == 1) {
			$where = array('status' => $status);
			$this->siak_view->data_materi = $this->siak_model->siak_edit($where, "materi_pembekalan", "*");
			$this->siak_view->siak_render('siak_absensi_pembekalan_mahasiswa/materi', true);
		}elseif ($status == 2) {
			$this->siak_view->data_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id, prodi");
			$this->siak_view->siak_render('siak_absensi_pembekalan_mahasiswa/prodi', true);
		}
	}

	public function materi($prodi_id){
		$where = array('prodi_id' => $prodi_id, 'status' => 2);
		$this->siak_view->data_materi = $this->siak_model->siak_edit($where, "materi_pembekalan", "*");
		$this->siak_view->siak_render('siak_absensi_pembekalan_mahasiswa/materi2', true);
	}

	public function ruang($materi_id){
		$where = array('materi_id' => $materi_id);
		$this->siak_view->data_ruang = $this->siak_model->siak_edit($where, "atur_pembekalan", "*");
		$this->siak_view->master_ruang = $this->siak_model->siak_data_list("ruang", "*");
		// var_dump($this->siak_view->master_ruang); die();
		$this->siak_view->siak_render('siak_absensi_pembekalan_mahasiswa/ruang', true);
	}

	public function confirm_absen(){
		$absen = implode(',', $_POST['hadir']);
		$hadir = explode(',', $absen);
		$nim = implode(',', $_POST['nim']);
		$hadir_nim = explode(',', $nim);
		$keterangan = implode(',', $_POST['keterangan']);
		$hadir_keterangan = explode(',', $keterangan);
		foreach ($hadir as $key) {
			foreach ($hadir_nim as $keys) {
				foreach ($hadir_keterangan as $value) {
					$key['status'] = $key['status']!=""?$key['status']:'2';
					$this->siak_model->siak_query("update","update absensi_pembekalan set status = ".$key['status'].", keterangan = '".$value."' where nim = ".$keys." AND materi_id = '".$_POST['materi_id']."' and ruang_id = '".$_POST['ruang_id']."' and tanggal = '".$_POST['tgl']."';");
				}
			}
		}
		$this->siak_model->siak_query("update","update absensi_pembekalan_dosen set status = ".$key['hadir_pengganti'].", keterangan = '".$_POST['keterangan_pengganti']."', pengampu_pengganti = '".$_POST['nip_pengganti']."' where pengampu_id = ".$_POST['pengampu_id']."  AND materi_id = '".$_POST['materi_id']."' and ruang_id = '".$_POST['ruang_id']."' AND tanggal = '".$_POST['tgl']."';");
		header('location: ' . URL . 'siak_absensi_pembekalan_mahasiswa/');
	}

	public function absensi_cetak(){
		$cohort		= $_POST['cohort'];
		$prodi_id 	= $_POST['prodi'];
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.nim, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto, c.prodi FROM mahasiswa a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.status = 1 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' AND a.cohort = ".$cohort." UNION SELECT a.nim, a.prodi_id, b.nama_depan, b.nama_belakang, b.foto,  c.prodi FROM mahasiswa a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.status = 1 AND a.prodi_id = c.prodi_id AND a.prodi_id = '".$prodi_id."' AND a.cohort = ".$cohort."");
		$this->siak_view->jadwal = $this->siak_model->siak_query("select", "SELECT *, date(start) as tgl from jadwal_kuliah Where prodi_id = '".$prodi_id."' AND cohort = ".$cohort." and kode_matkul = '".$_POST['matkul']."' and kode_topik = '".$_POST['topik']."' and date(start) = '".$_POST['tanggal']."' ");
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
			$this->siak_view->dosen = $this->siak_model->siak_data_list("pengampu_pembekalan", "*");
			$this->siak_view->siak_render('siak_absensi_pembekalan_mahasiswa/pengganti', true);
		}
	}
}

?>