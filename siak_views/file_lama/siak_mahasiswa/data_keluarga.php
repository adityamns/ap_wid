<div class="panel panel-default">
	<div class="panel-body" >
		<table class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>NAMA AYAH</td>
				<td>NAMA IBU</td>
				<td>NAMA SUAMI/ISTRI</td>
				<td>ACTION</td>
			</tr>
		</thead> 
		<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td>" . $value['nama_ayah'] . "</td>";
				echo "<td>" . $value['nama_ibu'] . "</td>";
				echo "<td>" . $value['nama_suamiistri'] . "</td>";
				echo "<td><a id='variousK$i' href = '".URL."siak_mahasiswa/data_keluarga/".$this->nim."/".$this->jenis."/edit'><button class='btn btn-default btn-xs'><span class='glyphicon glyphicon-edit'></span>Edit</button></a></td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	<script type="text/javascript">
	fancies();
	</script>