<?php

// echo Siak_session::siak_get('level');

?>

<div style="overflow: auto; overflow-y: hidden;">
<table id = "rencana_studi" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td>NO</td>
			<td>KODE MATKUL</td>
			<td>NAMA MATKUL</td>
			<td>SKS</td>
			<td>NILAI</td>
			<td>GRADE</td>
			<td>NA</td>
		</tr>
	</thead>
	<?php $i=0; foreach ($this->data as $key => $value) { ?>
	<tbody>
		<tr>
			<td><?php echo $i+1; ?></td>
			<td><?php echo $value['kode_matkul'];?></td>
			<td><?php echo $value['nama_matkul'];?></td>
			<td align='center'><?php echo $value['sks'];?></td>
			
			<?php 
				if(sizeof($this->data_nilai) > 0){
					foreach($this->data_nilai as $ky => $row){
						$z = ($row['bobot']*$value['sks']);
						
						if($value['kode_matkul']== $row['matkul_id']){
							echo "<td align='center'>".number_format($row['nilai_total'], 2, '.' , ',')."</td>";
							echo "
							<td align='center'>".$row['grade']."</td>
							<td align='center'>".$z."</td>
							";
							$o[] = $row['bobot'];
						}
						
					
					}
					
					$asd = $value['sks']*$o[$i];
				}
				else{
					echo "<td> - </td>
					<td> - </td>
					<td> - </td>";
				}
			?>
			
		</tr>
	</tbody>
	<?php $x += $value['sks']; $y += $asd; $i++;}?>
		<tr>
			<td colspan="3" style="text-align: center">
				Jumlah
			</td>
			<td align='center'>
				<?php echo $x; ?>
			</td>
			<td colspan="2">
				&nbsp;
			</td>
			<td align='center'>
				<?php echo $y; ?>
			</td>
		</tr>
		<tr>
			<td colspan="3" align='center'>
				IPK
			</td>
			<td colspan="4" align='center'>
				<?php $ipk=$y/$x; echo "<strong>".number_format($ipk, 2, '.' , ',')."</strong>";?>
			</td>
		</tr>
</table>
</div>
<div class="control-group">
	<label class="control-label">&nbsp;</label>
	<div class="controls">
		<div>
		      <form action="<?=URL?>siak_kartu_hasil_studi/pdf_khs" method="post">
		      <input type="hidden" name="nim_pdf" value="<?=$row['nim']?>">
		      <input type="hidden" name="smstr" value="<?=$row['semester']?>">
		      <button type = "submit" class = "btn blue">PDF</button>
		      </form>
			
		</div>
	</div>
</div>