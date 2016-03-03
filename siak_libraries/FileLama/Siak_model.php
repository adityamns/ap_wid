<?php

/* Main Siak Model Class */

class Siak_model {
	
	public $table = "";

	// Build a construct method
	function __construct(){
		$this->siak_db = new Siak_database();
	}
	
	function test($sql){
		$db = $this->siak_db->query($sql);
		return $db;
	}


	public function siak_login(){
		
		$statement = $this->siak_db->prepare("SELECT * FROM users WHERE username = :username");
		$statement->bindParam(':username' , $_POST['username'], PDO::PARAM_STR);
		$statement->execute();
		$count = $statement->rowCount();
		if ($count > 0) {
			foreach ($statement as $key) {
				if (password_verify($_POST['password'], $key['password']) && $key['status'] == "1") {
					$data    = $this->siak_query(
								      "select", 
								      "
									SELECT 
									  b.groups,
									  b.nama,
									  b.kode,
									  b.url,
									  b.parent,
									  a.loads,
									  a.creates,
									  a.reades,
									  a.updates,
									  a.deletes,
									  a.prodi_id 
									FROM 
									  role a,
									  modul b,
									  grup c,
									  users d 
									WHERE 
									  d.group_id = c.id AND 
									  c.id = a.group_id AND 
									  b.id = a.modul_id AND 
									  d.id = '".$key['id']."' AND 
									  b.status = '1' AND
									  b.parent IS NULL
									ORDER BY b.urutan ASC;
								      "
								    );
					$allowed = $this->siak_query(
								      "select",
								      "
									SELECT 
									  b.groups, 
									  b.nama_groups, 
									  b.ada_submenu,
									  min(b.urutan) as urutan 
									FROM 
									  role a, 
									  modul b, 
									  grup c, 
									  users d 
									WHERE 
									  d.group_id = c.id AND 
									  c.id = a.group_id AND 
									  b.id = a.modul_id AND 
									  d.id = '".$key['id']."' AND 
									  b.status = '1' 
									GROUP BY 
									  b.groups,
									  b.nama_groups,
									  b.ada_submenu 
									ORDER BY urutan,b.groups ASC;
								      "
								    );
					
			$mhs = "select view_mahasiswa.*, users.id as user_id from view_mahasiswa,users where users.username=view_mahasiswa.nim AND users.id = ".$key['id']." and nim = '".$key['username']."' ";
					
					$peg = "select *, grup.nama from users,grup where grup.id=users.group_id and users.id = '".$key['id']."'";
					
					$sql_profil = ($key['group_id'] == 16) ? $mhs:$peg;
					
					$profil = $this->siak_query("select",$sql_profil);
					
					Siak_session::siak_init();
					Siak_session::siak_set('role', $key['role']);
					Siak_session::siak_set('group', $key['group']);
					Siak_session::siak_set('username', $key['username']);
					Siak_session::siak_set('status', $key['status']);
					Siak_session::siak_set('loggedIn', true);
					Siak_session::siak_set('rule', $data);
					Siak_session::siak_set('allowed', $allowed);
					Siak_session::siak_set('id', $key['id']);
					Siak_session::siak_set('profil', $profil);
					Siak_session::siak_set('level', $key['group_id']);
					Siak_session::siak_set('prodi', $key['prodi_id']);
					header('location: ../siak_dashboard');
				}else{
					header('location: ../siak_login');
					exit();
				}
			}
		}else{
			header('location: ../siak_login');
			exit();
		}
	}

	public function siak_xhrInsert(){
		$options = array(
		    'cost' => 10,
		);
		$param = "";
		$value = array();
		$value2 = array();
		$valu = "";
		foreach ($_POST as $key => $val) {
			if ($key == "password") {
				$val = password_hash($val, PASSWORD_BCRYPT, $options);
			}
			$param .= $key.",";
			$valu  .= ":".$key.",";
			$value[":".$key] = $val;
			$value2[$key] = $val;
		}
		$field  =  substr($param, 0, sizeof($param) -2);
		$valu   =  substr($valu, 0, sizeof($valu) -2);
		$statement = $this->siak_db->prepare('INSERT INTO '.$this->table.' ('.$field.') VALUES('.$valu.')');
		$statement->execute($value);
	}

