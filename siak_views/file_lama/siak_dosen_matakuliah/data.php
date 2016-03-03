<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Daftar Kegiatan</div>
			</div>
			<div class="portlet-body">
			
			<div class="input-group">
				<a class=" btn purple btn-large" href="#addDos" data-toggle="modal" link="<?php echo URL; ?>siak_dosen_matakuliah/siak_add/" onclick="add(this)">Tambah</a>
			</div>
			<hr>
			<table id = "dosenmatakuliah" class="table table-bordered table-striped table-hover table-contextual table-responsive">
				<thead>
					<tr align = "center">
						<td>NO</td>
						<td>Kode Matakuliah</td>
						<td>Dosen Utama</td>
						<td>Dosen Pendamping</td>
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
						echo "<td>" . $value['kode_matkul'] . "</td>";
						if($value['dosen_utama'] != NULL){
							foreach ($this->siak_dosen as $key => $val) {
								$nip = explode(',', $value['dosen_utama']);
								$dosen = "";
								if( $val['nip'] == $nip[0]){
									echo "<td>".$val['nama']."</td>";
								}
							}
						}else{
							echo "<td></td>";
						}

						if($value['dosen_pendamping'] != NULL){
							foreach ($this->siak_dosen as $key => $val) {
								$nip = explode(',', $value['dosen_pendamping']);
								$dosen = "";
								if( $val['nip'] == $nip[0]){
									echo "<td>".$val['nama']."</td>";
								}
							}
						}else{
							echo "<td></td>";
						}

// 						echo "<td align = 'center'>";
// 						
// 						echo "<a id='variousK$i' href = '".URL."siak_dosen_matakuliah/siak_edit/".$value['id']."'> <span class='glyphicon glyphicon-edit'></span> </a> &nbsp";
// 						echo "<a href = '".URL."siak_dosen_matakuliah/siak_delete/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>";
// 						
// 						echo "</td>";
						
						
						echo "<td align = 'center'> 
						      <a class='btn blue mini' data-toggle='modal' data-target='#editDos' onclick='edit(this)' link= '".URL."siak_dosen_matakuliah/siak_edit/".$value['id']."'><i class='icon-edit'></i> Edit</a>";
						echo '<a class="btn red mini" data-toggle="modal" data-target="#hapusDos" onclick="kirim_id(\''.$value['id'].'\',\''.$value['kode_matkul'].'\')"><i class="icon-trash"></i> Delete</a>
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
		<a type="button" class="btn green" id="hapusK" href="#">Hapus</a>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#dosenmatakuliah').DataTable();
} );

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan menghapus <strong>"+nama+"</strong> dari tabel, klik Hapus untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL; ?>siak_dosen_matakuliah/siak_delete/"+id);
}
</script>