<div class="modal-body">
	<div class="portlet-body form">
	
	      <form id="formAddKT" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/tambah_riwayat_pangkat/<?=$this->nim?>/<?=$this->jenis?>" method = "post">
	      <div class="row-fluid">
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="pangkat">PANGKAT</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="pangkat" id="pangkat">
					      <input type="hidden" name="edit_id" value="-1">
					      <input type="hidden" name="nomor_seleksi" value="">
					      <input type="hidden" name="nim" value="<?=$this->nim?>">
				      </div>
			      </div>
		      </div>
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="tmt">TAMAT</label>
				      <div class="controls">
                      <input type="text" class="m-wrap span12" name="tmt" id="tmt">
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
	<button type="submit" data-dismiss="modal" class="btn green" onclick="AddKT()">Save changes</button>
</div>