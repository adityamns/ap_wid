<?php if($this->cek_mhs == NULL){ ?>
<script>alert("Mahasiswa ini tidak terdaftar");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php }else if($this->ada == 0){ ?>
<script>alert("Mahasiswa ini tidak lulus sidang proposal");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php }else if($this->afg == "ada"){ ?>
<script>alert("Mahasiswa ini sudah mengajukan judul tesis");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php }else if($this->mhs == NULL){ ?>
<script>alert("Mahasiswa ini tidak terdaftar");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php }else if($this->lulus_tesis == "lulus"){ ?>
<script>alert("Mahasiswa ini sudah lulus tesis");jQuery('button[type="submit"]').attr('disabled','disabled');</script>
<?php } ?>
<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
		<label class="control-label" for="nama">Nama</label>
			<div class="controls">
            <?php foreach($this->mhs as $maha => $siswa){ ?>
			<input type="text" class="m-wrap span12" readonly id="NAMA" value="<?php echo $siswa['nama_depan']." ".$siswa['nama_belakang']; ?>" required>
            <input type="hidden" name="judultesis_id" value="<?php echo $this->jud_id; ?>">
            <?php } ?>
            </div>
		</div>
	</div>
	<div class="span6">
		<div class="control-group">
		<label class="control-label" for="prodi">Program Studi</label>
			<div class="controls">
            <?php foreach($this->mhs as $maha => $siswa){ ?>
			<input type="text" class="m-wrap span12" readonly id="PRODI" name="prodi_id" value="<?php echo $siswa['prodi_id']; ?>" required>
            <?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="judul">Judul Tesis</label>
			<div class="controls ">
			<input type="text" class="m-wrap span12" name="judul" id="judul">
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="judul">Metodelogi</label>
			<div class="controls ">
			<input type="text" class="m-wrap span12" name="metodelogi" id="metodelogi">
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="judul">Tujuan</label>
			<div class="controls ">
			<input type="text" class="m-wrap span12" name="tujuan" id="tujuan">
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="judul">Referensi</label>
			<div class="controls ">
			<input type="text" class="m-wrap span12" name="referensi" id="referensi">
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="tanggal_pengajuan">Tanggal Pengajuan</label>
			<div class="controls ">
			<input type="text" class="m-wrap span12" readonly value="<?php echo date('d-m-Y'); ?>">
            <input type="hidden" name="tanggal_pengajuan" id="tanggal_pengajuan" value="<?php echo date('Y-m-d'); ?>">
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="control-group">
			<label class="control-label" for="tanggal_pengajuan">Dosen Pembimbing I</label>
			<div class="controls ">
            <select name="dosen_pembimbing1" class="m-wrap span12">
			<option value="">-- Dosen Pembimbing I --</option>
            <?php foreach($this->jenis_dosen as $jenis => $dosena){ ?>
            <?php foreach($this->dosen_pembimbing as $dosen => $pembimbing){ ?>
            <?php if($dosena['nip'] == $pembimbing['kode']){ ?>
            <option value="<?php echo $pembimbing['kode'] ?>" <?php echo $pembimbing['kode']==$this->dosen_proposal?"selected":"";?>><?php echo $pembimbing['nama']; ?></option>
            <?php }}} ?>
			</select>
			</div>
		</div>
	</div>
</div>