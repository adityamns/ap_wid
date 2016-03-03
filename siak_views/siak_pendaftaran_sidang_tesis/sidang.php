<?php if ($this->cek_mhs == NULL) { ?>
<div class="alert alert-danger">Mahasiswa ini tidak terdaftar</div>
<?php }else if (sizeof($this->data_judul) != 0) { ?>
<?php foreach ($this->data_judul as $key => $value) { ?>
<div class="alert alert-warning">Pengajuan Tesis Sudah Dikonfirmasi, Silahkan klik Daftar untuk Mendaftar Tesis</div>
<!--<div class="panel panel-danger" style="width:650px;">
	<div class="panel-heading">
		<h3 class="panel-title">Data Judul Tesis</h3>
	</div>
	<div class="panel-body">
 	<div class="container-fluid">-->
 		<form method = "post" class="form-horizontal" action = "<?php echo URL;?>siak_pendaftaran_sidang_tesis/siak_ok/<?php echo $value['id'];?>">
        	<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">NIM</label>
						<div class="controls">
							<input type="text" class="m-wrap span6" name="nim" id="nim" value="<?php echo $value['nim'];?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Nama</label>
						<div class="controls">
                        	<?php foreach($this->siak_mhs as $key => $vnama) { ?>
							<input type="text" class="m-wrap span12" id="NAMA" value="<?php echo $vnama['nama_depan']." ".$vnama['nama_belakang'];?>" readonly>
                            <?php } ?>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Program Studi</label>
						<div class="controls">
                        	<?php foreach($this->siak_prodi as $key => $vprodi) { ?>
                            <input type="hidden" class="m-wrap span12" id="PRODI_ID" name="prodi_id" value="<?php echo $vprodi['prodi_id'];?>" readonly>
							<input type="text" class="m-wrap span12" id="PRODI" value="<?php echo $vprodi['prodi'];?>" readonly>
                            <?php } ?>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Dosen Pembimbing I</label>
						<div class="controls">
                        <?php if($this->siak_pembimbing1 != NULL){ ?>
                        	<?php foreach($this->siak_pembimbing1 as $key => $vpem1) { ?>
							<input type="text" class="m-wrap span12" name="dosen_pembimbing1" value="<?php echo $vpem1['nama'];?>" readonly>
                            <?php } ?>
                        <? }else{ ?>
                        	<input type="text" class="m-wrap span12" name="dosen_pembimbing1" value="" readonly>
                        <?php } ?>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Dosen Pembimbing II</label>
						<div class="controls">
                        <?php if($this->siak_pembimbing2 != NULL){ ?>
                        	<?php foreach($this->siak_pembimbing2 as $key => $vpem2) { ?>
							<input type="text" class="m-wrap span12" name="dosen_pembimbing2" value="<?php echo $vpem2['nama'];?>" readonly>
                            <?php } ?>
                        <? }else{ ?>
                        	<input type="text" class="m-wrap span12" name="dosen_pembimbing2" value="" readonly>
                        <?php } ?>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Judul Tesis</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="judul" id="judul" value="<?php echo $value['judul'];?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Metodelogi</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="metodelogi" id="metodelogi" value="<?php echo $value['metodelogi'];?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Tujuan</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tujuan" id="tujuan" value="<?php echo $value['tujuan'];?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Referensi</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="referensi" id="referensi" value="<?php echo $value['referensi'];?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">Tanggal Pengajuan</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal_pengajuan" id="tanggal_pengajuan" value="<?php $x = explode("-",$value['tanggal_pengajuan']); echo $x[2]."-".$x[1]."-".$x[0]; ?>" readonly>
						</div>
					</div>
				</div>
            </div>
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="matkul_id">&nbsp;</label>
						<div class="controls">
							<input type="submit" class="btn green" value="DAFTAR">
						</div>
					</div>
				</div>
            </div>
 		</form>
 	<!--</div>
 </div>
 </div>-->
<?php } }else if($this->over != NULL){ ?>
	<?php if(Siak_session::siak_get('level')==16){ ?>
	<div class="alert alert-danger">Anda Sudah Mendaftar Sidang Tesis</div>
    <?php }else{ ?>
    <div class="alert alert-danger">Mahasiswa ini Sudah Mendaftar Sidang Tesis</div>
    <?php } ?>
	<?php } else { ?>
    <?php if(Siak_session::siak_get('level')==16){ ?>
	<div class="alert alert-danger">Anda Belum Berhak Mengikuti Ujian</div>
    <?php }else{ ?>
    <div class="alert alert-danger">Mahasiswa ini Belum Berhak Mengikuti Ujian</div>
    <?php } ?>
<?php } ?>
 <script type="text/javascript">
 jQuery(function() {
 	// jQuery( "#tanggal_pengajuan" ).datepicker(option);
 });
 </script>
 