<div class="modal-body">
	<div class="portlet-body form">
	
	      <form id="formAddBH" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/tambah_bhs/<?=$this->nim?>/<?=$this->jenis?>" method = "post">
	      <div class="row-fluid">
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="bahasa">BAHASA</label>
				      <div class="controls">
					      <input type="hidden" name="nomor_seleksi" value="">
					      <input type="hidden" name="nim" value="<?=$this->nim?>">
					      <input type="hidden" name="edit_id" value="-1">
					      <input type="text" class="m-wrap span12" name="bahasa" id="bahasa">
				      </div>
			      </div>
		      </div>
		      <div class="span6">
			      <div class="control-group">
				      <label class="control-label" for="aktif">Aktif</label>
				      <div class="controls">
				      <select name="aktif" class="m-wrap span12">
					    <option value="TRUE" >Aktif</option>
					    <option value="FALSE" >Tidak Aktif</option>
				      </select>
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
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" data-dismiss="modal" class="btn green" onclick="AddBH()">Simpan</button>
</div>