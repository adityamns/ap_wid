<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
 		<form id="formPenelitianEdit" class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/penelitian_dosen/<?php echo $value['id'];?>" method = "post">
 			<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Tahun Penelitian</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Tahun Penelitian"  name="tahun_penelitian" id="tahun_penelitian" value="<?php echo $value['tahun_penelitian']; ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Judul Penelitian</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Judul Penelitian"  name="judul_penelitian" id="judul_penelitian" value="<?php echo $value['judul_penelitian']; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="lastName">Jabatan</label>
							<div class="controls">
								<select class="m-wrap span12" name="jabatan">
								<?php foreach($this->jabatan as $key => $val) { ?>
								<option value='<?php echo $val[jabatan_id]; ?>' <?php echo $val[jabatan_id]==$value[jabatan]?"selected":"";?>><?php echo $val[nama_jabatan]; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Sumber Dana</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Sumber Dana" name="sumber_dana" id="sumber_dana" value="<?php echo $value['sumber_dana']; ?>">
							</div>
						</div>
					</div>

					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Nominal</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Nominal" name="nominal" id="nominal" value="<?php echo $value['nominal']; ?>">
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
	<button type="submit" class="btn green" onclick="document.getElementById('formPenelitianEdit').submit();">Save changes</button>
	</div>
 	<?php } ?>
	