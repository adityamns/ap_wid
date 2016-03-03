<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Siak_evdos extends Siak_controller{
  function __construct(){
    parent::__construct();
    parent::siak_logstat();
    $this->siak_roles();

  }

  function index(){
		$this->siak_view->config = "Siak Widyatama - Nilai Evaluasi Dosen";
	
		$this->siak_view->judul = "Nilai Evaluasi Dosen";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Penilaian','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Nilai Evaluasi Dosen','href'=>''. URL . 'siak_evdos'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
  
    $sql = "select * from dosen_matakuliah";
    $this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");

    // if($_POST['prodi'] == NULL && $_POST['matkul'] == NULL){
    //   $where = '';
    // }else{
    //   $where = "where prodi_id = '".$_POST['prodi']."' and kode_matkul = '".$_POST['matkul']."'";
    // }
    // $sql_dos = "select * from dosen_matakuliah $where";

    if($_POST['matkul'] == NULL){
      $where = '';
    }else{
      $where = "where abs_dosen.kode_matkul = '".$_POST['matkul']."' ";
    }

    $sql_dos = "
    select
    no,nama,kode_matkul
    from
    dosen
    inner join (select (
    CASE WHEN
    absensi_dosen.nip_pengganti IS NULL
    THEN
    absensi_dosen.nip
    ELSE
    absensi_dosen.nip_pengganti
    END
    ) AS no, kode_matkul from absensi_dosen) as abs_dosen on abs_dosen.no=dosen.nip
    $where
    group by kode_matkul,no,nama
    ";
    // $this->siak_view->sql = $sql_dos;
    $this->siak_view->dos = $this->siak_model->siak_query("select", $sql_dos);
    $this->siak_view->siak_render("siak_evdos/index", false);
  }

  function matkul($prodi){
    $this->siak_view->siak_prodi = $prodi;
    $data = $this->siak_model->siak_query("select", "SELECT * FROM matakuliah WHERE prodi_id = '".$prodi."'");

    $html = '';
    $html .= '<select class="m-wrap span12" name = "matkul">';
              foreach($data as $row => $key){
    $html .= '<option value="'.$key['kode_matkul'].'">'.$key['nama_matkul'].'</option>';
                }
    $html .= '</select>';

    echo $html;
  }
  
  function detail(){
    $sql = "select * from soal_evaluasi_dosen";
    $soal = $this->siak_model->siak_query("select",$sql);
    $this->siak_view->soal = $soal;
    $this->siak_view->siak_render("siak_evdos/detail", true);
  }

}

