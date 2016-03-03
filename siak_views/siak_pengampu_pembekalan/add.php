<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
 		<form id="formPem" class="horizontal-form" action = "<?php echo URL;?>siak_pengampu_pembekalan/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KODE PENGAMPU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kode_dosen" id="kode_dosen" placeholder="Kode Pengampu...">
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">NAMA PENGAMPU</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_dosen" id="nama_dosen" placeholder="Nama Pengampu...">
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
								<option value="1">Dalam</option>
								<option value="2">Luar</option>
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
									<option name="status" id="status" value="<?php echo $val['nilai']; ?>"><?php echo $val['nama']; ?></option>
								<?php } } ?>
							</select>
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
      <button type="submit" class="btn green" onclick="document.getElementById('formPem').submit();">Simpan</button>
</div>