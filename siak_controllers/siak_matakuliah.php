<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak matakuliah controller class */

class Siak_matakuliah extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi = $_SESSION['prodi'];
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//echo "<pre>";print_r($this->siak_session->siak_getAll());echo"</pre>";
		
		$this->siak_view->config = "Siak Widyatama - Mata Kuliah Paket";
		
		$this->siak_view->judul = "Mata Kuliah Paket";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Matakuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Mata Kuliah Paket','href'=>'' .URL. 'siak_matakuliah'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		//Hak Akses
		$method_or_uri = 'siak_matakuliah';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_datalist();
	}

	public function siak_datalist(){
		$nim = $_SESSION['username'];
		$mhs = $this->siak_model->siak_query("select","select * from mahasiswa where nim = '$nim'");
		
		foreach($mhs as $row => $rec): $prodi_new = $rec['prodi_id']; endforeach;
		$prodi = explode(',', $this->prodi_id);
		
		$ada = (!in_array($prodi_new, $prodi)) ? "tidak ada":"ada";
		
// 		var_dump($this->prodi_id);
// 		die();
		
		if($this->prodi_id !='' && $ada == "tidak ada"){
		
			$kondisi = "AND prodi_id ='$this->prodi' ";
			
			
		}
		else if($this->prodi_id != '' && $ada == "ada"){
		
			$kondisi = "AND prodi_id = '$prodi_new'";
		
		}
		else{
			$kondisi = "";
		}
// 		var_dump($kondisi);die();
		$jenis = $this->siak_model->siak_data_list("jenismatkul","jenismatkul_id,nama_jenismatkul");
		foreach($jenis as $row => $value){
		      if($value['nama_jenismatkul'] == 'Umum' || $value['nama_jenismatkul'] == 'umum'){
			$umum = $value['jenismatkul_id'];
		      }
		}
		
// 		echo "SELECT * FROM matakuliah WHERE jenismatkul_id = $umum $kondisi";die();
		
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select","SELECT * FROM matakuliah WHERE jenismatkul_id = $umum $kondisi");
		$this->siak_view->siak_render('siak_matakuliah/data', false);
	}

	public function siak_add(){
		$this->siak_view->tahun = $this->siak_model->siak_data_list("tahun_akademik", "tahun_id,nama_tahun");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_data_jenis = $this->siak_model->siak_data_list("jenismatkul","jenismatkul_id,nama_jenismatkul");
		$this->siak_view->siak_render('siak_matakuliah/add', true);
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
		    mkdir($location);
		}
		
		
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
			$this->siak_model->siak_query("insert", "insert into uploadsilabus (matkul_id, nama_file, tahun_id) VALUES ('".$id_bobot."', '".$data_file[$i]."', '".$tahun[$i]."')");
		    }
		    else{
			echo '<script language="javascript">';
			echo 'alert("uploadfile salah extension")';  //not showing an alert box.
			echo '</script>';
			exit;
		    }
		    
		}
	    
		header('location: ' . URL . 'siak_matakuliah');
	}

	public function siak_datapop(){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("matakuliah", "*");
		$this->siak_view->siak_render('siak_matakuliah/popup', true);
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
		$this->siak_view->siak_render('siak_matakuliah/edit', true);
	}
	public function siak_view($matkul_id){
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->tahun = $this->siak_model->siak_data_list("tahun_akademik", "tahun_id,nama_tahun");
		$this->siak_view->siak_data_kurikulum = $this->siak_model->siak_data_list("kurikulum", "kurikulum_id,nama_kurikulum");
		$this->siak_view->siak_data_jenis = $this->siak_model->siak_data_list("jenismatkul","jenismatkul_id,nama_jenismatkul");
		$where = array('matkul_id' => $matkul_id);
		$where2 = array('matkul_id' => $matkul_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "matakuliah", "*");
		$this->siak_view->siak_data_komponen = $this->siak_model->siak_edit($where2, "uploadsilabus", "*");
		$this->siak_view->siak_render('siak_matakuliah/detail', true);
	}

	public function siak_detail($matkul_id){
		$where = array('matkul_id' => $matkul_id);
		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "matakuliah", "*");
		$this->siak_view->siak_render('siak_matakuliah/view', false);
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
		
// 		echo $prodi;die();
		
		$this->siak_model->siak_query("update", "update matakuliah set jenismatkul_id='$jenismatkul', kode_matkul='$kode', nama_matkul='$nama',en_matkul='$en',singkatan='$sing',sks='$skss',semester='$semes',pertemuan='$temu',penanggungjawab='$jawab',keterangan='$ket' where matkul_id = '$matkul_id';"); 
		
		///////////////////////////////////////////////////////////////////////////////////////
		//UPLOAD FILE
		///////////////////////////////////
		$fileTypes= array('doc','docx','pdf');
		$fileParts = $_FILES['uploaded_file']['name'];
		$id_upload=$_POST['upload_id'];
		$total = count($id_upload);
		$bykfile=count($fileParts);

		$location="siak_public/siak_silabus/".$prodi."_".$jenismatkul;
// 		echo $location;die();
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
		    mkdir($location);
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
			    $this->siak_model->siak_query("insert", "insert into uploadsilabus (matkul_id, nama_file, tahun_id) VALUES ('".$matkul_id."', '".$data_file[$i]."', '".$tahun[$i]."')");
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
// 			      echo "update uploadsilabus set nama_file= '".$data_file[$i]."', tahun_id = '".$tahun[$i]."' where upload_id = '".$id_upload[$i]."';";
// 			      die();
			      $this->siak_model->siak_query("update", "update uploadsilabus set nama_file= '".$data_file[$i]."', tahun_id = '".$tahun[$i]."' where upload_id = '".$id_upload[$i]."';");
				    
			  }
// 		      }else{
// 			  
// 		      }
		}
		///////////////////////////////////////////////////////////////////////////////////////
		
			
		header('location: ' . URL . 'siak_matakuliah');
	}

	public function siak_delete($matkul_id){
		$where = array('matkul_id' => $matkul_id);
		$this->siak_model->siak_delete($where);
		header('location: ' . URL . 'siak_matakuliah');
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

?>