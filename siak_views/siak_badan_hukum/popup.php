<?php
	foreach ($css = explode(',', CSS) as $key) { echo '<link rel="stylesheet" type="text/css" href="'.URL.$key.'">'; }
?>
<script type="text/javascript">
	function gets(val){
		window.opener.document.getElementById('kode_hukum').value = val;
		window.close();
	}
</script>
	<table id="badan_hukum" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>KODE</td>
				<td>SINGKATAN</td>
				<td>NAMA</td>
				<td>KOTA</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr class='active'>"; ?>
				<td><a href='#' onClick="gets('<?php echo $value['kode_kampus']; ?>')"><?php echo $value['kode_kampus'];?></a></td>
			<?php
				echo "<td>" . $value['singkatan'] . "</td>";
				echo "<td>" . $value['nama'] . "</td>";
				echo "<td>" . $value['kota'] . "</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>