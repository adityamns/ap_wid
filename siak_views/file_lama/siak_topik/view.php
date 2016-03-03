
<h3>Matakuliah Data</h3>

<?php foreach ($this->siak_data as $key => $value) { ?>
<form method = "post" action = "<?php echo URL;?>/siak_matakuliah/siak_edit_save/<?php echo $value['matkul_id'];?>" class="form-horizontal">
	<div class="modal-body">
					<div class="control-group">
						<label>ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="matkul_id"  placeholder="" value="<?php echo $value['matkul_id'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>Kurikulum</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kurikulum_id"  placeholder="" value="<?php echo $value['kurikulum_id'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>NO URUT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="NoUrut"  placeholder="" value="<?php echo $value['NoUrut'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PRODI ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="prodi_id"  placeholder="" value="<?php echo $value['prodi_id'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>JENIS MATKUL</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="jenis_matkul"  placeholder="" value="<?php echo $value['jenis_matkul'];?>" READONLY>
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
						<label>MATAKULIAH</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="matakuliah"  placeholder="" value="<?php echo $value['matakuliah'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>MATKUL EN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="matkul_en"  placeholder="" value="<?php echo $value['matkul_en'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>SINGKATAN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="singkatan"  placeholder="" value="<?php echo $value['singkatan'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>DESKRIPSI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="deskripsi"  placeholder="" value="<?php echo $value['deskripsi'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>SKS</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="sks"  placeholder="" value="<?php echo $value['sks'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>SKS PRAKTIKUM</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="sks_praktikum"  placeholder="" value="<?php echo $value['sks_praktikum'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>SKS PKL</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="sks_pkl"  placeholder="" value="<?php echo $value['sks_pkl'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>SKS MIN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="sks_min"  placeholder="" value="<?php echo $value['sks_min'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>SEMESTER</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="semester"  placeholder="" value="<?php echo $value['semester'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PENANGGUNG JAWAB</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="penanggungjawab"  placeholder="" value="<?php echo $value['penanggungjawab'];?>" READONLY>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KETERANGAN</label>
						<div class="controls">
							<div class="form-group" >
								<input type="text" class="form-control" name="keterangan"  placeholder="" value="<?php echo $value['keterangan'];?>" READONLY>
							</div>
						</div>
					</div>
</div>					
	<label>&nbsp;</label>
		<input type = "submit" value = "EDIT">
</form>
<?php } ?>