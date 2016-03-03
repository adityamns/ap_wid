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
								echo "<td></td>";
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
								echo "<td></td>";
					} 
					
					elseif($value['dosen_pembimbing2'] == NULL) { echo "<td align='center'> - </td>"; }
						if($value['dosen_pembimbing3'] != NULL){
							foreach ($this->siak_data_dosen as $key => $values) {
								if ($value['dosen_pembimbing3'] == $values['kode']) {
									echo "<td>" . $values['nama']. "</td>";
								}
							}
								echo "<td> </td>";
					} 
					
					elseif($value['dosen_pembimbing3'] == NULL) { 
					
					
					echo "<td align='center'> - </td>"; 
					
					
					}
					
					echo "<td>" . $value['judul'] . " judul</td>";
					
						if($value['status'] == 1){
							echo "<td align = 'center'>";
	// 						echo $this->updates=="t"?"<a id='variousM$i' href = '".URL."siak_konfirmasi_judul/siak_edit/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-check'>Konfirmasi</span> </a>":"";
							echo "<a id='variousM$i' href = '".URL."siak_konfirmasi_judul/siak_edit/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-check'>Konfirmasi</span> </a>";
							
							echo "</td></tr>";
							
						} else if($value['status'] == 2) {
							echo "<td align = 'center'>";
							
							echo "<a href = '".URL."siak_konfirmasi_judul/siak_batal/".$value['judultesis_id']."' class='ask'> <span class='glyphicon glyphicon-remove'>Batalkan</span> </a>";
							echo "<a type=\"button\" class=\" btn red mini\" href = '".URL."siak_konfirmasi_judul/siak_batal/".$value['judultesis_id']."'>Batalkan</a>";
							echo "</td></tr>";
							
						} else if($value['status'] == 3) {
							echo "<td align = 'center'> Sidang </td></tr>";
						} else {
							echo "<td align = 'center'> Wisuda </td></tr>";
						}
				}
				?>
				</tbody>
			</table>
			
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#pengampu_pembekalan').DataTable();
} );
</script>