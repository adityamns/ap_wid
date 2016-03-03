<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak rencana_studi controller class */

class Siak_rencana_studi extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi = $_SESSION['prodi'];
		$this->level = $_SESSION['level'];
		$this->rolePage = $this->siak_session->siak_getAll();
// 		var_dump($this->prodi);
	}
	
	//

	function index($mhs = false){
		$this->siak_view->config = "Siak Widyatama - Isian Rencana Studi";
	
		$this->siak_view->judul = "Isian Rencana Studi";
		
		///BreadCrumbs
		$this->siak_breadcrumbs->add(array('title'=>'Pembelajaran','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Persiapan Kuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Isian Rencana Studi','href'=>''. URL . 'siak_rencana_studi'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		////
		
		//Hak Akses
		$method_or_uri = 'siak_rencana_studi';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
// 		$this->siak_view->siak_tahun_akademik = $this->siak_model->siak_data_list("tahun_akademik", "*");
		$this->siak_view->siak_tahun_akademik = $this->siak_model->siak_query("select","select * from detail_tahun_akademik where status='1' order by tahun");
		
		$nim = $_POST['nim'];
		if($nim == TRUE){
			$and = "and nim = '$nim'";
		}else if($mhs == TRUE){
			$and = "and nim = '$mhs'";
		}else{
			$and = "";
		}
		
		if($this->prodi == TRUE){
			$where = "where prodi_id='".$this->prodi."' $and";
		}else{
			$where = "";
		}
		
		$this->siak_view->siak_cohort = $this->siak_model->siak_query("select", "select * from cohort $where order by tahun_masuk");
		$this->siak_view->prodi = $this->siak_model->siak_data_list('prodi', 'prodi_id,prodi');
		$this->siak_view->data = $this->siak_model->siak_query("select", "select * from mahasiswa $where order by nim");
		
// 		$sql = "select * from mahasiswa $where";
// 		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
// 		
// 		if($this->level != 16){
// 			$this->siak_view->siak_render('konfirmasi_irs/index', false);
// 		}else{
			$this->siak_view->siak_render('siak_rencana_studi/index', false);
// 		}
	}
	
	function cari(){
		
		$nim = $_POST['nim'];
		$prod = $_POST['prodi'];
		$coh = $_POST['cohort'];
		$thn = $_POST['tahun_akademik'];
		$smstr = $_POST['semester'];
		
		if($_POST == TRUE){
			$where = 'where';
			if($prod == TRUE){
				$where .= " prodi_id='$prod'";
			}
			if($nim == TRUE){
				$where .= " and nim='$nim'";
			}
			if($coh == TRUE){
				$where .= " and cohort='$coh'";
			}
			if($thn == TRUE){
				$where .= " and tahun_akademik='$thn'";
			}
			if($smstr == TRUE){
			$sm = $smstr-1;
				$where .= " and semester='$sm'";
			}
		}
		
		$sql = "
			SELECT * FROM mahasiswa $where
		";
		
// 		echo $sql;
		
		$data = $this->reqQuery("select", $sql);
		
		$html = '
		<table id="notifikasi" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr>
					<th>NIM</th>
					<th>SEMESTER AKTIF</th>
					<th>STATUS PERPANJANGAN</th>
					<th>ACTION</th>
				</tr>
			</thead> 
			<tbody>';
			$i=0;
			foreach($data as $row => $val){$i++;
			$perpanjang = $val['perpanjangan'] > 0?"Perpanjangan Ke-".$val['perpanjangan']:"-";
		$html .= '
				<tr>
					<td><input type="hidden" value="'.$val['nim'].'" name="nim[]"><input type="hidden" value="'.$val['id'].'" name="id_mhs[]">'.$val['nim'].'</td>
					<td><input type="hidden" value="'.$val['semester'].'" name="smstr[]">'.$val['semester'].'</td>
					<td>'.$perpanjang.'</td>
					<td><input type="hidden" value="'.$val['prodi_id'].'" name="prodi[]">
					<input type="checkbox" class="cek" value="'.$val['nim'].'" name="cek[]">
					</td>
				</tr>'; 
			}
		$html .= '
			</tbody>
		</table>';
		
		echo $html;
		
	}
	
	function reqQuery($sqlType, $sql){
		$data = $this->siak_model->siak_query($sqlType, $sql);
		return $data;
	}
	
	function activated(){
		
		
		
		$count = sizeof($_POST['cek']);
		if($count <= 0){
			echo "Anda belum memilih";
		}else{
		
			for($i=0;$i<$count;$i++){
				foreach($_POST['nim'] as $rec => $nim){
					if($_POST['cek'][$i] == $nim){
						
						$kondisi = array('prodi_id' => $_POST['prodi'][$rec], 'semester' => ($_POST['smstr'][$rec]+1), 'jenismatkul_id' => 2);
						$matkul = $this->siak_model->siak_edit($kondisi, "matakuliah", "*");
						
						if(($_POST['smstr'][$rec]+1) > 0 && $_POST['smstr'][$rec] != "perp1" && $_POST['smstr'][$rec] != "perp2"){
							foreach($matkul as $key => $val){
								$sql1 = "insert into tbl_matakuliah_all(prodi_id,semester,nim,matkul_id,edit_id,jenis_matkul) values('".$_POST['prodi'][$rec]."','".($_POST['smstr'][$rec]+1)."','".$nim."','".$val['kode_matkul']."','1','".$val['jenismatkul_id']."')";
// 								echo "Insert tbl_matakuliah_all = ".$sql1."<br>";
								$this->siak_model->siak_query("insert",$sql1);
							}
							//Send Notif Here
						}
						
						//KET : 
						//*status -> untuk keterngan CUTI
						if($_POST['smstr'][$rec] == "perp1" || $_POST['smstr'][$rec] == "perp2"){
						
						      $sql = "
							      UPDATE 
								      mahasiswa 
							      SET 
								      perpanjangan = (
										      CASE WHEN perpanjangan IS NULL
										      THEN (0 + 1)
										      ELSE (perpanjangan + 1)
										      END
										      ), 
								      tahun_akademik  = '".$_POST['thn']."' WHERE nim = '".$nim."';
							      ";
						
							$this->siak_model->siak_query("update", $sql);
						}else{
						
						      $sqlUp = "UPDATE mahasiswa set edit_id='1', semester = '".($_POST['smstr'][$rec]+1)."', tahun_akademik  = '".$_POST['thn']."', status = '1' WHERE nim = '".$nim."';";
// 						      echo $sqlUp."\n";
						      $this->siak_model->siak_query("update", $sqlUp);
						      
						}
						
						$sqlIns = "INSERT INTO riwayat_status_mhs(nim, semester, tahun_akademik, status, id_mahasiswa) values('".$nim."','".$_POST['smstr'][$rec]."','".$_POST['thn']."', '1', '".$_POST['id_mhs'][$rec]."')";
// 						echo $sqlIns."<br>";
						$this->siak_model->siak_query("insert", $sqlIns);
					}
				}
			}
		
		}
		
	}
	
	function cekIrs(){
		echo "Isi Irs";
		$nim = $_POST['nim'];
		$prod = $_POST['prodi'];
		$coh = $_POST['cohort'];
		$thn = $_POST['tahun_akademik'];
		$smstr = $_POST['semester'];
		
		if($_POST == TRUE){
			$where = 'where';
			if($prod == TRUE){
				$where .= " prodi_id='$prod'";
			}
			if($nim == TRUE){
				$where .= " and nim='$nim'";
			}
			if($coh == TRUE){
				$where .= " and cohort='$coh'";
			}
			if($thn == TRUE){
				$where .= " and tahun_akademik='$thn'";
			}
			if($smstr == TRUE){
			$sm = $smstr-1;
				$where .= " and semester='$sm'";
			}
		}
		
		$sql = "
			SELECT * FROM mahasiswa $where
		";
	}

// 	public function siak_cek($nim, $semester){
	public function siak_cek(){ //Oleh mahasiswa
		$prodi = $_POST['prodi'];
		$nim = $_POST['nim'];
		$semester = $_POST['semester'];
		$this->siak_view->prodi = $prodi;
		$this->siak_view->nim = $nim;
		$this->siak_view->semester = $semester;
		
// 		$this->siak_view->nim = $nim;
// 		$this->siak_view->semester = $semester;
		
		
		$where = array('nim' => $nim, 'status' => 1);
		$prodi = $this->siak_model->siak_edit($where, "mahasiswa", "id,semester,prodi_id,cohort,tahun_akademik");
// 		var_dump($where);
		
		///Cek Sudah Mengambil Matakuliah Pilihan??
		$sqlCekMatkulPil = "
				    select
					    allt.nim,
					    allt.matkul_id,
					    allt.semester,
					    matpil.nama_matkul
				    from
					    tbl_matakuliah_all as allt,
					    matakuliah  as matpil
				    where
					    allt.matkul_id = matpil.kode_matkul and
					    matpil.jenismatkul_id = '1' and
					    allt.semester = '$semester' and
					    allt.nim = '$nim'
				  ";
		$mhsMatkulPil = $this->siak_model->siak_query("select", $sqlCekMatkulPil);
		$countMatkulPil = sizeof($mhsMatkulPil);
		
		$sqlCekMatkulAll = "select count(matkul_id) from tbl_matakuliah_all where nim = '$nim' and semester = '".$semester."' and jenis_matkul = '2'";
		$sqlCekMatkul = "select count(kode_matkul) from matakuliah where jenismatkul_id = '2' and semester = '".$semester."' and prodi_id = '".$_POST['prodi']."'";
		$CekMatkulAll = $this->siak_model->siak_query("select", $sqlCekMatkulAll);
		$CekMatkul = $this->siak_model->siak_query("select", $sqlCekMatkul);
		
// 		var_dump($sqlCekMatkul);
// 		die();
		
		foreach ($prodi as $key => $value) {
			
			$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semester, 'jenismatkul_id' => 2);
			$this->siak_view->cohort = $value['cohort'];
			$this->siak_view->id_mhs = $value['id'];
			$this->siak_view->data = $this->siak_model->siak_edit($kondisi, "matakuliah", "*");

			$query = "";
			foreach ($this->siak_view->data as $key => $valu) {
				$query .= "SELECT * FROM nilai_mahasiswa WHERE prodi_id = '".$value['prodi_id']."' AND semester = ".$semester." AND nim = '".$nim."' AND matkul_id = '".$valu['kode_matkul']."' UNION  ";
			}

			$query = substr($query, 0, sizeof($query) -8);
			$query .= ";";
			

			
			
			$aturan_nilai = $this->siak_model->siak_data_list("aturan_nilai", "*");
			
			if($value['prodi_id'] != $this->prodi && $this->level != '1' && $this->level != '16'){
			    echo "<div class='alert alert-danger'>Mahasiswa dengan NPM : <u style='color:blue'>".$nim."</u> tidak terdaftar pada Prodi $this->prodi.</div>";
			    exit;
			}
			
			$this->siak_view->data_nilai = $this->siak_model->siak_query("select", $query);
			$nilai = array();
			foreach ($this->siak_view->data_nilai as $key => $values) {
				foreach ($aturan_nilai as $key => $valu) {
					if($values['grade']==$valu['nama']){
						$nilai[] = $valu['lulus'];
					}
				}
			}
			
			// echo $value['semester']+1;
			if ($semester == $value['semester']+1 && in_array("N", $nilai) && $semester != "perp1" && $semester != "perp2") {
				$this->siak_view->siak_render('siak_rencana_studi/irs', true);
			}
			elseif ($semester == $value['semester']+1 && !in_array("N", $nilai) && $semester != "perp1" && $semester != "perp2") {
				//Kalo count = 0 Button Ambil Matakuliah Pilihan aktif
				if($countMatkulPil <= 0 && $semester != '1'){
					$pesan = "Anda Belum Mengambil Matakuliah Pilihan";
					
					$this->siak_view->cek = "t";
					$this->siak_view->pesan = $pesan;
				}
				$this->siak_view->CekMatkulAll = $CekMatkulAll;
				$this->siak_view->CekMatkul = $CekMatkul;
				$this->siak_view->siak_render('siak_rencana_studi/irs', true);
			}
			elseif($semester < $value['semester']+1 && !in_array("N", $nilai) && $semester != "perp1" && $semester != "perp2") {
				$data = $this->siak_model->fieldNew("select perpanjangan from mahasiswa where nim = '$nim'","perpanjangan");
				if($data > 0){
					echo "<div class='alert alert-danger'>Anda Saat ini sedang Aktif Di Semester Perpanjangan Ke-$data</div>";
				}else{
					echo "<div class='alert alert-danger'>Anda Sudah Aktif Di Semester ". $semester ."</div>";
				}
				
				$this->siak_view->aktif = "t";
				
				//Kalo count = 0 Button Ambil Matakuliah Pilihan aktif
				if($countMatkulPil <= 0 && $semester != '1'){
					$pesan = "Anda Belum Mengambil Matakuliah Pilihan";
					$this->siak_view->cek = "t";
					$this->siak_view->pesan = $pesan;
				}
				
				$this->siak_view->countMatkulPil = $countMatkulPil;
				$this->siak_view->CekMatkulAll = $CekMatkulAll;
				$this->siak_view->CekMatkul = $CekMatkul;
				$this->siak_view->siak_render('siak_rencana_studi/irs', true);
			}
			elseif($semester > $value['semester']+1 && !in_array("N", $nilai) && $semester != "perp1" && $semester != "perp2") {
				echo "<div class='alert alert-danger'>Anda Belum Bisa Mengisi IRS Semester ". $semester ."</div>";
			}
			elseif($semester < $value['semester']+1 && in_array("N", $nilai) && $semester != "perp1" && $semester != "perp2"){ 
				echo "<div class='alert alert-warning'>Nilai Anda pada Semester ". $semester ." masih ada yang kurang, Silahkan tekan tombol perpanjang tahun akademik untuk bisa mengisi IRS kembali</div>";
				echo '<a href = "siak_rencana_studi/perpanjang/'.$nim.'/'.$semester.'/'.$value['tahun_akademik'].' "><input type = "button" value = "PERPANJANG TAHUN AKADEMIK" class = "btn btn-medium btn-primary "/></a>';
			}else if($semester == "perp1" || $semester == "perp2"){
				$data = $this->siak_model->fieldNew("select perpanjangan from mahasiswa where nim = '$nim'","perpanjangan");
				$smstr = $semester == "perp1"?"1":"2";
// 				echo $smstr;
				if($data < $smstr){
					if($smstr == ($data+1)){
					echo "<div class='alert alert-danger'>Klik Button \"Aktifkan\" untuk mengaktifkan Perpanjangan Anda yang Ke-".($data+1)." </div>";
						echo '<input type="hidden" id="idMhs" value="'.$value['id'].'">
						      <div class="input-group" id="activePerp">
							      <button class=" btn purple btn-large" onclick="activePerp()" type="button">Aktifkan</button>
						      </div>
						      ';
					}else{
						echo "<div class='alert alert-danger'>Silahkan mengaktifkan Perpanjangan sebelumnya</div>";
					}
				}else{
					echo "<div class='alert alert-danger'>Anda sudah mengaktifkan Perpanjangan yang Ke-".$smstr." </div>";
					if($smstr == 2){
						echo "<div class='alert alert-danger'>Tidak bisa melakukan Perpanjangan lagi!!!</div>";
					}else{
						echo "<div class='alert alert-danger'>Silahkan pilih Semester Perpanjangan berikutnya</div>";
					}
				}
			}
		}
	}
	
	//IRS Perpanjangan
	function perpanjangan(){
		$sql = "
			UPDATE 
				mahasiswa 
			SET 
				perpanjangan = (
						CASE WHEN perpanjangan IS NULL
						THEN (0 + 1)
						ELSE (perpanjangan + 1)
						END
						), 
				tahun_akademik  = '".$_POST['thn']."' WHERE nim = '".$_POST['nim']."';
			";
		$this->siak_model->siak_query("update", $sql);
		$sqlIns = "INSERT INTO riwayat_status_mhs(nim, semester, tahun_akademik, status, id_mahasiswa) values('".$_POST['nim']."','".$_POST['smstr'][$rec]."','".$_POST['thn']."', '1', '".$_POST['idMhs']."')";
// 		echo $sqlIns."<br>";
		$this->siak_model->siak_query("insert", $sqlIns);
	}
	
	//Gatau ini dipake apa kagak :v
	public function perpanjang($nim, $semester, $tahun_akademik){
		$semester = $semester-1;
		$this->siak_model->siak_query("update","UPDATE mahasiswa set semester = ".$semester." WHERE nim = '".$nim."';");
		header('location: ' . URL . 'siak_rencana_studi');
	}

	public function siak_ok(){
	
		$prodi_id = $this->prodi;
// 		$prodi_id = $_POST['prodi_id'];
		$smstr = $_POST['semester'];
		$nim = $_POST['nim'];
		
		$id = $_POST['id_mhs'];
		
		/////
		//Value of edit_id is '0' for original data & '1' for insert data
		
		
		foreach ($_POST['kode_matkul'] as $key => $value) {
			if($smstr != "perp1" || $smstr != "perp2"){
				$sql1 = "insert into tbl_matakuliah_all(prodi_id,semester,nim,matkul_id,edit_id,jenis_matkul) values('".$prodi_id."','".$smstr."','".$nim."','".$value."','1','".$_POST['jenis_matkul'][$key]."')";
				$this->siak_model->siak_query("insert",$sql1);
// 				echo $sql1."<br>";
			}
				
		}
// 		$sqlIns = "INSERT INTO riwayat_status_mhs(nim, semester, tahun_akademik, status, id_mahasiswa) values('".$nim."','".$smstr."','".$_POST['thn']."', '1', '".$_POST['id_mhs']."')";
// 		echo $sqlIns."<br>";
// 		$this->siak_model->siak_query("insert", $sqlIns);
		
		//echo "UPDATE mahasiswa set edit_id='1',semester = '".$_POST['semester']."', tahun_akademik = '".$_POST['tahun_akademik']."', status = '1' WHERE nim = '".$_POST['nim']."'; "; die();
// 		die();
		
// 		$this->siak_model->siak_query("update", "UPDATE mahasiswa set edit_id='1', semester = '".$_POST['semester']."', tahun_akademik  = '".$_POST['thn']."', status = '1' WHERE nim = '".$_POST['nim']."'; ");
		
		if($smstr == "perp1" || $smstr == "perp2"){
			$sql = "
				UPDATE 
					mahasiswa 
				SET 
					perpanjangan = (
							CASE WHEN perpanjangan IS NULL
							THEN (0 + 1)
							ELSE (perpanjangan + 1)
							END
							), 
					tahun_akademik  = '".$_POST['thn']."' WHERE nim = '".$_POST['nim']."';
				";
			$this->siak_model->siak_query("update", $sql);
		}else{
			$this->siak_model->siak_query("update", "UPDATE mahasiswa set edit_id='1', semester = '".$_POST['semester']."', tahun_akademik  = '".$_POST['thn']."', status = '1' WHERE nim = '".$_POST['nim']."'; ");
		}
		
		$this->siak_model->notifInsertIRS($nim, $smstr, $this->level, $prodi_id);//Send Notif
		
		header('location: ' . URL . 'siak_rencana_studi');
	}
	
	
	function konfirmasi_irs(){
		$nim = $_POST['nim'];
		$prodi = $_POST['prodi'];
		$smstr = $_POST['smstr'];
		
		$sql_up_matkulAll = "update tbl_matakuliah_all set edit_id='0' where nim = '$nim' and semester = '$smstr'";
		$sql_up_mhs = "update mahasiswa set edit_id = '0' where nim = '$nim'";
		
		$this->siak_model->siak_query("update", $sql_up_matkulAll);
		$this->siak_model->siak_query("update", $sql_up_mhs);
		$this->siak_model->notifInsertIRS($nim, $smstr, $this->level, $prodi); //Send Notif
	}

	public function form_cuti($nim, $semester, $cohort){
		$where = array('nim' => $nim);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "mahasiswa", "*");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->semester = $semester;
		$this->siak_view->siak_render('siak_rencana_studi/form_cuti', true);
	}

	public function form_matkul_pilihan($nim, $semester, $cohort){
		$where = array('nim' => $nim);
		$prodi = $this->siak_model->siak_edit($where, "mahasiswa", "prodi_id,cohort");
		
		
		foreach ($prodi as $key => $value) {
			$kondisi = array('prodi_id' => $value['prodi_id'], 'semester' => $semester, 'jenismatkul_id' => 1);
			$x = $value['prodi_id'];
		}
		
		$sql = "select * from matakuliah where jenismatkul_id = 1 AND prodi_id = '$x' AND semester = '$semester'";
		
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		
		$kondisi2 = array('prodi_id' => $x, 'semester' => $semester, 'jenismatkul_id' => 2);
		$this->siak_view->data2 = $this->siak_model->siak_edit($kondisi2, "matakuliah", "*");
		
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "mahasiswa", "*");
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->semester = $semester;
		$this->siak_view->nim = $nim;
		$this->siak_view->cohort = $cohort;
		$this->siak_view->siak_render('siak_rencana_studi/form_matkul_pilihan', true);
	}

	public function insert_cuti(){
		$this->siak_model->siak_query("insert","insert into cuti values ('','".$_POST['nim']."','".$_POST['prodi_id']."', ".$_POST['semester'].", '".$_POST['lama_cuti']."', '".$_POST['tgl_mulai']."', '".$_POST['tgl_selesai']."', '".$_POST['alamat_cuti']."', '".$_POST['telp_cuti']."', 2)");
		header('location: ' . URL . 'siak_rencana_studi');
	}

	public function insert_matkul_pilihan(){
		$prodi_id = $_POST['prodi_id'];
		$smstr = $_POST['semester'];
		$nim = $_POST['nim'];
		
		foreach ($_POST['kode_matkul'] as $key => $value) {
		
			$sql1 = "insert into tbl_matakuliah_all(prodi_id,semester,nim,matkul_id) values('".$prodi_id."','".$smstr."','".$nim."','".$value."')";
			$this->siak_model->siak_query("insert",$sql1);
// 			echo $sql1."<br>";
		}
		foreach ($_POST['matkul_id'] as $key => $value) {
		
			$sql2 = "insert into tbl_matakuliah_all(prodi_id,semester,nim,matkul_id) values('".$prodi_id."','".$smstr."','".$nim."','".$value."')";
			$this->siak_model->siak_query("insert",$sql2);
// 			echo "<hr>".$sql2."<br>";
		}
// 		die();
		header('location: ' . URL . 'siak_rencana_studi');
	}

	public function tampil_cuti(){
		$where = array('status' => 2);
		$this->siak_view->data = $this->siak_model->siak_edit($where, "cuti", "*");
		$this->siak_view->siak_render('siak_rencana_studi/tampil_cuti', false);
	}

	public function form_confirm_cuti($id_cuti){
		$where = array('id_cuti' => $id_cuti);
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "*");
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "cuti", "*");
		foreach ($this->siak_view->siak_data as $key => $value) {
			$kondisi = array('nim' => $value['nim']);
			$this->siak_view->cohort = $this->siak_model->siak_edit($kondisi, "mahasiswa", "cohort");
		}
		$this->siak_view->siak_render('siak_rencana_studi/form_confirm_cuti', true);
	}

	public function confirm_cuti($id_cuti, $nim){
		$confirm = $this->siak_model->siak_query("update","update cuti set status = 1 where id_cuti = ".$id_cuti.";");
		if ($confirm == true) {
			$this->siak_model->siak_query("update","update mahasiswa set status = 3 where nim = ".$nim."; ");
		}
		header('location: ' . URL . 'siak_rencana_studi/tampil_cuti');
	}
}

?> 