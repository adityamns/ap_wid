<?php foreach ($this->siak_data as $key => $value) { ?>

<div class="modal-body">
	<div class="portlet-body form">
		<form id="formEditKL" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/siak_edit_save/<?php echo $value['nim'];?>/<?php echo $value['id'];?>/kursus_latihan/<?php echo $this->jenis; ?>" method = "post">
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label class="control-label" for="nama">NAMA</label>
					<div class="controls">
						<input type="text" class="m-wrap span12" name="nama" id="nama" value="<?php echo $value['nama']; ?>">
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
					<label class="control-label" for="lama">LAMA</label>
					<div class="controls">
						<input type="text" class="m-wrap span12" name="lama" id="lama" value="<?php echo $value['lama']; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label class="control-label" for="tahun_selesai">THN SELESAI</label>
					<div class="controls">
						<input type="text" class="m-wrap span12" name="tahun_selesai" id="tahun_selesai" value="<?php echo $value['tahun_selesai']; ?>">
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="control-group">
					<label class="control-label" for="tempat">TEMPAT</label>
					<div class="controls">
						<input type="text" class="m-wrap span12" name="tempat" id="tempat" value="<?php echo $value['tempat']; ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
		      <div class="span12">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">KETERANGAN</label>
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
	<button type="submit" data-dismiss="modal" class="btn green" onclick="EditKL()">Save changes</button>
</div>

<?php } ?>