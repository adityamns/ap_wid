<?php foreach ($this->siak_data as $key => $value) { ?>
<div class="modal-body">
	<div class="portlet-body form">
		
 		<form id="formEditDP" class="horizontal-form" action = "<?php echo URL;?>siak_mahasiswa/siak_edit_save/<?php echo $value['nim'];?>/0/pendidikan_mahasiswa/<?php echo $this->jenis;?>/<?php echo $value['id'];?>" method = "post">
 			<div class="row-fluid">
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="program">PROGRAM</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="program" id="program" value="<?php echo $value['program']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_perguran_tinggi">UNIVERSITAS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="nama_perguran_tinggi" id="nama_perguran_tinggi" value="<?php echo $value['nama_perguran_tinggi']; ?>">
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
							<input type="text" class="m-wrap span12" name="fakultas" id="fakultas" value="<?php echo $value['fakultas']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="nama_perguruan_tinggi">PRODI</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="program_studi" id="program_studi" value="<?php echo $value['program_studi']; ?>">
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
							<input type="text" class="m-wrap span12" name="beban_studi" id="beban_studi" value="<?php echo $value['beban_studi']; ?>">
      <!-- 						  <span class="help-block">Klik Tombol LIHAT untuk melihat Kode yang tersedia</span> -->
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control-label" for="tanggal_lulus">TGL LULUS</label>
						<div class="controls">
							<input type="text" class="m-wrap span12" name="tanggal_lulus" id="tanggal_lulus" value="<?php echo $value['tanggal_lulus']; ?>">
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
							<input type="text" class="m-wrap span12" name="sekolah" id="sekolah" value="<?php echo $value['sekolah']; ?>">
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
	<button type="submit" class="btn green" onclick="document.getElementById('formEditDP').submit();">Save changes</button>
</div>
<?php } ?>