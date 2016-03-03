<?php if ($this->rolepage['loads'] == "t") { ?>
	<div class="panel-body" >
		<div id="tabs">
			<ul>
				<li><a href="<?php echo URL; ?>siak_universitas/">IDENTITAS UNIVERSITAS</a></li>
				<li><a href="<?php echo URL; ?>siak_badan_hukum/">BADAN HUKUM</a></li>
				<li><a href="<?php echo URL; ?>siak_fakultas/">FAKULTAS</a></li>
				<!-- <li><a href="<?php echo URL; ?>siak_prodidikti/">PRODI DIKTI</a></li> -->
			</ul>
		</div>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>