<?php 
// var_dump($this->CekMatkulAll);
// echo "<hr>";
// var_dump($this->CekMatkul);
// if($this->semester > 1 && $this->aktif != "t"){
if($this->semester > 1 && $this->cek == 't'){
// if($this->semester > 1){
	echo "<div class='alert alert-danger'>".$this->pesan."</div>";
?>
<div class="control-group">
	<label class="control-label">Ambil Matakuliah Pilihan</label>
	<div class="controls">
		<a class=" btn purple btn-large" href="#addM" data-toggle="modal" link="<?php echo URL;?>siak_rencana_studi/form_matkul_pilihan/<?php echo $this->nim."/".$this->semester."/".$this->cohort; ?>" onclick="addModul(this)">LIHAT DAFTAR</a>
	</div>
</div>
<?php 
}
?>
<br>
<input type="hidden" name="prod_mhs" value="<?php echo $this->prodi; ?>">
<input type="hidden" name="nim" value="<?php echo $this->nim; ?>">
<input type="hidden" name="semester" value="<?php echo $this->semester; ?>">
<table id = "rencana_studi" class="table table-striped table-bordered table-hover table-full-width">
<!-- 	<thead> -->
		<tr align = "center">
			<th>NO</th>
			<th>SEMESTER</th>
			<th>KODE MATKUL</th>
			<th>NAMA MATKUL</th>
			<th>SKS</td>
			<th>PERTEMUAN</th>
			<?php if($this->aktif != 't' || $this->countMatkulPil <= 0){ ?>
			<th>AKSI</th>
			<?php } ?>
		</tr>
<!-- 	</thead> -->
	<?php $i=0; foreach ($this->data as $key => $value) { $i++;?>
<!-- 	<tbody> -->
		<tr>
			<td><?php echo $i; ?></td>
			<td><!--<input type="hidden" name="semester[]" value="<?php echo $value['semester'];?>">--><?php echo $value['semester'];?></td>
			<?php 
			if($this->CekMatkulAll[0]['count'] != $this->CekMatkul[0]['count']){
			?>
			<td><input type="hidden" name="kode_matkul[]" value="<?php echo $value['kode_matkul'];?>"><?php echo $value['kode_matkul'];?></td>
			<td><input type="hidden" name="nama_matkul[]" value="<?php echo $value['nama_matkul'];?>"><?php echo $value['nama_matkul'];?></td>
			<td><input type="hidden" name="sks[]" value="<?php echo $value['sks'];?>">
			    <input type="hidden" name="jenis_matkul[]" value="<?php echo $value['jenismatkul_id'];?>"><?php echo $value['sks'];?>
			</td>
			<td><input type="hidden" name="pertemuan[]" value="<?php echo $value['pertemuan'];?>"><?php echo $value['pertemuan'];?></td>
			<?php 
			}else{
			?>
			<td><?php echo $value['kode_matkul'];?></td>
			<td><?php echo $value['nama_matkul'];?></td>
			<td><?php echo $value['sks'];?></td>
			<td><?php echo $value['pertemuan'];?></td>
			<?php 
			}
			?>
			<?php if($this->aktif != 't' || $this->countMatkulPil <= 0){ ?>
			<td>&nbsp;</td>
			<?php } ?>
		</tr>
<!-- 	</tbody> -->
	<?php }?>
</table>
<table id = "tab2" class="table table-bordered table-striped table-hover table-contextual table-responsive">

</table>

<?php if($this->aktif != 't' || $this->countMatkulPil <= 0 && $this->semester != 1){ ?>
<div class="control-group">
	<label class="control-label">&nbsp;</label>
	<div class="controls">
		<div>
			<input type = "button" value = "SIMPAN" onclick="cekTahun()" id="simpanIRS" class = "btn blue btn-large"/>
		</div>
	</div>
</div>
<?php } ?>

<div id="addM" class="modal hide fade" data-width="760" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>Daftar Matakuliah Pilihan</h3>
	</div>
	<div id="addModul">
	
	</div>
</div>