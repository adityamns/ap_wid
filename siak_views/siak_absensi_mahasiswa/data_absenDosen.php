
		<?php 
		//var_dump($this->statusAbsen);
		if(sizeof($this->data_list) > 0 && $this->statusAbsen=="BISA"){
					foreach ($this->data_list as $key => $value) { 
					
		?>
					<input type='hidden' value='<?php echo $value['nip'];?>' name='nip' id='pengampu'>
					<input type='hidden' value='2' name='telat' id='telat'>
					<div class="row-fluid">
								<div class="alert alert-success" role="alert"><b>SILAHKAN PILIH STATUS</b></div>
							</div>
					<?php if($value['nip']==$_SESSION['username']){ ?>
					<center>
							<div class="row-fluid">
								<div class="alert alert-success" role="alert"><b>SILAHKAN PILIH STATUS</b></div>
							</div>
							<div class="row-fluid">
								<div class="control-group">
									<label class="control-label" for="firstName">STATUS</label>
										<div class="controls">
											<div id="statedivs">
												<select id='hadir' onchange='addKeterangan();' name='hadir' class="small m-wrap" required>Absensi</option>
													<option value=''>Status</option>
													<option value='1'>Hadir</option>
													<option value='2'>Tidak Hadir</option>
												</select>
											</div>
										</div>
								</div>
							</div>
							<div id="ktr"></div>
					</center>
					<?php } else { foreach ($this->dosen as $key => $row) { ?>
						<div class="row-fluid">
								<center><div class="control-group">
									<label class="control-label" for="firstName"><b>DOSEN PENGAMPU</label>
									<div class="controls">
										<input class="m-wrap span12" type='text' value='<?php echo $row['gelar_depan']." ".$row['nama']." ".$row['gelar_blkng']; ?>' readonly>
								</div>
							</div>
						</div>
						<?php } ?>
						<input type='hidden' value='<?php echo $_SESSION['username'];?>' name='nip_pengganti'>
						<div class='row'>
							<div class='form-group col-md-5'><label for='kode_matkul' class='control-label'>STATUS DOSEN PENGAMPU</label></div>
								<div class='form-group col-md-8'>
									<div class='form-group col-md-2'><input type='radio' name='keterangan' value='2'>SAKIT</div>
									<div class='form-group col-md-2'><input type='radio' name='keterangan' value='3'>IZIN</div>
									<div class='form-group col-md-2'><input type='radio' name='keterangan' value='4'>ALPA</div>
								</div>
						</div>
					<?php } ?>
					<center><div class="row-fluid">
									<div class="control-group">
										<label class="control-label" for="firstName"><b>HARI/TANGGAL</label>
									</div>
							</div>
					<div class="row-fluid">
								<div class="control-group pull-left margin-right-10">
										<input class="m-wrap span10" type='text' name='tgl'  value='<?php echo $value['tanggal']; ?>'readonly>
								</div>
								<div class="control-group pull-left">
								<label class="control-label" for="firstName">/</label>
								</div>
								<div class="control-group pull-left">
									<input class="m-wrap span10" type='text'  value='<?php echo $value['time']; ?>'readonly>
								</div>
							</div>
					<center><div class="row-fluid">
								<div class="control-group">
									<label class="control-label" for="firstName"><b>WAKTU ABSEN</label>
										<div class="controls">
											<?php $dt = new DateTime(); ?>
												<input class="m-wrap span10" type='text' name='waktu'  value='<?php echo $dt->format('Y-m-d H:i:s'); ?>'readonly>
										</div>				
								</div>
							</div>
					<center><div class="row-fluid">
								<div class="control-group">
									<label class="control-label"><b>CATATAN</label>
									<div class="controls">
										<textarea class="span12 wysihtml5 m-wrap" value='catatan' rows="6"></textarea>
									</div>
								</div>
							</div>
					<div class="control-group">
						<label class="control-label">&nbsp </label>
					<div class="controls">
						<div>
							<input type = "submit" value = "CHECK" class = "btn btn-medium btn-primary " />
						</div>
					</div>
 			</div>
			<?php }
			}else if(sizeof($this->data_list) > 0 && $this->statusAbsen=="HABIS"){
					foreach ($this->data_list as $key => $value) { 
				?>
				<div class="portlet box yellow">
					<div class="portlet-title">
						<div class="caption"><i class="icon-reorder"></i>FORM PENGISIAN</div>
					</div>
					<div class="portlet-body form">
				<div class="row-fluid">
						<div class="alert alert-danger" role="alert"><b>MAAF WAKTU ABSEN ANDA HABIS !</b></div>
				</div>
				<input type='hidden' value='<?php echo $value['nip'];?>' name='nip' id='pengampu'>
				<input type='hidden' value='1' name='telat' id='telat'>
					<div class="row-fluid">
							<div class="alert alert-success" role="alert"><b>SILAHKAN PILIH STATUS</b>
					</div>
					<?php if($value['nip']==$_SESSION['username']){ ?>
					<center>
							<div class="row-fluid">
								<div class="alert alert-success" role="alert"><b>SILAHKAN PILIH STATUS</b></div>
							</div>
							<div class="row-fluid">
								<div class="control-group">
									<label class="control-label" for="firstName"><b>STATUS</label>
										<div class="controls">
											<div id="statedivs">
												<select id='hadir' onchange='addKeterangan();' name='hadir' class="small m-wrap" required>Absensi</option>
													<option value=''>Status</option>
													<option value='1'>Hadir</option>
													<option value='2'>Tidak Hadir</option>
												</select>
											</div>
										</div>
								</div>
							</div>
							<div id="ktr"></div>
					</center>
					<?php } else { foreach ($this->dosen as $key => $row) { ?>
						<div class="row-fluid">
								<center><div class="control-group">
									<label class="control-label" for="firstName"><b>DOSEN PENGAMPU</label>
									<div class="controls">
										<input class="m-wrap span12" type='text' value='<?php echo $row['gelar_depan']." ".$row['nama']." ".$row['gelar_blkng']; ?>' readonly>
								</div>
							</div>
						</div>
						<?php } ?>
						<input type='hidden' value='<?php echo $_SESSION['username'];?>' name='nip_pengganti'>
							<div class="row-fluid">
								<center><div class="control-group">
									<label class="control-label"><b>Radio Buttons</label>
									<div class="controls">
										<label class="radio">
										<div class="radio">
											<span><input type="radio" name="keterangan" value="2"></span>
										</div>SAKIT
										</label>
										<label class="radio">
										<div class="radio">
											<span><input type="radio" name="keterangan" value="3"></span>
										</div>IJIN
										</label>
										<label class="radio">
										<div class="radio">
											<span><input type="radio" name="keterangan" value="3"></span>
										</div>ALPA
										</label>
									</div>
								</div>
							</div>
					<?php } ?>
					<center><div class="row-fluid">
									<div class="control-group">
										<label class="control-label" for="firstName"><b>HARI/TANGGAL</label>
									</div>
							</div>
					<div class="row-fluid">
								<div class="control-group pull-left margin-right-10">
										<input class="m-wrap span10" type='text' name='tgl'  value='<?php echo $value['tanggal']; ?>'readonly>
								</div>
								<div class="control-group pull-left">
								<label class="control-label" for="firstName">/</label>
								</div>
								<div class="control-group pull-left">
									<input class="m-wrap span10" type='text'  value='<?php echo $value['time']; ?>'readonly>
								</div>
							</div>
					<center><div class="row-fluid">
								<div class="control-group">
									<label class="control-label" for="firstName"><b>WAKTU ABSEN</label>
										<div class="controls">
											<?php $dt = new DateTime(); ?>
												<input class="m-wrap span10" type='text' name='waktu'  value='<?php echo $dt->format('Y-m-d H:i:s'); ?>'readonly>
										</div>				
								</div>
							</div>
					<center><div class="row-fluid">
								<div class="control-group">
									<label class="control-label"><b>CATATAN</label>
									<div class="controls">
										<textarea class="span12 wysihtml5 m-wrap" value='catatan' rows="6"></textarea>
									</div>
								</div>
							</div>
					<div class="control-group">
						<label class="control-label">&nbsp </label>
					<div class="controls">
						<div>
							<input type = "submit" value = "CHECK" class = "btn btn-medium btn-primary " />
						</div>
					</div>
 			</div>
				<?php }
				}else if(sizeof($this->data) > 0){ ?>
				<div class="row-fluid">
						<div class="alert alert-info" role="alert">ANDA SUDAH MELAKUKAN ABSEN TERIMAKASIH</div>
				</div>
			<?php }	else{	?>
				<div class="row-fluid">
						<div class="alert alert-danger" role="alert">MAAF ABSEN BELUM DI BUAT, SILAHKAN KONFIRMASI DENGAN PRODI YANG BERSANGKUTAN</div>
				</div>
			<?php }	?>