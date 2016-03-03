<div class="modal-body">
	<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach($this->siak_data as $row => $key){ ?>
		<form id="formEModul" name="editmodul" class="horizontal-form" action = "<?php echo URL;?>siak_modul/update/<?=$key['id']?>" method = "post">
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Nama Modul</label>
						<div class="controls">
							<input type="text" id="kode" class="m-wrap span12" value="<?=$key['nama_modul']?>" name="nama">
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
							foreach($this->data as $row => $keys){
							      $selected = ($keys['id'] == $key['parent'])?"selected":"";
							      echo '<option value="'.$keys['id'].'" '.$selected.'>Child to - '.$keys['nama_modul'].'</option>';
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
							<input type="text" name="url" id="url" class="m-wrap span12" value="<?=$key['url']?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">Urutan</label>
						<div class="controls">
							<input type="text" id="sort" class="m-wrap span12" value="<?=$key['urutan']?>" name="sort">
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
							<?php 
							$aktif = ($key['status'] == 't')?"selected":"";
							$taktif = ($key['status'] == 'f')?"selected":"";
							?>
							      <option value="t" <?=$aktif?>>Aktif</option>
							      <option value="f" <?=$taktif?>>Tidak Aktif</option>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
		<?php } ?>
		</div>
	</div>
</div>
	
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">Batal</button>
		<button type="submit" class="btn green" onclick="document.getElementById('formEModul').submit();">Simpan</button>
	</div>
</form>