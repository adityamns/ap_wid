<div class="modal-body">
	<div class="portlet-body form">
		<form id="formAddKL" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/tambah_kursus/<?=$this->nim?>/<?=$this->jenis?>" method = "post">
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label class="control-label" for="nama">NAMA</label>
					<div class="controls">
						<input type="text" class="m-wrap span12" name="nama" id="nama" value="<?php echo $value['nama']; ?>">
						<input type="hidden" name="edit_id" id="edit_id" value="-1">
						<input type="hidden" name="nim" id="nim" value="<?php echo $this->nim; ?>">
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
		</form>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" data-dismiss="modal" class="btn green" onclick="AddKL()">Save changes</button>
</div>