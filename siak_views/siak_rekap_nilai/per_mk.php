<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $this->nama_fak?></h3><br/>
		<h3 class="panel-title"><?php echo $this->nama_prodi?></h3>		
	</div>	
</div>
<center><h3>DAFTAR NILAI <?php echo strtoupper($this->nama_matkul)?></h3></center>
<div class="input-group">						
		<form style="float:left;" id="form1" action="<?php echo URL; ?>siak_rekap_nilai/print_nilai_permk" method="post" target="_blank">
			<input type="hidden" value="<?php echo $this->tahun;?>" name="tahun">
			<input type="hidden" value="<?php echo $this->fakultas;?>" name="fakultas">
			<input type="hidden" value="<?php echo $this->prodi;?>" name="prodi">
			<input type="hidden" value="<?php echo $this->cohort;?>" name="cohort">
			<input type="hidden" value="<?php echo $this->semester;?>" name="semester">
			<input type="hidden" value="<?php echo $this->matkul;?>" name="matkul">			
			<button class="btn btn-default btn-sm" onclick="submit()"><span class="glyphicon glyphicon-print" data-toggle="modal" data-target="#myModal"></span>Print</button>&nbsp;
		</form>				
	</div>
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td width="40">NO</td>
			<td width="400">NAMA</td>			
			<td width="120">NIM</td>
			<?php foreach ($this->data_komponen as $key => $value) { ?>
				<td><?php echo $value['komponen']." ".$value['persentase'];?> %</td>
			<?php } ?>
			<td width="70">HDR 10%</td>
			<td width="70">NM</td>
			<td width="70">NILAI</td>			
		</tr>
	</thead> 
	<tbody>
		<?php $i=1; foreach ($this->data_mahasiswa as $key => $value) { 
			$sql = "select * from nilai_mahasiswa where prodi_id = '".$this->prodi."' and semester = '".$this->semester."' and matkul_id = '".$this->matkul."' and nim = '".$value['nim']."' limit 1";
			$data_nilai_mhs = $this->db->siak_query("select", $sql);
			
			// echo $sql; 
			$nilaiabs = $this->db->siak_getfield("nilai", "nilai_absen", "nim = '".$value['nim']."' and prodi = '".$this->prodi."' and tahun = '".$this->tahun."' and semester = ".$this->semester." and kode_matkul = '".$this->matkul."'");
			if(empty($nilaiabs)){
				$nilai_absen = 0;
			}else{
				$nilai_absen = $nilaiabs;
			}
			
		?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $value['nama_depan']." ".$value['nama_belakang'] ?></td>
			<td><?php echo $value['nim'] ?></td>
			<?php if(empty($data_nilai_mhs)){?>
				<?php foreach ($this->data_komponen as $key => $value) { ?>
					<td>-</td>
				<?php } ?>
				<td><?php echo $nilai_absen?></td>
				<td>-</td>
				<td>-</td>
			<?php }else{
				$data_nilai = "";
				foreach ($data_nilai_mhs as $key => $vals) { 
					$data_nilai = explode(',', $vals['nilai']);				
				?>				
				<?php for($a=0; $a<count($data_nilai); $a++) { ?> 											
						<td align="center"><?php echo number_format($data_nilai[$a], 2, '.', '.')?></td>						
				<?php }?>									
				<td><?php echo $nilai_absen?></td>
				<td><?php echo number_format($vals['nilai_total'], 2, '.', ',')?></td>
				<td><?php echo $vals['grade'] ?></td>
			<?php } }?>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>