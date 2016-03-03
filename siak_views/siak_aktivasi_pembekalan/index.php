<?php //var_dump($this->mahasiswa); die(); ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Aktivasi Pembekalan</div>
	</div>
	<div class="portlet-body">
	
	<table id="aktivasi_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>NO</td>
				<td>TAHUN MASUK</td>
				<td>JUMLAH MAHASISWA</td>
				<td>ACTION</td>
			</tr>
		</thead>
		<tbody>	
			<?php
			$i = 0;
			foreach ($this->mahasiswa as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td>" . $value['tahun_masuk'] . "</td>";
				echo "<td><a href = '".URL."siak_aktivasi_pembekalan/siak_mahasiswa/".$value['tahun_masuk']."'>" . $value['jml_mhs'] . "</a></td>";
				// if ($value['pembekalan']==2) {
				// 	echo "<td align = 'center'> <a href = '".URL."siak_aktivasi_pembekalan/siak_set/".$value['tahun_masuk']."'> Aktifkan Pembekalan </a></td>";
				// }elseif($value['pembekalan']==1) {
				// 	echo "<td align = 'center'> <a href = '".URL."siak_aktivasi_pembekalan/siak_unset/".$value['tahun_masuk']."'> NonAktifkan Pembekalan </a></td>";
				// }
				echo $value['pembekalan']==0?"<td align = 'center'> <a class='btn green mini' href = '".URL."siak_aktivasi_pembekalan/siak_set/".$value['tahun_masuk']."'> Aktifkan Pembekalan </a>":"<td align = 'center'> <a class='btn red mini' href = '".URL."siak_aktivasi_pembekalan/siak_unset/".$value['tahun_masuk']."'> NonAktifkan Pembekalan </a>";
				echo "</td></tr>";
			}
			?>
		</tbody>
	</table>
	
	</div>
	<div id="addGed" class="modal hide fade in" >
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Tambah Data</h3>
		</div>
		<div id="addUsers">
		
		</div>
	</div>

	<div id="editGed" class="modal hide fade in">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Edit Data</h3>
		</div>
		<div id="editUsers">
		
		</div>
	</div>
	
	<div id="hapusGed" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Hapus Data</h3>
		</div>
		<div class="modal-body">
			<span id="data"></span>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Batal</button>
			<a type="button" class="btn green" id="hapus" href="#">Hapus</a>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $('#aktivasi_pembekalan').DataTable();
});

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_gedung/siak_delete/"+id);
}
</script>