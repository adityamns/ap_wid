<?php if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

class Siak_upload extends Siak_controller{
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		$this->prodi = $_SESSION['prodi'];
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}
	
	function index(){
	
		$this->siak_view->config = "Siak Widyatama - Upload File";
		
		$this->siak_view->judul = "Upload File";
		
		$this->siak_breadcrumbs->add(array('title'=>'Data Master','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Data Matakuliah','href'=>'#'));
		$this->siak_breadcrumbs->add(array('title'=>'Upload File','href'=>'' .URL. 'siak_upload'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		
		//Hak Akses
		$method_or_uri = 'siak_upload';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$this->siak_view->data = $this->siak_model->siak_query("select", "select * from upload_master");
		$this->siak_view->siak_render('siak_upload/index', false);
	}
	
	public function siak_datalist($id_upload = false){
		$user_dir = Siak_session::siak_get('username'); // Digunain untuk nama direktori dan author
	
// 		$jenis = $this->siak_model->siak_data_list("jenismatkul","jenismatkul_id,nama_jenismatkul");
// 		foreach($jenis as $row => $value){
// 		      if($value['nama_jenismatkul'] == 'Pilihan' || $value['nama_jenismatkul'] == 'pilihan'){
// 			$pilihan = $value['jenismatkul_id'];
// 		      }
// 		}
// 		$this->siak_view->data_matakuliah = $this->siak_model->siak_query("select","SELECT * FROM matakuliah WHERE jenismatkul_id = $pilihan");
		if($this->prodi == TRUE){
			$prodiID = "where prodi_id = '$this->prodi'";
		}
		$this->siak_view->data_matakuliah = $this->siak_model->siak_query("select","SELECT * FROM matakuliah $prodiID");
		if($id_upload == TRUE)$id = $id_upload;
		$this->siak_view->data_silabus = $this->siak_model->siak_query("select", "select * from upload where author = '$user_dir' and jenis_upload_id = '$id'");
		$this->siak_view->id = $id;
		$this->siak_view->tahun = $this->siak_model->siak_data_list("tahun_akademik", "tahun_id,nama_tahun");
		$this->siak_view->data_prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->data_jenis_matkul = $this->siak_model->siak_data_list("jenismatkul","jenismatkul_id,nama_jenismatkul");
	}
	
	/////// HALAMAN SILABUS 
	public function data($jenis, $id, $char){
		$this->siak_view->char = $char;
		$this->siak_datalist($id);
		
		//Hak Akses
		$method_or_uri = 'siak_upload';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$master = $this->siak_model->siak_query("select", "select * from upload_master");
		foreach($master as $row => $key){
			if(strtolower($key['id']) == $id){
				$this->siak_view->siak_render('siak_upload/'.$jenis, true);
			}
		}
	}
	
	public function add_silabus($id){
		$this->siak_datalist($id);
		$this->siak_view->siak_render('siak_upload/add_silabus', true);
	}
	public function edit_silabus($id, $jenis){
		$this->siak_datalist($jenis);
		
		//Hak Akses
		$method_or_uri = 'siak_upload';
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		
		$user_dir = Siak_session::siak_get('username'); // Digunain untuk nama direktori dan author
		$sql = "select * from upload where author = '$user_dir' and upload_id = '$id'";
		$this->siak_view->edit = $this->siak_model->siak_query("select", $sql);
		$this->siak_view->siak_render('siak_upload/edit_silabus', true);
	}
	
	/// END HALAMAN SILABUS 
	////////////////////////
	
	/////// SIMPAN
	
	public function simpan(){
		
		$dir = $_POST['dir'];
		
		$split = explode(',',$_POST['kode_matkul']);
		$kode_matkul = $split[0];
		$matkul_id = $split[1];
		
		$tahun_id = $_POST['tahun_id'];
		$publish = $_POST['publish'];
		$jenis_upload_id = $_POST['jenis_upload_id'];
		
		$user_dir = Siak_session::siak_get('username'); // Digunain untuk nama direktori dan author
		
		//// Cek apakah user memilih direktori??
		if($dir == "" || $dir == "new"){
		    $desired_dir = "siak_public/siak_upload/".$user_dir;
		}else{
		    $desired_dir = $dir;
		}
		
		if(isset($_FILES['uploaded_file'])){
			$errors= array();
			
			foreach($_FILES['uploaded_file']['tmp_name'] as $key => $tmp_name ){
				$file_name = $_FILES['uploaded_file']['name'][$key];
// 				$file_size =$_FILES['uploaded_file']['size'][$key];
				$file_tmp =$_FILES['uploaded_file']['tmp_name'][$key];
// 				$file_type=$_FILES['uploaded_file']['type'][$key];
				
				if($file_size > 2097152){
					$errors[]='File size must be less than 2 MB';
				}
				
				$query="INSERT INTO upload(matkul_id, nama_file, tahun_id, kode_matkul, location, author, publish, jenis_upload_id) VALUES('$matkul_id','$file_name','$tahun_id[$key]','$kode_matkul', '$desired_dir', '$user_dir', '$publish[$key]', '$jenis_upload_id'); ";
				
// 				$desired_dir = $location;
				
				if(empty($errors)==true){
				    if(is_dir($desired_dir)==false){
					$old_umask = umask(0);
					mkdir("$desired_dir", 0755);		// Create directory if it does not exist
					umask($old_umask);
				    }
				    
// 				    if(is_dir("$desired_dir/".$file_name)==false){
// 					move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
// 				    }else{									// rename the file if another one exist
// 					$new_dir="$desired_dir/".$file_name.time();
// 					rename($file_tmp,$new_dir) ;				
// 				    }
				    
				    
				    if(is_dir("$desired_dir/".$file_name) == TRUE || file_exists("$desired_dir/".$file_name)){ // rename the file if another one exist
					$new_dir="$desired_dir/new_".$file_name;
					rename($file_tmp,$new_dir) ;				
				    }else{									
					move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
				    }
				    
					$this->siak_model->siak_query("insert", $query);	// insert data to database
// 					echo $query."<br>";
					
				}else{
					print_r($errors);
				}
			}
			
			if(empty($error)){
// 				echo "Success";
				header('location: ' . URL . 'siak_upload');
			}
		}
		
	}
	
	/// END SIMPAN
	////////////////////////
	
	/////// UPDATE
	
	public function update(){
		
		$upload_id = $_POST['upload_id'];
		$old_dir = $_POST['old_dir'];
		$old_file = $_POST['old_file'];
		$dir = $_POST['dir'];
		
		$split = explode(',',$_POST['kode_matkul']);
		$kode_matkul = $split[0];
		$matkul_id = $split[1];
		
		$tahun_id = $_POST['tahun_id'];
		$publish = $_POST['publish'];
		
		$file_name = $_FILES['uploaded_file']['name'];
		$file_tmp =$_FILES['uploaded_file']['tmp_name'];
		
		$user_dir = Siak_session::siak_get('username'); // Digunain untuk nama direktori dan author
		
		//// Cek apakah user memilih direktori??
		if($dir == "" || $dir == "new"){
		    $desired_dir = "siak_public/siak_upload/".$user_dir;
		}else{
		    $desired_dir = $dir;
		}
		
// 		echo $dir;die();
		
		if(isset($_FILES['uploaded_file'])){ // Kalo file aplod Aktif
		/// Kalo ganti File
		
			if($old_dir != $desired_dir){
				$xc = array_diff(scandir($old_dir), array('..', '.'));
				foreach($xc as $kl){
					if($kl == $old_file){ // Hapus file didirektori lama dan aplod file ke direktori baru
						unlink($old_dir."/".$kl); // komen ini kalo ga mau apus file lama
						
						if(is_dir("$desired_dir/".$file_name) == TRUE || file_exists("$desired_dir/".$file_name)){ // rename the file if another one exist
						    $new_dir="$desired_dir/new_".$file_name;
						    rename($file_tmp,$new_dir) ;				
						}else{
						    move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
						}
					}
				}
				
// 				echo "<br> Siap upload file baru.<br>";
				$sql_up = "update upload set matkul_id = '$matkul_id', nama_file = '$file_name', kode_matkul = '$kode_matkul', location = '$desired_dir', author = '$user_dir', publish= '$publish' where upload_id = '$upload_id'";
// 				echo $sql_up;
												
			}else{
				
				$xc = array_diff(scandir($old_dir), array('..', '.'));
				foreach($xc as $kl){
					if($kl == $old_file){ // Hapus file didirektori lama dan aplod file ke direktori baru
						unlink($desired_dir."/".$old_file); // komen ini kalo ga mau apus file lama
						
						if(is_dir("$desired_dir/".$file_name) == TRUE || file_exists("$desired_dir/".$file_name)){ // rename the file if another one exist
						    $new_dir="$desired_dir/new_".$file_name;
						    rename($file_tmp,$new_dir) ;				
						}else{
						    move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
						}
					}
				}
				
				$sql_up = "update upload set matkul_id = '$matkul_id', nama_file = '$file_name', kode_matkul = '$kode_matkul', location = '$old_dir', author = '$user_dir', publish= '$publish' where upload_id = '$upload_id'";
// 				echo $sql_up;
// 				
// 				echo $dir;
			
			}
		}else{ // Kalo file aplod Tidak Aktif
		/// Kalo File ga diganti
		
			if($old_dir != $dir){ // Kalo ganti Direktori
				$xc = array_diff(scandir($old_dir), array('..', '.'));
				foreach($xc as $kl){
					if($kl == $old_file){
	// 					unlink($location."/".$kl);
						rename("$old_dir/".$old_file,"$dir/".$old_file);
// 						echo "Direktori diganti, file lama dipindah ke- ".$dir;
					}
				}
				
// 				echo "<br> Siap pindah dir baru.<br>";
				$sql_up = "update upload set matkul_id = '$matkul_id', nama_file = '$old_file', kode_matkul = '$kode_matkul', location = '$dir', author = '$user_dir', publish= '$publish' where upload_id = '$upload_id'";
// 				echo $sql_up;
												
			}else{ // Kalo TIDAK ganti Direktori
			
				$sql_up = "update upload set matkul_id = '$matkul_id', nama_file = '$old_file', kode_matkul = '$kode_matkul', location = '$old_dir', author = '$user_dir', publish= '$publish' where upload_id = '$upload_id'";
// 				echo $sql_up;
			
			}
			
		}
		$this->siak_model->siak_query("update", $sql_up);
		header('location: ' . URL . 'siak_upload');
	}
	
	/// END SIMPAN
	////////////////////////
	
	/////// CREATE DIR
	
	function create_dir($user_dir, $jenis){
		$dir = $_POST['new_dir'];
		$location = "siak_public/siak_upload/".$user_dir."/".$jenis;
		if (is_dir($location) == false) {
		    $old_umask = umask(0);
		    mkdir($location, 0755, true);
		    umask($old_umask);
		    if (is_dir($location."/".$dir) == false) {
			$old_umask = umask(0);
			mkdir($location."/".$dir, 0755, true);
			umask($old_umask);
		    }
		}else{
		    if (is_dir($location."/".$dir) == false) {
			$old_umask = umask(0);
			mkdir($location."/".$dir, 0755, true);
			umask($old_umask);
		    }
		}
	}
	
	function cekDir($jenis){ // for xml request
		$user = Siak_session::siak_get('username');
		$temp_dir = "siak_public/siak_upload/".$user."/".$jenis;
		$dir = array_diff(scandir($temp_dir), array('..', '.'));
		
		$html = '<select class="m-wrap span12" name = "dir" id="dir">
			 <option value="">--Pilih--</option>
			  ';
			foreach ($dir as $key) {
			    if(is_dir($temp_dir."/".$key) == FALSE){
				  $html .= '';
			    }else{
				  $html .= "<option value='$temp_dir/$key'>$key</option>";
			    }
			}
		$html .= '<option value="new" style="background-color:red; color:white">Buat Direktori Baru</option>
			  </select>';
		echo $html;
	}
	
	/// END CREATE DIR
	////////////////////////
	
	/////// HAPUS
	
	function hapus($id, $old_dir, $old_file){
		$sql_del = "delete from upload where upload_id = '$id'";
		$x = explode('-', $old_dir); // pecah tanda (-) jadi array
		$new_dir = implode('/', $x); // gabungkan array dengan tanda (/)
// 		echo $new_dir;
		$xc = array_diff(scandir($new_dir), array('..', '.'));
		foreach($xc as $kl){
			if($kl == $old_file){ // Hapus file didirektori lama dan aplod file ke direktori baru
				unlink($new_dir."/".$kl); // komen ini kalo ga mau apus file lama
			}
		}
		
		$this->siak_model->siak_query("delete", $sql_del);
		header('location: ' . URL . 'siak_upload');
// 		echo $sql;
// 		die();
	}
	
	/// END CREATE DIR
	////////////////////////
}