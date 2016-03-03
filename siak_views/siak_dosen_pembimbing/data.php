<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Daftar Kegiatan</div>
			</div>
			<div class="portlet-body">
			
			<div class="input-group">
				<a class=" btn purple btn-large" href="#addDos" data-toggle="modal" link="<?php echo URL; ?>siak_dosen_pembimbing/siak_add/" onclick="add(this)">Tambah</a>
			</div>
			<hr>
			<table id = "dosenmatakuliah" class="table table-bordered table-striped table-hover table-contextual table-responsive">
				<thead>
					<tr align = "center">
						<td>NO</td>
						<td>Jenis Dosen</td>
						<td>Penguji</td>
						<td>Nama</td>
                        <td>Jumlah Mahasiswa Maksimal</td>
						<td>AKSI</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					foreach ($this->siak_data_list as $key => $value) {
						$i++;
						echo "<tr class='active'>";
						echo "<td align = 'center'>" . $i . "</td>";
						if($value['jenis_dosen_pembimbing']==1){
							echo "<td>Dosen Pembimbing I</td>";
						} elseif($value['jenis_dosen_pembimbing']==2){
							echo "<td>Dosen Pembimbing II</td>";
						} elseif($value['jenis_dosen_pembimbing']==3){
							echo "<td>Dosen Pembimbing III</td>";
						} elseif($value['jenis_dosen_pembimbing']==4){
							echo "<td>Dosen Penguji</td>";
						} else {
							echo "<td>-</td>";
						}
						echo $value['penguji']==TRUE?"<td>Ya</td>":"<td>Tidak</td>";
						echo "<td>" . $value['nama'] . "</td>";
						echo "<td>" . $value['jml_mahasiswa_max'] . "</td>";
						
						echo "<td align = 'center'> 
						      <a class='btn blue mini' data-toggle='modal' data-target='#editDos' onclick='edit(this)' link= '".URL."siak_dosen_pembimbing/siak_edit/".$value['id']."'><i class='icon-edit'></i> Ubah</a>";
						echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusDos" onclick="kirim_id(\''.$value['id'].'\',\''.$value['nama'].'\')"><i class="icon-trash"></i> Hapus</a>
						      </td>';
						      
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
			
			</div>
		</div>
	</div>
</div>
<div id="addDos" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="add">
	
	</div>
</div>
<div id="editDos" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Edit Data</h3>
	</div>
	<div id="edit">
	
	</div>
</div>
<div id="hapusDos" class="modal hide fade" tabindex="-1" data-backdrop="static">
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
<script type="text/javascript">
$(document).ready(function() {
    $('#dosenmatakuliah').DataTable();
} );

function ubahSem(value){
	var strURL = "<?php echo URL;?>siak_dosen_pembimbing/penguji";
	var jenis = document.getElementById('jenis').value;
	
	jQuery.ajax({
		url: strURL + '/' + jenis,
		success: function(res){
			$('#getmatkul').html(res);
		}
	});
}

function ubahSemedit(value){
	var strURL = "<?php echo URL;?>siak_dosen_pembimbing/penguji_edit";
	var jenis = document.getElementById('edit_jenis').value;
	var kode = document.getElementById('edit_kode').value;
	var penguji = document.getElementById('edit_penguji').value;
	var jml = document.getElementById('edit_jml').value;
	var semua = document.getElementById('edit_semua').value;
	
	jQuery.ajax({
		url: strURL + '/' + jenis + '/' + semua,
		success: function(res){
			$('#getmatkuledit').html(res);
		}
	});
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_dosen_pembimbing/siak_delete/"+id);
}

function addVariables(){
	var varGroups = document.getElementById("variablegroups");
	var rnumber=Math.random();
	var htmls = "<select name = 'dosen_pendamping[]' class='chosen span12'><?php foreach ($this->dosen_pendamping as $key => $val) { $prodi = explode(',', $val['prodi_ngajar']); /*if(in_array($_POST['prodi'],$prodi)){*/?><option value='<?php echo $val['nip']; ?>'><?php echo $val['nama']; ?></option><?php /*}*/ } ?> </select><button class='btn red mini' type='button' onClick=\"deleteThisVar(this);\">Hapus</button>";
	$("#variablegroups").append($("<div class='input-group' id=\'"+ rnumber +"\'>"+ htmls +"<br><br></div>"));	
}
</script>