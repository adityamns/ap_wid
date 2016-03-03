<?php if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Data Jenis Matakuliah</div>
	</div>
	<div class="portlet-body">
	<?php if ($this->rolePage['creates'] == "t") { ?>
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addJM" data-toggle="modal" link="<?php echo URL; ?>siak_jenismatkul/siak_add/" onclick="addJM(this)">Tambah</a>
		</div>
		
		<hr>
	<?php } ?>
		<table id = "jenis_matkul" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
			<tr align = "center">
				<th>NO</th>
				<th>SINGKATAN</th>
				<th>JENIS MATAKULIAH</th>
				<?php if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") { ?>
				<th>ACTION</th>
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
				echo "<td>" . $value['singkatan'] . "</td>";
				echo "<td>" . $value['nama_jenismatkul'] . "</td>";
				if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
				echo "<td align = 'center'>";
				
// 				echo $this->updates=="t"?"<a id='variousJ$i' href = '".URL."siak_jenismatkul/siak_edit/".$value['jenismatkul_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
// 				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_jenismatkul/siak_delete/".$value['jenismatkul_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
				if ($this->rolePage['updates'] == "t") {
				echo '
				      <a class="btn blue mini" data-toggle="modal" data-target="#editJM" onclick="editJM(this)" link="'.URL.'siak_jenismatkul/siak_edit/'.$value['jenismatkul_id'].'"><i class="icon-edit"></i> Ubah</a>';
				}
				if ($this->rolePage['deletes'] == "t") {
				echo '
				      <a class="btn red mini" data-toggle="modal" data-target="#hapusJM" onclick="kirim_id(\''.$value['jenismatkul_id'].'\',\''.$value['nama_jenismatkul'].'\')"><i class="icon-trash"></i> Hapus</a>
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
		<h3>Ubah Data</h3>
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

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script>
$(document).ready(function() {
    $('#jenis_matkul').DataTable();
    
    $(document).ajaxStart(function(){
	$("#wait").css("display","block");
      });

      $(document).ajaxComplete(function(){
	$("#wait").css("display","none");
      });
    
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
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>