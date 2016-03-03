<script>
	function(){
		var bobot = document.getElementsByName('hasil[]');
		var sks = document.getElementsByName('sks[]');
		// alert(hasil_all);
		var total=0;
		for(i=0; i<hasil_all.length; i++){
			total = total + parseFloat(hasil_all[i].value);
		}
		document.getElementById('total').value =+ total;
	} 
	
</script>
<?php function hitung($sks,$nilai){
	$total=$nilai/$sks;
	return $total;
} ?>
<table border=2 id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="3">NO</td>
			<td rowspan="3">NIM</td>
			<td rowspan="3">NAMA</td>
			
			<?php $tot=sizeof($this->data); ?>
			<td colspan="<?php echo $tot*3; ?>">MATKUL</td>
			<td rowspan="3">IPK</td>
			
			<tr>
				<?php foreach ($this->semester as $key => $value) {?>
					<td colspan="<?php echo $value['jumlah']*3; ?>" align='center'><?php echo $value['semester']; ?></td>
				<?php } ?>
			</tr>
			<tr>
				<?php foreach ($this->data as $key => $value) {?>
					<td colspan="3" align='center'><?php echo $value['singkatan']; ?></td>
				<?php } ?>
			</tr>
		</tr>
	</thead> 
	<tbody>
		<?php
		$asd = array();
		foreach ($this->data_nilai_mhs as $key => $value) {
			$asd[] =  $value['nim'];
		}
		$i = 0;
		foreach ($this->data_mahasiswa as $key => $value) {
			$i++;
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td>" . $value['nim'] . "<input type='hidden' id='nim' value='" . $value['nim'] . "'></td>";
			echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
			$datanim = sizeof($this->data_mahasiswa);
			$data_count = sizeof($this->data);
			$size = 0;
			$s_data_nilai = sizeof($this->data_nilai);
			$data_temp = $this->data;
			if (count($this->data_nilai) > 0) {
				foreach ($this->data_nilai as $key => $vals) {
					if ($vals['nim']==$value['nim']) {
						for ($j = $size;$j<sizeof($data_temp);$j++) {
							//unset($data_temp[$j]);
							$size++;
							$data_count--;
							if($this->data[$j]['singkatan'] == $vals['singkatan']){
								echo "<td align='center'>".number_format($vals['nilai_total'], 2, '.', ',')."<input type='hidden' name='bobot[]' id='bobot".$i."' value='".$vals['bobot']."'></td>";
								echo "<td align='center'><b>".$vals['grade']."</td>";
								echo "<td align='center'><b>".$this->data[$j]['sks']."<input name='sks[]' type='hidden' id='sks".$i."' value='".$this->data[$j]['sks']."'></td>";
								if($data_count > 0){
									continue;
								} else {
									break;
								}
							} else {
								echo "<td align='center'>-</td>";
								echo "<td align='center'>-</td>";
								echo "<td align='center'><b>".$this->data[$j]['sks']."</td>";
							}
						}
						//echo "<td align='center'>".hitung($);."</td>";						
					}
				}
				
				if(!in_array($value['nim'],$asd)){
					foreach ($this->data as $key => $valu) {	
						echo "<td align='center'>-</td>";
						echo "<td align='center'>-</td>";
						
						echo "<td align='center'><b>".$valu['sks']."<input name='sks[]' type='hidden' id='sks".$i."' value='".$v['sks']."'></td>";
								
					}
					// echo "<td align='center'>-</td>";
					// echo "<td align='center'>-</td>";
					  echo "<td align='center'><input type='text' id='total".$i."'  name='hasil[]' '></td>";
				}
			}
			else{
				foreach ($this->data as $key => $valu) {
					echo "<td align='center'>-</td>";
					echo "<td align='center'>-</td>";
					echo "<td align='center'><b>".$valu['sks']."</td>";
				}
				
				echo "<td align='center'><input type='text' id='total".$i."'  name='hasil[]' '></td>";
			}
			echo "</tr>";
		}
		function cek_nilai($singkatan){
			foreach($this->data as $k=>$v){
				if($v['singkatan'] == $singkatan){
					return TRUE;
				}
			}
			return FALSE;
		}
		?>
	</tbody>
</table>