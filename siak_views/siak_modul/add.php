<div class="modal-body">
	<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
<form id="formAddModul" name="modul" class="horizontal-form" action = "<?php echo URL;?>/siak_modul/tambah" method = "post">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Nama Modul</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" placeholder="Masukkan Nama Modul" name="nama">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">Parent</label>
						<div class="controls chzn-controls">
							<select class="chosen span12" name="parent">
							      <option value="0">Parent - Parent</option>
							<?php 
							foreach($this->data as $row => $key){
							      echo '<option value="'.$key['id'].'">Child to - '.$key['nama_modul'].'</option>';
							}
							?>
							</select>
      <!-- 						  <input type="text" name="url" id="url" class="m-wrap span12" placeholder="Masukkan URL"> -->
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="lastName">URL / LINK</label>
						<div class="controls">
							<input type="text" name="url" id="url" class="m-wrap span12" placeholder="Masukkan URL">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Urutan</label>
						<div class="controls">
							<input type="text" id="sort" class="m-wrap span12" placeholder="Masukkan Nama Modul" name="sort">
      <!-- 						  <span class="help-block">This is inline help</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="lastName">Status</label>
						<div class="controls chzn-controls">
							<select class="chosen span12" name="status">
							      <option value="t">Aktif</option>
							      <option value="f">Tidak Aktif</option>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
		</div>
	</div>
</div>
	
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<button type="submit" class="btn green" onclick="document.getElementById('formAddModul').submit();">Simpan</button>
	</div>
</form>