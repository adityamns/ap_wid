<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id="formEGed" class="horizontal-form" action = "<?php echo URL;?>/siak_data_absensi/siak_edit_save/<?php echo $value['id'];?>" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NIM</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nim" id="nim" value="<?php echo $value['nim']?>">
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">STATUS</label>
						<div class="controls">
							<select id='status' class='m-wrap span12' name='status'  style='color:black;font-weight:bold;' >
								<option  value='1' <?php if($value['status']=="1") { echo "selected='selected'"; } ?>>HADIR</option>
								<option  value='2' <?php if($value['status']=="2") { echo "selected='selected'"; } ?>>SAKIT</option>
								<option  value='3' <?php if($value['status']=="3") { echo "selected='selected'"; } ?>>IJIN</option>
								<option  value='4' <?php if($value['status']=="4") { echo "selected='selected'"; } ?>>ALPA</option>
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
							<input type="text" class="m-wrap span12" name="catatan" id="catatan" value="<?php echo $value['catatan']?>">
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