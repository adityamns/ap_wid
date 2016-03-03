<div class="modal-body">
		<div class="portlet-body form">
 		<form id="formAddKeg" class="horizontal-form" action = "<?php echo URL;?>siak_pendaftaran_tesis/siak_create" method = "post">
        	<input type="hidden" name="status" id="status" value="1">
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nim">NIM</label>
						<div class="controls">
						<input type="text" class="m-wrap span12" name="nim" id="nim" placeholder="Nomor Induk Mahasiswa..." onchange="ubahSem(this)">
						</div>
					</div>
				</div>
            </div>

            
            <div id="getmatkul">
            <div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama">Nama</label>
						<div class="controls ">
						<input type="text" class="m-wrap span12" readonly id="NAMA" required>
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="prodi">Program Studi</label>
						<div class="controls ">
                        <input type="hidden" readonly name="prodi_id" id="PRODI_ID" />
						<input type="text" class="m-wrap span12" readonly id="PRODI">
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
                            <option value="<?php echo $pembimbing['kode'] ?>"><?php echo $pembimbing['nama']; ?></option>
                            <?php }}} ?>
						</select>
						</div>
					</div>
				</div>
            </div>
            </div>
 		</form>
 	</div>
 </div>
 
 <div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Batal</button>
	<button type="submit" id="kekirim" class="btn green" onclick="klik();">Simpan</button>
</div>
 