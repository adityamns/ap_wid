<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak jadwal controller class */

class Siak_jadwal_proposal extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->siak_view->config = "Siak Widyatama - Jadwal Proposal";
	
			$this->siak_view->judul = "Jadwal Proposal";
			
			$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
			$this->siak_breadcrumbs->add(array('title'=>'Tugas Akhir','href'=>'#'));
			$this->siak_breadcrumbs->add(array('title'=>'Jadwal Proposal','href'=>''. URL . 'siak_pendaftaran_judul'));
			$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	}

	
	function index(){
		$this->create();
	}

	public function siak_add(){		
		$this->siak_view->siak_render('siak_jadwal_proposal/add', true);
	}
	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		
	}
	public function cek_ruang(){
		$mulai	 = $_POST['mulai'];
		$akhir	 = $_POST['akhir'];
		$ruang	 = $_POST['ruang_id'];
		$penguji = $_POST['penguji_id'];
		$jumlah = count($penguji);
		$data['cek_ruang'] = $this->siak_model->siak_query("select", "select id from jadwal_sidang where mulai between '$mulai' and '$akhir' AND ruang_id='$ruang' or akhir between '$mulai' and '$akhir' AND ruang_id='$ruang'");
		//echo "select id from jadwal_sidang where mulai between '$mulai' and '$akhir' AND ruang_id='$ruang' or akhir between '$mulai' and '$akhir' AND ruang_id='$ruang'";
		$dosen=array();
		for ($i=0;$i<$jumlah;$i++){
			$dosen = $this->siak_model->siak_query("select", "select id from jadwal_sidang where mulai between '$mulai' and '$akhir' and penguji_id like '%".$penguji[$i]."%' or akhir between '$mulai' and '$akhir' and penguji_id like '%".$penguji[$i]."%' ");
		}
		$data['cek_dosen']='ADA';
		if($data['cek_ruang']==null){
			$data['cek_ruang']='KOSONG';
		}
		 if($dosen==null){
			$data['cek_dosen']='KOSONG';
		 }
		 
		
		echo json_encode($data);
	}
	public function data_list(){
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "select a.tahun_id, a.prodi_id, b.prodi, c.nama_tahun,SUBSTRING(c.nama_tahun,1,4) AS tahun from jadwal_sidang a, prodi b, tahun_akademik c where a.tahun_id=c.tahun_id AND a.prodi_id=b.prodi_id group by a.tahun_id,a.prodi_id,b.prodi,nama_tahun");
		$this->siak_view->siak_render('siak_jadwal_proposal/data_list', false);
	}
	
	//===============================
	public function list_data_mhs_proposal(){
		$this->siak_view->siak_data_dosen = $this->siak_model->siak_query("select","select *from pembimbing
		");
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT a.nim, b.nama_depan, b.nama_belakang,a.judul, c.prodi ,a.dosen_pembimbing1,a.dosen_pembimbing2,(select v.id from jadwal_sidang v where v.judultesis_id=a.judultesis_id and v.prodi_id=a.prodi_id) as jadwal FROM pendaftaran_judul_tesis a, view_mahasiswa b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id "
		.($_SESSION['prodi'] ? "AND a.prodi_id='".$_SESSION['prodi']."' " :"") ." 
		AND a.status=3");
		
		$this->siak_view->siak_render('siak_jadwal_proposal/list_data', false);
	}
	//===============================
	
	public function detail_list($tahunid,$prodi){
		if(Siak_session::siak_get('level')==16){
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT *from (SELECT a.id,a.tahun_id,SUBSTRING(f.nama_tahun,1,4) AS tahun, a.nim, b.nama_ruang, d.nama_depan,d.nama_belakang, c.judul,  a.mulai as START, a.akhir as END, e.prodi, e.prodi_id
		FROM jadwal_sidang a, ruang b, pendaftaran_judul_tesis c, data_pribadi_umum d, prodi e, tahun_akademik f
		WHERE a.nim='".Siak_session::siak_get('username')."' and a.tahun_id='$tahunid' and a.prodi_id='$prodi' AND a.nim = d.nim AND b.ruang_id=a.ruang_id  AND a.judultesis_id=c.judultesis_id AND c.prodi_id = e.prodi_id AND f.tahun_id=a.tahun_id
		UNION 
		SELECT a.id,a.tahun_id,SUBSTRING(f.nama_tahun,1,4) AS tahun, a.nim, b.nama_ruang, d.nama_depan,d.nama_belakang, c.judul,  a.mulai as START, a.akhir as END, e.prodi ,e.prodi_id
		FROM jadwal_sidang a,ruang b, pendaftaran_judul_tesis c, data_pribadi_pns d, prodi e, tahun_akademik f WHERE a.nim='".Siak_session::siak_get('username')."' and a.tahun_id='$tahunid' and a.prodi_id='$prodi' AND a.nim = d.nim AND b.ruang_id=a.ruang_id  AND a.judultesis_id = c.judultesis_id AND c.prodi_id = e.prodi_id AND f.tahun_id=a.tahun_id)as DATA order by start asc");
		}else{
			$cek = $this->siak_model->siak_query("select","select * from users where username='".Siak_session::siak_get('username')."'");
			foreach($cek as $c => $ek){
				$pro = $ek['prodi_id'];
			}
			if($pro == ""){
				$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT *from (SELECT a.id,a.tahun_id,SUBSTRING(f.nama_tahun,1,4) AS tahun, a.nim, b.nama_ruang, d.nama_depan,d.nama_belakang, c.judul,  a.mulai as START, a.akhir as END, e.prodi, e.prodi_id
		FROM jadwal_sidang a, ruang b, pendaftaran_judul_tesis c, data_pribadi_umum d, prodi e, tahun_akademik f
		WHERE a.tahun_id='$tahunid' and a.prodi_id='$prodi' AND a.nim = d.nim AND b.ruang_id=a.ruang_id  AND a.judultesis_id=c.judultesis_id AND c.prodi_id = e.prodi_id AND f.tahun_id=a.tahun_id
		UNION 
		SELECT a.id,a.tahun_id,SUBSTRING(f.nama_tahun,1,4) AS tahun, a.nim, b.nama_ruang, d.nama_depan,d.nama_belakang, c.judul,  a.mulai as START, a.akhir as END, e.prodi ,e.prodi_id
		FROM jadwal_sidang a,ruang b, pendaftaran_judul_tesis c, data_pribadi_pns d, prodi e, tahun_akademik f WHERE a.tahun_id='$tahunid' and a.prodi_id='$prodi' AND a.nim = d.nim AND b.ruang_id=a.ruang_id  AND a.judultesis_id = c.judultesis_id AND c.prodi_id = e.prodi_id AND f.tahun_id=a.tahun_id)as DATA order by start asc");
			}else{
				$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT *from (SELECT a.id,a.tahun_id,SUBSTRING(f.nama_tahun,1,4) AS tahun, a.nim, b.nama_ruang, d.nama_depan,d.nama_belakang, c.judul,  a.mulai as START, a.akhir as END, e.prodi, e.prodi_id
		FROM jadwal_sidang a, ruang b, pendaftaran_judul_tesis c, data_pribadi_umum d, prodi e, tahun_akademik f
		WHERE a.prodi_id='".$pro."' and a.tahun_id='$tahunid' and a.prodi_id='$prodi' AND a.nim = d.nim AND b.ruang_id=a.ruang_id  AND a.judultesis_id=c.judultesis_id AND c.prodi_id = e.prodi_id AND f.tahun_id=a.tahun_id
		UNION 
		SELECT a.id,a.tahun_id,SUBSTRING(f.nama_tahun,1,4) AS tahun, a.nim, b.nama_ruang, d.nama_depan,d.nama_belakang, c.judul,  a.mulai as START, a.akhir as END, e.prodi ,e.prodi_id
		FROM jadwal_sidang a,ruang b, pendaftaran_judul_tesis c, data_pribadi_pns d, prodi e, tahun_akademik f WHERE a.prodi_id='".$pro."' and a.tahun_id='$tahunid' and a.prodi_id='$prodi' AND a.nim = d.nim AND b.ruang_id=a.ruang_id  AND a.judultesis_id = c.judultesis_id AND c.prodi_id = e.prodi_id AND f.tahun_id=a.tahun_id)as DATA order by start asc");
			}
		}
		$this->siak_view->siak_render('siak_jadwal_proposal/detail_list', false);
	}

	public function detail($prodi,$nim){
		$this->siak_view->siak_dosen = $this->siak_model->siak_query("select", "SELECT *from dosen");
		$this->siak_view->siak_data = $this->siak_model->siak_query("select", "SELECT a.nim, b.nama_depan, b.nama_belakang, a.judultesis_id as judul_id,a.dosen_pembimbing1,a.dosen_pembimbing2, a.judul, c.prodi FROM pendaftaran_judul_tesis a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND a.prodi_id='$prodi' AND a.status=3 and a.nim='$nim' UNION 
			SELECT a.nim, b.nama_depan, b.nama_belakang,a.judultesis_id as judul_id,a.dosen_pembimbing1,a.dosen_pembimbing2, a.judul,  c.prodi FROM pendaftaran_judul_tesis a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND a.prodi_id='$prodi' AND a.status=3 and a.nim='$nim'");
		
		$this->siak_view->siak_render('siak_jadwal_proposal/data', true);
	}
	
	public function siak_create(){
		$_POST['penguji_id'] = implode(',', $_POST['penguji_id']);
		$this->siak_model->siak_create();
	}
	
	public function load_title($kodematkul){
		$siak_title = $this->siak_model->siak_query("select", "SELECT nama_matkul from matakuliah where kode_matkul='$kodematkul'");
		
		foreach ($siak_title as $nilai => $row ){
					echo $row['nama_matkul'];
		}
	}
	public function form($prodi){
		$this->siak_view->siak_ruang = $this->siak_model->siak_query("select", "SELECT *from ruang where status='1'");
		$this->siak_view->data_dosen = $this->siak_model->siak_query("select", "SELECT a.*, b.nama from dosen_pembimbing a, pembimbing b where b.kode=a.nip and penguji='TRUE'
			 union
			 SELECT a.*, b.nama from dosen_pembimbing a, penguji b where b.kode=a.nip and penguji='TRUE'");
		$this->siak_view->siak_data=$this->siak_model->siak_query("select", "SELECT a.nim, b.nama_depan, b.nama_belakang,a.judul, c.prodi FROM pendaftaran_judul_tesis a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND a.prodi_id='$prodi' AND a.status=3
			UNION 
			SELECT a.nim, b.nama_depan, b.nama_belakang, a.judul,  c.prodi FROM pendaftaran_judul_tesis a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND a.prodi_id='$prodi' AND a.status=3 ");
		
		$this->siak_view->siak_render('siak_jadwal_proposal/form_insert', true);
	}
	function create($tahun,$tahunid,$prodi){
		if ($tahunid==''){
				$tahun=$_POST['tahun_ak'];
				$tahunid =$_POST['tahun_id'];
				$prodi =$_POST['prodi'];
			}
			
		$this->siak_view->tahun		 = $tahun;
		$this->siak_view->bulan		 = $bulan;
		$this->siak_view->prodi		 = $prodi;
		$this->siak_view->kohort	 = $kohort;
		$this->siak_view->tahunid	 = $tahunid;
		$this->siak_view->siak_ruang = $this->siak_model->siak_query("select", "SELECT *from ruang where status=1");
		$this->siak_view->siak_event = $this->siak_model->siak_query("select", "SELECT *from event");
		
				 if($prodi=='SPS'){
					$this->siak_view->jenis 	= 'SPS';
					$this->siak_view->maxDate	= $tahun+1;
					$jenis = $this->siak_view->jenis;
				}
				else{
					$this->siak_view->jenis 	= 'NONSPS';
					$this->siak_view->maxDate	= $tahun+2;
					$jenis = $this->siak_view->jenis;
				}
				
		
		// $cek_sidang = $this->siak_model->siak_query("select", "SELECT tahun_id, event, mulai, akhir FROM kalender JOIN event ON kalender.event_id=event.id WHERE kalender.tahun_id='$tahunid' AND event='SIDANG TESIS' ORDER BY kalender.mulai ASC LIMIT 1 
		// ");
			$START = $this->siak_model->siak_query("select", "SELECT to_char(kalender.mulai,'YYYY') AS tahun, to_char(kalender.mulai,'MM') AS bulan,to_char(kalender.mulai,'DD') AS hari FROM kalender JOIN event ON kalender.event_id=event.id WHERE kalender.tahun_id='$tahunid' AND event='SIDANG TESIS' AND jenis='$jenis' ORDER BY kalender.mulai ASC LIMIT 1");
			
			$END = $this->siak_model->siak_query("select", "SELECT to_char(kalender.akhir,'YYYY') AS tahun, to_char(kalender.akhir,'MM') AS bulan,to_char(kalender.akhir,'DD') AS hari FROM kalender JOIN event ON kalender.event_id=event.id WHERE kalender.tahun_id='$tahunid' AND event='SIDANG TESIS'  AND jenis='$jenis' ORDER BY kalender.akhir DESC LIMIT 1 ");
			
			foreach ($START as $val1 => $mulai){
				$this->siak_view->tahunawl	= $mulai['tahun'];
				$this->siak_view->bulanawl	= $mulai['bulan'];
				$this->siak_view->hariawl	= $mulai['hari'];
			}
			foreach ($END as $val2 => $akhir){
				$this->siak_view->tahunakhr = $akhir['tahun'];
				$this->siak_view->bulanakhr = $akhir['bulan'];
				$this->siak_view->hariakhr 	= $akhir['hari'];
			}
		
		if($mulai == null){
			echo'<script>alert("Maaf Kegiatan Sidang Tesis Di Tahun '.$tahun.'/'.$jenis.'  belum tersedia. Silahkan di Buat terlebih dahulu");window.location.href="'.URL.'siak_jadwal_proposal/data_list";</script>';
		}
		else{
			 $this->siak_view->data_dosen = $this->siak_model->siak_query("select", "SELECT a.*, b.nama from dosen_pembimbing a, pembimbing b where b.kode=a.nip and penguji='TRUE'
			 union
			 SELECT a.*, b.nama from dosen_pembimbing a, penguji b where b.kode=a.nip and penguji='TRUE'");
			$this->siak_view->siak_data=$this->siak_model->siak_query("select", "SELECT a.nim, b.nama_depan, b.nama_belakang,a.judul, c.prodi FROM pendaftaran_judul_tesis a, data_pribadi_umum b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND a.prodi_id='$prodi' AND a.status=3
			UNION 
			SELECT a.nim, b.nama_depan, b.nama_belakang, a.judul,  c.prodi FROM pendaftaran_judul_tesis a, data_pribadi_pns b, prodi c WHERE a.nim = b.nim AND a.prodi_id = c.prodi_id AND a.prodi_id='$prodi' AND a.status=3 ");
			$this->siak_view->siak_render('siak_jadwal_proposal/create', false);
		}
	}
	 function bulan($b){
		
					if($b==01)
					{$bulan="January";}
					elseif($b==02)
					{$bulan="February";}
					elseif($b==03)
					{$bulan="March";}
					elseif($b==04)
					{$bulan="April";}
					elseif($b==05)
					{$bulan="May";}
					elseif($b==06)
					{$bulan="June";}
					elseif($b==07)
					{$bulan="July";}
					elseif($b==8)
					{$bulan="August";}
					elseif($b==9)
					{$bulan="September";}
					elseif($b==10)
					{$bulan="Oktober";}
					elseif($b==11)
					{$bulan="November";}
					elseif($b==12)
					{$bulan="Desember";}
				return $bulan;
		}
     function search($id,$jenis){
		$siak_data = $this->siak_model->siak_query("select", "SELECT kalender.id,kalender.mulai,kalender.akhir,event.event AS title,  kalender.event_id, to_char(kalender.mulai,'YYYY') AS tahun, 
		to_char(kalender.mulai,'MM') AS bulan, to_char(kalender.mulai,'DD') AS hari 
		FROM kalender left join event on event.id=kalender.event_id where kalender.tahun_id='$id' and kalender.jenis='$jenis' ORDER BY kalender.mulai");
		
		 foreach ($siak_data as $nilai => $row) { 
		echo"
			<option value='".$row['hari'].' '.$this->bulan($row['bulan']).','.$row['tahun']."'>".$row['title']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<strong>".$this->bulan($row['bulan'])."&nbsp;".$row['hari']."&nbsp;".$row['tahun']."</strong>
		</option>";
									 } 
	}
	
	function load_jadwal($tahunid,$jenis,$prodi){
		
		$siak_jadwal = $this->siak_model->siak_query("select", "SELECT * from ( SELECT * from (SELECT a.id, a.nim, d.nama_depan,d.nama_belakang, c.judul,  a.mulai as START, a.akhir as END, e.prodi, null as warna, false as allDay FROM jadwal_sidang a, pendaftaran_judul_tesis c, data_pribadi_umum d, prodi e WHERE a.nim = d.nim  AND a.judultesis_id=c.judultesis_id AND c.prodi_id = e.prodi_id AND c.prodi_id='$prodi' UNION SELECT a.id, a.nim, d.nama_depan,d.nama_belakang, c.judul,  a.mulai as START, a.akhir as END, e.prodi, null as warna,false as allDay FROM jadwal_sidang a, pendaftaran_judul_tesis c, data_pribadi_pns d, prodi e WHERE a.nim = d.nim  AND a.judultesis_id = c.judultesis_id AND c.prodi_id = e.prodi_id AND c.prodi_id='$prodi') as jadwal UNION SELECT kalender.id AS id, null as nim, null as nama_depan, event.event as nama_belakang, null as judul,  kalender.mulai AS START,  kalender.akhir AS END,null as prodi, event.warna,  true as allDay FROM kalender LEFT JOIN event ON event.id=kalender.event_id WHERE kalender.tahun_id='$tahunid' AND kalender.jenis='$jenis' )as result order by start");
		
		
		$data_jadwal = array();
		
				$hasil_jadwal = array();
		
		foreach ($siak_jadwal as $nilai => $row ){
			
			$data_jadwal['id']=$row['id'];
			$data_jadwal['nim']=$row['nim'];
			$data_jadwal['title']=$row['nama_depan'].' '.$row['nama_belakang'].' - '. $row['judul'];
			$data_jadwal['start']=$row['start'];
			$data_jadwal['end']=$row['end'];
			$data_jadwal['prodi']=$row['prodi'];
			$data_jadwal['warna']='#'.$row['warna'];
			$data_jadwal['allDay']=$row['allday'];
			
			
			
			array_push($hasil_jadwal,$data_jadwal);
		}
		
		$json = json_encode($hasil_jadwal);
		print $json;
	}
	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		//header('location: ' . URL . 'siak_persiapan_kuliah/siak_dosen_matakuliah');
	}
	
	public function detailnya($nim,$prodi,$id){
		$this->siak_view->prodi = $prodi;
		
		$pembimbing = $this->siak_model->siak_query("select","select * from pendaftaran_judul_tesis where nim='".$nim."'");
		foreach($pembimbing as $pem => $bimbing){
			$pembimbing1 = $bimbing['dosen_pembimbing1'];
			$pembimbing2 = $bimbing['dosen_pembimbing2'];
		}
		$this->siak_view->cek_pem1 = $this->siak_model->siak_query("select","select * from pembimbing where kode='".$pembimbing1."'");
		$this->siak_view->cek_pem2 = $this->siak_model->siak_query("select","select * from pembimbing where kode='".$pembimbing2."'");
		
		$penguji = $this->siak_model->siak_query("select","select * from jadwal_sidang where nim='".$nim."' and id='".$id."'");
		foreach($penguji as $pengu => $ji){
			$pengujinya = $ji['penguji_id'];
		}
		$x = explode(",",$pengujinya);
		$this->siak_view->penguji1 = $this->siak_model->siak_query("select","select * from penguji where kode='".$x[0]."'");
		$this->siak_view->penguji2 = $this->siak_model->siak_query("select","select * from penguji where kode='".$x[1]."'");
		$this->siak_view->penguji3 = $this->siak_model->siak_query("select","select * from penguji where kode='".$x[2]."'");
		
		$this->siak_view->siak_render('siak_jadwal_proposal/detailnya', true);
	}
	
}

?>