<div class="row">
	<div class="form-group col-md-2"><label for="materi_id" class="control-label">MATERI</label></div>
	<div class="form-group col-md-5">
		<select id="materi_id" name="materi_id" link="<?php echo URL;?>siak_absensi_pembekalan_mahasiswa/ruang" class="form-control" onchange="getKurikulum3(this)">
			<option value="0">- Materi -</option>
			<?php foreach ($this->data_materi as $key => $value) { ?>
			<option value="<?php echo $value['materi_id'];?>"><?php echo $value['materi'];?></option>
			<?php }?>
		</select>
	</div>
</div>

<div id="statedivsa">
	<div class="row">
		<div class="form-group col-md-2"><label for="materi_id" class="control-label">RUANG</label></div>
		<div class="form-group col-md-5">
			<select id="ruang_id" name="ruang_id" class="form-control">
				<option value="0">- Ruang -</option>
			</select>
		</div>
	</div>
</div>