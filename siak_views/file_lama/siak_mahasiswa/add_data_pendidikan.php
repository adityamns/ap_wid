<div class="modal-body">
	<div class="portlet-body form">
		
 		<form id="formAddDP" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/tambah_pendidikan/<?=$this->nim;?>/<?=$this->jenis?>" method = "post">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="program">PROGRAM</label>
						<div class="controls">
							<input type="hidden" name="nomor_seleksi" value="<?=$this->nosel?>">
							<input type="hidden" name="nim" value="<?=$this->nim?>">
							<input type="text" class="m-wrap span12" name="program" id="program" placeholder="Jenjang Studi">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_perguran_tinggi">UNIVERSITAS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_perguran_tinggi" id="nama_perguran_tinggi" placeholder="UNIVERSITAS">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="fakultas">FAKULTAS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="fakultas" id="fakultas" placeholder="FAKULTAS">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_perguruan_tinggi">PRODI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="program_studi" id="program_studi" placeholder="PRODI">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="beban_studi">BEBAN STUDI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="beban_studi" id="beban_studi" placeholder="BEBAN STUDI">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_lulus">TGL LULUS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal_lulus" id="tanggal_lulus" placeholder="TGL LULUS">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<!--/span-->
			</div>
			
			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="sekolah">SEKOLAH</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="sekolah" id="sekolah" placeholder="SEKOLAH">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
			</div>
		</form>
		
 	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn">Close</button>
	<button type="submit" class="btn green" onclick="document.getElementById('formAddDP').submit();">Save changes</button>
</div>