	public function siak_xhrEdit($where = array()){
		$options = array(
		    'cost' => 10,
		);
		$value = array();
		foreach ($_POST as $key=>$val) {
			if ($key == "password") {
				$val = password_hash($val, PASSWORD_BCRYPT, $options);
			}
			$field .= $key." = :".$key.",";
			$value[":".$key] = $val;
		}
		foreach ($where as $kunci => $nilai) {
			$value[":".$kunci] = $nilai;
			$kondisi .= $kunci." = :".$kunci." AND ";
		}
		$kondisi = substr($kondisi, 0, sizeof($kondisi) -6);
		$field   =  substr($field, 0, sizeof($field) -2);
		$statement = $this->siak_db->prepare('UPDATE '.$this->table.' SET '.$field.' WHERE '.$kondisi.' ;');
		$statement->execute($value);
	}

	public function siak_xhrGetListings(){
		$statement = $this->siak_db->prepare('SELECT * FROM '.$this->table.' ');
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$statement->execute();
		$data = $statement->fetchAll();
		echo json_encode($data);
	}

	public function siak_xhrDeleteListings(){
		$id = $_POST['id'];
		$statement = $this->siak_db->prepare('DELETE FROM '.$this->table.' WHERE id = "'.$id.'";');
		$statement->execute();
	}

	public function siak_query($act, $query){
	
		$statement = $this->siak_db->prepare($query);
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$statement->execute();
		if ($act == "select") {
			return $statement->fetchAll();
		}else{
			return true;
		}
	}

	public function siak_data_list($table, $field){
		$statement = $this->siak_db->prepare("SELECT ".$field." FROM ".$table." ");
		$statement->bindValue(':num', $num, PDO::PARAM_INT);
		$statement->bindValue(':offset', $offset, PDO::PARAM_INT);
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$statement->execute();
		return $statement->fetchAll();
	}

	public function siak_create(){
		$param = "";
		$value = array();
		$value2 = array();
		$valu = "";
		foreach ($_POST as $key=>$val) {
			$param .= $key.",";
			$valu  .= ":".$key.",";
			$value[":".$key] = $val;
			$value2[$key] = $val;
		}
		$field  =  substr($param, 0, sizeof($param) -2);
		$valu   =  substr($valu, 0, sizeof($valu) -2);
// 		echo 'INSERT INTO '.$this->table.' ('.$field.') VALUES('.$valu.') <br>'; 
// 		die();
		$statement = $this->siak_db->prepare('INSERT INTO '.$this->table.' ('.$field.') VALUES('.$valu.')');
// 		var_dump($value); die();
		$statement->execute($value);
	}
	
	////////////
	//HARI-HARI
	public function insert_data($data,$table){
	    $param = "";
	    $value = array();
	    $value2 = array();
	    $valu = "";
	    foreach ($data as $key=>$val) {
		    $param .= $key.",";
		    $valu  .= ":".$key.",";
		    $value[":".$key] = $val;
		    $value2[$key] = $val;
	    }
	    $field  =  substr($param, 0, sizeof($param) -2);
	    $valu   =  substr($valu, 0, sizeof($valu) -2);
	    
// 	    echo 'INSERT INTO '.$table.' ('.$field.') VALUES('.$valu.')'; //die();
	    
	    $statement = $this->siak_db->prepare('INSERT INTO '.$table.' ('.$field.') VALUES('.$valu.')');
	    
// 	    echo "<pre>";
// 	    var_dump($value);
// 	    echo "</pre>";die();
	    
	    $statement->execute($value);
	}
	///
	///////////

	public function siak_custom_create($tbl){
		$param = "";
		$value = array();
		$value2 = array();
		$valu = "";
		foreach ($_POST as $key=>$val) {
			$param .= $key.",";
			$valu  .= ":".$key.",";
			$value[":".$key] = $val;
			$value2[$key] = $val;
		}
		$field  =  substr($param, 0, sizeof($param) -2);
		$valu   =  substr($valu, 0, sizeof($valu) -2);
		$statement = $this->siak_db->prepare('INSERT INTO '.$tbl.' ('.$field.') VALUES('.$valu.')');
		$statement->execute($value);
	}


	public function siak_edit($where = array(), $table, $field){
		$val = array();
		foreach ($where as $key => $value) {
			$val[":".$key] = $value;
			$kondisi .= $key." = :".$key." AND ";
		}
		$kondisi = substr($kondisi, 0, sizeof($kondisi) -6);
		$statement = $this->siak_db->prepare('SELECT '.$field.' FROM '.$table.' WHERE '.$kondisi.' ;');
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		$statement->execute($val);
		return $statement->fetchAll();
	}

