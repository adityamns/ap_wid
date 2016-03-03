<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
		<form id="formEditJM" class="form-inline" action = "<?php echo URL;?>siak_jenismatkul/siak_edit_save/<?php echo $value['jenismatkul_id'];?>" method = "post">
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="singkatan">SINGKATAN</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="singkatan" id="kode_kurikulum" value="<?php echo $value['singkatan'];?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="nama_jenismatkul">NAMA JENIS MATAKULIAH</label>
						<div class="controls">
						<?php 
						$pilih = ($value['nama_jenismatkul'] == "pilihan" || $value['nama_jenismatkul'] == "Pilihan")?"selected":"";
						$pilih2 = ($value['nama_jenismatkul'] == "umum" || $value['nama_jenismatkul'] == "Umum")?"selected":"";
						?>
						  <select  class="m-wrap span12" name="nama_jenismatkul" id="nama_jenismatkul">
						    <option value="pilihan" <?=$pilih?>>Pilihan</option>
						    <option value="umum" <?=$pilih2?>>Umum</option>
						  </select>
<!-- 						  <input type="text" id="kode" class="m-wrap span12" name="nama_jenismatkul" id="nama_jenismatkul" value="<?php echo $value['nama_jenismatkul'];?>"> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
		</form>
		<?php } ?>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEditJM').submit();">Simpan</button>
</div>