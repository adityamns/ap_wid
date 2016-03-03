<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">

		<form id="formSyarat" name="users" class="horizontal-form" method = "post" action = "<?php echo URL;?>/syarat_wisuda/create">

			<div class="row-fluid">
				<div class="span12 ">
					<div class="control-group">
						<label class="control-label" for="username">Nama Materi</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama" id="nama" placeholder="Nama Syarat...">
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
									<option value="1">Aktif</option>
									<option value="2">Tidak Aktif</option>
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
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formSyarat').submit();">Simpan</button>
</div>
