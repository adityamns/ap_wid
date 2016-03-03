<?php 
	function cek_nilai($data_komponen,$nim,$komponen){
			foreach($data_komponen as $v =>$row){
				if($row['id_komponen'] == $komponen){
					if($row['nim']==$nim){
						return array(true,$row['nilai']);
					}
				}
			}
			return array(false,'');	

	}
?>
<script>
	$(document).ready(function(){
		$('#OK').click(function(){
			var form=jQuery("#generateNilai").serialize();
			console.log(form);
			$.ajax({
				data: form,
				type: "POST",
				url: '<?php echo URL; ?>siak_penilaian/generateNilai',
				success: function(data) {
					//$('#modper').html(data);
				}
			});
		});
	});
</script>
<div class="portlet box green" >
	<div class="portlet-title">
		<div class="caption"><i class="icon-home"></i>NILAI MAHASISWA</div>
	</div>
	<div class="portlet-body">
	<?php if($this->status=='t'){ ?>
		<!--<div class="row-fluid">
				<div class="span12">
						<div class="control-group">
							<marquee><h3 style='color:blue;'><b>WAKTU PENGISIAN NILAI TINGGAL <?php echo $this->jarak; ?></b></h3></marquee>
						</div>
				</div>
		</div>
	<?php
	}elseif ($this->status=='f' && $this->data_nilai > 0){ ?>
		<div class="row-fluid">
				<div class="span12">
						<div class="control-group">
							<marquee><h3 style='color:green;'><b>WAKTU PENGISIAN NILAI SUDAH HABIS</b></h3></marquee>
						</div>
				</div>
		</div>
	<?php }else{ ?>
		<!--<div class="row-fluid">
				<div class="span12">
						<div class="control-group">
							<marquee><h3 style='color:red;'><b>WAKTU PENGISIAN NILAI BELUM DI TENTUKAN SILAHKAN KONFIRMASI DENGAN DOSEN PENANGGUNG JAWAB</b></h3></marquee>
						</div>
				</div>
		</div>-->
	<?php }
	//echo $this->nilai_asli;
		if($this->nilai_asli <=0){
	?>
	<input type='button' id='OK' value='GENERATE NILAI'>
	<br>
	<form id='generateNilai'>
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2">NO</td>
			<td rowspan="2">NIM</td>
			<td rowspan="2">NAMA</td>
			<?php foreach ($this->bobot as $key => $value) { $i++; ?>
			<td rowspan="2"><?php echo $value['komponen'];?></td>
			<?php } ?>
			<td rowspan="2">ABSEN</td>
			<td colspan="2">NILAI AKHIR</td>
			
			<tr>
				<td align='center'>NILAI</td>
				<td align='center'>GRADE</td>
			</tr>
		</tr>
	</thead> 
	<tbody>
	<input type='hidden' value='<?php echo $this->semester;?>' name='semester'>
	<input type='hidden' value='<?php echo $this->prodi;?>' name='prodi'>
	<input type='hidden' value='<?php echo $this->matkul;?>' name='matkul'>
	<input type='hidden' value='<?php echo $this->tahun;?>' name='tahun'>
	<input type='hidden' value='<?php echo $this->idbobot;?>' name='idbobot'>
		<?php
		// $asd = array();
		// foreach ($this->data_nilai_mhs as $key => $value) {
			// $asd[] =  $value['nim'];
		// }
		$i = 0;
		foreach ($this->data_mahasiswa as $key => $value) {
			$i++;
			$nilaiabs = $this->db->siak_getfield("nilai", "nilai_absen", "nim = '".$value['nim']."' and prodi = '".$this->prodi."' and tahun = '".$this->tahun."' and semester = ".$this->semester." and kode_matkul = '".$this->matkul."'");
			if(empty($nilaiabs)){
				$nilai_absen = 0;
			}else{
				$nilai_absen = $nilaiabs;
			}			
			echo "<tr>";
			echo "<td align = 'center'></td>";
			echo "<td>" . $value['nim'] . "<input type='hidden' name='nim[]' id='nim' value='" . $value['nim'] . "'></td>";
			echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
			$datanim = sizeof($this->data_mahasiswa);
			$datanimlai = sizeof($this->data_nilai);
			$datanimla = sizeof($this->data_nilai)+1;
			if (count($this->data_komponen_nilai) > 0) {
				
					foreach ($this->bobot as $key => $bobot) {
						
						$nilai=cek_nilai($this->data_komponen_nilai,$value['nim'],$bobot['id_komponen']);
						if($nilai[0]){
						
							echo "<td align='center'>".$nilai[1]."
							<input type='hidden' value='".$bobot['id_komponen']."' name='id_komponen".$value['nim']."[]'>
							<input type='hidden' value='".$nilai[1]."' name='nilai".$value['nim']."[]'></td>";
						}
						else{
						
							echo "<td align='center'>0
							<input type='hidden' value='".$bobot['id_komponen']."' name='id_komponen".$value['nim']."[]'>
							<input type='hidden' value='0' name='nilai".$value['nim']."[]'></td>";
						}
							
					}
							echo "<td align='center'>".$nilai_absen."
							<input type='hidden' value='0' name='nilai".$value['nim']."[]'></td>";
							$SUM= $this->db->siak_query("select", "SELECT SUM(hasil_bobot) as rata_rata 
							FROM komponen_nilai where id_komponen IN (".$this->idAll.") and nim='".$value['nim']."'   
							");
							
							
							////Ubah Range Nilai berdasarkan Status perbaikan
							//$cek = $this->db->siak_query('select', "select nim from nilai_mahasiswa where nim='".$value['nim']."' and status_perbaikan <= 0 ");
							//var_dump($cek);
							//if(sizeof($cek) > 0){
							//	$rang = $this->range_nilai2;
// 								echo $value['nim']." True";
							//}else{
							//	$rang = $this->range_nilai;
// 								echo $value['nim']." False";
// 								echo "select nim from komponen_nilai where nim='".$value['nim']."' and status_perbaikan = true";
							//}
							///
							
							foreach($SUM as $v=>$rat){
								echo $rang;
								foreach($this->range_nilai as $i=>$range){
									if($range['nilaimin'] <= (int)$rat['rata_rata'] && $range['nilaimax'] >= (int)$rat['rata_rata']){
										echo "<td align='center'><div id='tot".$i."'>".number_format($rat['rata_rata'], 2, '.', ',')."<input type='hidden' name='total[]' value='".$rat['rata_rata']."'></div></td>";
										echo "<td align='center'><div id='grade".$i."'>".$range['nama']."<input type='hidden' value='".$range['nama']."' name='grade[]'><input type='hidden' value='".$range['bobot']."' name='bobot[]'></div></td>";
									}/*else{
										echo "<td align='center'>&nbsp;</div></td>";
										echo "<td align='center'>&nbsp;</div></td>";
									}*/
									
								}
							}
			}else{
				$urut=1;
				foreach ($this->bobot as $key => $valu) {
					echo "<td align='center'><div id='td".$i."".$urut."'>-<input type='hidden' value='0' name='nilai".$value['nim']."[]'></div></td>";
					$urut++;
				}
				echo "<td align='center'>".$nilai_absen."<input type='hidden' value='0' name='nilai".$value['nim']."[]'></td>";
				echo "<td align='center'>-</td>";
				echo "<td align='center'>-</td>";
				
			}
			echo "</tr>";
		}
		?>
	</tbody>
</table>
<?php }else{ ?>
<!-- ***** NILAI SUDAH UPDATE ******-->
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td rowspan="2">NO</td>
			<td rowspan="2">NIM</td>
			<td rowspan="2">NAMA</td>
			<?php foreach ($this->data as $key => $value) { $i++; ?>
			<td rowspan="2"><?php echo $value['komponen'];?></td>
			<?php } ?>
			<td rowspan="2">ABSEN</td>
			<td colspan="2">NILAI AKHIR</td>
			<tr>
				<td align='center'>NILAI</td>
				<td align='center'>GRADE</td>
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
			$nilaiabs = $this->db->siak_getfield("nilai", "nilai_absen", "nim = '".$value['nim']."' and prodi = '".$this->prodi."' and tahun = '".$this->tahun."' and semester = ".$this->semester." and kode_matkul = '".$this->matkul."'");
			if(empty($nilaiabs)){
				$nilai_absen = 0;
			}else{
				$nilai_absen = $nilaiabs;
			}			
			echo "<tr>";
			echo "<td align = 'center'>" . $i . "</td>";
			echo "<td>" . $value['nim'] . "<input type='hidden' name='nama[]' id='nim' value='" . $value['nim'] . "'></td>";
			echo "<td>" . $value['nama_depan'] . " " . $value['nama_belakang'] . "</td>";
			
				foreach ($this->data_nilai as $key => $vals) { 
					$nilai = explode(',', $vals['nilai']);
					if ($vals['nim']==$value['nim'] ) {
						
						foreach ($nilai as $key) {
							echo "<td align='center'>".number_format($key, 2, '.', '.')."</td>";
							$urut++;
						}
						echo "<td align='center'>".number_format($vals['nilai_total'], 2, '.', ',')."</td>";
						echo "<td align='center'><div id='grade".$i."'>".$vals['grade']."</div></td>";
						
					
					}
				}
			
			echo "</tr>";
		}
		?>
	</tbody>
</table>
<?php } ?>
</form>
</div>
</div>