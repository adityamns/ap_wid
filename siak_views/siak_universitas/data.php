<?php 
// echo "<pre>";
// var_dump($this->role);
// echo "</pre>";

if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="icon-home"></i>Identitas Universitas</div>
		</div>
		<div class="portlet-body">
		<?php if ($this->rolePage['creates'] == "t") { ?>
			<!--<a href="<?php echo URL; ?>siak_universitas/siak_add/" id='variousA0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>-->
			<a class="btn purple btn-large" href="#addMUniversitas" data-toggle="modal" link="<?php echo URL; ?>siak_universitas/siak_add/" onclick="addUsers(this)">Tambah</a>
		<hr>
		<?php } ?>
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
		<table id="univ" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr align = "center">
					<td>NO</td>
					<td>KODE</td>
					<td>NAMA</td>
					<td>KOTA</td>
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
					echo "<td>" . $value['kode'] . "</td>";
					echo "<td>" . $value['nama'] . "</td>";
					echo "<td>" . $value['kota'] . "</td>";
					if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
					echo "<td align = 'center'>";
					echo $this->rolePage['updates']=="t"?"<a class='btn blue mini' data-toggle='modal' data-target='#editMUniversitas' onclick='editUsers(this)' link = '".URL."siak_universitas/siak_edit/".$value['kode']."'> <i class='icon-edit'></i> Ubah</a>":"";
// 					echo "&nbsp";
					echo $this->rolePage['deletes']=="t"?"<a class='btn red mini' data-toggle='modal' data-target='#hapusMUniversitas' onclick=\"kirim_id('".$value['kode']."', '".$value['nama']."')\"><i class='icon-trash'></i> Hapus</a>":"";
// 					echo "<a class='btn blue mini' data-toggle='modal' data-target='#editMUniversitas' onclick='editUsers(this)' link = '".URL."siak_universitas/siak_edit/".$value['kode']."'> <i class='icon-edit'></i> Edit</a>";
// 					echo "&nbsp";
// 					echo "<a class='btn red mini' data-toggle='modal' data-target='#hapusMUniversitas' onclick=\"kirim_id('".$value['kode']."', '".$value['nama']."')\"><i class='icon-trash'></i> Delete</a>";
					echo "</td>";
					}
					echo "</tr>";

				}
				?>
			</tbody>
		</table>
		</div>
		<div id="addMUniversitas" class="modal hide fade in" data-width="760">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Tambah Data</h3>
			</div>
			<div id="addUsers">
			
			</div>
		</div>

		<div id="editMUniversitas" class="modal hide fade in" data-width="760">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Edit Data</h3>
			</div>
			<div id="editUsers">
			
			</div>
		</div>

		<div id="hapusMUniversitas" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
	</div>
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script>
$(document).ready(function() {
    $('#univ').DataTable();
    
    $(document).ajaxStart(function(){
      $("#wait").css("display","block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display","none");
    });

});

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_universitas/siak_delete/"+id);
}
</script>
		<?php }else{ ?>
		<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
		<?php } ?>