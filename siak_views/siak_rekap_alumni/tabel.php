<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive" width="100%">
	<thead>
		<tr align = "center">
			<td rowspan="2" width="5%">NO</td>
			<td rowspan="2" width="15%">NIM</td>
            <td rowspan="2">NAMA</td>
			<td rowspan="2" width="5%">IPK</td>
			<td rowspan="2" width="15%">TAHUN MASUK</td>
            <td rowspan="2" width="10%">TAHUN LULUS</td>
		</tr>
	</thead> 
	<tbody>
		<?php
		$i = 0;
		foreach ($this->laporan as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td align = 'center'>" . $value['nim'] . "<input type='hidden' id='nim' value='" . $value['nim'] . "'></td>";
			echo "<td align = 'center'>" . $value['nama_depan'] ." ".$value['nama_belakang']. "</td>";
			echo "<td align = 'center'>" . $value['ipk'] . "</td>";
			echo "<td align = 'center'>".$value['tahun_masuk']."</td>";
			echo "<td align = 'center'>".$value['tahun_lulus']."</td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>
<div class="control-group">
	<label class="control-label">&nbsp</label>
	<div class="controls">
    <form action="<?=URL?>siak_rekap_alumni/pdf" method="post">
		<input type="hidden" name="prodi_id" value="<?=$value['prodi_id']?>">
        <input type="hidden" name="prodi" value="<?=$value['prodi']?>">
		<input type="hidden" name="cohort" value="<?=$value['cohort']?>">
		<button type = "submit" value = "PDF" name="pdf" id="pdf" class = "btn btn-medium btn-warning" style="float: left"/>PDF</button>
	</form>
    </div>
</div>