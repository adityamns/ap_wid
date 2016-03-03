<?php

class Siak_izin extends Siak_controller{
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->level = $_SESSION['level'];
	  
	}
	
	function index($nim, $cohort, $tgl){
		
// 		if($this->level == 16){
		
			if($nim == NULL){
				$whereNim = '';
			}else{
				$whereNim = "and abs.nim = '$nim'";
			}
			
			if($cohort == NULL){
				$whereTgl = '';
			}else{
				$whereTgl = "and abs.tanggal = '$tgl'";
			}
			
			if($tgl == NULL){
				$whereCoh = '';
			}else{
				$whereCoh = "and abs.cohort = '$cohort'";
			}
		
// 		}
		
		$sql = "
			select 
				abs.bukti_surat,
				abs.tanggal,
				abs.kode_matkul,
				abs.kode_topik,
				abs.status,
				abs.edit_id,
				matkul.nama_matkul
			from 
				absensi as abs,
				matakuliah as matkul
			where
				abs.kode_matkul = matkul.kode_matkul
				and abs.status <> 1
				$whereNim 
				$whereTgl
				$whereCoh
			";
			
		$this->siak_view->nim = $nim;
		$this->siak_view->tgl = $tgl;
		$this->siak_view->coh = $cohort;
		$this->siak_view->data = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render("siak_izin/index", false);
	}
	
	function upload($nim, $cohort, $tgl, $status){
	
		$this->siak_view->nim = $nim;
		$this->siak_view->tgl = $tgl;
		$this->siak_view->coh = $cohort;
		$this->siak_view->status = $status;
		
		$this->siak_view->siak_render("siak_izin/upload", true);
		
	}
	
	function update(){
		
		$url = URL."siak_izin/index/".$_POST['nim']."/".$_POST['cohort']."/".$_POST['tanggal'];
		
		if(isset($_FILES['bukti'])){
			if(is_uploaded_file($_FILES['bukti']['tmp_name'])) {
				$file_tmp = $_FILES['bukti']['tmp_name'];
				$path = "siak_public/siak_upload/Mahasiswa";
				$newpath = $path."/Bukti";
				
				$name = $_POST['nim'].'_'.$_FILES['bukti']['name'];
				
				if(is_dir($path)==false){
					$old_umask = umask(0);
					mkdir("$path", 0777);		// Create directory if it does not exist
					umask($old_umask);
					
					if(is_dir($newpath)==false){
						$old_umask = umask(0);
						mkdir("$newpath", 0777);		// Create directory if it does not exist
						umask($old_umask);
					}
					
				}
				
				$targetPath = $newpath.'/'.$name;
				move_uploaded_file($file_tmp,$targetPath);
			}else{
				echo "File tidak boleh KOSONG";
				echo '
				
				<form name="redirect">
				<center>
				<font face="Arial"><b>You will be redirected to the script in<br><br>
				<form>
				<input type="text" size="3" name="redirect2">
				</form>
				seconds</b></font>
				</center>
				
				<script>
				

				/*
				Count down then redirect script
				By JavaScript Kit (http://javascriptkit.com)
				Over 400+ free scripts here!
				*/

				//change below target URL to your own
				var targetURL="'.$url.'"
				//change the second to start counting down from
				var countdownfrom=10


				var currentsecond=document.redirect.redirect2.value=countdownfrom+1
				function countredirect(){
				if (currentsecond!=1){
				currentsecond-=1
				document.redirect.redirect2.value=currentsecond
				}
				else{
				window.location=targetURL
				return
				}
				setTimeout("countredirect()",1000)
				}

				countredirect()
				
				</script>
				
				';
				die();
			}
		}else{
			$name = 'tidak ada';
		}
		
		$sql_up = "update absensi set edit_id = '1', bukti_surat = '".$name."', status = '".$_POST['status']."' where nim = '".$_POST['nim']."' and cohort = '".$_POST['cohort']."' and tanggal = '".$_POST['tanggal']."';";
		
// 		echo $sql_up;
		$this->siak_model->siak_query("update", $sql_up);
		header('Location:'.$url);
	
	}
  
}