<?php if ($this->reades == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
	<?php if ($this->creates == "t") { ?>
		<div class="input-group">
			<a href="<?php echo URL; ?>siak_pembimbing/siak_add/" id='variousX0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>
		</div>
		<hr>
	<?php } ?>
		<table id = "aturan_nilai" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NAMA</td>
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
				echo $this->updates=="t"?"<td align = 'center'> <a id='variousX$i' href = '".URL."siak_pembimbing/siak_edit/".$value['id']."'> <span class='glyphicon glyphicon-edit'></span> </a>&nbsp <a href = '".URL."siak_pembimbing/siak_delete/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a></td>":"";
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
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>