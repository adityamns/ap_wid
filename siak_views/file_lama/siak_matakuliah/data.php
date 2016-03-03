<?php //if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
	<?php //if ($this->creates == "t") { ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMPaket" data-toggle="modal" link="<?php echo URL; ?>siak_matakuliah/siak_add/" onclick="addMPaket(this)">Tambah</a>
		</div>
		<hr>
	<?php //} ?>
		<table id = "matakuliah" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<td>NO</td>
				<td>KODE MATAKULIAH</td>
				<td>NAMA MATAKULIAH</td>
				<td>SINGKATAN</td>
				<td>SKS</td>
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
				echo "<td>" . $value['kode_matkul'] . "</td>";
				echo "<td>" . $value['nama_matkul'] . "</td>";
				echo "<td>" . $value['singkatan'] . "</td>";
				echo "<td>" . $value['sks'] . "</td><td align = 'center'>";
				
// 				echo $this->updates=="t"?"<a id='variousM$i' href = '".URL."siak_matakuliah/siak_edit/".$value['matkul_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
// 				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_matakuliah/siak_delete/".$value['matkul_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				
				echo '
				      <a class="btn blue mini" data-toggle="modal" data-target="#editMPaket" onclick="editMPaket(this)" link="'.URL.'siak_matakuliah/siak_edit/'.$value['matkul_id'].'"><i class="icon-edit"></i> Edit</a>
				      <a class="btn red mini" data-toggle="modal" data-target="#hapusMPaket" onclick="kirim_id(\''.$value['matkul_id'].'\',\''.$value['nama_matkul'].'\')"><i class="icon-trash"></i> Delete</a>
				      ';
				
				echo "</td></tr>";
			}
			?>
		</tbody>
	</table>
	
	</div>
</div>

<div id="addMPaket" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addMPK">
	
	</div>
</div>

<div id="editMPaket" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editMPK">
	
	</div>
</div>

<div id="hapusMPaket" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
    $('#matakuliah').DataTable();
} );

function addMPaket(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#addMPK').html(data);
	  }
      });
}

function editMPaket(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#editMPK').html(data);
	  }
      });
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_matakuliah/siak_delete/"+id);
}
</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>