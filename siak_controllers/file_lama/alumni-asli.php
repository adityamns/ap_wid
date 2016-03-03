<?php
if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Alumni extends Siak_controller{
  function __construct(){
    parent::__construct();
      parent::siak_logstat();
      $this->siak_roles();
  }
  
  function index(){
		$this->siak_view->config = "Siak Unhan - Setup Alumni";
	
		$this->siak_view->judul = "Setup Alumni";
		
		$this->siak_breadcrumbs->add(array('title'=>'Alumni','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Setup Alumni','href'=>''. URL . 'alumni'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
    $this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
    $this->siak_view->siak_render("alumni/index", false);
  }
  
  function get_data(){
      $sql_cek = "
		  SELECT DISTINCT
		    view_mahasiswa.nim,
		    view_mahasiswa.prodi_id,
		    view_mahasiswa.nama_depan,
		    view_mahasiswa.nama_belakang,
		    view_mahasiswa.tahun_masuk,
		    view_mahasiswa.jenis,
		    nilai_mahasiswa.nilai_total,
		    nilai_mahasiswa.grade,
		    yudisium.ipk
		  FROM 
		    view_mahasiswa,
		    nilai_mahasiswa,
		    syarat_wisuda,
		    yudisium
		  WHERE
		    view_mahasiswa.nim = nilai_mahasiswa.nim AND
		    syarat_wisuda.nim = nilai_mahasiswa.nim AND
		    view_mahasiswa.semester = nilai_mahasiswa.semester AND
		    yudisium.nim = syarat_wisuda.nim AND
		    nilai_mahasiswa.hasil = 'TRUE' AND
		    syarat_wisuda.cek = 'TRUE'
		 ";

      $hasil = $this->siak_model->siak_query("select", $sql_cek);
      $i = 1;
      foreach($hasil as $rec => $col){
	
	$html .= '<tr>
		  <td>'.$i.'</td>
		  <td>'.$col['nim'].'</td>
		  <td>'.strtoupper($col['nama_depan']).'&nbsp;'.strtoupper($col['nama_belakang']).'</td>
		  <td>'.number_format($col['nilai_total'], 2, '.' , ',').'</td>
		  <td>'.$col['grade'].'</td>
		  <td>'.$col['ipk'].'</td>
		  </tr>';
      $i++; 
      }
      
      $count = count($hasil);
      $alert = '<tr>
		  <td colspan="6"><div class="alert alert-danger" style="text-align:center">Maaf data belum ada</div></td>
	      </tr>';
      echo ($count > 0)? $html:$alert;
  }
  
  function get_cohort($kode){
    $sql = "select * from cohort where prodi_id = '$kode'";
    $data = $this->siak_model->siak_query("select", $sql);
    $html = '<select class="form-control" id="tahunid" name="tahun" link="'.URL.'alumni/get_mhs" onchange="getMhs(this)">
	      <option value="">-- TAHUN ANGKATAN --</option>';
	      foreach($data as $row => $key){
    $html .= '<option value="'.$key['cohort'].'" >'.$key['tahun_masuk'].'</option>';
	      }
    $html .= '</select>';
    
    echo $html;
  }
  
  function get_mhs($prodi,$cohort){
    $sql = "select * from mahasiswa where prodi_id = '$prodi' and cohort = '$cohort'";
    $data = $this->siak_model->siak_query("select", $sql);
    $i = 1;
    
    foreach($data as $row => $key){
      $sql_cek = "
		  SELECT DISTINCT
		    view_mahasiswa.nim,
		    view_mahasiswa.prodi_id,
		    view_mahasiswa.nama_depan,
		    view_mahasiswa.nama_belakang,
		    view_mahasiswa.tahun_masuk,
		    view_mahasiswa.jenis,
		    nilai_mahasiswa.nilai_total,
		    nilai_mahasiswa.grade,
		    yudisium.ipk
		  FROM 
		    view_mahasiswa,
		    nilai_mahasiswa,
		    syarat_wisuda,
		    yudisium
		  WHERE
		    view_mahasiswa.nim = nilai_mahasiswa.nim AND
		    syarat_wisuda.nim = nilai_mahasiswa.nim AND
		    view_mahasiswa.semester = nilai_mahasiswa.semester AND
		    yudisium.nim = syarat_wisuda.nim AND
		    view_mahasiswa.nim = '".$key['nim']."' AND
		    view_mahasiswa.semester = '".$key['semester']."' AND
		    nilai_mahasiswa.hasil = 'TRUE' AND
		    syarat_wisuda.cek = 'TRUE'
		 ";

      $hasil = $this->siak_model->siak_query("select", $sql_cek);
      
      foreach($hasil as $rec => $col){
	
	$html .= '<tr>
		  <td>'.$i.'</td>
		  <td>'.$col['nim'].'
		      <input type="hidden" name="count[]" value="">
		      <input type="hidden" name="jenis[]" value="'.$col['jenis'].'">
		      <input type="hidden" name="nim[]" value="'.$col['nim'].'">
		      <input type="hidden" name="prodi_id[]" value="'.$col['prodi_id'].'">
		      <input type="hidden" name="tahun_masuk[]" value="'.$col['tahun_masuk'].'">
		      <input type="hidden" name="ipk[]" value="'.$col['ipk'].'">
		  </td>
		  <td>'.strtoupper($col['nama_depan']).'&nbsp;'.strtoupper($col['nama_belakang']).'</td>
		  <td>'.number_format($col['nilai_total'], 2, '.' , ',').'</td>
		  <td>'.$col['grade'].'</td>
		  <td>'.$col['ipk'].'</td>
		  </tr>';
      $i++; 
      }
      
    }
    $html .= '
	      <tr>
		  <td colspan="6"><input class="btn btn-medium btn-primary" type="submit" name="set_alumni" value="Set Alumni"></td>
	      </tr>';

//     if(count($hasil) <= 0){
//       echo '<tr>
// 		<td colspan="6"><div class="alert alert-danger" style="text-align:center">Maaf data Mahasiswa Siap Alumni untuk Prodi( '.$prodi.' ) dengan Cohort( '.$cohort.' ) belum ada</div></td>
// 	    </tr>';
//     }else{
      echo $html;
//     }
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
      echo $sql_insert."<br>";
      echo $sql_del_user."<br>";
      echo $sql_del_mhs."<br><br>";
      
//       $this->siak_model->siak_query("insert", $sql_insert);
//       $this->siak_model->siak_query("delete", $sql_del_user);
//       $this->siak_model->siak_query("delete", $sql_del_mhs);
      
    }
    die();
  }
  
  function data_alumni(){
		$this->siak_view->config = "Siak Unhan - Data Alumni";
	
		$this->siak_view->judul = "Data Alumni";
		
		$this->siak_breadcrumbs->add(array('title'=>'Alumni','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Alumni','href'=>''. URL . 'alumni/data_alumni'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		$sql = "select a.nim,
	a.ipk,
	b.nama_depan,
	b.nama_belakang 

from 	alumni a, 
	data_pribadi_umum b 

where a.nim=b.nim
 union
 select a.nim,
	a.ipk,
	b.nama_depan,
	b.nama_belakang 

from 	alumni a, 
	data_pribadi_pns b 

where a.nim=b.nim";
    
		$this->siak_view->hasil =$this->siak_model->siak_query("select", $sql);
    $this->siak_view->siak_render("alumni/data_alumni", false);
  }
  
  function get_alumni(){
    $sql = "select a.nim,
	a.ipk,
	b.nama_depan,
	b.nama_belakang 

from 	alumni a, 
	data_pribadi_umum b 

where a.nim=b.nim
 union
 select a.nim,
	a.ipk,
	b.nama_depan,
	b.nama_belakang 

from 	alumni a, 
	data_pribadi_pns b 

where a.nim=b.nim";
    
    $hasil = $this->siak_model->siak_query("select", $sql);
      $i = 1;
      foreach($hasil as $rec => $col){
	
	$html .= '<tr>
		  <td>'.$i.'</td>
		  <td>'.$col['nim'].'</td>
		  <td>'.strtoupper($col['nama_depan']).'&nbsp;'.strtoupper($col['nama_belakang']).'</td>
		  <td>'.number_format($col['nilai_total'], 2, '.' , ',').'</td>
		  <td>'.$col['grade'].'</td>
		  
		  </tr>';
      $i++; 
      }
      
      $count = count($hasil);
      $alert = '<tr>
		  <td colspan="6"><div class="alert alert-danger" style="text-align:center">Maaf data belum ada</div></td>
	      </tr>';
      echo ($count > 0)? $html:$alert;
  }
  function exc_alumni(){
    $sql = "
        select a.nim,
            a.ipk,
            b.nama_depan,
            b.nama_belakang 

        from     alumni a, 
            data_pribadi_umum b 

        where a.nim=b.nim
        union
        select a.nim,
            a.ipk,
            b.nama_depan,
            b.nama_belakang 

        from     alumni a, 
            data_pribadi_pns b 

        where a.nim=b.nim
      ";
    $this->siak_view->data = $this->siak_model->siak_query('select', $sql);
    $this->siak_view->siak_render('alumni/excel_alumni', true);
  }
}