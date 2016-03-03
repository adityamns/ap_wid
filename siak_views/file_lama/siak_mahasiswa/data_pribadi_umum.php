<div class="panel panel-default">
	<div class="panel-body" >
		<table class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>NAMA</td>
				<td>TELP/HP</td>
				<td>ALAMAT</td>
				<td>ACTION</td>
			</tr>
		</thead> 
		<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
				echo "<td>" . $value['telp_rumah'] . " / " . $value['handphone'] . "</td>";
				echo "<td>" . $value['alamat_rumah'] . "</td>";
				echo "<td><a id='variousP$i' href = '".URL."siak_mahasiswa/data_pribadi/".$this->nim."/".$this->jenis."/edit'><button class='btn btn-default btn-xs'><span class='glyphicon glyphicon-edit'></span>Edit</button></a></td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	<script type="text/javascript">
	fancies();
	</script>