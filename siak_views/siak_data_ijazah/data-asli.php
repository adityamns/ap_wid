<div class="panel panel-primary">
	<div class="panel-body" >
		<div class="input-group">
			<a href="<?php echo URL; ?>siak_dosen_matakuliah/siak_add/" id='variousK0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>
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

					echo "<td align = 'center'> <a id='variousK$i' href = '".URL."siak_dosen_matakuliah/siak_edit/".$value['id']."'> <span class='glyphicon glyphicon-edit'></span> </a> &nbsp <a href = '".URL."siak_dosen_matakuliah/siak_delete/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a></td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		<script type="text/javascript">
			askDelete();
			fancy();
			asd();
		</script>