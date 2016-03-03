<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
 		<form id="formKaryaEdit" class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/karyailmiah_dosen/<?php echo $value['id'];?>" method = "post">
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
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formKaryaEdit').submit();">Save changes</button>
	</div>
 	<?php } ?>
	