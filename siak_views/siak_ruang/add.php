<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
 		<form id="formR" class="horizontal-form" action = "<?php echo URL;?>siak_ruang/siak_create" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">ID</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="ruang_id" id="ruang_id" placeholder="Kode Ruang...">
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">RUANG</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_ruang" id="nama_ruang" placeholder="Nama Ruang...">
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">JENIS</label>
						<div class="controls">
							<select name="jenis_ruang" class="m-wrap span12">
								<?php foreach ($this->jenis_ruang as $key => $value) { ?>
									<option value="<?php echo $value['id']; ?>"><?php echo $value['nama']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">GEDUNG</label>
						<div class="controls">
							<select name="gedung" class="m-wrap span12">
								<?php foreach ($this->gedung as $key => $value) { ?>
									<option value="<?php echo $value['id']; ?>"><?php echo $value['nama']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">LANTAI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="lantai" id="lantai" placeholder="Lantai...">
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KAPASITAS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kapasitas" id="kapasitas" placeholder="Kapasitas ruang...">
						</div>
					</div>
				</div>
			</div> 
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">STATUS</label>
						<div class="controls">
							<select name="status" class="m-wrap span12">
								<?php foreach ($this->status_ruang as $key => $val) { 
									$untuk = explode(',', $val['untuk']); if(in_array("ruang", $untuk)){ ?>
								<option name="status_dosen" id="status_dosen" value="<?php echo $val['nilai']; ?>" <?php if ($val['nilai'] == $value['status_dosen']) { echo "selected"; } ?> ><?php echo $val['nama']; ?></option>
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
							<textarea class="m-wrap span12" name="keterangan" id="keterangan" placeholder="Keterangan..."></textarea>
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
      <button type="submit" class="btn green" onclick="document.getElementById('formR').submit();">Simpan</button>
</div>