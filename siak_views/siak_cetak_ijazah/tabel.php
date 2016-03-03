
<table id = "example" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2" width="5%">NO</td>
			<td rowspan="2" width="15%">NO IJAZAH</td>
			<td rowspan="2" width="15%">NIM</td>
			<td rowspan="2" width="15%">NAMA</td>
			
            <td rowspan="2" align="center">AKSI</td>

		</tr>
		
	</thead> 
	<tbody>
		<?php
		$i = 0;
		foreach ($this->laporan as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td align = 'center'>".$value['no_ijazah']."</td>";
			echo "<td align = 'center'>".$value['nim']."<input type='hidden' name='x[]' value='" . $i . "'><input type='hidden' id='nim' value='" . $value['nim'] . "'><input type='hidden' name='nim_baru[]' value='" . $value['nim'] . "'></td>";
			echo "<td align = 'center'>".$value['nama_depan']." ".$value['nama_belakang']."</td>";
			
			
			echo "<td align='center' width='20%'> 	<form action='".URL."siak_cetak_ijazah/ijazahok/".$value['nim']."' method='post' target='_BLANK'> 
				<input type='hidden' name='x' value='".$value['nim']."'>
											<button type = 'submit' class = 'btn btn-medium btn-warning' />CETAK</button>
											</form>
						</td>";
			echo "</tr>";
		}
		
		?>
	</tbody>
</table>
