<?php if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Download extends Siak_controller{
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi = $_SESSION['prodi'];
		$this->user = $_SESSION['username'];
		$this->level = $_SESSION['level'];
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}
	
	function index($prodi_id = false, $smstr = false){
		$this->siak_view->config = "Siak Unhan - Download Silabus";
	
		$this->siak_view->judul = "Download Silabus";
		
		$this->siak_breadcrumbs->add(array('title'=>'Download','href'=>''. URL . 'download'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
	
		if($this->level == '16'){
			$nim = "nim = '$this->user'";
			$smstr = $this->siak_model->siak_getfield('semester', 'mahasiswa', $nim);
			$prodi_id = $this->prodi;
		}
		
		if($smstr == false){
			$semester = "";
		}else{
			$semester = "and mahasiswa.semester = '$smstr'";
		}
		
		if($prodi_id == false){
			$prodi = "";
		}else{
			$prodi = "and mahasiswa.prodi_id = '$prodi_id'";
		}
		
		$sql = "
			select distinct
				matakuliah.kode_matkul,
				matakuliah.nama_matkul,
				dosen_matakuliah.dosen_utama,
				dosen_matakuliah.dosen_pendamping
			from 
				matakuliah,
				mahasiswa,
				dosen_matakuliah
			where 
				matakuliah.prodi_id = mahasiswa.prodi_id and
				-- matakuliah.semester = mahasiswa.semester and
				dosen_matakuliah.kode_matkul = matakuliah.kode_matkul and
				matakuliah.semester = '$smstr'
				-- $semester
				$prodi
			";
		
		//Cek Lagi Query diatas -_- lier euy saya

		$this->siak_view->mhs = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->level = $this->level;
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		
		//Hak Akses
// 			echo $sql;
		$method_or_uri = $this->uri->getUri(1);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		if($smstr == TRUE && $prodi_id == TRUE && $this->level != '16'){
			$html = '';
			
			$html .= '<table id = "download2" class="table table-striped table-bordered table-hover table-full-width">
				<thead>
					<tr align = "center">
						<th>NO</th>
						<th>KODE DOSEN</th>
						<th>KODE MATAKULIAH</th>
						<th>MATAKULIAH</th>
						<th>SILABUS</th>
						<th>MATERI</th>
					</tr>
				</thead> 
				<tbody>';
					$i = 1;
					foreach ($this->siak_view->mhs as $key => $value) {
					
						$html .= "<tr class='active'>";
						$html .= "<td align = 'center'>" . $i . "</td>";
						$html .= "<td>" . $value['dosen_utama'] . "</td>";
						$html .= "<td>" . $value['kode_matkul'] . "</td>";
						$html .= "<td>" . $value['nama_matkul'] . "</td>";
						$html .= '<td><a class="btn green mini" data-toggle="modal" data-target="#modal-unduh" onclick="unduh(this)" link="'.URL.'download/unduh/'.$value['kode_matkul'].'/2"><i class="icon-download-alt"></i> Silabus</a></td>';
						$html .= '<td><a class="btn green mini" data-toggle="modal" data-target="#modal-unduh" onclick="unduh(this)" link="'.URL.'download/unduh/'.$value['kode_matkul'].'/1"><i class="icon-download-alt"></i> Materi</a></td>';
						$html .= "</tr>";
					$i++;}
				$html .= '</tbody>
			</table>';
			
			
			echo $html;
			
		}else{
			$this->siak_view->siak_render("download/index", false);
		}
	}
	
	function unduh($kode, $id){
		$sql = 'select * from upload where kode_matkul = \''.$kode.'\' and jenis_upload_id = \''.$id.'\' and publish = \'t\'';
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
// 		echo $sql;
		
		//Hak Akses
		$method_or_uri = $this->uri->getUri(1);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->siak_render("download/unduh", true);
	}
	
}