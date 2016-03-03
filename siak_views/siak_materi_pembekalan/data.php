<?php //if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
	<?php //if ($this->creates == "t") { ?>
		<div class="input-group">
			<a class="btn purple btn-large" href="#addMat" data-toggle="modal" link="<?php echo URL; ?>siak_materi_pembekalan/siak_add/" onclick="addUsers(this)">Tambah</a>
		</div>
		<hr>
	<?php //} ?>
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
		<table id = "materi_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
				<tr align = "center">
					<td>NO</td>
					<td>TAHUN AKADEMIK</td>
					<td>MATERI</td>
					<td>PROGRAM STUDI</td>
					<td>STATUS</td>
					<td>ACTION</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($this->siak_data_list as $key => $value) {
					$i++;
					echo "<tr class='active'>";
					echo "<td align = 'center'>" . $i . "</td>";
					foreach ($this->siak_data_tahun as $key => $val) {
						echo $val['tahun_id']==$value['tahun_akademik']?"<td>".$val['nama_tahun']."</td>":"";
					}
					echo "<td>" . $value['materi'] . "</td>";
					echo "<td>" . $value['prodi_id'] . "</td>";
					if ($value['status'] == "1") {
						echo "<td> Umum </td>";
					}elseif ($value['status'] == "2") {
						echo "<td> Prodi </td>";
					}
					echo "<td align = 'center'>";
					
					echo $this->updates=="t"?"<a class='btn blue mini' data-toggle='modal' data-target='#editMat' onclick='editUsers(this)' link = '".URL."siak_materi_pembekalan/siak_edit/".$value['materi_id']."'> <i class='icon-edit'></i> Ubah</a>":"";
					echo $this->deletes=="t"?"<a class='btn red mini' data-toggle='modal' data-target='#hapusMat' onclick=\"kirim_id('".$value['materi_id']."', '".$value['materi']."')\" > <i class='icon-trash'></i> Hapus</a>":"";
					echo "</td></tr>";
				}
				?>
			</tbody>
		</table>
		</div>
	</div>
</div>

<div id="addMat" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addUsers">
	
	</div>
</div>

<div id="editMat" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editUsers">
	
	</div>
</div>

<div id="hapusMat" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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

<script type="text/javascript">
$(document).ready(function(){
$('#materi_pembekalan').DataTable();
});

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_materi_pembekalan/siak_delete/"+id);
}

</script>
<?php //}else{ ?>
<!--<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>-->
<?php //} ?>