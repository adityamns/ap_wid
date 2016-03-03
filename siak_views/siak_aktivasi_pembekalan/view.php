
<h3>Ruang Data</h3>

<?php foreach ($this->siak_data as $key => $value) { ?>
<form method = "post" action = "<?php echo URL;?>/siak_ruang/siak_edit_save/<?php echo $value['ruang_id'];?>">
	<div class="modal-body">
					<div class="control-group">
						<label>RUANG ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="ruang_id"  placeholder="" value="<?php echo $value['ruang_id'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>NAMA RUANG</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="nama_ruang"  placeholder="" value="<?php echo $value['nama_ruang'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KAPASITAS</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kapasitas"   placeholder="" value="<?php echo $value['kapasitas'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>JENIS RUANG</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="jenis_ruang"  placeholder="" value="<?php echo $value['jenis_ruang'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>GEDUNG</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="jenis_ruang"  placeholder="" value="<?php echo $value['jenis_ruang'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KETERANGAN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="keterangan"  placeholder="" value="<?php echo $value['keterangan'];?>" READONLY>
							</div>
						</div>
					</div>
</div>					
	<label>&nbsp;</label>
		<input type = "submit" value = "EDIT">
</form>
<?php } ?>