<div class="modal-body">
	<div class="scroller" data-always-visible="1" data-rail-visible1="1">
		<div class="portlet-body form">
		<?php foreach ($this->siak_data as $key => $value) { ?>
 		<form id="formR" class="horizontal-form" action = "<?php echo URL;?>/siak_ruang/siak_edit_save/<?php echo $value['ruang_id'];?>" method = "post">
 			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">ID</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="ruang_id" id="ruang_id" readonly value="<?php echo $value['ruang_id']?>">
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">RUANG</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_ruang" id="nama_ruang" value="<?php echo $value['nama_ruang']?>">
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
								<?php foreach ($this->jenis_ruang as $key => $val) { ?>
									<option value="<?php echo $val['id']; ?>" <?php echo $value['jenis_ruang']==$val['id']?"selected":"";?>><?php echo $val['nama']; ?></option>
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
							<?php foreach ($this->gedung as $key => $val) { ?>
								<option value="<?php echo $val['id']; ?>" <?php echo $value['gedung']==$val['id']?"selected":"";?>><?php echo $val['nama']; ?></option>
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
							<input type="text" class="m-wrap span12" name="lantai" id="lantai" value="<?php echo $value['lantai']?>">
						</div>
					</div>
				</div>
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">KAPASITAS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="kapasitas" id="kapasitas" value="<?php echo $value['kapasitas']?>">
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
							<textarea class="m-wrap span12" name="keterangan" id="keterangan" placeholder="Keterangan..."><?php echo $value['keterangan']?></textarea>
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
      <button type="submit" class="btn green" onclick="document.getElementById('formR').submit();">Simpan</button>
</div>