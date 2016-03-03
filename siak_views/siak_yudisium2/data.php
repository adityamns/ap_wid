<?php if ($this->reades == "t" && $this->loads == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
		<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NIM</td>
				<td>NAMA</td>
				<td>PROGRAM STUDI</td>
				<td>STATUS</td>
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
					echo "<td>" . $value['nim'] . "</td>";
					echo "<td>" . $value['nama_depan'] .' '. $value['nama_belakang'] . "</td>";
					echo "<td>" . $value['prodi'] . "</td>";
					if($value['statusy'] == 1){
						echo "<td align='center'><font color='green'><span class='glyphicon glyphicon-ok'></span></font></td>";
					} elseif($value['statusy'] == 2){
						echo "<td align='center'><font color='red'><span class='glyphicon glyphicon-remove'></span></font></td>";
					}
					echo $this->updates=="t"?"<td align = 'center'> <a id='variousX$i' href = '".URL."siak_yudisium/siak_edit/".$value['nim']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
					echo "</tr>";
				}
			?>
			</tbody>
		</table>

		
		<div class="panel-body">
			<br><br><br>
			<div id="statediva">
			
			</div>
		<script type="text/javascript">
		askDelete();
		fancy();
		asd();


		jQuery(document).ready(function(){
	
});
		</script>
<?php }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>

