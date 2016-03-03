<?php //if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
		<?php if ($this->rolePage['creates'] == "t") { ?>
		<div class="input-group">
			<!--<a href="<?php echo URL; ?>siak_dosen/data_penelitian/<?php echo $this->nip?>/add" id='variousO0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>-->
			<a class=" btn purple btn-large" href="#addMPeneliti" data-toggle="modal" link="<?php echo URL; ?>siak_dosen/data_penelitian/<?php echo $this->nip?>/add" onclick="addPeneliti(this)">Tambah</a>
		</div>
		<hr>
		<?php } ?>
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
		<table id="penelitian" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>TAHUN PENELITIAN</td>
				<td>JUDUL PENELITIAN</td>
				<td>JABATAN</td>
				<td>SUMBER DANA</td>
				<?php if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") { ?>
				<td>AKSI</td>
				<?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td>" . $value['tahun_penelitian'] . "</td>";
				echo "<td>" . $value['judul_penelitian'] . "</td>";
				foreach ($this->jabatan as $key => $val) {
					if ($val['jabatan_id'] == $value['jabatan']) {
						echo "<td>" . $val['nama_jabatan'] . "</td>";
					}
				}
				echo "<td>" . $value['sumber_dana'] . "</td>";
				if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
				echo "<td>";
				if ($this->rolePage['updates'] == "t") {
				echo '
				      <a class="btn blue mini" data-toggle="modal" data-target="#editMPeneliti" onclick="editPeneliti(this)" link="'.URL.'siak_dosen/data_penelitian/'.$this->nip.'/edit/'.$value['id'].'"><i class="icon-edit"></i> Ubah</a>';
				}
				if ($this->rolePage['deletes'] == "t") {
				echo '
				      <a class="btn red mini" data-toggle="modal" data-target="#hapusPeneliti" onclick="kirim_id(\''.$value['nip'].'\',\''.$value['id'].'\',\''.$value['judul_penelitian'].'\')"><i class="icon-trash"></i> Hapus</a>
				      ';
				}
// 				echo $this->updates=="t"?"<a id='editMPeneliti' href = '".URL."siak_dosen/data_penelitian/".$this->nip."/edit/".$value['id']."'><span class='glyphicon glyphicon-edit'></span></a>":"";
// 				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_dosen/siak_delete/".$value['nip']."/penelitian_dosen/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				
				echo "</td>";
				}
				echo "</tr>";
			}
			?>
			</tbody>
		</table>
		</div>
		<div id="addMPeneliti" class="modal hide fade" data-width="760">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Tambah Data</h3>
			</div>
			<div id="addPeneliti">
				
			</div>
		</div>

		<div id="editMPeneliti" class="modal hide fade" data-width="760">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Ubah Data</h3>
			</div>
			<div id="editPeneliti">
			
			</div>
		</div>

		<div id="hapusPeneliti" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
    $('#penelitian').DataTable();
});

function addPeneliti(value){
//       var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
//       var link = url+"<?=$this->jenis?>"+"/"+nim;
      var link = url;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#addPeneliti").html(data);
	  }
      });
}

function editPeneliti(value){
//       var nim = "<?php echo $this->nim; ?>";
      var url = $(value).attr('link');
//       var link = url+"<?=$this->jenis?>"+"/"+nim;
      var link = url;
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#editPeneliti").html(data);
	  }
      });
}

function kirim_id(nip,id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_dosen/siak_delete/"+nip+"/penelitian_dosen/"+id);
}
</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>