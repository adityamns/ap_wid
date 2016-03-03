<?php //if ($this->reades == "t") { ?>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Index</div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body">
		
	<?php //if ($this->creates == "t") { ?>	
		<div class="input-group">
			<a class=" btn purple btn-large" href="#tambahTopik" data-toggle="modal" link="<?php echo URL; ?>siak_topik/siak_add/" onclick="addTopik(this)">Tambah</a>
		</div>
		<hr>
	<?php //} ?>
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
		<table id = "topik" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
				<tr align = "center">
					<td>NO</td>
					<td>KODE TOPIK</td>
					<td>NAMA TOPIK</td>
					<td>KODE MATA KULIAH</td>
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
					echo "<td>" . $value['kode_topik'] . "</td>";
					echo "<td>" . $value['nama_topik'] . "</td>";
					echo "<td>" . $value['kode_matkul'] . "</td><td align = 'center'>";
					
					//echo $this->updates=="t"?"<a id='variousT$i' href = '".URL."siak_topik/siak_edit/".$value['id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
					//echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_topik/siak_delete/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
					
					echo '
						<a class="btn blue mini" data-toggle="modal" data-target="#editTopik" onclick="editTopik(this)" link="'.URL.'siak_topik/siak_edit/'.$value['id'].'"><i class="icon-edit"></i> Edit</a>
						<a class="btn red mini" data-toggle="modal" data-target="#hapusTopik" onclick="kirim_id(\''.$value['id'].'\',\''.$value['nama_topik'].'\')"><i class="icon-trash"></i> Delete</a>
						';
					
					echo "</td></tr>";
				}
				?>
			</tbody>
		</table>
		</div>
	</div>
</div>

<div id="tambahTopik" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addTop">
	
	</div>
</div>

<div id="editTopik" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editTop">
	
	</div>
</div>

<div id="hapusTopik" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
    $('#topik').DataTable();
} );

function addTopik(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#addTop').html(data);
	  }
      });
}

function editTopik(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#editTop').html(data);
	  }
      });
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_topik/siak_delete/"+id);
}

</script>
	
<?php //}else{ ?>
<!--<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>-->
<?php //} ?>