<?php

/* Siak dashboard controller class */

class Siak_dashboard extends Siak_controller{
	
	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
		
		foreach ($this->siak_session->siak_getAll() as $key => $value) {
		
			$this->siak_view->loads = $value['loads'];
			$this->siak_view->creates = $value['creates'];
			$this->siak_view->reades  = $value['reades'];
			$this->siak_view->updates = $value['updates'];
			$this->siak_view->deletes = $value['deletes'];
			$this->siak_view->nama_modul = $value['nama_modul'];
			$this->siak_view->url_modul = $value['url'];
			$this->prodi_id = $value['prodi_id'];
				
		}
		
		$this->id_user = Siak_session::siak_get('id');
		$this->siak_breadcrumbs->add(array('title'=>'Beranda','href'=>'' . URL . 'siak_dashboard'));
	}

	function index(){
			$this->siak_view->config = 'Siak Widyatama - Beranda';
			
			$this->siak_breadcrumbs->add(array('title'=>'','href'=>'#'));
	
			if($_GET['tahun1']){
				$tahun=$_GET['tahun1'];
			}
			else{
				$now=date('Y');
				$tahun=$now ;
			}
		// $this->siak_view->siak_fakultas = $this->siak_model->siak_query("select", "select count(*) as jumlah,prodi.prodi,tahun_masuk, fakultas.fakultas,fakultas.fakultas_id from mahasiswa left join prodi on prodi.prodi_id=mahasiswa.prodi_id left join fakultas on fakultas.fakultas_id=prodi.fakultas_id where status=1 group by prodi.prodi,tahun_masuk,fakultas,fakultas.fakultas_id");
		// $this->siak_view->siak_tahun = $this->siak_model->siak_query("select", "select tahun_masuk from mahasiswa where status=1 group by tahun_masuk");
		// $this->siak_view->siak_prodi = $this->siak_model->siak_query("select", "select count(*) as jumlah,prodi.prodi,tahun_masuk, fakultas.fakultas,prodi.prodi_id from mahasiswa left join prodi on prodi.prodi_id=mahasiswa.prodi_id left join fakultas on fakultas.fakultas_id=prodi.fakultas_id where status=1 group by prodi.prodi,tahun_masuk,fakultas,prodi.prodi_id");
		// $this->siak_view->siak_render('siak_dashboard/index', false);
		
		/**** TABLE ****/
		// $this->siak_view->siak_fakultas = $this->siak_model->siak_query("select", "select *from fakultas order by fakultas_kd desc");
		// $this->siak_view->tahun = $this->siak_model->siak_query("select", "select tahun_masuk from mahasiswa where status=1 group by tahun_masuk order by tahun_masuk asc");
		// $this->siak_view->jumlah = $this->siak_model->siak_query("select", "select count(*) as jumlah,tahun_masuk, fakultas.fakultas,fakultas.fakultas_kd from mahasiswa left join prodi on prodi.prodi_id=mahasiswa.prodi_id left join fakultas on fakultas.fakultas_id=prodi.fakultas_id where status=1 group by tahun_masuk,fakultas,fakultas.fakultas_kd order by tahun_masuk asc");
		// $this->siak_view->siak_prodi = $this->siak_model->siak_query("select", "select count(*) as jumlah,prodi.prodi,tahun_masuk, fakultas.fakultas,prodi.prodi_id from mahasiswa left join prodi on prodi.prodi_id=mahasiswa.prodi_id left join fakultas on fakultas.fakultas_id=prodi.fakultas_id where status=1 group by prodi.prodi,tahun_masuk,fakultas,prodi.prodi_id");
		// $this->siak_view->siak_render('siak_dashboard/index', false);
		
		$this->siak_view->siak_fakultas = $this->siak_model->siak_query("select", "select count(*) as jumlah,tahun_masuk, fakultas.fakultas,fakultas.fakultas_kd from mahasiswa left join prodi on prodi.prodi_id=mahasiswa.prodi_id left join fakultas on fakultas.fakultas_id=prodi.fakultas_id where status=1 and tahun_masuk=$tahun group by tahun_masuk,fakultas,fakultas.fakultas_kd");
		$this->siak_view->siak_tahun = $this->siak_model->siak_query("select", "select tahun_masuk from mahasiswa where status=1 group by tahun_masuk order by tahun_masuk asc");
		$this->siak_view->siak_prodi = $this->siak_model->siak_query("select", "select count(*) as jumlah,tahun_masuk,prodi.prodi_id, fakultas.fakultas,fakultas.fakultas_kd from mahasiswa left join prodi on prodi.prodi_id=mahasiswa.prodi_id left join fakultas on fakultas.fakultas_id=prodi.fakultas_id where status=1 and tahun_masuk=$tahun group by tahun_masuk,fakultas,fakultas.fakultas_kd,prodi.prodi_id");
		$this->siak_view->jtahun=$tahun;
		
		$this->siak_view->siak_jadwal = $this->siak_model->siak_query("select", "SELECT nama,prodi,pertemuanke,nama_ruang,singkatan,prodi_id,kode_matkul,nama_matkul,semester, to_char(mulai,'HH24:MI') AS waktu_mulai,to_char(akhir,'HH24:MI') AS waktu_akhir,to_char(mulai,'YYYY-MM-DD') AS waktu,to_char(mulai,'DD') AS hari FROM view_jadwal_kuliah_notopik ORDER BY mulai desc ");
		
		$this->siak_view->judul = "Beranda";
		
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());

		$this->siak_view->siak_render('siak_dashboard/index', false);
		
	}

	function siak_logout(){
		$this->siak_session->siak_destroy();
		header('location: ../siak_login');
		exit();
	}

	function siak_locked(){
		$this->siak_session->siak_destroy();
		header('location: ../siak_locked');
		exit();
	}
	
	function user_detail($user_id){
	      
	      $sql = "
		      select * from users where id = '$user_id'
	      ";
	      $data = $this->siak_model->siak_query("select" ,$sql);
	      $this->siak_view->data = $data;
	      $this->siak_view->siak_render('gw_user/index', false);
	}
	
	function edit($id){
	      $sql = "select * from users where id = '$id'";
	      $edit = $this->siak_model->siak_query("select" , $sql);
	      
	      $this->siak_view->edit = $edit;
	      $this->siak_view->siak_render("gw_user/edit" , true);
	}
	
	function update(){
	      $id = $_POST['id'];
	      
	      $options = array(
                      	 'cost' => 10,
                      	 );
	      
	      $pass = password_hash($_POST['new_pass'], PASSWORD_BCRYPT, $options);
	      
	      $sql = "update users set password = '$pass' where id = '$id'";
	      $this->siak_model->siak_query("update" , $sql);
	      
	      header('location: ' . URL . 'siak_dashboard/user_detail/' . $id);
	}
	
	function notif(){
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		
		$html = "
			  <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-close-others=\"true\">
			  <i class=\"icon-warning-sign\"></i>";
		
		$dt = new DateTime();
		$datetime_new = $dt->format('Y-m-d H:i:s');
		$id = Siak_session::siak_get('id');
		$sql = "
			SELECT
				a.id,
				a.url,
				a.description,
				a.datetime2,
				b.table_name,
				b.table_field,
				b.table_value,
				b.isread
			FROM
				notification as a,
				notification_detail as b
			WHERE
				a.id = b.id_notif AND
				b.isread = false AND
				b.table_value = '$id'
			ORDER BY a.id DESC LIMIT 4
			  ";
		$sql_count = " select count(isread) from notification_detail where isread = false and table_value = '$id'";
		$data = $this->siak_model->siak_query("select", $sql);	
		$count = $this->siak_model->siak_query("select", $sql_count);
		$html .= "
			  <span class=\"badge\">".$count[0]['count']."</span>
			  </a>
			  <ul class=\"dropdown-menu extended notification\">
				  <li>";
				if($count[0]['count'] == 0){ 
		$html .= "
				<p>Tidak ada pemberitahuan baru</p>";
				
				} else {
		$html .= "
				<p>Anda mempunyai ".$jml." pemberitahuan baru yang belum dibaca</p>";
				} 
		$html .= "
			</li>
			<li>
				<ul class=\"dropdown-menu-list scroller\" style=\"height:250px\">";
				
			foreach($data as $row => $key){
			      
						if($key['isread'] == 0){
						$html .= " 
						<li>
						      <a href='".URL.$key['url']."' id=\"notip\" link='".$key['id']."' onclick=\"update(this)\">
							      <span class=\"btn green mini\">Baru<!--<i class=\"icon-plus\"></i>--></span>
							      ".$key['description']." pada 
							      <span class=\"time\">".$key['datetime2']."</span>
						      </a>
						</li>";
						}else{
						}
			}
		$html .= "	
				</ul>
			</li>
			<li class=\"external\">
				<a href='".URL.'allnotifikasi'."'>Lihat semua pemberitahuan <i class=\"m-icon-swapright\"></i></a>
			</li>
		</ul>";
		
// 		
		$json = json_encode(array('bihii'=>$html));
		echo "data: {$json}\n\n";
		
		flush();
	}
	
	function notifAjax(){
		$html = '
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
			  <i class="icon-warning-sign"></i>';
		
		$dt = new DateTime();
		$datetime_new = $dt->format('Y-m-d H:i:s');
		$id = Siak_session::siak_get('id');
		$sql = "
			SELECT
				a.id,
				a.url,
				a.description,
				a.datetime2,
				b.table_name,
				b.table_field,
				b.table_value
			FROM
				notification as a,
				notification_detail as b
			WHERE
				a.id = b.id_notif AND
				b.table_value = '$id'
			ORDER BY a.id DESC LIMIT 4
			  ";
		$sql_count = " select count(isread) from notification_detail where isread = false and table_value = '$id'";
		$data = $this->siak_model->siak_query("select", $sql);	
		$count = $this->siak_model->siak_query("select", $sql_count);
		$html .= '
			  <span class="badge">'.$count[0]['count'].'</span>
			  </a>
			  <ul class="dropdown-menu extended notification">
				  <li>';
				if($count[0]['count'] == 0){ 
		$html .= '
				<p>Tidak ada pemberitahuan baru</p>';
				
				} else {
		$html .= '
				<p>Anda mempunyai '.$jml.' pemberitahuan baru yang belum dibaca</p>';
				} 
		$html .= '
			</li>
			<li>
				<ul class="dropdown-menu-list scroller" style="height:250px">';
				
			foreach($data as $row => $key){
			      
		$html .= '
					<li>
						<a href="'.URL.$key['url'].'" id="notip" link="'.$key['id'].'" onclick="update(this)">
						<span class="btn green mini">Baru<!--<i class="icon-plus"></i>--></span>
						'.$key['description'].' pada
						<span class="time">'.$key['datetime2'].'</span>
						</a>
					</li>';
			}
		$html .= '	
				</ul>
			</li>
			<li class="external">
				<a href="'.URL.'allnotifikasi'.'">Lihat semua pemberitahuan <i class="m-icon-swapright"></i></a>
			</li>
		</ul>';
		
// 		echo $html;
		$json = json_encode(array('bihii'=>$html));
		echo "{$json}";
	}
	
	function update_notif($id){
		$sql = "update notification_detail set isread = true where id_notif = '".$id."' and table_value = '".$this->id_user."'";
		$this->siak_model->siak_query("update", $sql);
	}

	function pivot(){
		$this->siak_view->config = "Siak Unhan - Pivot";
	
		$this->siak_view->judul = "Pivot";
		
		$this->siak_breadcrumbs->add(array('title'=>'Pivot','href'=>''. URL . 'siak_dashboard/pivot'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		$this->siak_view->siak_render("pivot/index" , false);
	}
	
	function siak_query(){
		$this->siak_view->config = "Siak Unhan - Query Designer";
	
		$this->siak_view->judul = "Query Designer";
		
		$this->siak_breadcrumbs->add(array('title'=>'Query Designer','href'=>''. URL . 'siak_dashboard/siak_query'));
		$this->siak_view->set_breadcrumbs($this->siak_breadcrumbs->output());
		$this->siak_view->siak_render("query_designer/index", false);
	}
	
	function lapor(){
		$this->siak_view->data = $this->siak_model->siak_query("select","select * from laporbug where id = '5'");
		$this->siak_view->siak_render("siak_dashboard/lapor", true);
	}
	
	function laporBug(){
		$time = new DateTime();
		$now = date_format($time, 'Y-m-d H:i:s');
	
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		if(is_uploaded_file($_FILES['foto']['tmp_name'])) {
			$type = explode('/', $_FILES['foto']['type']);
			
			if($type[1] == "jpeg"){
				$type[1] = "jpg";
			}
			
			$file_type = $type[1];
			$sourcePath = $_FILES['foto']['tmp_name'];
			
			$path = "siak_public/siak_images/laporbug";
			$name = $_SESSION['username'].'.'.$file_type;
			
			
			if(is_dir($path)==false){
				$old_umask = umask(0);
				mkdir("$path", 0755);		// Create directory if it does not exist
				umask($old_umask);
			}
			
			$targetPath = $path.'/'.$name;
			
			$_POST['foto'] = $name;
			
			if(move_uploaded_file($sourcePath,$targetPath)) {
// 				echo 'sukses aplod';
			}
		}
		
		$data['from_ip'] = $ip;
		$data['using_browser'] = $_SERVER['HTTP_USER_AGENT'];
		$data['user'] = $_SESSION['username'];
		$data['user_id'] = $_SESSION['id'];
		$data['created_at'] = $now;
		
		$_POST['detail_user'] = json_encode($data);
		
		$this->siak_model->siak_custom_create("laporbug");
		
		echo 'Data berhasil terkirim';
		
	}
}

?>