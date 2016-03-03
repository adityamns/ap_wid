<?php //if ($this->reades == "t" && $this->loads == "t") { 
var_dump($this->data);
?>
<div class="panel panel-primary">
	<div class="panel-body" >
	<?php //if ($this->creates == "t") { ?>
		<div class="input-group">
			<a href="<?php echo URL; ?>siak_pendaftaran_wisuda/verifikasi" id='variousP0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>
		</div>
		<hr>
	<?php //} ?>
		<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NIM</td>
				<td>TANGGAL</td>
				<td>KETERANGAN</td>
				<td>ACTION</td>
			</tr>
			</thead>
			<tbody>
			<?php
			$i = 0;
			foreach ($this->data as $key => $value) {
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td>" . $value['nim'] . "</td>";
				echo "<td>" . $value['tgl_penyerahan'] . "</td>";
				echo "<td>" . $value['keterangan'] . "</td>";
				echo "<td align = 'center'>";
				echo $this->updates=="t"?"<a id='variousM$i' href = '".URL."siak_pendaftaran_wisuda/siak_edit/".$value['wisuda_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
				echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_pendaftaran_wisuda/siak_delete/".$value['wisuda_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
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
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>