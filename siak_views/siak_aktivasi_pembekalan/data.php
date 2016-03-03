<?php if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
	<?php if ($this->creates == "t") { ?>
		<div class="input-group">
			<a href="<?php echo URL; ?>siak_gedung/siak_add/" id='variousG0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>
		</div>
		<hr>
		<?php } ?>
		<table id = "gedung" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
		<tr align = "center">
			<td>NO</td>
			<td>NAMA</td>
			<td>STATUS</td>
			<td>KETERANGAN</td>
			<td>ACTION</td>
		</tr>
		</thead>
		<tbody>
		<?php
		$i = 0;
		foreach ($this->siak_data_list as $key => $value) {

			$i++;
			echo "<tr class='active'>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td>" . $value['nama'] . "</td>";
			foreach ($this->status_gedung as $key => $val) { 
				$untuk = explode(',', $val['untuk']);
				if(in_array("gedung", $untuk)){
					if ($value['status'] == $val['nilai']) {
						echo "<td>" . $val['nama'] . "</td>";
					}
				}
			}
			echo "<td>" . $value['keterangan'] . "</td>";
			echo "<td align='center'>";
			echo $this->updates=="t"?"<a id='variousG$i' href = '".URL."siak_gedung/siak_edit/".$value['id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
			echo "&nbsp";
			echo $this->deletes=="t"?"<a href = '".URL."siak_gedung/siak_delete/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
			echo "</td></tr>";
			}
		?>
		</tbody>
	</table>
	<script type="text/javascript">
	askDelete();
	fancy();
	asd();
	</script>
	<?php }else{ ?>
	<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
	<?php } ?>