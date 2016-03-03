<?php if ($this->rolepage['loads'] == "t") { ?>
	<div class="panel-body" >
		<div id="tabs">
			<ul>
				<li><a href="<?php echo URL; ?>siak_aturan_nilai/">Aturan Nilai</a></li>
				<li><a href="<?php echo URL; ?>siak_predikat/">Predikat</a></li>
			</ul>
		</div>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>