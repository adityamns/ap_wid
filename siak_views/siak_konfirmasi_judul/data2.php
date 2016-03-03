<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Daftar Mahasiswa</div>
			</div>
			<div class="portlet-body">			
			
			<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
				<thead>
				<tr align = "center">
					<td>NO</td>
					<td>NIM</td>
					<td>NAMA</td>
					<td>DOSEN PEMBIMBING I</td>
					<td>DOSEN PEMBIMBING II</td>
					<td>DOSEN PEMBIMBING III</td>
					<td>JUDUL TESIS</td>
					<td>ACTION</td>
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
				foreach ($this->siak_data_list as $key => $value) {
					$i++;
					echo "<tr class='active'>";
					echo "<td align = 'center'>" . $i . "</td>";
					echo "<td>" . $value['nim'] . "</td>";
						foreach($this->siak_mahasiswa as $x =>$row){
							if($value['nim']==$row['nim']){
								echo "<td>" .$row['nama_depan']." ".$row['nama_belakang']. "</td>";
							}
						}
					if($value['dosen_pembimbing1'] != NULL){
						foreach ($this->siak_data_dosen as $key => $values) {
							if ($value['dosen_pembimbing1'] == $values['kode']) {
								echo "<td>" . $values['nama']. "</td>";
							}
						}
// 								echo "<td></td>";
					} 
					
					elseif($value['dosen_pembimbing1'] == NULL) { 
					echo "<td align='center'> - </td>"; 
					}
						if($value['dosen_pembimbing2'] != NULL){
							foreach ($this->siak_data_dosen as $key => $values) {
								if ($value['dosen_pembimbing2'] == $values['kode']) {
									echo "<td>" . $values['nama']. "</td>";
								}
							}
// 								echo "<td></td>";
					} 
					
					elseif($value['dosen_pembimbing2'] == NULL) { echo "<td align='center'> - </td>"; }
						if($value['dosen_pembimbing3'] != NULL){
							foreach ($this->siak_data_dosen as $key => $values) {
								if ($value['dosen_pembimbing3'] == $values['kode']) {
									echo "<td>" . $values['nama']. "</td>";
								}
							}
// 								echo "<td> </td>";
					} 
					
					elseif($value['dosen_pembimbing3'] == NULL) { 
					
					
					echo "<td align='center'> - </td>"; 
					
					
					}
					
					if($_SESSION['level'] != 16){
					
					echo "<td>" . $value['judul'] . " judul</td>";
					
						if($value['status'] == 1){
							echo "<td align = 'center'>";
	// 						echo $this->updates=="t"?"<a id='variousM$i' href = '".URL."siak_konfirmasi_judul/siak_edit/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-check'>Konfirmasi</span> </a>":"";
// 							echo "<a id='variousM$i' href = '".URL."siak_konfirmasi_judul/siak_edit/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-check'>Konfirmasi</span> </a>";
							
							echo "<a class=\" btn purple mini\" href=\"#addSil\" data-toggle=\"modal\" link='".URL."siak_konfirmasi_judul/siak_edit/".$value['judultesis_id']."' onclick=\"add(this)\">Konfirmasi</a>";
							
							echo "</td></tr>";
							
						} else if($value['status'] == 2) {
							echo "<td align = 'center'>";
							
// 							echo "<a href = '".URL."siak_konfirmasi_judul/siak_batal/".$value['judultesis_id']."' class='ask'> <span class='glyphicon glyphicon-remove'>Batalkan</span> </a>";
// 							echo "<a type=\"button\" class=\" btn red mini\" href = '".URL."siak_konfirmasi_judul/siak_batal/".$value['judultesis_id']."'>Batalkan</a>";
							echo '
							      <a class="btn red mini" data-toggle="modal" data-target="#hapusSil" onclick="kirim_id(\''.$value['judultesis_id'].'\',\''.$value['nim'].'\')">Batalkan</a>
							      ';
							
							echo "</td></tr>";
							
						} else if($value['status'] == 3) {
							echo "<td align = 'center'> Sidang </td></tr>";
						} else {
							echo "<td align = 'center'> Wisuda </td></tr>";
						}
						
					}else{
					      echo "<td align = 'center'>asjfhbas</td></tr>";
					}
				}
				?>
				</tbody>
			</table>
			
			</div>
		</div>
	</div>
</div>

<div id="addSil" class="modal hide fade" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="add">
	
	</div>
</div>

<div id="hapusSil" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Batalkan Pengajuan Judul</h3>
	</div>
	<div class="modal-body">
		<span id="data"></span>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Kembali</button>
		<a type="button" class="btn green" id="hapus" href="#">Batalkan</a>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#pengampu_pembekalan').DataTable();
} );

function kirim_id(id,nama){
	document.getElementById('data').innerHTML = "Anda akan membatalkan Judul Proposal <strong>"+nama+"</strong>, klik Batalkan untuk melanjutkan.";
	$("#hapus").attr("href","<?php echo URL;?>siak_konfirmasi_judul/siak_batal/"+id);
}
</script>