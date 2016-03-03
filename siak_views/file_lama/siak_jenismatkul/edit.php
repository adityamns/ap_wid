<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
		<form id="formEditJM" class="form-inline" action = "<?php echo URL;?>siak_jenismatkul/siak_edit_save/<?php echo $value['jenismatkul_id'];?>" method = "post">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="singkatan">SINGKATAN</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="singkatan" id="kode_kurikulum" value="<?php echo $value['singkatan'];?>">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="nama_jenismatkul">NAMA JENIS MATAKULIAH</label>
						<div class="controls">
      						  <input type="text" class="m-wrap span12" name="nama_jenismatkul" id="nama_jenismatkul" value="<?php echo $value['nama_jenismatkul'];?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="prodi_id">PROGRAM STUDI</label>
						<div class="controls">
						  <select name="prodi_id" class="m-wrap span12">
						  <?php foreach($this->siak_data_list as $key => $val) { ?>
							  <option value='<?php echo $val[prodi_id]; ?>' <?php echo $val[prodi_id]==$value[prodi_id]?"selected":"";?>><?php echo $val[prodi]; ?></option>		
						  <?php } ?>
						  </select>
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
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formEditJM').submit();">Save changes</button>
</div>