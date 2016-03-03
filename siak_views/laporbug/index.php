<?php
if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="icon-home"></i>Daftar Permasalahan</div>
		</div>
		<div class="portlet-body">
		<?php if ($this->rolePage['creates'] == "t") { ?>
			<!--<a href="<?php echo URL; ?>siak_badan_hukum/siak_add/" id='variousB0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>-->
<!-- 			<a class="btn purple btn-large" href="#addMBadanhukum" data-toggle="modal" link="<?php //echo URL; ?>siak_badan_hukum/siak_add/" onclick="addUsers(this)">Tambah</a> -->
		<?php } ?>
		<hr>
		
		<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
		<table id="univ" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr align = "center">
					<td>NO</td>
					<td>Judul</td>
					<td>Pengirim</td>
					<td>Keterangan</td>
					
					<?php if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") { ?>
					<td>ACTION</td>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($this->data as $key => $value) {
					$detail = json_decode($value['detail_user']);
					$i++;
					echo "<tr class='active'>";
					echo "<td align = 'center'>" . $i . "</td>";
					echo "<td>" . $value['judul'] . "</td>";
					echo "<td>" . $detail->user . "</a></td>";
					$status=($value['status']!="" || $value['status'] != 0)?"<i class='icon-ok '> OK<i>":"<i class='icon-bullhorn'> Belum</i>";
					echo "<td>" . $status . "</td>";
					
					if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
					echo "<td align = 'center'>";
					
						if ($this->rolePage['updates'] == "t") {
							
							$upsatesu = "<a class='btn blue mini' data-toggle='modal' data-target='#updateMBug' onclick=\"kirim_id2('".$value['id']."', '".$value['judul']."')\"> <i class='icon-edit'></i> Set OK</a>";
							$upsatese = "<a class='btn red mini' disabled> <i class='icon-edit'></i> Set OK</a>";
							$statusu=($value['status']=="" || $value['status'] == 0)?$upsatesu:$upsatese;
							echo $statusu;
						}
						echo "&nbsp";
						if ($this->rolePage['deletes'] == "t") {
							echo "<a class='btn red mini' data-toggle='modal' data-target='#hapusMBug' onclick=\"kirim_id('".$value['id']."', '".$value['judul']."')\" > <i class='icon-trash'></i> Hapus</a>";
						}
						
						echo "&nbsp";
						echo "<a class='btn green mini' data-toggle='modal' data-target='#detailMBug' onclick='detailbug(this)' link='".URL."siak_bug/detailBug/".$value['id']."' > <i class='icon-ok'></i> Detail</a>";
						
					echo "</td>";
					}
					
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		</div>
		
		<div id="detailMBug" class="modal hide fade in">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Detail Laporan Masalah Penggunaan</h3>
			</div>
			<div id="detail">
			
			</div>
		</div>
		
		<div id="updateMBug" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>Hapus Data</h3>
			</div>
			<div class="modal-body">
				<span id="updateBug"></span>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">Batal</button>
				<a type="button" class="btn green" id="update" href="#">Simpan</a>
			</div>
		</div>
		<div id="hapusMBug" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
$(document).ready(function(){
	$('#univ').DataTable();
	$(document).ajaxStart(function(){
      $("#wait").css("display","block");
    });

    $(document).ajaxComplete(function(){
      $("#wait").css("display","none");
    });
    
})

function detailbug(value){
	var url = $(value).attr('link');
	$.ajax({
		url: url,
		success: function(res){
			$('#detail').html(res);
		}
	});
}

function kirim_id2(id,nama){
	document.getElementById('updateBug').innerHTML = "Anda akan mengubah staatus <strong>"+nama+"</strong> Menjadi OK, klik Simpan untuk melanjutkan.";
	$("#update").attr("href","<?php echo URL; ?>siak_bug/updateBug/"+id);
}
function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_bug/hapusBug/"+id);
}
</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>