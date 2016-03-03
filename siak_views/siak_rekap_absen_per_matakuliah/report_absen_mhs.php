
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2">NO</td>
			<td rowspan="2">NIM</td>
			<td rowspan="2">NAMA</td>
            <td rowspan="2">ACTION</td>
		</tr>
	</thead> 
	<tbody>
		<?php
		$i = 0;
		foreach ($this->data_mahasiswa as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td>" . $value['nim'] . "<input type='hidden' id='nim' value='" . $value['nim'] . "'></td>";
			echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
			echo "<td align='center'><a id='variousY$i' href = '".URL."siak_rekap_absen_per_matakuliah/getDetail/".$this->prodi."/".$this->semester."/".$value['nim']."/".$this->matkul."/".$this->cohort."'> <span class='glyphicon glyphicon-check'>DETAIL</span> </a></td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>