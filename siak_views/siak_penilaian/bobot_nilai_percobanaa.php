
<table width="30%"  id="fakultas" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	
	<thead>
		<tr align='center'>
			<td colspan='2'><strong>BOBOT NILAI</strong></td>
		</tr>
	</thead>
	<?php  foreach ($this->data as $key => $value) { ?>
		<tbody>
		<tr>
			<td>PRESENTASI</td>
			<td align='center'><strong><?php echo $value['presentasi'];?>%</strong></td>
		</tr>
		<tr>
			<td>TUGAS MANDIRI</td>
			<td align='center'><strong><?php echo $value['tugas_mandiri'];?>%</strong></td>
		</tr>
		<tr>
			<td>UTS</td>
			<td align='center'><strong><?php echo $value['uts'];?>%</strong></td>
		</tr>
		<tr>
			<td>UAS</td>
			<td align='center'><strong><?php echo $value['uas'];?>%</strong></td>
		</tr>
		</tbody>
	
	
	<?php } ?>
</table>

</div>
	
	<div class="panel-body" style="width:500px;margin-top:-205px;margin-left:500px;">
		<table width="50%" align="left" id="fakultas" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
				<tr align = "center"><td colspan='7'><strong>NILAI MAHASISWA</strong></td></tr>
				<tr align = "center">
					<td>NO</td>
					<td>NIM</td>
					<td>NAMA</td>
					<td>PRESENTASI</td>
					<td>TUGAS</td>
					<td>UTS</td>
					<td>UAS</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($this->data_nilai as $key => $value) {
					$i++;
					echo "<tr class='active'>";
					echo "<td align = 'center'>" . $i . "</td>";
					echo "<td>" . $value['NIM'] . "</td>";
					echo "<td>" . $value['nama_depan'] . "&nbsp;" . $value['nama_belakang'] . "</td>";
					echo "<td>" . $value['presentasi'] . "</td>";
					echo "<td>" . $value['tugas_mandiri'] . "</td>";
					echo "<td>" . $value['UTS'] . "</td>";
					echo "<td>" . $value['UAS'] . "</td>";
					
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
