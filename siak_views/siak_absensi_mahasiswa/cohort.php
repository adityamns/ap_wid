	
		<?php //if ($this->creates == "t") { ?>
				
				
		<table id = "prodi" class="table table-striped table-bordered table-hover table-full-width">
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
					echo "<td align = 'center'> <a onclick='getForm(this)' data-toggle='modal' data-target='#dialog1' href='#' url='".URL."siak_absensi_mahasiswa/form_absen/".$this->prodi."/".$value['cohort']."'>ABSENSI</a></td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		