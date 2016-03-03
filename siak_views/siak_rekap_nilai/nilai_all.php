<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $this->nama_fak?></h3><br/>
		<h3 class="panel-title"><?php echo $this->nama_prodi?></h3>		
	</div>	
</div>
<center><h3>DAFTAR NILAI <?php echo strtoupper($this->nama_matkul)?></h3></center>
<div class="input-group">						
		<form style="float:left;" id="form1" action="<?php echo URL; ?>siak_rekap_nilai/print_nilai_all" method="post" target="_blank">
			<input type="hidden" value="<?php echo $this->tahun;?>" name="tahun">
			<input type="hidden" value="<?php echo $this->fakultas;?>" name="fakultas">
			<input type="hidden" value="<?php echo $this->prodi;?>" name="prodi">
			<input type="hidden" value="<?php echo $this->cohort;?>" name="cohort">
			<input type="hidden" value="<?php echo $this->semester;?>" name="semester">
			<input type="hidden" value="<?php echo $this->matkul;?>" name="matkul">		
			<input type="hidden" value="<?php echo $this->dosen;?>" name="dosen">		
			<input type="hidden" value="<?php echo $this->nilai;?>" name="nilai">		
			<button class="btn btn-default btn-sm" onclick="submit()"><span class="glyphicon glyphicon-print" data-toggle="modal" data-target="#myModal"></span>Print</button>&nbsp;
		</form>				
	</div>
<table id="mahasiswa" class="table table-bordered table-striped table-hover table-contextual table-responsive">
	<thead>
		<tr align = "center">
			<td width="40">NO</td>
			<td width="300">NAMA</td>			
			<td width="120">NIM</td>			
			<td width="70">NILAI</td>	
			<td width="">DOSEN</td>	
			<td width="">MATA KULIAH</td>				
		</tr>
	</thead> 
	<tbody>
		<?php $i=1; foreach ($this->data_nilai as $key => $value) { 
			$nama_depan = $this->db->siak_getfield("nama_depan", "data_pribadi_umum", "nim = '".$value['nim']."'");
			$nama_belakang = $this->db->siak_getfield("nama_belakang", "data_pribadi_umum", "nim = '".$value['nim']."'");
			if(empty($nama_depan)){
				$nama_depan = $this->db->siak_getfield("nama_depan", "data_pribadi_pns", "nim = '".$value['nim']."'");
				$nama_belakang = $this->db->siak_getfield("nama_belakang", "data_pribadi_pns", "nim = '".$value['nim']."'");
			}	
			$dosen = explode(',', $value['dosen_utama']);	
			$namamatkul = $this->db->siak_getfield("nama_matkul", "matakuliah", "kode_matkul = '".$value['matkul_id']."'");	
		?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $nama_depan." ".$nama_belakang ?></td>
			<td><?php echo $value['nim'] ?></td>
			<td><?php echo $value['grade'] ?></td>	
			<td><?php for($a=0; $a<count($dosen); $a++){ echo $this->db->siak_getfield("nama", "dosen", "nip = '".$dosen[$a]."'")." ,";}?></td>	
			<td><?php echo $namamatkul ?></td>				
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>