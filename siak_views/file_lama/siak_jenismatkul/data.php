<?php //if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
	<?php //if ($this->creates == "t") { ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addJM" data-toggle="modal" link="<?php echo URL; ?>siak_jenismatkul/siak_add/" onclick="addJM(this)">Tambah</a>
		</div>
		
		<hr>
	<?php //} ?>
		<table id = "jenis_matkul" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
			<tr align = "center">
				<th>NO</th>
				<th>SINGKATAN</th>
				<th>JENIS MATKUL</th>
				<th>ACTION</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td>" . $value['singkatan'] . "</td>";
				echo "<td>" . $value['nama_jenismatkul'] . "</td><td align = 'center'>";
				
// 				echo $this->updates=="t"?"<a id='variousJ$i' href = '".URL."siak_jenismatkul/siak_edit/".$value['jenismatkul_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
// 				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_jenismatkul/siak_delete/".$value['jenismatkul_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				
				echo '
				      <a class="btn blue mini" data-toggle="modal" data-target="#editJM" onclick="editJM(this)" link="'.URL.'siak_jenismatkul/siak_edit/'.$value['jenismatkul_id'].'"><i class="icon-edit"></i> Edit</a>
				      <a class="btn red mini" data-toggle="modal" data-target="#hapusJM" onclick="kirim_id(\''.$value['jenismatkul_id'].'\',\''.$value['nama_jenismatkul'].'\')"><i class="icon-trash"></i> Delete</a>
				      ';
				
				echo "</tr></td>";
			}
			?>
			</tbody>
		</table>
	</div>
</div>

<div id="addJM" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addJ">
	
	</div>
</div>

<div id="editJM" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editJ">
	
	</div>
</div>

<div id="hapusJM" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
    $('#jenis_matkul').DataTable();
} );

function addJM(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#addJ').html(data);
	  }
      });
}

function editJM(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#editJ').html(data);
	  }
      });
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_jenismatkul/siak_delete/"+id);
}
</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>