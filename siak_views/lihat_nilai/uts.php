<div style="overflow: auto; overflow-y: hidden;">
<table id = "rencana_studi" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td>NO</td>
			<td>KODE MATKUL</td>
			<td>NAMA MATKUL</td>
			<td>SKS</td>
			<td>NILAI</td>
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
				$nilaiuas = $this->nilai_($this->nim, $value['kode_matkul'], 'UTS');
				if(sizeof($nilaiuas) > 0){
					foreach($nilaiuas as $val => $nilai){
						echo "<td>".$nilai['nilai']."</td>";
						$nil = $nilai['nilai'];
					}
					$y += $nil;
				}else{
					echo "<td style='color:red'>Nilai Belum Ada (Belum Di-Published)</td>";
					$cn[] = 't';
				}
			?>
			
		</tr>
	<?php $x += $value['sks']; $i++;}?>
		<?php if(count($cn) <= 0){ ?>
		<tr>
			<td colspan="3" style="text-align: center">
				Jumlah
			</td>
			<td align='center'>
				<?php echo $x; ?>
			</td>
			<td align='center'>
				<?php echo $y; ?>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="text-align:center">
				Indeks Prestasi
			</td>
			<td align='center'>
				<?php $ipk=$y/$x; echo "<strong>".number_format($ipk, 2, '.' , ',')."</strong>";?>
			</td>
		</tr>
		<?php }else{ ?>
		<tr>
			<td colspan="5" style="text-align:center">
				Nilai belum LENGKAP !!
				<?=count($cn)?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
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