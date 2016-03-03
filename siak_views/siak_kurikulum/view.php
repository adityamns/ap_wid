
<h3>Kurikulum Data</h3>

<?php foreach ($this->siak_data as $key => $value) { ?>
<form method = "post" action = "<?php echo URL;?>/siak_kurikulum/siak_edit_save/<?php echo $value['kurikulum_id'];?>">
	<div class="modal-body">
					<div class="control-group">
						<label>Kurikulum ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kurikulum_id"  placeholder="" value="<?php echo $value['kurikulum_id'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>NAMA KURIKULUM</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="nama_kurikulum"  placeholder=""  placeholder="" value="<?php echo $value['nama_kurikulum'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KODE KURIKULUM</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kode_kurikulum"   placeholder=""  placeholder="" value="<?php echo $value['kode_kurikulum'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PRODI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="prodi_id"  placeholder=""  placeholder="" value="<?php echo $value['prodi_id'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TANGGAL BERDIRI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_dibuat"  placeholder=""  placeholder="" value="<?php echo $value['tgl_dibuat'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KETERANGAN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="keterangan"  placeholder=""  placeholder="" value="<?php echo $value['keterangan'];?>" readonly>
							</div>
						</div>
					</div>
</div>					
	<label>&nbsp;</label>
		<input type = "submit" value = "EDIT">
</form>
<?php } ?>