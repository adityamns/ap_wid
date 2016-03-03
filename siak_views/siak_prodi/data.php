<?php //if ($this->reades == "t") { ?>
<!-- <div class="panel-body"> -->

	<?php //if ($this->creates == "t") { ?>
		<div class="input-group">
		<!--<a href="<?php echo URL; ?>siak_prodi/siak_add/<?php //echo $this->siak_fakID; ?>" id='variousD0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Prodi</button></a>-->
			<a class="btn purple btn-large" href="#addMProdi" data-toggle="modal" link="<?php echo URL; ?>siak_prodi/siak_add/<?php echo $this->siak_fakID; ?>" onclick="addProdi(this)">Tambah</a>
		</div>
		<br><br>
		<?php //} ?>
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
			<table id = "prodi" class="table table-bordered table-striped table-hover table-contextual table-responsive">
				<thead>
					<tr align = "center">
						<td>NO</td>
						<td>KODE</td>
						<td>PRODI</td>
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
						echo "<td>" . $value['prodi_id'] . "</td>";
						echo "<td>" . $value['prodi'] . "</td>";
						echo "<td align = 'center'>";
// 						echo $this->updates=="t"?"<a data-toggle='modal' data-target='#editMProdi' onclick='editProdi(this)' link = '".URL."siak_prodi/siak_edit/".$value['prodi_id']."'><i class='icon-edit'></i></a>":"";
// 						echo $this->deletes=="t"?"&nbsp <a data-toggle='modal' data-target='#hapusMUsers' onclick=\"kirim_id('".$value['prodi_id']."', '".$value['prodi']."')\" > <i class='icon-trash'></i> </a>":"";
						echo "<a data-toggle='modal' data-target='#editMProdi' onclick='editProdi(this)' link = '".URL."siak_prodi/siak_edit/".$value['prodi_id']."'><i class='icon-edit'></i></a>";
						echo "&nbsp <a data-toggle='modal' data-target='#hapusMUsers' onclick=\"kirim_id('".$value['prodi_id']."', '".$value['prodi']."')\" > <i class='icon-trash'></i> </a>";
						echo "</td>";
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<div id="addMProdi" class="modal hide fade in" data-width="760">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Tambah Data</h3>
			</div>
			<div id="addProdi">
			
			</div>
		</div>

		<div id="editMProdi" class="modal hide fade in" data-width="760">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Edit Data</h3>
			</div>
			<div id="editProdi">
			
			</div>
		</div>

		<div id="hapusMUsers" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
    $('#prodi').DataTable();
});

function addProdi(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#addProdi').html(data);
    }
  });
}

function editProdi(value){
  var link = $(value).attr('link');
  $.ajax({
    url: link,
    success: function(data) {
      $('#editProdi').html(data);
    }
  });
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_prodi/siak_delete/"+id);
}
</script>
<!-- 	</div> -->
	<?php //}else{ ?>
<!-- 	<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
	<?php //} ?>