<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Pengaturan Ruangan</div>
	</div>
	<div class="portlet-body">
	
		<div class="input-group">
			<a class="btn purple btn-large" href="#addAR" data-toggle="modal" link="<?php echo URL; ?>siak_atur_pembekalan/siak_add/" onclick="add(this)">Tambah</a>
		</div>
		<hr>
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
		<table id = "atur_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
				<tr align = "center">
					<td>NO</td>
					<td>Ruang</td>
					<td>Kapasitas Ruangan</td>
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
					

					if($value['ruang_id'] != NULL){
						foreach ($this->siak_ruang as $key => $val) {
							if( $val['ruang_id'] == $value['ruang_id']){
								echo "<td align='center'>".$val['nama_ruang']."</td>";
								$nama = $val['nama_ruang'];
							}
						}
					}else{
						echo "<td></td>";
					}
					
					echo "<td align='center'><b>".$value['jumlah_mhs']."</b> orang</td>";
					
					echo "<td align = 'center'>";
					echo "<a id='variousQ$i' href = '".URL."siak_atur_pembekalan/siak_edit/".$value['id']."'> <span class='glyphicon glyphicon-edit'></span> </a> &nbsp";
					echo "<a href = '".URL."siak_atur_pembekalan/siak_delete/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>";
					
					echo $this->updates=="t"?"<a class='btn blue mini' data-toggle='modal' data-target='#editAR' onclick='edit(this)' link = '".URL."siak_atur_pembekalan/siak_edit/".$value['id']."'> <i class='icon-edit'></i> Edit</a>":"";
					echo $this->deletes=="t"?"<a class='btn red mini' data-toggle='modal' data-target='#hapusAR' onclick=\"kirim_id('".$value['id']."', '".$nama."')\" > <i class='icon-trash'></i> Delete</a>":"";
					
					
					echo "</td></tr>";
				}
				?>
			</tbody>
		</table>
		</div>
	</div>
</div>

<div id="addAR" class="modal hide fade in" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="add">
	
	</div>
</div>

<div id="editAR" class="modal hide fade in">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="edit">
	
	</div>
</div>

<div id="hapusAR" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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

<script>
$(document).ready(function() {
    $('#atur_pembekalan').DataTable();
});

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_gedung/siak_delete/"+id);
}
</script>