<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="materi_id">MATERI</label>
			<div class="controls chzn-controls">
				<select class="chosen span12" name="materi_id" link="<?php echo URL;?>siak_absensi_pembekalan_mahasiswa/ruang" id="materi_id">
					<option value="0">- Materi -</option>
					<?php foreach ($this->data_materi as $key => $value) { ?>
					<option value="<?php echo $value['materi_id'];?>"><?php echo $value['materi'];?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
</div>
<div id="statedivs">
<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="ruang_id">RUANG</label>
			<div class="controls chzn-controls">
				<select class="chosen span12" name="ruang_id" link="<?php echo URL; ?>siak_atur_pembekalan/kapasitas" id="ruang_id">
					<option value="">-- Pilih Ruang --</option>
					<?php foreach($this->siak_ruang as $key => $value) {
						echo "<option value='$value[ruang_id]'>$value[nama_ruang]</option>";
					} ?>
				</select>
			</div>
		</div>
	</div>
</div>
</div>