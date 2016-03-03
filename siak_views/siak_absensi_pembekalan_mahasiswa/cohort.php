	<div class="panel-body" style="width:500px;">
		<table width="50%" id = "prodi" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
				<tr align = "center">
					<td>NO</td>
					<td>COHORT</td>
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
					echo "<td>" . $value['cohort'] . "</td>";
					echo "<td align = 'center'> <a id='variousC$i' href = '".URL."siak_absensi_mahasiswa/form_absen/".$this->prodi."/".$value['cohort']."'>ABSENSI</a></td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>