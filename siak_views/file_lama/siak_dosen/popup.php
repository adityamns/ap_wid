<?php
	foreach ($css = explode(',', CSS) as $key) { echo '<link rel="stylesheet" type="text/css" href="'.URL.$key.'">'; }
?>
<script type="text/javascript">
	function gets(val){
		window.opener.document.getElementById('nip').value = val;
		window.close();
	}
</script>
	<table id="dosen" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>NIP</td>
				<td>NAMA</td>
				<td>PROGRAM STUDI</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr class='active'>"; ?>
				<td><a href='#' onClick="gets('<?php echo $value['nip']; ?>')"><?php echo $value['nip'];?></a></td>
			<?php
				echo "<td>" . $value['nama'] . "</td>";
				foreach ($this->siak_prodi as $key => $val) {
					if($val[prodi_id] == $value[prodi_id]){
						echo "<td>" . $val['prodi'] . "</td>";
					}
				}
				echo "</tr>";
			}
			?>
		</tbody>
	</table>