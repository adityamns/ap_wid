<?PHP
// echo "<pre>";
// var_dump($this->data_list);
// echo "</pre>";
// $time3='2015-01-23 18:16:00';
// $saveTime = strtotime($time3); // Saved time from file/database
// echo $saveTime;
// $thisTime = time(); // Current time
// $diffTime = ($saveTime-$thisTime); // Difference in time
// echo "<br>".$thisTime;
// echo "<br>".$diffTime;

  // if($diffTime >= 1) {
    // $countMin = floor($diffTime/60);
    // $countSec = ($diffTime-($countMin*60));
    // echo 'Time remaining until next run is in ',$countMin,' minute(s) ',$countSec,' seconds';
  // } else {
    // echo 'Timer expired.';
  // }
?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>Index</div>
		
	</div>
	<div class="portlet-body">

				<table id = "konfirmasi" class="table table-striped table-bordered table-hover table-full-width">
					<thead>
						<tr align = "center">
							<td>NO</td>
							<td>PRODI</td>
							<td>COHORT</td>
							<td>MATAKULIAH</td>
							<td>TANGGAL / JAM</td>
							<td>PERTEMUAN-KE</td>
							<td>ACTION</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($this->data_list as $key => $value) {
							$i++;
							echo "<tr class='active'>";
							echo "<td align = 'center'>" . $i . "</td>";
							echo "<td align = 'center'>" . $value['prodi_id'] . "</td>";
							echo "<td align = 'center'>" . $value['cohort'] . "</td>";
							echo "<td align = 'center'>" . $value['nama_matkul'] . "</td>";
							echo "<td align = 'center'>" . $value['tanggal2'] . "</td>";
							echo "<td align = 'center'>" . $value['pertemuanke'] . "</td>";
							echo "<td align = 'center'><div class='btn-group'>";
					if($value['status']=='belum'){
							echo"
									<form target='_blank' method = 'post' action='".URL."siak_absensi_mahasiswa/DATA_KONFIRMASI'>
										<input type='hidden' value='" . $value['kode_matkul'] . "' name='matkul'>
										<input type='hidden' value='" . $value['prodi_id'] . "' name='prodi'>
										<input type='hidden' value='" . $value['tanggal'] . "' name='tanggal'>
										<input type='hidden' value='" . $value['pertemuanke'] . "' name='pertemuanke'>
										<input type='hidden' value='" . $value['cohort'] . "' name='cohort'>	
										<button class='btn green' type='submit'>konfirmasi mhs</button>
									</form>";
						}
					else{
						echo"<div class='btn-group'>
									<form target='_blank' method = 'post' action='".URL."siak_absensi_mahasiswa/DATA_KONFIRMASI'>
										<input type='hidden' value='" . $value['kode_matkul'] . "' name='matkul'>
										<input type='hidden' value='" . $value['prodi_id'] . "' name='prodi'>
										<input type='hidden' value='" . $value['tanggal'] . "' name='tanggal'>
										<input type='hidden' value='" . $value['pertemuanke'] . "' name='pertemuanke'>
										<input type='hidden' value='" . $value['cohort'] . "' name='cohort'>	
										<button class='btn orange' type='submit'>ubah</button>
									</form>";
// 						echo"<form><button class='btn green' type='button' disabled>konfirmasi mhs</button></form>";
					}
					if($value['konfirmasi_dosen']==null){
						echo"
									<form target='_blank' method = 'post' action='".URL."siak_absensi_mahasiswa/DATA_KONFIRMASI_DOSEN'>
										<input type='hidden' value='" . $value['kode_matkul'] . "' name='matkul'>
										<input type='hidden' value='" . $value['prodi_id'] . "' name='prodi'>
										<input type='hidden' value='" . $value['tanggal'] . "' name='tanggal'>
										<input type='hidden' value='" . $value['pertemuanke'] . "' name='pertemuanke'>
										<input type='hidden' value='" . $value['cohort'] . "' name='cohort'>	
										<button class='btn blue' type='submit'>konfirmasi dosen</button>
									</form>";
					}else{
// 						echo"<div class='btn-group'>
// 									<form target='_blank' method = 'post' action='".URL."siak_absensi_mahasiswa/DATA_KONFIRMASI_DOSEN'>
// 										<input type='hidden' value='" . $value['kode_matkul'] . "' name='matkul'>
// 										<input type='hidden' value='" . $value['prodi_id'] . "' name='prodi'>
// 										<input type='hidden' value='" . $value['tanggal'] . "' name='tanggal'>
// 										<input type='hidden' value='" . $value['pertemuanke'] . "' name='pertemuan'>
// 										<input type='hidden' value='" . $value['cohort'] . "' name='cohort'>	
// 										<button class='btn blue' type='submit'>ubah absen dosen</button>
// 									</form>";
						echo"<form><button class='btn green' type='button' disabled>konfirmasi mhs</button></form>";
					}					
					echo"<form method = 'post' action='".URL."siak_absensi_mahasiswa/delete_absen'>
						<input type='hidden' value='" . $value['kode_matkul'] . "' name='matkul'>
						<input type='hidden' value='" . $value['prodi_id'] . "' name='prodi'>
						<input type='hidden' value='" . $value['tanggal'] . "' name='tanggal'>
						<input type='hidden' value='" . $value['pertemuanke'] . "' name='pertemuanke'>
						<input type='hidden' value='" . $value['cohort'] . "' name='cohort'>	
						<button class='btn red' type='submit'>hapus</button>
					</form></div>
					</td>";
							 echo "</tr>";
						}
						?>
					</tbody>
				</table>
				<div id="statediva" style="width:500px;margin-top:-15px;margin-left:500px;">

				</div>
				</div>
				</div>
				
<script type="text/javascript">
	$(document).ready(function() {
		$('#konfirmasi').DataTable();
	});
</script>