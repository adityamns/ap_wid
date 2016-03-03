<div class="modal-body">
	<div class="portlet-body form">
	
	<form id="formAddKI" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/tambah_karya/<?=$this->nim?>/<?=$this->jenis?>" method = "post">
	
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="judul">JUDUL</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="judul" id="judul" value="<?php echo $value['judul']; ?>">
					<input type="hidden" name="edit_id" id="edit_id" value="-1">
					<input type="hidden" name="nim" id="nim" value="<?=$this->nim?>">
					<input type="hidden" id="jenis" value="<?php echo $this->jenis; ?>">
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label class="control-label" for="media">MEDIA</label>
				<div class="controls">
					<input type="text" class="m-wrap span12" name="media" id="media" value="">
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
	<button type="submit" data-dismiss="modal" class="btn green" onclick="AddKI()">Save changes</button>
</div>