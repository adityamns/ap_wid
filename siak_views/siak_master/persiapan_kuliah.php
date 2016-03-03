<?php if ($this->rolepage['loads'] == "t") { ?>


	<div class="panel-body" >
		<div id="tabs">
<?php 
$sql = "select * from modul where parent = 'siak_persiapan_kuliah'";
$query = $this->db->siak_query("select",$sql);

// foreach(Siak_session::siak_get('allowed') as $key => $val) { 
//   $menu = "<ul>";
//   foreach($query as $key => $value) {
// 	  $menu .= "<li><a href='".URL.$value['url']."'>".$value['nama']."</a></li>";
//   }
//   echo $menu .= "</ul>";
// }
?>
			<ul>
				<li><a href="<?php echo URL; ?>siak_kurikulum/">KURIKULUM</a></li>
				<li><a href="<?php echo URL; ?>siak_jenismatkul/">JENIS MATKUL</a></li>
				<li><a href="<?php echo URL; ?>siak_matakuliah/">MATAKULIAH PAKET</a></li>
				<li><a href="<?php echo URL; ?>siak_matakuliah_pil">MATAKULIAH PILIHAN</a></li>
				<li><a href="<?php echo URL; ?>siak_topik/">TOPIK</a></li>
			</ul>
		</div>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>