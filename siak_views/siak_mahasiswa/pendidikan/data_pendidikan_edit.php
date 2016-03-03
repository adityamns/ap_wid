<?php foreach ($this->siak_data as $key => $value) { ?>

<div class="modal-body">
	<div class="portlet-body form">
	
	      <form id="formEditEN" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/siak_edit_save/<?php echo $value['nim'];?>/0/riwayat_pendidikan/<?php echo $this->jenis; ?>/<?php echo $value['id'];?>" method = "post">
	      <div class="row-fluid">
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="nama">JENIS / NAMA PEMBENTUKAN</label>
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
				      <label class="control-label" for="tahun">Tahun</label>
				      <div class="controls">
                      <input type="text" class="m-wrap span12" name="tahun" value="<?php echo $value['tahun']; ?>">
				      </div>
			      </div>
		      </div>
		      <!--/span-->
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
	<button type="submit" data-dismiss="modal" class="btn green" onclick="EditEN()">Save changes</button>
</div>

<?php } ?>