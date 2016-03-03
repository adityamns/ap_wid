 <div class="jumbotron" style="width:500px">
<h3>Add Mahasiswa</h3><hr>
<form class="form-inline" action = "<?php echo URL;?>siak_mahasiswa/siak_create" method = "post">
	<div class="control-group">
						<label>NIM</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="nim"  placeholder="" value="<?php echo $value['nim'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KELAS</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kelas"  placeholder="" value="<?php echo $value['kelas'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>USERNAME</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="user_login"  placeholder="" value="<?php echo $value['user_login'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>LEVEL_ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="level_id"  placeholder="" value="<?php echo $value['level_id'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PASSWORD</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="password"  placeholder="" value="<?php echo $value['password'];?>" readonly>
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label>NAMA MAHASISWA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="nama_mhs"  placeholder="" value="<?php echo $value['nama_mhs'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>FOTO</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="foto_mhs"  placeholder="" value="<?php echo $value['foto_mhs'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>STATUS MAHASISWA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="status_mhs"  placeholder="" value="<?php echo $value['status_mhs'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PRODI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="prodi_id"  placeholder="" value="<?php echo $value['prodi_id'];?>">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>JENIS KELAMIN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="jenis_kelamin"  placeholder="" value="<?php echo $value['jenis_kelamin'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>WARGA NEGARA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="warga_negara"  placeholder="" value="<?php echo $value['warga_negara'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KEBANGSAAN</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kebangsaan"  placeholder="" value="<?php echo $value['kebangsaan'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TEMPAT LAHIR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tmp_lahir"  placeholder="" value="<?php echo $value['tmp_lahir'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TANGGAL LAHIR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_lahir"  placeholder="" value="<?php echo $value['tgl_lahir'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>AGAMA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="agama"  placeholder="" value="<?php echo $value['agama'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>STATUS SIPIL</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="status_sipil"  placeholder="" value="<?php echo $value['status_sipil'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>ALAMAT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="alamat"  placeholder="" value="<?php echo $value['alamat'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>KOTA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kota"  placeholder="" value="<?php echo $value['kota'];?>">
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>RT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="rt"  placeholder="" value="<?php echo $value['rt'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>RW</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="rw"  placeholder="" value="<?php echo $value['rw'];?>" readonly>
							</div>
						</div>
					</div>
					
					
					<div class="control-group">
						<label>KODE POS</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="kode_pos"  placeholder="" value="<?php echo $value['kode_pos'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PROPINSI</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="propinsi"  placeholder="" value="<?php echo $value['propinsi'];?>" readonly>
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label>NEGARA</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="negara"  placeholder="" value="<?php echo $value['negara'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TELEPON</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="telepon"  placeholder="" value="<?php echo $value['telepon'];?>"readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>HANDPHONE</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="handphone"  placeholder="" value="<?php echo $value['handphone'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>EMAIL</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="email"  placeholder="" value="<?php echo $value['email'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>ASAL PT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="asal_pt"  placeholder="" value="<?php echo $value['asal_pt'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PRODI ASAL PT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="prodi_asal_pt"  placeholder="" value="<?php echo $value['prodi_asal_pt'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TANGGAL LULUS ASAL PT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_lulus_asal_pt"  placeholder="" value="<?php echo $value['tgl_lulus_asal_pt'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>IPK ASAL PT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="ipk_asal_pt"  placeholder="" value="<?php echo $value['ipk_asal_pt'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>IPK</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="ipk"  placeholder="" value="<?php echo $value['ipk'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>WISUDA ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="wisuda_id"  placeholder="" value="<?php echo $value['wisuda_id'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>PREDIKAT</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="predikat"  placeholder="" value="<?php echo $value['predikat'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>SK MASUK</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="sk_masuk"  placeholder="" value="<?php echo $value['sk_masuk'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TGL SK MASUK</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_sk_masuk"  placeholder="" value="<?php echo $value['tgl_sk_masuk'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>SK KELUAR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="sk_keluar"  placeholder="" value="<?php echo $value['sk_keluar'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TGL SK KELUAR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_sk_keluar"  placeholder="" value="<?php echo $value['tgl_sk_keluar'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TAHUN KELUAR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="thn_keluar"  placeholder="" value="<?php echo $value['thn_keluar'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>CATATAN KELUAR</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="catatan_keluar"  placeholder="" value="<?php echo $value['catatan_keluar'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>NO IDENTITAS</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="no_identitas"  placeholder="" value="<?php echo $value['no_identitas'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>FAKULTAS ID</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="fakultas_id"  placeholder="" value="<?php echo $value['fakultas_id'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>NO IJAZAH</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="no_ijazah"  placeholder="" value="<?php echo $value['no_ijazah'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TGL IJAZAH</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="tgl_ijazah"  placeholder="" value="<?php echo $value['tgl_ijazah'];?>" readonly>
							</div>
						</div>
					</div>
					<div class="control-group">
						<label>TOTAL SKS</label>
						<div class="controls">
							<div class="form-group">
								<input type="text" class="form-control" name="total_sks"  placeholder="" value="<?php echo $value['total_sks'];?>" readonly>
							</div>
						</div>
					</div>
	<div class="control-group">
		<label class="control-label">&nbsp</label>
		<div class="controls">
			<div>
				<input type = "submit" value = "INSERT" class = "btn btn-medium btn-primary "/>
				<input type = "reset" value = "CANCEL" class = "btn btn-medium btn-warning "/>
			</div>
		</div>
	</div>
</form>
</div>