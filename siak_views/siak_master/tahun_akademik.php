<?php if ($this->rolepage['loads'] == "t") { ?>
	<div class="panel-body" >
		<div id="tabs">
			<ul>
				<li><a href="<?php echo URL; ?>siak_tahun_akademik/">TAHUN AKADEMIK</a></li>
			</ul>
		</div>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>