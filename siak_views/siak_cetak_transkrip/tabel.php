<form action="<?=URL?>siak_cetak_transkrip/cetak_transkrip_perprodi/<?php echo $this->cohort."/".$this->prodi ?>" method="post" target="_BLANK">
<table id = "example" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2" width="5%">NO</td>
			<td rowspan="2" width="15%">NIM</td>
			<td rowspan="2" width="15%">NAMA</td>
			
			<td rowspan="2" width="15%">PRODI ID</td>
            <td rowspan="2" width="10%">PRiEDIKAT</td>
            <td rowspan="2" width="10%">IPK</td>
            

		</tr>
	</thead> 
	<tbody>
		<?php
		$i = 0;
		foreach ($this->laporan as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td align = 'center'>".$value['nim']."<input type='hidden' name='x[]' value='" . $i . "'><input type='hidden' id='nim' value='" . $value['nim'] . "'><input type='hidden' name='nim_baru[]' value='" . $value['nim'] . "'></td>";
			echo "<td align = 'center'>".$value['nama_depan']." ".$value['nama_belakang']."</td>";
			echo "<td align = 'center'>".$value['prodi_id']."</td>";
			echo "<td align = 'center'>".$value['predikat']."</td>";
			echo "<td align = 'center'>".$value['ipk']."</td>";
			
			echo "</tr>";
		}
		?>
	</tbody>
</table>

<input type = "submit" value = "Cetak PDF" class = "btn btn-medium btn-primary "/>