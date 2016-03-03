<?php if($this->ada_mhs == "tidak"){ ?>
<script>alert("Mahasiswa ini tidak terdaftar");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php }else if($this->mhs_tesis != "sudah"){ ?>
<script>alert("Mahasiswa ini belum melakukan irs semester akhir");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php }else if($this->grade_gagal == "ya" && $this->kurang == "ya"){ ?>
<script>alert("Mahasiswa ini masih ada matakuliah yang harus diperbaiki dan masih kurang beberapa sks");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php }else if($this->kurang == "ya"){ ?>
<script>alert("Mahasiswa ini masih kurang beberapa sks");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php }else if($this->afg == "ada"){ ?>
<script>alert("Mahasiswa ini sudah mengajukan proposal");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php }else if($this->grade_gagal == "ya"){ ?>
<script>alert("Mahasiswa ini masih ada matakuliah yang harus diperbaiki");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php }else if($this->sudah == "sudah"){ ?>
<script>alert("Mahasiswa ini sudah lulus tesis");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php } ?>
<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
		<label class="control-label" for="nama">Nama</label>
			<div class="controls">
            <?php if($this->ada_mhs != "tidak"){ ?>
            <?php foreach($this->mhs as $maha => $siswa){ ?>
			<input type="text" class="m-wrap span12" readonly id="NAMA" value="<?php echo $siswa['nama_depan']." ".$siswa['nama_belakang']; ?>" required>
            </div>
            <?php }}else{ ?>
            <input type="text" class="m-wrap span12" readonly id="NAMA" value="" required>
            </div>
            <?php } ?>
		</div>
	</div>
	<div class="span6">
		<div class="control-group">
		<label class="control-label" for="prodi">Program Studi</label>
			<div class="controls">
			<?php if($this->ada_mhs != "tidak"){ ?>
            <?php foreach($this->mhs as $maha => $siswa){ ?>
			<input type="text" class="m-wrap span12" readonly id="PRODI" name="prodi_id" value="<?php echo $siswa['prodi_id']; ?>" required>
            </div>
            <?php }}else{ ?>
            <input type="text" class="m-wrap span12" readonly id="PRODI" name="prodi_id" value="" required>
            </div>
            <?php } ?>
		</div>
	</div>
</div>