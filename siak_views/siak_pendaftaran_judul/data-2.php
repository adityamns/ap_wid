<?php //if ($this->reades == "t" && $this->loads == "t") { ?>
<div class="panel panel-primary">
	<div class="panel-body" >
	<?php if ($this->creates == "t") { ?>
		<div class="input-group">
			<a href="<?php echo URL; ?>siak_pendaftaran_judul/siak_add/" id='variousP0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>
		</div>
		<hr>
	<?php } ?>
		<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NIM</td>
				<td>NAMA</td>
				<td>JUDUL TESIS</td>
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
					foreach($this->siak_mahasiswa as $x =>$row){
						if($value['nim']==$row['nim']){
						echo "<td>" .$row['nama_depan']." ".$row['nama_belakang']. "</td>";
					}
					}
				echo "<td>" . $value['judul'] . "</td>";
				if($value['status'] == 1){
					echo "<td align='center'><font color='orange'><span class='glyphicon glyphicon-record' title='Pending' style='cursor:pointer;'></span></font></td>";
					echo "<td align = 'center'>";
					echo $this->updates=="t"?"<a id='variousM$i' href = '".URL."siak_pendaftaran_judul/siak_edit/".$value['judultesis_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>":"";
					echo $this->deletes=="t"?"&nbsp <a href = '".URL."siak_pendaftaran_judul/siak_delete/".$value['judultesis_id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>":"";
					echo "</td></tr>";
				} else if($value['status'] == 2){
					echo "<td align='center'><font color='green'><span class='glyphicon glyphicon-record' title='Konfirmasi' style='cursor:pointer;'></span></font></td>";
					echo "<td align = 'center'> - </td></tr>";
				} else if($value['status'] == 3) {
					echo "<td align='center'><font color='red'><span class='glyphicon glyphicon-record' title='Sidang Proposal' style='cursor:pointer;'></span></font></td>";
					echo "<td align = 'center'> - </td></tr>";
				} else {
					echo "<td align='center'><font color='blue'><span class='glyphicon glyphicon-record' title='Wisuda' style='cursor:pointer;'></span></font></td>";
					echo "<td align = 'center'> - </td></tr>";
				}
			}
			?>
			</tbody>
		</table>
		<div class="panel-body">
			<br><br><br>
			<div id="statediva">
			
			</div>
			
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>