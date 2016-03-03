<?php // if ($this->reades == "t") { ?>
<!--<div class="panel panel-primary">
	<div class="panel-body" >-->
	<?php //if ($this->creates == "t") { ?>
		<!--<div class="input-group">
			<a href="<?php echo URL; ?>siak_jadwal_sidang/siak_add/" id='variousJ0'><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></span> Add Data</button></a>
		</div>
		<hr>-->
	<?php //} ?>
    <div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
					<div class="caption"><i class="icon-globe"></i>Jadwal Sidang Proposal</div>
			</div>
		<div class="portlet-body">
		<table id = "jenis_ruang" class="table table-bordered table-striped table-hover table-contextual table-responsive">
		<thead>
		<tr align = "center">
			<td>NO</td>
			<td>NIM</td>
			<td>NAMA</td>
			<td>JUDUL TESIS</td>
			<td>WAKTU</td>
			<td>RUANG</td>
			<td>DETAIL</td>
			<!--<td>ACTION</td>-->
		</tr>
		</thead>
		<tbody>
		<?php
			$i = 0;
			foreach ($this->siak_data as $key => $value) {

				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td align = 'center'>" . $value['nim'] . "</td>";
				echo "<td align = 'center'>" .$value['nama_depan']. " ".$value['nama_belakang']."</td>";
				echo "<td align = 'center'>" . $value['judul'] . "</td>";
				$x = explode(" ",$value['start']);
				$y = explode("-",$x[0]);
				echo "<td align = 'center'>" . $y[2]."-".$y[1]."-".$y[0]." ".$x[1] . "</td>";
				echo "<td align = 'center'>" . $value['nama_ruang'] . "</td>";
				echo "<td align = 'center'><a class='btn green mini' data-toggle='modal' data-target='#editM' onclick='edit(this)' link='".URL."siak_jadwal_sidang_tesis/detailnya/".$value['nim']."/".$value['prodi']."/".$value['id']."'>DETAIL</a></td></tr>";
				// echo "<td align = 'center'><b>" .$value['prodi']. "</td><td align = 'center'>";
				// echo //$this->updates=="t"?
				// "<a  href = '".URL."siak_jadwal_sidang/create/".$value['tahun']."/".$value['tahun_id']."/".$value['prodi_id']."'> <span class='glyphicon glyphicon-edit'></span> </a>"
				//:""
				// ;
				// echo //$this->deletes=="t"?
				// "&nbsp <a href = '".URL."siak_jadwal_sidang/siak_delete/".$value['id']."' class='ask'> <span class='glyphicon glyphicon-trash'></span> </a>"
				//:""
				// ;
			// echo "</td></tr>";
		}
		?>
		</tbody>
	</table>
    </div>
	</div>
</div>
</div>

<div id="editM" class="modal hide fade" data-width="760">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h3>Detail</h3>
				</div>
				<div id="edit">
				
				</div>
			</div>
	<script type="text/javascript">
	$(document).ready(function() {
    $('#jenis_ruang').DataTable();
} );
	/* askDelete();
	fancy();
	asd(); */
	</script>
<?php // }else{ ?>
<!--<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>-->
<?php //} ?>