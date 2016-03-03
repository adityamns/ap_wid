<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak Dosen Mata Kuliah controller class */

class Siak_input_ijazah extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		$this->role = array('owner');
		parent::siak_logstat();
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
		$this->prodi = $_SESSION['prodi'];
	}

	function index(){
		$this->siak_view->config = "Siak Unhan - Input No Ijazah";
	
		$this->siak_view->judul = "Input No Ijazah";
			
		$this->siak_breadcrumbs->add(array('title'=>'Ijazah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Input No Ijazah','href'=>'#'));
		
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("ijazah", "*");
		
		$this->siak_view->siak_render('siak_input_ijazah/data', false);
	}
//
////////////////////////////////////// HARI :D

	public function siak_add(){
		$this->siak_view->prodi = $this->prodi;
	
		$this->siak_view->dosen_utama = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama FROM dosen a ');
		$this->siak_view->dosen_pendamping = $this->siak_model->siak_query("select", 'SELECT a.nip, a.nama FROM dosen a ');
		$this->siak_view->topik = $this->siak_model->siak_data_list("topik", "*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->cohort = $this->siak_model->siak_query("select", "select cohort from cohort group by cohort order by cohort asc");
		$this->siak_view->siak_render('siak_input_ijazah/add', true);
	}
	
	public function siak_create(){

		
		

		
		$nim = $_POST['nim'];
		$prodi_id = $_POST['prodi_id'];
		$no_urut = $_POST['no_urut'];
		
		
		/* $tahun_lulus = $this->siak_model->siak_query("select","select * from transkrip_nilai where nim='".$_POST['nim']."'");
		foreach($tahun_lulus as $keyo => $valo){
		$tahun=$valo['tahun_lulus'];
		} */
		$tahun_lulus = $this->siak_model->siak_query("select","select * from transkrip_nilai");
		
	

		$fakultas = $this->siak_model->siak_query("select","select * from prodi where prodi_id='".$_POST['prodi_id']."'");
		foreach ($_POST['nim'] as $key => $value) {
			foreach($fakultas as $keya => $val){
				foreach($tahun_lulus as $tahun => $lulus){
					if($lulus['nim'] == $value){
				$ok = $val['fakultas_id']."/".$val['prodi_kd']."/".$no_urut."/M.Si/".$lulus['tahun_lulus']."/UNHAN";
			$sql = "insert into ijazah (no_ijazah,nim,prodi_id,no_urut) values ('".$ok."','".$nim[$key]."','".$prodi_id."','".$no_urut."')";
			$no_urut++;
		//echo $sql."<br>";
		$no_urutan=$this->siak_model->siak_query("select","select * from ijazah where no_urut='".$no_urut."'");
		$nimnim=$this->siak_model->siak_query("select","select * from ijazah where nim='".$nim[$key]."'");
		 if ($no_urutan != NULL){
			     	echo "<script>alert('No Urut telah digunakan');window.location.href='".URL."siak_input_ijazah';</script>";
			     	return 0;
			     }
			      else if ($nimnim != NULL){
			     	echo "<script>alert('NIM telah ada');window.location.href='".URL."siak_input_ijazah';</script>";
			     	return 0;
			     }
			     else {
			     	$this->siak_model->siak_query("insert" ,$sql);
			     }
	}
	}
	}
		}

	/*$tahun_lulus = $this->siak_model->siak_query("select","select * from transkrip_nilai where nim='".$_POST['nim']."'");
	foreach($tahun_lulus as $key => $val){
	$tahun=$val['tahun_lulus'];
	}
	$nono = $this->siak_model->siak_query("select","select * from mahasiswa where nim='".$_POST['nim']."'");
	foreach($nono as $keye => $vale){
	$noi=$vale['id'];
	}
	
	$ijazah = $this->siak_model->siak_data_list('ijazah','*');
	$cek = array();
	foreach($ijazah as $ija => $zah){
		$z = explode("/",$zah['no_ijazah']);
		if($z[4] == $tahun){
			array_push($cek,"ada");
		}
	}
	
	
	$fakultas = $this->siak_model->siak_query("select","select * from prodi where prodi_id='".$_POST['prodi_id']."'");
	
	foreach($fakultas as $key => $val){

	$ok = $val['fakultas_id']."/".$val['prodi_kd']."/".$no_urut."/M.Si/".$tahun."/UNHAN";
	$no_urut=$this->siak_model->siak_query("select","select * from ijazah where no_urut='".$_POST['no_urut']."'");
	
}*/
		
		/*$data = array(
			$nim = $_POST['nim_baru'];
				'no_ijazah' => $ok,
			      'prodi_id' => $_POST['prodi_id'],
			      'nim' => $_POST['nim'],
			      'no_urut' => $_POST['no_urut'],


			    
			      );
		 if ($no_urut != NULL){
			     	echo "<script>alert('No Urut telah digunakan');window.location.href='".URL."siak_input_ijazah';</script>";
			     	return 0;
			     }else {
			     	$this->siak_model->insert_data($data, "ijazah");
			     } */
 		//var_dump($data);die(); 
		//$this->siak_model->insert_data($data, "ijazah");
		
		header('location: ' . URL . 'siak_input_ijazah');
	}

	public function siak_edit($id){
		$this->siak_view->prodi = $this->prodi;
		$where = array('id' => $id);
		$this->siak_view->siak_data_list = $this->siak_model->siak_edit($where,"ijazah", "*");
		
		$this->siak_view->siak_render('siak_input_ijazah/edit', true);
	}
	
	public function siak_edit_save($id){
		$where = array('id' => $id);
		$this->siak_model->siak_edit_save($where);
		header('location: ' . URL . 'siak_input_ijazah');
	}

	public function siak_detail($id){
		$where = array('no_ijazah' => $id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "ijazah", "*");
		$this->siak_view->siak_render('siak_input_ijazah/view', false);
	}

	public function siak_delete($id){
		$where = array('id' => $id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_input_ijazah');
	}

	public function mahasiswa($prodi,$cohort){
		$this->siak_view->siak_prodi = $prodi;
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "
		SELECT 
			a.nim,
			b.nama_depan,
			b.nama_belakang,
			c.status,
			c.tahun_lulus
		
		FROM 
			mahasiswa a,
			data_pribadi_umum b,
			transkrip_nilai c
		
		WHERE 
			a.nim=c.nim and
			a.nim=b.nim and
			c.status='1' and
			a.prodi_id = '".$prodi."' and 
			a.cohort = '".$cohort."'
		
		UNION
		SELECT 
			a.nim,
			b.nama_depan,
			b.nama_belakang,
			c.status,
			c.tahun_lulus
		
		FROM 
			mahasiswa a,
			data_pribadi_pns b,
			transkrip_nilai c
		
		WHERE 
			a.nim=c.nim and
			a.nim=b.nim and
			c.status='1' and
			a.prodi_id = '".$prodi."' and 
			a.cohort = '".$cohort."'
		
		order by nim
			;");
		
		
		$this->siak_view->siak_render('siak_input_ijazah/mahasiswa', true);
	}
}

?>