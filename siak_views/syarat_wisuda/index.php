<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Syarat Wisuda</div>
			</div>

			<div class="portlet-body">

			<div class="input-group">
				<a class=" btn purple btn-large" href="#addM" data-toggle="modal" link="<?php echo URL; ?>syarat_wisuda/add/" onclick="add(this)">Tambah</a>
			</div>
			<hr>

				<table id="syarat" class="table table-bordered table-striped table-hover table-contextual table-responsive">
					<thead>
						<tr align = "center">
							<td width="5">No</td>
							<td>Nama</td>
							<td>Status</td>
							<td width="15%">Action</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
						$yes = "<td><span class='glyphicon glyphicon-ok' style='color:green'></span></td>";
						$no = "<td><span class='glyphicon glyphicon-minus' style='color:red'></span></td>";
						foreach ($this->data as $key => $value) {
							$i++;
							echo "<tr>";
							echo "<td>" . $i . "</td>";
							echo "<td>" . $value['nama'] . "</td>";
							$status = ($value['status'] == FALSE)? "Tidak Aktif":"Aktif";
							echo "<td>" . $status . "</td>";

							// echo "<td align = 'center'> <a id='variousR$i' href = '".URL."syarat_wisuda/edit/".$value['id']."'> <span class='glyphicon glyphicon-edit'></span> &nbsp </a> <a href = '".URL."syarat_wisuda/delete/".$value['id']."' class='ask'><span class='glyphicon glyphicon-trash'></span> </a></td>";
							echo "<td align = 'center'>
							<a class='btn blue mini' data-toggle='modal' data-target='#editM' onclick='edit(this)' link= '".URL."syarat_wisuda/edit/".$value['id']."'><i class='icon-edit'></i> Ubah</a>";
							echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusM" onclick="kirim_id(\''.$value['id'].'\',\''.$value['nama'].'\')"><i class="icon-trash"></i> Hapus</a>
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
	<div id="add">

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
		$('#syarat').DataTable();
	});

	function kirim_id(id,nama){
		document.getElementById('dataHapus').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
		$("#hapusD").attr("href","<?php echo URL; ?>syarat_wisuda/delete/"+id);
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
