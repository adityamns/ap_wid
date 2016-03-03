<?php if ($this->reades == "t") { ?>
<?php if (count($this->siak_data) != 0){ ?>
<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="panel panel-primary">
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_mahasiswa/siak_edit_save/<?php echo $value['nim'];?>/0/data_pribadi_pns/pns" method = "post">
 			<div class="row">
 				<div class="form-group col-md-2"><label for="nama_depan" class="control-label">NAMA DEPAN</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nama_depan" id="nama_depan" value="<?php echo $value['nama_depan']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="nama_belakang" class="control-label">NAMA BELAKANG</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nama_belakang" id="nama_belakang" value="<?php echo $value['nama_belakang']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="tempat_lahir" class="control-label">TEMPAT LAHIR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo $value['tempat_lahir']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="tanggal_lahir" class="control-label">TANGGAL LAHIR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $value['tanggal_lahir']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="kelamin_kode" class="control-label">JENIS KELAMIN</label></div>
 				<?php foreach ($this->kelamin as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<?php echo $nilai['nama'];?> <input type="radio" name="kelamin_kode" id="kelamin_kode" <?php if($value['kelamin_kode'] == $nilai['kode']){ echo 'checked = "checked"'; }?> value="<?php echo $nilai['kode']; ?>">
 					</div>
 				<?php } ?>
 				<div class="form-group col-md-2"><label for="agama_id" class="control-label">AGAMA</label></div>
 				<select name = "agama_id">
 				<?php foreach ($this->agama as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<option value = "<?php echo $nilai['id'];?>" <?php if($value['agama_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>
 					</div>
 				<?php } ?>
 				</select>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="status_perkawinan_id" class="control-label">STATUS KAWIN</label></div>
 				<div class="form-group col-md-3">
 				<select name = "status_perkawinan_id">
 				<?php foreach ($this->perkawinan as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<option value = "<?php echo $nilai['id'];?>" <?php if($value['status_perkawinan_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>
 					</div>
 				<?php } ?>
 				</select>
 				</div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="no_ktp" class="control-label">NO. KTP</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="no_ktp" id="no_ktp" value="<?php echo $value['no_ktp']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="nip" class="control-label">NIP</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nip" id="nip" value="<?php echo $value['nip']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="kesatuan" class="control-label">KESATUAN</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kesatuan" id="kesatuan" value="<?php echo $value['kesatuan']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="jenis_pns_id" class="control-label">JENIS PNS</label></div>
 				<div class="form-group col-md-3">
 				<select name = "jenis_pns_id">
 				<?php foreach ($this->jenis_pns as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<option value = "<?php echo $nilai['id'];?>" <?php if($value['jenis_pns_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>
 					</div>
 				<?php } ?>
 				</select>
 				</div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="status_perkawinan_id" class="control-label">GOLONGAN</label></div>
 				<div class="form-group col-md-3">
 				<select name = "golongan_id">
 				<?php foreach ($this->golongan as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<option value = "<?php echo $nilai['id'];?>" <?php if($value['golongan_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>
 					</div>
 				<?php } ?>
 				</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="pangkat_id" class="control-label">PANGKAT</label></div>
 				<div class="form-group col-md-3">
 				<select name = "pangkat_id">
 				<?php foreach ($this->pangkat as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<option value = "<?php echo $nilai['id'];?>" <?php if($value['pangkat_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>
 					</div>
 				<?php } ?>
 				</select>
 				</div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="alamat_rumah" class="control-label">ALAMAT RUMAH</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="alamat_rumah" id="alamat_rumah" value="<?php echo $value['alamat_rumah']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kode_pos_rumah" class="control-label">POS RUMAH</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kode_pos_rumah" id="kode_pos_rumah" value="<?php echo $value['kode_pos_rumah']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="telp_rumah" class="control-label">TELP RUMAH</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="telp_rumah" id="telp_rumah" value="<?php echo $value['telp_rumah']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kota_rumah" class="control-label">KOTA RUMAH</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kota_rumah" id="kota_rumah" value="<?php echo $value['kota_rumah']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="handphone" class="control-label">HANDPHONE</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="handphone" id="handphone" value="<?php echo $value['handphone']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="alamat_surat" class="control-label">ALAMAT SURAT</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="alamat_surat" id="alamat_surat" value="<?php echo $value['alamat_surat']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kode_pos_surat" class="control-label">POS SURAT</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kode_pos_surat" id="kode_pos_surat" value="<?php echo $value['kode_pos_surat']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="email" class="control-label">EMAIL</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="email" id="email" value="<?php echo $value['email']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kota_surat" class="control-label">KOTA SURAT</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kota_surat" id="kota_surat" value="<?php echo $value['kota_surat']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="paspor" class="control-label">PASPOR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="paspor" id="paspor" value="<?php echo $value['paspor']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="alamat_kantor" class="control-label">ALAMAT KANTOR</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="alamat_kantor" id="alamat_kantor" value="<?php echo $value['alamat_kantor']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kode_pos_kantor" class="control-label">POS KANTOR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kode_pos_kantor" id="kode_pos_kantor" value="<?php echo $value['kode_pos_kantor']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-sm-2"><label for="telp_kantor" class="control-label">TELP KANTOR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="telp_kantor" id="telp_kantor" value="<?php echo $value['telp_kantor']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="kota_kantor" class="control-label">KOTA KANTOR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kota_kantor" id="kota_kantor" value="<?php echo $value['kota_kantor']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="fax_kantor" class="control-label">FAX KANTOR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="fax_kantor" id="fax_kantor" value="<?php echo $value['fax_kantor']; ?>"></div>
 			</div>
 			<?php if ($this->updates == "t") { ?>
 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "UPDATE" class = "btn btn-medium btn-primary "/>
 					</div>
 				</div>
 			</div>
 			<?php } ?> 
 		</form>
 	</div>
	</div>
	</div>
<?php } } else{ ?>
<div class="panel panel-primary">
	<div class="panel-body">
 	<div class="container-fluid">
 		<form class="form-horizontal" action = "<?php echo URL;?>siak_mahasiswa/siak_insert_save/<?php echo $this->nim;?>/0/data_pribadi_pns/pns" method = "post">
 			<input type="hidden" value="<?php echo $this->nim; ?>" name="nim">
 			<div class="row">
 				<div class="form-group col-md-2"><label for="nama_depan" class="control-label">NAMA DEPAN</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nama_depan" id="nama_depan" value="<?php echo $value['nama_depan']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="nama_belakang" class="control-label">NAMA BELAKANG</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nama_belakang" id="nama_belakang" value="<?php echo $value['nama_belakang']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="tempat_lahir" class="control-label">TEMPAT LAHIR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo $value['tempat_lahir']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="tanggal_lahir" class="control-label">TANGGAL LAHIR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $value['tanggal_lahir']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="kelamin_kode" class="control-label">JENIS KELAMIN</label></div>
 				<?php foreach ($this->kelamin as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<?php echo $nilai['nama'];?> <input type="radio" name="kelamin_kode" id="kelamin_kode" <?php if($value['kelamin_kode'] == $nilai['kode']){ echo 'checked = "checked"'; }?> value="<?php echo $nilai['kode']; ?>">
 					</div>
 				<?php } ?>
 				<div class="form-group col-md-2"><label for="agama_id" class="control-label">AGAMA</label></div>
 				<select name = "agama_id">
 				<?php foreach ($this->agama as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<option value = "<?php echo $nilai['id'];?>" <?php if($value['agama_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>
 					</div>
 				<?php } ?>
 				</select>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="status_perkawinan_id" class="control-label">STATUS KAWIN</label></div>
 				<div class="form-group col-md-3">
 				<select name = "status_perkawinan_id">
 				<?php foreach ($this->perkawinan as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<option value = "<?php echo $nilai['id'];?>" <?php if($value['status_perkawinan_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>
 					</div>
 				<?php } ?>
 				</select>
 				</div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="no_ktp" class="control-label">NO. KTP</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="no_ktp" id="no_ktp" value="<?php echo $value['no_ktp']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="nip" class="control-label">NIP</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="nip" id="nip" value="<?php echo $value['nip']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="kesatuan" class="control-label">KESATUAN</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kesatuan" id="kesatuan" value="<?php echo $value['kesatuan']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="jenis_pns_id" class="control-label">JENIS PNS</label></div>
 				<div class="form-group col-md-3">
 				<select name = "jenis_pns_id">
 				<?php foreach ($this->jenis_pns as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<option value = "<?php echo $nilai['id'];?>" <?php if($value['jenis_pns_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>
 					</div>
 				<?php } ?>
 				</select>
 				</div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="status_perkawinan_id" class="control-label">GOLONGAN</label></div>
 				<div class="form-group col-md-3">
 				<select name = "golongan_id">
 				<?php foreach ($this->golongan as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<option value = "<?php echo $nilai['id'];?>" <?php if($value['golongan_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>
 					</div>
 				<?php } ?>
 				</select>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="pangkat_id" class="control-label">PANGKAT</label></div>
 				<div class="form-group col-md-3">
 				<select name = "pangkat_id">
 				<?php foreach ($this->pangkat as $kunci => $nilai) { ?>
 					<div class="form-group col-md-2">
 						<option value = "<?php echo $nilai['id'];?>" <?php if($value['pangkat_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>
 					</div>
 				<?php } ?>
 				</select>
 				</div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="alamat_rumah" class="control-label">ALAMAT RUMAH</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="alamat_rumah" id="alamat_rumah" value="<?php echo $value['alamat_rumah']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kode_pos_rumah" class="control-label">POS RUMAH</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kode_pos_rumah" id="kode_pos_rumah" value="<?php echo $value['kode_pos_rumah']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="telp_rumah" class="control-label">TELP RUMAH</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="telp_rumah" id="telp_rumah" value="<?php echo $value['telp_rumah']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kota_rumah" class="control-label">KOTA RUMAH</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kota_rumah" id="kota_rumah" value="<?php echo $value['kota_rumah']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="handphone" class="control-label">HANDPHONE</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="handphone" id="handphone" value="<?php echo $value['handphone']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="alamat_surat" class="control-label">ALAMAT SURAT</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="alamat_surat" id="alamat_surat" value="<?php echo $value['alamat_surat']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kode_pos_surat" class="control-label">POS SURAT</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kode_pos_surat" id="kode_pos_surat" value="<?php echo $value['kode_pos_surat']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="email" class="control-label">EMAIL</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="email" id="email" value="<?php echo $value['email']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kota_surat" class="control-label">KOTA SURAT</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kota_surat" id="kota_surat" value="<?php echo $value['kota_surat']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="paspor" class="control-label">PASPOR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="paspor" id="paspor" value="<?php echo $value['paspor']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="alamat_kantor" class="control-label">ALAMAT KANTOR</label></div>
 				<div class="form-group col-md-8"><input type="text" class="form-control" name="alamat_kantor" id="alamat_kantor" value="<?php echo $value['alamat_kantor']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-sm-2"><label for="kode_pos_kantor" class="control-label">POS KANTOR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kode_pos_kantor" id="kode_pos_kantor" value="<?php echo $value['kode_pos_kantor']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-sm-2"><label for="telp_kantor" class="control-label">TELP KANTOR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="telp_kantor" id="telp_kantor" value="<?php echo $value['telp_kantor']; ?>"></div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-2"><label for="kota_kantor" class="control-label">KOTA KANTOR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="kota_kantor" id="kota_kantor" value="<?php echo $value['kota_kantor']; ?>"></div>
 				<div class="form-group col-md-1"><label>&nbsp</label></div>
 				<div class="form-group col-md-2"><label for="fax_kantor" class="control-label">FAX KANTOR</label></div>
 				<div class="form-group col-md-3"><input type="text" class="form-control" name="fax_kantor" id="fax_kantor" value="<?php echo $value['fax_kantor']; ?>"></div>
 			</div>
 			<?php if ($this->updates == "t") { ?>
 			<div class="control-group">
 				<label class="control-label">&nbsp</label>
 				<div class="controls">
 					<div>
 						<input type = "submit" value = "INSERT" class = "btn btn-medium btn-primary "/>
 					</div>
 				</div>
 			</div>
 			<?php } ?> 
 		</form>
 	</div>
	</div>
	</div>
<?php } }else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>
<script type="text/javascript">
jQuery(function() {
	jQuery( "#tanggal_lahir" ).datepicker(option);
	jQuery( "#tgl_sk_ban" ).datepicker(option);
});
fancy();
</script>