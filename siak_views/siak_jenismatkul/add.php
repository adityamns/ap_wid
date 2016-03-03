<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<form id="formAddJM" class="form-inline" action = "<?php echo URL;?>siak_jenismatkul/siak_create" method = "post">
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="singkatan">SINGKATAN</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" name="singkatan" id="kode_kurikulum" placeholder="Singkatan Jenis...">
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
						  <select  class="m-wrap span12" name="nama_jenismatkul" id="nama_jenismatkul">
						    <option value="pilihan">Pilihan</option>
						    <option value="umum">Umum</option>
						  </select>
<!-- 						  <input type="text" id="kode" class="m-wrap span12" name="nama_jenismatkul" id="nama_jenismatkul"> -->
						  
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
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddJM').submit();">Simpan</button>
</div>