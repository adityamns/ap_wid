<div class="panel panel-primary">
	<div class="panel-body" >
		<div class="input-group">
			<a href="<?php echo URL; ?>siak_bobot_absen/siak_add/" id='variousM0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>
		</div>
		<hr>
		<table id="modul" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NAMA</td>
				<td>KODE</td>
				<td>NILAI</td>
				<td>ACTION</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=0;
			$yes = "<td><span class='glyphicon glyphicon-ok' style='color:green'></span></td>";
			$no = "<td><span class='glyphicon glyphicon-minus' style='color:red'></span></td>";
			foreach ($this->siak_data_list as $key => $value) {
				$i++;
				echo "<tr>";
				echo "<td>" . $i . "</td>";
				echo "<td>" . $value['nama'] . "</td>";
				echo "<td>" . $value['kode'] . "</td>";
				echo "<td>" . $value['nilai'] . "</td>";				
				echo "<td align = 'center'> <a id='variousM$i' href = '".URL."siak_bobot_absen/siak_edit/".$value['id']."'> <span class='glyphicon glyphicon-edit'></span> &nbsp </a> <a href = '".URL."siak_bobot_absen/siak_delete/".$value['id']."' class='ask'><span class='glyphicon glyphicon-trash'></span> </a></td>";
				echo "</tr>";
			}
			?>
		</tbody>
		</table>
	<script type="text/javascript">
	fancy();
	asd();
	askDelete();
	</script>