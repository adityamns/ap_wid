<div class="panel panel-primary">
	<div class="panel-body" >
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMGrup" data-toggle="modal" link="<?php echo URL; ?>siak_group/siak_add/" onclick="addGrup(this)">Tambah</a>
		</div>
		<hr>
		<table id="grupe" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<th>NO</th>
				<th>NAMA</th>
				<th>KETERANGAN</th>
				<th>ACTION</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=0;
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr>";
				echo "<td>" . $i . "</td>";
				echo "<td>" . $value['nama'] . "</td>";
				echo "<td>" . $value['keterangan'] . "</td>";
				echo "<td align = 'center'>
				      <a class='btn blue mini' data-toggle='modal' data-target='#editMGrup' onclick='editGrup(this)' link= '".URL."siak_group/siak_edit/".$value['id']."'><i class='icon-edit'></i> ubah</a>";
				echo '&nbsp;<a class="btn red mini" data-toggle="modal" data-target="#hapusMGrup" onclick="kirim_id(\''.$value['id'].'\',\''.$value['nama'].'\')"><i class="icon-trash"></i> Hapus</a>
				      </td>';
				echo "</tr>";
			}
			?>
		</tbody>
		</table>

		<div id="addMGrup" class="modal hide fade in">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Tambah Data</h3>
			</div>
			<div id="addGrup">
			
			</div>
		</div>

		<div id="editMGrup" class="modal hide fade in">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Edit Data</h3>
			</div>
			<div id="editGrup">
			
			</div>
		</div>

		<div id="hapusMGrup" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-body">
				<span id="dataHapus"></span>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">Batal</button>
				<a type="button" class="btn green" id="hapusGrup" href="#">Hapus</a>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
    $('#grupe').DataTable();
} );

function kirim_id(id,nama){
	document.getElementById('dataHapus').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapusGrup").attr("href","<?php echo URL; ?>siak_group/siak_delete/"+id);
}
</script>