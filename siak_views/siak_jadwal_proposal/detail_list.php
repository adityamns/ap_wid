<div class="row-fluid">
	<div class="span12">
		<div class="portlet box blue">
			<div class="portlet-title">
					<div class="caption"><i class="icon-globe"></i>Jadwal Sidang Proposal</div>
			</div>
		<div class="portlet-body">
		<table id = "pengampu_pembekalan" class="table table-bordered table-striped table-hover table-contextual table-responsive">
			<thead>
			<tr align = "center">
				<td>NO</td>
				<td>NIM</td>
				<td>NAMA</td>
				<td>JUDUL PROPOSAL</td>
				<td>WAKTU</td>
                <td>RUANG</td>
                <td>DETAIL</td>
			</tr>
			</thead>
			<tbody>
            <?php $i = 0; ?>
            <?php foreach($this->siak_data as $siak => $data){
				$i++;
				echo "<tr class='active'>";
				echo "<td align = 'center'>" . $i . "</td>";
				echo "<td align = 'center'>" . $data['nim'] . "</td>";
				echo "<td align = 'center'>" .$data['nama_depan']. " ".$data['nama_belakang']."</td>";
				echo "<td align = 'center'>" . $data['judul'] . "</td>";
				$x = explode(" ",$data['start']);
				$y = explode("-",$x[0]);
				echo "<td align = 'center'>" . $y[2]."-".$y[1]."-".$y[0]." ".$x[1] . "</td>";
				echo "<td align = 'center'>" . $data['nama_ruang'] . "</td>";
				echo "<td align = 'center'><a class='btn green mini' data-toggle='modal' data-target='#editM' onclick='edit(this)' link='".URL."siak_jadwal_proposal/detailnya/".$data['nim']."/".$data['prodi']."/".$data['id']."'>DETAIL</a></td></tr>";
			} ?>
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

<script>
$(document).ready(function() {
    $('#pengampu_pembekalan').DataTable();
} );
</script>