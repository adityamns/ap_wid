<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Laporan Mahasiswa</h3>
	</div>
</div>
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive" width="100%">
	<thead>
		<tr align = "center">
			<td rowspan="2" width="10%">PRODI</td>
			<td rowspan="2">COHORT 1</td>
			<td rowspan="2">COHORT 2</td>
			<td rowspan="2">COHORT 3</td>
            <td rowspan="2">COHORT 4</td>
            <td rowspan="2">COHORT 5</td>
            <td rowspan="2">COHORT 6</td>
		</tr>
	</thead> 
	<tbody>
		<?php
		echo "<tr align='center'>";
		echo "<td>".$this->prod."</td>";
		foreach($this->laporan as $a => $b){
			echo "<td><a href = '".URL."siak_rekap_mahasiswa/identitas/".$b['cohort']."'>".$b['count']."
			</a></td>";
		}
		echo "</tr>";
		?>
	</tbody>
</table>