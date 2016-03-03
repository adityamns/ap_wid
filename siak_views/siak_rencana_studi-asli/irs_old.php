<?php 
// echo "<pre>";
// var_dump($this->id);
// echo "</pre>";
?>

<table id = "rencana_studi" class="table table-striped table-bordered table-hover table-full-width">
<!-- 	<thead> -->
		<tr align = "center">
			<th>NO</th>
			<th>SEMESTER</th>
			<th>KODE MATKUL</th>
			<th>NAMA MATKUL</th>
			<th>SKS</td>
			<th>PERTEMUAN</th>
		</tr>
<!-- 	</thead> -->
	<?php $i=0; foreach ($this->data as $key => $value) { $i++;?>
<!-- 	<tbody> -->
		<tr>
			<td><?php echo $i; ?></td>
			<td><!--<input type="hidden" name="semester[]" value="<?php echo $value['semester'];?>">--><?php echo $value['semester'];?></td>
			<td><input type="hidden" name="kode_matkul[]" value="<?php echo $value['kode_matkul'];?>"><?php echo $value['kode_matkul'];?></td>
			<td><input type="hidden" name="nama_matkul[]" value="<?php echo $value['nama_matkul'];?>"><?php echo $value['nama_matkul'];?></td>
			<td><input type="hidden" name="sks[]" value="<?php echo $value['sks'];?>"><?php echo $value['sks'];?></td>
			<td><input type="hidden" name="pertemuan[]" value="<?php echo $value['pertemuan'];?>"><?php echo $value['pertemuan'];?></td>
		</tr>
<!-- 	</tbody> -->
	<?php }?>
</table>
<table id = "tab2" class="table table-bordered table-striped table-hover table-contextual table-responsive">

</table>
<div class="control-group">
	<label class="control-label">&nbsp</label>
	<div class="controls">
		<div>
			<input type="hidden" name="id_mhs" value="<?php echo $this->id_mhs;?>">
			<input type = "submit" value = "OK" class = "btn btn-medium btn-primary"/>
			<!-- <a id="variousX9" href = "<?php echo URL;?>siak_rencana_studi/form_cuti/<?php echo $this->nim."/".$this->semester."/".$this->cohort; ?>"><input type = "button" value = "CUTI" class = "btn btn-medium btn-warning "/></a> -->
			<a href = "<?php echo URL;?>siak_rencana_studi"><input type = "button" value = "BATAL" class = "btn btn-medium btn-danger "/></a>
			<a class=" btn purple btn-large" href="#addM" data-toggle="modal" link="<?php echo URL;?>siak_rencana_studi/form_matkul_pilihan/<?php echo $this->nim."/".$this->semester."/".$this->cohort; ?>" onclick="addModul(this)">AMBIL MATA KULIAH PILIHAN</a>
			
		</div>
	</div>
</div>


<div id="addM" class="modal hide fade" data-width="760" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Tambah Data</h3>
	</div>
	<div id="addModul">
	
	</div>
</div>