<div class="panel panel-primary">
	<div class="panel-body" >
		<table class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>NAMA</td>
				<td>TAHUN</td>
				<td>KETERANGAN</td>
				<td>ACTION</td>
			</tr>
		</thead> 
		<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td>" . $value['nama'] . "</td>";
				echo "<td>" . $value['tahun'] . "</td>";
				echo "<td>" . $value['keterangan'] . "</td>";
				echo "<td><a id='variousT$i' href = '".URL."siak_mahasiswa/data_riwayat_pendidikan/".$this->nim."/".$this->jenis."/edit/".$value['id']."'><span class='glyphicon glyphicon-edit'></span></a>&nbsp <a href = '".URL."siak_mahasiswa/siak_delete/".$value['nim']."/riwayat_pendidikan_mahasiswa/".$value['id']."/".$this->jenis."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a></td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	<script type="text/javascript">
	askDelete();
	fancies();
	</script>