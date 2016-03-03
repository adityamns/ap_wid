<?php foreach ($this->siak_data as $key => $value) { ?>

<div class="modal-body">
	<div class="portlet-body form">
	
	<form id="formEditKI" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/siak_edit_save/<?php echo $value['nim'];?>/<?php echo $value['id'];?>/karya_ilmiah/<?php echo $this->jenis; ?>" method = "post">
	
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="judul">JUDUL</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="judul" id="judul" value="<?php echo $value['judul']; ?>">
					<input type="hidden" id="id" value="<?php echo $value['id']; ?>">
					<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $value['id']; ?>">
					<input type="hidden" name="nomor_seleksi" value="<?php echo $value['nomor_seleksi']; ?>">
					<input type="hidden" name="nim" id="nim" value="<?php echo $value['nim']; ?>">
					<input type="hidden" id="jenis" value="<?php echo $this->jenis; ?>">
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="media">MEDIA</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="media" id="media" value="<?php echo $value['media']; ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="tahun">TAHUN</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="tahun" id="tahun" value="<?php echo $value['tahun']; ?>">
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="keterangan">KETERANGAN</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="keterangan" id="keterangan" value="<?php echo $value['keterangan']; ?>">
				</div>
			</div>
		</div>
	</div>
	
	</form>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" data-dismiss="modal" class="btn green" onclick="EditKI()">Save changes</button>
</div>

<?php } ?>