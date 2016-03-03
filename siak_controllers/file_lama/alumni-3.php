<?php
if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');
class Alumni extends Siak_controller{
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}
	
	///alumni -> lulust tabel ranskrip
	
	function index(){
		$this->siak_view->config = "Siak Unhan - Setup Alumni";
	
		$this->siak_view->judul = "Setup Alumni";
		
		$this->siak_breadcrumbs->add(array('title'=>'Alumni','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Setup Alumni','href'=>''. URL . 'alumni'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$sqlAlumni = "";
		$this->siak_view->alumni = $this->siak_model->siak_query("select", $sqlAlumni);
		
		$this->siak_view->siak_render("alumni/index", false);
	}
	
	function get_cohort($kode){
		$sql = "select * from cohort where prodi_id = '$kode'";
		$data = $this->siak_model->siak_query("select", $sql);
		$html = '<select class="m-wrap span6" id="tahunid" name="tahun" link="'.URL.'alumni/getMhs" onchange="getMhs(this)">
			  <option value="">-- TAHUN ANGKATAN --</option>';
			  foreach($data as $row => $key){
		$html .= '<option value="'.$key['cohort'].'" >'.$key['tahun_masuk'].'</option>';
			  }
		$html .= '</select>';
		
		echo $html;
	}
	
	function getMhs(){
		echo $_POST['prodi']."\n";
		echo $_POST['cohort'];
	}
}