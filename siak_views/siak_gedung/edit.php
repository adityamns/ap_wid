<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id="formEGed" class="horizontal-form" action = "<?php echo URL;?>/siak_gedung/siak_edit_save/<?php echo $value['id'];?>" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NAMA</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama" id="nama" value="<?php echo $value['nama']?>">
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">STATUS</label>
						<div class="controls">
							<select class="m-wrap span12" name = "status">
								<?php foreach ($this->status_ruang as $key => $val) { 
									$untuk = explode(',', $val['untuk']); if(in_array("gedung", $untuk)){ ?>
								<option name="status" id="status" value="<?php echo $val['nilai']; ?>" <?php if ($val['nilai'] == $value['status']) { echo "selected"; } ?> ><?php echo $val['nama']; ?></option>
								<?php } } ?>
							</select>
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="firstName">KETERANGAN</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="keterangan" id="keterangan" value="<?php echo $value['keterangan']?>">
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
      <button type="submit" class="btn green" onclick="document.getElementById('formEGed').submit();">Simpan</button>
</div>