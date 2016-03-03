<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-home"></i>KONFIRMASI KEHADIRAN DOSEN
		</div>
	</div>
	<div class="modal-body">
	<?php foreach ($this->siak_data as $key => $value) { ?>
	<div class="portlet-body form">
			<form class="horizontal-form" action = "<?php echo URL;?>siak_dosen/siak_edit_save/<?php echo $value['nip'];?>/dosen" method = "post" enctype="multipart/form-data">
				<div class='row-fluid'>
				<div class='span6'>
				<div class="control-group">
					<label class="control-label">Unggah Foto</label>
					<div class="controls">
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div class="fileupload-new thumbnail" style="width: 200px; height: 250px;">
								<div id="targetLayer">
										<img width='200px' height='250px' id="foto" nama="<?php echo $value['foto']; ?>" src="<?=URL?>siak_public/siak_upload/Dosen/<?php echo $value['foto']; ?>" alt="" />
								</div>
							</div>
							<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 250px; line-height: 20px;">
							
							
							</div>
							<div>
								<span class="btn green btn-file">
									<span class="fileupload-new">Pilih Gambar</span>
									<span class="fileupload-exists">Ubah</span>
									<input type="file" class="default" name="foto" value="<?php echo $value['foto']; ?>"/>
								</span>
								
								<a href="#" class="btn red fileupload-exists" data-dismiss="fileupload">Hapus</a>
	<!-- 							<input type="submit" class="btn green fileupload-exists" value="Save"> -->
							</div>
						</div>
						<span class="label label-important">CATATAN!</span>
						<span>
						Preview Gambar Hanya bisa
						Untuk Browser (Firefox, Chrome, Opera, 
						Safari and Internet Explorer 10) Versi Terbaru
						</span>
					</div>
				</div>
				</div><div class='span6'>
				<div class="control-group">
					<label class="control-label">Unggah Foto</label>
					<div class="controls">
						<div class="fileupload fileupload-new" data-provides="fileupload">
							<div class="fileupload-new thumbnail" style="width: 200px; height: 250px;">
								<div id="targetLayer">
										<img width='200px' height='250px' id="foto" name="<?php echo $value['foto']; ?>" src="<?=URL?>siak_public/siak_upload/Dosen/<?php echo $value['foto']; ?>" alt="" />
								</div>
							</div>
							<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 250px; line-height: 20px;">
							
							
							</div>
							<div>
								<span class="btn green btn-file">
									<span class="fileupload-new">Pilih Gambar</span>
									<span class="fileupload-exists">Ubah</span>
									<input type="file" class="default" name="foto" value="<?php echo $value['foto']; ?>"/>
								</span>
								
								<a href="#" class="btn red fileupload-exists" data-dismiss="fileupload">Hapus</a>
	<!-- 							<input type="submit" class="btn green fileupload-exists" value="Save"> -->
							</div>
						</div>
						<span class="label label-important">CATATAN!</span>
						<span>
						Preview Gambar Hanya bisa
						Untuk Browser (Firefox, Chrome, Opera, 
						Safari and Internet Explorer 10) Versi Terbaru
						</span>
					</div>
				</div>
				</div>
				</div>
                
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NIP PENGAJAR</label>
							<div class="controls">
								<input type="text" name="nkpt" id="nkpt" class="m-wrap span12" value="<?php echo $value['nip']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NIP PENGGANTI</label>
							<div class="controls">
								<input type="text" readonly name="kode_prodi" id="kode_prodi" class="m-wrap span12" value="<?php echo $value['nip_pengganti']; ?>">
	     					</div>
						</div>
					</div>
				</div>
                
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NAMA PENGAJAR</label>
							<div class="controls">
								<input type="text" readonly class="m-wrap span12" value="<?php echo $value['gelar_depan']." ".$value['nama']." ".$value['gelar_blkng']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">NAMA PENGGANTI</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" value="<?php echo $value['nama_pengganti']; ?>">
	     					</div>
						</div>
					</div>
				</div>		
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">MATAKULIAH</label>
							<div class="controls">
								<input type="text" name="nip" id="nip" class="m-wrap span12" value="<?php echo $value['kode_matkul']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">TOPIK</label>
							<div class="controls">
								<input type="text" name="topik" id="topik" class="m-wrap span12" value="<?php echo $value['kode_topik']; ?>">
	     					</div>
						</div>
					</div>
				</div>
				
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">PERTEMUANKE</label>
							<div class="controls">
								<input type="text" name="pertemuanke" id="pertemuanke" class="m-wrap span12" value="<?php echo $value['pertemuanke']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">RUANG</label>
							<div class="controls">
								<input type="text" class="m-wrap span12" value="<?php echo $value['nama_ruang']; ?>">
								<input type="hidden" name="ruang_id" id="ruang_id" class="m-wrap span12" value="<?php echo $value['ruang_id']; ?>">
	      					</div>
						</div>
					</div>
				</div>
				
                <div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">HARI & TANGGAL</label>
							<div class="controls">
								<input type="text" readonly name="nidn" id="nidn" class="m-wrap span12" value="<?php echo $value['tgl']; ?>">
	      					</div>
						</div>
					</div>
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">WAKTU ABSEN</label>
							<div class="controls">
								<input type="text" readonly name="waktu" id="waktu" class="m-wrap span12" value="<?php echo $value['waktu']; ?>">
	     					</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="control-group">
							<label class="control-label" for="firstName">STATUS DOSEN UTAMA</label>
							<div class="controls">
								<input type="text" name="nidn" id="nidn" class="m-wrap span12" value="<?php echo $value['status']; ?>">
	      					</div>
						</div>
					</div>
				</div>
                
                
				
				<button class="btn blue" type="submit">
					<i class="icon-ok"></i>
					Simpan
				</button>
				
			</form>
		</div>
	<?php } ?>
	</div>
	</div>
	