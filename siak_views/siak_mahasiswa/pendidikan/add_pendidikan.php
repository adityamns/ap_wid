<div class="modal-body">
	<div class="portlet-body form">
	
	      <form id="formAddEN" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/tambah_riwayat/<?=$this->nim?>/<?=$this->jenis?>" method = "post">
	      <div class="row-fluid">
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="nama">JENIS / NAMA PEMBENTUKAN</label>
				      <div class="controls">
					      <input type="text" class="m-wrap span12" name="nama" id="nama">
					      <input type="hidden" name="edit_id" value="-1">
					      <input type="hidden" name="nomor_seleksi" value="">
					      <input type="hidden" name="nim" value="<?=$this->nim?>">
				      </div>
			      </div>
		      </div>
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="aktif">Tahun</label>
				      <div class="controls">
                      <input type="text" class="m-wrap span12" name="tahun" id="tahun">
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
	<button type="submit" data-dismiss="modal" class="btn green" onclick="AddEN()">Save changes</button>
</div>