
<h3>Prodi Data</h3>

<?php foreach ($this->siak_data as $key => $value) { ?>
<form method = "post" action = "<?php echo URL;?>/siak_prodi/siak_edit_save/<?php echo $value['prodi_id'];?>">
	<div class="modal-body">
					<div class="control-group">
						<label>PRODI ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="prodi_id"  placeholder="" value="<?php echo $value['prodi_id'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>FAKULTAS ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="fakultas_id"  placeholder="" value="<?php echo $value['fakultas_id'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PRODI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="prodi"  placeholder="" value="<?php echo $value['prodi'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PRODI EN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="prodi_en"  placeholder="" value="<?php echo $value['prodi_en'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>JENJANG</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="jenjang"  placeholder="" value="<?php echo $value['jenjang'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>GELAR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="gelar"  placeholder="" value="<?php echo $value['gelar'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>AKREDITASI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="akreditasi"  placeholder="" value="<?php echo $value['akreditasi'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>NO SKD DIKTRI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="no_skd_dikti"  placeholder="" value="<?php echo $value['no_skd_dikti'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TGL SKD DIKTRI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_skd_dikti"  placeholder="" value="<?php echo $value['tgl_skd_dikti'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>NO SK BAN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="no_sk_ban"  placeholder="" value="<?php echo $value['no_sk_ban'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TGL SK BAN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_sk_ban"  placeholder="" value="<?php echo $value['prodi'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>DAPAT PINDAH PRODI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="DapatPindahProdi"  placeholder="" value="<?php echo $value['DapatPindahProdi'];?>" READONLY>
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
	
	<label>&nbsp;</label>
		<input type = "submit" value = "EDIT">
</form>
<?php } ?>