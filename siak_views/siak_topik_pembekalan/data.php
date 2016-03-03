<?php //if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
	<?php// ($this->creates == "t") { ?>
		<div class="input-group">
			<a class="btn purple btn-large" href="#addTopMat" data-toggle="modal" link="<?php echo URL; ?>siak_topik_pembekalan/siak_add/" onclick="add(this)">Tambah</a>
		</div>
		<hr>
	<?php //} ?>
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
		<table id = "topik_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
				<tr align = "center">
					<td>NO</td>
					<td>MATERI</td>
					<td>KODE TOPIK</td>
					<td>NAMA TOPIK</td>
					<td width="20%">ACTION</td>
				</tr>
			</thead> 
			<tbody>
				<?php
				$i = 0;
				foreach ($this->siak_data_list as $key => $value) {
					$i++;
					echo "<tr class='active'>";
					echo "<td align = 'center'>" . $value['materi_id'] . "</td>";
					foreach ($this->siak_data_materi as $key => $val) {
						echo $val['materi_id']==$value['materi_id']?"<td>" . $val['materi'] . "</td>":"";
					}
					echo "<td>" . $value['kode_topik_materi'] . "</td>";
					echo "<td>" . $value['nama_topik_materi'] . "</td><td align = 'center'>";
					
					echo $this->updates=="t"?"<a class='btn blue mini' data-toggle='modal' data-target='#editTopMat' onclick='edit(this)' link = '".URL."siak_topik_pembekalan/siak_edit/".$value['topik_materi_id']."'> <i class='icon-edit'></i> Edit</a>":"";
					echo $this->deletes=="t"?"<a class='btn red mini' data-toggle='modal' data-target='#hapusTopMat' onclick=\"kirim_id('".$value['topik_materi_id']."', '".$value['nama_topik_materi']."')\" > <i class='icon-trash'></i> Delete</a>":"";
					
					echo "</td></tr>";
				}
				?>
			</tbody>
		</table>
		</div>
	</div>
</div>

<div id="addTopMat" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="add">
	
	</div>
</div>

<div id="editTopMat" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="edit">
	
	</div>
</div>

<div id="hapusTopMat" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Hapus Data</h3>
	</div>
	<div class="modal-body">
		<span id="dataTOP"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<a type="button" class="btn green" id="hapusTOP" href="#">Hapus</a>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
$('#topik_pembekalan').DataTable();
});

function kirim_id(id,nama){
	document.getElementById('dataTOP').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapusTOP").attr("href","<?php echo URL; ?>siak_topik_pembekalan/siak_delete/"+id);
}

</script>
<?php //}else{ ?>
<!--<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>-->
<?php //} ?>