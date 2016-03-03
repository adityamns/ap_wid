<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">

			<form id="formESyarat" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>/syarat_wisuda/update">
				<?php
				foreach($this->data as $row => $col){
				?>
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="username">Nama Materi</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" name="nama" id="nama" value="<?=$col['nama']?>">
								<input type="hidden" name="id" id="id" value="<?=$col['id']?>">
							</div>
						</div>
					</div>
					<!--/span-->
				</div>

				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="lastName">Status</label>
							<div class="controls">
								<select class="m-wrap span12" name = "status">
									<?php
									$aktif = ($col['status'] == FALSE)? "selected":"";
									?>
									<option value="1" <?=$aktif?>>Aktif</option>
									<option value="0" <?=$aktif?>>Tidak Aktif</option>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<?php } ?>
			</form>

		</div>
	</div>
</div>

<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formESyarat').submit();">Simpan</button>
</div>
