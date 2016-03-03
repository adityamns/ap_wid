<?php
	foreach ($css = explode(',', CSS) as $key) { echo '<link rel="stylesheet" type="text/css" href="'.URL.$key.'">'; }
?>
<script type="text/javascript">
	function gets(val){
		window.opener.document.getElementById('matkul_id').value = val;
		window.close();
	}
</script>
	<table id="dosen" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>KODE MATAKULIAH</td>
				<td>NAMA MATAKULIAH</td>
				<td>SINGKATAN</td>
				
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 0;
			//var_dump($this->siak_data_list);die();
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr class='active'>"; ?>
				<td><a href='#' onClick="gets('<?php echo $value['kode_matkul']; ?>')"><?php echo $value['kode_matkul'];?></a></td>
			<?php
				echo "<td>" . $value['nama_matkul'] . "</td>";
				echo "<td>" . $value['singkatan'] . "</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>