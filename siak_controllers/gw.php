<?php

if ( ! defined('SIAK_SYSTEM')) exit('No direct script access allowed');

/* Siak users controller class */

class Gw extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		$this->rolePage = $this->siak_session->siak_getAll();
	}

	function index(){
		//Untuk Modul yang ada didalam tab gunakan role dari url utama -> misal : siak.com/siak_pengaturan
		//yang dipakai berarti siak_pengaturan
		//Atau Cara lainnya buatkan modul (set status == false) dan daftarkan/tambahkan pada masing" role semua modul yang didalam tab dan gunakan fungsi $this->uri->getUri(2)
		//untuk parameternya
		
		//Hak Akses
// 		$method_or_uri = 'siak_pengaturan'; //bila belum ditambahkan/dibuatkan modul
		$method_or_uri = $this->uri->getUri(1);
		$this->siak_view->rolePage = $this->uri->getRolePage($this->rolePage, $method_or_uri);
		//
		$this->siak_datalist();
// 		$this->siak_view->siak_render('gw/index', false);
	}

	public function siak_datalist(){
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_modul = $this->siak_model->siak_data_list("modul","*");
		
		$this->siak_view->siak_status = $this->siak_model->siak_data_list("status","*");
		$this->siak_view->siak_group = $this->siak_model->siak_data_list("grup","*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_query("select", "SELECT group_id, count(id) as jml_hak FROM role GROUP BY group_id;");
		$this->siak_view->siak_render('gw/index', true);
	}
	
	public function gw_add(){
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");
		$this->siak_view->siak_modul = $this->siak_model->siak_data_list("menu","*");
		
		$this->siak_view->siak_status = $this->siak_model->siak_data_list("status","*");
		$this->siak_view->siak_group = $this->siak_model->siak_data_list("grup","*");
		$this->siak_view->siak_data_list = $this->siak_model->siak_data_list("users", "id,username,group_id,status");
		
		$this->siak_view->siak_render('gw/add', true);
	}
	
	function tambah(){
		$id = $_POST['id'];
		$kd = $_POST['modul_kode'];
		
		$allow_read_i = $_POST['allow_read_i'];
		$allow_create_i = $_POST['allow_create_i'];
		$allow_update_i = $_POST['allow_update_i'];
		$allow_delete_i = $_POST['allow_delete_i'];
		$pribadi_i = $_POST['pribadi_i'];
		$group_id = $_POST['group_id'];
// 		
		foreach($id as $val => $key){
			$var = implode(",", $_POST['prodi_id'.$val]);
// 			echo "insert into role_new(modul_id,group_id,loads,creates,reades,updates,deletes,prodi_id) values($kd[$val],$group_id,'$pribadi_i[$val]','$allow_create_i[$val]','$allow_read_i[$val]','$allow_update_i[$val]','$allow_delete_i[$val]','$var') <br>";
			//query here
			//
			$this->siak_model->siak_query("insert", "insert into role(modul_id,group_id,loads,creates,reades,updates,deletes,prodi_id) values($kd[$val],$group_id,'$pribadi_i[$val]','$allow_create_i[$val]','$allow_read_i[$val]','$allow_update_i[$val]','$allow_delete_i[$val]','$var')");
		}
// die();
		header('location: ' . URL . 'siak_pengaturan/');
	}
	
	public function gw_edit($id){
// 		echo $id;
// 		die();
		$where = array('id' => $id);
		$this->siak_view->id = $id;
		$this->siak_view->prodi = $this->siak_model->siak_data_list("prodi", "prodi_id,prodi");	
		$this->siak_view->siak_modul = $this->siak_model->siak_data_list("menu","*");
		$this->siak_view->siak_group = $this->siak_model->siak_data_list("grup","*");
// 		$this->siak_view->siak_data = $this->siak_model->siak_edit($where, "role", "*");
// 		$sql = "select role_new.*, modul.nama from role_new, modul where role_new.modul_id = modul.id and group_id = '$id'";
		$this->siak_view->siak_data = $this->siak_model->siak_query("select","select role.*, menu.nama_modul from role, menu where role.modul_id = menu.id and group_id = '$id'");
// 		$this->siak_view->siak_data = $this->siak_model->siak_query("select",$sql);
		$this->siak_view->siak_render('gw/edit', true);
	}
	
	function gw_update(){
		$idx = $_POST['idx'];
		
		
		//update
		$allow_read = $_POST['allow_create'];
		$modul_id = $_POST['modul_id'];
		$role_id = $_POST['role_id'];
		//insert
		
		$allow_read_i = $_POST['allow_read_i'];
		$allow_create_i = $_POST['allow_create_i'];
		$allow_update_i = $_POST['allow_update_i'];
		$allow_delete_i = $_POST['allow_delete_i'];
		$pribadi_i = $_POST['pribadi_i'];
		$group_id = $_POST['grup_id'];
		$kd = $_POST['modul_kode'];
		
// 		var_dump($idx);die();
		
		$zx = 0;
		foreach($idx as $row => $val){
		
		$sql_insert = "insert into role(modul_id,group_id,loads,creates,reades,updates,deletes,prodi_id) values($modul_id[$row],$group_id,'$pribadi_i[$row]','$allow_create_i[$row]','$allow_read_i[$row]','$allow_update_i[$row]','$allow_delete_i[$row]','$drop_ins')";
		
			if($_POST['prodi_idX'.$row] == NULL){
			$zx++;
			      
			      //Update
			      $drop_up = implode("," ,$_POST['prodi_idX'.$zx]);
			      
			      if($_POST['prodi_idz'.$row] == NULL){
			      //Insert
			      $drop_ins = implode("," ,$_POST['prodi_idz'.($zx-$zx)]);
			      }else{
			      //Insert
			      $drop_ins = implode("," ,$_POST['prodi_idz'.($zx)]);
			      }
			      

			}else{
			      
			      //Update
			      $drop_up = implode("," ,$_POST['prodi_idX'.$row]);
			      
			      if($_POST['prodi_idz'.$row] == NULL){
			      //Insert
			      $drop_ins = implode("," ,$_POST['prodi_idz'.($row-$zx)]);
			      }else{
			      //Insert
			      $drop_ins = implode("," ,$_POST['prodi_idz'.($row)]);
			      }
			
			}
			
			$sql_update = "update role set loads = '$pribadi_i[$row]',creates = '$allow_create_i[$row]',reades = '$allow_read_i[$row]',updates = '$allow_update_i[$row]',deletes = '$allow_delete_i[$row]',prodi_id = '$drop_up' where id = '$role_id[$row]' and modul_id = '$modul_id[$row]'";
			
			if($_POST['prodi_idz'.$row] == NULL){
	// 		      //Insert
			      $drop_ins = implode("," ,$_POST['prodi_idz'.$zx]);
			      

			}else{
			      
	// 		      //Insert
			      $drop_ins = implode("," ,$_POST['prodi_idz'.$row]);
			
			}
		
			if($idx[$row] == NULL){

// 			      echo $sql_insert."<br>";
			      $this->siak_model->siak_query("insert",$sql_insert);
			      
			}else{
			
// 			      echo $sql_update."<br>";
			      $this->siak_model->siak_query("update",$sql_update);
			      
			}
		}
				
// 		die();
		header('location: ' . URL . 'siak_pengaturan');
	}
	
	function hapus_ajax(){
	    $id = $_POST['asd'];
	    
// 	    echo $id;die();
	    
	    $this->siak_model->siak_query("delete","delete from role where id = '$id'");
	}
      
	function gw_delete($id){
	    $this->siak_model->siak_query("delete","delete from role where group_id = '$id'");
	    header('location: ' . URL . 'siak_pengaturan');
	}
}
