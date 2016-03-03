<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak master controller class */

class Siak_penilaian extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function index(){
		$this->siak_view->config = "Siak Widyatama - Nilai Mahasiswa";
	
		$this->siak_view->judul = "Nilai Mahasiswa";
			
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Penilaian','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Nilai Mahasiswa','href'=>''. URL . 'siak_penilaian'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
			
		$this->siak_penilaian();
	}

	function getNilai($id){
		$siak_data = $this->siak_model->siak_query("select", "SELECT * FROM nilai_mahasiswa where nim='$id'");
		$data_nilai = array();
		$result = array();

		foreach ($siak_data as $nilai => $row ){
			$data_nilai['nim']=$row['nim'];
			$data_nilai['presentasi']=$row['presentasi'];
			$data_nilai['tugas_mandiri']=$row['tugas_mandiri'];
			$data_nilai['UTS']=$row['UTS'];
			$data_nilai['UAS']=$row['UAS'];
			array_push($result,$data_nilai);
		}
		print json_encode($result);
	}

	function siak_penilaian(){
		
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "penilaian" && $value['kode'] == "nilai_mahasiswa") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
			}
		}
		$this->siak_view->siak_render('siak_penilaian/index', false);
	}

	function menu_tab(){
		
		$this->siak_view->siak_render('siak_penilaian/menu_tab', false);
	}
	function matkul($prodi,$semes){
		$this->siak_view->data_matkul = $this->siak_model->siak_query("select", "SELECT *from matakuliah where prodi_id='$prodi' and semester='$semes'");
		$this->siak_view->siak_render('siak_penilaian/matkul', true);
	}
