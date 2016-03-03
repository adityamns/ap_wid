<div class="row">
	<div class="form-group col-md-2"><label for="prodi_id" class="control-label">PRODI</label></div>
	<div class="form-group col-md-5">
		<select id="prodi_id" name="prodi_id" link="<?php echo URL;?>siak_absensi_pembekalan_mahasiswa/materi" class="form-control" onchange="getKurikulum2(this)">
			<option value="0">- Prodi -</option>
			<?php foreach ($this->data_prodi as $key => $value) { ?>
			<option value="<?php echo $value['prodi_id'];?>"><?php echo $value['prodi'];?></option>
			<?php }?>
		</select>
	</div>
</div>

<div id="statedivs">
<div class="row">
	<div class="form-group col-md-2"><label for="materi_id" class="control-label">MATERI</label></div>
	<div class="form-group col-md-5">
		<select id="materi_id" name="materi_id" class="form-control">
			<option value="0">- Materi -</option>
		</select>
	</div>
</div>

	<div class="row">
		<div class="form-group col-md-2"><label for="materi_id" class="control-label">RUANG</label></div>
		<div class="form-group col-md-5">
			<select id="ruang_id" name="ruang_id" class="form-control">
				<option value="0">- Ruang -</option>
			</select>
		</div>
	</div>
</div>