<?php
if ($this->reades == "t") { ?>
<?php if (count($this->siak_data) != 0){ ?>
<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="portlet-body form">
		
		<form class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/siak_edit_save/<?php echo $value['nim'];?>/0/data_pribadi_umum/umum" method = "post">
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_depan">NAMA DEPAN</label>
						<div class="controls">
							<input type="text" name="nama_depan" id="nama_depan" class="m-wrap span12" value="<?php echo $value['nama_depan']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_belakang">NAMA BELAKANG</label>
						<div class="controls">
							<input type="text" name="nama_belakang" id="nama_belakang" class="m-wrap span12" value="<?php echo $value['nama_belakang']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tempat_lahir">TEMPAT LAHIR</label>
						<div class="controls">
							<input type="text" name="tempat_lahir" id="tempat_lahir" class="m-wrap span12" value="<?php echo $value['tempat_lahir']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_lahir">TANGGAL LAHIR</label>
						<div class="controls">
							<input type="text" name="tanggal_lahir" id="tanggal_lahir" class="m-wrap span12" value="<?php echo $value['tanggal_lahir']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kelamin_kode">JENIS KELAMIN</label>
						<div class="controls">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?php foreach ($this->kelamin as $kunci => $nilai) { ?>
							<label class="radio">
								<input type="radio" name="kelamin_kode" id="kelamin_kode" <?php if($value['kelamin_kode'] == $nilai['kode']){ echo 'checked'; }?> value="<?php echo $nilai['kode']; ?>">
								<?php echo $nilai['nama'];?>&nbsp;&nbsp;
							</label>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="agama_id">AGAMA</label>
						<div class="controls">
							<select name="agama_id" class="m-wrap span12">	
							<?php foreach ($this->agama as $kunci => $nilai) { ?>
								<option value = "<?php echo $nilai['id'];?>" <?php if($value['agama_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>	
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="status_perkawinan_id">STATUS KAWIN</label>
						<div class="controls">		
							<select name="status_perkawinan_id" class="m-wrap span12">	
							<?php foreach ($this->perkawinan as $kunci => $nilai) { ?>
								<option value = "<?php echo $nilai['id'];?>" <?php if($value['status_perkawinan_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>	
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="no_ktp">NO. KTP</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="no_ktp" id="no_ktp" value="<?php echo $value['no_ktp']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="alamat_rumah">ALAMAT RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="alamat_rumah" id="alamat_rumah" value="<?php echo $value['alamat_rumah']; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kode_pos_rumah">POS RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kode_pos_rumah" id="kode_pos_rumah" value="<?php echo $value['kode_pos_rumah']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="telp_rumah">TELP RUMAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="telp_rumah" id="telp_rumah" value="<?php echo $value['telp_rumah']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kota_rumah">KOTA RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kota_rumah" id="kota_rumah" value="<?php echo $value['kota_rumah']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="handphone">HANDPHONE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="handphone" id="handphone" value="<?php echo $value['handphone']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="alamat_surat">ALAMAT SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="alamat_surat" id="alamat_surat" value="<?php echo $value['alamat_surat']; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kode_pos_surat">POS SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kode_pos_surat" id="kode_pos_surat" value="<?php echo $value['kode_pos_surat']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="email">EMAIL</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="email" id="email" value="<?php echo $value['email']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kota_surat">KOTA SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kota_surat" id="kota_surat" value="<?php echo $value['kota_surat']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="paspor">PASPOR</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="paspor" id="paspor" value="<?php echo $value['paspor']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<?php //if ($this->updates == "t") { ?>
<!-- 			<div class="form-actions"> -->
				<button class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Save
				</button>
<!-- 			</div> -->
			<?php //} ?>
		</form>
	</div>
</div>
<?php } } else{ ?> 
<div class="modal-body">
	<div class="portlet-body form">
		
 		<form class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/siak_insert_save/<?php echo $this->nim;?>/0/data_pribadi_umum/umum" method = "post">
 			<input type="hidden" value="<?php echo $this->nim; ?>" name="nim">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_depan">NAMA DEPAN</label>
						<div class="controls">
							<input type="text" name="nama_depan" id="nama_depan" class="m-wrap span12" value="<?php echo $value['nama_depan']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_belakang">NAMA BELAKANG</label>
						<div class="controls">
							<input type="text" name="nama_belakang" id="nama_belakang" class="m-wrap span12" value="<?php echo $value['nama_belakang']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tempat_lahir">TEMPAT LAHIR</label>
						<div class="controls">
							<input type="text" name="tempat_lahir" id="tempat_lahir" class="m-wrap span12" value="<?php echo $value['tempat_lahir']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_lahir">TANGGAL LAHIR</label>
						<div class="controls">
							<input type="text" name="tanggal_lahir" id="tanggal_lahir" class="m-wrap span12" value="<?php echo $value['tanggal_lahir']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kelamin_kode">JENIS KELAMIN</label>
						<div class="controls">
							<label class="radio">
								<div class="radio">
								<span>
									<input type="radio" name="kelamin_kode" id="kelamin_kode"  value="L">
								</span>
								</div>
								laki-laki
							</label>
							<label class="radio">
								<div class="radio">
								<span>
									<input type="radio" name="kelamin_kode" id="kelamin_kode"  value="P">
								</span>
								</div>
								Perempuan
							</label>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="agama_id">AGAMA</label>
						<div class="controls">
							<select name="agama_id" class="m-wrap span12">	
							<?php foreach ($this->agama as $kunci => $nilai) { ?>
								<option value = "<?php echo $nilai['id'];?>" <?php if($value['agama_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>	
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="status_perkawinan_id">STATUS KAWIN</label>
						<div class="controls">		
							<select name="status_perkawinan_id" class="m-wrap span12">	
							<?php foreach ($this->perkawinan as $kunci => $nilai) { ?>
								<option value = "<?php echo $nilai['id'];?>" <?php if($value['status_perkawinan_id'] == $nilai['id']){ echo 'selected = "selected"'; }?> ><?php echo $nilai['nama'];?></option>	
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="no_ktp">NO. KTP</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="no_ktp" id="no_ktp" value="<?php echo $value['no_ktp']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="alamat_rumah">ALAMAT RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="alamat_rumah" id="alamat_rumah" value="<?php echo $value['alamat_rumah']; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kode_pos_rumah">POS RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kode_pos_rumah" id="kode_pos_rumah" value="<?php echo $value['kode_pos_rumah']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="telp_rumah">TELP RUMAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="telp_rumah" id="telp_rumah" value="<?php echo $value['telp_rumah']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kota_rumah">KOTA RUMAH</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kota_rumah" id="kota_rumah" value="<?php echo $value['kota_rumah']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="handphone">HANDPHONE</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="handphone" id="handphone" value="<?php echo $value['handphone']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="control-group">
						<label class="control-label" for="alamat_surat">ALAMAT SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="alamat_surat" id="alamat_surat" value="<?php echo $value['alamat_surat']; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kode_pos_surat">POS SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kode_pos_surat" id="kode_pos_surat" value="<?php echo $value['kode_pos_surat']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="email">EMAIL</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="email" id="email" value="<?php echo $value['email']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="kota_surat">KOTA SURAT</label>
						<div class="controls">		
							<input type="text" class="m-wrap span12" name="kota_surat" id="kota_surat" value="<?php echo $value['kota_surat']; ?>">
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="paspor">PASPOR</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="paspor" id="paspor" value="<?php echo $value['paspor']; ?>">
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
 			<?php //if ($this->updates == "t") { ?>
<!-- 			<div class="form-actions"> -->
				<button class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Insert
				</button>
<!-- 			</div> -->
			<?php //} ?>
 		</form>
	</div>
</div>
<?php } } else{ ?>
<div class="alert alert-danger">Anda Tidak Mempunyai Hak Untuk Mengakses Halaman Ini...</div>
<?php } ?>