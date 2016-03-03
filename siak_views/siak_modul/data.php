<?php //if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
		<?php //if ($this->creates == "t") { ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addM" data-toggle="modal" link="<?php echo URL; ?>siak_modul/siak_add/" onclick="addModul(this)">Tambah</a>
		</div>
		
		<hr>
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
		<table id="modul" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<th width="5%">NO</th>
				<!-- <td>KODE</td> -->
				<th width="25%">NAMA</th>
				<th width="20%">URL</th>
				<th width="5%">URUTAN</th>
				<th width="5%">STATUS</th>
				<th width="20%">ACTION</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=0;
			foreach ($this->data as $key => $value) {
				$i++;
				echo "<tr>";
				echo "<td>" . $i . "</td>";
				// echo "<td>" . $value['kode'] . "</td>";
				echo "<td>" . $value['nama_modul'] . "</td>";
				echo "<td><a href='". URL . $value['url'] ."'> " . URL . $value['url'] . "</a></td>";
				echo "<td>" . $value['urutan'] . "</td>";
				$status = ($value['status'] == 't')?"Aktif":"Tidak Aktif";
				echo "<td>" . $status . "</td>";
				echo '<td align = "center">    
				      <a class="btn blue mini" data-toggle="modal" data-target="#editM" onclick="editModul(this)" link="'.URL.'siak_modul/siak_edit/'.$value['id'].'"><i class="icon-edit"></i>Ubah</a>
				      <a class="btn red mini" data-toggle="modal" data-target="#static" onclick="kirim_id(\''.$value['id'].'\',\''.$value['nama_modul'].'\')"><i class="icon-trash"></i>Hapus</a>
				      </td>';
				echo "</tr>";
			}
			?>
		</tbody>
		</table>
		</div>
</div>
<div id="addM" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addModul">
	
	</div>
</div>

<div id="editM" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editModul">
	
	</div>
</div>

<div id="static" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
    $('#modul').DataTable();
} );

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_modul/siak_delete/"+id);
}
</script>
		<?php //}else{ ?>
<!-- 		<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
		<?php //} ?>