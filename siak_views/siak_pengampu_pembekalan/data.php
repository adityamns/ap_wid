<?php //if ($this->reades == "t" && $this->loads == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Pengampu Pembekalan</div>
	</div>
	<div class="portlet-body">
	
		<?php //if ($this->creates == "t") { ?>
		<div class="input-group">
			<a class="btn purple btn-large" href="#addPem" data-toggle="modal" link="<?php echo URL; ?>siak_pengampu_pembekalan/siak_add/" onclick="addUsers(this)">Tambah</a>
		</div>
		<hr>
		<?php //} ?>
		<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>KODE DOSEN</td>
				<td>NAMA DOSEN</td>
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
				echo "<td>" . $value['kode_dosen'] . "</td>";
				echo "<td>" . $value['nama_dosen'] . "</td>";
				foreach ($this->status_pengampu as $key => $val) { 
					$untuk = explode(',', $val['untuk']);
					if(in_array("materi_pembekalan", $untuk)){
						if ($value['status'] == $val['nilai']) {
							echo "<td>" . $val['nama'] . "</td>";
						}
					}
				}
				echo "<td align = 'center'>";
				
				echo $this->updates=="t"?"<a id='variousM$i' href = '".URL."siak_pengampu_pembekalan/siak_edit/".$value['pengampu_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_pengampu_pembekalan/siak_delete/".$value['pengampu_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				
				echo $this->updates=="t"?"<a class='btn blue mini' data-toggle='modal' data-target='#editPem' onclick='editUsers(this)' link = '".URL."siak_pengampu_pembekalan/siak_edit/".$value['pengampu_id']."'> <i class='icon-edit'></i> Edit</a>":"";
				echo $this->deletes=="t"?"<a class='btn red mini' data-toggle='modal' data-target='#hapusPem' onclick=\"kirim_id('".$value['pengampu_id']."', '".$value['nama_dosen']."')\" > <i class='icon-trash'></i> Delete</a>":"";
			
				echo "</td></tr>";
			}
			?>
			</tbody>
		</table>
	</div>
		
	<div id="addPem" class="modal hide fade in" >
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Tambah Data</h3>
		</div>
		<div id="addUsers">
		
		</div>
	</div>

	<div id="editPem" class="modal hide fade in">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Edit Data</h3>
		</div>
		<div id="editUsers">
		
		</div>
	</div>
	
	<div id="hapusPem" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
    $('#pengampu_pembekalan').DataTable();
});

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_pengampu_pembekalan/siak_delete/"+id);
}
</script>
<?php //}else{ ?>
<!--<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>-->
<?php //} ?>