<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			<form id="formAbdi" class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_create_data/pengabdian_dosen" method = "post">
				<input type="hidden" class="m-wrap span12" name="nip" id="nip" value="<?php echo $this->nip; ?>">
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Tahun Pengabdian</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Tahun Pengabdian" name="tahun_abdi" id="tahun_abdi" value="<?php echo $value['tahun_abdi']; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Kegiatan</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Kegiatan" name="kegiatan" id="kegiatan" value="<?php echo $value['kegiatan']; ?>">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAbdi').submit();">Save changes</button>
</div>