	public function siak_edit_save($where = array()){
		$value = array();
		foreach ($_POST as $key=>$val) {
// 			if($val != ''){
				// $field .= $key." = :".$key.",";
				$field .= $key." = '".$val."',";
				$value[":".$key] = $val;
// 			}
		}
		foreach ($where as $kunci => $nilai) {
			$value[":".$kunci] = $nilai;
			// $kondisi .= $kunci." = :".$kunci." AND ";
			$kondisi .= $kunci." = '".$nilai."' AND ";
		}
		$kondisi = substr($kondisi, 0, sizeof($kondisi) -6);
		$field   =  substr($field, 0, sizeof($field) -2);
		$statement = $this->siak_db->prepare('UPDATE '.$this->table.' SET '.$field.' WHERE '.$kondisi.' ;');
// 		echo 'UPDATE '.$this->table.' SET '.$field.' WHERE '.$kondisi.' ;'; die();
		$statement->execute();
	}

	public function siak_update_save($table, $where = array()){
// 		echo "<pre>";
// 		var_dump($_POST);
// 		echo "</pre>";
	
		if ($_POST['tgl_lahir'] == TRUE && $_POST['tgl_lahir'] == '') {
			$_POST['tgl_lahir'] = NULL;
		}
		
		$value = array();
		foreach ($_POST as $key=>$val) {
// 			if($val != ''){
				// $field .= $key." = :".$key.",";
				$field .= $key." = '".$val."',";
				$value[":".$key] = $val;
// 			}
		}
		foreach ($where as $kunci => $nilai) {
			$value[":".$kunci] = $nilai;
			// $kondisi .= $kunci." = :".$kunci." AND ";
			$kondisi .= $kunci." = '".$nilai."' AND ";
		}
		$kondisi = substr($kondisi, 0, sizeof($kondisi) -6);
		$field   =  substr($field, 0, sizeof($field) -2);
		$statement = $this->siak_db->prepare('UPDATE '.$table.' SET '.$field.' WHERE '.$kondisi.' ;');
// 		 echo 'UPDATE '.$table.' SET '.$field.' WHERE '.$kondisi.' ;'; die();
		$statement->execute();
	}


	public function siak_delete($where){
		// var_dump(Siak_session::siak_getAll()); die();
		foreach ($where as $kunci => $nilai) {
			$value[":".$kunci] = $nilai;
			$kondisi .= $kunci." = :".$kunci." AND ";
		}
		$kondisi = substr($kondisi, 0, sizeof($kondisi) -6);
		$statement = $this->siak_db->prepare('DELETE FROM '.$this->table.' WHERE '.$kondisi.' ;');
		$statement->execute($value);
	}

	public function siak_custom_delete($tbl, $where){
		foreach ($where as $kunci => $nilai) {
			$value[":".$kunci] = $nilai;
			$kondisi .= $kunci." = :".$kunci." AND ";
		}
		$kondisi = substr($kondisi, 0, sizeof($kondisi) -6);
		$statement = $this->siak_db->prepare('DELETE FROM '.$tbl.' WHERE '.$kondisi.' ;');
		$statement->execute($value);
	}


	public function siak_countall(){
		$statement = $this->siak_db->prepare('SELECT * FROM '.$this->table.';');
		$statement->execute();
		return $statement->rowCount();
	}
	public function siak_getfield($field, $table, $where){
		$output = "";
		$rs = $this->siak_db->query("select ".$field." from ".$table." where ".$where." limit 1");
		foreach ($rs as $kunci => $nilai) {
			$output = $nilai[$field];
		}
		return $output;
	}
	
