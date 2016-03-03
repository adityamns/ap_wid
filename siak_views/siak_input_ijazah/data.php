<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Input No Ijazah</div>
			</div>
			<div class="portlet-body">
			
			<div class="input-group">
				<a class=" btn purple btn-large" href="#addDos" data-toggle="modal" link="<?php echo URL; ?>siak_input_ijazah/siak_add/" onclick="add(this)">Tambah</a>
			</div>
			<hr>
			<table id = "dosenmatakuliah" class="table table-bordered table-striped table-hover table-contextual table-responsive">
				<thead>
					<tr align = "center">
						<td>NO</td>
						<td>NO IJAZAH</td>
						<td>NIM</td>
						
						<td>PRODI</td>
						<td>ACTION</td>
					</tr>
				</thead>
				<tbody>
					<?php
	// 				var_dump($this->siak_data_list);
					$i = 0;
					foreach ($this->siak_data_list as $key => $value) {
						$i++;
						echo "<tr class='active'>";
						echo "<td align = 'center'>" . $i . "</td>";
						echo "<td>" . $value['no_ijazah'] . "</td>";
						echo "<td>" . $value['nim'] . "</td>";
						
						echo "<td>" . $value['prodi_id'] . "</td>";
						
						
						echo "<td align = 'center'> 
						       <a class='btn blue mini' data-toggle='modal' data-target='#editDos' onclick='edit(this)' link= '".URL."siak_input_ijazah/siak_edit/".$value['id']."'><i class='icon-edit'></i> Ubah</a>";
						echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusDos" onclick="kirim_id(\''.$value['id'].'\',\''.$value['no_ijazah'].'\')"><i class="icon-trash"></i> Hapus</a>
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
	var strURL = "<?php echo URL;?>siak_input_ijazah/mahasiswa";
	var cohort = document.getElementById('cohort').value;
	var prodi = document.getElementById('prodi_id').value;
	
// 	alert(strURL + '/' + prodi + '/' + cohort);
	
	jQuery.ajax({
		url: strURL + '/' + prodi + '/' + cohort ,
		success: function(res){
			$('#getmatkul').html(res);
		}
	});
}

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus no ijazah <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_input_ijazah/siak_delete/"+id);
}


</script>