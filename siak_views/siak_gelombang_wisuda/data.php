<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Setting Wisuda</div>
			</div>

			<div class="portlet-body">

				<div class="input-group">
					<a class=" btn purple btn-large" href="#addM" data-toggle="modal" link="<?php echo URL; ?>siak_gelombang_wisuda/siak_add/" onclick="addModul(this)">Tambah</a>
				</div>
				<hr>

				<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
					<thead>
						<tr align = "center">
							<td rowspan="2">NO</td>
							<td rowspan="2">NAMA</td>
							<td colspan="2">TANGGAL</td>
							<td rowspan="2">TAHUN</td>
							<td rowspan="2">ACTION</td>
						</tr>
						<tr align = "center">
							<td>MULAI</td>
							<td>SELESAI</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($this->siak_data_list as $key => $value) {
							$i++;
							$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
							$tahun 	= substr($value['tanggal_mulai'], 0, 4);
							$tahun1 = substr($value['tanggal_selesai'], 0, 4);
							$bulan 	= substr($value['tanggal_mulai'], 5, 2);
							$bulan1 = substr($value['tanggal_selesai'], 5, 2);
							$tgl   	= substr($value['tanggal_mulai'], 8, 2);
							$tgl1   = substr($value['tanggal_selesai'], 8, 2);
							$tanggalmulai 	= $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
							$tanggalselesai = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;
							echo "<tr class='active'>";
							echo "<td align = 'center'>" . $i . "</td>";
							echo "<td>" . $value['nama'] . "</td>";
							echo "<td>" . $tanggalmulai . "</td>";
							echo "<td>" . $tanggalselesai . "</td>";
							echo "<td>" . $value['tahun'] . "</td>";

							// echo $this->updates=="t"?"<td align = 'center'> <a id='variousX$i' href = '".URL."siak_gelombang_wisuda/siak_edit/".$value['kode']."'> <span class='glyphicon glyphicon-edit'></span> </a>&nbsp <a href = '".URL."siak_gelombang_wisuda/siak_delete/".$value['kode']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a></td>":"";
							echo "<td align = 'center'>
							<a class='btn blue mini' data-toggle='modal' data-target='#editM' onclick='edit(this)' link= '".URL."siak_gelombang_wisuda/siak_edit/".$value['kode']."'><i class='icon-edit'></i> Ubah</a>";
							echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusM" onclick="kirim_id(\''.$value['kode'].'\',\''.$value['nama'].'\')"><i class="icon-trash"></i> Hapus</a>
							</td>';
							echo "</tr>";
						}
						?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>

<div id="addM" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addModul">

	</div>
</div>

<div id="editM" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="edit">

	</div>
</div>

<div id="hapusM" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="dataHapus"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapusD" href="#">Hapus</a>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#pengampu_pembekalan').DataTable();
	});

	function kirim_id(id,nama){
		document.getElementById('dataHapus').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
		$("#hapusD").attr("href","<?php echo URL; ?>siak_gelombang_wisuda/siak_delete/"+id);
	}

	function update(value){
		var id = $(value).attr('link');

		var link = "<?php echo URL.'siak_dashboard/update_notif';?>";
		var url = link + "/" + id;
		$.ajax({
			url: url,
			success: function(data) {

			}
		});
	}
</script>
