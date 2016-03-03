<?php if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Siak_irs extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi_id = $_SESSION['prodi'];
		$this->level = $_SESSION['level'];
		$this->user = $_SESSION['username'];
	}
	
	function index(){
		$this->siak_view->config = "Siak Widyatama - Isian Rencana Studi";
	
		$this->siak_view->judul = "Isian Rencana Studi";
		
		///BreadCrumbs
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Isian Rencana Studi','href'=>''. URL . 'siak_rencana_studi'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		////
		
		//Cari
		$nim = $_POST['nim'];
		$thn = $_POST['tahun_akademik'];
		$prodi = $_POST['prodi'];
		$smstr = $_POST['semester'];
		
		if($_POST == TRUE){
		
			$whereNim = "where ";
			
			if($thn != NULL || $thn != ''){
				$whereNim .= "tahun_masuk = '$thn' ";
			}else{
				$whereNim .= "";
			}
			
			if($nim != NULL || $nim != ''){
				$whereNim .= "and nim = '$nim'";
			}else{
				$whereNim .= "";
			}
			
			if($prodi != NULL || $prodi != ''){			
				$whereNim .= "and prodi_id = '$prodi'";
			}else{
				$whereNim .= "";
			}
			
			if($smstr != NULL || $smstr != ''){
				$whereNim .= "and semester = '$smstr'";
			}else{
				$whereNim .= "";
			}
			
			
		}
		
		$sql = "
			SELECT 
			      * 
			FROM 
				mahasiswa 
			$whereNim
		";
// 		
		$newSql = ($this->level != 16)?$this->prodi_id:$sql;
		
// 		$data = $nim." ".$thn." ".$prodi." ".$smstr;
// 		$this->siak_view->data = $sql;
		
		$this->siak_view->data = $this->siak_model->siak_query('select', $sql);
		$this->siak_view->siak_tahun_akademik = $this->siak_model->siak_data_list("tahun_akademik", "*");
		$this->siak_view->prodi = $this->siak_model->siak_data_list('prodi', 'prodi_id,prodi');
		$this->siak_view->siak_render('siak_irs/index', false);
	}
	
	function cek_mhs(){
		$sql = "select prodi_id from mahasiswa where nim = '".$_POST['nim']."'";
		$data = $this->siak_model->fieldNew($sql, 'prodi_id');
		echo $data;
	}
	
	function test(){
		$this->siak_view->siak_render('siak_irs/test', true);
	}

}