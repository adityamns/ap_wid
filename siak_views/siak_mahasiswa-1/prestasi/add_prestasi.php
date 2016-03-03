<div class="modal-body">
	<div class="portlet-body form">
	<form id="formAddP" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/tambah_prestasi/<?php echo $this->nim;?>/<?php echo $this->jenis; ?>" method = "post">
	
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="prestasi">PRESTASI</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="prestasi" id="prestasi" value="">
					<input type="hidden" name="edit_id" id="edit_id" value="-1">
					<input type="hidden" name="nim" id="nim" value="<?php echo $this->nim; ?>">
					<input type="hidden" id="jenis" value="<?php echo $this->jenis; ?>">
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="diberikan">DIBERIKAN</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="diberikan" id="diberikan" value="">
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
				<label class="control-label" for="keterangan">KETERANGAN</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="keterangan" id="keterangan" value="">
				</div>
			</div>
		</div>
	</div>
	
	</form>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" data-dismiss="modal" class="btn green" onclick="AddP()">Save changes</button>
</div>