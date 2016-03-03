<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id="formSeminarEdit" class="form-horizontal" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/seminar_dosen/<?php echo $value['id'];?>" method = "post">
 			<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Tahun Seminar</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Tahun Seminar" name="tahun_seminar" id="tahun_seminar" value="<?php echo $value['tahun_seminar']; ?>">
							</div>
						</div>
					</div>

				</div>

				<div class="row-fluid">
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Judul Seminar</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Judul Seminar" name="judul_seminar" id="judul_seminar" value="<?php echo $value['judul_seminar']; ?>">
							</div>
						</div>
					</div>

					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Peranan Dalam Seminar</label>
							<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Peranan Dalam Seminar" name="peran" id="peran" value="<?php echo $value['peran']; ?>">
							</div>
						</div>
					</div>
				</div>

				
				
				<div class="row-fluid">	
					<div class="span6 ">
						<div class="control-group">
							<label class="control-label" for="firstName">Penyelanggara</label>
								<div class="controls">
									<input type="text" class="m-wrap span12" placeholder="Penyelenggara" name="penyelenggara" id="penyelenggara" value="<?php echo $value['penyelenggara']; ?>">
								</div>
							</div>
						</div>

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
 		<?php } ?>
 	</div>
	</div>
	</div>
 	<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formSeminarEdit').submit();">Simpan</button>
</div>