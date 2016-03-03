<?php
if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');
class Alumni extends Siak_controller{
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}
	
	///alumni -> lulust tabel ranskrip
	
	//Set Alumni
	function index(){
		//BreadCrumbs
		$this->siak_view->config = "Siak Unhan - Setup Alumni";
	
		$this->siak_view->judul = "Setup Alumni";
		
		$this->siak_breadcrumbs->add(array('title'=>'Alumni','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Setup Alumni','href'=>''. URL . 'alumni'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		//
		
		//Hak Akses
		$method_or_uri = 'alumni';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$sqlAlumni = "
		SELECT DISTINCT
		    view_mahasiswa.nim,
		    view_mahasiswa.prodi_id,
		    view_mahasiswa.nama_depan,
		    view_mahasiswa.nama_belakang,
		    view_mahasiswa.tahun_masuk,
		    view_mahasiswa.jenis,
		--    nilai_mahasiswa.nilai_total,
		--    nilai_mahasiswa.grade,
		    yudisium.ipk
		  FROM 
		    view_mahasiswa,
		--    nilai_mahasiswa,
		    syarat_wisuda,
		    yudisium
		  WHERE
		--    view_mahasiswa.nim = nilai_mahasiswa.nim AND
		--    syarat_wisuda.nim = nilai_mahasiswa.nim AND
		    syarat_wisuda.nim = view_mahasiswa.nim AND
		--    view_mahasiswa.semester = nilai_mahasiswa.semester AND
		    yudisium.nim = syarat_wisuda.nim AND
		--    nilai_mahasiswa.hasil = 'TRUE' AND
		    syarat_wisuda.cek = 'TRUE'
		";
		$this->siak_view->alumni = $this->siak_model->siak_query("select", $sqlAlumni);
		
		$this->siak_view->siak_render("alumni/index", false);
	}
	
	function get_cohort($kode){
		$sql = "select * from cohort where prodi_id = '$kode'";
		$data = $this->siak_model->siak_query("select", $sql);
		$html = '<select class="m-wrap span6" id="tahunid" name="tahun" link="'.URL.'alumni/getMhs" onchange="getMhs(this)">
			  <option value="">-- PILIH --</option>';
			  foreach($data as $row => $key){
		$html .= '<option value="'.$key['cohort'].'" >'.$key['tahun_masuk'].' / '.$key['cohort'].'</option>';
			  }
		$html .= '</select>';
		
		echo $html;
	}
	
	function getMhs(){
		$prodi = $_POST['prodi']?"AND view_mahasiswa.prodi_id = '".$_POST['prodi']."'":"";
		$cohort = $_POST['cohort']?" AND view_mahasiswa.cohort = '".$_POST['cohort']."'":"";
		
		$sqlAlumni = "
		SELECT DISTINCT
		    view_mahasiswa.nim,
		    view_mahasiswa.prodi_id,
		    view_mahasiswa.nama_depan,
		    view_mahasiswa.nama_belakang,
		    view_mahasiswa.tahun_masuk,
		    view_mahasiswa.jenis,
		    yudisium.ipk
		  FROM 
		    view_mahasiswa,
		    syarat_wisuda,
		    yudisium
		  WHERE
		    syarat_wisuda.nim = view_mahasiswa.nim AND
		    yudisium.nim = syarat_wisuda.nim --AND
		$prodi
		$cohort
		AND syarat_wisuda.cek = 'TRUE'
		";
		$this->siak_view->alumni = $this->siak_model->siak_query("select", $sqlAlumni);
// 		$this->siak_view->alumni = $sqlAlumni;
		
		$this->siak_view->siak_render("alumni/getMhs", true);
		
	}
	
	function create(){
  
		$count = $_POST['count'];
		$nim = $_POST['nim'];
		$jenis = $_POST['jenis'];
		$prodi = $_POST['prodi_id'];
		$cohort = $_POST['tahun'];
		$thn_masuk = $_POST['tahun_masuk'];
		$ipk = $_POST['ipk'];
		$thn_lulus = date("Y");
		
		
		foreach($count as $row => $key){
		
			$sql_insert = "insert into alumni(jenis,nim,prodi_id,cohort,tahun_masuk,ipk,tahun_lulus) values('$jenis[$row]', '$nim[$row]', '$prodi[$row]', '$cohort', '$thn_masuk[$row]', '$ipk[$row]', '$thn_lulus')";
			$sql_del_user = "delete from users where username = '$nim[$row]' and prodi_id = '$prodi[$row]'";
			$sql_del_mhs = "delete from mahasiswa where nim = '$nim[$row]' and prodi_id = '$prodi[$row]'";
// 			echo $sql_insert."<br>";
// 			echo $sql_del_user."<br>";
// 			echo $sql_del_mhs."<br><br>";
			
		        $this->siak_model->siak_query("insert", $sql_insert);
		        $this->siak_model->siak_query("delete", $sql_del_user);
		        $this->siak_model->siak_query("delete", $sql_del_mhs);
		  
		}
// 	  die();
	  header('location:'. URL.'alumni');
	}
	//END Set Alumni
	
	//Data Mahasiswa Alumni
	function data_alumni(){
		//BreadCrumbs
		$this->siak_view->config = "Siak Unhan - Data Alumni";
	
		$this->siak_view->judul = "Data Alumni";
		
		$this->siak_breadcrumbs->add(array('title'=>'Alumni','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Alumni','href'=>''. URL . 'alumni/data_alumni'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		//
		
		//Hak Akses
		$method_or_uri = 'alumni/data_alumni';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$sql = "
			SELECT 
				a.nim,
				a.ipk,
				b.nama_depan,
				b.nama_belakang 
			FROM 
				alumni a, 
				data_pribadi_umum b 
			WHERE 
				a.nim=b.nim";
		$this->siak_view->hasil =$this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render("alumni/data_alumni", false);
	}
	
	function get_cohort2($kode){
		$sql = "select * from cohort where prodi_id = '$kode'";
		$data = $this->siak_model->siak_query("select", $sql);
		$html = '<select class="m-wrap span6" id="tahunid" name="tahun" link="'.URL.'alumni/getAlumni" onchange="getAlumni(this)">
			  <option value="">-- PILIH --</option>';
			  foreach($data as $row => $key){
		$html .= '<option value="'.$key['cohort'].'" >'.$key['tahun_masuk'].' / '.$key['cohort'].'</option>';
			  }
		$html .= '</select>';
		
		echo $html;
	}
	
	function getAlumni(){
		$prodi = $_POST['prodi']?" a.prodi_id = '".$_POST['prodi']."' AND":"";
		$cohort = $_POST['cohort']?" a.cohort = '".$_POST['cohort']."' AND":"";
		
// 		echo $prodi."+".$cohort;
// 		die();
		
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$sql = "
		SELECT *
		FROM
			(SELECT 
				a.nim,
				a.ipk,
				a.prodi_id,
				a.cohort,
				b.nama_depan,
				b.nama_belakang 
			FROM 
				alumni a, 
				data_pribadi_umum b 
			WHERE 
				$prodi
				$cohort
				a.nim=b.nim
			UNION SELECT
				a.nim,
				a.ipk,
				a.prodi_id,
				a.cohort,
				b.nama_depan,
				b.nama_belakang 
			FROM 
				alumni a, 
				data_pribadi_pns b 
			WHERE 
				$prodi
				$cohort
				a.nim=b.nim
			)
		AS query ORDER BY nim ASC
			";
		$this->siak_view->hasil =$this->siak_model->siak_query("select", $sql);
// 		$this->siak_view->hasil = $sql;
		$this->siak_view->siak_render("alumni/getAlumni", true);
	}
}