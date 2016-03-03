<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id="formEPem" class="horizontal-form" action = "<?php echo URL;?>/siak_pengampu_pembekalan/siak_edit_save/<?php echo $value['pengampu_id'];?>" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE PENGAMPU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_dosen" id="kode_dosen" readonly value="<?php echo $value['kode_dosen']; ?>">
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NAMA PENGAMPU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_dosen" id="nama_dosen" value="<?php echo $value['nama_dosen']; ?>">
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">Jenis Pengampu</label>
						<div class="controls">
							<select class="m-wrap span12" name = "tipe_pengampu">
								<option value="1" <?php echo $value['tipe_pengampu'] == "1"?"selected":"";?> >Dalam</option>
								<option value="2" <?php echo $value['tipe_pengampu'] == "2"?"selected":"";?> >Luar</option>
							</select>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="firstName">STATUS</label>
						<div class="controls">
							<select class="m-wrap span12" name = "status">
								<?php foreach ($this->status_pengampu as $key => $val){
									$untuk = explode(',', $val['untuk']); if(in_array("pengampu_pembekalan", $untuk)){ ?>
									<option name="status" id="status" value="<?php echo $val['nilai']; ?>" <?php echo $value['status'] == $val['nilai']?"selected":"";?> ><?php echo $val['nama']; ?></option>
								<?php } } ?>
							</select>
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
      <button type="button" data-dismiss="modal" class="btn">Close</button>
      <button type="submit" class="btn green" onclick="document.getElementById('formEPem').submit();">Save changes</button>
</div>