<?php 
//if ($this->loads == "t") { ?>
<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>Daftar Mahasiswa</div>
			</div>
			<div class="portlet-body">
				<div class="table-toolbar">
					<div class="btn-group pull-right">
						<button class="btn dropdown-toggle" data-toggle="dropdown">Cetak / Download <i class="icon-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right">
							<li><a href="#">Cetak</a></li>
							<li><a href="#">PDF</a></li>
							<li><a href="#">Excel</a></li>
						</ul>
					</div>
				</div>
				<br>
				<br>
				<?php //if ($this->reades == "t") { ?>
					<table id="example" class="table table-striped table-bordered table-hover table-full-width">
					<thead>
						<tr align = "center">
							<th>NO</th>
							<th>NIM</th>
							<th>NAMA</th>
							<th>PRODI</th>
							<th>STATUS</th>
							<th>COHORT</th>
							<th>TAHUN MASUK</th>
						</tr>
					</thead> 
					<tbody>
						<?php
						$i = 0;
						foreach ($this->siak_data_list as $key => $value) {
							$i++;
							echo "<tr class='active'>";
							echo "<td align = 'center'>" . $i . "</td>";
// 							echo $this->reades=="t"?"<td><a href = '".URL."siak_master/siak_mahasiswa/".$value['nim']."/".$value['jenis']."'>" . $value['nim'] . "</a></td>":"<td>" . $value['nim'] . "</td>";
							echo "<td><a href = '".URL."siak_master/siak_mahasiswa/".$value['nim']."/".$value['jenis']."'>" . $value['nim'] . "</a></td>";
							echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
							echo "<td>" . $value['prodi'] . "</td>";

							foreach ($this->status as $key => $val) { 
								$untuk = explode(',', $val['untuk']);
								if(in_array("mahasiswa", $untuk)){
									if ($value['status'] == $val['nilai']) {
										echo "<td>" . $val['nama'] . "</td>";
									}
								}
							}
							echo "<td>" . $value['cohort'] . "</td>";
							echo "<td>" . $value['tahun_masuk'] . "</td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
				<?php //} ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#mahasiswa').DataTable();
} );
</script>
<?php //}else{ ?>
<!-- <div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div> -->
<?php //} ?>