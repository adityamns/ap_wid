<?php if ($this->rolePage['reades'] == "t") { ?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-globe"></i>Batasan Input Nilai</div>
	</div>
	<div class="portlet-body" >
	<?php if ($this->rolePage['creates'] == "t") { ?>
		
		<div class="input-group">
			<a class=" btn purple btn-large" href="#addMDP" data-toggle="modal" link="<?php echo URL; ?>siak_batasan_waktu_nilai/siak_add" onclick="addModul(this)">Tambah</a>
<!-- 			<a class=" btn purple btn-large" onclick="test()">test</a> -->
		</div>
		<hr>
	<?php } ?>
		<table id = "batasan_waktu" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>MATAKULIAH</td>
				<td>MULAI</td>
				<td>AKHIR</td>
				<td>DOSEN</td>
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
				echo "<td>" . $value['matkul_id'] . "</td>";
				echo "<td>" . $value['mulai'] . "</td>";
				echo "<td>" . $value['akhir'] . "</td>";
				echo "<td>dosen</td>";
				if ($this->rolePage['updates'] == "t" || $this->rolePage['deletes'] == "t") {
				echo "<td align = 'center'>";
				if ($this->rolePage['updates'] == "t") {
				echo "
							<a class='btn blue mini' data-toggle='modal' data-target='#editM' onclick='edit(this)' link= '".URL."siak_gelombang_wisuda/siak_edit/".$value['kode']."'><i class='icon-edit'></i> Ubah</a>";
				}
				if ($this->rolePage['deletes'] == "t") {
							echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusM" onclick="kirim_id(\''.$value['kode'].'\',\''.$value['nama'].'\')"><i class="icon-trash"></i> Hapus</a>';
				}
				echo '</td>';
				}
				
				echo "</tr>";
			}
			?>
			</tbody>
		</table>
		
		</div>
		</div>
<?php //}else{ ?>
<!--<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>-->
<?php //} ?>
<div id="addMDP" class="modal hide fade" data-width='650'>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addModul">
	
	</div>
</div>

<div id="editMDP" class="modal hide fade" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="editDP">
	
	</div>
</div>

<div id="hapusMDP" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
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

<script type="text/javascript">
$(document).ready(function(){
	$('#batasan_waktu').DataTable();
	$(document).ajaxStart(function(){
	  $("#wait").css("display","block");
	});

	$(document).ajaxComplete(function(){
	  $("#wait").css("display","none");
	});
});
		

function getmatkul(value) {
	var strURL = jQuery(value).attr('link');
	var semes = jQuery(value).attr('value');
	var prodi = document.getElementById('prodi').value;
	var req = getXMLHTTP();
	if (req) {
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.status == 200) {
					document.getElementById('statediv').innerHTML=req.responseText;            
				} else {
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}       
		}     
		req.open("GET", strURL+ "/" + prodi+ "/" + semes, true);
		req.send(null);
	}
}

</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>