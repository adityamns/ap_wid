<div class="modal-body">
	<div class="portlet-body form">
	
	<form id="formAddSI" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/tambah_seminar/<?php echo $this->nim; ?>/<?php echo $this->jenis; ?>" method = "post">
	
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="nama">NAMA</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="nama" id="nama" value="">
					<input type="hidden" name="edit_id" id="edit_id" value="-1">
					<input type="hidden" name="nim" id="nim" value="<?php echo $this->nim; ?>">
					<input type="hidden" id="jenis" value="<?php echo $this->jenis; ?>">
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="peranan">PERANAN</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="peranan" id="peranan" value="">
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="tahun">TAHUN</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="tahun" id="tahun" value="">
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="instansi">INSTANSI</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="instansi" id="instansi" value="">
				</div>
			</div>
		</div>
	</div>
	
	</form>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" data-dismiss="modal" class="btn green" onclick="AddSI()">Simpan</button>
</div>