<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<form id="formAddJM" class="form-inline" action = "<?php echo URL;?>siak_jenismatkul/siak_create" method = "post">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="singkatan">SINGKATAN</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="singkatan" id="kode_kurikulum" placeholder="Singkatan Jenis...">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="nama_jenismatkul">NAMA JENIS MATAKULIAH</label>
						<div class="controls">
      						  <input type="text" class="m-wrap span12" name="nama_jenismatkul" id="nama_jenismatkul" placeholder="Masukkan Nama Jenis Matakuliah">
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
						  <?php foreach($this->siak_data_list as $key => $val) {
							  echo "<option value='$val[prodi_id]'>$val[prodi]</option>";
						  } ?>
						  </select>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
		</form>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddJM').submit();">Save changes</button>
</div>