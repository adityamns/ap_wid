<?php

/* Main Siak View class */
class Siak_view{

	private $bready = '';

	function __construct(){
		// $this->siak_view->session = $this->siak_session->siak_getAll();
		$this->db = new Siak_model();
		$this->uri = new Siak_Uri(); //get uri segment
	}

	public function siak_render($name, $noinclude){
		//var_dump($noinclude);die();
		if ($noinclude == true) {
			require 'siak_views/' . $name . '.php';
		}else{
			require 'siak_views/siak_header.php';
			require 'siak_views/' . $name . '.php';
			require 'siak_views/siak_footer.php';
		}
	}
	
	//==== Breadcrumbs ====//
	public function set_breadcrumbs($bready){
		$this->bready = $bready;
	}
	
	public function get_breadcrumbs(){
		echo $this->bready;
	}
	
	function display_children($parent, $id) {
	
	$sql = "SELECT 
		      a.id, 
		      a.nama_modul, 
		      a.url, 
		      DERIV1.JML,
		      (select role.loads from role where role.modul_id=a.id and role.group_id='".$id."' limit 1) loads
	      FROM 
		      menu a 
	      LEFT OUTER JOIN 
	      (
		      SELECT 
			      parent, 
			      COUNT(*) JML 
		      FROM 
			      menu 
		      GROUP BY 
			      parent
	      ) 
	      DERIV1 ON 
	      a.id = deriv1.parent 
	      WHERE 
	      a.parent = '".$parent."' and a.status = 't' order by urutan";
	      
	//Adding status clause to select aktif menu but still can add modul for pages rule
	      
	$data = $this->db->siak_query("select", $sql);
	
	$html = "";				
	foreach ($data as $hole => $row) {
	  if ($row['jml'] > 0 && $row['loads'] == 't') {
	  
		  $html .= 
			'
			<li>
			      <a class="active" href="javascript:;">
			      <i class="icon-sitemap"></i> 
			      <span class="title">'.$row['nama_modul'].'</span>
			      <span class="arrow "></span>
			      </a>
			      <ul class="sub-menu">';
			      
		  $html .= $this->display_children($row['id'], $id);
		  
	  } elseif ($row['jml'] == "" && $row['loads'] == 't') {
	  
		  $html .= "<li ><a href='".URL.$row['url'] . "'><i class='icon-folder-open'></i> " . $row['nama_modul'] . "</a></li>";
		    
	  }
	}
	$html .= "</ul></li>";
	return $html;
      }
      
      function filter_data($nip, $kd_matkul){
				$sql = "
				SELECT DISTINCT evd.nip,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '1' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '5') AS pil1a,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '2' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '5') AS pil2a,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '3' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '5') AS pil3a,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '4' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '5') AS pil4a,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '1' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '6') AS pil1b,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '2' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '6') AS pil2b,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '3' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '6') AS pil3b,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '4' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '6') AS pil4b,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '1' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '7') AS pil1c,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '2' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '7') AS pil2c,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '3' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '7') AS pil3c,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '4' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '7') AS pil4c,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '1' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '8') AS pil1d,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '2' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '8') AS pil2d,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '3' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '8') AS pil3d,
				(SELECT COUNT(jawaban) FROM evaluasi_dosen AS ev1 WHERE ev1.jawaban = '4' AND ev1.nip = '$nip' AND ev1.kode_matkul = '$kd_matkul' AND ev1.soal_id = '8') AS pil4d
				FROM evaluasi_dosen AS evd WHERE evd.nip = '$nip'
				";
				// echo $sql;

				$data = $this->db->siak_query("select", $sql);
				return $data;
			}
			
	function nilai_($nim,$matkul,$page){
		$sql = "
			      SELECT 
				      komnil.nim,
				      komnil.nilai,
				      komnil.id_komponen,
				      kom.komponen,
				      bo.matkul_id,
				      bo.semester
			      FROM 
				      komponen_nilai as komnil,
				      komponen as kom,
				      bobot as bo
			      WHERE 
				      komnil.id_komponen = kom.id
				      AND bo.id = kom.id_bobot
				      AND kom.komponen = '$page'
				      AND komnil.nim = '$nim'
				      AND bo.matkul_id = '$matkul'
			      ";
			      
		$data = $this->db->siak_query("select", $sql);
		return $data;
	}


}

?>
