<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
 		<form id="formJGed" class="horizontal-form" action = "<?php echo URL;?>siak_setting_batas_waktu_absen/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">WAKTU(menit)</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="waktu" id="waktu" placeholder="Nama..."> /menit
						</div>
					</div>
				</div>
			</div> 
 		</form>
		</div>
	</div>
</div>

<div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn">Batal</button>
      <button type="submit" class="btn green" onclick="document.getElementById('formJGed').submit();">Simpan</button>
</div>