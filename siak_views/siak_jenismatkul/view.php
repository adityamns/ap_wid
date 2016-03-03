
<h3>Jenis Matakuliah Data</h3>

<?php foreach ($this->siak_data as $key => $value) { ?>
<form method = "post" action = "<?php echo URL;?>/siak_jenismatkul/siak_edit_save/<?php echo $value['jenis_matkul_id'];?>">
	<div class="modal-body">
					<div class="control-group">
						<label>JENIS MATKUL</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="jenis_matkul_id"  placeholder="" value="<?php echo $value['jenis_matkul_id'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KODE MATKUL</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kode_matkul"  placeholder="" value="<?php echo $value['kode_matkul'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>JENIS MATAKULIAH</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="jenis_matkul"   placeholder="" value="<?php echo $value['jenis_matkul'];?>" READONLY>
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