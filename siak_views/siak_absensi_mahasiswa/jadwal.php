	
		<table id = "prodi" class="table table-striped table-bordered table-hover table-full-width">
			<thead>
				<tr align = "center">
					<td>NO</td>
					<td>HARI/TANGGAL</td>
					<td>WAKTU</td>
					<td>TOPIK</td>
					<td>COHORT</td>
					<td>ACTION</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($this->data_list as $key => $value) {
					$i++;
					echo "<tr class='active'>";
					echo "<td align = 'center'>" . $i . "</td>";
					echo "<td>" . $value['tanggal'] . "</td>";
					echo "<td>" . $value['mulai'] . "</td>";
					echo "<td align = 'center'>" . $value['kode_topik'] . "</td>";
					echo "<td align = 'center'>" . $value['cohort'] . "</td>";
					if ($value['absen']!=''){
					echo "<td align = 'center'>
					<form target='_blank' method = 'post' action='".URL."siak_absensi_mahasiswa/absensi_cetak'>
						<input type='hidden' value='" . $value['kode_matkul'] . "' name='matkul'>
						<input type='hidden' value='" . $value['prodi_id'] . "' name='prodi'>
						<input type='hidden' value='" . $value['mulai'] . "' name='tanggal'>
						<input type='hidden' value='" . $value['kode_topik'] . "' name='topik'>
						<input type='hidden' value='" . $value['cohort'] . "' name='cohort'>	
						<input type='hidden' value='" . $value['pertemuanke'] . "' name='pertemuanke'>	
						<button type='submit'>BUKA</button>
					</form>
					</td>";}
					else{
						echo "<td align = 'center'>
					<form method = 'post' action='".URL."siak_absensi_mahasiswa/absensi/".$value['cohort']."'>
						<input type='hidden' name='semester' value='" . $value['semester'] . "' >
						<input type='hidden' name='topik' value='" . $value['kode_topik'] . "' >
						<input type='hidden' name='prodi' value='" . $value['prodi_id'] . "' >
						<input type='hidden' name='matkul' value='" . $value['kode_matkul'] . "' >
						<input type='hidden' name='tanggal' value='" . $value['mulai'] . "' >
						<input type='hidden' name='pertemuanke' value='" . $value['pertemuanke'] . "' >	
						<button type='submit'>ABSEN</button>
					</form>
					</td>";
					}
					echo "</tr>";
				}
				?>
			</tbody>
		</table>