//SPS/2009/1/M-MP1201
	function tabpenilaian($prodi,$tahunid,$semes,$matkul){
		$this->siak_view->prodi    = $prodi;
		$this->siak_view->tahun    = $tahunid;
		$this->siak_view->semester = $semes;
		$this->siak_view->matkul   = $matkul;
		$this->siak_view->siak_render('siak_penilaian/tabpenilaian', true);
	}
	function getbobot($prodi,$tahunid,$semes,$matkul){
		$this->siak_view->prodi    = $prodi;
		$this->siak_view->tahun    = $tahunid;
		$this->siak_view->semester = $semes;
		$this->siak_view->matkul   = $matkul;
		$dt = new DateTime(); 
		$dt->format('Y-m-d');
		$now=$dt->format('Y-m-d');
		
		$query = "select b.*, case when '$now' between b.mulai and b.akhir then TRUE else FALSE end as status from batasan_waktu_nilai b where prodi_id='$prodi' AND tahun_id='$tahunid' AND matkul_id='$matkul' AND semester='$semes'";
// 		echo $query;
// 		die();
		$this->siak_view->batasan = $this->siak_model->siak_query("select", $query);
			foreach($this->siak_view->batasan as $val => $value){
				$mulai=$value['mulai'];
				$akhir=$value['akhir'];
				$this->siak_view->status='t';
			}
			$date1=date_create($now);
			$date2=date_create($akhir);
			$diff=date_diff($date1,$date2);
			$this->siak_view->jarak=$diff->format("%R%a HARI");
		// if (sizeof($batasan) > 0 && $status=='t'){
					// $this->siak_view->data_nilai = $this->siak_model->siak_query("select", "SELECT * FROM nilai_mahasiswa WHERE prodi_id='$prodi' AND semester='$semes' AND matkul_id='$matkul';");
					// $this->siak_view->data_nilai_mhs = $this->siak_model->siak_query("select", "SELECT nim FROM nilai_mahasiswa WHERE prodi_id='$prodi' AND semester='$semes' AND matkul_id='$matkul';");
					$this->siak_view->bobot = $this->siak_model->siak_query("select", "SELECT *, komponen.id as id_komponen,(select a.published from komponen_nilai a where a.id_komponen=komponen.id limit 1 ) as published FROM komponen LEFT JOIN bobot ON bobot.id=komponen.id_bobot where prodi_id='$prodi' AND tahun_id='$tahunid' AND matkul_id='$matkul' AND semester='$semes'");
					// $kode=array();
					// foreach($this->siak_view->bobot as $key=>$row){
						// array_push($kode,$row['id_komponen']);
					// }
					// $idkomponen=implode(',',$kode);
					// $this->siak_view->idAll=$idkomponen;
					// $this->siak_view->data_komponen_nilai= $this->siak_model->siak_query("select", "SELECT * FROM komponen_nilai where id_komponen IN (".$idkomponen.") ");
					// $tot= $this->siak_model->siak_query("select", "SELECT SUM(hasil_bobot) as rata_rata FROM komponen_nilai where id_komponen IN (216,218) and nim='120140103001'");
// 					$this->siak_view->range_nilai=$this->siak_model->siak_data_list('aturan_nilai','nama,bobot,nilaimin,nilaimax');
					$this->siak_view->range_nilai=$this->siak_model->siak_query('select','select nama,bobot,nilaimin,nilaimax from aturan_nilai where jenis_nilai = 1');
					$this->siak_view->range_nilai2=$this->siak_model->siak_query('select','select nama,bobot,nilaimin,nilaimax from aturan_nilai where jenis_nilai = 2');
			
		// }
					$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='$prodi' AND tahun_masuk='$tahunid' ");
			
		$this->siak_view->siak_render('siak_penilaian/bobot_coba', true);
	}
	public function list_nilai($prodi,$tahunid,$semes,$matkul){
		$this->siak_view->prodi    = $prodi;
		$this->siak_view->tahun    = $tahunid;
		$this->siak_view->semester = $semes;
		$this->siak_view->matkul   = $matkul;
		
		$this->siak_view->data_nilai = $this->siak_model->siak_query("select", "SELECT * FROM nilai_mahasiswa WHERE prodi_id='$prodi' AND semester='$semes' AND matkul_id='$matkul';");
		$this->siak_view->nilai_asli=sizeof($this->siak_view->data_nilai);
		//var_dump($this->siak_view->nilai_asli);die();
		$this->siak_view->data_nilai_mhs = $this->siak_model->siak_query("select", "SELECT nim FROM nilai_mahasiswa WHERE prodi_id='$prodi' AND semester='$semes' AND matkul_id='$matkul';");
		$this->siak_view->bobot = $this->siak_model->siak_query("select", "SELECT *, komponen.id as id_komponen,(select a.published from komponen_nilai a where a.id_komponen=komponen.id limit 1 ) as published FROM komponen LEFT JOIN bobot ON bobot.id=komponen.id_bobot where prodi_id='$prodi' AND tahun_id='$tahunid' AND matkul_id='$matkul' AND semester='$semes'");
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='$prodi' AND tahun_masuk='$tahunid' ");
		$kode=array();
		
		foreach($this->siak_view->bobot as $key=>$row){
					$this->siak_view->idbobot=$row['id_bobot'];
					array_push($kode,$row['id_komponen']);
				}
		$idkomponen=implode(',',$kode);
		$this->siak_view->idAll=$idkomponen;
		$this->siak_view->data_komponen_nilai= $this->siak_model->siak_query("select", "SELECT * FROM komponen_nilai where id_komponen IN (".$idkomponen.") ");
// 		$this->siak_view->range_nilai=$this->siak_model->siak_data_list('aturan_nilai','nama,bobot,nilaimin,nilaimax');
		$this->siak_view->range_nilai=$this->siak_model->siak_query('select','select nama,bobot,nilaimin,nilaimax from aturan_nilai where jenis_nilai = 1');
		$this->siak_view->range_nilai2=$this->siak_model->siak_query('select','select nama,bobot,nilaimin,nilaimax from aturan_nilai where jenis_nilai = 2');
		// echo "SELECT * FROM komponen_nilai where id_komponen IN (".$idkomponen.") ";
		// echo "<pre>";var_dump($this->siak_view->data_komponen_nilai);echo "</pre>";
		//die();
		$this->siak_view->siak_render('siak_penilaian/list_nilai', true);
	}
	
	function form_isian($prodi,$tahunid,$semes,$matkul,$idkomponen,$urut){
		$this->siak_view->prodi    = $prodi;
		$this->siak_view->tahun    = $tahunid;
		$this->siak_view->semester = $semes;
		$this->siak_view->matkul   = $matkul;
		$this->siak_view->idkomp    = $idkomponen;
		$this->siak_view->urutBobot    = $urut;
		$this->siak_view->bobot = $this->siak_model->siak_query("select", "SELECT *, komponen.id as id_komponen FROM komponen LEFT JOIN bobot ON bobot.id=komponen.id_bobot where prodi_id='$prodi' AND tahun_id='$tahunid' AND matkul_id='$matkul' AND semester='$semes'");
		$this->siak_view->data_sub = $this->siak_model->siak_query("select", "SELECT * FROM sub_komponen WHERE id_komponen=".$idkomponen."");
		$this->siak_view->data_komponen_nilai= $this->siak_model->siak_query("select", "SELECT * FROM komponen_nilai where id_komponen='$idkomponen' order by nim");
		$this->siak_view->data_sub_nilai = $this->siak_model->siak_query("select", "select *from sub_nilai_mahasiswa where komponen='$idkomponen' order by nim");
		//echo $idkomponen;
		//echo "select *from sub_nilai_mahasiswa where komponen='$idkomponen'";
		// echo '<pre>';var_dump($this->siak_view->data_sub_nilai);echo '</pre><br>';echo '<pre>';var_dump($this->siak_view->data_nilai_sub);echo '</pre><br>';die();
		$this->siak_view->colspan=sizeof($this->siak_view->data_sub);
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", "SELECT * FROM view_mahasiswa WHERE prodi_id='$prodi' AND tahun_masuk='$tahunid' ");
		$this->siak_view->siak_render('siak_penilaian/form_isian', true);
	}
	function range_nilai(){
		$this->siak_view->range_nilai=$this->siak_model->siak_data_list('aturan_nilai','nama,bobot,nilaimin,nilaimax');
		$this->siak_view->siak_render('siak_penilaian/range_coba', true);
	}
	
	
	function perbaikan_nilai($prodi,$tahunid,$semes,$matkul,$idkomponen,$urut){
		$this->siak_view->prodi    = $prodi;
		$this->siak_view->tahun    = $tahunid;
		$this->siak_view->semester = $semes;
		$this->siak_view->matkul   = $matkul;
		$this->siak_view->idkomp    = $idkomponen;
		$this->siak_view->urutBobot    = $urut;
		
		$this->siak_view->bobot = $this->siak_model->siak_query("select", "SELECT *, komponen.id as id_komponen FROM komponen LEFT JOIN bobot ON bobot.id=komponen.id_bobot where prodi_id='$prodi' AND tahun_id='$tahunid' AND matkul_id='$matkul' AND semester='$semes'");
		
		$this->siak_view->data_sub = $this->siak_model->siak_query("select", "SELECT * FROM sub_komponen WHERE id_komponen=".$idkomponen."");
		$this->siak_view->data_komponen_nilai= $this->siak_model->siak_query("select", "SELECT * FROM komponen_nilai where id_komponen='$idkomponen' ");
		$this->siak_view->data_perbaikan_nilai= $this->siak_model->siak_query("select", "SELECT * FROM perbaikan_nilai where id_komponen='$idkomponen' ");
		$this->siak_view->data_sub_nilai = $this->siak_model->siak_query("select", "select *from sub_nilai_mahasiswa where komponen='$idkomponen'");
		
		$this->siak_view->colspan=sizeof($this->siak_view->data_sub);
		
		$mhs = "
			SELECT * FROM
				(SELECT 
					dps.nama_depan, 
					dps.nama_belakang,
					dps.nim,
					nil.grade,
					nil.prodi_id,
					nil.semester,
					mhs.tahun_masuk as cohort
				FROM 
					data_pribadi_pns as dps,
					nilai_mahasiswa as nil,
					mahasiswa as mhs
				WHERE 
					dps.nim = nil.nim and 
					mhs.nim = nil.nim and
					nil.semester = '$semes'
				UNION SELECT
					dpu.nama_depan,
					dpu.nama_belakang,
					dpu.nim,
					nil.grade,
					nil.prodi_id,
					nil.semester,
					mhs.tahun_masuk as cohort
				FROM
					data_pribadi_umum as dpu,
					nilai_mahasiswa as nil,
					mahasiswa as mhs
				WHERE
					dpu.nim = nil.nim and
					mhs.nim = nil.nim and
					nil.semester = '$semes'
				) as a
			WHERE a.nim is not null AND a.prodi_id = '$prodi' AND a.grade NOT in ('A','A+','A-','B','B-','B+','C','C+') AND a.cohort = $tahunid
			ORDER BY a.nim
		";
		
		$this->siak_view->data_mahasiswa = $this->siak_model->siak_query("select", $mhs);
// 		$this->siak_view->data_mahasiswa = $mhs;
		$this->siak_view->siak_render('siak_penilaian/form_perbaikan', true);
	}
	
	function insert_coba(){
		$nim=$_POST['nim'];
		$jumlah_mhs=count($_POST['nim']);
		$jumlah_subkom=$_POST['colspan'];
		$urut=0;
			for($i=1;$i<=$jumlah_mhs;$i++){
				$hsl=$_POST['hasil'.$i];
				$nilai1=$_POST['nilai'][$urut];
				$hasil=$hsl==''?0:$hsl;
				$nilai=$nilai1==''?0:$nilai1;
					$query = "insert into komponen_nilai(nilai, id_komponen, hasil_bobot, nim, published) values(".$nilai.",".$_POST['id_komponen'].",".$hasil.",'".$_POST['nim'][$urut]."',2);";
					
					$this->siak_model->siak_query("insert", $query);
					//echo "1. ".$query."<br>";
					for($x=0;$x<$jumlah_subkom;$x++){
						$sub=$_POST['sub_nilai'.$_POST['nim'][$urut].$i][$x];
						$subnilai=$sub==''?0:$sub;
						$hasilsub=$_POST['sub_hasil'.$i][$x];
						$subhasil=$hasilsub==''?0:$hasilsub;
							$query2 = "insert into sub_nilai_mahasiswa(komponen, sub_komponen, sub_nilai, sub_hasil, nim) values(".$_POST['id_komponen'].",".$_POST['sub_komponen'][$x].",".$subnilai.",".$subhasil.",'".$_POST['nim'][$urut]."');";
						$this->siak_model->siak_query("insert", $query2);
					//echo "2. ".$query2."<br>";
					}
				$urut++;
			}
			//die();
	}
	function update_coba(){
		$nim=$_POST['nim'];
		$jumlah_mhs=count($_POST['nim']);
		$jumlah_subkom=$_POST['colspan'];
		$urut=0;
			for($i=1;$i<=$jumlah_mhs;$i++){
				$hsl=$_POST['hasil'.$i];
				$nilai1=$_POST['nilai'][$urut];
				$hasil=$hsl==''?0:$hsl;
				$nilai=$nilai1==''?0:$nilai1;
					$query = "update komponen_nilai set nilai=".$nilai.", id_komponen=".$_POST['id_komponen'].", hasil_bobot=".$hasil.", nim='".$_POST['nim'][$urut]."' where id=".$_POST['kompid'][$urut].";";
					
					$this->siak_model->siak_query("update", $query);
					//echo "1. ".$query."<br>";
					for($x=0;$x<$jumlah_subkom;$x++){
						$sub=$_POST['sub_nilai'.$_POST['nim'][$urut].$i][$x];
						$subnilai=$sub==''?0:$sub;
						$hasilsub=$_POST['sub_hasil'.$i][$x];
						$subhasil=$hasilsub==''?0:$hasilsub;
							$query2 = "update sub_nilai_mahasiswa set komponen=".$_POST['id_komponen'].", sub_komponen=".$_POST['sub_komponen'][$x].", sub_nilai=".$subnilai.", sub_hasil=".$subhasil.", nim='".$_POST['nim'][$urut]."' where id=".$_POST['id'.$_POST['nim'][$urut].$i][$x].";";
						$this->siak_model->siak_query("update", $query2);
					//echo "2. ".$query2."<br>";
					}
				$urut++;
			}
			//die();
	}
	
	function update_per(){
		$nim=$_POST['nim'];
		$jumlah_mhs=count($_POST['nim']);
		$jumlah_subkom=$_POST['colspan'];
		$urut=0;
			for($i=1;$i<=$jumlah_mhs;$i++){
				$hsl=$_POST['hasil'.$i];
				$nilai1=$_POST['nilai'][$urut];
				$hasil=$hsl==''?0:$hsl;
				$nilai=$nilai1==''?0:$nilai1;
					$query = "update komponen_nilai set status_perbaikan = 'TRUE', nilai=".$nilai.", id_komponen=".$_POST['id_komponen'].", hasil_bobot=".$hasil.", nim='".$_POST['nim'][$urut]."' where id=".$_POST['kompid'][$urut].";";
					$this->siak_model->siak_query("update", $query);
// 					echo "1. ".$query."<br>";
					
					for($x=0;$x<$jumlah_subkom;$x++){
						$sub=$_POST['sub_nilai'.$_POST['nim'][$urut].$i][$x];
						$old=$_POST['nilai_old'.$_POST['nim'][$urut].$i][$x];
						
						$subnilai=$sub==''?0:$sub;
						$hasilsub=$_POST['sub_hasil'.$i][$x];
						$subhasil=$hasilsub==''?0:$hasilsub;
						
						$query2 = "update sub_nilai_mahasiswa set komponen=".$_POST['id_komponen'].", sub_komponen=".$_POST['sub_komponen'][$x].", sub_nilai=".$subnilai.", sub_hasil=".$subhasil.", nim='".$_POST['nim'][$urut]."' where id=".$_POST['id'.$_POST['nim'][$urut].$i][$x].";";
						$insert_per = "
							insert into 
							perbaikan_nilai(nilai, hasil_bobot, id_komponen, nim, id_komponen_nilai) 
							values(".$old.", ".$hasil.", ".$_POST['id_komponen'].", '".$_POST['nim'][$urut]."', ".$_POST['kompid'][$urut].")
							";
							
						$this->siak_model->siak_query("update", $query2);
						
						if($_POST['qu'] == "insertP"){
							$this->siak_model->siak_query("insert", $insert_per);
// 							echo $insert."<br>";
						}
						
// 						echo "2. ".$query2."<br>";
					}
				$urut++;
			}		
		
	}
	
	function upPer(){
		$range = $this->siak_model->siak_query('select','select nama,bobot,nilaimin,nilaimax from aturan_nilai where jenis_nilai = 2');
		
		foreach($_POST['nim'] as $key => $row){
			
			$updateNilai = "update nilai_mahasiswa set status_perbaikan='t', nilai_total = '".$_POST['perb'][$key]."' where nim='".$_POST['nim'][$key]."' and matkul_id='".$_POST['matkul']."' and semester = '".$_POST['semester']."'";
			echo $updateNilai."<br>"; //Update Nilai Perbaikan Mahasiswa
// 			$this->siak_model->siak_query("update", $updateNilai);
			
			$insert_per = "insert into perbaikan_nilai(nilai, hasil_bobot, id_komponen, nim, id_komponen_nilai) values(".$_POST['old'][$key].", ".$hasil.", ".$_POST['id_komponen'].", '".$_POST['nim'][$key]."', ".$_POST['kompid'][$key].")";
// 			echo $insert_per."<br>"; //Masukkan Nilai Lama(sebelum perbaikan)
			if($_POST['qu'] == "insertP"){
// 				$this->siak_model->siak_query("insert", $insert_per);
				echo $insert_per."<br>";
			}
		}
		
	}

	function form_nilai($prodi,$semester,$nim,$matkul,$tahun){
		
		$this->siak_view->prodi    = $prodi;
		$this->siak_view->nim 	   = $nim;
		$this->siak_view->tahun    = $tahun;
		$this->siak_view->semester = $semester;
		$this->siak_view->matkul   = $matkul;
		$this->siak_view->nilai_absen = 0;
		
		$this->siak_view->data = $this->siak_model->siak_query("select", "SELECT *, komponen.id as id_komponen FROM komponen LEFT JOIN bobot ON bobot.id=komponen.id_bobot where prodi_id='$prodi' AND tahun_id='$tahun' AND matkul_id='$matkul' AND semester='$semester'");
		$query = "";
		foreach ($this->siak_view->data as $key => $value) {
			$query .= "SELECT * FROM sub_komponen WHERE id_komponen=".$value['id_komponen']." UNION ";
		}
		
		$query  =  substr($query, 0, sizeof($query) -7);
		$this->siak_view->data_sub = $this->siak_model->siak_query("select", $query);

		$this->siak_view->data_nilai = $this->siak_model->siak_query("select", "SELECT * FROM nilai_mahasiswa WHERE nim='$nim' AND prodi_id='$prodi' AND semester='$semester' AND matkul_id='$matkul';");
		$query2 = "";
		foreach ($this->siak_view->data_nilai as $key => $value) {
			$query2 .= "SELECT * from sub_nilai_mahasiswa WHERE id_nilai=".$value['id']." UNION";
		}
		$query2  =  substr($query2, 0, sizeof($query2) -7);
		$query2 .= ";";
		$this->siak_view->data_nilai_sub = $this->siak_model->siak_query("select", $query2);
		$nilaiabs = $this->siak_model->siak_getfield("nilai", "nilai_absen", "nim = '".$nim."' and prodi = '".$prodi."' and tahun = '".$tahun."' and semester = ".$semester." and kode_matkul = '".$matkul."'");
		if(!empty($nilaiabs)){
			$this->siak_view->nilai_absen = $nilaiabs;
		}
		$this->siak_view->siak_render('siak_penilaian/form_nilai', true);
	}

	function insert_nilai(){
		$sub_komponen=$_POST['sub_komponen'];
		$sub_nilai= $_POST['sub_nilai'];
		$total_sub = count($_POST['sub_komponen']);
		$aturan= $this->siak_model->siak_data_list("aturan_nilai","*");
		foreach ($aturan as $key => $value) {
			if ($value['nilaimin'] <= (int)$_POST['total_nilai'] && $value['nilaimax'] >= (int)$_POST['total_nilai']) {
				$grade = $value['nama'];
				$bobot = $value['bobot'];
			}
		}
		$_POST['komponen'] = implode(',', $_POST['komponen']);
		$_POST['nilai'] = implode(',', $_POST['nilai']);
		
		$data['grade']=$grade;
		$data['total']=$_POST['total_nilai'];
		echo json_encode($data);
		$this->siak_model->siak_query("insert", "INSERT INTO nilai_mahasiswa(prodi_id,semester,nim,matkul_id,komponen,nilai,nilai_total,grade,bobot) VALUES('".$_POST['prodi']."','".$_POST['semester']."','".$_POST['nim']."','".$_POST['matkul']."','".$_POST['komponen']."','".$_POST['nilai']."','".$_POST['total_nilai']."','".$grade."',".$bobot.");");
		$id=$this->siak_model->siak_query("select","SELECT id FROM nilai_mahasiswa ORDER BY id DESC LIMIT 1");
		foreach ($id as $key => $ida ){
			$id_nilai=$ida['id'];
		}
		$i=-1;
		foreach ($sub_komponen as $key => $value) {
			$i++;
			$subkom = explode('-', $value);
			$query = "insert into sub_nilai_mahasiswa(id_nilai, komponen, sub_komponen, sub_nilai) values(".$id_nilai.",";
			foreach ($subkom as $vale) {
				$query .= $vale.",";
			}
			$query .= $sub_nilai[$i];
			$query .= ");";
			$this->siak_model->siak_query("insert", $query);
		}
		// echo "<br>";
		// die();

		//header('location: ' . URL . 'siak_penilaian/');
	}

	function update_nilai(){
		//die();
		$id_subnilai = $_POST['id_subnilai'];
		$id_nilai=$_POST['id_nilai'];
		$sub_komponen=$_POST['sub_komponen'];
		$sub_nilai= $_POST['sub_nilai'];
		$total_sub = count($_POST['sub_komponen']);
		$aturan= $this->siak_model->siak_data_list("aturan_nilai","*");
		foreach ($aturan as $key => $value) {
			if ($value['nilaimin'] <= (int)$_POST['total_nilai'] && $value['nilaimax'] >= (int)$_POST['total_nilai']) {
				$grade = $value['nama'];
				$bobot = $value['bobot'];
			}
		}
		$_POST['komponen'] = implode(',', $_POST['komponen']);
		$_POST['nilai'] = implode(',', $_POST['nilai']);
		$this->siak_model->siak_query("update", "UPDATE nilai_mahasiswa set nilai = '".$_POST['nilai']."',nilai_total = '".$_POST['total_nilai']."',grade = '".$grade."',bobot = ".$bobot." WHERE id = ".$id_nilai.";");
		$data['total']=$_POST['total_nilai'];
		$data['grade']=$grade;
		echo json_encode($data);
		
		$i=-1;
		foreach ($sub_komponen as $key => $value) {
			$i++;
			$subkom = explode('-', $value);
			$query = "update sub_nilai_mahasiswa set id_nilai = ".$id_nilai.", ";
			foreach ($subkom as $key => $vale) {
				if ($key == 0) {
					$query .= "komponen = ".$vale.", ";
				}else{
					$query .= "sub_komponen = ".$vale.", ";
				}
			}
			$query .= "sub_nilai = ".$sub_nilai[$i];
			$query .= " WHERE id = ";
			$query .= $id_subnilai[$i].";";
			
			$this->siak_model->siak_query("update", $query);
		}
			
	}
	
	public function publish($id){
		

// 		$this->siak_model->siak_query("update", "update komponen_nilai set published=".$_POST['publis']." where id_komponen=".$id."");
		$prodi = $_POST['prodi'];
		$publish = $_POST['publis'];
// 		echo $prodi." - ".$publish;
		
		$url = "siak_dashboard";
		$this->siak_model->notifPublish($prodi, $publish, $url);
		die();
	}
	public function generateNilai(){
		$nim=$_POST['nim'];
		$matkul=$_POST['matkul'];
		$tahun=$_POST['tahun'];
		$semester=$_POST['semester'];
		$prodi=$_POST['prodi'];
		$bobot=$_POST['bobot'];
		$total=$_POST['total'];
		$grade=$_POST['grade'];
		$jumlah_mhs=count($nim);
		
		for($i=0;$i<$jumlah_mhs;$i++){
		$komponen=implode(',',$_POST['id_komponen'.$nim[$i]]);
		$nilai=implode(',',$_POST['nilai'.$nim[$i]]);
		
			$query = "insert into nilai_mahasiswa(nim, prodi_id, semester, matkul_id, komponen, nilai, nilai_total, grade, bobot) values('".$nim[$i]."','".$prodi."','".$semester."','".$matkul."','".$komponen."','".$nilai."','".$total[$i]."','".$grade[$i]."','".$bobot[$i]."');";
			echo $query."<br>";
			$this->siak_model->siak_query("insert", $query);
		}
		
		
	}

}

?>