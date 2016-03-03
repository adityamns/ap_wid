<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			<form id="formPelatihan" class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_create_data/pelatihan_dosen" method = "post">
				<input type="hidden" class="m-wrap span12" name="nip" id="nip" value="<?php echo $this->nip; ?>">
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Tahun Pelatihan</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Tahun Pelatihan" name="tahun_pelatihan" id="tahun_pelatihan" value="">
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Judul Pelatihan</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Judul Pelatihan" name="judul_pelatihan" id="tahun_pelatihan" value="">
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Penyelenggara</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Penyelenggara" name="penyelenggara" id="penyelenggara" value="">
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
	<button type="submit" class="btn green" onclick="document.getElementById('formPelatihan').submit();">Simpan</button>
</div>