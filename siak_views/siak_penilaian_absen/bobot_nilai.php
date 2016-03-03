<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Bobot Nilai Absen</h3>
		<?php //echo "total ". $this->tot_pertemuan_matkul?>
		<?php //echo "jml pertemuan ".$this->jml_pertemuan?>
		<?php echo "<br/>".$this->message; ?>
	</div>	
</div>
<div class="input-group">						
		<form style="float:left;" id="form1" action="<?php echo URL; ?>siak_penilaian_absen/print_nilai" method="post" target="_blank">
			<input type="hidden" value="<?php echo $this->prodi;?>" name="prodi">
			<input type="hidden" value="<?php echo $this->cohort;?>" name="cohort">
			<input type="hidden" value="<?php echo $this->semester;?>" name="semester">
			<input type="hidden" value="<?php echo $this->matkul;?>" name="matkul">
			<button class="btn btn-default btn-sm" onclick="submit()"><span class="glyphicon glyphicon-print" data-toggle="modal" data-target="#myModal"></span>Cetak</button>&nbsp;
		</form>		
		&nbsp;
		<?php if($this->tot_pertemuan_matkul == $this->jml_pertemuan){ ?>
		<a class="btn btn-default btn-sm" link="<?php echo URL; ?>siak_penilaian_absen/save_nilai" onclick="saveNilai(this)">Simpan Nilai</a>
		<?php } ?>		
	</div>
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td width="40">NO</td>
			<td width="120">NIM</td>
			<td width="400">NAMA</td>			
			<td width="150">NILAI KEHADIRAN</td>
			<td>% NILAI KEHADIRAN (10%)</td>			
		</tr>
	</thead> 
	<tbody>
		<?php $i=0; 
		// $hadir = 1;
		// $alpha = 0;
		// $sakit = 0.3;
		// $ijin = 0.7;
		foreach ($this->data_mahasiswa as $key => $value) {
		$i++; ?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $value['nim'] ?></td>
			<td><?php echo $value['nama_depan']." ".$value['nama_belakang'] ?></td>
			<?php 
				
				$totpertemuan = $this->tot_pertemuan_matkul;
				$query = "select count(*) as total, status from absensi 
						where prodi_id = '".$this->prodi."' and cohort = '".$this->cohort."' and kode_matkul = '".$this->matkul."' and nim = '".$value['nim']."' group by status order by status";
				echo "<pre>".$query."</pre>";
				$data_absen = $this->db->siak_query("select",$query);
				$absen = 0;					
				foreach($data_absen as $row => $key){
					 //echo "status ".$key['status'];
					if($key['status'] == 1)
						$absen = ($absen + ($this->hadir * $key['total']));
					if($key['status'] == 2)
						$absen = ($absen + ($this->sakit * $key['total']));
					if($key['status'] == 3)
						$absen = ($absen + ($this->ijin * $key['total']));
					if($key['status'] == 4)
						$absen = ($absen + ($this->alpha * $key['total']));							
					// echo "total ".$key['total'];
				}
				$nilaiakhir = $absen/$totpertemuan * 100;
			?>
			<td><?php echo number_format((float)$nilaiakhir, 2, '.', '');?></td>
			<td><?php echo number_format((float)(10/100) * $nilaiakhir, 2, '.', '')?></td>			
		<tr/>
		<?php }?>
	</tbody>
</table>