<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
			<form id="formKarya" class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_create_data/karyailmiah_dosen" method = "post">
				<input type="hidden" class="m-wrap span12" name="nip" id="nip" value="<?php echo $this->nip; ?>">
				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Tahun Karya Ilmiah</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Tahun Karya Ilmiah" name="tahun_ilmiah" id="tahun_ilmiah" value="<?php echo $value['tahun_ilmiah']; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Judul Karya Ilmiah</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Judul Karya Ilmiah" name="judul_ilmiah" id="judul_ilmiah" value="<?php echo $value['judul_ilmiah']; ?>">
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
	<button type="submit" class="btn green" onclick="document.getElementById('formKarya').submit();">Simpan</button>
</div>