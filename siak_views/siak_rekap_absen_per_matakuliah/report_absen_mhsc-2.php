
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2">NO</td>
			<td rowspan="2">NIM</td>
			<td colspan="16">PERTEMUAN</td>
		</tr>
		<tr align="center">
		    <td>1</td>
		    <td>2</td>
		    <td>3</td>
		    <td>4</td>
		    <td>5</td>
		    <td>6</td>
		    <td>7</td>
		    <td>8</td>
		    <td>9</td>
		    <td>10</td>
		    <td>11</td>
		    <td>12</td>
		    <td>13</td>
		    <td>14</td>
		    <td>15</td>
		    <td>16</td>
		</tr>
	</thead> 
	<tbody>
    KETERANGAN<p>
    H : HADIR<br>
    S : SAKIT<br>
    I : IZIN<br>
    TH : TIDAK HADIR
		<?php
		$i = 0;
		function check_data($mulai,$nim,$row){
			foreach($row as $k => $v){
				if($v['nim'] == $nim){
					foreach($mulai as $mu => $lai){
						if($v['tanggal'] == $lai['mulai']){
							return array(true, $v['status']);
						}
					}
				}
			}
			return array(false, '');
		}
		foreach ($this->data_mahasiswa as $key => $valueasd) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td align='center'>" . $valueasd['nama_depan'] . " ".$valueasd['nama_belakang']."<input type='hidden' id='nim' value='" . $valueasd['nim'] . "'></td>";
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p1);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H1H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H1S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H1I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H1A[] = $status;
				}
				
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p2);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H2H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H2S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H2I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H2A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p3);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H3H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H3S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H3I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H3A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p4);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H4H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H4S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H4I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H4A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p5);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H5H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H5S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H5I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H5A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p6);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H6H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H6S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H6I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H6A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p7);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H7H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H7S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H7I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H7A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p8);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H8H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H8S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H8I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H8A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p9);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H9H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H9S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H9I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H9A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p10);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H10H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H10S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H10I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H10A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p11);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H11H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H11S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H11I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H11A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p12);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H12H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H12S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H12I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H12A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p13);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H13H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H13S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H13I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H13A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p14);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H14H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H14S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H14I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H14A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p15);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H15H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H15S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H15I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H15A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
			
			$check_data = check_data($this->detail,$valueasd['nim'],$this->p16);
			if($check_data[0]){
// 				$status= $check_data[1]==1?"H":"TH";
				if($check_data[1]==1){
					$status = "H";
					$H16H[] = $status;
				}
				else if($check_data[1]==2){
					$status = "S";
					$H16S[] = $status;
				}
				else if($check_data[1]==3){
					$status = "I";
					$H16I[] = $status;
				}
				else if($check_data[1]==4){
					$status = "TH";
					$H16A[] = $status;
				}
					echo "<td align = 'center'>".$status."</td>";
			}else{
					echo "<td align='center'> - </td>";
			}
		}
		echo "</tr>";
		/*
		$i = 0;*/
		/*echo "<tr>";
		echo "<td>no</td><td>nim</td>";*/
		/*foreach ($this->data_mahasiswa as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td>" . $value['nim'] . "<input type='hidden' id='nim' value='" . $value['nim'] . "'></td>";
			function check_data($mulai, $row){
				foreach($row as $k => $v){
					if($v['tanggal'] == $mulai){
						return array(true, $v['status']);
					}
				}
				return array(false, '');
			}
			foreach ($this->detail as $yo => $sh) {
				$check_data = check_data($sh['mulai'],$this->absen);
					if($check_data[0]){
						$status= $check_data[1]==1?"HADIR":"TIDAK HADIR";
								echo "<td align = 'center'>".$status."</td>";
					}else{
							echo "<td align='center'> - </td>";
					}
			}
			echo "</tr>";
		}*/
		foreach($this->detail as $det => $ail){
			
		}
		?>
		<tr align = "center">
			<td colspan="18">&nbsp;</td>
		</tr>
		<tr align = "center">
			<td rowspan="5" style="vertical-align: middle;">TOTAL</td>
		</tr>
		<tr align = "center">
			<td>HADIR</td>
		    <td><?php echo count($H1H); ?></td>
		    <td><?php echo count($H2H); ?></td>
		    <td><?php echo count($H3H); ?></td>
		    <td><?php echo count($H4H); ?></td>
		    <td><?php echo count($H5H); ?></td>
		    <td><?php echo count($H6H); ?></td>
		    <td><?php echo count($H7H); ?></td>
		    <td><?php echo count($H8H); ?></td>
		    <td><?php echo count($H9H); ?></td>
		    <td><?php echo count($H10H); ?></td>
		    <td><?php echo count($H11H); ?></td>
		    <td><?php echo count($H12H); ?></td>
		    <td><?php echo count($H13H); ?></td>
		    <td><?php echo count($H14H); ?></td>
		    <td><?php echo count($H15H); ?></td>
		    <td><?php echo count($H16H); ?></td>
		</tr>
		<tr align = "center">
			<td>SAKIT</td>
		    <td><?php echo count($H1S); ?></td>
		    <td><?php echo count($H2S); ?></td>
		    <td><?php echo count($H3S); ?></td>
		    <td><?php echo count($H4S); ?></td>
		    <td><?php echo count($H5S); ?></td>
		    <td><?php echo count($H6S); ?></td>
		    <td><?php echo count($H7S); ?></td>
		    <td><?php echo count($H8S); ?></td>
		    <td><?php echo count($H9S); ?></td>
		    <td><?php echo count($H10S); ?></td>
		    <td><?php echo count($H11S); ?></td>
		    <td><?php echo count($H12S); ?></td>
		    <td><?php echo count($H13S); ?></td>
		    <td><?php echo count($H14S); ?></td>
		    <td><?php echo count($H15S); ?></td>
		    <td><?php echo count($H16S); ?></td>
		</tr>
		<tr align = "center">
			<td>IZIN</td>
		    <td><?php echo count($H1I); ?></td>
		    <td><?php echo count($H2I); ?></td>
		    <td><?php echo count($H3I); ?></td>
		    <td><?php echo count($H4I); ?></td>
		    <td><?php echo count($H5I); ?></td>
		    <td><?php echo count($H6I); ?></td>
		    <td><?php echo count($H7I); ?></td>
		    <td><?php echo count($H8I); ?></td>
		    <td><?php echo count($H9I); ?></td>
		    <td><?php echo count($H10I); ?></td>
		    <td><?php echo count($H11I); ?></td>
		    <td><?php echo count($H12I); ?></td>
		    <td><?php echo count($H13I); ?></td>
		    <td><?php echo count($H14I); ?></td>
		    <td><?php echo count($H15I); ?></td>
		    <td><?php echo count($H16I); ?></td>
		</tr>
		<tr align = "center">
			<td>TIDAK HADIR</td>
		    <td><?php echo count($H1A); ?></td>
		    <td><?php echo count($H2A); ?></td>
		    <td><?php echo count($H3A); ?></td>
		    <td><?php echo count($H4A); ?></td>
		    <td><?php echo count($H5A); ?></td>
		    <td><?php echo count($H6A); ?></td>
		    <td><?php echo count($H7A); ?></td>
		    <td><?php echo count($H8A); ?></td>
		    <td><?php echo count($H9A); ?></td>
		    <td><?php echo count($H10A); ?></td>
		    <td><?php echo count($H11A); ?></td>
		    <td><?php echo count($H12A); ?></td>
		    <td><?php echo count($H13A); ?></td>
		    <td><?php echo count($H14A); ?></td>
		    <td><?php echo count($H15A); ?></td>
		    <td><?php echo count($H16A); ?></td>
		</tr>
	</tbody>
</table>
<div class="control-group">
	<label class="control-label">&nbsp</label>
	<div class="controls">
    <form action="<?=URL?>siak_rekap_absen_per_matakuliah/pdf" method="post">
		<input type="hidden" name="prodi_id" value="<?=$valueasd['prodi_id']?>">
		<input type="hidden" name="cohort" value="<?=$valueasd['cohort']?>">
        <input type="hidden" name="nim" value="<?=$valueasd['nim']?>">
        <input type="hidden" name="kd_matkul" value="<?=$ail['kode_matkul']?>">
		<button type = "submit" value = "PDF" name="pdf" id="pdf" class = "btn btn-medium btn-warning" style="float: left"/>PDF</button>
	</form>
    </div>
</div>