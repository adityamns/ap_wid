<?php if ($this->rolepage['loads'] == "t") { ?>
	<div class="panel-body" >
		<div id="tabs">
			<ul>
				<li><a href="<?php echo URL; ?>siak_gedung/">Gedung</a></li>
				<li><a href="<?php echo URL; ?>siak_jenis_ruang/">Jenis Ruangan</a></li>
				<li><a href="<?php echo URL; ?>siak_ruang/">Ruangan</a></li>
			</ul>
		</div>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>