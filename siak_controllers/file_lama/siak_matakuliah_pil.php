<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak matakuliah controller class */

class Siak_matakuliah_pil extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi = $_SESSION['prodi'];
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
			if ($value['groups'] == "master" && $value['kode'] == "matkul") {
				$this->siak_view->loads = $value['loads'];
				$this->siak_view->creates = $value['creates'];
				$this->siak_view->reades  = $value['reades'];
				$this->siak_view->updates = $value['updates'];
				$this->siak_view->deletes = $value['deletes'];
				$this->prodi_id = $value['prodi_id'];
				
			}
		}
	}

	function index(){
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$nim = $_SESSION['username'];
		$mhs = $this->siak_model->siak_query("select","select * from mahasiswa where nim = '$nim'");
		
		foreach($mhs as $row => $rec): $prodi_new = $rec['prodi_id']; endforeach;
		$prodi = explode(',', $this->prodi_id);
		
		$ada = (!in_array($prodi_new, $prodi)) ? "tidak ada":"ada";
		
		if($this->prodi_id !='' && $ada == "tidak ada"){
		
			$kondisi = "AND prodi_id ='$this->prodi' ";
			
			
		}
		else if($this->prodi_id != '' && $ada == "ada"){
		
			$kondisi = "AND prodi_id = '$prodi_new'";
		
		}
		else{
			$kondisi = "";
		}
		
		$jenis = $this->siak_model->siak_data_list("jenismatkul","jenismatkul_id,nama_jenismatkul");
		foreach($jenis as $row => $value){
		      if($value['nama_jenismatkul'] == 'Pilihan' || $value['nama_jenismatkul'] == 'pilihan'){
			$pilihan = $value['jenismatkul_id'];
		      }
		}
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","SELECT * FROM matakuliah WHERE jenismatkul_id = $pilihan $kondisi");
		/*
		var_dump($this->siak_view->siak_data_list);
		die();*/
		$this->siak_view->siak_render('siak_matakuliah_pil/data', false);
	}

	public function siak_add(){
		$this->siak_view->tahun = $this->siak_model->siak_data_list("tahun_akademik", "tahun_id,nama_tahun");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data_jenis = $this->siak_model->siak_data_list("jenismatkul","jenismatkul_id,nama_jenismatkul");
		$this->siak_view->siak_render('siak_matakuliah_pil/add', true);
	}

	public function siak_create(){
		$prodi=$_POST['prodi_id'];
		$kurikulum=$_POST['kurikulum_id'];
		$kode=$_POST['kode_matkul'];
		$nama=$_POST['nama_matkul'];
		$en=$_POST['en_matkul'];
		$sing=$_POST['singkatan'];
		$jenismatkul=$_POST['jenismatkul_id'];
		$skss=$_POST['sks'];
		$semes=$_POST['semester'];
		$temu=$_POST['pertemuan'];
		$jawab=$_POST['penanggungjawab'];
		$ket=$_POST['keterangan'];
		
// 		echo "<pre>";
// 		var_dump($_POST);
// 		echo "</pre>";
		
// 		echo "insert", "insert into matakuliah (kurikulum_id, prodi_id, jenismatkul_id, kode_matkul, nama_matkul,en_matkul,singkatan,sks,semester,pertemuan,penanggungjawab,keterangan) VALUES ('$kurikulum','$prodi','$jenismatkul','$kode','$nama','$en','$sing','$skss','$semes','$temu','$jawab','$ket')";
// 		die();
		
		$tahun=$_POST['tahun_id'];
		$total = count($_POST['tahun_id']);
		
		$this->siak_model->siak_query("insert", "insert into matakuliah (kurikulum_id, prodi_id, jenismatkul_id, kode_matkul, nama_matkul,en_matkul,singkatan,sks,semester,pertemuan,penanggungjawab,keterangan) VALUES ('$kurikulum','$prodi','$jenismatkul','$kode','$nama','$en','$sing','$skss','$semes','$temu','$jawab','$ket')");
		
		$id=$this->siak_model->siak_query("select","SELECT matkul_id FROM matakuliah ORDER BY matkul_id DESC LIMIT 1");
		foreach ($id as $key => $ida ){
			$id_bobot=$ida['matkul_id'];
		}
		
		$fileTypes= array('doc','docx','pdf');
		$fileParts = $_FILES['uploaded_file']['name'];
		
		$bykfile=count($fileParts);
		
		$location="siak_public/siak_silabus/".$prodi."_".$jenismatkul;
		
		//Create folder
		if (is_dir($location) == false) {
		    $old_umask = umask(0);
		    mkdir($location, 0777);
		    umask($old_umask);
		}
		
// 		var_dump($bykfile);
		
		for($i=0; $i< $bykfile; $i++){
		    $file = $_FILES['uploaded_file']['name'][$i];
		    $tmp  = $_FILES['uploaded_file']['tmp_name'][$i];
		    $fileinfo = pathinfo($_FILES['uploaded_file']['name'][$i]);
		    
		    //cek file extension
		    if(in_array($fileinfo['extension'], $fileTypes) && $file !=""){
			//Ceck duplicate file
			$data_dir = $location."/".$fileParts[$i];
			if(file_exists($data_dir)){
			      $data = "copy_".$file;
			      $data_file[] = "copy_".$fileParts[$i];
			      
			}else{
			      $data = $file;
			      $data_file[] = $fileParts[$i];
			}
			
			//Move Uploaded file from $tmp to Directory
			move_uploaded_file($tmp,"$location/$data");
			
// 			echo "insert into uploadsilabus (matkul_id, nama_file, tahun_id) VALUES ('".$id_bobot."', '".$data_file[$i]."', '".$tahun[$i]."')";
			//Insert multiple data file
			$this->siak_model->siak_query("insert", "insert into uploadsilabus (matkul_id, nama_file, tahun_id) VALUES ('".$id_bobot."', '".$data_file[$i]."', '".$tahun[$i]."')");
		    }
		    else{
			echo '<script language="javascript">';
			echo 'alert("uploadfile salah extension")';  //not showing an alert box.
			echo '</script>';
			exit;
		    }
		    
		}
// 		die();
		header('location: ' . URL . 'siak_matakuliah_pil');
	}

	public function siak_datapop(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("matakuliah", "*");
		$this->siak_view->siak_render('siak_matakuliah_pil/popup', true);
	}
	
	public function siak_edit($matkul_id){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->tahun = $this->siak_model->siak_data_list("tahun_akademik", "tahun_id,nama_tahun");
		$this->siak_view->siak_data_kurikulum = $this->siak_model->siak_data_list("kurikulum", "kurikulum_id,nama_kurikulum");
		$this->siak_view->siak_data_jenis = $this->siak_model->siak_data_list("jenismatkul","jenismatkul_id,nama_jenismatkul");
		$where = array('matkul_id' => $matkul_id);
		$where2 = array('matkul_id' => $matkul_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "matakuliah", "*");
		$this->siak_view->siak_data_komponen = $this->siak_model->siak_edit($where2, "uploadsilabus", "*");
		$this->siak_view->siak_render('siak_matakuliah_pil/edit', true);
	}

	public function siak_detail($matkul_id){
		$where = array('matkul_id' => $matkul_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "matakuliah", "*");
		$this->siak_view->siak_render('siak_matakuliah_pil/view', false);
	}

	public function siak_edit_save($matkul_id){
		//var_dump($_POST);die();
		$prodi=$_POST['prodi_id'];
		$kurikulum=$_POST['kurikulum_id'];
		$kode=$_POST['kode_matkul'];
		$nama=$_POST['nama_matkul'];
		$en=$_POST['en_matkul'];
		$sing=$_POST['singkatan'];
		$jenismatkul=$_POST['jenismatkul_id'];
		$skss=$_POST['sks'];
		$semes=$_POST['semester'];
		$temu=$_POST['pertemuan'];
		$jawab=$_POST['penanggungjawab'];
		$ket=$_POST['keterangan'];
		
		$tahun=$_POST['tahun_id'];
		
// 		$this->siak_model->siak_query("update", "update matakuliah set jenismatkul_id='$jenismatkul', kode_matkul='$kode', nama_matkul='$nama',en_matkul='$en',singkatan='$sing',sks='$skss',semester='$semes',pertemuan='$temu',penanggungjawab='$jawab',keterangan='$ket' where matkul_id = '$matkul_id';"); 
		
		///////////////////////////////////////////////////////////////////////////////////////
		//UPLOAD FILE
		///////////////////////////////////
		$fileTypes= array('doc','docx','pdf');
		$fileParts = $_FILES['uploaded_file']['name'];
		$id_upload=$_POST['upload_id'];
		$total = count($id_upload);
		$bykfile=count($fileParts);

		$location="siak_public/siak_silabus/".$prodi."_".$jenismatkul;
		
// 		var_dump($fileParts);echo "<br>";
// 		
// 		if(empty($fileParts) != FALSE){
// 		    var_dump(empty($fileParts));
// 		    echo "ISI";die();
// 		}else{
// 		    var_dump(empty($fileParts));
// 		    echo "KOSONG";die();
// 		}
		
		//Create folder
		if (is_dir($location) == false) {
		    $old_umask = umask(0);
		    mkdir($location, 0777);
		    umask($old_umask);
		}
// 		echo $location;die();

		$where2 = array('matkul_id' => $matkul_id);
		$data = $this->siak_model->siak_edit($where2, "uploadsilabus", "*");
		
		if($data == NULL){//Kalo data kosong
		    ///Insert File
		    for($i=0; $i< $bykfile; $i++){
			$file = $_FILES['uploaded_file']['name'][$i];
			$tmp  = $_FILES['uploaded_file']['tmp_name'][$i];
			$fileinfo = pathinfo($_FILES['uploaded_file']['name'][$i]);
			
			//cek file extension
			if(in_array($fileinfo['extension'], $fileTypes) && $file !=""){
			    //Ceck duplicate file
			    $data_dir = $location."/".$fileParts[$i];
			    if(file_exists($data_dir)){
				  $data = "copy_".$file;
				  $data_file[] = "copy_".$fileParts[$i];
				  
			    }else{
				  $data = $file;
				  $data_file[] = $fileParts[$i];
			    }
			    
			    //Move Uploaded file from $tmp to Directory
			    move_uploaded_file($tmp,"$location/$data");
			    
			    //Insert multiple data file
// 			    $this->siak_model->siak_query("insert", "insert into uploadsilabus (matkul_id, nama_file, tahun_id) VALUES ('".$matkul_id."', '".$data_file[$i]."', '".$tahun[$i]."')");
			}
			else{
			    echo '<script language="javascript">';
			    echo 'alert("uploadfile salah extension")';  //not showing an alert box.
			    echo '</script>';
			    exit;
			} 
		    }
		    
		}else{
		
		    //Cek Apa file diganti/tidak
		    //
// 		      if(empty($fileParts) != FALSE){
		      
// 			  echo "<script>alert('ISI')</script>";die();
			  
			  //Remove File lama
			  $xc = array_diff(scandir($location), array('..', '.'));
			  foreach($xc as $kl){
				  unlink($location."/".$kl);
			  }
			  
			  for($i=0; $i< $bykfile; $i++){
			      $file = $_FILES['uploaded_file']['name'][$i];
			      $tmp  = $_FILES['uploaded_file']['tmp_name'][$i];
			      $fileinfo = pathinfo($_FILES['uploaded_file']['name'][$i]);
			      
			      $data_dir = $location."/".$fileParts[$i];
			      
			      
			      if(file_exists($data_dir)){
				    $data = "copy_".$file;
				    $data_file[] = "copy_".$fileParts[$i];
				    
			      }else{
				    $data = $file;
				    $data_file[] = $fileParts[$i];
			      }
			      
			      //Move Uploaded file from $tmp to Directory
			      move_uploaded_file($tmp,"$location/$data");
			      
			      //Update multiple
// 			      $this->siak_model->siak_query("update", "update uploadsilabus set nama_file= '".$data_file[$i]."', tahun_id = '".$tahun[$i]."' where upload_id = '".$id_upload[$i]."';");
				    
			  }
// 		      }else{
// 			  
// 		      }
		}
		///////////////////////////////////////////////////////////////////////////////////////
		
		die();
// 		header('location: ' . URL . 'siak_matakuliah_pil');
	}

	public function siak_delete($matkul_id){
		$where = array('matkul_id' => $matkul_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_matakuliah_pil');
	}
	public function kurikulum($prodi){
		$siak_data_list = $this->siak_model->siak_query("select", 'SELECT * FROM kurikulum ; ');
		$html = '<select class="m-wrap span12" name="kurikulum_id">';
			foreach($siak_data_list as $key => $val){
			$prodi_new = explode(',', $val['prodi_id']);
			if (in_array($prodi, $prodi_new)) {
				$html .= "<option value='".$val['kurikulum_id']."'>".$val['nama_kurikulum']."</option>";
			} }
		$html .= '</select>';
		echo $html;
	}

	public function UploadFile($fupload_name){

		 $vdir_upload = "siak_public/siak_silabus/";
  		 $vfile_upload = $vdir_upload . $fupload_name;
  		 $tipe_file   = $_FILES['fupload']['type'];

  		//Simpan gambar dalam ukuran sebenarnya
  		 move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	}
}
