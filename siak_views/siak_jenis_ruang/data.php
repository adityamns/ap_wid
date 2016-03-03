<?php if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Data Jenis Ruangan</div>
	</div>
	<div class="portlet-body">
		<?php if ($this->rolePage['creates'] == "t") { ?>
		<div class="input-group">
			<a class="btn purple btn-large" href="#addJGed" data-toggle="modal" link="<?php echo URL; ?>siak_jenis_ruang/siak_add/" onclick="addUsers(this)">Tambah</a>
		</div>
		<hr>
		<?php } ?>
		<table id = "jenis_ruang" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
		<tr align = "center">
			<td>NO</td>
			<td>NAMA</td>
			<td>KETERANGAN</td>
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
			echo "<td>" . $value['nama'] . "</td>";
			echo "<td>" . $value['keterangan'] . "</td>";
			if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
			echo "<td align = 'center'>";
			
// 			echo $this->updates=="t"?"<a class='btn blue mini' data-toggle='modal' data-target='#editJGed' onclick='editUsers(this)' link = '".URL."siak_jenis_ruang/siak_edit/".$value['id']."'> <i class='icon-edit'></i> Ubah</a>":"";
// 			echo $this->deletes=="t"?"<a class='btn red mini' data-toggle='modal' data-target='#hapusJGed' onclick=\"kirim_id('".$value['id']."', '".$value['nama']."')\" > <i class='icon-trash'></i> Hapus</a>":"";
			if ($this->rolePage['updates'] == "t") {
			echo "<a class='btn blue mini' data-toggle='modal' data-target='#editJGed' onclick='editUsers(this)' link = '".URL."siak_jenis_ruang/siak_edit/".$value['id']."'> <i class='icon-edit'></i> Ubah</a>";
			}
			if ($this->rolePage['deletes'] == "t") {
			echo "<a class='btn red mini' data-toggle='modal' data-target='#hapusJGed' onclick=\"kirim_id('".$value['id']."', '".$value['nama']."')\" > <i class='icon-trash'></i> Hapus</a>";
			}
			echo "</td>";
			}
			echo "</tr>";
		}
		?>
		</tbody>
		</table>
	</div>
	<div id="addJGed" class="modal hide fade in" >
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Tambah Data</h3>
		</div>
		<div id="addUsers">
		
		</div>
	</div>

	<div id="editJGed" class="modal hide fade in">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Ubah Data</h3>
		</div>
		<div id="editUsers">
		
		</div>
	</div>
	
	<div id="hapusJGed" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script>
$(document).ready(function() {
    $('#jenis_ruang').DataTable();
    $(document).ajaxStart(function(){
      $("#wait").css("display","block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display","none");
    });
});

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_jenis_ruang/siak_delete/"+id);
}
</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>