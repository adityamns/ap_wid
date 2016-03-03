<?php if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue" >
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Fakultas</div>
	</div>
	<div class="portlet-body">
	
		<div class="row-fluid">
			<div class="span6">
		
			
			<?php if ($this->rolePage['creates'] == "t") { ?>
			<div class="input-group">
				<a class="btn purple btn-large" href="#addMFakultas" data-toggle="modal" link="<?php echo URL; ?>siak_fakultas/siak_add/" onclick="addUsers(this)">Tambah</a>
			</div>
			
			<?php } ?>
			<br><br>
			<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
				<table id = "fakultas" class="table table-bordered table-striped table-hover table-contextual table-responsive">

					<thead>
						<tr align = "center">
							<td>NO</td>
							<td>KODE</td>
							<td>FAKULTAS</td>
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
							echo "<td>" . $value['fakultas_id'] . "</td>";
							echo "<td>" . $value['fakultas'] . "</td>";
							if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
							echo "<td align = 'center'>";
							echo $this->rolePage['updates']=="t"?"<a data-toggle='modal' data-target='#editMFakultas' onclick='editUsers(this)' link = '".URL."siak_fakultas/siak_edit/".$value['fakultas_id']."'> <i class='icon-edit'></i> </a>":"";
							echo $this->rolePage['deletes']=="t"?"&nbsp <a data-toggle='modal' data-target='#hapusMUsers' onclick=\"kirim_id('".$value['fakultas_id']."', '".$value['fakultas']."')\"> <i class='icon-trash'></i></a>":"";
							echo "&nbsp <a href = '#' fakultas_id = '".$value['fakultas_id']."' url = '".URL."siak_fakultas/siak_prodi/".$value['fakultas_id']."' onClick='getSomething(this)'> <i class='icon-check'></i> </a>";
							echo "</td>";
							}
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
			<div id="addMFakultas" class="modal hide fade in">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h3>Tambah Data</h3>
				</div>
				<div id="addUsers">
				
				</div>
			</div>

			<div id="editMFakultas" class="modal hide fade in">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h3>Ubah Data</h3>
				</div>
				<div id="editUsers">
				
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

		
			</div>
			
			<div class="span6">
				<div id="statediva">
				</div>
			</div>
		</div>
		
		
	</div>
	
</div>

<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:50%;padding:2px;">
  <img src='<?=URL?>siak_public/img/ajax-loader.gif' width="64" height="64" /><br>Loading..
</div>

<script type="text/javascript">

$(document).ready(function() {
    $('#fakultas').DataTable();
    $('#prodi').DataTable();
    
    $(document).ajaxStart(function(){
      $("#wait").css("display","block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display","none");
    });
});

function getSomething(value){

      var link = $(value).attr('url');
      $.ajax({
	  url: link,
	  success: function(data) {
	      $("#statediva").html(data);
	  }
      });
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_fakultas/siak_delete/"+id);
}
</script>		
		<?php }else{ ?>
		<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
		<?php } ?>