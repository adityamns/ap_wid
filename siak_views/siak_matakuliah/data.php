<?php if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Data Matakuliah Paket</div>
	</div>
	<div class="portlet-body">
	<?php if ($this->rolePage['creates'] == "t" ) { ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMPaket" data-toggle="modal" link="<?php echo URL; ?>siak_matakuliah/siak_add/" onclick="addMPaket(this)">Tambah</a>
		</div>
		<hr>
	<?php } ?>
		<table id = "matakuliah" class="table table-striped table-bordered table-hover table-full-width">
		<thead>
			<tr align = "center">
				<td>NO</td>
				<td>KODE MATAKULIAH</td>
				<td>NAMA MATAKULIAH</td>
				<td>SINGKATAN</td>
				<td>SKS</td>
				<?php if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") { ?>
				<td>ACTION</td>
				<?php } ?>
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
				echo "<td>" . $value['sks'] . "</td>";
				if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
				echo "<td align = 'center'>";
				
// 				echo $this->updates=="t"?"<a id='variousM$i' href = '".URL."siak_matakuliah/siak_edit/".$value['matkul_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
// 				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_matakuliah/siak_delete/".$value['matkul_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				if ($this->rolePage['updates'] == "t") {
				echo '
				      <a class="btn blue mini" data-toggle="modal" data-target="#editMPaket" onclick="editMPaket(this)" link="'.URL.'siak_matakuliah/siak_edit/'.$value['matkul_id'].'"><i class="icon-edit"></i> Ubah</a>';
				}
				if ($this->rolePage['deletes'] == "t") {
				echo '
				      <a class="btn red mini" data-toggle="modal" data-target="#hapusMPaket" onclick="kirim_id(\''.$value['matkul_id'].'\',\''.$value['nama_matkul'].'\')"><i class="icon-trash"></i> Hapus</a>
				      ';
				}
				echo "</td>";
				}
				echo "</tr>";
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
		<h3>Ubah Data</h3>
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

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script>
$(document).ready(function() {
    $('#matakuliah').DataTable();
    
    $(document).ajaxStart(function(){
	$("#wait").css("display","block");
      });

      $(document).ajaxComplete(function(){
	$("#wait").css("display","none");
      });
    
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
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>