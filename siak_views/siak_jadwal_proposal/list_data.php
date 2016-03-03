<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET -->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>LIST PESERTA SIDANG PROPOSAL</div>
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
					<td>JUDUL TESIS</td>
					<td>STATUS</td>
					
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
					echo "<td>" .$value['nama_depan']." ".$value['nama_belakang']. "</td>";						
					if($value['dosen_pembimbing1'] != NULL){
						foreach ($this->siak_data_dosen as $key => $values1) {
							if ($value['dosen_pembimbing1'] == $values1['kode']) {
// 								echo "<td>" . $values['nama']. "</td>";
								$x1 = $values1['nama'];
							}
						}
							echo "<td>".$x1."</td>";
					// }else{ echo "<td>".$x1."</td>"; }
					}else{ echo "<td></td>"; }
					if($value['dosen_pembimbing2'] != NULL){
						foreach ($this->siak_data_dosen as $key => $values2) {
							if ($value['dosen_pembimbing2'] == $values2['kode']) {
// 								
								$x2 = $values2['nama'];
							}
						}
								echo "<td>".$x2." </td>";
					
					}else{echo "<td></td>";}
					echo "<td>" . $value['judul'] . " judul</td>";
					if($value['jadwal']!=''){
						echo "<td><a class='btn green mini disabled'><i class='icon-ok'></i>jadwal sudah tersedia</a></td>";
					}else{
						echo "<td><a class='btn red mini disabled'><i class='icon-ok'></i>jadwal belum tersedia</a></td>";	
					}
					echo "</tr>";
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