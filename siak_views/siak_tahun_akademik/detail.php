<div class="span12">
	<div class="input-group">
			<span class="btn green btn-large" >DETAIL TAHUN AKADEMIK</span>
		</div>
		<hr>
	<div class='table-responsive' style="overflow:auto; overflow-y:hidden;">
	<table id="detail_tahun" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>TAHUN</td>
				<td>SEMESTER</td>
			
			</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td>" . $value['tahun'] . "</td>";
				echo "<td>" . $value['semester'] . "</td>";
				
				echo "</tr>";
			}
			?>
			</tbody>
		</table>
		</div>
		</div>
		<script>
			$('#detail_tahun').DataTable();
		</script>