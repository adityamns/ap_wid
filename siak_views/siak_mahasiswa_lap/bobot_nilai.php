<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2">NO</td>
			<td rowspan="2">NIM</td>
			<td rowspan="2">NAMA</td>
			<td >PRODI</td>
			<td rowspan="2">TAHUN MASUK</td>
			<td rowspan="2">STATUS</td>
			
			
		</tr>
	</thead> 
	<tbody>
		<?php
		$asd = array();
		foreach ($this->data_nilai_mhs as $key => $value) {
			$asd[] =  $value['nim'];
		}
		$i = 0;
		foreach ($this->data_mahasiswa as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td>" . $value['nim'] . "<input type='hidden' id='nim' value='" . $value['nim'] . "'></td>";
			echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
			
						echo "<td align='center' >".$value['prodi']."</td>";
						echo "<td align='center'>".$value['tahun_masuk']."</td>";
						echo "<td align='center'>".$value['nama']."</td>";
						
					}
				
		?>
	</tbody>
</table>