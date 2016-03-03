<?php //if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
	<?php //if ($this->creates == "t") { ?>	
		
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addKur" data-toggle="modal" link="<?php echo URL; ?>siak_kurikulum/siak_add/" onclick="addKur(this)">Tambah</a>
		</div>
		<hr>
	<?php //} ?>
		<table id="kurikulum" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
			<tr align = "center">
				<th>NO</th>
				<th>KODE KURIKULUM</th>
				<th>NAMA KURIKULUM</th>
				<th>PROGRAM STUDI</th>
				<th>STATUS</th>
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
				echo "<td>" . $value['kode_kurikulum'] . "</td>";
				echo "<td>" . $value['nama_kurikulum'] . "</td>";
				echo "<td>" . $value['prodi_id'] . "</td>";
				foreach ($this->status_kurikulum as $key => $val) { 
					$untuk = explode(',', $val['untuk']);
					if(in_array("kurikulum", $untuk)){
						if ($value['status'] == $val['nilai']) {
							echo "<td>" . $val['nama'] . "</td>";
						}
					}
				}
				echo "<td align = 'center'>";
				
// 				echo $this->updates=="t"?"<a id='variousK$i' href = '".URL."siak_kurikulum/siak_edit/".$value['kurikulum_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
// 				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_kurikulum/siak_delete/".$value['kurikulum_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				
				echo '
				      <a class="btn blue mini" data-toggle="modal" data-target="#editKur" onclick="editKur(this)" link="'.URL.'siak_kurikulum/siak_edit/'.$value['kurikulum_id'].'"><i class="icon-edit"></i> Edit</a>
				      <a class="btn red mini" data-toggle="modal" data-target="#hapusKur" onclick="kirim_id(\''.$value['kurikulum_id'].'\',\''.$value['nama_kurikulum'].'\')"><i class="icon-trash"></i> Delete</a>
				      ';
				
				echo "</td></tr>";
			}
			?>
			</tbody>
		</table>
	
	
	</div>
</div>

<div id="addKur" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addK">
	
	</div>
</div>

<div id="editKur" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editK">
	
	</div>
</div>

<div id="hapusKur" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
    $('#kurikulum').DataTable();
} );

function addKur(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#addK').html(data);
	  }
      });
}

function editKur(value){
      var link = $(value).attr('link');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $('#editK').html(data);
	  }
      });
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_kurikulum/siak_delete/"+id);
}
</script>

<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>