<script>
	// function(){
		// var bobot = document.getElementsByName('hasil[]');
		// var sks = document.getElementsByName('sks[]');
		//alert(hasil_all);
		// var total=0;
		// for(i=0; i<hasil_all.length; i++){
			// total = total + parseFloat(hasil_all[i].value);
		// }
		// document.getElementById('total').value =+ total;
	// } 
	
</script>
<?php 
function cek_nilai($data, $singkatan, $nim){
	$result = NULL;
	foreach($data as $k=>$v){
		if($v['singkatan'] == $singkatan && $v['nim'] == $nim){
			$result = $v;
			break;
		}
	}
	return $result;
}

function ngitung($data,$id,$sks){
	$isi=NULL;
	foreach($data as $tot=>$total){
		if($total['nim'] == $id){
			$isi=$total['total']/$sks;
		}
	}
		return $isi;
	}
	
	
 ?><div style="overflow: auto; overflow-y: hidden;">
<table border=2 id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="3">NO</td>
			<td rowspan="3">NIM</td>
			<td rowspan="3">NAMA</td>
			
			<?php $tot=sizeof($this->data); ?>
			<td colspan="<?php echo $tot*3; ?>">MATKUL</td>
			<td rowspan="2" colspan="2">IPK</td>
			
			
			<tr>
				<?php foreach ($this->semester as $key => $value) {?>
					<td colspan="<?php echo $value['jumlah']*3; ?>" align='center'><?php echo $value['semester']; ?></td>
				<?php } ?>
			</tr>
			<tr>
				<?php foreach ($this->data as $key => $value) {?>
					<td colspan="3" align='center'><?php echo $value['singkatan']; ?></td>
				<?php } ?>
				<td>Nilai</td>
				<td>SKS</td>
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
					$o=0;
				foreach ($this->data as $k=>$v) {
					$result = cek_nilai($this->data_nilai, $v['singkatan'], $value['nim']);
					if($result != NULL){
					
						echo "<td align='center'>".number_format($result['nilai_total'], 2, '.', ',')."<input type='hidden' name='".$value['nim'].$o."' id='bobot".$i."' value='".$result['total']."'></td>";
						echo "<td align='center'><b>".$result['grade']."</td>";
						echo "<td align='center'><b>".$v['sks']."</td>";
						$o++;
					} else {
						echo "<td align='center'>-</td>";
						echo "<td align='center'>-</td>";
						echo "<td align='center'><b>".$v['sks']."</td>";
					}
					
				}
				
				foreach ($this->total_sks as $key => $row) {
				echo "<td align='center'>".round(ngitung($this->total_nilai,$value['nim'],$row['jumlah']),2)."<input type='hidden' id='".$value['nim']."' value='".round(ngitung($this->total_nilai,$value['nim'],$row['jumlah']),2)."'></td>";
					echo "<td align='center'>".$row['jumlah']." sks</td>";
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
		?>
		
	</tbody>
</table>
</div>
<form action='siak_yudisium' method='post' target='_BLANK'> 
				<input type='hidden' name='x' value='<?=$this->nip?>'>
				<button type = 'submit' class = 'btn btn-medium btn-warning' />Save Data</button>
				</form>