	///////////// NOTIFIKASI
	//
	//
	function notifInsert($table, $nim, $jenis, $level){
	
		$tab = $this->cekTabs($table);
		$url = 'siak_master/siak_mahasiswa/'.$nim.'/'.$jenis.$tab;
		
		if($level == 16){
			$pesan = Siak_session::siak_get('username').' telah melakukan perubahan data '.strtoupper(str_replace("_", " ", $table));
		}else{
			$pesan = Siak_session::siak_get('username').' telah menyetujui perubahan data Anda';
		}
		
		$dt = new DateTime();
		$datetime = $dt->format('Y-m-d H:i:s');
		$data_notif = array(
				    'datetime2' => $datetime,
				    'url' => $url,
				    'description' => $pesan
				    );
		
		$this->insert_data($data_notif , "notification");
		
		$where = "datetime2 = '$datetime' ORDER BY id DESC";
		$id_notif = $this->siak_getfield("id", "notification", $where);
		
		if($level == 16){
			$sql_cek = "select id from users where group_id <> 16";
		}else{
			$sql_cek = "select id from users where group_id = 16 and username = '$nim'";
		}
		
		$users = $this->siak_query("select", $sql_cek);
	  
			foreach($users as $row => $user){
				$insert = "insert into notification_detail(id_notif, isread, table_name, table_field, table_value) values('".$id_notif."','f', 'users', 'id', '".$user['id']."')";
				$this->siak_query("insert" , $insert);
			}
	
	}
	
	function notifJadwal($jadwal, $url){
	
		$data = json_encode($jadwal);
		$x = json_decode($data);
		
// 		echo $data;
// 		die();
		$prodi_id = $x[0]->prodi_id;
		$kode_matkul = $x[0]->kode_matkul;
		
		$pesan = "Jadwal Matakuliah ".$kode_matkul." telah dirubah";
		
		$dt = new DateTime();
		$datetime = $dt->format('Y-m-d H:i:s');
		$data_notif = array(
				    'datetime2' => $datetime,
				    'url' => $url,
				    'description' => $pesan
				    );
		
		$this->insert_data($data_notif , "notification");
		
		$where = "datetime2 = '$datetime' ORDER BY id DESC";
		$id_notif = $this->siak_getfield("id", "notification", $where);
		
		$sql_cek = "select id from users where group_id = 16 and prodi_id = '$prodi_id'";
		$users = $this->siak_query("select", $sql_cek);
	  
		foreach($users as $row => $user){
			$insert = "insert into notification_detail(id_notif, isread, table_name, table_field, table_value) values('".$id_notif."','f', 'users', 'id', '".$user['id']."')";
			$this->siak_query("insert" , $insert);
		}
	}
	
	function notifAbsen($nim, $url){
		
		$pesan = "Anda( ".$nim." ) tidak mengikuti perkuliahan hari ini diharapkan untuk mengupload berkas/bukti keterngan Ketidakhadirannya ";
		
		$dt = new DateTime();
		$datetime = $dt->format('Y-m-d H:i:s');
		$data_notif = array(
				    'datetime2' => $datetime,
				    'url' => $url,
				    'description' => $pesan
				    );
		
// 		$this->insert_data($data_notif , "notification");
		
		$where = "datetime2 = '$datetime' ORDER BY id DESC";
		$id_notif = $this->siak_getfield("id", "notification", $where);
		
		$sql_cek = "select id from users where group_id = 16 and username = '$nim'";
		$users = $this->siak_query("select", $sql_cek);
		foreach($users as $nimi){
			$insert = "insert into notification_detail(id_notif, isread, table_name, table_field, table_value) values('".$id_notif."','f', 'users', 'id', '".$nimi."')";
			echo $insert."<br>";
// 			$this->siak_query("insert" , $insert);
		}
	}
	
	//
	//
	//////////////////////
	
	function cekTabs($table){
		//EDISI males ngoding :v
		if($table == "data_pribadi_umum" || $table == "data_pribadi_pns" ){ $tab = "#tab-pribadi"; }
		if($table == "keluarga" ){ $tab = "#tab-keluarga"; }
		if($table == "pendidikan_mahasiswa" ){ $tab = "#tab-pendidikan"; }
		if($table == "bahasa_asing" ){ $tab = "#tab-bahasa-asing"; }
		if($table == "kursus_latihan" ){ $tab = "#tab-kursus"; }
		if($table == "karya_ilmiah" ){ $tab = "#tab-karya"; }
		if($table == "seminar_ilmiah" ){ $tab = "#tab-seminar"; }
		if($table == "prestasi_mahasiswa" ){ $tab = "#tab-prestasi"; }
		if($table == "riwayat_pendidikan" ){ $tab = "#tab-riwayat-pen"; }
		if($table == "riwayat_pangkat" ){ $tab = "#tab-riwayat-pang"; }
		
		return $tab;
	}
	//

}

?>
